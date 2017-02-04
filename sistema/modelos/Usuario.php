<?php
require_once('conexion_BD.php');
/**
* 
*/
class Usuario extends DBAbstractModel
{
	#Trae los datos del usuario
	public function get($usuario=''){
		if($usuario != '') {
            $this->query = "
                SELECT      *
                FROM        usuarios
                WHERE       correo = '$usuario' OR id = '$usuario'
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
            $this->correo=null;
            $this->mensaje = '0';
        }

	}
	#crea al usuario
	public function set($atributos='',$valor='',$correo=''){
        if($correo) {
            $this->get($correo);
            if($correo != $this->correo) {
                $this->query = "INSERT INTO usuarios ($atributos) VALUES ($valor)";
                $this->execute_single_query();
                if ($this->booleanoQquery == true) {
                    $this->mensaje = 'exito';
                }else{
                    $this->mensaje = false;    
                }
            } else {
                $this->mensaje = 'existe';
            }
        } else {
            $this->mensaje = false;
        }
    }
    #Traer todos los usuarios
    public function all(){
        $this->query = "SELECT * FROM usuarios WHERE correo != 'admin@gramoven1.com' ";
        $this->get_results_from_query();

        if(count($this->rows) >0) {
            $this->mensaje = '1';
            return $this->rows;
        } else {
            return $this->mensaje = '0';
        }

    }
     #Edita los datos del usuario
    public function edit($atributosValores='',$id_usuario=''){
        if($id_usuario!='') {
            $this->query = "UPDATE usuarios SET ".$atributosValores['atributosValores']."  WHERE id ='$id_usuario'";
            $this->execute_single_query();
            if ($this->booleanoQquery == true) {
                $this->mensaje = 'exito';
            }else{
                $this->mensaje = false;    
            }
        } else {
            $this->mensaje = false;
        }

    }
    #Elimina al usuario
    public function delete($user_id=0) {
        $user_id=(int)$user_id;
        //var_dump($user_id);
        $this->query = "DELETE FROM usuarios WHERE id = $user_id";
        $this->execute_single_query();
        //var_dump($this->booleanoQquery);
        $this->mensaje =  true;
    }
}