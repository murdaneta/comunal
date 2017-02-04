<?php
require_once('controlador_vista.php');
require_once('../modelos/Usuario.php');
/**
* 
*/
class UsuarioController
{

	static function perfil($mensaje=array()){
		$usuario=new Usuario();
		$usuario->get($_SESSION['usuario']);
		if ($usuario->mensaje) {
            $datos = $usuario->all;
			Vistas::retornar_vista('perfil',$datos);
		}else{
			UsuarioController::lista(array('mensaje'=>'El Usuario No Existe','tipo_mensaje' => 'warning'));
		}
	}
	static function ver_usuario($mensaje=array()){
		$usuario=new Usuario();
		$id_usuario=Vistas::datos_get('usuario');
		$usuario->get($id_usuario);
		if ($usuario->mensaje) {
            $datos = $usuario->all;
			Vistas::retornar_vista('perfil',$datos);
		}else{
			UsuarioController::lista(array('mensaje'=>'El Usuario No Existe','tipo_mensaje' => 'warning'));
		}
	}
	static function editar_usuario(){
		$usuario=new Usuario();
		$usuario_id=Vistas::datos_get('user_edit');
		$usuario->get($usuario_id);
		if ($usuario->mensaje && $usuario_id!=1) {
            $datos = $usuario->all;
			Vistas::retornar_vista('usuario_edit',$datos);
		}else{
			UsuarioController::lista(array('mensaje'=>'El usuario No Existe','tipo_mensaje' => 'warning'));
		}
	}
	static function borrar_usuario(){
		$usuario=new Usuario();
		$usuario_id=Vistas::datos_get('user_delete');
		$usuario->delete($usuario_id);
		if ($usuario->mensaje && $usuario_id!=1) {
			UsuarioController::lista(array('mensaje'=>'El usuario fue eliminado','tipo_mensaje' => 'info'));
		}else{
			UsuarioController::lista(array('mensaje'=>'El usuario No Existe','tipo_mensaje' => 'warning'));
		}
	}
	static function update(){
		//return var_dump($_POST);
		$datos=UsuarioController::datos($_POST,10);
		$usuario=new Usuario();
		if ($_POST['correo']&&$_POST['id_usuario']!=1) {
			 $usuario->edit($datos,$_POST['id_usuario']);
		}else{
			Vistas::redireccionar_vista('usuarios/lista');
		}
		if(!$usuario->mensaje){
			$usuario->get($_POST['id_usuario']);
			$datos1 = $usuario->all;
			Vistas::retornar_vista('usuario_edit',$datos1,array(
				'mensaje' => 'El Usuario No se ha podido Modificar
				(puede que algunos de los correos electronico ya este
				 en uso o la cedula este registrada)','tipo_mensaje' => 'warning'));
		}elseif ($usuario->mensaje=='exito') {
			$usuario->get($_POST['id_usuario']);
			$datos1 = $usuario->all;
			Vistas::retornar_vista('usuario_edit',$datos1,array(
				'mensaje' => 'El Usuario se modifico Exitosamente','tipo_mensaje' => 'success'));
		}
	}
	static function lista($mensaje=array()){
		$usuario=new Usuario();
		$todos=$usuario->all();
		$datos='';
		$i;
		if ($todos) {
			foreach ($todos as $usuario) {
				$datos.='<tr>';
				foreach ($usuario as $propiedad=>$valor) {
					if ($propiedad== 'id') {
						$datos.='<td class="text-center"><a href="{RAIZ_LINK}?usuario='.$valor.'">'.$valor."</a></td>";
					}
					if ($propiedad== 'cedula'||
						$propiedad== 'nombre'||
						$propiedad== 'apellido'||
						$propiedad== 'correo') {
						$datos.='<td>'.$valor."</td>";
					}
		        };
		        $datos.='</tr>';
	        };
		}
		Vistas::retornar_vista('usuarios_ver',array("tabla_datos"=>$datos),$mensaje);
	}
	static function formulario($mensaje=array()){
		Vistas::retornar_vista('usuario_formulario',array(),$mensaje);
	}
	static function guardar($mensaje=array()){
		$datos=UsuarioController::usuarios_datos($_POST,9);
		$usuario=new Usuario();
		if ($_POST['correo']) {
			 $usuario->set($datos['atributos'],$datos['valores'],$_POST['correo']);
		}else{
			Vistas::redireccionar_vista('usuarios/crear');
		}
		//echo $usuario->mensaje;
		if ($usuario->mensaje=='existe') {
			UsuarioController::formulario(
				array(
					'mensaje' 		=> 'El Correo:'.$_POST['correo'].' ya se encuentra registrado',
					'tipo_mensaje' 	=> 'danger'));
		}elseif(!$usuario->mensaje){
			UsuarioController::formulario(
				array(
					'mensaje' 		=> 'No Se ha Creado el Usuario',
					'tipo_mensaje' 	=> 'warning'));
		}elseif ($usuario->mensaje=='exito') {
			UsuarioController::lista(
				array(
					'mensaje' 		=> 'Se ha Creado el Usuario Exitosamente',
					'tipo_mensaje' 	=> 'success'));
		}	
	}
	static function usuarios_datos($data=array(),$cantidad=0){
		$atributo='';
		$valor='';
		$i=0;
		$total;
		foreach ($data as $key => $value) {	
			if ($key!='clave_confirmacion') {	
				# code...
				if ($i==0 and $key!='' and $value!='') {
					$atributo.=$key;
					$valor.="'".$value."'";
				}elseif ($i<=$cantidad and $key!='' and $value!='') {
					$atributo.=','.$key;
					$valor.=",'".$value."'";
				}
				$i++;
			}	
		}
		return $total=array('valores' => $valor,'atributos' => $atributo);
	}
	static function datos($data=array(),$cantidad=0){
		$valor='';
		$i=0;
		$total;
		foreach ($data as $key => $value) {
			if ($key!="id_usuario" && $key!='clave_confirmacion') {
				if ($i==0 and $key!='' and $value!='') {
					$valor.=$key."='".$value."'";
				}elseif ($i<=$cantidad and $key!='' and $value!='') {
					$valor.=",".$key."='".$value."'";
				}
				$i++;
			}
		}
		return $total=array('atributosValores' => $valor);
	}
}