<?php

namespace App\Http\Controllers;

use App\Models\DateTime;
use App\Models\MataKuliah;
use App\Models\ResponseMessage;
use Exception;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Illuminate\Contracts\Routing\ResponseFactory::json
     */
    public function index()
    {
        $data = MataKuliah::query()->where('mk_rec_status','=',1)->get();
        return response()->json($data);
    }

    /**
     * Return a specified listing of the resource.
     *
     * @return Illuminate\Contracts\Routing\ResponseFactory::json
     */
    public function getList($id)
    {
        $data = MataKuliah::query()->where('mk_ps_id','=',$id,'and')->where('mk_rec_status','=',1)->get();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Contracts\Routing\ResponseFactory::json
     */
    public function store(Request $request)
    {
        $resmsg = new ResponseMessage();

        try
        {
            $request->validate([
                'mk_ps_id' => 'required',
                'mk_sm_id' => 'required',
                'mk_sks' => 'required',
                'mk_mutu' => 'required',
                'mk_name' => 'required',
                'sm_code' => 'required',
                'sm_name' => 'required'
            ]);

            $mk_data = [
                'mk_id' => rand(1,2147483647),
                'mk_ps_id' => $request->mk_ps_id,
                'mk_sm_id' => $request->mk_sm_id,
                'mk_sks' => $request->mk_sks,
                'mk_mutu' => $request->mk_mutu,
                'mk_code' => "MK" . (string)$request->mk_ps_id . $request->sm_code . (string)rand(1000,9999),
                'mk_name' => $request->mk_name,
                'mk_semester' => $request->sm_name,
                'mk_desc' => $request->mk_desc,
                'mk_rec_status' => 1,
                'mk_rec_createdby' => strlen(trim($request->creator)) == 0 ? 'system' : $request->creator,
                'mk_rec_created' => DateTime::Now()
            ];

            MataKuliah::create($mk_data);

            $resmsg->code = 1;
            $resmsg->message = "Data has created";
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
     * @return Illuminate\Contracts\Routing\ResponseFactory::json
     */
    public function show($id)
    {
        try
        {
            if (preg_match("/[A-Za-z]/", $id)) throw new Exception("Invalid Data", 0);
            $data = MataKuliah::query()->where('mk_id', '=', $id)->where('mk_rec_status','=',1)->get();

            return response()->json(compact('data'));
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Illuminate\Contracts\Routing\ResponseFactory::json
     */
    public function update(Request $request, $id)
    {
        $resmsg = new ResponseMessage();

        try
        {
            if (preg_match("/[A-Za-z]/", $id)) throw new Exception("Invalid Data", 0);
            $request->validate([
                'mk_ps_id' => 'required',
                'mk_sm_id' => 'required',
                'mk_sks' => 'required',
                'mk_mutu' => 'required',
                'mk_name' => 'required'
            ]);

            MataKuliah::query()->where('mk_id', '=', $id)->update($request->all());

            $resmsg->code = 1;
            $resmsg->message = "Data has edited";
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
     * Exclude the specified resource while reading data from storage
     * 
     * @param int $id
     * @return Illuminate\Contracts\Routing\ResponseFactory::json
     */
    public function exclude($id)
    {
        $resmsg = new ResponseMessage();

        try
        {
            if (preg_match("/[A-Za-z]/", $id)) throw new Exception("Invalid Data", 0);

            $update = [
                'mk_rec_status' => -1,
                'mk_rec_deletedby' => 'system',
                'mk_rec_deleted' => DateTime::Now()
            ];

            MataKuliah::query()->where('mk_id', '=', $id)->update($update);

            $resmsg->code = 1;
            $resmsg->message = "Data has temporary deleted";
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
     * @return Illuminate\Contracts\Routing\ResponseFactory::json
     */
    public function destroy($id)
    {
        $resmsg = new ResponseMessage();

        try
        {
            if (preg_match("/[A-Za-z]/", $id)) throw new Exception("Invalid Data", 0);

            MataKuliah::query()->where('mk_id', '=', $id)->delete();

            $resmsg->code = 1;
            $resmsg->message = "Data has deleted";
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
