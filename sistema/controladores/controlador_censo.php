<?php
require_once('controlador_vista.php');
require_once('../modelos/Habitante.php');
require_once('../modelos/Familia.php');
require_once('../modelos/Vivienda.php');
require_once('../modelos/Servicio.php');
/**
* 
*/
class Censo
{
	static function registrar($mensaje=array()){
		Vistas::retornar_vista('censo_jefe',array(), $mensaje);
	}

	static function registados($mensaje=array()){
		$habitante=new Habitante();
		$todos=$habitante->all();
		$datos='';
		$i;
		if ($todos) {
			foreach ($todos as $habitante) {
				$datos.='<tr';
				foreach ($habitante as $propiedad=>$valor) {
					if ($propiedad=='id_jefe' && $valor!='') {
						$datos.=' class="success">';
					}elseif($propiedad=='id_jefe'){
						$datos.='>';
					}
					if ($propiedad== 'id') {
						$datos.='<td class="text-center"><a href="{RAIZ_LINK}?habitante='.$valor.'">'.$valor."</a></td>";
					}
					if ($propiedad== 'cedula'||
						$propiedad== 'nombre'||
						$propiedad== 'apellido'||
						$propiedad== 'fecha_nacimiento') {
						$datos.='<td>'.$valor."</td>";
					}
		        };
		        $datos.='</tr>';
	        };
		}
		Vistas::retornar_vista('censo_ver',array("tabla_datos"=>$datos),$mensaje);
	}

	static function crear_jefe(){
		//return var_dump(array_keys($_POST));
		//$x=count($_POST);
		//return $x ;
		$datos=Censo::censo_datos($_POST,34);
		$habitante=new Habitante();
		if ($_POST['cedula']) {
			 $habitante->set($datos['atributos'],$datos['valores'],$_POST['cedula']);
		}else{
			Vistas::redireccionar_vista('censo/registrar');
		}
		//echo $habitante->mensaje;
		if ($habitante->mensaje=='existe') {
			Censo::registrar(array('mensaje' => 'El habitante ya existe','tipo_mensaje' => 'danger'));
		}elseif(!$habitante->mensaje){
			Censo::registrar(array('mensaje' => 'No se ha agregado al habitante','tipo_mensaje' => 'warning'));
		}elseif ($habitante->mensaje=='exito') {
			Vistas::retornar_vista('censo_situacion_economica',array('id_jefe'=> $habitante->id),array(
				'mensaje' => 'El Jefe familiar ha sido agregado exitosamente, Ahora debe registrar la Situacion Economica de la familia en la vivienda ','tipo_mensaje' => 'success'));
		}	
	}

	static function crear_situacion_economica(){
		//return var_dump($_POST);
		//$x=count($_POST);
		//return $x ;
		
		$familia=new Familia();
		if ($_POST['id_jefe']) {
			$id_jefe=$_POST['id_jefe'];
			 $familia->set($id_jefe);
			 $familia_id=$familia->id;
		}else{
			Vistas::redireccionar_vista('censo/registrar');
		}
		//echo $familia->mensaje;
		if (isset($familia_id)) {
			$familia->set_economia(
				$familia_id,
				$_POST['actividad_economica'],
				$_POST['descripcion_ventas'],
				$_POST['ingreso_familiar']);
			if(!$familia->mensaje){
				Vistas::retornar_vista('censo_situacion_economica',array('id_jefe'=> $_POST['id_jefe']),array(
				'mensaje' => 'No se ha podido agregar la situación economica','tipo_mensaje' => 'danger'));
			}elseif ($familia->mensaje=='exito') {
				Vistas::retornar_vista('censo_situacion_vivienda',array('id_familia'=> $familia_id),array(
					'mensaje' => 'La situacion economica se agrego exitosamente, Ahora debe registrar la Situacion de la vivienda ','tipo_mensaje' => 'success'));
			}
		}
	}

	static function crear_situacion_vivienda(){
		//return var_dump(array_keys($_POST));
		$datos=Censo::censo_datos($_POST,49);
		if ($_POST['id_familia']) {
			$vivienda=new Vivienda();
			$id_vivienda=$vivienda->set($datos['atributos'],$datos['valores'],$_POST['id_familia']);
			if(!$vivienda->mensaje){
				Vistas::retornar_vista('censo_situacion_vivienda',array('id_familia'=> $_POST['id_familia']),array(
				'mensaje' => 'No se ha podido agregar la Vivienda','tipo_mensaje' => 'danger'));
			}elseif ($vivienda->mensaje=='exito') {
				Vistas::retornar_vista('censo_servicios',array('id_vivienda'=> $id_vivienda),array(
					'mensaje' => 'La vivienda fue agregada exitosamente, Ahora debe registrar los servicios que posee la vivienda ','tipo_mensaje' => 'success'));
			}
			
		}else{
			Vistas::redireccionar_vista('censo/registrar');
		}
	}

	static function crear_servicios(){
		//return var_dump($_POST);
		$datos=Censo::censo_datos($_POST,35);
		if ($_POST['id_vivienda']) {
			$servicio=new Servicio();
			$id_vivienda=$servicio->set($datos['atributos'],$datos['valores'],$_POST['id_vivienda']);
			if(!$servicio->mensaje){
				Vistas::retornar_vista('censo_servicios',array('id_vivienda'=> $_POST['id_vivienda']),array(
				'mensaje' => 'No se ha podido agregar los servicios a la vivienda','tipo_mensaje' => 'danger'));
			}elseif ($servicio->mensaje=='exito') {
				Censo::registados(array('mensaje' => 'El Jefe familiar,la situacion economica de la familia, la vivienda y los servicios  fueron registrados con exito','tipo_mensaje' => 'success'));
			}
			
		}else{
			Vistas::redireccionar_vista('censo/registrar');
		}
	}

	static function censo_datos($data=array(),$cantidad=0){
		$atributo='';
		$valor='';
		$i=0;
		$total;
		foreach ($data as $key => $value) {
			if ($key!='id_familia') {			
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
}