<!-- index.blade.php -->

@extends('layouts.app')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="uper">
        @if(session()->get('success'))
            <div class="alert alert-success mt-2 alert-dismissible fade show" role="alert">
                {{ session()->get('success') }}

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div><br />
        @endif

        <div class="container pl-0 pr-0 mt-2">
            <div class="clearfix">
                <div class="col-md-4 float-left">
                    <h4 class="mt-2">Lista de Tarefas</h4>
                </div>

                <div class="col-md-8 float-right mr-0">
                    <div class="form-group form-inline  float-right">
                        <form>
                            <input type="text" class="form-control form-control-sm" id="tituloTarefa" name="tituloTarefa" value="{{ isset($tituloTarefa) ? $tituloTarefa : ''}}" placeholder="Pesquise uma tarefa"/>
                            <button type="submit" href="{{ route('tarefas.index') }}" class="btn btn-primary mr-2 btn-sm"><i class="fas fa-search"></i> Pesquisar</button>
                        </form>
                        <a href="{{ route('tarefas.create') }}" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Nova Tarefa</a>
                    </div>

                </div>
            </div>
        </div>

        <table class="table table-striped table-sm mt-1">
            <thead>
            <tr>
                <td>Id</td>
                <td>Titulo</td>
                <td>Descricao</td>
                <td colspan="2" width="15%">Ações</td>
            </tr>
            </thead>
            <tbody>
            @foreach($tarefas as $tarefa)
                <tr>
                    <td>{{$tarefa->id}}</td>
                    <td>{{$tarefa->tituloTarefa}}</td>
                    <td>{{$tarefa->descricaoTarefa}}</td>
                    <td><a href="{{ route('tarefas.edit', $tarefa->id)}}" class="btn btn-primary btn-sm"><i class="far fa-edit"></i> Editar</a></td>
                    <td>
                        <form action="{{ route('tarefas.destroy', $tarefa->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit"><i class="fas fa-times"></i> Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
            <div class="d-flex justify-content-center">
                {{ $tarefas->appends(['tituloTarefa' => isset($tituloTarefa) ? $tituloTarefa : ''])->links() }}
            </div>
        <div>
@endsection
