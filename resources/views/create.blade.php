@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nova Venda</h1>
    <form action="{{ route('vendas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="cliente">Cliente</label>
            <input type="text" name="cliente" id="cliente" class="form-control">
        </div>

        <h3>Itens</h3>
        <div id="items">
            <div class="item">
                <div class="form-row align-items-end">
                    <div class="col">
                        <label for="produto">Produto</label>
                        <input type="text" name="items[0][produto]" class="form-control">
                    </div>
                    <div class="col">
                        <label for="quantidade">Quantidade</label>
                        <input type="number" name="items[0][quantidade]" class="form-control">
                    </div>
                    <div class="col">
                        <label for="preco">Preço</label>
                        <input type="number" step="0.01" name="items[0][preco]" class="form-control">
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-danger remove-item">Remover</button>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-secondary" id="add-item">Adicionar Item</button>

        <h3>Parcelas</h3>
        <div id="parcelas">
            <div class="parcela">
                <div class="form-row align-items-end">
                    <div class="col">
                        <label for="valor">Valor</label>
                        <input type="number" step="0.01" name="parcelas[0][valor]" class="form-control">
                    </div>
                    <div class="col">
                        <label for="data_vencimento">Data de Vencimento</label>
                        <input type="date" name="parcelas[0][data_vencimento]" class="form-control">
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-danger remove-parcela">Remover</button>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-secondary" id="add-parcela">Adicionar Parcela</button>

        <button type="submit" class="btn btn-primary mt-3">Salvar</button>
    </form>
</div>

<script>
    document.getElementById('add-item').addEventListener('click', function () {
        let itemsDiv = document.getElementById('items');
        let itemIndex = itemsDiv.children.length;
        let itemDiv = document.createElement('div');
        itemDiv.className = 'item';
        itemDiv.innerHTML = `
            <div class="form-row align-items-end mt-3">
                <div class="col">
                    <label for="produto">Produto</label>
                    <input type="text" name="items[${itemIndex}][produto]" class="form-control">
                </div>
                <div class="col">
                    <label for="quantidade">Quantidade</label>
                    <input type="number" name="items[${itemIndex}][quantidade]" class="form-control">
                </div>
                <div class="col">
                    <label for="preco">Preço</label>
                    <input type="number" step="0.01" name="items[${itemIndex}
