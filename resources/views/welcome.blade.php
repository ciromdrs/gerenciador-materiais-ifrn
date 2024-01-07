<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Página inicial-DEFF</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('login/vendor/bootstrap/css/bootstrap.min.css') }}"rel="stylesheet">
    <link href="{{ asset('login/css/style.css') }}" rel="stylesheet">

</head>   

<body>

    <!-- ======= Hero Section ======= -->
    <div class="div-hero">
        <section id="hero" class="d-flex align-items-center">
            <div class="container d-flex flex-column align-items-center" data-aos="zoom-in" data-aos-delay="100">
                <h1 style="color:white;">Bem vindo(a) ao SEF!</h1>
                <h2 style="color:white"><b>Clique no botão abaixo para fazer login</b></h2>
                <a href="{{ config('suap.uri_login') }}" class="btn-about"><b>Login</b></a>
                    
            </div>
        </section><!-- End Hero -->
    </div>

    <script src="{{ asset('login/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('login/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('login/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('login/js/main.js') }}"></script>


</body>

</html>
