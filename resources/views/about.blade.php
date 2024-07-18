@extends('layout.layout')
@section('content')
    <div class="row">
        @include('layout.leftnavigation')
        <div class="col-6">
            <div class="mt-3">
                <h1>About Adventurer's Guild</h1>
            </div>
            <hr>
        <img src="https://adventuresincardboard.com/wp-content/uploads/65490594_698772483909743_3928218191758622720_n.jpg" alt="Board Media" class="img-fluid mb-3">
        <h4>Adventurer's Guild is a social media platform designed exclusively for adventurers of various classes, including warriors, mages, pirates, wizards, and thieves. Our platform fosters a professional environment where adventurers can connect, share experiences, and forge alliances. Whether you seek camaraderie, strategic partnerships, or knowledge exchange, Adventurer's Guild offers a unique space for every adventurer to thrive and collaborate. Join us in building a network of exceptional individuals dedicated to mutual growth and success in their quests.</h4>
        </div>
        @include('layout.rightnavigation')
    </div>
@endsection
