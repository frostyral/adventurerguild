@extends('layout.layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-sm-8 col-md-6">
        <form class="form mt-5" action="{{ route('login') }}" method="post">
            @csrf
            <h3 class="text-center text-dark">Login</h3>
            <div class="form-group ">
                <label for="text" class="text-dark">Name:</label><br>
                <input type="text" name="name" id="name" class="form-control">
                @error('name')
                    <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="password" class="text-dark">Password:</label><br>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            @error('password')
                <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
            @enderror
            <div class="form-group">
                <label for="remember-me" class="text-dark"></label><br>
                <input type="submit" name="submit" class="btn btn-dark btn-md" value="submit">
            </div>
            <div class="text-right mt-2">
                <a href="/register" class="text-dark">Register here</a>
            </div>
        </form>
    </div>
</div>
@endsection
