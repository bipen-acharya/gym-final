<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;

class TrainersController extends Controller
{
    public function index()
    {
        return User::where('user_role', 2)->paginate(20);
    }
}
