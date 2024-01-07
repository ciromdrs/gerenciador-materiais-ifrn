<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Local;
use App\Models\Material;
use App\Http\Requests\ValidacaoItem;
use App\Models\Arquivo;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    /**
     * Exibe a lista de itens.
     */
    public function index()
    {
        return view("itens.index", ['itens' => Item::with(['local', 'material'])->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locais = Local::orderBy('nome', 'asc')->get();
        $materiais = Material::orderBy('nome', 'asc')->get();

        return view(
            'itens.create',
            [
                'locais' => $locais,
                'materiais' => $materiais,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidacaoItem $request)
    {
        $file = $request->file('foto');
        $item = Item::create($request->all());

        if ($file) {
            $path = $file->storeAs('public/itens', $file->hashName());

            Storage::setVisibility($path, 'public');

            Arquivo::create([
                'item_id' => $item->id,
                'path' => $path,
            ]);
        }
        return back();
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        return view('itens.edit', [
            'item' => $item,
            'materiais' => \App\Models\Material::all(),
            'locais' => \App\Models\Local::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ValidacaoItem $request, Item $item)
    {
        $file = $request->file('foto');

        try {
            //caso tenha foto, entra aqui
            if ($file) {

                if (Storage::exists($item->arquivo->path)) {

                    //caso tenha uma foto, ele recupera o caminho dessa foto
                    $path = $item->arquivo->path;

                    //apaga a foto do sistema
                    Storage::delete($path);

                    //alterando a visibilidade da foto
                    Storage::setVisibility($path, 'public');

                    //salvando no sistema
                    $path = $file->storeAs('public/itens', $file->hashName());

                    //buscando o registro no banco de dados
                    $arq = Arquivo::find($item->arquivo->id);

                    //atualizando o caminho 
                    $arq->path = $path;
                    $arq->save();

                    //atualiza todos os dados do item em geral
                    $item->update($request->all());

                    //retorna para o anterior
                    return back();
                } else {
                    //caso o arquivo seja apagado do sistema, ele não dá pau, pois é só entrar com ele de novo, por isso tem esse if

                    //salvando no projeto
                    $path = $file->storeAs('public/itens', $file->hashName());

                    //alterando a visibilidade
                    Storage::setVisibility($path, 'public');

                    //capturando os registros no banco de dados
                    $arq = Arquivo::find($item->arquivo->id);

                    //atualizando o registro
                    $arq->path = $path;
                    $arq->save();

                    //atualizando tudo
                    $item->update($request->all());

                    // e deppois volta
                    return back();
                }
            } else {
                //atualizando tudo
                $item->update($request->all());

                // e deppois volta
                return back();
            }
        } catch (\Throwable $th) {
            //caso não tenha foto, entra aqui
            if ($file) { //verifica se realmente foi passado um arquivo
                //caso não tenha foto

                //salva a foto no sistema
                $path = $file->storeAs('public/itens', $file->hashName());

                //altera a visibilidade da foto
                Storage::setVisibility($path, 'public');

                //salva o caminho no banco
                Arquivo::create([
                    'item_id' => $item->id,
                    'path' => $path,
                ]);
                //atualiza todos os dados
                $item->update($request->all());

                //retorna para o anterior
                return back();
            } else {
                //caso não seja passado um arquivo, ele apenas atualiza tudo
                $item->update($request->all());
                // e deppois volta
                return back();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        //caso não tenha foto
        try {
            //caso tenha foto
            $path = $item->arquivo->path;
            if (Storage::exists($path)) {
                Storage::delete($path);
                $arq = Arquivo::find($item->arquivo->id);
                $arq->delete();
                $item->delete();
                return back();
            }
        } catch (\Throwable $th) {
            //caso não tenha foto
            return back()->withException($th);
        }
    }
}
