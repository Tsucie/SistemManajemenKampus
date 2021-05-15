<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Exception;
use General\ResponseMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

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
        // dd($client);
        return view('Client.Index', compact('client'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
            $client = DB::table('clients')
                      ->join('users', 'clients.c_u_id', '=', 'users.u_id')
                      ->leftJoin('user_photos', 'clients.c_u_id', '=', 'user_photos.up_u_id')
                      ->select('clients.*', 'users.u_username', 'user_photos.up_filename', 'user_photos.up_photo')
                      ->where('clients.c_u_id', '=', $id, 'and')
                      ->where('clients.c_rec_status', '=', 1)
                      ->get();
        
            return response()->json(compact('client'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Client $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $resmsg = new ResponseMessage();

        try
        {
            if ($client == null) throw new Exception("Incomplete Data", 0);
            $request->validate([
                'c_name' => 'required',
                'u_username' => 'required'
            ]);

            

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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
