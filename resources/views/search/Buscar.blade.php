@extends('templates.default')

@section('conteudo')
    <style>
        h3{
            padding: 10px;
        }
        #resultados{
            margin: 10px;
        }
    </style>
    <h3>Resultados da busca para "{{ Request::input('query') }}"</h3>
    @if(!$users->count())
        <p>Não houve resultados.</p>
    @else
    <div id="resultados" class="row">
        <div class="col-12">
            @foreach($users as $user)
                @include('user/partials/userblock')
                <br>
            @endforeach
        </div>
    </div>
    @endif
@stop
