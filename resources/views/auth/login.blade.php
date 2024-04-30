<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Lapalapa Apps &mdash; Admin Login</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('template') }}/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('template') }}/node_modules/@fortawesome/fontawesome-free/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('template') }}/node_modules/bootstrap-social/bootstrap-social.css">
    <link rel="stylesheet" href="{{ asset('template') }}/node_modules/izitoast/dist/css/iziToast.min.css">


    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('template') }}/assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('template') }}/assets/css/components.css">
    <link rel="stylesheet" href="{{ asset('template') }}/assets/css/lalapa-apps.css">

</head>

<body id="login">
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="mt-5">
                    <div class="card mt-4">
                        <div class="row">
                            <div class="col-6 d-none d-sm-block">
                                <div class="p-5 mt-3">
                                    <img src="{{ asset('template') }}/assets/img/landing-page.svg"
                                        class="image-login" alt="logo" width="100%">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-none d-sm-block">
                                    <div class="card-header mt-4" id="card-header">
                                        <h1>Lapa Lapa Apps</h1>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <form class="needs-validation" novalidate="" action="{{ route('login') }}"
                                        method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input id="email" type="email" class="form-control" name="email"
                                                tabindex="1" placeholder="Masukan Email Anda" required autofocus>
                                            <div class="invalid-feedback">
                                                Masukan E-mail Anda Dengan Benar
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="d-block">
                                                <label for="password" class="control-label">Password</label>
                                            </div>
                                            <input id="password" type="password" class="form-control" name="password"
                                                tabindex="2" autocomplete="password" placeholder="Masukan Password Anda"
                                                required>
                                            <div class="invalid-feedback">
                                                Masukan Password Anda Dengan Benar
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="remember" class="custom-control-input"
                                                    tabindex="3" id="remember-me">
                                                <label class="custom-control-label" for="remember-me">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                                Login
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="simple-footer text-white">
                        Copyright &copy; Lapa Lapa Apps 2022
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('template') }}/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('template') }}/node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="{{ asset('template') }}/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('template') }}/node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
    <script src="{{ asset('template') }}/node_modules/moment/min/moment.min.js"></script>
    <script src="{{ asset('template') }}/assets/js/stisla.js"></script>


    <!-- JS Libraies -->
    <script src="{{ asset('template') }}/node_modules/izitoast/dist/js/iziToast.min.js"></script>


    <!-- Template JS File -->
    <script src="{{ asset('template') }}/assets/js/scripts.js"></script>
    <script src="{{ asset('template') }}/assets/js/custom.js"></script>

    <!-- Page Specific JS File -->

    <script>
        @error('email')
            iziToast.error({
                title: 'Login dengan akun yang benar !',
                message: "{{ $message }}",
                position: 'topRight',

            });
        @enderror
    </script>

</body>

</html>
