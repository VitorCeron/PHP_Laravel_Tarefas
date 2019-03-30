<!-- create.blade.php -->

@extends('layouts.app')

@section('content')

    <div class="container pl-0 pr-0 mt-3">
        <h4 class="mt-2">Adicionar uma Tarefa</h4>
        <hr>
    </div>

    @if ($errors->any())

    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div><br />

    @endif

    <form method="post" action="{{ route('tarefas.store') }}">
        <div class="form-group">
            @csrf
            <label for="tituloTarefa">Titulo Tarefa</label>
            <input type="text" class="form-control form-control-sm" name="tituloTarefa" id="tituloTarefa"/>
        </div>
        <div class="form-group">
            <label for="descricaoTarefa">Descrição da Tarefa</label>
            <input type="text" class="form-control form-control-sm" name="descricaoTarefa" id="descricaoTarefa"/>
        </div>
        <button type="reset" class="btn btn-warning"><i class="fas fa-trash"></i> Limpar</button>
        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Salvar Tarefa</button>
    </form>

@endsection
