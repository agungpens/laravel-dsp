<nav class="topnav navbar navbar-light bg-primary">
    <button type="button" class="navbar-toggler text-dark mt-2 p-0 mr-3 collapseSidebar">
        <i class="fe fe-menu navbar-toggler-icon"></i>
    </button>
    <span style="font-weight: bold; font-size: 15px;" class="">Delta Subur Prima</span>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link  my-2" href="#" id="modeSwitcher" data-mode="light">
                <i class="fe fe-sun fe-16"></i>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle  pr-0" href="#" id="navbarDropdownMenuLink"
                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="avatar avatar-sm mt-2">
                    <i class="fe fe-user fe-24"></i>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="{{ url('setting') }}">Settings</a>
                <a class="dropdown-item" href="{{ url('/logout') }}">Logout</a>
            </div>
        </li>
    </ul>
</nav>
