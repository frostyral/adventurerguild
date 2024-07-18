<div>
    <form action="{{ route('board.comments.create',$board->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <textarea name="content" class="fs-6 form-control" rows="1"></textarea>
        </div>
        <div>
            <button type="submit" class="btn btn-primary btn-sm"> Post Comment </button>
        </div>
    </form>
    <hr>
    @forelse ($board->comments as $comment)
    <div class="d-flex align-items-start">
        <img style="width:35px" class="me-2 avatar-sm rounded-circle"
            src="{{ $comment->user->getImageURL() }}"
            alt=" {{ $comment->user->name }}Avatar">
        <div class="w-100">
            <div class="d-flex justify-content-between mt-2">
                <h6 class=""> {{ $comment->user->name }}
                </h6>
                <small class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span> {{ $comment->created_at->diffForHumans() }}</small>
            </div>
            <p class="fs-6 mt-3 fw-light">
                {{ $comment->content }}
            </p>
        </div>
    </div>
    @empty
        <p class="text-center mt-4">Be the first to comment on this board!</p>
    @endforelse
</div>
