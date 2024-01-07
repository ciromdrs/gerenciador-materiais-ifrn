<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use App\Models\Material;
use App\Models\Item;
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
            'itens' => Item::all(),
        ]);
    }
    /**
     * Listar empréstimos.
     */
    public function index()
    {
        // return 'chegou aqui';
        return view('emprestimos.index', ['emprestimos' => Emprestimo::all()]);
    }


    public function itens(Emprestimo $emprestimo)
    {
        return view('emprestimos.itens', [
            'emprestimo' => $emprestimo,
        ]);
    }

    public function devolver(Request $request, Emprestimo $emprestimo)
    {
        $ids = $request->itens; //capturando os ids  dos itens que foram passados pelo usuário através da checkbox
        if ($ids) {
            if (sizeof($ids) == sizeof($emprestimo->itens)) {
                //esta comparando se a quantidade de itens, se for a mesma quantidade significa que todos os itens do empréstimo foram devolvido,logo eu dissocio apenas os itens e apago o empréstimo
                foreach ($emprestimo->itens as $item) {
                    $item->disponibilidade = true;
                    $item->save();
                }
                $emprestimo->itens()->detach();
                $emprestimo->delete();
            } else {
                //se a quantidade não for igual, então nem todos os itens foram devolvidos, logo dissocio apenas os itens que foram devolvidos
                for ($i = 0; $i < sizeof($ids); $i++) {
                    $emprestimo->itens()->detach($ids[$i]);
                    foreach (Item::find($ids) as $item) {
                        $item->disponibilidade = true;
                        $item->save();
                    }
                }
            }
        } else {
            return back();
        }

        return redirect(route('emprestimos.index'));
    }
    /**
     * Store a newly created resource in storage.
     */
    //Essa função não é mais precisa, pois sua lógica foi transferida para App\Livewire\TelaEmprestimos.php -> public function emprestar()
    // public function store(ValidacaoEmprestimo $request)
    // {
    //     if (!$request->itens) {
    //         return back()->withErrors(['nenhum-item-erro' => "Escolha um ou mais itens a serem emprestados"]);
    //     } else {
    //         $emprestimo = Emprestimo::create([
    //             'usuario_que_emprestou' => \App\Models\Session::first()->identificacao,
    //             'usuario_que_recebeu' => $request->usuario_que_recebeu,
    //         ]);

    //         try {
    //             $itens = $request->itens;
    //             for ($i = 0; $i < sizeof($itens); $i++) {
    //                 $emprestimo->itens()->attach($itens[$i]);
    //             }
    //             return redirect(route('emprestimos.index'));
    //         } catch (\Throwable $th) {
    //             $emprestimo->itens()->detach();
    //             $emprestimo->delete();
    //             return redirect(route('emprestimos.index'));
    //         }
    //     }
    // }
}
