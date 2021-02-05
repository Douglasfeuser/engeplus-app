@extends('vendas.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Engeplus Listagem de vendas</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('vendas.create') }}"> Criar nova venda</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>N#</th>
            <th>Nome</th>
            <th>Detalhe</th>
            <th width="280px">Ações</th>
        </tr>
        @foreach ($vendas as $product)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->detail }}</td>
            <td>
                <form action="{{ route('vendas.destroy',$product->id) }}" method="POST">

                    <a class="btn btn-info" href="{{ route('vendas.show',$product->id) }}">Ver</a>

                    <a class="btn btn-primary" href="{{ route('vendas.edit',$product->id) }}">Editar</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Exluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {!! $vendas->links() !!}

@endsection
