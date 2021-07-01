<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index(){
        /* $user = Auth::user(); */
        /* dd($user->name); */
        return view('guest.home'); //quello che c'è dentro la cartella views -> guest -> .blade.php

    }
}
