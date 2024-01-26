<div>
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">

                {{--
                    <a href="/painel">
                        <li data-filter=".filter-todos">Todos</li>
                    </a>
                    @foreach ($categorias as $categoria)
                    <a href="{{route('material.categoria',$categoria->id)}}">
                        <li data-filter=".filter-{{ $categoria->nome }}">{{ $categoria->nome }}</li>
                    </a>
                    @endforeach --}}

                <li wire:click="define({{ 0 }})" data-filter=".filter-todos">Todos</li>
                @foreach ($categorias as $categoria)
                    <li wire:click="define({{ $categoria->id }})" data-filter=".filter-{{ $categoria->nome }}">
                        {{ $categoria->nome }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="row portfolio-container">
        {{-- TODO: Iterar em todas as Categorias do Material do Item --}}
        @foreach ($materiais as $material)
            @php
                try {
                    $caminho = Storage::url($material->arquivo->caminho);
                } catch (\Throwable $th) {
                    $caminho = null;
                }
            @endphp
            <div class="col-lg-4 col-md-6">
                <a href="/emprestimos/novo">
                    <div class="portfolio-wrap">

                        <div class="text-center">
                            @if ($caminho != null)
                                <img src="{{ $caminho }}" style="height: 200px" class="img-fluid" alt="Foto do Material">
                            @else
                                <img src="{{ asset('imagens/sem-imagem.jpg') }}" style="height: 200px" class="img-fluid"
                                    alt="Material sem foto">
                            @endif
                            <div class="portfolio-info">
                                <div class="portfolio-links">
                                    {{-- <a href="https://lncimg.lance.com.br/cdn-cgi/image/width=1920,quality=75,format=webp/uploads/2023/04/03/642aded4857be.jpeg"
                                    data-gallery="portfolioGallery" class="portfolio-lightbox"
                                    title="Ampliar Foto"><i class="bx bx-plus"></i></a>
                                <a href="{{ route('materiais.editar') }}" title="Editar"><i class="bx bx-edit"></i></a> --}}
                                </div>
                                <div class="card" style="border-radius:50px">
                                    <p class="m-1" style="color: black;">{{ $material->nome }}</p>
                                </div>
                            </div>
                        </div>


                    </div>
                </a>
            </div>
        @endforeach
    </div>
