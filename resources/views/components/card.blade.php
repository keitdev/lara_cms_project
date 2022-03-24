<div class="card">
    <div class="card-header">
        <h4 class="card-title float-left">{{ $header }}</h4>
        <a {{ $attributes }}><i class="fas fa-plus"></i> {{ $link }}</a>
    </div>
    <div class="card-body">
        {{ $slot }}
    </div>
</div>