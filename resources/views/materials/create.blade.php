@extends('layouts.master')
<!-- Font Icon -->
<link rel="stylesheet" href="">

<!-- Main css -->
<link rel="stylesheet" href="{{ asset('cadastro_itens/css/style.css') }}">

<!-- Favicons -->
<link href="{{ asset('img/favicon.png') }}" rel="icon">
<link href="{{ asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">


<!-- Google Fonts -->
<link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="{{ asset('main/vendor/aos/aos.css') }}" rel="stylesheet">
<link href="{{ asset('main/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('main/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset('main/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
<link href="{{ asset('main/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
<link href="{{ asset('main/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
<link href="{{ asset('main/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

<!-- Template Main CSS File -->
<link href="{{ asset('main/css/style.css') }}" rel="stylesheet">

@section('master-main')
    <div class="signup-content">
        <div class="signup-form">
            <h2 class="form-title">Cadastro de Material</h2>

            <form method="POST" class="register-form " action="{{ url('materiais') }}">
                @csrf
                <div class="form-group">
                    <input type="text" required name="nome" id="name" value="{{ @old('nome') }}"
                        placeholder="Nome do material" value="" />
                </div>

                <div class="form-group">
                    <select class="custom-select" name="categoria_id" required id="CustomSelect">
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                        @endforeach
                    </select>
                </div>

                @error('name')
                    <span class="badge bg-warning">{{ $message }}</span>
                @enderror

                <div class="form-group form-button">
                    <button class="form-submit border border-none">Salvar</button>
                </div>

            </form>

            <button type="button" class="form-submit border border-none" data-bs-toggle="modal"
                data-bs-target="#exampleModal">
                Nova Categoria
            </button>
        </div>

    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="m-5">
                    <h2 class="form-title">Nova Categoria</h2>

                    <form method="POST" class="register-form " action="/categorias">
                        @csrf
                        <div class="form-group">
                            <input type="text" required name="nome" id="name" placeholder="Nome Da Categoria"
                                value="{{ @old('nome') }}" />
                        </div>
                        @error('nome')
                            <span class="badge bg-warning">{{ $message }}</span>
                        @enderror

                        <div class="form-group form-button">
                            <button class="form-submit border border-none">Salvar</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
<!-- JS -->
<script src="{{ asset('cadastro_itens/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('cadastro_itens/js/main.js') }}"></script>
