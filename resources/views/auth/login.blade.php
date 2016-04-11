@extends('auth.layout')

@section('content')

<div class="container margin-top-40 padding-top-40">
    <div class="margin-top-40 col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 login-form padding-bottom-10">
        <h3 class="text-center">Login</h3>
        <hr>
        <form class="form-horizontal" method="post" action="{{route('login')}}">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="username" class="col-sm-3 control-label">Username : </label>
                <div class="col-sm-9">
                    <input type="username"  data-provide="typeahead"  autocomplete="off" value="{{old('username')}}" class="typeahead form-control" id="username" name="username" placeholder="User Name">
                    @if (session('login_message'))
                    <div class="text-danger padding-5">{{ session('login_message') }}</div>
                    @else
                    <div class="text-danger padding-5">{{$errors->first('username')}}</div>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-3 control-label">Password : </label>
                <div class="col-sm-9">
                    <input type="password" class="form-control " id="password" name="password" placeholder="Password">
                    <div class="text-danger padding-5">{{$errors->first('password')}}</div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-default btn-block">Sign in</button>
                </div>
            </div>
        </form>
    </div>
</div>



@stop