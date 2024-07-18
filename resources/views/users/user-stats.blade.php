<div class="d-flex justify-content-start">
    <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-user me-1">
        </span> {{ $user->followers()->count() }} Alliances</a>
    <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fa-solid fa-scroll me-1">
        </span> {{ $user->boards()->count() }} Boards Posted</a>
    <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-heart me-1">
        </span> {{ $user->likes()->count() }} Boards Liked</a>
    <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-comment me-1">
        </span> {{ $user->comments()->count() }} Replies</a>

</div>
