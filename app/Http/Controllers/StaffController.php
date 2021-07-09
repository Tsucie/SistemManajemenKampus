<?php

namespace App\Http\Controllers;

use App\Models\DateTime;
use Exception;
use App\Models\ImageProcessor;
use App\Models\ResponseMessage;
use App\Models\Staff;
use App\Models\User;
use App\Models\UserPhoto;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = DB::table('staff')
                    ->join('users','staff.stf_u_id','=','users.u_id')
                    ->join('staff_categories','staff.stf_sc_id','=','staff_categories.sc_id')
                    ->leftJoin('user_photos','staff.stf_u_id','=','user_photos.up_u_id')
                    ->select('staff.*', 'users.u_username', 'user_photos.up_filename', 'user_photos.up_photo', 'staff_categories.sc_name')
                    ->orderBy('staff.stf_sc_id')
                    ->where('staff.stf_rec_status','=',1)
                    ->get();
        
        return view('Staff.Index', compact('staff'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Staff.Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $stf
     * @return \Illuminate\Http\Response
     */
    public function store(Request $stf)
    {
        $stf->validate([
            'u_username' => 'required',
            'u_password' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'stf_sc_id' => 'required',
            'stf_fullname' => 'required',
            'stf_num_stat' => 'required',
            'stf_education' => 'required',
            'stf_experience' => 'required',
            'stf_address' => 'required',
            'stf_province' => 'required',
            'stf_city' => 'required',
            'stf_birthplace' => 'required',
            'stf_birthdate' => 'required',
            'stf_gender' => 'required',
            'stf_state' => 'required',
            'stf_email' => 'required',
            'stf_status' => 'required',
            'stf_contact' => 'required'
        ]);

        $u_id = rand(-2147483648,2147483647);
        $photo = null;
        if ($stf->hasFile('image'))
        {
            $photo = ImageProcessor::getImageThumbnail($stf, 'image', 'Stf');
            $photo->merge([
                'up_id' => rand(-2147483648,2147483647),
                'up_u_id' => $u_id,
                'up_rec_status' => 1,
                'up_rec_createdby' => strlen(trim($stf->creator)) == 0 ? 'system' : $stf->creator,
                'up_rec_created' => DateTime::Now()
            ]);
        }

        $stf->merge([
            'stf_id' => rand(-2147483648,2147483647),
            'stf_u_id' => $u_id,
            'stf_rec_status' => 1,
            'stf_rec_createdby' => strlen(trim($stf->creator)) == 0 ? 'system' : $stf->creator,
            'stf_rec_created' => DateTime::Now()
        ]);

        $user = new Request();
        $user->merge([
            'u_id' => $u_id,
            'u_ut_id' => 2,
            'u_username' => '@'.$stf->u_username,
            'u_password' => Hash::make($stf->u_password),
            'u_rec_status' => 1,
            'u_rec_createdby' => strlen(trim($stf->creator)) == 0 ? 'system' : $stf->creator,
            'u_rec_created' => DateTime::Now()
        ]);

        DB::beginTransaction();
        try
        {
            $queryUser =
                "INSERT INTO users (`u_id`,`u_ut_id`,`u_username`,`u_password`,`u_rec_status`,`u_rec_createdby`,`u_rec_created`) ".
                "VALUES ($user->u_id, $user->u_ut_id, '$user->u_username', '$user->u_password', $user->u_rec_status, '$user->u_rec_createdby', '$user->u_rec_created')";
            DB::insert($queryUser);

            if ($photo != null) UserPhoto::create($photo->all());
            
            $stf_fks_col = $stf->has('stf_fks_id') ? "`stf_fks_id`," : "";
            $stf_fks_id = $stf->has('stf_fks_id') ? "$stf->stf_fks_id," : "";
            $stf_ps_col = $stf->has('stf_ps_id') ? "`stf_ps_id`," : "";
            $stf_ps_id = $stf->has('stf_ps_id') ? "$stf->stf_ps_id," : "";
            $stf_mk_col = $stf->has('stf_mk_id') ? "`stf_mk_id`," : "";
            $stf_mk_id = $stf->has('stf_mk_id') ? "$stf->stf_mk_id," : "";
            $stf_num = $stf->input($stf->stf_num_stat);
            $queryStf =
                "INSERT INTO staff(`stf_id`,`stf_u_id`,`stf_sc_id`,".$stf_fks_col.$stf_ps_col.$stf_mk_col."`stf_fullname`,`stf_num_stat`,`$stf->stf_num_stat`,`stf_education`,`stf_experience`,`stf_address`,`stf_province`,`stf_city`,`stf_birthplace`,`stf_birthdate`,`stf_gender`,`stf_religion`,`stf_state`,`stf_email`,`stf_status`,`stf_contact`,`stf_rec_status`,`stf_rec_createdby`,`stf_rec_created`) ".
                "VALUES ($stf->stf_id,$stf->stf_u_id,$stf->stf_sc_id,".$stf_fks_id.$stf_ps_id.$stf_mk_id."'$stf->stf_fullname','$stf->stf_num_stat','$stf_num','$stf->stf_education','$stf->stf_experience','$stf->stf_address','$stf->stf_province','$stf->stf_city','$stf->stf_birthplace','$stf->stf_birthdate','$stf->stf_gender','$stf->stf_religion','$stf->stf_state','$stf->stf_email',$stf->stf_status,'$stf->stf_contact',$stf->stf_rec_status,'$stf->stf_rec_createdby','$stf->stf_rec_created')";
            DB::insert($queryStf);

            DB::commit();
            return redirect()->route('Staff.index')->with('1', 'Data has created');
        }
        catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
            return redirect()->route('Staff.index')->with('0', $ex->getCode().':'.$ex->getMessage());
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
        try
        {
            if (preg_match("/[A-Za-z]/", $id)) throw new Exception("Invalid Data", 0);
            $data = $this->getData($id);
            return response()->json($data);
        }
        catch (Exception $ex)
        {
            return response()->json([
                'code' => $ex->getCode(),
                'message' => $ex->getMessage()
            ]);
        }
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
        return view('Staff.Update', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $req
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $req->validate([
            'u_username' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'stf_sc_id' => 'required',
            'stf_fullname' => 'required',
            'stf_num_stat' => 'required',
            'stf_education' => 'required',
            'stf_experience' => 'required',
            'stf_address' => 'required',
            'stf_province' => 'required',
            'stf_city' => 'required',
            'stf_birthplace' => 'required',
            'stf_birthdate' => 'required',
            'stf_gender' => 'required',
            'stf_state' => 'required',
            'stf_email' => 'required',
            'stf_status' => 'required',
            'stf_contact' => 'required'
        ]);

        $photo = null;
        if ($req->hasFile('image'))
        {
            $photo = ImageProcessor::getImageThumbnail($req, 'image', 'Stf');
            if ($req->up_id != null) {
                $photo->merge([
                    'up_rec_updatedby' => strlen(trim($req->creator)) == 0 ? 'system' : $req->creator,
                    'up_rec_updated' => DateTime::Now()
                ]);
            }
            else
            {
                $photo->merge([
                    'up_id' => rand(-2147483648,2147483647),
                    'up_u_id' => $id,
                    'up_rec_status' => 1,
                    'up_rec_createdby' => strlen(trim($req->creator)) == 0 ? 'system' : $req->creator,
                    'up_rec_created' => DateTime::Now()
                ]);
            }
        }

        $stf = new Request();
        if ($req->stf_fks_id != "null") $stf->merge(['stf_fks_id' => $req->stf_fks_id]);
        if ($req->stf_ps_id != "null") $stf->merge(['stf_ps_id' => $req->stf_ps_id]);
        if ($req->stf_mk_id != "null") $stf->merge(['stf_mk_id' => $req->stf_mk_id]);
        $stf->merge([
            'stf_sc_id' => $req->stf_sc_id,
            'stf_fullname' => $req->stf_fullname,
            'stf_num_stat' => $req->stf_num_stat,
            $req->stf_num_stat => $req->input($req->stf_num_stat),
            'stf_education' => $req->stf_education,
            'stf_experience' => $req->stf_experience,
            'stf_address' => $req->stf_address,
            'stf_province' => $req->stf_province,
            'stf_city' => $req->stf_city,
            'stf_birthplace' => $req->stf_birthplace,
            'stf_birthdate' => $req->stf_birthdate,
            'stf_gender' => $req->stf_gender,
            'stf_state' => $req->stf_state,
            'stf_email' => $req->stf_email,
            'stf_status' => $req->stf_status,
            'stf_contact' => $req->stf_contact,
            'stf_rec_updatedby' => strlen(trim($req->creator)) == 0 ? 'system' : $req->creator,
            'stf_rec_updated' => DateTime::Now()
        ]);

        $user = new Request();
        $user->merge([
            'u_username' => '@'.$req->u_username,
            'u_rec_updatedby' => strlen(trim($req->creator)) == 0 ? 'system' : $req->creator,
            'u_rec_updated' => DateTime::Now()
        ]);

        DB::beginTransaction();
        try
        {
            if ($photo != null)
                if ($req->up_id != null)
                    UserPhoto::query()->where('up_u_id','=',$id)->update($photo->all());
                else
                    UserPhoto::create($photo->all());
            
            User::query()->where('u_id','=',$id)->update($user->all());
            Staff::query()->where('stf_u_id','=',$id)->update($stf->all());

            DB::commit();
            return redirect()->route('Staff.index')->with('Success', 'Data has edited');
        }
        catch (Exception $ex) {
            DB::rollBack();
            return redirect()->route('Staff.index')->with('Error', $ex->getCode().':'.$ex->getMessage());
        }
    }

    /**
     * Exclude the specified resource in storage.
     * 
     * @param int $id
     * @return Illuminate\Contracts\Routing\ResponseFactory::json
     */
    public function exclude($id)
    {
        $resmsg = new ResponseMessage();

        $existStf = $this->getData($id);

        $photo = null;
        if ($existStf->up_id != null)
        {
            $photo = new Request();
            $photo->merge([
                'up_rec_status' => -1,
                'up_rec_deletedby' => 'system',
                'up_rec_deleted' => DateTime::Now()
            ]);
        }

        $user = [
            'u_rec_status' => -1,
            'u_rec_deletedby' => 'system',
            'u_rec_deleted' => DateTime::Now()
        ];

        $stf = [
            'stf_rec_status' => -1,
            'stf_rec_deletedby' => 'system',
            'stf_rec_deleted' => DateTime::Now()
        ];

        DB::beginTransaction();
        try
        {
            if($photo != null) UserPhoto::query()->where('up_u_id','=',$id)->update($photo->all());
            User::query()->where('u_id','=',$id)->update($user);
            Staff::query()->where('stf_u_id','=',$id)->update($stf);

            DB::commit();
            $resmsg->code = 1;
            $resmsg->message = 'Data has temporary deleted';
        }
        catch (Exception $ex)
        {
            DB::rollBack();
            $resmsg->code = $ex->getCode();
            $resmsg->message = $ex->getMessage();
        }
        return response()->json([
            'code' => $resmsg->code,
            'message' => $resmsg->message
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response json()
     */
    public function destroy($id)
    {
        $resmsg = new ResponseMessage();

        DB::beginTransaction();
        try
        {
            Staff::query()->where('stf_u_id', '=', $id)->delete();
            User::query()->where('u_id', '=', $id)->delete();

            DB::commit();
            $resmsg->code = 1;
            $resmsg->message = 'Data has deleted';
        }
        catch (Exception $ex)
        {
            DB::rollBack();
            $resmsg->code = $ex->getCode();
            $resmsg->message = $ex->getMessage();
        }
        return response()->json([
            'code' => $resmsg->code,
            'message' => $resmsg->message
        ]);
    }

    private function getData($id)
    {
        $data = DB::table('staff')
                    ->join('users','staff.stf_u_id','=','users.u_id')
                    ->join('staff_categories','staff.stf_sc_id','=','staff_categories.sc_id')
                    ->leftJoin('user_photos','staff.stf_u_id','=','user_photos.up_u_id')
                    ->leftJoin('fakultas', 'staff.stf_fks_id', '=', 'fakultas.fks_id')
                    ->leftJoin('program_studis', 'staff.stf_ps_id', '=', 'program_studis.ps_id')
                    ->leftJoin('mata_kuliahs', 'staff.stf_mk_id', '=', 'mata_kuliahs.mk_id')
                    ->select('staff.*', 'users.u_username','user_photos.up_id', 'user_photos.up_filename', 'user_photos.up_photo', 'staff_categories.sc_name', 'fakultas.fks_name', 'program_studis.ps_name', 'mata_kuliahs.mk_name')
                    ->where('staff.stf_u_id', '=', $id, 'and')
                    ->where('staff.stf_rec_status','=',1)
                    ->get();
        
        $data[0]->up_photo = base64_encode($data[0]->up_photo);
        $data[0]->u_username = str_replace('@','',$data[0]->u_username);
        $data[0]->stf_birthdate = date('Y-m-d', strtotime($data[0]->stf_birthdate));

        return $data;
    }
}
