<?php
require_once('controlador_vista.php');
/**
* 
*/
class FamiliaControlador 
{

	static function vista(){
		$familia=new Familia();
		$id_familia=Vistas::datos_get('familia');
		$todos=$familia->all($id_familia);
		$datos='';
		$nombre_jefe='';
		$apellido_jefe='';
		$id_vivienda='';
		$id_familia='';
		$id_jefe='';
		if ($familia->mensaje) {
			foreach ($todos as $familia) {
				foreach ($familia as $propiedad=>$valor) {
					//var_dump($propiedad);
					if ($propiedad== 'id') {
						$datos.='<a href="{RAIZ_LINK}?habitante='.$valor.'" class="list-group-item">
						<h4 class="text-info"><i class="fa fa-user fa-fw"></i>';
					}elseif ($propiedad== 'nombre') {
						if (!$valor) {
							$datos.="No posee familiares registrados";
						}else{
							$datos.=" $valor";
						}
					}elseif ($propiedad== 'apellido') {
						$datos.=" $valor";
					}elseif ($propiedad== 'parentesco') {
						$datos.='<span class="pull-right text-muted"><em>'.$valor.'</em>
                        </span>';
					}elseif ($propiedad=='nombre_jefe') {
						$nombre_jefe=$valor;
					}elseif($propiedad=='apellido_jefe'){
						$apellido_jefe=$valor;
					}elseif ($propiedad=='id_vivienda') {
						$id_vivienda=$valor;
					}elseif ($propiedad=='id_familia') {
						$id_familia=$valor;
					}elseif ($propiedad=='id_jefe') {
						$id_jefe=$valor;
					}
		        };
		        	$datos.='</h4></a>';
	        };
	        Vistas::retornar_vista('familia_ver',array(
	        	"list_familiares"=>$datos,
	        	'nombre_jefe'=>$nombre_jefe,
	        	'apellido_jefe'=>$apellido_jefe,
	        	'id_vivienda'=>$id_vivienda,
	        	'id_familia'=>$id_familia,
	        	'id_jefe'=>$id_jefe));
		}else{
			Censo::registados(array('mensaje'=>'La Familia No Existe','tipo_mensaje' => 'warning'));
		}
	}
	static function formulario_familiar()
	{
		$familia=new Familia();
		$familia->get(Vistas::datos_get('familiar_agregar'));
		//echo $familia->id;
		Vistas::retornar_vista('familia_agregar',array('id_familia'=>$familia->id));
	}
	static function agregar_familiar()
	{
		//return var_dump($_POST);

		$datos=FamiliaControlador::datos($_POST,30);
		//return var_dump($datos);
		$habitante=new Habitante();
		$familia=new Familia();
		if ($_POST['cedula']) {
			 $habitante->set($datos['atributos'],$datos['valores'],$_POST['cedula']);
			if ($habitante->mensaje=='exito') {
			 	$familia->familiar($_POST['id_familia'],$habitante->id,$_POST['parentesco']);
			 	if ($familia->mensaje) {
			 		Vistas::retornar_vista('familia_agregar',array('id_familia'=> $_POST['id_familia']),array(
				'mensaje' => 'Se agrego el Familiar con exito','tipo_mensaje' => 'success'));
			 	}
			}else{
			 	Vistas::retornar_vista('familia_agregar',array('id_familia'=> $_POST['id_familia']),array(
				'mensaje' => 'No se Agrego el Familiar','tipo_mensaje' => 'warning'));
			}
		}else{
			Vistas::redireccionar_vista('censo/registrar');
		}
	}
	static function edit(){
		
	}
	static function update(){
		
	}
	static function datos($data=array(),$cantidad=0){
		$atributo='';
		$valor='';
		$i=0;
		$total;
		foreach ($data as $key => $value) {
			if ($key!='id_familia' && $key!='parentesco') {			
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