<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsuarios = User::where('role', 'user')->count();

        $solicitudesPendientes = Solicitud::whereNull('estado')
                                ->orWhere('estado', 'Pendiente')
                                ->count();

        $solicitudesAprobadas = Solicitud::where('estado', 'Aprobado')->count();

        $solicitudesHoy = Solicitud::whereDate('created_at', now()->today())->count();

        $ultimasSolicitudes = Solicitud::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsuarios',
            'solicitudesPendientes',
            'solicitudesAprobadas',
            'solicitudesHoy',
            'ultimasSolicitudes'
        ));
    }

    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);

        if($user->id === Auth::id()) {
            return back()->with('error', 'No puedes bloquear tu propia cuenta.');
        }

        $user->is_active = !$user->is_active;
        $user->save();

        return back()->with('status', 'Estado del usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if($user->id === Auth::id()) {
            return back()->with('error', 'No puedes eliminarte a ti mismo.');
        }

        $user->delete();

        return back()->with('status', 'Usuario eliminado correctamente.');
    }

    public function indexSolicitudes()
    {
        $solicitudes = Solicitud::with('user')->orderBy('created_at', 'desc')->get();

        return view('admin.solicitudes.index', compact('solicitudes'));
    }

    public function evaluarSolicitud(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|in:Aprobado,Rechazado',
            'observacion_admin' => 'nullable|string|max:1000',
        ]);

        $solicitud = Solicitud::findOrFail($id);

        $solicitud->estado = $request->estado;
        $solicitud->observacion_admin = $request->observacion_admin;
        $solicitud->save();

        return redirect()->route('solicitudes.show', $id)
                         ->with('status', 'El trámite ha sido ' . strtolower($request->estado) . ' correctamente.');
    }
}
