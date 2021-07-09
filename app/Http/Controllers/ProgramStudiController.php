<?php

namespace App\Http\Controllers;

use App\Models\DateTime;
use App\Models\ProgramStudi;
use App\Models\ResponseMessage;
use Exception;
use Illuminate\Http\Request;

class ProgramStudiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory::json
     */
    public function index()
    {
        $data = ProgramStudi::query()->where('ps_rec_status','=',1)->get();
        return response()->json($data);
    }

    /**
     * Return a specifed listing of the resource.
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory::json
     */
    public function getList($id)
    {
        $data = ProgramStudi::query()->where('ps_fks_id','=',$id,'and')->where('ps_rec_status','=',1)->get();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory::json
     */
    public function store(Request $request)
    {
        $resmsg = new ResponseMessage();

        try
        {
            $request->validate([
                'ps_fks_id' => 'required',
                'ps_name' => 'required'
            ]);
            
            $LastPsData = ProgramStudi::query()->where('ps_fks_id','=',$request->ps_fks_id)->get()->last();
            $ps_id_last = $LastPsData == null ? '1' : (string)(str_replace((string)$request->ps_fks_id, '', (string)$LastPsData->ps_id) + 1);
            $ps_id = (string)$request->ps_fks_id . $ps_id_last;
            
            $request->merge([
                'ps_id' => (int)$ps_id,
                'ps_rec_status' => 1,
                'ps_rec_createdby' => strlen(trim($request->creator)) == 0 ? 'system' : $request->creator,
                'ps_rec_created' => DateTime::Now()
            ]);

            ProgramStudi::create($request->all());

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
     * @return \Illuminate\Contracts\Routing\ResponseFactory::json
     */
    public function show($id)
    {
        try
        {
            if (preg_match("/[A-Za-z]/", $id)) throw new Exception("Invalid Data", 0);
            $data = ProgramStudi::query()->where('ps_id', '=', $id)->where('ps_rec_status','=',1)->get();

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
     * @return \Illuminate\Contracts\Routing\ResponseFactory::json
     */
    public function update(Request $request, $id)
    {
        $resmsg = new ResponseMessage();

        try
        {
            if (preg_match("/[A-Za-z]/", $id)) throw new Exception("Invalid Data", 0);
            $request->validate(['ps_name' => 'required']);

            ProgramStudi::query()->where('ps_id', '=', $id)->update($request->all());

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
     * @return \Illuminate\Contracts\Routing\ResponseFactory::json
     */
    public function exclude($id)
    {
        $resmsg = new ResponseMessage();

        try
        {
            if (preg_match("/[A-Za-z]/", $id)) throw new Exception("Invalid Data", 0);

            $update = [
                'ps_rec_status' => -1,
                'ps_rec_deletedby' => 'system',
                'ps_rec_deleted' => DateTime::Now()
            ];

            ProgramStudi::query()->where('ps_id', '=', $id)->update($update);

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
     * @return \Illuminate\Contracts\Routing\ResponseFactory::json
     */
    public function destroy($id)
    {
        $resmsg = new ResponseMessage();

        try
        {
            if (preg_match("/[A-Za-z]/", $id)) throw new Exception("Invalid Data", 0);

            ProgramStudi::query()->where('ps_id', '=', $id)->delete();

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
