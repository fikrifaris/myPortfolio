<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\todo;
use Carbon\Carbon;

class todoController extends Controller
{
    public function index()
    {
       $task = DB::table('todos')->get();
        return view ('portfolio', ['todos' => $task]);
    }

    public function create()
    {
        
    }
  
    public function store(Request $request)
    {
         // validate the form
        $request->validate([
            'date' => 'required',
            'task' => 'required|max:200'
        ]);

         $dateFormat = Carbon::parse($request->date)->format("Y-m-d");

        // store the data
        DB::table('todos')->insert([
            'date' => $dateFormat,
            'task' => $request->task,
            'status' => 0
        ]);

        // redirect
        return redirect('portfolio')->with('status', 'Task added!');
    }
    
    public function show($id)
    {
        
    }
    
    public function edit($id)
    {
        
    }
  
    public function update(Request $request, $id)
    {
        // validate the form
        $request->validate([
            'date' => 'required',
            'task' => 'required|max:200'
        ]);

        $dateFormat = Carbon::parse($request->date)->format("Y-m-d");

        // update the data
        DB::table('todos')->where('id', $id)->update([
            'date' => $dateFormat,
            'task' => $request->task
        ]);

        // redirect
        return redirect('portfolio')->with('status', 'Task updated!');
    }
  
    public function destroy($id)
    {
         // delete the todo
        DB::table('todos')->where('id', $id)->delete();

        // redirect
        return redirect('portfolio')->with('status', 'Task removed!');
    }
}
