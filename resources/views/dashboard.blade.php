@extends('layout.layout')
@section('content')
    <div class="container py-4">
        <div class="row">
            @include('layout.leftnavigation')
            <div class="col-6">
                @include('shared.success-message')
                @include('boards.shared.submit-board')
                <hr>
                @forelse ($boards as $board)
                <div class="mt-3">
                    @include('boards.shared.board-card')
                </div>
                @empty
                <p class="text-center mt-4">Be the first to post a board!</p>
                @endforelse
                <div class="mt-3">
                    {{ $boards->links() }}
                </div>
            </div>
            @include('layout.rightnavigation')
        </div>
    </div>
@endsection
