<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use App\Models\Material;
use Illuminate\Http\Request;
use App\Http\Requests\ValidacaoEmprestimo;

class EmprestimoController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('emprestimos.create', [
            'materiais' => Material::orderBy('nome', 'asc')->get(),
        ]);
    }
    /**
     * Listar empréstimos.
     */
    public function index()
    {
        return view('emprestimos.index', ['emprestimos' => Emprestimo::all()]);
    }


    public function materiais(Emprestimo $emprestimo)
    {
        return view('emprestimos.materiais', [
            'emprestimo' => $emprestimo,
        ]);
    }

    public function devolver(Request $request, Emprestimo $emprestimo)
    {
        $ids = $request->materiais; //capturando os ids  dos materiais que foram passados pelo usuário através da checkbox
        if ($ids) {
            if (sizeof($ids) == sizeof($emprestimo->materiais)) {
                //esta comparando se a quantidade de materiais, se for a mesma quantidade significa que todos os materiais do empréstimo foram devolvido,logo eu dissocio apenas os materiais e apago o empréstimo
                foreach ($emprestimo->materiais as $material) {
                    $material->save();
                }
                $emprestimo->materiais()->detach();
                $emprestimo->delete();
            } else {
                //se a quantidade não for igual, então nem todos os materiais foram devolvidos, logo dissocio apenas os materiais que foram devolvidos
                for ($i = 0; $i < sizeof($ids); $i++) {
                    $emprestimo->materiais()->detach($ids[$i]);
                    foreach (Material::find($ids) as $material) {
                        $material->save();
                    }
                }
            }
        } else {
            return back();
        }

        return redirect(route('emprestimos.index'));
    }
}
