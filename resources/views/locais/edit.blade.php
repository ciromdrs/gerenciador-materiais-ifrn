@extends('layouts.master')
<!-- Main css -->
<link rel="stylesheet" href="{{ asset('cadastro_itens/css/style.css') }}">

@section('master-main')
    <div class="signup-content">
        <div class="signup-form mt-4">
            <h2 class="form-title">Editar Local</h2>
            <form method="POST" class="register-form " id="register-form" action="{{route('locais.update',$local->id) }}">
                @csrf

                <div class="form-group">
                    <input type="text" required name="nome" placeholder="Nome Do Local" value="{{ $local->nome }}" />
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
@endsection
