<?php

namespace App\Http\Controllers;

use App\Models\Chart;
use App\Models\dateList;
use App\Models\todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function index()
    {
        $pending = DB::table('date_lists')
                        ->leftJoin('todos', 'date_lists.id', '=', 'todos.date_list_id')
                        ->select('status', DB::raw('count(*) as total'))
                        ->where('status', 0)
                        ->groupBy('date')
                        ->pluck('total', 'status')->all();

        $complete = DB::table('date_lists')
                        ->leftJoin('todos', 'date_lists.id', '=', 'todos.date_list_id')
                        ->select('status', DB::raw('count(*) as total'))
                        ->groupBy('date')
                        ->where('status', 1)
                        ->pluck('total', 'status')->all();

        $groups = DB::table('date_lists')
                        ->select('date')
                        ->groupBy('date')
                        ->pluck('date')->all();

        // Prepare the data for returning with the view
        $chart = new Chart;
                $chart->labels = (array_values($groups));
                $chart->pending_dataset = (array_values($pending));
                $chart->complete_dataset = (array_values($complete));
        return view('statistics', compact('chart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function show(Chart $chart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function edit(Chart $chart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chart $chart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chart $chart)
    {
        //
    }
}
