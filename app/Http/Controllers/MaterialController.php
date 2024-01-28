<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidacaoMaterial;
use App\Models\Arquivo;
use App\Models\Categoria;
use App\Models\Local;
use App\Models\Material;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materiais = Material::with(['categorias'])
            ->orderBy('nome', 'asc')
            ->get();
        return view('materiais.index', ['materiais' => $materiais]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::orderBy('nome', 'asc')->get();
        $locais = Local::orderBy('nome', 'asc')->get();
        return view(
            'materiais.create',
            ['categorias' => $categorias, 'locais' => $locais]
        );
    }

    /**
     * Cria um material.
     */
    public function store(ValidacaoMaterial $request)
    {
        // Cria o material
        // TODO: Substituir request->all() pelos campos explícitos
        $material = Material::create($request->all());

        // Salva a foto, se foi enviada
        $file = $request->file('foto');
        if ($file) {
            $this->salvar_foto($file, $material->id);
        }

        // Salva as categorias
        $categoria_ids = $request->get('categorias', []);
        foreach ($categoria_ids as $id) {
            $material->categorias()->attach($id);
        }

        return back();
    }

    /**
     * Salva a foto de um material.
     * 
     * @param \Illuminate\Http\UploadedFile $file A foto enviada pelo usuário na requisição.
     * @param string $material_id O id do material a ser vinculado à foto.
     */
    private function salvar_foto($file, $material_id)
    {
        $caminho = $file->storeAs('public/materiais', $file->hashName());

        // Salva o registro do arquivo da foto
        Arquivo::create([
            'material_id' => $material_id,
            'caminho' => $caminho,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        return view('materiais.edit', [
            'material' => $material,
            'categorias' => Categoria::orderBy('nome', 'asc')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ValidacaoMaterial $request, Material $material)
    {
        // Caso o usuário tenha enviado uma foto
        $file = $request->file('foto');
        if ($file) {
            // Verifica se já havia uma foto
            if (Storage::exists($material->arquivo->caminho)) {
                // Se já havia, apaga
                $caminho = $material->arquivo->caminho;
                Storage::delete($caminho);

                // Salva a nova foto e deixa pública
                $caminho = $file->storeAs('public/materiais', $file->hashName());

                // Atualiza o registro do Arquivo com o novo caminho
                $arq = Arquivo::find($material->arquivo->id);
                $arq->caminho = $caminho;
                $arq->save();
            }
        }

        //capturando os ids das categorias que foram marcadas para serem removidas
        $categorias_remover = $request->categorias_remover;
        //capturando os ids das categorias que foram marcadas para serem associadas/adicionadas
        $categorias_adicionar = $request->categorias_adicionar;
        if ($categorias_remover) { //verificando se existe alguma a ser removida
            //removendo as categorias
            for ($i = 0; $i < sizeof($categorias_remover); $i++) {
                $material->categorias()->detach($categorias_remover[$i]);
            }
        }
        if ($categorias_adicionar) { //verificando se alguma categoria precisa ser adicionada
            $indisponivel = []; //array que vai conter possíveis erros de categorias repetidas
            for ($i = 0; $i < sizeof($categorias_adicionar); $i++) { //for para passar pela arra
                foreach ($material->categorias as $categorias) { //foreach para acessar as categorias anexadas anteriormente a esse material
                    //aqui estou fazendo uma verificação, estou verificando se as novas categorias estão repetidas/já tinham sido associadas anteriormente
                    if ($categorias_adicionar[$i] == $categorias->id) {
                        //se alguma condição for verdadeira, ele gera a string abaixo:
                        $indisponivel[] = "Categoria '$categorias->nome' já está associada a esse material";
                    }
                }
            }
            if ($indisponivel) { //verificando se existe algum erro de tentativa de incluir uma categoria já anexada
                //retornando para a página anterior junto com a variável que contém as mensagens de erro
                return back()->withErrors(['error' => $indisponivel]);
            } else {
                //caso não exista categorias repetidas, ele anexa as novas categorias
                for ($i = 0; $i < sizeof($categorias_adicionar); $i++) {
                    $material->categorias()->attach($categorias_adicionar[$i]);
                }
            }
        }
        //atualizando o nome do campo se for necessário
        $material->update(['nome' => $request->nome]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        // Caso tenha categorias, apaga
        $material->categorias()->detach();
        // Caso tenha foto, apaga
        $arq = $material->arquivo;
        if ($arq) {
            if (Storage::exists($arq->caminho)) {
                Storage::delete($arq->caminho);
            }
            $arq->delete();
        }
        $material->delete();
        return back();
    }
}
