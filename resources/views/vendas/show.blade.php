@extends('vendas.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Ver venda</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('vendas.index') }}"> Voltar</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nome:</strong>
                {{ $venda->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Detalhe:</strong>
                {{ $venda->detail }}
            </div>
        </div>
    </div>
@endsection
