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
                <span class="input-group-button">
                    <button class="btn btn-primary" type="submit">Add</button>
                </span>
            </div>
        </form>

        <table class="table table-condensed" style="border-collapse:collapse;" id="accordion">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                @foreach ($dates as $date)
                    <tr data-bs-toggle="collapse" class="collapsed bg-info accordion-item"
                        data-bs-target="#collapse4-{{ $date->id }}" aria-expanded="false"
                        aria-controls="collapse4-{{ $date->id }}">

                        <td><span class="badge text-bg-light">{{ $date->date }}</span></td>

                        <td>
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
                        </td>
                    </tr>
                    <tr>
                        <td colspan="12">
                            <div class="accordion-collapse collapse" id="collapse4-{{ $date->id }}"
                                aria-labelledby="headingOne" data-bs-parent="#accordion">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Task</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($date->todos as $todo)
                                            <tr>

                                                @if ($todo->status == 1)
                                                    <td>
                                                        {{ $todo->task }}
                                                    </td>

                                                    <td> <span class="badge bg-success">Done</span></td>
                                                @else
                                                    <td>
                                                        {{ $todo->task }}
                                                    </td>

                                                    <td><span class="badge bg-secondary">Pending</span></td>
                                                @endif


                                                <td>
                                                    <button class="btn" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapse3-{{ $loop->index }}-{{ $todo->id }}"
                                                        aria-expanded="false">
                                                        <i class="fas-sharp fa-solid fa-pen-to-square fa-xl"
                                                            title="Edit Task"></i>
                                                    </button>

                                                    <form action="{{ url('taskDel/' . $todo->id) }}" method="POST"
                                                        style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn" type="submit"><i
                                                                class="fas-sharp fa-solid fa-trash fa-xl"
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

                                                    <div class="collapse mt-2"
                                                        id="collapse3-{{ $loop->index }}-{{ $todo->id }}">
                                                        <div class="card card-body">
                                                            <form action="{{ url('editTask/' . $todo->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="text" class="form-control" name="task"
                                                                    id="task" value="{{ $todo->task }}">
                                                                <button class="btn btn-secondary"
                                                                    type="submit">Update</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <script type="text/javascript">
        $('.date').datepicker({
            format: 'dd-mm-yyyy'
        });
    </script>
@endsection
