@php
    $links = config('sidebar');
@endphp

<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        {{-- @foreach ($links as $link)
            <li class="nav-item ">
                <a href="{{ view($link['route']) }}" class="nav-link active">
                    <i class="{{ $link['icon'] }}"></i>
                    <p>
                        {{ $link['title'] }}
                    </p>
                </a>
            </li>
            @endforeach --}}
        <li class="nav-item ">
            <a href="#" class="nav-link active">
                <i class=""></i>
                <p>
                    test
                </p>
            </a>
        </li>
    </ul>
</nav>
