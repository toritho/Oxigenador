<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
<link rel="stylesheet" type="text/css" href="./css/index.css">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>

 
<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">
 
			<div class="signup">
				<form action="./Auth/registro.php" method="post">
					<label for="chk" aria-hidden="true">Registrar</label>
					<input type="email" name="correo" placeholder="Email" required="">
					<input type="password" name="contraseña" placeholder="Password" required="">
					<input class="button" type="submit" value="Registrar">
				</form>
			</div>

			<div class="login">
				<form action="./Auth/login.php" method="post">
					<label for="chk" aria-hidden="true">Login</label>
					<input type="email" name="correo" placeholder="Usuario" required="">
					<input type="password" name="contraseña" placeholder="Password" required="">
					<input class="button" type="submit" value="Iniciar Sesión">
				</form>
			</div>
	</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
	 $(document).ready(function () {
        <?php
        // Verificar si hay un mensaje y mostrarlo con SweetAlert
        if (isset($_GET['mensaje'])) {
            echo "Swal.fire({
                title: 'Éxito',
                text: '" . $_GET['mensaje'] . "',
                icon: 'success'
            });";
        }
        ?>
    });

</script>
</body>
</html>
