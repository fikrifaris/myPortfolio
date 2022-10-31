<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\todo;
use App\Models\dateList;
use Carbon\Carbon;

class todoController extends Controller
{
    public function index()
    {
    //    $tasks = DB::table('todos')->get();
    // $dates = DB::table('date_lists')->get();
    $dates = dateList::with('todos')->get();

    //  dd($dates->todos->task);

        return view ('portfolio',compact(
            'dates',
           
        ));
    }

    public function create()
    {
        
    }
  
    public function store(Request $request)
    {
         // validate the form
        $request->validate([
            'date' => 'required',
        ]);

         $dateFormat = Carbon::parse($request->date)->format("Y-m-d");

        // store the data
        DB::table('date_lists')->insert([
            'date' => $dateFormat,
        ]);

        // redirect
        return redirect('portfolio')->with('status', 'Date added!');
    }

    public function storeTask(Request $request, $id)
    {
         // validate the form
        $request->validate([
            'task' => 'required',
        ]);

        // store the data
        DB::table('todos')->insert([
            'task' => $request->task,
            'status' => 0,
            'date_list_id' => $id
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
        ]);

        $dateFormat = Carbon::parse($request->date)->format("Y-m-d");

        // update the data
        DB::table('date_lists')->where('id', $id)->update([
            'date' => $dateFormat,
        ]);

        // redirect
        return redirect('portfolio')->with('status', 'Date updated!');
    }

    public function updateTask(Request $request, $id)
    {
        // validate the form
        $request->validate([
            'task' => 'required',
        ]);

        // update the data
        DB::table('todos')->where('id', $id)->update([
            'task' => $request->task
        ]);

        // redirect
        return redirect('portfolio')->with('status', 'Task updated!');
    }

    public function completeTask(Request $request, $id)
    {
        // update the data
        DB::table('todos')->where('id', $id)->update([
            'status' => 1,
        ]);

        // redirect
        return redirect('portfolio')->with('status', 'Task Completed!');
    }
  
    public function destroy($id)
    {
         // delete the todo
        DB::table('date_lists')->where('id', $id)->delete();

        // redirect
        return redirect('portfolio')->with('status', 'List removed!');
    }

    public function destroyTask($id)
    {
         // delete the todo
        DB::table('todos')->where('id', $id)->delete();

        // redirect
        return redirect('portfolio')->with('status', 'Task removed!');
    }
}
