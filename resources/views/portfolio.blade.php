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
        <form action="{{ url('/addTask') }}" method="POST">
            @csrf
            <div id="myDIV" class="TDheader">
                <h2 style="margin:5px">To Do List</h2>
                <input class="date form-control" type="text" id="date" name="date" placeholder="Select Date">
                <input class="form-control" type="text" id="task" name="task" placeholder="Add Task">
                <button class="btn btn-primary" type="submit">Add</button>
            </div>
        </form>

        <ul class="list-group">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @foreach ($todos as $todo)
                <li class="list-group-item">
                    {{ $todo->task }}
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse-{{ $loop->index }}" aria-expanded="false">
                        Edit
                    </button>
                    <form action="{{ url('todos/' . $todo->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>

                    <div class="collapse mt-2" id="collapse-{{ $loop->index }}">
                        <div class="card card-body">
                            <form action="{{ url('todos/' . $todo->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input class="date" type="text" id="date" name="date"
                                    value="{{ date('d-m-Y', strtotime($todo->date)) }}">
                                <input type="text" id="task" name="task" value="{{ $todo->task }}">
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
