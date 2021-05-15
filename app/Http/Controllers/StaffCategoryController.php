<?php

namespace App\Http\Controllers;

use App\Models\StaffCategory;
use Exception;
use General\ResponseMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffCategoryController extends Controller
{
    /**
     * [GET([controller])] Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff_categories = StaffCategory::all();
        return view('StaffCategory.index', compact('staff_categories'));
    }

    /**
     * [POST([controller]/create)] Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * [POST([controller])] Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response json()
     */
    public function store(Request $request)
    {
        $resmsg = new ResponseMessage();

        try
        {
            $request->validate(['sc_name' => 'required']);
        
            // Name in the form must match with the model column names!
            StaffCategory::create($request->all());

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
     * [GET([controller])/{$id}] Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response json()
     */
    public function show($id)
    {
        try
        {
            if (preg_match("/[A-Za-z]/", $id)) throw new Exception("Invalid Data", 0);
            $category = DB::table('staff_categories')->select()->where('sc_id', '=', $id)->get();

            return response()->json(compact('category'));
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
     * [GET([controller]/{$id}/edit)] Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * [PUT/PATCH([controller]/{$id})]Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StaffCategory $sc
     * @return \Illuminate\Http\Response json()
     */
    public function update(Request $request, StaffCategory $sc)
    {
        $resmsg = new ResponseMessage();

        try
        {
            if ($sc == null) throw new Exception("Incomplete Data", 0);
            $request->validate(['sc_name' => 'required']);

            $sc->update($request->all());

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
     * [DELETE([controller]/{$id})] Remove the specified resource from storage.
     *
     * @param  \App\Models\StaffCategory $sc
     * @return \Illuminate\Http\Response json()
     */
    public function destroy(StaffCategory $sc)
    {
        $resmsg = new ResponseMessage();

        try
        {
            if ($sc == null) throw new Exception("Incomplete Data", 0);
            
            $sc->delete();

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
