<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-gob-black uppercase tracking-tighter">
            Gestión de Usuarios
        </h2>
    </x-slot>

    <div class="bg-white shadow-lg p-6 border-t-4 border-gob-secondary mt-6">

        <p class="mb-4 text-xs text-gob-gray-a">
            Aquí puedes administrar los permisos y el acceso de los usuarios registrados en el sistema.
        </p>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 border border-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gob-gray-b uppercase tracking-wider">Nombre / RUT</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gob-gray-b uppercase tracking-wider">Rol</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gob-gray-b uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-right text-xs font-bold text-gob-gray-b uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($users as $user)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="font-bold text-gob-black text-sm">{{ $user->name }}</div>
                            <div class="text-xs text-gob-gray-a">{{ $user->rut }} | {{ $user->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($user->role === 'admin')
                                <span class="px-2 py-1 inline-flex text-[10px] leading-5 font-black uppercase rounded bg-red-100 text-red-800 border border-red-200">
                                    Administrador
                                </span>
                            @else
                                <span class="px-2 py-1 inline-flex text-[10px] leading-5 font-bold uppercase rounded bg-blue-100 text-gob-primary border border-blue-200">
                                    Usuario
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($user->is_active)
                                <span class="px-2 py-1 inline-flex text-[10px] leading-5 font-bold uppercase text-green-800 bg-green-100 rounded-full">
                                    Activo
                                </span>
                            @else
                                <span class="px-2 py-1 inline-flex text-[10px] leading-5 font-bold uppercase text-red-800 bg-red-100 rounded-full">
                                    Suspendido
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-3">
                            <form action="{{ route('admin.users.toggle', $user->id) }}" method="POST" class="inline">
                                @csrf @method('PATCH')
                                <button type="submit" class="text-[10px] uppercase font-bold text-gob-primary hover:underline hover:text-blue-900">
                                    {{ $user->is_active ? 'Suspender' : 'Activar' }}
                                </button>
                            </form>

                            <span class="text-gray-300">|</span>

                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar a este usuario permanentemente? Esta acción borrará sus trámites.');">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-[10px] uppercase font-bold text-gob-secondary hover:underline hover:text-red-700">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
