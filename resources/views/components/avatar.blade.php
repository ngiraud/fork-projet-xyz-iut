@props(['src' => null, 'size' => 'medium', 'alt' => 'John'])

<div class="avatar avatar-{{ $size }}">
    @if ($src === null)
        {{ \Illuminate\Support\Str::take($alt, 1) }}
    @else
        <img src="{{ $src }}" alt="{{ $alt }}"/>
    @endif
</div>
