<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="pt-4 pb-1 border-t border-gray-200">
        <div class="px-4">
            @if(Auth::check())
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            @else
                <div class="font-medium text-base text-gray-800">Gość</div>
            @endif
        </div>
        <div class="space-y-1">
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            @endauth
        </div>
    </div>
</nav>
