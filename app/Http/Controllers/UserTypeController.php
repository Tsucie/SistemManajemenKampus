<?php

namespace App\Http\Controllers;

use App\Models\UserType;
use Illuminate\Support\Facades\Auth;

/**
 * Single Action Controller
 * ketikan php artisan make:controller NamaController --invokable untuk membuatnya
 */
class UserTypeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        if (!Auth::check()) return redirect()->route('login');
    }
    
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return response()->json(UserType::all());
    }
}
