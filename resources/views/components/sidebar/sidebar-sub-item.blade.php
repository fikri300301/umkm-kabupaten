@props(['link', 'name'])

@php
    $routeName = Request::route()->getName();
    $routeNames = str_word_count(str_replace('-',' ',$routeName),1);
    $names = str_word_count(strtolower($name),1);

    if (count(array_intersect($routeNames,$names)) > 0) {
        $active = true;
    }else {
        $active = false;
    }
    $classes = $active ? 'submenu-item active' : 'submenu-item';
@endphp

<li class="{{ $classes }}">
    <a href="{{ $link }}" class="submenu-link">
        {{ $name }}
    </a>
</li>
