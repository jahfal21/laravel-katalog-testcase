<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 mt-5 ms-4 mb-5">
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page"
                    href="{{ route('home') }}">
                    <i class="fas fa-book"></i>
                    <span class="ms-2">List Test Case</span>
                </a>
            </li>
            @if (Auth::user()->role_id == 1)
                <li class="nav-item mb-2">
                    <a class="nav-link {{ request()->is('home/showUser') ? 'active' : '' }}"
                        href="{{ route('home.showUser') }}">
                        <i class="fas fa-users"></i>
                        <span class="ms-2">Manage User</span>
                    </a>
                </li>  
            @else
                <li class="nav-item mb-2">
                    <a class="nav-link {{ request()->is('home/profile/' . Auth::user()->id) ? 'active' : '' }}"
                        href="{{ route('home.profile', Auth::user()->id) }}">
                        <i class="fas fa-user-circle"></i>
                        <span class="ms-2">Profile</span>
                    </a>
                </li>
            @endif          
        </ul>
    </div>
</nav>
