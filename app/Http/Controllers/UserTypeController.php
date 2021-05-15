<?php

namespace App\Http\Controllers;

use App\Models\UserType;
use Illuminate\Http\Request;

/**
 * Single Action Controller
 * ketikan php artisan make:controller NamaController --invokable untuk membuatnya
 */
class UserTypeController extends Controller
{
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
