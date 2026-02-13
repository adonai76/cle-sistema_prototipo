<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Servicio no disponible</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 h-screen flex items-center justify-center px-4">

    <div class="max-w-lg w-full text-center">
        <div class="mb-8">
            <svg class="w-24 h-24 mx-auto text-indigo-500 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
            </svg>
        </div>

        <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl mb-4">
            ¡Ups! Algo salió mal.
        </h1>

        <p class="text-lg text-gray-600 mb-8">
            No eres tú, somos nosotros (o nuestra base de datos).<br>
            Estamos experimentando problemas técnicos temporales, pero ya estamos trabajando para solucionarlo.
        </p>

        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <button onclick="window.location.reload()" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 transition duration-150 ease-in-out cursor-pointer shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                Intentar de nuevo
            </button>

            <a href="/" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition duration-150 ease-in-out shadow-sm">
                Volver al inicio
            </a>
        </div>

        <div class="mt-12 text-xs text-gray-400">
            Error 500 | Server Error
        </div>
    </div>

</body>
</html>
