<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\ItemVenda;
use App\Models\Parcela;
use Illuminate\Http\Request;
use PDF;

class VendaController extends Controller
{
    public function index(Request $request)
    {
        $vendas = Venda::with('items', 'parcelas')
            ->where('user_id', auth()->id())
            ->filter($request->all())
            ->get();

        return view('vendas.index', compact('vendas'));
    }

    public function create()
    {
        return view('vendas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cliente' => 'nullable|string',
            'items' => 'required|array',
            'items.*.produto' => 'required|string',
            'items.*.quantidade' => 'required|integer',
            'items.*.preco' => 'required|numeric',
            'parcelas' => 'required|array',
            'parcelas.*.valor' => 'required|numeric',
            'parcelas.*.data_vencimento' => 'required|date',
        ]);

        $venda = Venda::create([
            'user_id' => auth()->id(),
            'cliente' => $data['cliente'],
            'total' => array_reduce($data['items'], function ($carry, $item) {
                return $carry + $item['quantidade'] * $item['preco'];
            }, 0),
        ]);

        foreach ($data['items'] as $item) {
            ItemVenda::create([
                'venda_id' => $venda->id,
                'produto' => $item['produto'],
                'quantidade' => $item['quantidade'],
                'preco' => $item['preco'],
            ]);
        }

        foreach ($data['parcelas'] as $parcela) {
            Parcela::create([
                'venda_id' => $venda->id,
                'valor' => $parcela['valor'],
                'data_vencimento' => $parcela['data_vencimento'],
            ]);
        }

        return redirect()->route('vendas.index');
    }

    public function edit(Venda $venda)
    {
        $this->authorize('update', $venda);
        return view('vendas.edit', compact('venda'));
    }

    public function update(Request $request, Venda $venda)
    {
        $this->authorize('update', $venda);

        // Similar to store method for updating

        return redirect()->route('vendas.index');
    }

    public function destroy(Venda $venda)
    {
        $this->authorize('delete', $venda);
        $venda->delete();

        return redirect()->route('vendas.index');
    }

    public function generatePDF(Venda $venda)
    {
        $pdf = PDF::loadView('vendas.pdf', compact('venda'));
        return $pdf->download('venda_' . $venda->id . '.pdf');
    }
}

