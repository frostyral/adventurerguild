<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:50px" class="me-2 avatar-sm rounded-circle"
                    src="{{ $board->user->getImageURL() }}" alt="{{ $board->user->name }} Avatar">
                <div>
                    <h5 class="card-title mb-0"><a href="{{ route('users.show',$board->user->id) }}"> {{ $board->user->name }}
                        </a></h5>
                        <p class="mb-0 small text-truncate">{{ $board->user->class }}</p>
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
        <form action="{{ route('board.update',$board->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="mb-3">
                <textarea name="content" class="form-control" id="content" rows="3">{{ $board->content }}</textarea>
                @if($board->media)
                    <img src="{{ asset('storage/' . $board->media) }}" alt="Board Media" class="img-fluid mt-4">
                @endif
                @error('content')
                    <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label>Upload Media</label>
                <input name="media" class="form-control mb-2" type="file">
               </input>
            </div>
            <div>
                <button type="submit" class="btn btn-dark mb-2"> Update Board </button>
            </div>
        </form>
        @else
        <p class="fs-6 fw-light text-muted">
            {{$board->content}}
        </p>
        @if($board->media)
            <img src="{{ asset('storage/' . $board->media) }}" alt="Board Media" class="img-fluid mb-3">
        @endif
        @endif
        <div class="d-flex justify-content-between">
            @include('boards.shared.like-button')
            <div>
                <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                    {{ $board->created_at->diffForHumans() }} </span>
            </div>
        </div>
        @include('shared.comments-box')
    </div>
</div>
