@extends('layout.app')

@push('style')

@endpush

@section('conteudo')
<title>Cadastro</title>

<div class="container" style="margin-top:10%">
    <div class="row">
        <div class="col-md-5 center-block">
            <div class="panel panel-default panel-transparent">

                <div class="panel-body">
                    @if (Session::has('mensagem_sucesso'))
                        <div id="message" class="alert alert-success">
                            {{ Session::get('mensagem_sucesso') }}
                        </div>
                    @endif
                    @if (Session::has('mensagem_aviso'))
                        <div id="message" class="alert alert-warning">
                            {{ Session::get('mensagem_aviso') }}
                        </div>
                    @endif

                    <form id="form_id" class="form-horizontal" method="POST" action="{{ url('cadastro/novoUsuario') }}">
                        
                        {{ csrf_field() }}
                        <div>
                            <label for="name"><span class="amarelo">Nome Completo</span></label>
                            <input id="name" type="text" class="form-control" name="name" value="{{old('name')}}" required autofocus placeholder="Insira o nome completo">
                            @if ($errors->has('name'))
                                <strong class="branco"> {{ $errors->first('name') }}</strong>
                            @endif
                        </div>

                        <br>

                        <div>
                            <label for="email"><span class="amarelo">E-mail</span></label>
                            <input id="email" type="email" class="form-control" name="email" value="{{old('email')}}" required autofocus placeholder="Insira o e-mail">
                            @if ($errors->has('email'))
                                <strong class="branco"> {{ $errors->first('email') }}</strong>
                            @endif
                        </div>

                        <br>

                        <div>
                            <label for="cpf"><span class="amarelo">CPF</span></label>
                            <input id="cpf" type="text" class="form-control" name="cpf" value="{{old('cpf')}}" minlength="14" required autofocus placeholder="Insira o CPF">
                            @if ($errors->has('cpf'))
                                <strong class="branco"> {{ $errors->first('cpf') }}</strong>
                            @endif
                        </div>

                        <br>

                        <div>
                            <label for="tipo_usuario"><span class="amarelo">Tipo do Usuário</span></label>
                            <select name="tipo_usuario" id="tipo_usuario" class="form-control" required>
                                <option value=""></option>
                                <option value="cliente" {{old('tipo_usuario') == 'cliente' ? 'selected' : ''}}>Cliente</option>
                                <option value="colaborador" {{old('tipo_usuario') == 'colaborador' ? 'selected' : ''}}>Colaborador</option>
                            </select>
                            @if ($errors->has('tipo_usuario'))
                                <strong class="branco"> {{ $errors->first('tipo_usuario') }}</strong>
                            @endif
                        </div>

                        <br>

                        <div>
                            <label for="password"><span class="amarelo">Senha</span></label>
                            <input id="password" type="password" class="form-control" value="{{old('password')}}" name="password" required placeholder="Insira a senha">
                            @if ($errors->has('password'))
                                <strong class="branco"> {{ $errors->first('password') }}</strong>
                            @endif
                        </div>

                        <br>

                        <div>
                            <label for="password_repeat"><span class="amarelo">Repita a Senha</span></label>
                            <input id="password_repeat" type="password" class="form-control" value="{{old('password_repeat')}}" name="password_repeat" required placeholder="Repita a senha">
                            @if ($errors->has('password'))
                                <strong class="branco"> {{ $errors->first('password_repeat') }}</strong>
                            @endif
                        </div>

                        <br><br>

                        <div class="form-group center-block">

                            <div class="col-md-6 col-md-offset-5">
                                <button type="submit" id="buttonLogin" class="btn fundo_amarelo">
                                    <span class="branco">Criar</span>
                                </button>
                            </div>

                            <div class="row col-md-12">
                                <a class="pull-right amarelo" href="{{url('login')}}">
                                    Voltar
                                </a>
                            </div>

                        </div>

                    </form>
                    
                </div>

            </div>
        </div>
    </div>
</div>
    
@endsection

@push('scripts')

    <script>

        $(document).ready(function(){
            $('#cpf').mask('000.000.000-00', {reverse: true});
        });

        /* $('#buttonLogin').on('click', function(){
            let senha = $('#password').val();
            let senhaRepeat = $('#password_repeat').val();

            if(senha !== senhaRepeat && senhaRepeat != '' && senha != ''){
                $('#password_repeat_aviso').text('As senhas não se coincidem.');
                setTimeout(() => {
                    $('#password_repeat_aviso').text('');
                }, 5000);
            } else {
                let name = $('#name').val();
                let email = $('#email').val();
                let cpf = $('#cpf').val();
                let tipo_usuario = $('#tipo_usuario').val();
                if(name != '' && email != '' && cpf != '' && tipo_usuario != ''){
                    $('#form_id').submit();
                }
            }
        }); */

    </script>

@endpush