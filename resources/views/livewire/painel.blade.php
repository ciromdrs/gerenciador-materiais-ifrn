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
                    $path = Storage::url($material->arquivo->path);
                } catch (\Throwable $th) {
                    $path = null;
                }
            @endphp
            <div class="col-lg-4 col-md-6">
                <a href="/emprestimos/novo">
                    <div class="portfolio-wrap">

                        @if ($path != null)
                            <img src="{{ $path }}" class="img-fluid" alt="Imagem não encontrada">

                            <div class="portfolio-info">
                                <div class="portfolio-links">
                                    {{-- <a href="https://lncimg.lance.com.br/cdn-cgi/image/width=1920,quality=75,format=webp/uploads/2023/04/03/642aded4857be.jpeg"
                                        data-gallery="portfolioGallery" class="portfolio-lightbox"
                                        title="Ampliar Foto"><i class="bx bx-plus"></i></a>
                                    <a href="/itens/editar" title="Editar"><i class="bx bx-edit"></i></a> --}}
                                </div>
                                <div class="card" style="border-radius:50px">
                                    <p class="m-1" style="color: black;">{{ $material->nome }}</p>
                                </div>
                            </div>
                        @else
                            <img src="{{ asset('imagens/sem-imagem.jpg') }}" class="img-fluid"
                                alt="Imagem não encontrada">

                            <div class="portfolio-info">
                                <div class="portfolio-links">
                                    {{-- <a href="https://lncimg.lance.com.br/cdn-cgi/image/width=1920,quality=75,format=webp/uploads/2023/04/03/642aded4857be.jpeg"
                                        data-gallery="portfolioGallery" class="portfolio-lightbox"
                                        title="Ampliar Foto"><i class="bx bx-plus"></i></a>
                                    <a href="/itens/editar" title="Editar"><i class="bx bx-edit"></i></a> --}}
                                    <div class="card" style="border-radius:50px">
                                        <p class="m-1" style="color: black;">{{ $material->nome }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif


                    </div>
                </a>
            </div>
        @endforeach
    </div>


    {{-- Listando através dos ITENS: --}}
    {{--    <div class="col-lg-4 col-md-6">
        <div class="portfolio-wrap">
            @php
                try {
                    $path = Storage::url($item->arquivo->path);
                } catch (\Throwable $th) {
                    $path = '';
                }
            @endphp
            @if ($path)
                <img src="{{ $path }}" class="img-fluid" alt="">
                <div class="portfolio-info">
                    <p>{{ $item->material->nome }}</p>
                    <div class="portfolio-links">
                  <a href="https://lncimg.lance.com.br/cdn-cgi/image/width=1920,quality=75,format=webp/uploads/2023/04/03/642aded4857be.jpeg"
                            data-gallery="portfolioGallery" class="portfolio-lightbox" title="Ampliar Foto"><i
                                class="bx bx-plus"></i></a>
                        <a href="/itens/alugar" title="Alugar"><i class="bx bx-link"></i></a>
                        <a href="/itens/editar" title="Editar"><i class="bx bx-edit"></i></a>
                    </div>
                </div>
            @else
                <div class="text-center">
                    <p>{{ $item->material->nome }}</p>
                </div>
            @endif

        </div>
    </div> --}}
