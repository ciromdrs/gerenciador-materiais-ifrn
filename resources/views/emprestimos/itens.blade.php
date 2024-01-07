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
                            <th scope="col">Nome do item</th>
                            <th scope="col">Estado de conservação</th>
                            <th scope="col">Quem emprestou</th>
                            <th scope="col">Quem recebeu</th>
                            <th scope="col">Horário do empréstimo</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- <form action="{{ route('emprestimos.devolver', $emprestimo->id) }}" method="POST"> --}}
                        @foreach ($emprestimo->itens as $item)
                            @php
                                try {
                                    $path = Storage::url($item->arquivo->path);
                                } catch (\Throwable $th) {
                                    $path = '';
                                }
                            @endphp
                            <tr class="">
                                <td>
                                    <div class="mx-2" style="width:100%;">
                                        <img style="height: 100px" src="{{ $path }}" alt="Nenhuma foto encontrada">
                                    </div>
                                </td>
                                <td>
                                    {{-- <input name="itens[]" value="{{ $item->id }}" type="checkbox"> --}}
                                    {{ $item->material->nome }}
                                </td>
                                <td>
                                    {{ $item->estado_conservacao }}
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
                @foreach ($emprestimo->itens as $item)
                    <input name="itens[]" value="{{ $item->id }}" hidden checked type="checkbox">
                @endforeach
                <button class="btn btn-success">Devolver</button>
            </form>

        </div>
    </div>

    </div>
@endsection
