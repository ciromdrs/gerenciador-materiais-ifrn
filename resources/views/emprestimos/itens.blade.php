<!-- Renomear este aquivo para show.blade.php -->

@extends('layouts.master')

@section('master-main')
    <div class="p-3">
        <div class="row justify-content-center" style="margin-top: 90px">
            <div class="text-center mb-2">
                <h1 class="display-5">Informações sobre o empréstimo</h1>
            </div>
            <div class="table-responsive mt-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Foto</th>   
                            <th scope="col">Material</th>
                            <th scope="col">Estado de conservação</th>
                            <th scope="col">Quem emprestou</th>
                            <th scope="col">Quem recebeu</th>
                            <th scope="col">Hora do empréstimo</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- <form action="{{ route('emprestimos.devolver', $emprestimo->id) }}" method="POST"> --}}
                        @foreach ($emprestimo->materiais as $material)
                            @php
                                try {
                                    $caminho = Storage::url($material->arquivo->caminho);
                                } catch (\Throwable $th) {
                                    $caminho = '';
                                }
                            @endphp
                            <tr class="">
                                <td>
                                    <div class="mx-2" style="width:100%;">
                                        <img style="height: 100px" src="{{ $caminho }}" alt="Nenhuma foto encontrada">
                                    </div>
                                </td>
                                <td>
                                    {{-- <input name="materiais[]" value="{{ $material->id }}" type="checkbox"> --}}
                                    {{ $material->nome }}
                                </td>
                                <td>
                                    {{ $material->estado_conservacao }}
                                </td>
                                <td>
                                    {{ $emprestimo->usuario_que_emprestou }}
                                </td>

                                <td>
                                    {{ $emprestimo->usuario_que_recebeu }}
                                </td>

                                <td>
                                    {{ $emprestimo->created_at }}
                                </td>

                            </tr>
                        @endforeach
                        {{-- <button class="btn btn-success">Devolver</button>
                        </form> --}}
                    </tbody>
                </table>
            </div>

            <form action="{{ route('emprestimos.devolver', $emprestimo->id) }}" class="mt-2" method="POST">
                @csrf
                @foreach ($emprestimo->materiais as $material)
                    <input name="materiais[]" value="{{ $material->id }}" hidden checked type="checkbox">
                @endforeach
                <button class="btn btn-success">Devolver</button>
            </form>

        </div>
    </div>

    </div>
@endsection
