<h4> Share yours ideas </h4>
<div class="row">
    <form action="{{ route('board.create') }}" method="post">
        @csrf
        <div class="mb-3">
            <textarea name="board" class="form-control" id="board" rows="3"></textarea>
            @error('board')
                <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <button type="submit" class="btn btn-dark"> Share </button>
        </div>
    </form>
</div>
