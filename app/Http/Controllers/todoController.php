<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\todo;
use App\Models\dateList;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;


class todoController extends Controller
{
    public function index()
    {
    //    $tasks = DB::table('todos')->get();
    // $dates = DB::table('date_lists')->get();
    $dates = dateList::with('todos')->get();

      //dd($dates);

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

        try {
        // store the data
        DB::table('date_lists')->insert([
            'date' => $dateFormat,
        ]);

        // redirect
        return redirect('portfolio')->with('success', 'Date added!');
        } catch (\Exception $e){
            return redirect('portfolio')
                ->with('error', 'Error during the creation!');
        }
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
        return redirect('portfolio')->with('success', 'Task added!');
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
        return redirect('portfolio')->with('success', 'Date updated!');
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
        return redirect('portfolio')->with('success', 'Task updated!');
    }

    public function checkTask(Request $request, $id)
    {

        $status = todo::get()->pluck('status');
         //dd($status);
        if ($status[0] == 0) {
        // update the data
        DB::table('todos')->where('id', $id)->update([
            'status' => 1,
        ]);
        Alert::success('Checked', 'Task Completed');
        } else {
        DB::table('todos')->where('id', $id)->update([
        'status' => 0,
        ]);

        Alert::warning('Unchecked', 'Task Not Completed');
        }  

        // redirect
        return redirect('portfolio');
    }
  
    public function destroy($id)
    {
         // delete the todo
        DB::table('date_lists')->where('id', $id)->delete();

        Alert::warning('Warning Title', 'Warning Message');
        // redirect
        return redirect('portfolio')->with('warning', 'List removed!');
    }

    public function destroyTask($id)
    {
         // delete the todo
        DB::table('todos')->where('id', $id)->delete();

        // redirect
        return redirect('portfolio')->with('status', 'Task removed!');
    }
}
