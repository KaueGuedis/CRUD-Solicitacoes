@extends('layout.app')

@push('style')

@endpush

@section('conteudo')
<title>Login</title>

<div class="container" style="margin-top:15%">
    <div class="row">
        <div class="col-md-5 center-block">
            <div class="panel panel-default panel-transparent">

                <div class="panel-body">

                    <div id="message"></div>

                    <form id="form_id" class="form-horizontal" method="POST" action="{{ url('authenticate') }}">
                        
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

        $(document).ready(function(){

            @if (Session::has('mensagem_sucesso'))
                $('#message').addClass('alert alert-success');
                $('#message').text("{{Session::get('mensagem_sucesso')}}");
                @php
                    Session()->forget('mensagem_sucesso');
                @endphp
            @endif

            @if (Session::has('mensagem_aviso'))
                $('#message').addClass('alert alert-success');
                $('#message').text("{{Session::get('mensagem_aviso')}}");
                @php
                    Session()->forget('mensagem_aviso');
                @endphp
            @endif

            setTimeout(() => {
                $('#message').removeClass();
                $('#message').text("");
            }, 5000);

        });

    </script>

@endpush