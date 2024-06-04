<nav class="navbar navbar-expand-lg navbar-light bg-white flex-row border-bottom shadow">
    <div class="container-fluid">
        <a class="navbar-brand mx-lg-1 mr-0" href="{{ url('/') }}">
            <img src="{{asset('assets/images/logodsp.png')}}" alt="" width="110" height="50">
        </a>
        <span style="font-weight: bold; font-size: 15px;">Delta Subur Prima</span>
        <ul class="navbar-nav d-flex flex-row">
            <li class="nav-item">
                <a class="nav-link text-muted my-2" href="./#" id="modeSwitcher" data-mode="light">
                    <i class="fe fe-sun fe-16"></i>
                </a>
            </li>
            <li class="nav-item dropdown ml-lg-0">
                <a class="nav-link  text-muted" href="{{ url('login') }}">
                    <span class="avatar avatar-sm mt-2">
                        <i class="fe fe-user fe-24"></i>
                    </span>
                </a>

            </li>
        </ul>
    </div>
</nav>
