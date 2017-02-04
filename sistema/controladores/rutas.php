<?php
//Estas dos lineas son para mostrar los errores de php en un servidor web.
require_once('errores.php');
require_once('constantes.php');
require_once('controlador_principal.php');
require_once('controlador_sesion.php');
require_once('controlador_censo.php');
require_once('controlador_habitante.php');
require_once('controlador_vivienda.php');
require_once('controlador_familia.php');
require_once('controlador_pdf.php');
require_once('controlador_usuario.php');

rutas();

function rutas (){
	
	$url=$_SERVER['REQUEST_URI'];

	if ($url==RAIZ.'principal'&& !$_SESSION || $url==RAIZ) {
		Principal::vista();

	}elseif ($url==RAIZ."iniciar" && !$_SESSION) {
		Sesion::vista();

	}elseif ($url==RAIZ."abrir" && !$_SESSION) {
		Sesion::abrir_sesion();

	}elseif ($url==RAIZ."pdf/carta/residencia" && !$_SESSION) {
		pdfControlador::residencia();

	}elseif ($url==RAIZ."pdf/carta/buena_conducta" && !$_SESSION) {
		pdfControlador::buena_conducta();

	}elseif ($url==RAIZ."pdf/carta/solteria" && !$_SESSION) {
		pdfControlador::solteria();

	}elseif ($url==RAIZ."pdf/carta/no_poseer_vivienda" && !$_SESSION) {
		pdfControlador::no_poseer_vivienda();

	}elseif ($url==RAIZ."pdf/carta/union_concubinaria" && !$_SESSION) {
		pdfControlador::union_concubinaria();

	}elseif ($_SESSION) {

		if ($url==RAIZ.'inicio') {
			
			Vistas::retornar_vista('inicio');

		}elseif ($url==RAIZ."cerrar") {
			
			Sesion::cerrar_sesion();

		}elseif ($url==RAIZ.'perfil') {
			
			UsuarioController::perfil();

		}elseif ($url==RAIZ.'usuarios/lista') {
			
			UsuarioController::lista();

		}elseif ($url==RAIZ.'usuarios/crear') {

			if ($_SESSION['tipo_usuario']=='Pricipal') {
				UsuarioController::formulario();
			}else{
				UsuarioController::lista(array(
					'mensaje'=>'Not ienes permisos para crear usuarios',
					'tipo_mensaje' => 'info'));
			}

		}elseif ($url==RAIZ.'usuarios/guardar' && $_SESSION['tipo_usuario']=='Pricipal') {
			
			UsuarioController::guardar();

		}elseif (isset($_GET['usuario'])){

			if ($_SESSION['tipo_usuario']=='Pricipal') {
				UsuarioController::ver_usuario();
			}else{
				UsuarioController::lista(array(
					'mensaje'=>'No tienes permisos para ver detalles de otros usuarios',
					'tipo_mensaje' => 'info'));
			}


		}elseif (isset($_GET['user_edit'])){

			if ($_SESSION['tipo_usuario']=='Pricipal') {
				UsuarioController::editar_usuario();
			}elseif ($_SESSION['tipo_usuario']=='Secundario' && 
						$_GET['user_edit']==$_SESSION['usuario_id']) {
				UsuarioController::editar_usuario();
			}else{
				UsuarioController::lista(array(
					'mensaje'=>'No tienes permisos para editar otros usuarios',
					'tipo_mensaje' => 'info'));
			}
			

		}elseif (isset($_GET['user_delete'])){

			if ($_SESSION['tipo_usuario']=='Pricipal') {
				UsuarioController::borrar_usuario();
			}else{
				UsuarioController::lista(array(
					'mensaje'=>'No tienes permisos para borrar usuarios',
					'tipo_mensaje' => 'info'));
			}
			

		}elseif ($url==RAIZ.'usuario/editar'){

			if ($_SESSION['tipo_usuario']=='Pricipal') {
				UsuarioController::update();
			}elseif ($_SESSION['tipo_usuario']=='Secundario' && 
						$_GET['user_edit']==$_SESSION['usuario_id']) {
				UsuarioController::update();
			}else{
				UsuarioController::lista(array(
					'mensaje'=>'No tienes permisos para editar otros usuarios',
					'tipo_mensaje' => 'info'));
			}

		}elseif ($url==RAIZ."censo/registrar") {
			
			Censo::registrar();

		}elseif ($url==RAIZ."formulario/jefe") {
			
			Censo::crear_jefe();

		}elseif ($url==RAIZ."formulario/situacion_economica") {
			
			Censo::crear_situacion_economica();

		}elseif ($url==RAIZ."formulario/situacion_vivienda") {
			
			Censo::crear_situacion_vivienda();

		}elseif ($url==RAIZ."formulario/servicios") {
			
			Censo::crear_servicios();

		}elseif ($url==RAIZ."censo/ver") {
			
			Censo::registados();
			
		}elseif (isset($_GET['habitante'])) {
			
			HabitanteControlador::vista();
			
		}elseif (isset($_GET['habitante_edit'])) {
			
			HabitanteControlador::edit();
			
		}elseif ($url==RAIZ.'formulario/habitante/edit' && isset($_POST)) {
			
			HabitanteControlador::update();
			
		}elseif (isset($_GET['familia'])) {
			
			FamiliaControlador::vista();
			
		}elseif (isset($_GET['familiar_agregar'])) {
			
			FamiliaControlador::formulario_familiar();
			
		}elseif ($url==RAIZ.'formulario/familiar'&& isset($_POST)) {
			
			FamiliaControlador::agregar_familiar();
			
		}elseif (isset($_GET['vivienda'])) {
			
			ViviendaControlador::vista();
			
		}elseif (isset($_GET['vivienda_edit'])) {
			
			ViviendaControlador::edit();
			
		}elseif ($url==RAIZ.'formulario/vivienda/edit' && isset($_POST)) {
			
			ViviendaControlador::update();
			
		}elseif ($url==RAIZ.'imprimir/lista/habitantes') {
			
			pdfControlador::habitantes();
			
		}else{
			Vistas::retornar_vista('404');
		}

	}else{

		Vistas::retornar_vista('404');
		
	}
}
?>