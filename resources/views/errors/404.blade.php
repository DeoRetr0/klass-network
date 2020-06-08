@extends('templates.default')

@section('conteudo')
    <div id="404" style="margin-top: 100px">
        <h3>Oops! Não achei essa página :/</h3>
        <a style="color: var(--primaryText-color);" href="{{route('home')}}">Voltar</a>
    </div>
@stop
