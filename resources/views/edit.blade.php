@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Venda</h1>
    <form action="{{ route('vendas.update', $venda->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="cliente">Cliente</label>
            <input type="text" name="cliente" id="cliente" class="form-control" value="{{ $venda->cliente }}">
        </div>

        <h3>Itens</h3>
        <div id="items">
            @foreach($venda->items as $index => $item)
            <div class="item">
                <div class="form-row align-items-end">
                    <div class="col">
                        <label for="produto">Produto</label>
                        <input type="text" name="items[{{ $index }}][produto]" class="form-control" value="{{ $item->produto }}">
                    </div>
                    <div class="col">
                        <label for="quantidade">Quantidade</label>
                        <input type="number" name="items[{{ $index }}][quantidade]" class="form-control" value="{{ $item->quantidade }}">
                    </div>
                    <div class="col">
                        <label for="preco">Preço</label>
                        <input type="number" step="0.01" name="items[{{ $index }}][preco]" class="form-control" value="{{ $item->preco }}">
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-danger remove-item">Rem
