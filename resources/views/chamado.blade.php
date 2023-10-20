@extends('layout.app')

@push('style')

@endpush

@section('conteudo')
<title>Criar chamado</title>

<div class="container" style="margin-top: 2%">
    <div class="row">
        <div class="col-md-12 center-block">
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

                    @if(empty($dadosChamado))
                        <form id="form_id" class="form-horizontal" method="POST" action="{{ url('salvarChamado') }}" enctype="multipart/form-data">
                    @else
                        <input type="text" hidden name="id" value="{{$dadosChamado['id']}}">
                        <form id="form_id" class="form-horizontal" method="POST" action="{{ url('atualizaChamado') }}" enctype="multipart/form-data">
                    @endif
                        
                        {{ csrf_field() }}

                        <div>
                            <h2 class="text-center amarelo">Abertura de Chamado</h2>
                        </div>

                        <div>
                            <label for="titulo"><span class="amarelo">Título do chamado</span></label>
                            <input {{!empty($dadosChamado['titulo']) ? 'readonly' : ''}} id="titulo" type="text" class="form-control" name="titulo" value="{{old('titulo') ?? $dadosChamado['titulo'] ?? ''}}" required autofocus placeholder="Insira o título do chamado">
                            @if ($errors->has('titulo'))
                                <strong class="branco"> {{ $errors->first('titulo') }}</strong>
                            @endif
                        </div>

                        <br>

                        <div>
                            <label for="descricao"><span class="amarelo">Descrição</span></label>
                            <textarea {{!empty($dadosChamado['descricao']) ? 'readonly' : ''}} class="form-control" name="descricao" id="descricao" cols="30" rows="10" required>{{old('descricao') ?? $dadosChamado['descricao'] ?? ''}}</textarea>
                            @if ($errors->has('descricao'))
                                <strong class="branco"> {{ $errors->first('descricao') }}</strong>
                            @endif
                        </div>

                        <br>

                        <div>
                            @if(!empty($dadosChamado['anexo']))
                                <a class="btn btn-primary" href="{{url('baixarArquivo?anexo='.$dadosChamado['anexo'])}}">Baixar Arquivo</a>
                            @else
                                <label for="anexo"><span class="amarelo">Anexo</span></label>
                                <input {{!empty($dadosChamado) ? 'disabled' : ''}} id="anexo" name="anexo" type="file" class="form-control" value="{{old('anexo')}}" autofocus>
                            @endif
                            @if ($errors->has('anexo'))
                                <strong class="branco"> {{ $errors->first('anexo') }}</strong>
                            @endif
                        </div>

                        <br>

                        @if(!empty($dadosChamado))
                            <div>
                                <label for="status"><span class="amarelo">Status</span></label>
                                <input readonly type="text" name="status" id="status" class="form-control" value="{{$dadosChamado['status']}}">
                            </div>

                            <br>

                            <div>
                                <label for="resposta"><span class="amarelo">Resposta</span></label>
                                <textarea {{empty($dadosChamado['resposta']) || $dadosChamado['resposta'] != 'Finalizado' ? '' : 'readonly'}} class="form-control" name="resposta" id="resposta" cols="30" rows="10" required>{{old('resposta') ?? $dadosChamado['resposta'] ?? ''}}</textarea>
                                @if ($errors->has('resposta'))
                                    <strong class="branco"> {{ $errors->first('resposta') }}</strong>
                                @endif
                            </div>

                        @endif

                        <br><br>

                        @if(!empty($dadosChamado))
                            <input hidden type="text" id="atualiza_chamado" name="atualiza_chamado">
                            <div class="text-center">
                                <button type="button" class="btn fundo_amarelo" onclick="enviaFormulario('Finalizado')">
                                    <span class="branco">Finalizar Chamado</span>
                                </button>

                                <button type="button" class="btn fundo_amarelo" onclick="enviaFormulario('Em atendimento')">
                                    <span class="branco">Atualizar Chamado</span>
                                </button>
                            </div>
                        @else
                            <div class="text-center">
                                <button type="submit" class="btn fundo_amarelo">
                                    <span class="branco">Criar Chamado</span>
                                </button>
                            </div>
                        @endif

                    </form>

                    <div class="form-group center-block">

                        <div class="row col-md-12">
                            <a class="pull-left amarelo" href="{{url('dashboard')}}">
                                Voltar
                            </a>

                            <a class="pull-right amarelo" href="{{url('logout')}}">
                                Logout
                            </a>
                        </div>

                    </div>
                    
                </div>

            </div>
        </div>
    </div>
</div>
    
@endsection

@push('scripts')

<script>

    function enviaFormulario(status) {
        $('#atualiza_chamado').val(status);
        $('#form_id').submit();
    }

</script>

@endpush