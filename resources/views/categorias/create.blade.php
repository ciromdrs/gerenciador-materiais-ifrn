@extends('layouts.master')
    <!-- Main css -->
    <link rel="stylesheet" href="{{asset('cadastro_itens/css/style.css')}}">

 @section('master-main')

    <div class="signup-content">
        <div class="signup-form mt-4">
            <h1 class="form-title">Cadastro de Categoria</h1>

            <form method="POST" class="register-form " action="/categorias">
                @csrf
                <div class="form-group">
                    <input type="text" required name="nome_categoria" id="name" placeholder="Nome Da Categoria" value="{{@old('nome_categoria')}}" />
                </div>
                @error('nome_categoria')
                    <span class="badge bg-warning">{{$message}}</span>
                @enderror

                <div class="form-group form-button">
                    <button class="form-submit border border-none">Salvar</button>
                </div>

            </form>
            
        </div>
        
    </div>


@endsection
