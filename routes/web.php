<?php

use App\Http\Controllers\ArquivoController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\LocalController;
use App\Models\Categoria;
use App\Models\Material;
use Illuminate\Support\Facades\Route;
use App\Models\Session;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::name('em-producao')
    ->get(
        '/em-producao',
        function () {
            return view('inproduction');
        }
    );

// GuestMiddleware desativado temporariamente porque estava entrando em loop de redirecionamento
// Route::middleware(['GuestMiddleware'])
//     ->group(function () {
Route::name('home')
    ->get('/', function () {
        return view('welcome');
    });
// });

# TODO: Mudar para /login-view
Route::name('login.')
    ->group(
        function () {
            Route::name('view')
                ->get('/authorization-view', function () {
                    return view('authorization-view');
                });

            Route::name('callback')
                ->post(
                    '/authorization-callback',
                    function (Request $request) {
                        if (!Session::first()) {
                            $res = Http::withUrlParameters([
                                'scope' => 'identificacao'
                            ])
                                ->withToken($request->suap_token)
                                ->acceptJson()
                                ->get(config('suap.uri_eu'));

                            Session::create([
                                'nome_usual' => $res['nome_usual'],
                                'identificacao' => $res['identificacao'],
                                'campus' => $res['campus'],
                                'email' => $res['email'],
                                'sexo' => $res['sexo'],
                                'cpf' => $res['cpf'],
                                'foto' => $res['foto'],
                                'data_de_nascimento' => $res['data_de_nascimento'],
                                'email_academico' => $res['email_academico'],
                                'email_google_classroom' => $res['email_google_classroom'],
                                'email_preferencial' => $res['email_preferencial'],
                                'email_secundario' => $res['email_secundario'],
                                'nome' => $res['nome'],
                                'nome_registro' => $res['nome_registro'],
                                'nome_social' => $res['nome_social'],
                                'primeiro_nome' => $res['primeiro_nome'],
                                'tipo_usuario' => $res['tipo_usuario'],
                                'ultimo_nome' => $res['ultimo_nome'],
                            ]);
                            return response($res)->cookie('suapToken', $request->suap_token);
                        } else {
                            return redirect(route('painel'));
                        }
                    }
                );
        }
    );


Route::middleware(['suapToken'])
    ->group(function () { //middleware de proteção
        Route::name('painel')
            ->get('/painel', function () {
                /* 
            Esta rota esta renderizando o painel principal (dashboard)
            */

                /* Pegandos todas as categorias salvas no sistema*/
                $categorias = Categoria::orderBy('nome', 'asc')->get();

                /* Pegandos todos os materiais salvos no sistema*/
                $materiais = Material::orderBy('nome', 'asc')->get();

                return view('painel', [
                    'categorias' => $categorias,
                    'materiais' => $materiais
                ]);
            });

        Route::name('materiais.')
            ->controller(MaterialController::class)
            ->prefix('/materiais')
            ->group(function () {
                Route::name('novo')->get('/novo', 'create');
                Route::name('salvar')->post('', 'store');

                Route::name('destroy')->get('/deletar/{material}', 'destroy');

                Route::name('index')->get('', 'index');

                # TODO: Deveria ser PUT para alterar
                Route::name('atualizar')->post('/{material}', 'update');

                Route::name('editar')->get('/{material}/editar', 'edit');
            });


        // TODO: Retirar do grupo que usa SUAP, pois não precisa estar logado para tentar fazer logout.
        Route::name('logout')
            ->get('/logout', function (Request $request) {
                unset($_COOKIE['suapToken']);
                unset($_COOKIE['suapTokenExpirationTime']);
                unset($_COOKIE['suapScope']);

                setcookie('suapToken', null, -1);
                setcookie('suapTokenExpirationTime', null, -1);
                setcookie('suapScope', $request->scope, null, -1);

                try {
                    Session::first()->delete();
                    return redirect(url('/'));
                } catch (\Throwable $th) {
                    return redirect(url('/'));
                }
            });

        Route::name('itens.')
            ->prefix('/itens')
            ->controller(ItemController::class)
            ->group(function () {

                /*
                    Rotas para o controlador de Item.
                */
                Route::name('index')->get('', 'index');

                /*Esta rota está retornando a view onde mostra o formulário para cadastrar um novo item*/
                Route::name('novo')->get('/novo', 'create');

                Route::name('store')->post('', 'store');

                /*Esta rota está levando para a função vai processar o empréstimo do item*/
                Route::name('alugar')->get('/alugar', 'alugar');

                /*Esta rota está retornando a view onde mostra o formulário para editar um item*/
                Route::name('editar')->get('/editar/{item}', 'edit');

                /*Esta rota está retornando a página que lista os items que estão alugados*/
                Route::name('alugados')->get('/alugados', 'alugados');

                # TODO: Deveria ser um PUT.
                Route::name('update')->post('/{item}', 'update');

                Route::name('deletar')->get('/deletar/{item}', 'destroy');

                /*Esta rota está levando para a função que processa a devolução do item*/
                Route::name('devolver')->get('/devolver', 'devolver');
            });


        /**
         * Rotas relacionadas a Categorias.
         */
        Route::name('categorias.')
            ->prefix('/categorias')
            ->controller(CategoriaController::class)
            ->group(function () {
                /*Esta rota está retornando a view index com uma lista de objetos da tabela categorias*/
                Route::name('index')->get('', 'index');

                /*Esta rota leva ao armazenamento de uma nova categoria*/
                Route::name('store')->post('', 'store');

                /*Esta rota está retornando a view create*/
                Route::name('create')->get('/nova', 'create');

                /*Esta rota serve para atualizar um objeto no banco, ela recebe um parâmetro que servirá para identifcar o objeto no banco*/
                Route::name('atualizar')->patch('/{categoria}', 'update');

                /*Esta rota está retornando a view edit, ela está recebendo um parâmetro que serve para identificar o objeto no banco*/
                Route::name('editar')->get('/{categoria}/editar', 'edit');

                /*Esta rota está serve para deletar um objeto do banco, ela recebe um parâmetro para identifcar o obejto no banco*/
                # TODO: Deveria ser uma requisição DELETE
                Route::name('delete')->get('/deletar/{categoria}', 'delete');
            });


        Route::name('emprestimos.')
            ->prefix('/emprestimos')
            ->controller(EmprestimoController::class)
            ->group(function () {
                Route::name('create')->get('/novo', 'create');
                Route::name('store')->post('/store', 'store');
                Route::name('index')->get('/todos', 'index');
                Route::name('itens')->get('/{emprestimo}/itens', 'itens');
                Route::name('devolver')->post('/{emprestimo}', 'devolver');
            });


        Route::name('locais.')
            ->prefix('/locais')
            ->controller(LocalController::class)->group(function () {
                Route::get('', 'index');
                Route::name('novo')->get('/novo', 'create');
                Route::name('salvar')->post('', 'store');
                Route::name('delete')->get('/deletar/{local}', 'destroy');
                Route::name('editar')->get('/{local}/edit', 'edit');
                Route::name('update')->post('/{local}', 'update');
            });

        Route::name('arquivos.')
            ->prefix('/arquivos')
            ->controller(ArquivoController::class)->group(function () {
                Route::name('apagar')->get('/apagar/{arquivo}', 'destroy');
            });
    });
