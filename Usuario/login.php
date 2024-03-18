<!DOCTYPE html>
<html lang="en">
<head>
        <?php
        require_once('conexion.php');

        // Resto de tu código aquí
        ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <!-- Enlace al archivo CSS generado por Tailwind -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <form action="../Usuario/index.php" method="post" class="flex flex-col space-y-4">
            <label for="chk" aria-hidden="true" class="sr-only">Login</label>
            <input type="email" name="usuario" placeholder="Usuario" required="" class="px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300 placeholder-gray-400">
            <input type="password" name="contraseña" placeholder="Password" required="" class="px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300 placeholder-gray-400">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300">Iniciar Sesión</button>
        </form>

        <div class="mt-4 text-center">
            <p>No tienes una cuenta aún?</p>
            <button id="btnToggle" class="text-blue-500" onclick="toggleForm()">Regístrate</button>
        </div>
    </div>

    <script>


        function toggleForm() {
            var form = document.querySelector('form');

            // Cambiar el texto del botón y la acción del formulario
            if (form.getAttribute('action').includes('registro')) {
                form.setAttribute('action', '../Usuario/index.php');
                document.getElementById('btnToggle').innerText = 'Regístrate';
            } else {
                form.setAttribute('action', '../Usuario/registro.php');
                document.getElementById('btnToggle').innerText = 'Iniciar Sesión';
            }
        }
    </script>
</body>
</html>
