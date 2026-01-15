<!DOCTYPE html>
<html>
<head>
    <title>Test de Emergencia</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-20">
    <div class="bg-white p-10 rounded shadow-xl border-t-8 border-blue-900">
        <h1 class="text-3xl font-bold">¡LOGRASTE ENTRAR!</h1>
        <p class="mt-4 text-xl text-gray-600">
            Nombre: {{ Auth::user()->name }} <br>
            RUT: {{ Auth::user()->rut }}
        </p>
        <form method="POST" action="{{ route('logout') }}" class="mt-8">
            @csrf
            <button type="submit" class="text-red-600 underline">Cerrar sesión para probar de nuevo</button>
        </form>
    </div>
</body>
</html>
