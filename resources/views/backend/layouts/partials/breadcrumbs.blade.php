@if ($breadcrumbs)
    <!-- Content Header (Page header) -->
    @foreach ($breadcrumbs as $breadcrumb)
        @if ($breadcrumb->url && !$loop->last)
            <li class="breadcrumb-item active"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
        @else
            <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
        @endif
    @endforeach
@endif
