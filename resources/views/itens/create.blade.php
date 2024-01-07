 @extends('layouts.master')

 <!-- Main css -->
 <link rel="stylesheet" href="{{ asset('cadastro_itens/css/style.css') }}">

 @section('master-main')
     <div class="signup-content ">
         <div class="signup-form mt-4">
             <h1 class="form-title">Cadastro de item</h1>

             <form action="{{ route('itens.store') }}" method="POST" enctype="multipart/form-data">
                 @csrf

                 <div class="form-group">
                     <input type="text" required name="estado_conservacao" placeholder="Estado do item"
                         value="{{ @old('estado_conservacao') }}" />

                     @error('estado_conservacao')
                         <span class="badge bg-warning">{{ $message }}</span>
                     @enderror
                 </div>


                 <div class="form-group">
                     <select class="custom-select " required id="CustomSelect" name="local_id"
                         value="{{ @old('local_id') }}">

                         @foreach ($locais as $local)
                             <option value="{{ $local->id }}">{{ $local->nome }}</option>
                         @endforeach
                     </select>
                     <div id="fileHelpId" class="form-text">Escolher Local</div>
                     @error('local_id')
                         <span class="badge bg-warning">{{ $message }}</span>
                     @enderror
                 </div>

                 <div class="form-group">
                     <select class="custom-select " required id="CustomSelect" name="material_id">
                         @foreach ($materiais as $material)
                             <option value="{{ $material->id }}">{{ $material->nome }}</option>
                         @endforeach
                     </select>
                     <div id="fileHelpId" class="form-text">Escolher Material</div>
                     @error('material_id')
                         <span class="badge bg-warning">{{ $message }}</span>
                     @enderror
                 </div>

                 <div class="mb-3">
                     <input type="file" class="form-control" value="{{ @old('foto') }}" name="foto"
                         aria-describedby="fileHelpId">
                     <small class="form-text">Foto do item</small>

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
             </form>

         </div>

     </div>
     </div>

     <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">

                 <div class="m-5">
                     <h2 class="form-title">Novo Local</h2>

                     <form method="POST" class="register-form " action="/locais">
                         @csrf
                         <div class="form-group">
                             <input type="text" name="nome" id="name" placeholder="Nome Do Local"
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
