@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
    <div class="card">
        <div class="px-3 pt-4 pb-2">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img style="width:150px" class="me-3 avatar-sm rounded-circle"
                        src="{{ $user->getImageURL() }}" alt="Mario Avatar">
                    <div>
                        <h3 class="card-title mb-0"><a href="#"> {{ $user->name }}
                            </a></h3>
                        <span class="fs-6 text-muted">{{ $user->class }}</span>
                    </div>
                </div>
                <div>
                    @auth()
                        @if(Auth::id() === $user->id)
                        <a href="{{ route('users.edit',$user->id) }}">Edit</a>
                        @endif
                    @endauth
                </div>
            </div>
            <div class="px-2 mt-4">
                <h5 class="fs-5"> About Adventurer : </h5>
                <p class="fs-6 fw-light">
                    {{ $user->about }}
                </p>
                @include('users.user-stats')
                @auth()
                    @if(Auth::id() !== $user->id)
                        <div class="mt-3">
                            @if(Auth::user()->follows($user))
                            <form method="POST" action="{{ route('users.unfollow',$user->id) }}">
                                @csrf
                            <button type="submit" class="btn btn-danger btn-sm"> Unfollow </button>
                            @else
                            <form method="POST" action="{{ route('users.follow',$user->id) }}">
                                @csrf
                            <button type="submit" class="btn btn-primary btn-sm"> Follow </button>
                        </form>
                    @endif
                    </div>
                    @endif
                @endauth
            </div>
        </div>
