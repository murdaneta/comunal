<?php
require_once('controlador_vista.php');
require_once('../modelos/Habitante.php');
/**
* 
*/
class HabitanteControlador 
{

	static function vista(){
		$habitante=new Habitante();
		$id_habitante=Vistas::datos_get('habitante');
		$habitante->get($id_habitante);
		if ($habitante->mensaje) {
			$vivienda=new Habitante();
			$vivienda->relacionVivienda($id_habitante);
			if ($vivienda->mensaje) {
				$id_f=$vivienda->id_familia;
				$id_v=$vivienda->id_vivienda;
				//var_dump($vivienda->id_vivienda);
			}else{
				$id_v="null";
				$id_f="null";
			}
            $datos = $habitante->all;
			Vistas::retornar_vista('habitante_ver',['id_vivienda'=>$id_v,'id_familia'=>$id_f]+$datos);
		}else{
			Censo::registados(array('mensaje'=>'El Habitante No Existe','tipo_mensaje' => 'warning'));
		}
	}
	static function edit(){
		$habitante=new Habitante();
		$habitante->get(Vistas::datos_get('habitante_edit'));
		if ($habitante->mensaje) {
            $datos = $habitante->all;
			Vistas::retornar_vista('habitante_edit',$datos);
		}else{
			Censo::registados(array('mensaje'=>'El Habitante No Existe','tipo_mensaje' => 'warning'));
		}
	}
	static function update(){
		//return var_dump($_POST);
		$datos=HabitanteControlador::datos($_POST,35);
		//Validando checkbox
			$check='';
			if(!isset($_POST["diario"])){
				$check.=",diario=''";
			}
			if(!isset($_POST["semanal"])){
				$check.=",semanal=''";
			}
			if(!isset($_POST["quincenal"])){
				$check.=",quincenal=''";
			}
			if(!isset($_POST["mensual"])){
				$check.=",mensual=''";
			}
			if(!isset($_POST["por_trabajo_realizado"])){
				$check.=",por_trabajo_realizado=''";
			}
			if(!isset($_POST["cancer"])){
				$check.=",cancer=''";
			}
			if(!isset($_POST["diabetes"])){
				$check.=",diabetes=''";
			}
			if(!isset($_POST["sida"])){
				$check.=",sida=''";
			}
			if(!isset($_POST["tuberculosis"])){
				$check.=",tuberculosis=''";
			}
			if(!isset($_POST["hipertension"])){
				$check.=",hipertension=''";
			}
			if(!isset($_POST["asma"])){
				$check.=",asma=''";
			}
		//Fin Validando checkbox
		$habitante=new Habitante();
		if ($_POST['cedula']&&$_POST['id_habitante']) {
			$datos['atributosValores'].=$check;
			 $habitante->edit($datos,$_POST['id_habitante']);
		}else{
			Vistas::redireccionar_vista('censo/ver');
		}
		if(!$habitante->mensaje){
			$habitante->get($_POST['id_habitante']);
			$datos1 = $habitante->all;
			Vistas::retornar_vista('habitante_edit',$datos1,array(
				'mensaje' => 'El Habitante No se ha podido Modificar','tipo_mensaje' => 'warning'));
		}elseif ($habitante->mensaje=='exito') {
			$habitante->get($_POST['id_habitante']);
			$datos1 = $habitante->all;
			Vistas::retornar_vista('habitante_edit',$datos1,array(
				'mensaje' => 'El Habitante se modifico Exitosamente','tipo_mensaje' => 'success'));
		}
	}

	static function datos($data=array(),$cantidad=0){
		$valor='';
		$i=0;
		$total;
		foreach ($data as $key => $value) {
			if ($key!="id_habitante" && $key!='id_vivienda') {
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