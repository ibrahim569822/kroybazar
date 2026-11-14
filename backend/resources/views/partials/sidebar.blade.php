<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>

                @if (auth()->user()->role == 1)
                    <li class="{{ request()->is('admin') ? 'active' : '' }}">
                        <a href="/admin"><img src="{{ asset('assets/img/icons/dashboard.svg') }}" alt="img"><span> Dashboard</span></a>
                    </li>
                    <li class="{{ request()->is('admin/accounts*') ? 'active' : '' }}">
                        <a href="/admin/accounts/pending"><img src="{{ asset('assets/img/icons/users1.svg') }}" alt="img"><span> Pending Accounts</span></a>
                    </li>
                    <li class="{{ request()->is('admin/categories*') ? 'active' : '' }}">
                        <a href="/admin/categories"><i data-feather="grid"></i><span> Categories</span></a>
                    </li>
                @endif

                @if (auth()->user()->role == 2)
                    <li class="{{ request()->is('vendor') ? 'active' : '' }}">
                        <a href="/vendor"><img src="{{ asset('assets/img/icons/dashboard.svg') }}" alt="img"><span> Dashboard</span></a>
                    </li>
                @endif

                @if (auth()->user()->role == 3)
                    <li class="{{ request()->is('shop') ? 'active' : '' }}">
                        <a href="/shop"><img src="{{ asset('assets/img/icons/dashboard.svg') }}" alt="img"><span> Dashboard</span></a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</div>