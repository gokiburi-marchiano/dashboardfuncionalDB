<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\SolicitudArchivo;
use App\Models\SolicitudHistorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SolicitudController extends Controller
{
    public function index()
    {
        $solicitudes = Solicitud::where('user_id', Auth::id())
            ->with('archivos')
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
            'titulo'       => 'required|string|max:255',
            'departamento' => 'required|string',
            'descripcion'  => 'nullable|string',
            'archivos'     => 'array|max:10',
            'archivos.*'   => 'file|mimes:pdf,doc,docx,jpg,png,jpeg|max:10240',
        ]);

        $solicitud = Solicitud::create([
            'user_id'      => Auth::id(),
            'user_rut'     => Auth::user()->rut,
            'titulo'       => $request->titulo,
            'tipo'         => $request->titulo,
            'departamento' => $request->departamento,
            'descripcion'  => $request->descripcion,
            'estado'       => 'Pendiente',
        ]);

        if ($request->hasFile('archivos')) {
            foreach ($request->file('archivos') as $archivo) {

                $ruta = $archivo->store('solicitudes', 'public');

                SolicitudArchivo::create([
                    // ESTA ERA LA CAUSA DEL ERROR, AHORA ESTÁ CORREGIDO:
                    'solicitud_id'  => $solicitud->id,
                    'file_path'     => $ruta,
                    'original_name' => $archivo->getClientOriginalName(),
                    'mime_type'     => $archivo->getClientMimeType(),
                ]);
            }
        }

        return redirect()->route('solicitudes.index')->with('status', 'Solicitud creada exitosamente.');
    }

    public function show($id)
    {
        if (Auth::user()->role === 'admin') {
            $solicitud = Solicitud::with('archivos')->findOrFail($id);
        } else {
            $solicitud = Solicitud::with('archivos')->where('user_id', Auth::id())->findOrFail($id);
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
            'nuevos_archivos'   => 'required|array|max:5',
            'nuevos_archivos.*' => 'file|mimes:pdf,doc,docx,jpg,png,jpeg|max:10240',
        ]);

        if ($request->hasFile('nuevos_archivos')) {

            foreach ($request->file('nuevos_archivos') as $archivo) {

                $rutaNueva = $archivo->store('solicitudes', 'public');
                $nombreOriginal = $archivo->getClientOriginalName();

                SolicitudArchivo::create([
                    // AQUÍ TAMBIÉN ESTABA EL ERROR, CORREGIDO:
                    'solicitud_id'  => $solicitud->id,
                    'file_path'     => $rutaNueva,
                    'original_name' => $nombreOriginal,
                    'mime_type'     => $archivo->getClientMimeType(),
                ]);

                SolicitudHistorial::create([
                    'solicitud_id'     => $solicitud->id,
                    'user_id'          => Auth::id(),
                    'accion'           => 'Archivo Adicional Subido',
                    'archivo_anterior' => null,
                    'archivo_nuevo'    => $rutaNueva,
                    'motivo'           => 'Usuario agregó: ' . $nombreOriginal
                ]);
            }

            $solicitud->save();
        }

        return back()->with('status', 'Nuevos archivos agregados correctamente.');
    }
}
