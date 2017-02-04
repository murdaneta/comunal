<?php
require_once('controlador_vista.php');
session_start();
/**
* 
*/
class Sesion
{

	static function vista($mensaje=array()){
		Vistas::retornar_vista('iniciar_sesion',array(), $mensaje);
	}

	static function abrir_sesion(){
		if ($_POST['email']) {
			$usuario=new Usuario();
			$usuario->get($_POST['email']);
			if ($usuario->mensaje) {
				$usuario->clave=$_POST['password'];
				$_SESSION['usuario']=$usuario->correo;
				$_SESSION['usuario_id']=$usuario->id;
				$_SESSION['tipo_usuario']=$usuario->tipo_usuario;
				Vistas::redireccionar_vista('inicio');
			}else{
				Sesion::vista(array('mensaje' => 'Datos Incorrectos','tipo_mensaje' => 'danger'));
			}
			/*
			if ($_POST['email']=='usuario@gmail.com' and $_POST['password']=='123456') {
				$_SESSION['usuario']=$_POST['email'];
				Vistas::redireccionar_vista('inicio');
			}else{
				Sesion::vista(array('mensaje' => 'Datos Incorrectos','tipo_mensaje' => 'danger'));
			}*/
		}else{
			Sesion::vista(array('mensaje' => 'Datos Incorrectos','tipo_mensaje' => 'danger'));
		}
	}

	static function cerrar_sesion(){
		session_destroy();
		Vistas::redireccionar_vista('principal');
	}
	
	static function plantilla_session(){
		if ($_SESSION) {
			return $html = Vistas::plantilla('plantilla_sesion');
		}elseif(!$_SESSION){
			return $html = Vistas::plantilla('plantilla');
		}

	}
}