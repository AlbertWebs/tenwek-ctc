@php
    $menu = config('admin.menu', []);
@endphp
<nav class="mt-4 px-3 space-y-0.5 overflow-y-auto max-h-[calc(100vh-8rem)]">
    @foreach($menu as $item)
        @php
            $permission = $item['permission'] ?? null;
            $show = !$permission || (auth()->user()->hasPermission($permission));
            $routeBase = \Illuminate\Support\Str::beforeLast($item['route'], '.');
$active = request()->routeIs($item['route']) || request()->routeIs($routeBase . '.*');
        @endphp
        @if($show)
            <a href="{{ route($item['route']) }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-white/90 hover:bg-white/10 hover:text-white transition-colors {{ $active ? 'bg-white/15 text-white font-medium' : '' }}">
                @include('admin-dashboard.components.icon', ['name' => $item['icon']])
                <span class="truncate">{{ $item['label'] }}</span>
            </a>
        @endif
    @endforeach
</nav>
<div class="absolute bottom-0 left-0 right-0 p-3 border-t border-white/10 bg-admin-teal">
    <a href="{{ url('/') }}" target="_blank" rel="noopener" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-white/80 hover:bg-white/10 hover:text-white text-sm transition-colors">
        @include('admin-dashboard.components.icon', ['name' => 'external-link'])
        View site
    </a>
</div>
