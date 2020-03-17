@extends('layouts.app')

@section('content')
    <div class="row">
    <div class="col-sm-8 offset-sm-2">
        <form action="{{route('users.update', $user->id)}}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <div class="form-group">
                <label for="firstname">Name:</label>
                <input type="text" name = "name" class="form-control" required value = "{{$user->name}}">
            </div>
            <div class="form-group">
                <label for="lastname">E-mail:</label>
                <input type="text" name = "email" class="form-control" required value = "{{$user->email}}">
            </div>
            <button type = "submit" class = "btn btn-success">Submit</button>
        </form>
    </div>


    @endsection
