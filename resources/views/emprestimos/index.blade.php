@extends('layouts.master')

@section('master-main')
    <div class="p-3">
        <div class="row justify-content-center" style="margin-top: 90px">
            @if (sizeof($emprestimos) != 0)
                <div class="text-center mb-2">
                    <h1 class="display-5">Empréstimos pendentes</h1>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Data e Hora</th>
                                <th scope="col">Quem Emprestou</th>
                                <th scope="col">Quem Recebeu</th>
                                <th scope="col">Item(s)</th>
                                <th scope="col">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($emprestimos as $emp)
                                <tr class="">
                                    <td>
                                        {{ $emp->created_at }}
                                    </td>

                                    <td>
                                        {{ $emp->usuario_que_emprestou }}
                                    </td>

                                    <td>
                                        {{ $emp->usuario_que_recebeu }}
                                    </td>

                                    <td>
                                        {{-- acessando os items desse empréstimo --}}
                                        @foreach ($emp->itens as $item)
                                            {{ $item->material->nome }};
                                        @endforeach
                                    </td>
                                    <td>
                                        <form action="{{ route('emprestimos.devolver', $emp->id) }}" class="mt-2"
                                            method="POST">
                                            @csrf
                                            @foreach ($emp->itens as $item)
                                                <input name="itens[]" value="{{ $item->id }}" hidden checked
                                                    type="checkbox">
                                            @endforeach
                                            <a class="btn btn-success" href="{{ route('emprestimos.itens', $emp->id) }}">
                                                Itens </a>
                                            <button class="btn btn-success">Devolver</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
@else
    <div class="text-center mb-2">
        <h1 class="display-5">Nenhum empréstimo pendente</h1>
    </div>
    @endif

@endsection
