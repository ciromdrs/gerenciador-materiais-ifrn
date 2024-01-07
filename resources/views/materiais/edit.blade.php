@extends('layouts.master')

<link rel="stylesheet" href="{{ asset('cadastro_itens/css/style.css') }}">

@section('master-main')
    <div class="signup-content">
        <div class="signup-form mt-4">
            <h1 class="form-title">Edição do material</h1>

            <form method="POST" class="register-form " action="{{ route('materiais.atualizar', $material->id) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="text" required name="nome"value="{{ $material->nome }}"
                        placeholder="Nome do material" value="" />
                </div>

                <div class="mb-3">
                    <input type="file" class="form-control" name="foto" id="" value="{{ @old('foto') }}"
                        aria-describedby="fileHelpId" />
                    <small class="form-text">Foto do material</small>
                </div>

                <div class="row">
                    <div class="col">
                        <h2 style="font-size: 20px">Categorias desse material</h2>
                        <p>Selecione a que deseja remover</p>
                        @foreach ($material->categorias as $categoria)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $categoria->id }}"
                                    name="categorias_remover[]">
                                {{ $categoria->nome }}
                            </div>
                        @endforeach

                    </div>
                    <div class="col mt-4 mt-sm-0">
                        <h2 style="font-size: 20px">Categorias</h2>
                        <p>Selecione a categoria que deseja adicionar (categorias repetidas não vão ser
                            associadas)</p>
                        @foreach ($categorias as $categoria)
                            <div class="form-check">

                                <input class="form-check-input" type="checkbox" value="{{ $categoria->id }}"
                                    name="categorias_adicionar[]" id="flexCheckDefault">
                                {{ $categoria->nome }}

                            </div>
                        @endforeach
                    </div>

                </div>

                @error('name')
                    <span class="badge bg-warning">{{ $message }}</span>
                @enderror


                @if ($errors->any())
                    <div>
                        @foreach ($errors->all() as $error)
                            <p class="badge bg-warning">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <div class="form-group form-button">
                    <button class="form-submit border border-none">Salvar</button>
                </div>


                <button type="button" class="form-submit border border-none" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    Nova Categoria
                </button>
            </form>
        </div>

        @php
            try {
                $path = Storage::url($material->arquivo->path);
            } catch (\Throwable $th) {
                $path = null;
            }
        @endphp
        @if ($path != null)
            <!-- Tratar else -->
            <div class="signup-image" style="display:flex; align-itens:center; flex-direction:column;">
                <div class="text-center">
                    <h1>Foto do Material:</h1>
                </div>
                <img src="{{ $path }}"alt="Foto do item" style="height:auto width:auto;">
                <div class="mt-3">
                    <a href="{{ route('arquivos.apagar', $material->arquivo->id) }}" class="btn btn-success">Apagar</a>
                </div>
            </div>
        @endif
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="m-5">
                    <h1 class="form-title">Nova Categoria</h1>

                    <form method="POST" class="register-form " action="/categorias">
                        @csrf
                        <div class="form-group">
                            <input type="text" required name="nome_categoria" id="name"
                                placeholder="Nome Da Categoria" value="{{ @old('nome_categoria') }}" />
                        </div>
                        @error('nome_categoria')
                            <span class="badge bg-warning">(Cadastro de categoria){{ $message }}</span>
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
