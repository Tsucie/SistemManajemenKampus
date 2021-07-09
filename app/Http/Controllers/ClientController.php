<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\DateTime;
use Exception;
use Intervention\Image\Facades\Image;
use App\Models\ResponseMessage;
use App\Models\UserPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = DB::table('clients')
                      ->join('users', 'clients.c_u_id', '=', 'users.u_id')
                      ->leftJoin('user_photos', 'clients.c_u_id', '=', 'user_photos.up_u_id')
                      ->select('clients.*', 'users.u_username', 'user_photos.up_filename', 'user_photos.up_photo')
                      ->where('clients.c_rec_status', '=', 1)
                      ->get();
        
        return view('Client.Index', compact('client'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Not Used because using API Route
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $client
     * @return \Illuminate\Http\Response
     */
    public function store(Request $client)
    {
        $resmsg = new ResponseMessage();

        try
        {
            $client->validate([
                'u_username' => 'required',
                'u_password' => 'required',
                'c_name' => 'required',
                'u_file' => 'image|mimes:jpeg,png,jpg|max:2048'
            ]);

            $u_id = rand(-2147483648,2147483647);
            $photo = null;
            if ($client->hasFile('u_file'))
            {
                $photo = new Request();
                $imgExt = $client->file('u_file')->getClientOriginalExtension();
                $up_filename = 'C_'.$client->u_username.'_ProfilePhoto.'.$imgExt;
                $imgFile = $client->u_file;
                $up_photo = Image::make($imgFile)->resize(100, 100, function ($constraint) {
                    $constraint->aspectRatio();
                });
                Response::make($up_photo->encode($imgExt));

                $photo->merge([
                    'up_id' => rand(-2147483648,2147483647),
                    'up_u_id' => $u_id,
                    'up_photo' => $up_photo,
                    'up_filename' => $up_filename,
                    'up_rec_status' => 1,
                    'up_rec_createdby' => strlen(trim($client->creator)) == 0 ? 'system' : $client->creator,
                    'up_rec_created' => DateTime::Now()
                ]);
            }

            $client->merge([
                'c_id' => rand(-2147483648,2147483647),
                'c_u_id' => $u_id,
                'c_code' => "C-".rand(1000000000,2147483647),
                'c_rec_status' => 1,
                'c_rec_createdby' => strlen(trim($client->creator)) == 0 ? 'system' : $client->creator,
                'c_rec_created' => DateTime::Now()
            ]);

            $user = new Request();
            $user->merge([
                'u_id' => $u_id,
                'u_ut_id' => 1,
                'u_username' => '@'.$client->u_username,
                'u_password' => Hash::make($client->u_password),
                'u_rec_status' => 1,
                'u_rec_createdby' => strlen(trim($client->creator)) == 0 ? 'system' : $client->creator,
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

                $queryClient =
                    "INSERT INTO clients (`c_id`,`c_u_id`,`c_code`,`c_name`,`c_remark`,`c_rec_status`,`c_rec_createdby`,`c_rec_created`) ".
                    "VALUES ($client->c_id, $client->c_u_id, '$client->c_code', '$client->c_name', '$client->c_remark', $client->c_rec_status, '$client->c_rec_createdby', '$client->c_rec_created')";
                DB::insert($queryClient);

                DB::commit();

                $resmsg->code = 1;
                $resmsg->message = "Data has created";
            }
            catch (Exception $sqlEx) {
                DB::rollBack();
                throw $sqlEx;
            }
        }
        catch (Exception $ex)
        {
            $resmsg->code = $ex->getCode();
            $resmsg->message = $ex->getMessage();
        }
        return response()->json([
            'code' => $resmsg->code,
            'message' => $resmsg->message
        ]);
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
            $data = DB::table('clients')
                      ->join('users', 'clients.c_u_id', '=', 'users.u_id')
                      ->leftJoin('user_photos', 'clients.c_u_id', '=', 'user_photos.up_u_id')
                      ->select('clients.*', 'users.u_username', 'user_photos.up_id', 'user_photos.up_filename', 'user_photos.up_photo')
                      ->where('clients.c_u_id', '=', $id, 'and')
                      ->where('clients.c_rec_status', '=', 1)
                      ->get();
            
            $data[0]->up_photo = base64_encode($data[0]->up_photo);
            $data[0]->u_username = str_replace('@','',$data[0]->u_username);
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
        //Not Used because using API Route
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $resmsg = new ResponseMessage();

        try
        {
            if (preg_match("/[A-Za-z]/", $id)) throw new Exception("Invalid Data", 0);
            $request->validate([
                'c_name' => 'required',
                'u_username' => 'required',
                'u_file' => 'image|mimes:jpeg,png,jpg|max:2048'
            ]);

            $photo = null;
            if ($request->hasFile('u_file'))
            {
                $photo = new Request();
                $imgExt = $request->file('u_file')->getClientOriginalExtension();
                $up_filename = 'C_'.$request->u_username.'_ProfilePhoto.'.$imgExt;
                $imgFile = $request->u_file;
                $up_photo = Image::make($imgFile)->resize(100, 100, function ($constraint) {
                    $constraint->aspectRatio();
                });
                Response::make($up_photo->encode($imgExt));

                if ($request->up_id != null) {
                    $photo->merge([
                        'up_photo' => $up_photo,
                        'up_filename' => $up_filename,
                        'up_rec_updatedby' => strlen(trim($request->creator)) == 0 ? 'system' : $request->creator,
                        'up_rec_updated' => DateTime::Now()
                    ]);
                }
                else
                {
                    $photo->merge([
                        'up_id' => rand(-2147483648,2147483647),
                        'up_u_id' => $id,
                        'up_photo' => $up_photo,
                        'up_filename' => $up_filename,
                        'up_rec_status' => 1,
                        'up_rec_createdby' => strlen(trim($request->creator)) == 0 ? 'system' : $request->creator,
                        'up_rec_created' => DateTime::Now()
                    ]);
                }
            }

            $client = new Request();
            $client->merge([
                'c_name' => $request->c_name,
                'c_remark' => $request->c_remark,
                'c_rec_updatedby' => strlen(trim($request->creator)) == 0 ? 'system' : $request->creator,
                'c_rec_updated' => DateTime::Now()
            ]);

            $user = new Request();
            $user->merge([
                'u_username' => '@'.$request->u_username,
                'u_rec_updatedby' => strlen(trim($request->creator)) == 0 ? 'system' : $request->creator,
                'u_rec_updated' => DateTime::Now()
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
                DB::table('clients')->where('c_u_id', '=', $id)->update($client->all());

                DB::commit();
                $resmsg->code = 1;
                $resmsg->message = "Data has edited";
            }
            catch (Exception $sqlEx) {
                DB::rollBack();
                throw $sqlEx;
            }
        }
        catch (Exception $ex) 
        {
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resmsg = new ResponseMessage();

        try
        {
            if (preg_match("/[A-Za-z]/", $id)) throw new Exception("Invalid Data", 0);

            DB::beginTransaction();
            try
            {
                DB::table('clients')->where('c_u_id', '=', $id)->delete();
                DB::table('users')->where('u_id', '=', $id)->delete();

                DB::commit();
                $resmsg->code = 1;
                $resmsg->message = "Data has deleted";
            }
            catch (Exception $sqlEx) {
                DB::rollBack();
                throw $sqlEx;
            }
        }
        catch (Exception $ex) 
        {
            $resmsg->code = $ex->getCode();
            $resmsg->message = $ex->getMessage();
        }
        return response()->json([
            'code' => $resmsg->code,
            'message' => $resmsg->message
        ]);
    }
}
