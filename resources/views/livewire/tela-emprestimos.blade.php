<div class="container">
    <div class="row">
        <div class="col-lg-7 col-sm-12 col-md-11  col-xs-12" style="margin-top: 100px">
            <h2 class="pb-2 ">Materiais</h2>
            <div class="d-flex mb-3">
                <!-- Filtro de Materiais -->
                <!-- TODO: Colocar um filtro de texto geral, que busque em todos os atributos de Material -->
                <span>Filtrar:</span>
                <input type=text wire:model.live="filtro_material" class="form-control form-control-sm" id="FormControlSelect1" placeholder='Ex.: bola volei'>
            </div>

            <!-- Lista de Materiais filtrados -->
            <ul class="list-unstyled" id="ulmaterial">
                @foreach ($materiais as $material)
                <li class="mt-2" id="boxleftmain">
                    <div class="d-flex flex-row justify-content-between align-items-center p-1">
                        <!-- Foto -->
                        <img style="height: 100px" class="img-fluid" alt="Foto do Material"
                            src=
                                @if($material->arquivo)
                                    "{{ Storage::url($material->arquivo->caminho) }}"
                                @else
                                    "{{ asset('imagens/sem-imagem.jpg') }}"
                                @endif
                            >
                        <!-- Nome, disponibilidade, etc. -->
                        <div class="d-flex flex-column p-2 justify-content-center">
                            <h4 class="mb-0">{{ $material->nome }}</h3>
                            <p class="mb-0"><span>Local: {{ $material->local->nome }}</span></p>
                            <p class="mb-0"><span>Estado de conservação:
                                    {{ $material->estado_conservacao }}</span></p>
                            <p class="mb-0">
                                @php
                                    [$disponivel, $motivo] = $material->disponivel();
                                    if ($disponivel) {
                                        $bgclass = 'bg-success';
                                    } else {
                                        $bgclass = 'bg-warning';
                                    }
                                    echo "<span class=\"badge $bgclass\">$motivo</span>";
                                @endphp
                            </p>
                        </div>
                        <!-- Botão selecionar material -->
                        <div class="p-2 align-items-center justify-content-center">
                            <button class=" btn btn-success text-center" wire:click="adicionar({{ $material }})"
                                id="addbutton">+</button>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>

        <!-- Formulário do responsável -->
        <div class="col-lg-5 col-md-11 col-sm-11 col-xs-1 " id="divpreenche" style="margin-top: 100px">
            <h2 class="mb-3">Empréstimo</h2>
            <div class="form-inline my-2 my-lg-0 col-10 " id="formpreenche">
                <input id="formulario" required class="form-control focus mb-2 col-12"
                    wire:model.live="responsavel" type="search"
                    placeholder="Matrícula do aluno ou servidor" aria-label="Search"
                    style="width: 20rem">
                <button class="btn btn-success" type="submit" wire:click="emprestar">Emprestar</button>
                @if ($msg)
                <div>
                    <span class="badge bg-warning">
                        {{ $msg }}
                    </span>
                </div>
                @endif
            </div>

            <!-- Lista de Materais selecionados -->
            @if (sizeof($selecionados) != 0)
            <h4 class="mb-3">Selecionados</h4>
            <div class="col-lg-12  justify-content-between">
                <div class="row">
                    @foreach ($selecionados as $mat)
                    <div wire:click="remover({{ $mat }})" class="p-1 mx-1"
                        style="width: auto; height:auto; border: solid 1px #18b746; border-radius:11px;cursor:pointer; le">
                        {{ $mat->nome }}
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>