@extends('templates.default')

@section('conteudo')
    <style>
        #resultados{
            margin-top: 50px;
        }
        h3{
            padding: 10px;
        }
    </style>
    <div id="resultados">
        <h3>Resultados da busca para "{{ Request::input('query') }}"</h3>
        @if(!$users->count())
            <p>Não houve resultados.</p>
        @else
            <div class="row">
                <div class="col-12">
                    @foreach($users as $user)
                        @include('user/partials/userblock')
                        <br>
                    @endforeach
                </div>
            </div>
    </div>
    @endif
@stop
