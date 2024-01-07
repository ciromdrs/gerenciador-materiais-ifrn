<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Requests\ValidacaoCategoria;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $categorias=Categoria::orderBy('nome','asc');
        return view('categorias.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidacaoCategoria $request)
    {
        Categoria::create(['nome' => $request->nome_categoria]);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        return view('categorias.show', ['categoria' => $categoria]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', ['categoria' => $categoria]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ValidacaoCategoria $request, Categoria $categoria)
    {
        $categoria->update(['nome' => $request->nome_categoria]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Categoria $categoria)
    {
        try {
            $categoria->delete();
            return back();
        } catch (\Throwable $th) {
            return back()->withErrors($th->getMessage());
        }
    }
}
