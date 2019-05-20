<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Log;

class LogController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('only_admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $logs = Log::paginate(10);
        return view('logs.index', compact('logs'));
    }

}
