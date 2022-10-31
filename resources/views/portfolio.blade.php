@extends('layouts.app')

@section('content')
    <section class="toDo">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ url('/addDate') }}" method="POST">
            @csrf
            <div id="myDIV" class="TDheader">
                <h2 style="margin:5px">To Do List</h2>
                <input class="date form-control" type="text" id="date" name="date" placeholder="Select Date">
                {{-- <input class="form-control" type="text" id="task" name="task" placeholder="Add Task"> --}}
                <button class="btn btn-primary" type="submit">Add</button>
            </div>
        </form>

        <ul class="list-group">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @foreach ($dates as $date)
                <li class="list-group-item">
                    {{ $date->date }}
                    <button class="btn btn-success" type="submit" data-bs-toggle="collapse"
                        data-bs-target="#collapse-{{ $loop->index }}" aria-expanded="false">Add Task</button>
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse-{{ $loop->index }}" aria-expanded="false">
                        Edit
                    </button>
                    <form action="{{ url('todos/' . $date->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>

                    @foreach ($date->todos as $todo)
                        <ul>

                            <li>
                                @if ($todo->status == 1)
                                    <p style="color: green"><s>{{ $todo->task }}</s></p>
                                @else
                                    {{ $todo->task }}
                                @endif
                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse3-{{ $loop->index }}" aria-expanded="false">
                                    Edit Task
                                </button>

                                <form action="{{ url('taskDel/' . $todo->id) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>

                                <form action="{{ url('marked/' . $todo->id) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-success" type="submit">Complete</button>
                                </form>
                            </li>

                        </ul>

                        <div class="collapse mt-2" id="collapse3-{{ $loop->index }}">
                            <div class="card card-body">
                                <form action="{{ url('editTask/' . $todo->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" class="form-control" name="task" id="task"
                                        value="{{ $todo->task }}">
                                    <button class="btn btn-secondary" type="submit">Update</button>
                                </form>
                            </div>
                        </div>
                    @endforeach

                    <div class="collapse mt-2" id="collapse-{{ $loop->index }}">
                        <div class="card card-body">
                            <form action="{{ url('addTask/' . $date->id) }}" method="POST">
                                @csrf
                                <input type="text" class="form-control" name="task" id="task"
                                    placeholder="Add new task">
                                <button class="btn btn-secondary" type="submit">Add</button>
                            </form>
                        </div>
                    </div>

                    <div class="collapse mt-2" id="collapse2-{{ $loop->index }}">
                        <div class="card card-body">
                            <form action="{{ url('todos/' . $date->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input class="date" type="text" id="date" name="date"
                                    value="{{ date('d-m-Y', strtotime($date->date)) }}">
                                <button class="btn btn-secondary" type="submit">Update</button>
                            </form>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </section>

    <script type="text/javascript">
        $('.date').datepicker({
            format: 'dd-mm-yyyy'
        });
    </script>
@endsection
