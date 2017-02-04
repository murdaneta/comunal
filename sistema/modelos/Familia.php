<?php
require_once('conexion_BD.php');
/**
* 
*/
class Familia extends DBAbstractModel
{
	#consulatar familia
	public function get($id_familia=''){
        if($id_familia != '') {
            $this->query = "
                SELECT      *
                FROM        familias
                WHERE       id = '$id_familia'
            ";
            $this->get_results_from_query();
        }

        if(count($this->rows) == 1) {
            foreach ($this->rows[0] as $propiedad=>$valor) {
                $this->$propiedad = $valor;
            }
            $this->mensaje = true;
        } else {
            $this->mensaje = false;
        }
		

	}
    public function all($id_familia=''){
        $this->query = "SELECT  
            h.id, h.nombre,
            h.apellido,
            f.parentesco,
            familias.id AS id_familia,
            hj.nombre as nombre_jefe,
            hj.apellido as apellido_jefe,
            familias.id_jefe,
            fv.id_vivienda  FROM familias
            LEFT JOIN familiares f ON familias.id=f.id_familia 
            LEFT JOIN habitantes h ON f.id_familiar=h.id
            LEFT JOIN habitantes hj ON familias.id_jefe=hj.id
            LEFT JOIN familia_vivienda fv ON familias.id=fv.id_familia
            WHERE `familias`.`id`='".$id_familia."'
            GROUP BY h.id";
        $this->get_results_from_query();

        if(count($this->rows) >0) {
            $this->mensaje = '1';
            return $this->rows;
        } else {
            return $this->mensaje = false;
        }
    }
    public function set($id_jefe=''){
        if($id_jefe) {
        	//var_dump($id_jefe);
                $this->query = "INSERT INTO `familias`(`id_jefe`) VALUES ($id_jefe)";
                $this->execute_single_query();
                $this->mensaje = 'exito';
        } else {
            $this->mensaje = false;
        }

    }
    public function set_economia($id_familia='',$actividad_economica='',$descripcion_ventas='',$ingreso_familiar=''){
        if($id_familia) {
                $this->query = "INSERT INTO `economias`(
                	`id_familia`,
					`actividad_economica`,
					`descripcion_ventas`,
					`ingreso_familiar`)
					VALUES (
                	'".$id_familia."',
                	'".$actividad_economica."',
                	'".$descripcion_ventas."',
                	'".$ingreso_familiar."')";
                $this->execute_single_query();
                $this->mensaje = 'exito';
        } else {
            $this->mensaje = false;
        }

    }
    public function familiar($id_familia='',$id_familiar='',$parentesco=''){
        if($id_familia) {
            //var_dump($id_jefe);
                $this->query = "INSERT INTO `familiares`(`id_familia`,`id_familiar`,`parentesco`) VALUES ('$id_familia','$id_familiar','$parentesco')";
                $this->execute_single_query();
                $this->mensaje = true;
        } else {
            $this->mensaje = false;
        }
    }

    public function edit(){

    }
    public function delete(){

    }
}