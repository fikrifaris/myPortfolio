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
                    <b>{{ $date->date }}</b>
                    <button class="btn" type="submit" data-bs-toggle="collapse"
                        data-bs-target="#collapse-{{ $loop->index }}" aria-expanded="false">
                        <i class="fas-sharp fa-solid fa-square-plus fa-xl" title="Add Task"></i>
                    </button>
                    <button class="btn" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse2-{{ $loop->index }}" aria-expanded="false">
                        <i class="fas-sharp fa-solid fa-pen-to-square fa-xl" title="Edit Date"></i>

                    </button>
                    <form action="{{ url('todos/' . $date->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn" type="submit"><i class="fas-sharp fa-solid fa-trash fa-xl"
                                title="Delete Date"></i></button>
                    </form>

                    @foreach ($date->todos as $todo)
                        <ul class="task-section">
                            <li>
                                @if ($todo->status == 1)
                                    <s style="color: green">{{ $todo->task }}</s>
                                @else
                                    {{ $todo->task }}
                                @endif
                                <button class="btn" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse3-{{ $loop->index }}-{{ $todo->id }}"
                                    aria-expanded="false">
                                    <i class="fas-sharp fa-solid fa-pen-to-square fa-xl" title="Edit Task"></i>
                                </button>

                                <form action="{{ url('taskDel/' . $todo->id) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn" type="submit"><i class="fas-sharp fa-solid fa-trash fa-xl"
                                            title="Delete Task"></i></button>
                                </form>

                                <form action="{{ url('marked/' . $todo->id) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn" type="submit"><i
                                            class="fas-sharp fa-solid fa-circle-check fa-xl"
                                            title="Checked Task"></i></button>
                                </form>
                            </li>

                        </ul>

                        <div class="collapse mt-2" id="collapse3-{{ $loop->index }}-{{ $todo->id }}">
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
