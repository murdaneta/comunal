<?php
require_once('controlador_vista.php');
/**
* 
*/
class ViviendaControlador
{
	static function vista(){
		$vivienda=new Vivienda();
		$id_habitante=Vistas::datos_get('vivienda');
		$vivienda->get($id_habitante);
		if ($vivienda->mensaje) {
            $datos = $vivienda->all;
			Vistas::retornar_vista('vivienda_ver',$datos);
		}else{
			Censo::registados(array('mensaje'=>'La Vivienda no existe','tipo_mensaje' => 'warning'));
		}
	}
	static function edit(){
		$vivienda=new Vivienda();
		$vivienda->get(Vistas::datos_get('vivienda_edit'));
		if ($vivienda->mensaje) {
            $datos = $vivienda->all;
			Vistas::retornar_vista('vivienda_edit',$datos);
		}else{
			Censo::registados(array('mensaje'=>'El Habitante No Existe','tipo_mensaje' => 'warning'));
		}
	}
	static function update(){
		$datos=HabitanteControlador::datos($_POST,49);
		//return var_dump($_POST);
		$check='';
		//Validando checkbox
			if(!isset($_POST["sala_habitacion"])){
				$check.=",sala_habitacion=''";
			}
			if(!isset($_POST["comedor_habitacion"])){
				$check.=",comedor_habitacion=''";
			}
			if(!isset($_POST["cocina_habitacion"])){
				$check.=",cocina_habitacion=''";
			}
			if(!isset($_POST["bano_habitacion"])){
				$check.=",bano_habitacion=''";
			}
			if(!isset($_POST["frisadas"])){
				$check.=",frisadas=''";
			}
			if(!isset($_POST["sin_frisar"])){
				$check.=",sin_frisar=''";
			}
			if(!isset($_POST["tablas"])){
				$check.=",tablas=''";
			}
			if(!isset($_POST["bahareque"])){
				$check.=",bahareque=''";
			}
			if(!isset($_POST["zinc_paredes"])){
				$check.=",zinc_paredes=''";
			}
			if(!isset($_POST["carton_Piedra"])){
				$check.=",carton_Piedra=''";
			}
			if(!isset($_POST["platabanda"])){
				$check.=",platabanda=''";
			}
			if(!isset($_POST["asbesto"])){
				$check.=",asbesto=''";
			}
			if(!isset($_POST["teja"])){
				$check.=",teja=''";
			}
			if(!isset($_POST["zinc_techo"])){
				$check.=",zinc_techo=''";
			}
			if(!isset($_POST["machihembrado"])){
				$check.=",machihembrado=''";
			}
			if(!isset($_POST["techo_raso"])){
				$check.=",techo_raso=''";
			}
			if(!isset($_POST["nevera"])){
				$check.=",nevera=''";
			}
			if(!isset($_POST["cocina"])){
				$check.=",cocina=''";
			}
			if(!isset($_POST["gabinete"])){
				$check.=",gabinete=''";
			}
			if(!isset($_POST["camas"])){
				$check.=",camas=''";
			}
			if(!isset($_POST["aire"])){
				$check.=",aire=''";
			}
			if(!isset($_POST["ventilador"])){
				$check.=",ventilador=''";
			}
			if(!isset($_POST["juego_comedor"])){
				$check.=",juego_comedor=''";
			}
			if(!isset($_POST["muebles_sala"])){
				$check.=",muebles_sala=''";
			}
			if(!isset($_POST["utensilios_cocina"])){
				$check.=",utensilios_cocina=''";
			}
			if(!isset($_POST["tv"])){
				$check.=",tv=''";
			}
			if(!isset($_POST["moscas"])){
				$check.=",moscas=''";
			}
			if(!isset($_POST["hormigas"])){
				$check.=",hormigas=''";
			}
			if(!isset($_POST["ratones"])){
				$check.=",ratones=''";
			}
			if(!isset($_POST["cucarachas"])){
				$check.=",cucarachas=''";
			}
			if(!isset($_POST["ciempies"])){
				$check.=",ciempies=''";
			}
			if(!isset($_POST["perro"])){
				$check.=",perro=''";
			}
			if(!isset($_POST["gato"])){
				$check.=",gato=''";
			}
			if(!isset($_POST["pajaros"])){
				$check.=",pajaros=''";
			}
			if(!isset($_POST["gallinas"])){
				$check.=",gallinas=''";
			}
			if(!isset($_POST["patos"])){
				$check.=",patos=''";
			}
			if(!isset($_POST["cochinos"])){
				$check.=",cochinos=''";
			}
		//Fin Validando checkbox
		$vivienda=new Vivienda();
		if ($_POST['numero_vivienda']&&$_POST['id_vivienda']) {
			$datos['atributosValores'].=$check;
			//var_dump($datos['atributosValores']);
			 $vivienda->edit($datos,$_POST['id_vivienda']);
		}else{
			Vistas::redireccionar_vista('censo/ver');
		}
		if(!$vivienda->mensaje){
			$vivienda->get($_POST['id_vivienda']);
			$datos1 = $vivienda->all;
			Vistas::retornar_vista('vivienda_edit',$datos1,array(
				'mensaje' => 'La Vivienda No se ha podido Modificar','tipo_mensaje' => 'warning'));
		}elseif ($vivienda->mensaje=='exito') {
			$vivienda->get($_POST['id_vivienda']);
			$datos1 = $vivienda->all;
			Vistas::retornar_vista('vivienda_edit',$datos1,array(
				'mensaje' => 'La Vivienda se modifico Exitosamente','tipo_mensaje' => 'success'));
		}
	}
}