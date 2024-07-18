<div>
    @auth()
        @if(Auth::user()->likesBoard($board))
            <form action="{{ route('boards.unlike', $board->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="fw-light nav-link fs-6">
                    <span class="fas fa-heart me-1"></span> {{ $board->likes()->count() }}
                </button>
            </form>
        @else
            <form action="{{ route('boards.like', $board->id) }}" method="POST">
                @csrf
                <button type="submit" class="fw-light nav-link fs-6">
                    <span class="far fa-heart me-1"></span> {{ $board->likes()->count() }}
                </button>
            </form>
        @endif
    @endauth
    @guest
    <a href="{{ route('login') }}" class="fw-light nav-link fs-6">
        <span class="far fa-heart me-1"></span> {{ $board->likes()->count() }}
    </a>
    @endguest
</div>
