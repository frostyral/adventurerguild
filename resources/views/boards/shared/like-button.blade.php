<div>
    <form action="{{ route('boards.like',$board->id) }}" method="POST">
    @csrf
    <button href="#" class="fw-light nav-link fs-6"> <span class="fas fa-heart me-1">
        </span> {{ $board->likes()->count() }} </button>
    </form>
</div>
