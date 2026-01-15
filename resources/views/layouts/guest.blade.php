<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Acceso Institucional - Gobierno de Chile</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-100">
        <div class="w-full h-2 flex">
            <div class="w-1/2 bg-[#003399]"></div>
            <div class="w-1/2 bg-[#EF3340]"></div>
        </div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 border-t">
            <div class="mb-6">
                <h1 class="text-2xl font-extrabold tracking-tighter text-[#003399] uppercase">
                    Gobierno de <span class="text-[#EF3340]">Chile</span>
                </h1>
                <p class="text-center text-xs font-semibold text-gray-500 tracking-widest uppercase">Servicios Digitales</p>
            </div>

            <div class="w-full sm:max-w-md mt-4 px-8 py-10 bg-white shadow-md overflow-hidden sm:rounded-lg border-t-4 border-[#003399]">
                {{ $slot }}
            </div>

            <footer class="mt-8 text-center text-xs text-gray-400">
                <p>&copy; {{ date('Y') }} Ministerio Secretaría General de la Presidencia</p>
            </footer>
        </div>
    </body>
</html>
