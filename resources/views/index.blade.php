@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Vendas</h1>
    <a href="{{ route('vendas.create') }}" class="btn btn-primary mb-3">Nova Venda</a>

    <!-- Filtros -->
    <form method="GET" action="{{ route('vendas.index') }}" class="mb-3">
        <div class="form-row align-items-end">
            <div class="col">
                <label for="cliente">Cliente</label>
                <input type="text" name="cliente" id="cliente" class="form-control" value="{{ request('cliente') }}">
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
    </form>

    <!-- Listagem de Vendas -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vendas as $venda)
            <tr>
                <td>{{ $venda->id }}</td>
                <td>{{ $venda->cliente }}</td>
                <td>{{ $venda->total }}</td>
                <td>
                    <a href="{{ route('vendas.edit', $venda->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('vendas.destroy', $venda->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                    </form>
                    <a href="{{ route('vendas.pdf', $venda->id) }}" class="btn btn-info btn-sm">PDF</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
