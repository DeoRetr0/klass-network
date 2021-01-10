 <style>
        #atualizarPerfil{
            padding: 10px;
            background-color: var(--primary-color);
            width: fit-content;
            margin: 50px auto;
            color: white;
            font-family: 'Josefin Sans', sans-serif;
        }
        #atualizarPerfil h3{
            text-align: center;
        }
        #salvar{
            text-align: center;
        }
        #salvar a{
            color: #212121;
            width: fit-content;
            margin: 0;
        }
        #conteudoAtualizar{
            margin-top: 20px;
        }
    </style>
    <div id="atualizarPerfil">
        <h3>Atualize suas informações</h3>
        <div id="conteudoAtualizar" class="row">
            <div class="container">
                <div id="mudarImagens">
                    <form enctype="multipart/form-data" method="post" action="/mudarBanner" style="padding: 5px">
                        <label>Mudar Banner</label><br>
                        <input type="file" name="banner"><br>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="submit" class="btn-sm btn-primary" style="margin-top: 5px">
                    </form>
                    <form enctype="multipart/form-data" method="post" action="/mudarImagem" style="padding: 5px">
                        <label>Mudar Imagem de Perfil</label><br>
                        <input type="file" name="avatar"><br>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="submit" class="btn-sm btn-primary" style="margin-top: 5px">
                    </form>
                </div>
                <form class="form-vertical" method="POST" action="{{route('profile.edit')}}">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group {{$errors    ->has('nome')?'has-error':''}}">
                                <label for="nome" class="control-label">Nome:</label>
                                <input type="text" name="nome" class="form-control" id="nome" value="{{ Request::old('nome')?:Auth::user()->nome }}">
                                @if($errors->has('nome'))
                                    <span class="help-block">{{ $errors->first('nome') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group {{$errors->has('sobrenome')?'has-error':''}}">
                                <label for="sobrenome" class="control-label">Sobrenome:</label>
                                <input type="text" name="sobrenome" class="form-control" id="sobrenome" value="{{ Request::old('sobrenome')?:Auth::user()->sobrenome }}">
                                @if($errors->has('sobrenome'))
                                    <span class="help-block">{{ $errors->first('sobrenome') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="localizacao" class="control-label">Localização:</label>
                                <input type="text" name="localizacao" class="form-control" id="localizacao" value="{{ Request::old('localizacao')?:Auth::user()->localizacao }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="data_nascimento" class="control-label">Nasceu em:</label>
                                <input type="text" name="data_nascimento" class="form-control" id="nasceuEm" value="{{ Request::old('data_nascimento')?:Auth::user()->data_nascimento }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="relacionamento" class="control-label">Relacionamento:</label>
                                <select class="form-control" name="relacionamento">
                                    {{$rel = DB::table('relacionamento')->pluck('relacionamento')}}
                                    <option value="{{ Request::old('relacionamento')?:Auth::user()->relacionamento }}">{{ Request::old('relacionamento')?:Auth::user()->relacionamento }}</option>
                                    @foreach($rel as $relacionamento)
                                        <option value="{{$relacionamento}}">{{$relacionamento}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="trabalho" class="control-label">Trabalho:</label>
                                <input type="text" name="trabalho" class="form-control" id="trabalho" value="{{ Request::old('trabalho')?:Auth::user()->trabalho }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="faculdade" class="control-label">Faculdade:</label>
                                <select class="form-control" name="faculdade" id="ie">
                                    {{$fac = DB::table('faculdades')->pluck('faculdade')}}
                                    <option value="{{ Request::old('faculdade')?:Auth::user()->faculdade }}">{{ Request::old('faculdade')?:Auth::user()->faculdade }}</option>
                                    @foreach($fac as $faculdade)
                                        <option value="{{$faculdade}}">{{$faculdade}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="curso" class="control-label">Curso:</label>
                                <select class="form-control" name="curso" id="curso">
                                    {{$c = DB::table('cursos')->pluck('curso')}}
                                    <option value="{{ Request::old('curso')?:Auth::user()->curso }}">{{ Request::old('curso')?:Auth::user()->curso }}</option>
                                    @foreach($c as $cursos)
                                        <option value="{{$cursos}}">{{$cursos}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="sobre" class="control-label">Sobre:</label>
                            <textarea type="text" name="sobre" class="form-control" id="sobre">{{ Request::old('sobre')?:Auth::user()->sobre }}</textarea>
                        </div>
                    </div>
                    <div id="salvar" class="form-group">
                        <button type="submit" class="btn btn-light">Salvar</button>
                    </div>
                    <input type="hidden" name="_token" value="{{Session::token()}}">
                </form>
            </div>
        </div>
    </div>
