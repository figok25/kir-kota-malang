
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport" shrink-to-fit=no">
        <title>Ganti Password | BALAI UJI KIR MALANG KOTA</title>
        <meta content="" name="description">
        <meta content="" name="keywords">
    
        <!-- Favicons -->
        <link href="{{URL::to('/')}}/assets/img/favicon.png" rel="icon">
        <link href="{{URL::to('/')}}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">
      
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com" rel="preconnect">
        <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
      
        <!-- Vendor CSS Files -->
        <link href="{{URL::to('/')}}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{URL::to('/')}}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="{{URL::to('/')}}/assets/vendor/aos/aos.css" rel="stylesheet">
        <link href="{{URL::to('/')}}/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
        <link href="{{URL::to('/')}}/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    
        {{-- login css --}}
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('assets/fonts/icomoon/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/login/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/login/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/login/style.css') }}">
        
        {{-- CDN --}}
        {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> --}}

        <!-- Main CSS File -->
        <link href="{{URL::to('/')}}/assets/css/main.css" rel="stylesheet">
        <link href="{{URL::to('/')}}/assets/css/profil/so.css" rel="stylesheet">
        <link href="{{URL::to('/')}}/assets/css/profil/vm.css" rel="stylesheet">
    
        {{-- KAIADMIN CSS --}}
        <link rel="stylesheet" href="{{URL::to('/')}}/assets/css/home/plugins.min.css" />
        <link rel="stylesheet" href="{{URL::to('/')}}/assets/css/home/kaiadmin.min.css" />
        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link rel="stylesheet" href="{{URL::to('/')}}/assets/css/home/demo.css" />
    
    </head>
<body>
    @include('sweetalert::alert')
    <div class="d-lg-flex half">
        <div class="bg order-1 order-md-2" style="background-image: url('{{ asset("assets/img/login/login.jpg") }}');"></div>
        <div class="contents order-2 order-md-1">
    
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-7">
                    <h3>Ganti Password Baru</h3>
                        <strong>BALAI UJI KIR MALANG KOTA</strong>
                            <form action="{{ route('auth.reset_pw.post') }}" method="POST" class="user">
                                @csrf
                                <div class="form-group first">
                                    <label align="left" for="email">Email</label>
                                    <input type="email" class="form-control" placeholder="Masukan Email" id="email" name="email">
                                </div>
                                <div class="form-group last mb-3">
                                    <label align="left" for="password">Password Baru</label>
                                    <input type="password" class="form-control" placeholder="Masukan Password" id="password" name="password">
                                </div>
                                <div class="form-group last mb-3">
                                    <label align="left" for="password">Konfirmasi Password Baru</label>
                                    <input type="password" class="form-control" placeholder="Masukan Password" id="password" name="password_confirmation">
                                </div>
                                <div class="form-group last mb-3">
                                    <input type="hidden" name="token" value="{{$target->token}}">
                                </div>
                                <input type="submit" value="Reset" class="btn btn-block btn-primary" style="background-color: #2a0f60 !important; border:none !important;">
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
        {{-- login script --}}
        <script src="assets/js/login/jquery-3.3.1.min.js"></script>
        <script src="assets/js/login/popper.min.js"></script>
        <script src="assets/js/login/bootstrap.min.js"></script>
        <script src="assets/js/login/main.js"></script>
</body>
</html>

 