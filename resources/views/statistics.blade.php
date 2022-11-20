@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <h3 class="panel-heading my-2">Tasks Statistics</h3>
                    <div class="col-lg-12">
                        <canvas id="userChart" class="rounded shadow"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.0.1"></script>
    <script src="{{ URL::asset('js/utils.js') }}"></script>
    <!-- CHARTS -->
    <script>
        var ctx = document.getElementById('userChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',

            // The data for our dataset
            data: {
                labels: {!! json_encode($chart->labels) !!},
                datasets: [{
                        label: 'Completed',
                        backgroundColor: 'green',
                        data: {!! json_encode($chart->complete_dataset) !!},
                    },
                    {
                        label: 'Pending',
                        backgroundColor: 'red',
                        data: {!! json_encode($chart->pending_dataset) !!},
                    }
                ]
            },
            // Configuration options go here
            options: {
                scales: {
                    yAxes: [{
                        stacked: true,
                        ticks: {
                            beginAtZero: true,
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        },
                    }],
                    xAxes: {
                        stacked: true,
                    }
                },
                layout: {
                    padding: {
                        left: 10,
                        right: 10,
                        top: 0,
                        bottom: 10
                    }
                }
            }
        });
    </script>
@endsection
