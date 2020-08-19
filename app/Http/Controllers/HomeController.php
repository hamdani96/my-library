<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Transaction;
use App\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $transaction = Transaction::get();
        $book = Book::get();
        $user = User::get();
        if(Auth::user()->level == 'user'){
            $data = Transaction::where('status', 'pinjam')
                                ->where('user_id', Auth::user()->id)
                                ->get();
        }else{
            $data = Transaction::where('status', 'pinjam')->get();
        }
        return view('home', compact('transaction', 'book', 'user', 'data'));
    }
}
