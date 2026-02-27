<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GastoController extends Controller
{
    public function index(Request $request)
    {
        $gastos = session()->get('gastos', []);
        $total = array_sum(array_column($gastos, 'monto'));

        return view('gastos', compact('gastos', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string',
            'monto' => 'required|numeric|min:0'
        ]);

        $gastos = session()->get('gastos', []);

        // 🔹 Gasto con fecha
        $gastos[] = [
            'descripcion' => $request->descripcion,
            'monto' => $request->monto,
            'fecha' => now()->format('Y-m-d')
        ];

        session()->put('gastos', $gastos);

        return redirect()->route('gastos.index');
    }
}


