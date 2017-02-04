<?php
require_once('conexion_BD.php');
/**
* 
*/
class Servicio extends DBAbstractModel
{
	#Trae los datos del Habitante
	public function get($habitante=''){
		

	}
    public function all(){
      

    }
    public function set($atributos='',$valor='',$id_vivienda='')
    {
		if($id_vivienda) {
            $this->query = "INSERT INTO `servicios`($atributos) VALUES ($valor)";
            $this->execute_single_query();
        	$this->mensaje = 'exito';
        } else {
        	$this->mensaje = false;
        }

	}
    public function edit(){

    }
    public function delete(){

    }
}