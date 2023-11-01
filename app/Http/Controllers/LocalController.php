<?php

namespace App\Http\Controllers;

use App\Models\Local;
use Illuminate\Http\Request;
use App\Http\Requests\ValidacaoLocal;

class LocalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('locais.index',['locais'=>\App\Models\Local::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('locais.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidacaoLocal $request)
    {
        Local::create($request->all());
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Local $local)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Local $local)
    {
        return view('locais.edit',['local'=>$local]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ValidacaoLocal $request, Local $local)
    {
        $local->update($request->all());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Local $local)
    {
        $local->delete();
        return back();
    }
}
