@extends('layout.layout')
@section('content')
<div class="row">
    @include('layout.leftnavigation')
    <div class="col-6">
        <div class="mt-3">
            @include('shared.user-card')
        </div>
        <hr>
            @foreach ($boards as $board)
            <div class="mt-3">
                @include('boards.shared.board-card')
            </div>
            @endforeach
            <div class="mt-3">
                {{ $boards->links() }}
        </div>
    </div>
</div>
@include('layout.rightnavigation')
@endsection
