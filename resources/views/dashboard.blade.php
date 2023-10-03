@extends('layouts.master')
  <!-- Favicons -->
  <link href="{{asset('img/favicon.png')}}" rel="icon">
  <link href="{{asset('img/apple-touch-icon.png')}}" rel="apple-touch-icon">  

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('main/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('main/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('main/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('main/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('main/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('main/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('main/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('main/css/style.css')}}" rel="stylesheet">  


  @section('master-main')
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container-fluid position-relative" data-aos="fade-up" data-aos-delay="100">
      <div class="row justify-content-center">
        <div class="col-xl-7 col-lg-9 text-center">
          <h1>IF Sports</h1>
          <h2>Inventário de itens</h2>
        </div>
      </div>
              
      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2 id="portfolioname">Itens</h2>
          
        </div>
        
        <div class="row" data-aos="fade-up" data-aos-delay="150">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">


              @foreach ($categories as $categorie)
                <li data-filter=".filter-{{$categorie->name}}" >{{$categorie->name}}</li>
              @endforeach

              
              <a href="/categorias/nova" class="mx-3" title="Nova Categoria">
                  <i>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                    </svg>
                  </i>
              </a>
              
              <a href="/categorias" class="mx-3" title="Categorias">
                <i>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                  </svg>
                </i>
            </a>
            
            </ul>

          </div>
        </div>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="300">

          <div class="col-lg-4 col-md-6 portfolio-item filter-basquete" >
            <div class="portfolio-wrap">
              <img src="{{asset('imagens/bbasquete.jpg')}}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Item</h4>
                <p>Disponivel</p>
                <div class="portfolio-links">
                  <a href="https://lncimg.lance.com.br/cdn-cgi/image/width=1920,quality=75,format=webp/uploads/2023/04/03/642aded4857be.jpeg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Ampliar Foto"><i class="bx bx-plus"></i></a>
                  <a href="/itens/rent" title="Alugar"><i class="bx bx-link"></i></a>
                  <a href="/itens/edit" title="Editar"><i class="bx bx-edit"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-futebol">
            <div class="portfolio-wrap">
              <img src="{{asset('imagens/bfutebol.jpg')}}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Item</h4>
                <p>Disponivel</p>
                <div class="portfolio-links">
                  <a href="{{asset('main/img/portfolio/portfolio-1.jpg')}}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Ampliar Foto"><i class="bx bx-plus"></i></a>
                  <a href="/itens/rent" title="Alugar"><i class="bx bx-link"></i></a>
                  <a href="/itens/edit" title="Editar"><i class="bx bx-edit"></i></a>

                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-voleibol">
            <div class="portfolio-wrap">  
              <img src="{{asset('imagens/bvolei.png')}}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Item</h4>
                <p>Disponivel</p>
                <div class="portfolio-links">
                  <a href="{{asset('main/img/portfolio/portfolio-1.jpg')}}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Ampliar Foto"><i class="bx bx-plus"></i></a>
                  <a href="/itens/rent" title="Alugar"><i class="bx bx-link"></i></a>
                  <a href="/itens/edit" title="Editar"><i class="bx bx-edit"></i></a>

                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Section -->



















  </main><!-- End #main -->
    
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-short" style="color:white; " viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 12a.5.5 0 0 0 .5-.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 .5.5z"/>
  </svg></a>

  @endsection


  <!-- Vendor JS Files -->
  <script src="{{asset('main/vendor/purecounter/purecounter_vanilla.js')}}"></script>
  <script src="{{asset('main/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('main/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('main/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('main/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('main/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('main/js/main.js')}}"></script>
  <script src="{{asset('/main/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
