@extends('layout.layout')
@section('content')

    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-6">
            <form class="form mt-5" action="{{ route('register') }}" method="post">
                @csrf
                <h1 class="text-center text-dark    ">Register</h1>
                <div class="form-group ">
                    <label for="text" class="text-dark">Name:</label><br>
                    <input type="text" name="name" id="name" class="form-control">
                    @error('name')
                        <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="text" class="text-dark">Class:</label><br>
                    <select name="class" id="class" class="form-control">
                        <option value="Beginner" selected disabled hidden>--</option>
                        <option value="Warrior">Warrior</option>
                        <option value="Bowman">Bowman</option>
                        <option value="Magician">Magician</option>
                        <option value="Pirate">Pirate</option>
                        <option value="Thief">Thief</option>
                    </select>
                @error('class')
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
                <div class="form-group mt-3">
                    <label for="confirm-password" class="text-dark">Confirm Password:</label><br>
                    <input type="password" name="password_confirmation" id="confirm-password" class="form-control">
                </div>
                @error('password_confirmation')
                    <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                @enderror
                <div class="form-group">
                    <label for="remember-me" class="text-dark"></label><br>
                    <input type="submit" name="submit" class="btn btn-dark btn-md" value="submit">
                </div>
                <div class="text-right mt-2">
                    <a href="/login" class="text-dark">Login here</a>
                </div>
            </form>
        </div>
    </div>
@endsection
