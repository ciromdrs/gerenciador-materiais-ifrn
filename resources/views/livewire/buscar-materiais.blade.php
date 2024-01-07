<div>
    <div>
        <input type="text" placeholder="Buscar Material" class="form-control" name="categoria" wire:model.live="material">
    </div>

    <div>
        <a class="btn btn-success mt-3" href="/materiais/novo">Adicionar Material</a>
    </div>

    {{-- @if (Session::has('errors'))   
        Tentando tratar execptions, mas não qual seria a maneira mais apropriada para mostrar ao usuário
        @foreach ($errors->all() as $item)
            <span>{{ $item }}</span>
        @endforeach
    @endif --}}

    <div class="col-12">
        @if (sizeof($materiais) != 0)
            <div class="table-responsive bg-white">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th scope="col">Foto</th>
                            <th scope="col">Material</th>
                            <th scope="col">Categorias</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>

                            @foreach ($materiais as $material)
                                @php
                                    try {
                                        $path = Storage::url($material->arquivo->path);
                                    } catch (\Throwable $th) {
                                        $path = null;
                                    }
                                @endphp
                                <td>
                                    <div class="mx-2" style="width:100%;">
                                        @if ($path != null)
                                            <img style="height: 100px" src="{{ $path }}"
                                                alt="Nenhuma foto encontrada">
                                        @else
                                            <img src="{{ asset('imagens/sem-imagem.jpg') }}" class="img-fluid"
                                                style="height: 100px" alt="Imagem não encontrada">
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $material->nome }}</td>
                                <td>
                                    @if (sizeof($material->categorias) != 0)
                                        @foreach ($material->categorias as $categoria)
                                            {{ $categoria->nome }};
                                        @endforeach
                                    @else
                                        <p>Sem categoria(s)</p>
                                    @endif
                                </td>

                                <td>
                                    <a class="btn btn-success"
                                        href="{{ url('/materiais/deletar', ['material' => $material->id]) }}">Apagar</a>
                                    <a class="btn btn-success"
                                        href="{{ route('materiais.editar', $material->id) }}">Editar</a>
                                </td>
                        </tr>
        @endforeach

        </tbody>
        </table>
    </div>
@else
    <div class="text-center">
        <h3>Nenhum material foi encontrado</h3>
    </div>
    @endif

</div>

@foreach ($errors->all() as $item)
    {{ $item }}
@endforeach
</div>
