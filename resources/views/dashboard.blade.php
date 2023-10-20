@extends('layout.app')

@push('style')

@endpush

@section('conteudo')
<title>Chamados</title>

<div class="container" style="margin-top: 2%">
    <div class="row">
        <div class="col-md-12 center-block">
            <div class="panel panel-default panel-transparent">

                <div class="panel-body">

                    @if(!empty($erro))
                        <div id="message" class="alert alert-warning">
                            {{ $erro }}
                        </div>
                    @elseif(!empty($sucesso))
                        <div id="message" class="alert alert-success">
                            {{ $sucesso }}
                        </div>
                    @endif

                    @if($usuarioLogado->tipo_usuario == 'cliente')
                        <div>
                            <a class="btn fundo_amarelo pull-right" href="{{url('novoChamado')}}"><span class="branco">Criar Chamado</span></a>
                        </div>

                        <br><br>
                    @endif

                    <div>
                        <table id="tabela_chamados" class="fundo_branco" data-pagination="true" data-search="true" data-toolbar=".toolbar" data-show-refresh="true">
                            <thead>
                                <tr>
                                    <th data-visible="false" data-field="id" data-sortable="true">ID</th>
                                    <th data-field="titulo" data-sortable="true">Título do Chamado</th>
                                    <th data-field="status" data-sortable="true">Status</th>
                                    <th data-field="criacao" data-sortable="true" data-formatter="transDataBR">Data/Hora criação</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <br><br>

                    <div class="form-group center-block">

                        <div class="row col-md-12">
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

        $(document).ready(function(){
            $('#tabela_chamados').bootstrapTable({
                url: "{{url('listagemChamados')}}",
                pagination:true,
                showRefresh: true,
                sidePagination:"server",
                method: 'get',
                cache:false,
                onClickRow: function(row, $element, field){
                    var url = "{{url('visualizarChamado')}}/"+row.id;
                    window.location.replace(url);
                },
                queryParams: function (p) {
                    return {
                        params:p
                    };
                },
            });
        });

        function transDataBR(data) {

            if (data) {
                data = data.split(' ');
                var hora = data[1];
                data = data[0].split('-');
                data = data[2]+'/'+data[1]+'/'+data[0];
                var dataHora = data + ' ' + hora;
                return dataHora;
            }
        }

    </script>

@endpush