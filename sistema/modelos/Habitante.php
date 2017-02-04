<?php
require_once('conexion_BD.php');
/**
* 
*/
class Habitante extends DBAbstractModel
{
	#Trae los datos del Habitante
	public function get($habitante=''){
		if($habitante != '') {
            $this->query = "
                SELECT      *
                FROM        habitantes
                WHERE       id = '$habitante' OR cedula = '$habitante'
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
        $this->query = "SELECT  
        f.id_jefe, 
        h.id ,
        h.nombre, 
        h.apellido,
        h.cedula,
        h.fecha_nacimiento, 
        fv.id_vivienda, 
        fv.id_familia, 
        v.numero_vivienda, 
        h.nacionalidad FROM habitantes h
            LEFT JOIN familiares fs ON h.id=fs.id_familiar 
            LEFT JOIN familias  f ON h.id=f.id_jefe
            LEFT JOIN familia_vivienda fv ON f.id=fv.id_familia OR fs.id_familia=fv.id_familia
            LEFT JOIN viviendas v ON fv.id_familia=v.id
            WHERE 
               (
                   `fs`.`id_familiar`= `h`.`id`
                   OR
                   `f`.`id_jefe`= `h`.`id`
               )
            GROUP BY h.id";
        $this->get_results_from_query();

        if(count($this->rows) >0) {
            $this->mensaje = '1';
            return $this->rows;
        } else {
            return $this->mensaje = '0';
        }

    }
    public function set($atributos='',$valor='',$cedula=''){
        if($cedula) {
            $this->get($cedula);
            if($cedula != $this->cedula) {
                $this->query = "INSERT INTO habitantes ($atributos) VALUES ($valor)";
                $this->execute_single_query();
                $this->mensaje = 'exito';
            } else {
                $this->mensaje = 'existe';
            }
        } else {
            $this->mensaje = false;
        }

    }

    public function edit($atributosValores='',$id_habitante='',$cedula=''){
        if($id_habitante!='') {
            $this->query = "UPDATE habitantes SET ".$atributosValores['atributosValores']."  WHERE id ='$id_habitante'";
            $this->execute_single_query();
            $this->mensaje = 'exito';
        } else {
            $this->mensaje = false;
        }

    }
    public function delete($id_habitante=''){

    }
    public function relacionVivienda($id_habitante=''){
        if ($id_habitante!='') {
            $this->query = "SELECT familia_vivienda.id_vivienda, familia_vivienda.id_familia   FROM habitantes 
            LEFT JOIN familiares ON habitantes.id=familiares.id_familiar 
            LEFT JOIN familias ON habitantes.id=familias.id_jefe
            LEFT JOIN familia_vivienda ON familias.id=familia_vivienda.id_familia OR familiares.id_familia=familia_vivienda.id_familia
            WHERE 
            (
                `familiares`.`id_familiar`= `habitantes`.`id`
                OR
                `familias`.`id_jefe`= `habitantes`.`id`
            )
            AND `habitantes`.`id`='".$id_habitante."'
            GROUP BY habitantes.id";
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
}