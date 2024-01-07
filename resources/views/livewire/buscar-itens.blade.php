<div>
    <div>
        <div class="mb-3">
            <label for="" class="form-label">Filtrar por material</label>
            <select class="form-select form-select-lg" name="" wire:model.live="material" id="">
                <option selected value="0">Todos</option>
                @foreach ($materiais as $material)
                    <option value="{{ $material->id }}">{{ $material->nome }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div>
        <a class="btn btn-success mt-3" href="/itens/novo">Adicionar Item</a>
    </div>
    <div class="col-12">
        @if (sizeof($itens) != 0)
            <div class="table-responsive bg-white">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th scope="col">Foto</th>
                            <th scope="col">Item</th>
                            <th scope="col">Local</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>

                            @foreach ($itens as $item)
                                @php
                                    try {
                                        $path = Storage::url($item->arquivo->path);
                                    } catch (\Throwable $th) {
                                        $path = null;
                                    }
                                @endphp
                                <td>
                                    <div class="mx-2" style="width:100%;">
                                        @if ($path != null)
                                            <img style="height: 100px" src="{{ $path }}"
                                                alt="Imagem não encontrada">
                                        @else
                                            <img src="{{ asset('imagens/sem-imagem.jpg') }}" class="img-fluid" style="height: 100px"
                                                alt="Imagem não encontrada">
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $item->material->nome }}</td>
                                <td>{{ $item->local->nome }}</td>
                                <td>{{ $item->estado_conservacao }}</td>

                                <td>
                                    <a class="btn btn-success"
                                        href="{{ url('/itens/deletar', ['item' => $item->id]) }}"> Apagar</a>
                                    <a class="btn btn-success"
                                        href="{{ route('itens.editar', ['item' => $item->id]) }}">Editar</a>
                                </td>
                        </tr>
        @endforeach

        </tbody>
        </table>
    </div>
@else
    <div class="text-center">
        <h3>Nenhum item foi encontrado</h3>
    </div>
    @endif

</div>
</div>
