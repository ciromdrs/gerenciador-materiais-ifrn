<div>

    <div class="mb-4">
        <input type="text" placeholder="Buscar Local" class="form-control" name="categoria" wire:model.live="local">
    </div>

    <div>
        <a class="btn btn-success mb-4" href="/locais/novo">Adicionar Local</a>
    </div>
    <div class="col-12">
        @if (sizeof($locais) != 0)
            <div class="table-responsive bg-white">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th scope="col">Local</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($locais as $local)
                                <td>{{ $local->nome }}</td>

                                <td>
                                    <a class="btn btn-success"
                                        href="{{ url('/locais/deletar', ['local' => $local->id]) }}">Apagar</a>
                                    <a class="btn btn-success"
                                        href="{{ route('locais.editar', ['local' => $local->id]) }}">Editar</a>
                                </td>
                        </tr>
        @endforeach

        </tbody>
        </table>
    </div>
@else
    <div class="text-center">
        <h3>Nenhum local foi encontrado</h3>
    </div>
    @endif

</div>
</div>
