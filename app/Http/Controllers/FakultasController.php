<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\ResponseMessage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('Fakultas.Index');
    }

    /**
     * Return a listing of the resource.
     * 
     * @return \Illuminate\Contracts\Routing\ResponseFactory::json
     */
    public function getAll()
    {
        $data = Fakultas::all()->where('fks_rec_status','=',1);
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
            $request->validate(['fks_name' => 'required']);

            $fks_count = DB::table('fakultas')->count();

            $request->merge([
                'fks_id' => $fks_count + 1,
                'fks_rec_status' => 1,
                'fks_rec_createdby' => strlen(trim($request->creator)) == 0 ? 'system' : $request->creator,
                'fks_rec_created' => date('Y-m-d H:i:s')
            ]);

            Fakultas::create($request->all());

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
            $data = Fakultas::query()->where('fks_id', '=', $id)->where('fks_rec_status','=',1)->get();

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
            $request->validate(['fks_name' => 'required']);

            $request->merge([
                'fks_rec_updatedby' => strlen(trim($request->creator)) == 0 ? 'system' : $request->creator,
                'fks_rec_updated' => date('Y-m-d H:i:s')
            ]);

            Fakultas::query()->where('fks_id', '=', $id)->update($request->all());

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
                'fks_rec_status' => -1,
                'fks_rec_deletedby' => 'system',
                'fks_rec_deleted' => date('Y-m-d H:i:s')
            ];

            Fakultas::query()->where('fks_id', '=', $id)->update($update);

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

            Fakultas::query()->where('fks_id', '=', $id)->delete();

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
