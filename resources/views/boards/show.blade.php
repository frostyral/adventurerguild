@extends('layout.layout')
@section('content')
<div class="container py-4">
    <div class="row">
        @include('layout.leftnavigation')
        <div class="col-6">
            <div class="mt-3">
                @include('boards.shared.board-card')
            </div>
        </div>
        @include('layout.rightnavigation')
    </div>
</div>
@endsection
