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
                                    </tr>

                                        @foreach($tasks as $task)
                                            <tr>
                                                <td>{{ $task->task_name }}</td>
                                                <td>{{ $task->due_date }}</td>
                                                <td>
                                                    <form action="{{ route('task.update' , $task->id)}}" method="POST" >
                                                        {{ csrf_field() }}
                                                        {{ method_field('PATCH') }}
                                                        <select name="status" class="status" >
                                                            <option value selected>@if($task->status == 1)
                                                                  New
                                                                @elseif($task->status == 2)
                                                                   In progress
                                                                @elseif($task->status == 3)
                                                                    Done
                                                                @endif</option>
                                                            @if($task->status == 1)
                                                                <option value="2">In progress</option>
                                                            @elseif($task->status == 2)
                                                                <option value="3">Done</option>
                                                            @else
                                                                <option value="2">In progress</option>
                                                            @endif
                                                        </select>
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
