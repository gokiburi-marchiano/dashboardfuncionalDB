<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SolicitudController extends Controller
{
    public function index()
    {
        $solicitudes = Solicitud::where('user_id', Auth::id())
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('solicitudes.index', compact('solicitudes'));
    }

    public function create()
    {
        return view('solicitudes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'departamento' => 'required|string',
            'descripcion' => 'nullable|string',
            'archivo' => 'nullable|file|mimes:pdf,doc,docx,jpg,png,jpeg|max:10240',
        ]);

        $rutaArchivo = null;

        if ($request->hasFile('archivo')) {
            $rutaArchivo = $request->file('archivo')->store('solicitudes', 'public');
        }


        Solicitud::create([
            'user_id'      => Auth::id(),
            'user_rut'     => Auth::user()->rut,
            'titulo'       => $request->titulo,
            'tipo'         => $request->titulo,
            'departamento' => $request->departamento,
            'descripcion'  => $request->descripcion,
            'archivo_path' => $rutaArchivo,
            'estado'       => 'Pendiente',
        ]);

        return redirect()->route('solicitudes.index');
    }
}
