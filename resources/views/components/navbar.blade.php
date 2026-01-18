<nav class="navbar navbar-custom fixed top-0 w-full z-50">
    <div class="container mx-auto px-4">
        <div class="flex-1">
            <a href="{{ route('home') }}" class="text-3xl font-bold display-font">
                <span class="bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent">SOUND</span>
                <span class="text-white">GROUP</span>
            </a>
        </div>
        <div class="flex-none flex items-center">
            <ul class="menu menu-horizontal px-1 hidden lg:flex gap-2 items-center">
                <li><a href="{{ route('home') }}" class="hover:text-purple-400 transition-colors">Home</a></li>
                <li><a href="{{ route('music') }}" class="hover:text-purple-400 transition-colors">Music</a></li>
                <li><a href="{{ route('videos') }}" class="hover:text-purple-400 transition-colors">Videos</a></li>
                <li><a href="{{ route('about') }}" class="hover:text-purple-400 transition-colors">About</a></li>
            </ul>
            
            <div class="flex gap-2 ml-4 items-center">
                @auth
                    <!-- Logged In User -->
                    <span class="text-sm text-gray-300 hidden md:inline">Hello, {{ Auth::user()->name }}</span>
                    
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-ghost btn-sm">Dashboard</a>
                    @else
                        <a href="{{ route('user.dashboard') }}" class="btn btn-ghost btn-sm">Dashboard</a>
                    @endif
                    
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="btn btn-gradient btn-sm text-white">Logout</button>
                    </form>
                @else
                    <!-- Guest User -->
                    <a href="{{ route('login') }}" class="btn btn-ghost btn-sm">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-gradient btn-sm text-white">Sign Up</a>
                @endauth
            </div>
            
            <div class="dropdown dropdown-end lg:hidden ml-2">
                <label tabindex="0" class="btn btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </label>
                <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 p-2 shadow bg-base-200 rounded-box w-52">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('music') }}">Music</a></li>
                    <li><a href="{{ route('videos') }}">Videos</a></li>
                    <li><a href="{{ route('about') }}">About</a></li>
                    @auth
                        <li class="border-t border-gray-700 mt-2 pt-2">
                            @if(Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            @else
                                <a href="{{ route('user.dashboard') }}">Dashboard</a>
                            @endif
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="border-t border-gray-700 mt-2 pt-2"><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Sign Up</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</nav>