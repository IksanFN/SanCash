<div>
    @if ($message = Session::get('error'))
        <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @elseif($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    </div>