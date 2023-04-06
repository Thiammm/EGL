<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Node\FunctionNode;

class UsersController extends Controller
{
    public function index(){
        return view('admin.users');
    }
}
