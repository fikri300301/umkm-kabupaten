@props(['icon', 'link', 'name'])

@php
    $routeName = Request::route()->getName();
    $routeNames = str_word_count(str_replace('-',' ',$routeName),1);
    $names = str_word_count(strtolower($name),1);
    if (count(array_intersect($routeNames,$names)) > 0) {
        $active = true;
    }else {
        $active = false;
    }
    $classes = $active ? 'sidebar-item active' : 'sidebar-item';
@endphp


<li class="{{ $classes }} {{ $slot->isEmpty() ? '' : 'has-sub' }}">
    <a href="{{ $slot->isEmpty() ? $link : '#' }}" class='sidebar-link'>
        <i class="{{ $icon }}"></i>
        <span>{{ $name }}</span>
    </a>
    @if (!$slot->isEmpty())
        <ul class="submenu">
            {{ $slot }}
        </ul>
    @endif
</li>
