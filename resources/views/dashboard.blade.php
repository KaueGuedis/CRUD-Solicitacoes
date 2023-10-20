@extends('layout.app')

@push('style')

    <style>
        .panel-transparent {
            background: none;
        }

        .panel-transparent .panel-body{
            background: #2D2D37;
        }

        .center-block {
            float: none !important;
        }

        .branco {
            color: #FAFAFA !important;
        }

        .amarelo {
            color: #FFC500 !important;
        }
        
        .fundo_amarelo {
            background-color: #FFC500 !important;
        }
    </style>

@endpush

@section('conteudo')
<title>Chamados</title>

<div class="container" style="margin-top:15%">
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

                    <form id="form_id" class="form-horizontal" method="POST" action="{{ url('login') }}">
                        
                        {{ csrf_field() }}
                        <div>
                            <label for="email"><span class="amarelo">Login</span></label>
                            <input id="email" type="email" class="form-control" name="email" value="{{old('email')}}" required autofocus placeholder="Insira o e-mail">
                            @if ($errors->has('email'))
                                <strong class="branco"> {{ $errors->first('email') }}</strong>
                            @endif
                        </div>

                        <br>

                        <div>
                            <label for="password"><span class="amarelo">Senha</span></label>
                            <input id="password" type="password" class="form-control" name="password" required placeholder="Insira a senha">
                            @if ($errors->has('password'))
                                <strong class="branco"> {{ $errors->first('password') }}</strong>
                            @endif
                        </div>

                        <br><br>

                        <div class="form-group center-block">

                            <div class="col-md-6 col-md-offset-5">
                                <button type="submit" id="buttonLogin" class="btn fundo_amarelo">
                                    <span class="branco">Login</span>
                                </button>
                                <br>
                            </div>

                            <div class="row col-md-12">
                                <a class="pull-right amarelo" href="{{url('novoUsuario')}}">
                                    Novo usuário
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

        

    </script>

@endpush