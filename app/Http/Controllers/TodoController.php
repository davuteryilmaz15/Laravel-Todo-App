<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Todo;
use App\Log;

class TodoController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $todos = Auth::user()->todos;
        return view('todos.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('todos.create');
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
        $this->validate($request, [
            'title' => 'required|unique:todos|max:255|min:10',
            'deadline' => 'required|date|after:today'
        ]);
        
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $input['completed'] = false;
        
        $todo = Todo::create($input);
        
        $message = "'".$request['title']."' başlıklı görev ".Auth::user()->name." tarafından oluşturuldu.";
        Log::add_log($message);

        Session::flash("toast_status",1);
        return redirect()->route('todo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $todo = Todo::find($id);

        if ($todo->user != Auth::user())
        {
            Session::flash('toast_status', 0);
            return redirect()->route('todo.index');
        }

        return view('todos.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'title' => 'required|max:255|min:10',
            'deadline' => 'required|date|after:today'
        ]);
        
        $input = $request->all();
        
        $todo = Todo::find($id)->update($input);

        $message = "'".$request['title']."' başlıklı görev ".Auth::user()->name." tarafından düzenlendi.";
        Log::add_log($message);

        Session::flash("toast_status",4);
        return redirect()->route('todo.index');
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
        
        $todo = Todo::find($id);

        if ($todo->user != Auth::user())
        {
            Session::flash('toast_status', 0);
            return redirect()->route('todo.index');
        }
        $title = $todo->title;
        Todo::destroy($id);

        $message = "'".$title."' başlıklı görev ".Auth::user()->name." tarafından silindi.";
        Log::add_log($message);

        Session::flash('toast_status', 3);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function complete($id)
    {
        //
        $todo = Todo::find($id);

        if ($todo->user != Auth::user())
        {
            Session::flash('toast_status', 0);
            return redirect()->route('todo.index');
        }

        $todo->completed = !$todo->completed;
        $todo->save();
        
        if ($todo->completed)
        {
            $message = "'".$todo->title."' başlıklı görev ".Auth::user()->name." tarafından tamamlandı.";
        }
        else
        {
            $message = "'".$todo->title."' başlıklı görev ".Auth::user()->name." tarafından tamamlanmadı olarak güncellendi.";
        }
        Log::add_log($message);

        Session::flash('toast_status', 2);
        return back();
    }

}
