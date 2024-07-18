@auth()
<h4> Share your ideas </h4>
<div class="row">
    <form action="{{ route('board.create') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <textarea name="content" class="form-control" id="content" rows="3"></textarea>
            @error('content')
                <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label>Upload Media</label>
            <input name="media" class="form-control mb-2" type="file">
            @error('media')
                <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
            @enderror
            <button type="submit" class="btn btn-dark"> Share </button>
        </div>
    </form>
</div>
@endauth
@guest()
    <h4>Login to interact with the Guild</h4>
@endguest
