<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tarefas;
use App\User;
use Auth;

class TarefasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {

        $tituloTarefa = ''; //precisa criar a variável name para retornar algo para a view, mesmo que ela esteja vazio a view espera o retorno
        //verifica se o formulario de filtro foi preenchido, se sim a view renderiza os dados de acordo com a pesquisa
        if($request->tituloTarefa != null){
            $tituloTarefa = $request->tituloTarefa;
            $tarefas = Tarefas::where('idUser', '=', Auth::user()->id)->where('tituloTarefa','LIKE', '%'.$tituloTarefa.'%')->orderBy('id')->paginate(10);
        } else {
            $tarefas = Tarefas::where('idUser', '=', Auth::user()->id)->orderBy('id')->paginate(10);
        }
        return view('index', compact('tarefas'))->with('tituloTarefa', $tituloTarefa);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'tituloTarefa' => 'required|max:255',
            'descricaoTarefa' => 'required'
        ]);

        Tarefas::create([
            'tituloTarefa' => $request['tituloTarefa'],
            'descricaoTarefa' => $request['descricaoTarefa'],
            'idUser' => Auth::user()->id
        ]);

        return redirect('/tarefas')->with('success', 'Tarefa cadastrada com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $idTarefa
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $tarefa = Tarefas::findOrFail($id);

        return view('edit', compact('tarefa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $validatedData = $request->validate([
            'tituloTarefa' => 'required|max:255',
            'descricaoTarefa' => 'required'
        ]);
        Tarefas::whereId($id)->update($validatedData);

        return redirect('/tarefas')->with('success', 'Tarefa atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $tarefas = Tarefas::findOrFail($id);
        $tarefas->delete();

        return redirect('/tarefas')->with('success', 'Tarefa excluída com sucesso');
    }
}
