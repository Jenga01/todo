@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @if($tasks->count()>0)
                    <div class="card-header">My tasks</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            <div class="container">

                                <table class="table table-bordered">
                                    <tr>

                                        <th>Task name</th>
                                        <th>@sortablelink('due_date')</th>
                                        <th>@sortablelink('status')</th>
                                        <th>Change status</th>
                                    </tr>

                                        @foreach($tasks as $task)
                                            <tr>
                                                <td>{{ $task->task_name }}</td>
                                                <td>{{ $task->due_date }}</td>
                                                <td>@if($task->status == 1)
                                                        <label for="new" id="new">New</label>
                                                    @elseif($task->status == 2)
                                                        <label for="inprog" id="ip">In progress</label>
                                                    @else
                                                        <label for="done" id="done">Done</label>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{ route('task.update' , $task->id)}}" method="POST">
                                                        {{ csrf_field() }}
                                                        {{ method_field('PATCH') }}
                                                        <select id="status" name="status">
                                                            @if($task->status == 1)
                                                                <option value="2">In progress</option>
                                                            @elseif($task->status == 2)
                                                                <option value="3">Done</option>
                                                            @else
                                                                <option value="2">In progress</option>
                                                            @endif
                                                        </select>
                                                        <input type="submit" value="Submit" class="btn btn-primary">
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        User has no tasks
                                    @endif
                                </table>

                                {{ $tasks->links() }}
                            </div>


                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection
