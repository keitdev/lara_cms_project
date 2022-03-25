<div class="modal fade" {{ $attributes }}>
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" autocomplete="off">
            @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ $slot }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">{{ $text }}</button>
                </div>
            </form>
        </div>
    </div>
</div>