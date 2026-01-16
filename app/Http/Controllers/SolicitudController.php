<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\SolicitudHistorial;
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

    public function show($id)
    {
        if (Auth::user()->role === 'admin') {
            $solicitud = Solicitud::findOrFail($id);
        } else {
            $solicitud = Solicitud::where('user_id', Auth::id())->findOrFail($id);
        }

        return view('solicitudes.show', compact('solicitud'));
    }

    public function update(Request $request, $id)
    {
        $solicitud = Solicitud::findOrFail($id);

        if ($solicitud->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para modificar esta solicitud.');
        }

        $request->validate([
            'nuevo_archivo' => 'required|file|mimes:pdf,doc,docx,jpg,png,jpeg|max:10240',
        ]);

        if ($request->hasFile('nuevo_archivo')) {
            $rutaAnterior = $solicitud->archivo_path;

            $rutaNueva = $request->file('nuevo_archivo')->store('solicitudes', 'public');

            SolicitudHistorial::create([
                'solicitud_id'      => $solicitud->id,
                'user_id'           => Auth::id(),
                'accion'            => 'Nueva Versión Subida',
                'archivo_anterior'  => $rutaAnterior,
                'archivo_nuevo'     => $rutaNueva,
                'motivo'            => 'Corrección de archivo por el usuario'
            ]);

            $solicitud->archivo_path = $rutaNueva;
            $solicitud->save();
        }

        return back()->with('status', 'Archivo actualizado. La versión anterior se ha guardado en el historial.');
    }
}
