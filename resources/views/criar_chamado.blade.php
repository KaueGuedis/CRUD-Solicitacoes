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

                    <div>
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

@endpush