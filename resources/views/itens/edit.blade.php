@extends('layouts.master')

<!-- Main css -->
<link rel="stylesheet" href="{{ asset('cadastro_itens/css/style.css') }}">

@section('master-main')
    <div class="signup-content ">
        <div class="signup-form mt-4">
            <h1 class="form-title">Edição do item</h1>
            <form method="post" class="register-form " id="register-form" action="{{ route('itens.update', $item->id) }}"
                enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <input type="text" required name="estado_conservacao" placeholder="Estado do item"
                        value="{{ $item->estado_conservacao }}" />
                </div>


                <div class="form-group">
                    <select class="custom-select " required id="CustomSelect" name="local_id" value="{{ @old('local') }}">
                        <option selected value="{{ $item->local->id }}">{{ $item->local->nome }}</option>
                        @foreach ($locais as $local)
                            <option value="{{ $local->id }}">{{ $local->nome }}</option>
                        @endforeach
                    </select>
                    <div id="fileHelpId" class="form-text">Escolher Local</div>
                </div>

                <div class="form-group">
                    <select class="custom-select " required id="CustomSelect" name="material_id">
                        <option selected value="{{ $item->material->id }}">{{ $item->material->nome }}</option>
                        @foreach ($materiais as $material)
                            <option value="{{ $material->id }}">{{ $material->nome }}</option>
                        @endforeach
                    </select>
                    <div id="fileHelpId" class="form-text">Escolher Material</div>
                </div>

                <div class="mb-3">
                    <input type="file" class="form-control" value="{{ @old('foto') }}" name="foto"
                        aria-describedby="fileHelpId">
                    <small class="form-text">Foto do Item</small>
                    @error('foto')
                        <span class="badge bg-warning">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group form-button">
                    <button class="form-submit border border-none">Salvar</button>
                </div>
            </form>

            <button type="button" class="form-submit border border-none" data-bs-toggle="modal"
                data-bs-target="#exampleModal">
                Novo Local
            </button>

        </div>

        @php
            try {
                $path = Storage::url($item->arquivo->path);
            } catch (\Throwable $th) {
                $path = null;
            }
        @endphp
        @if ($path != null)
        <!-- Tratar o else -->
            <div class="signup-image" style="display:flex; align-itens:center; flex-direction:column;">
                <div class="text-center">
                    <h2>Foto do item:</h2>
                </div>
                <img src="{{ $path }}"alt="Foto do item" style="height:auto width:auto;">
                <div class="mt-3">
                    <a href="{{ route('arquivos.apagar', $item->arquivo->id) }}" class="btn btn-success">Apagar</a>
                </div>
            </div>
        @endif
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="m-5">
                    <h2 class="form-title">Nova Categoria</h2>

                    <form method="POST" class="register-form " action="/locais">
                        @csrf
                        <div class="form-group">
                            <input type="text" required name="nome" id="name" placeholder="Nome Do Local"
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
    @endsection
