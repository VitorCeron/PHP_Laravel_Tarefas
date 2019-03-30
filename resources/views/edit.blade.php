<!-- edit.blade.php -->

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

    <form method="post" action="{{ route('tarefas.update', $tarefa->id) }}">
        <div class="form-group">
            @csrf
            @method('PATCH')
            <label for="tituloTarefa">Titulo Tarefa</label>
            <input type="text" class="form-control form-control-sm" name="tituloTarefa" id="tituloTarefa" value="{{$tarefa->tituloTarefa}}"/>
        </div>
        <div class="form-group">
            <label for="descricaoTarefa">Descrição da Tarefa</label>
            <input type="text" class="form-control form-control-sm" name="descricaoTarefa" id="descricaoTarefa" value="{{$tarefa->descricaoTarefa}}"/>
        </div>
        <button type="reset" class="btn btn-warning"><i class="fas fa-trash"></i> Limpar</button>
        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Atualizar Tarefa</button>
    </form>
@endsection
