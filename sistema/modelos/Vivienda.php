<?php
require_once('conexion_BD.php');
/**
 * 
 */
 class Vivienda extends DBAbstractModel
 {
 	public function get($idOrNumero=''){
        if($idOrNumero != '') {
            $this->query = "
                SELECT      *
                FROM        viviendas
                WHERE       id = '$idOrNumero' OR id = '$idOrNumero'
            ";
            $this->get_results_from_query();
        }

        if(count($this->rows) == 1) {
            $datos='all';
            $all=array();
            foreach ($this->rows[0] as $propiedad=>$valor) {
                $this->$propiedad = $valor;
            }
            foreach ($this->rows[0] as $propiedad=>$valor) {
                $all=$all+[$propiedad => $valor];
            }
            //var_dump($all);
            $this->$datos=$all;
            $this->mensaje = '1';
        } else {
            $this->cedula=null;
            $this->mensaje = '0';
        }

    }
	public function all(){

	}
	public function set($atributos='',$valor='',$id_familia='')
    {
		if($id_familia) {
            $this->query = "INSERT INTO `viviendas`($atributos) VALUES ($valor)";
            $this->execute_single_query();
            $id_vivienda=$this->id;
            if ($id_vivienda!=0) {
                $this->query = "INSERT INTO `familia_vivienda`(`id_familia`, `id_vivienda`)
                    VALUES (
                    '".$id_familia."',
                    '".$id_vivienda."')";
                $this->execute_single_query();
                    $this->mensaje = 'exito';
                    return $id_vivienda;
            }else{
                $this->mensaje = false;
            }
            
        } else {
            $this->mensaje = false;
        }

	}
	 public function edit($atributosValores='',$id_vivienda=''){
        if($id_vivienda!='') {
            $this->query = "UPDATE viviendas SET ".$atributosValores['atributosValores']."  WHERE id ='$id_vivienda'";
            $this->execute_single_query();
            $this->mensaje = 'exito';
        } else {
            $this->mensaje = false;
        }
    }
	public function delete(){

	}
}