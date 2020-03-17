@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> <h2>Create new task</h2></div>
                    @if(\Session::has('success'))
                        <div class="alert alert-success">
                            {{\Session::get('success')}}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('task.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Task name:</label>
                            <textarea type="text" class="form-control" id="task_name" name="task_name"></textarea>
                        </div>

                            <input type="hidden" class="form-control" name="status" value="1">


                        <div class="form-group">
                            <label for="password">Due date:</label>
                            <input type="datetime-local" class="form-control" id="password" name="due_date">
                        </div>

                        <input type="hidden" value="{{request()->id}}" name="user_id">


                        <div class="form-group">
                            <button style="cursor:pointer" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>


    @endsection
