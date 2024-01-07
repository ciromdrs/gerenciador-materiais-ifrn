<div>
    <div>
        <input type="text" placeholder="Buscar Categoria" class="form-control" name="categoria"
            wire:model.live="categoria">
    </div>

    <div class="mt-4">
        <a href="/categorias/nova" class="btn btn-success mb-4">Adicionar Categoria</a>
    </div>

    {{-- @if (Session::has('errors'))   
        Tentando tratar execptions, mas não qual seria a maneira mais apropriada para mostrar ao usuário
        @foreach ($errors->all() as $item)
            <span>{{ $item }}</span>
        @endforeach
    @endif --}}

    <div class="col-12">
        @if (sizeof($categorias) != 0)
            <div class="table-responsive bg-white">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th scope="col">Categoria</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($categorias as $categoria)
                                <td>{{ $categoria->nome }}</td>

                                <td>
                                    <a class="btn btn-success"
                                        href="{{ url('/categorias/deletar', ['categoria' => $categoria->id]) }}
                                        ">Apagar</a>
                                    <a class="btn btn-success"
                                        href="{{ route('categorias.editar', ['categoria' => $categoria->id]) }}">Editar</a>
                                </td>
                        </tr>
        @endforeach

        </tbody>
        </table>
        <div>
        </div>
    </div>
@else
    <div class="text-center">
        <h3>Nenhuma categoria foi encontrada</h3>
    </div>
    @endif
</div>


</div>
