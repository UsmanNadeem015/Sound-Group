        <nav class="navbar navbar-custom fixed top-0 w-full z-50">
            <div class="container mx-auto px-4">
                <div class="flex-1">
                    <a href="{{ url('/') }}" class="text-3xl font-bold display-font">
                        <span class="bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent">SOUND</span>
                        <span class="text-white">GROUP</span>
                    </a>
                </div>
                <div class="flex-none flex items-center">
                    <ul class="menu menu-horizontal px-1 hidden lg:flex gap-2 items-center">
                        <li><a href="{{ url('/') }}" class="hover:text-purple-400 transition-colors">Home</a></li>
                        <li><a href="{{ url('/Music') }}" class="hover:text-purple-400 transition-colors">Music</a></li>
                        <li><a href="{{ url('/Videos') }}" class="hover:text-purple-400 transition-colors">Videos</a></li>
                        <li><a href="{{ url('/About') }}" class="hover:text-purple-400 transition-colors">About</a></li>
                    </ul>
                    <div class="flex gap-2 ml-4 items-center">
                        <a href="{{ url('/Login') }}" class="btn btn-ghost btn-sm">Login</a>
                        <a href="{{ url('/Register') }}" class="btn btn-gradient btn-sm text-white">Sign Up</a>
                    </div>
                    <div class="dropdown dropdown-end lg:hidden ml-2">
                        <label tabindex="0" class="btn btn-ghost">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </label>
                        <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 p-2 shadow bg-base-200 rounded-box w-52">
                            <li><a>Home</a></li>
                            <li><a>Music</a></li>
                            <li><a>Videos</a></li>
                            <li><a>About</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>