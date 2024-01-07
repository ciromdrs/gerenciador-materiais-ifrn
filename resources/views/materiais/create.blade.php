@extends('layouts.master')

<link rel="stylesheet" href="{{ asset('cadastro_itens/css/style.css') }}">

@section('master-main')
    <div class="signup-content">
        <div class="signup-form mt-4">
            <h1 class="form-title">Cadastro de material</h1>

            <form method="POST" class="register-form " action="{{ route('materiais.salvar') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="text" required name="nome"value="{{ @old('nome') }}" placeholder="Nome do material"
                        value="{{ @old('nome') }}" />
                </div>

                <div class="mb-3">
                    <input type="file" class="form-control" name="foto" id="" value="{{ @old('foto') }}"
                        aria-describedby="fileHelpId" />
                    <small class="form-text">Foto do material</small>
                </div>

                @if ($errors->any())
                    <div>
                        @foreach ($errors->all() as $error)
                            <p class="badge bg-warning">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                @foreach ($categorias as $categoria)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $categoria->id }}" name="categorias[]"
                            id="flexCheckDefault">
                        {{ $categoria->nome }}
                    </div>
                @endforeach


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
                    <h1 class="form-title">Nova Categoria</h1>

                    <form method="POST" class="register-form " action="{{ route('categorias.store') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="nome_categoria" id="name" placeholder="Nome Da Categoria"
                                value="{{ @old('nome') }}" />
                        </div>
                        @error('nome_categoria')
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
