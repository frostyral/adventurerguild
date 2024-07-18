<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:50px" class="me-2 avatar-sm rounded-circle"
                    src="https://i1.sndcdn.com/artworks-8EE51mfTnCD6YUJs-3MrRZg-t500x500.jpg" alt="{{ $board->user->name }} Avatar">
                <div>
                    <h5 class="card-title mb-0"><a href="#"> {{ $board->user->name }}
                        </a></h5>
                </div>
            </div>
            <div>
                <form method="POST" action="{{ route('board.destroy',$board->id) }}">
                    @csrf
                    @method('delete')
                    <a class="" href="{{ route('board.show',$board->id) }}">View Post</a>
                    @if(auth()->id() == $board->user_id)
                    <a class="mx-2" href="{{ route('board.edit',$board->id) }}">Edit</a>
                    <button class="btn btn-danger btn-sm">X</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if($editing ?? false)
        <form action="{{ route('board.update',$board->id) }}" method="post">
            @csrf
            @method('put')
            <div class="mb-3">
                <textarea name="board" class="form-control" id="board" rows="3">{{ $board->content }}</textarea>
                @error('success')
                    <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="">
                <button type="submit" class="btn btn-dark mb-2"> Update Board </button>
            </div>
        </form>
        @else
        <p class="fs-6 fw-light text-muted">
            {{$board->content}}
        </p>
        @endif
        <div class="d-flex justify-content-between">
            <div>
                <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-heart me-1">
                    </span> {{ $board->likes }} </a>
            </div>
            <div>
                <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                    {{ $board->created_at }} </span>
            </div>
        </div>
            @include('shared.comments-box')
    </div>
</div>
