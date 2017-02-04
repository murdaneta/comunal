<?php
require_once('controlador_vista.php');
/**
* 
*/
class Principal
{
	static function vista(){
		Vistas::retornar_vista('principal');
	}
}