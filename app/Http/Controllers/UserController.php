<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
Use Alert;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        if(Auth::user()->level != 'admin'){
            Alert::warning('Oppss..', 'Kamu Tidak Boleh Mengakses Halaman Itu');
            return redirect('/home');
        }
        $user = User::orderBy('id', 'DESC')->paginate(5);
        return view('user/index', compact('user'));
    }
}
