 @extends('layouts.master')
<!-- Font Icon -->
    <link rel="stylesheet" href="">

    <!-- Main css -->
    <link rel="stylesheet" href="{{asset('cadastro_itens/css/style.css')}}">

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

 <div class="container">
    <div class="signup-content">
        <div class="signup-form">
            <h2 class="form-title">Cadastro de item</h2>
            <form method="GET" class="register-form " id="register-form" action="/inproduction">
                @csrf
                <div class="form-group">
                    <input type="text" required name="name" id="name" placeholder="Nome Do Item" value=""/>
                </div>

                <div class="form-group">
                    <select class="custom-select " required id="CustomSelect">
                        <option selected>Categoria</option>
                        <option value="1" >Futebol</option>
                        <option value="2">Voleibol</option>
                        <option value="3">Basquete</option>
                    </select>
                </div>
                
                <div class="form-group">

                <select class="custom-select "  required id="CustomSelect">   
                    <option selected>Local de armazenamento</option>
                    <option value="1" >Depósito 1</option>
                    <option value="2" >Depósito 2</option>
                    <option value="3" >Depósito 3</option>
                    </select>
                </div>                            

                <div class="form-group">
                    <input type="date" required name="" id="name"/>
                    <div id="fileHelpId" class="form-text">Data de Entrada</div>
                </div>

                <div class="mb-3">
                    <input type="file" class="form-control" name="" id="" placeholder="" aria-describedby="fileHelpId">
                    <div id="fileHelpId" class="form-text">Escolher Foto</div>
                </div>

                <div class="form-group form-button">
                    <button class="form-submit border border-none">Salvar</button>
                </div>
            </form>
        </div>

        <div class="signup-image">
            {{-- <figure><img src="{{asset('cadastro_itens/images/signup-image.jpg')}}"alt="sing up image"></figure> --}}
        </div>
        
    </div>
</div>


@endsection
<!-- JS -->
<script src="{{asset('cadastro_itens/jquery/jquery.min.js')}}"></script>
<script src="{{asset('cadastro_itens/js/main.js')}}"></script>