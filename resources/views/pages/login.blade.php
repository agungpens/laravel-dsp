@include('template.head')

<body class="light ">
    <div class="wrapper vh-100">

      {{-- alert success & error --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session('error') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row align-items-center h-100">
            <form action="{{ url('signin') }}" method="POST" class="col-lg-3 col-md-4 col-10 mx-auto text-center">
                @csrf
                <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
                    <img src="{{asset('assets/images/logodsp.png')}}" alt="" width="100" height="50">
                </a>
                <h1 class="h6 mb-3">Selamat Datang!</h1>
                <div class="form-group">
                    <label for="inputUser" class="sr-only">Email address</label>
                    <input type="username" name="username" id="inputUser" class="form-control form-control-lg"
                        placeholder="Username" required="" autofocus="">
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" name="password" id="inputPassword" class="form-control form-control-lg"
                        placeholder="Password" required="">
                </div>

                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign In</button>
                {{-- <a href="{{ url('dashboard') }}" class="btn btn-lg btn-primary btn-block">Sign In</a> --}}
                <p class="mt-5 mb-3 ">Maaf, Login Hanya Untuk Karyawan.</p>
            </form>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/simplebar.min.js"></script>
    <script src='js/daterangepicker.js'></script>
    <script src='js/jquery.stickOnScroll.js'></script>
    <script src="js/tinycolor-min.js"></script>
    <script src="js/config.js"></script>
    <script src="js/apps.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-56159088-1');
    </script>
</body>

</html>
</body>

</html>
