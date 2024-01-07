<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Http\Requests\ValidacaoMaterial;
use App\Models\Arquivo;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Material::with('categorias')->orderBy('nome', 'asc')->get();
        return view('materiais.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::orderBy('nome', 'asc')->get();
        return view('materiais.create', ['categorias' => $categorias]);
    }

    /**
     * Cria um material.
     */
    public function store(ValidacaoMaterial $request)
    {
        // Cria o material
        $material = Material::create($request->all());
        
        // Pega a possível foto
        $file = $request->file('foto');
        // Verifica se tem foto
        if ($file) {
            // Salva a foto
            $path = $file->storeAs('public/materiais', $file->hashName());
            
            Storage::setVisibility($path, 'public');

            // Salva o registro do arquivo da foto
            Arquivo::create([
                'material_id' => $material->id,
                'path' => $path,
            ]);
        }
        
        // Salva as categorias
        $categorias = $request->categorias;
        for ($i = 0; $i < sizeof($categorias); $i++) {
            $material->categorias()->attach($categorias[$i]);
        }

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        return view('materiais.edit', ['material' => $material, 'categorias' => \App\Models\Categoria::orderBy('nome', 'asc')->get()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ValidacaoMaterial $request, Material $material)
    {

        $file = $request->file('foto');
        try {
            //caso tenha foto, entra aqui
            if ($file) {
                if (Storage::exists($material->arquivo->path)) {
                    //caso tenha uma foto, ele recupera o caminho dessa foto
                    $path = $material->arquivo->path;

                    //apaga a foto do sistema
                    Storage::delete($path);

                    //alterando a visibilidade da foto
                    Storage::setVisibility($path, 'public');

                    //salvando no sistema
                    $path = $file->storeAs('public/itens', $file->hashName());

                    //buscando o registro no banco de dados
                    $arq = Arquivo::find($material->arquivo->id);

                    //atualizando o caminho 
                    $arq->path = $path;
                    $arq->save();
                }
            }
        } catch (\Throwable $th) {
            // TODO: Tratar excessão específica para caso não tenha foto
            $path = $file->storeAs('public/materiais', $file->hashName());

            Storage::setVisibility($path, 'public');

            //salvando o registro
            Arquivo::create([
                'material_id' => $material->id,
                'path' => $path,
            ]);
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
        //caso não tenha foto
        try {
            //caso tenha foto
            $path = $material->arquivo->path;
            if (Storage::exists($path)) {
                Storage::delete($path);
                $arq = Arquivo::find($material->arquivo->id);
                $arq->delete();
                $material->delete();
                return back();
            }
        } catch (\Throwable $th) {
            // TODO: Tratar excessão específica para caso não tenha foto
            try {
                $material->delete();
                return back();
            } catch (\Throwable $th) {
                return back()->withException($th);
            }
        }
    }
}
