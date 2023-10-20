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

                    <form id="form_id" class="form-horizontal" method="POST" action="{{ url('salvarChamado') }}" enctype="multipart/form-data">
                        
                        {{ csrf_field() }}

                        <div>
                            <h2 class="text-center amarelo">Abertura de Chamado</h2>
                        </div>

                        <div>
                            <label for="titulo"><span class="amarelo">Título do chamado</span></label>
                            <input {{!empty($dadosChamado) ?? 'readonly'}} id="titulo" type="text" class="form-control" name="titulo" value="{{old('titulo')}}" required autofocus placeholder="Insira o título do chamado">
                            @if ($errors->has('titulo'))
                                <strong class="branco"> {{ $errors->first('titulo') }}</strong>
                            @endif
                        </div>

                        <br>

                        <div>
                            <label for="descricao"><span class="amarelo">Descrição</span></label>
                            <textarea {{!empty($dadosChamado) ?? 'readonly'}} class="form-control" name="descricao" id="descricao" cols="30" rows="10" required>{{old('descricao')}}</textarea>
                            @if ($errors->has('descricao'))
                                <strong class="branco"> {{ $errors->first('descricao') }}</strong>
                            @endif
                        </div>

                        <br>

                        <div>
                            <label for="anexo"><span class="amarelo">Anexo</span></label>
                            <input {{!empty($dadosChamado) ?? 'readonly'}} id="anexo" name="anexo" type="file" class="form-control" value="{{old('anexo')}}" minlength="14" autofocus>
                            <input style="display: none" id="anexo_file" type="file" class="form-control" name="anexo_file" value="{{old('anexo')}}">
                            @if ($errors->has('anexo'))
                                <strong class="branco"> {{ $errors->first('anexo') }}</strong>
                            @endif
                        </div>

                        <br>

                        @if(!empty($dadosChamado))
                            <div>
                                <label for="status"><span class="amarelo">Status</span></label>
                                <input {{!empty($dadosChamado) ?? 'readonly'}} type="text" name="status" id="status" class="form-control" value="{{old('status')}}">
                            </div>

                            <br>

                            <div>
                                <label for="resposta"><span class="amarelo">Resposta</span></label>
                                <textarea {{!empty($dadosChamado) ?? 'readonly'}} class="form-control" name="resposta" id="resposta" cols="30" rows="10">{{old('resposta')}}</textarea>
                                @if ($errors->has('resposta'))
                                    <strong class="branco"> {{ $errors->first('resposta') }}</strong>
                                @endif
                            </div>

                        @endif

                        <br><br>

                        @if(!empty($dadosChamado))
                            <input hidden type="text" id="atualiza_chamado">
                            <div class="text-center">
                                <button type="submit" class="btn fundo_amarelo" onclick="$('#atualiza_chamdo').val('finaliza')">
                                    <span class="branco">Finalizar Chamado</span>
                                </button>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn fundo_amarelo" onclick="$('#atualiza_chamdo').val('atualiza')">
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

@endpush