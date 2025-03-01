<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Picqer\Barcode\BarcodeGeneratorHTML;
use Picqer\Barcode\BarcodeGeneratorPNG;

class CodigoBarrasController extends Controller
{
    /**
     * Muestra el formulario para ingresar el código.
     */
    public function index()
    {
        return view('codigo_barras.index');
    }

    /**
     * Genera el código de barras en diferentes formatos.
     */
    public function generar(Request $request)
    {
        // Validar el código ingresado
        $request->validate([
            'codigo' => 'required|string|max:255',
        ]);

        $codigo = $request->input('codigo');

        // Generar código de barras en formato HTML
        $generatorHTML = new BarcodeGeneratorHTML();
        $codigoBarrasHTML = $generatorHTML->getBarcode($codigo, $generatorHTML::TYPE_CODE_128);

        // Generar código de barras en formato PNG
        $generatorPNG = new BarcodeGeneratorPNG();
        $codigoBarrasPNG = base64_encode($generatorPNG->getBarcode($codigo, $generatorPNG::TYPE_CODE_128));

        return view('codigo_barras.mostrar', compact('codigoBarrasHTML', 'codigoBarrasPNG', 'codigo'));
    }
}
