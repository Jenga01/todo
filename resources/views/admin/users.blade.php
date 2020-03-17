@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    @if(\Session::has('success'))
                        <div class="alert alert-success">
                            {{\Session::get('success')}}
                        </div>
                    @endif

                    <h1>User Profiles Data</h1>
                    <table class="table table-striped">
                        <tr>
                            <th>Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Create task</th>
                        </tr>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td><a href="{{route('users.edit',$user->id)}}" class="btn btn-info">Edit</a></td>
                                <td>
                                    <form action="{{ route('users.destroy' , $user->id)}}" method="POST">
                                        <input name="_method" type="hidden" value="DELETE">
                                        {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger">Detele</button>
                                    </form>
                                </td>
                                <td><a href="{{route('task.index', ['id' => $user->id])}}">Add task</a></td>
                            </tr>
                        @endforeach

                    </table>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            <h2>Create new user</h2>
                            <form method="POST" action="{{ route('users.store') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>

                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>

                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>

                                <input type="hidden" value="user" name="role">

                                <div class="form-group">
                                    <button style="cursor:pointer" type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


    @endsection
