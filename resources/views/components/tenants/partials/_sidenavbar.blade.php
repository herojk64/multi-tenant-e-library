<!-- Sidebar -->
        <aside class="bg-white py-2 px-2">
            <nav>
                <ul>
                    <li>
                        <a href="{{route('profile')}}" class="flex items-center gap-2 px-4 py-2 mb-2 text-gray-700 hover:bg-gray-200 rounded {{url()->current() === route('landlord.profile')?'bg-gray-200':''}}">
                            <x-heroicon-s-user-circle class="w-8 h-8"/>
                            <span class="hidden md:block">Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('dashboard')}}" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:bg-gray-200 rounded {{url()->current() === route('landlord.dashboard')?'bg-gray-200':''}}">
                            <x-heroicon-s-server-stack class="w-8 h-8"/>
                            <span class="hidden md:block">Dashboard</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>
