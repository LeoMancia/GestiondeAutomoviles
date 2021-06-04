<?php

include('../Modelo/session.php');
$mensaje ="";

$patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";
$patron_correo = "/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/";
$patron_contra = "/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/";

if ($_POST) {
	// Nombre:
	 if( empty($_POST['nombreUser']) )
	 $mensaje = "Nombre de usuario es requerido";
	else
	{
		// Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
		 if( preg_match($patron_texto, $_POST['nombreUser']) ){

			// Contraseña:
			if( empty($_POST['contasena']) )
			$mensaje = "La contraseña es requerida";
			else
			{
				// Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
				if( preg_match($patron_contra, $_POST['contasena']) ){
					if ( verificarUsuario($_POST)) {
						echo "<script> window.location='./' </script>";
						exit();
					}else{
						$mensaje = "El usuario no existe";
					}
				}else{
					$mensaje = "Usuario y/o contraseña incorrecta";
				}
			}
		 }else{
			$mensaje = "Usuario y/o contraseña incorrecta";
		 }
	}



		
		 
}



include("Nav.php");
?>
<style type="text/css">
 	body,
		html {
			margin: 20px;
			padding: 30px;
			height: 100%;
			background: #60a3bc !important;
		}
		.user_card {
			height: 400px;
			width: 350px;
			margin-top: auto;
			margin-bottom: auto;
			background: #f39c12;
			position: relative;
			display: flex;
			justify-content: center;
			flex-direction: column;
			padding: 10px;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			-webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			-moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			border-radius: 5px;

		}
		.brand_logo_container {
			position: absolute;
			height: 170px;
			width: 170px;
			top: -75px;
			border-radius: 50%;
			background: #60a3bc;
			padding: 10px;
			text-align: center;
		}
		.brand_logo {
			height: 150px;
			width: 150px;
			border-radius: 50%;
			border: 2px solid white;
		}
		.form_container {
			margin-top: 100px;
		}
		.login_btn {
			width: 100%;
			background: #c0392b !important;
			color: white !important;
		}
		.login_btn:focus {
			box-shadow: none !important;
			outline: 0px !important;
		}
		.login_container {
			padding: 0 2rem;
		}
		.input-group-text-addon {
			background: #c0392b !important;
			color: white !important;
			border: 0 !important;
			border-radius: 0.25rem 0 0 0.25rem !important;
		}
		.input_user,
		.input_pass:focus {
			box-shadow: none !important;
			outline: 0px !important;
		}
		.custom-checkbox .custom-control-input:checked~.custom-control-label::before {
			background-color: #c0392b !important;
		}

</style>

<div id="divlogin">
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="data:image/jpeg;base64,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" class="brand_logo" alt="Logo">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
                    <form method="post">
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text-addon"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="nombreUser" class="form-control input_user" placeholder="username">
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
				                <span class="input-group-text-addon"><i class="fas fa-key"></i></span>
		                    </div>
			                    <input type="password" name="contasena" class="form-control input_pass" placeholder="password">
			            </div>
                        <div class="error">
                            <?php echo $mensaje; ?>
                        </div>
			   
	<div class="d-flex justify-content-center mt-3 login_container">
 	<button class="btn login_btn"type="submit" mb-1>Entrar</button>
	 <a class="btn login_btn" href="RegistroLog.php">Registrarse</a>
    </form>
   </div>
</div>

            </div>
        </div>
    </div>
</div>






