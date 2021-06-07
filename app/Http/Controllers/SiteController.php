<?php

namespace App\Http\Controllers;

use App\Models\ImageProcessor;
use Exception;
use App\Models\UserPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $site = DB::table('sites')
                    ->join('users','sites.s_u_id','=','users.u_id')
                    ->leftJoin('user_photos','sites.s_u_id','=','user_photos.up_u_id')
                    ->select('sites.*', 'users.u_username', 'user_photos.up_filename', 'user_photos.up_photo')
                    ->where('sites.s_rec_status','=',1)
                    ->get();
        
        return view('Site.Index', compact('site'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Site.Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $site
     * @return \Illuminate\Http\Response
     */
    public function store(Request $site)
    {
        $site->validate([
            'u_username' => 'required',
            'u_password' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            's_fullname' => 'required',
            's_num_stat' => 'required',
            's_remark' => 'required',
            's_education' => 'required',
            's_experience' => 'required',
            's_address' => 'required',
            's_province' => 'required',
            's_city' => 'required',
            's_birthplace' => 'required',
            's_birthdate' => 'required',
            's_gender' => 'required',
            's_state' => 'required',
            's_email' => 'required',
            's_status' => 'required',
            's_contact' => 'required'
        ]);

        $u_id = rand(-2147483648,2147483647);
        $photo = null;
        if ($site->hasFile('image'))
        {
            $photo = ImageProcessor::getImageThumbnail($site, 'image', 'S');
            $photo->merge([
                'up_id' => rand(-2147483648,2147483647),
                'up_u_id' => $u_id,
                'up_rec_status' => 1,
                'up_rec_createdby' => strlen(trim($site->creator)) == 0 ? 'system' : $site->creator,
                'up_rec_created' => date('Y-m-d H:i:s')
            ]);
        }

        $site->merge([
            's_id' => rand(-2147483648,2147483647),
            's_u_id' => $u_id,
            //s_num_stat is a string containing s_nidn, s_nidk or s_nip
            $site->s_num_stat => $site->input($site->s_num_stat),
            's_rec_status' => 1,
            's_rec_createdby' => strlen(trim($site->creator)) == 0 ? 'system' : $site->creator,
            's_rec_created' => date('Y-m-d H:i:s')
        ]);

        $user = new Request();
        $user->merge([
            'u_id' => $u_id,
            'u_ut_id' => 2,
            'u_username' => '@'.$site->u_username,
            'u_password' => Hash::make($site->u_password),
            'u_rec_status' => 1,
            'u_rec_createdby' => strlen(trim($site->creator)) == 0 ? 'system' : $site->creator,
            'u_rec_created' => date('Y-m-d H:i:s')
        ]);

        DB::beginTransaction();
        try
        {
            $queryUser =
                "INSERT INTO users (`u_id`,`u_ut_id`,`u_username`,`u_password`,`u_rec_status`,`u_rec_createdby`,`u_rec_created`) ".
                "VALUES ($user->u_id, $user->u_ut_id, '$user->u_username', '$user->u_password', $user->u_rec_status, '$user->u_rec_createdby', '$user->u_rec_created')";
            DB::insert($queryUser);

            if ($photo != null) UserPhoto::create($photo->all());
            $s_num = $site->input($site->s_num_stat);
            $querySite =
                "INSERT INTO sites (`s_id`,`s_u_id`,`s_fullname`,`s_remark`,`$site->s_num_stat`,`s_num_stat`,`s_education`,`s_experience`,`s_address`,`s_province`,`s_city`,`s_birthplace`,`s_birthdate`,`s_gender`,`s_religion`,`s_state`,`s_email`,`s_status`,`s_contact`,`s_rec_status`,`s_rec_createdby`,`s_rec_created`) ".
                "VALUES ($site->s_id,$site->s_u_id,'$site->s_fullname','$site->s_remark','$s_num','$site->s_num_stat','$site->s_education','$site->s_experience','$site->s_address','$site->s_province','$site->s_city','$site->s_birthplace','$site->s_birthdate','$site->s_gender','$site->s_religion','$site->s_state','$site->s_email',$site->s_status,'$site->s_contact',$site->s_rec_status,'$site->s_rec_createdby','$site->s_rec_created')";
            DB::insert($querySite);

            DB::commit();
            return redirect()->route('Site.index')->with('1', 'Data has created');
        }
        catch (Exception $ex) {
            DB::rollBack();
            return redirect()->route('Site.index')->with('0', $ex->getCode().':'.$ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->getData($id);
        return view('Site.Detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->getData($id);
        return view('Site.Update', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'u_username' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            's_fullname' => 'required',
            's_num_stat' => 'required',
            's_remark' => 'required',
            's_education' => 'required',
            's_experience' => 'required',
            's_address' => 'required',
            's_province' => 'required',
            's_city' => 'required',
            's_birthplace' => 'required',
            's_birthdate' => 'required',
            's_gender' => 'required',
            's_state' => 'required',
            's_email' => 'required',
            's_status' => 'required',
            's_contact' => 'required'
        ]);

        $photo = null;
        if ($request->hasFile('image'))
        {
            $photo = ImageProcessor::getImageThumbnail($request, 'image', 'S');
            if ($request->up_id != null) {
                $photo->merge([
                    'up_rec_updatedby' => strlen(trim($request->creator)) == 0 ? 'system' : $request->creator,
                    'up_rec_updated' => date('Y-m-d H:i:s')
                ]);
            }
            else
            {
                $photo->merge([
                    'up_id' => rand(-2147483648,2147483647),
                    'up_u_id' => $id,
                    'up_rec_status' => 1,
                    'up_rec_createdby' => strlen(trim($request->creator)) == 0 ? 'system' : $request->creator,
                    'up_rec_created' => date('Y-m-d H:i:s')
                ]);
            }
        }

        $site = new Request();
        $site->merge([
            's_fullname' => $request->s_fullname,
            's_num_stat' => $request->s_num_stat,
            //s_num_stat is a string containing s_nidn, s_nidk or s_nip
            $request->s_num_stat => $request->input($request->s_num_stat),
            's_remark' => $request->s_remark,
            's_education' => $request->s_education,
            's_experience' => $request->s_experience,
            's_address' => $request->s_address,
            's_province' => $request->s_province,
            's_city' => $request->s_city,
            's_birthplace' => $request->s_birthplace,
            's_birthdate' => $request->s_birthdate,
            's_gender' => $request->s_gender,
            's_state' => $request->s_state,
            's_email' => $request->s_email,
            's_status' => $request->s_status,
            's_contact' => $request->s_contact,
            's_rec_updatedby' => strlen(trim($request->creator)) == 0 ? 'system' : $request->creator,
            's_rec_updated' => date('Y-m-d H:i:s')
        ]);

        $user = new Request();
        $user->merge([
            'u_username' => '@'.$request->u_username,
            'u_rec_updatedby' => strlen(trim($request->creator)) == 0 ? 'system' : $request->creator,
            'u_rec_updated' => date('Y-m-d H:i:s')
        ]);

        DB::beginTransaction();
        try 
        {
            if ($photo != null)
                if ($request->up_id != null)
                    DB::table('user_photos')->where('up_u_id', '=', $id)->update($photo->all());
                else
                    UserPhoto::create($photo->all());
            
            DB::table('users')->where('u_id', '=', $id)->update($user->all());
            DB::table('sites')->where('s_u_id', '=', $id)->update($site->all());

            DB::commit();
            return redirect()->route('Site.index')->with('Success', 'Data has edited');
        }
        catch (Exception $ex) {
            DB::rollBack();
            return redirect()->route('Site.index')->with('Error', $ex->getCode().':'.$ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try
        {
            DB::table('sites')->where('s_u_id', '=', $id)->delete();
            DB::table('users')->where('u_id', '=', $id)->delete();

            DB::commit();
            return redirect()->route('Site.index')->with('Success', 'Data has deleted');
        }
        catch (Exception $ex) {
            DB::rollBack();
            return redirect()->route('Site.index')->with('Error', $ex->getCode().':'.$ex->getMessage());
        }
    }

    private function getData($id)
    {
        $data = DB::table('sites')
                    ->join('users', 'sites.s_u_id', '=', 'users.u_id')
                    ->leftJoin('user_photos', 'sites.s_u_id', '=', 'user_photos.up_u_id')
                    ->select('sites.*', 'users.u_username', 'user_photos.up_id', 'user_photos.up_filename', 'user_photos.up_photo')
                    ->where('sites.s_u_id', '=', $id, 'and')
                    ->where('sites.s_rec_status', '=', 1)
                    ->get();
        
        $data[0]->up_photo = base64_encode($data[0]->up_photo);
        $data[0]->u_username = str_replace('@','',$data[0]->u_username);
        
        return $data;
    }
}
