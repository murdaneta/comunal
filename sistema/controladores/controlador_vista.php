<?php

class Vistas
{
	static function plantilla($form) {
	    $file = '../vistas/'.$form.'.html';
	    $template = file_get_contents($file);
	    return $template;
	}
	static function insertar_datos($html, $datos) {
    foreach ($datos as $clave=>$valor) {
    	if ($clave && $valor) {
       		$html = str_replace('{'.$clave.'}', $valor, $html);
    	}elseif($clave){
    		$html = str_replace('{'.$clave.'}', '', $html);
    	}
    	$html = str_replace('{'."$valor$clave".'}', 'checked', $html);
    	$html = str_replace('{'.$valor.'checked}', 'checked', $html);
    	$html = str_replace('{'."$clave$valor".'}', 'selected="selected"', $html);
    }
    return $html;
	}
	static function retornar_vista($vista='',$datos=array(),$mensaje_vista=array()){
		$html=Sesion::plantilla_session();
		$html = str_replace('{page-wrapper}', Vistas::plantilla($vista), $html);
		if ($datos) {
			$html = Vistas::insertar_datos($html, $datos);
		}
		$html = str_replace('{RAIZ_COMPLEMENTOS}', Vistas::raiz_componenetes(), $html);
		$html = str_replace('{RAIZ_LINK}', Vistas::raiz_link(), $html);
		if ($mensaje_vista) {
			$html=Vistas::mensaje_vista($html,$mensaje_vista);
		}
		print $html;
	}
	static function redireccionar_vista($vista){
		header('Location:'.'http://'.$_SERVER['SERVER_NAME'].RAIZ.$vista);
	}
	static function raiz_componenetes(){
		return 'http://'.$_SERVER['SERVER_NAME'].RAIZ_COMPLEMENTOS;	
	}
	static function raiz_link(){
		return 'http://'.$_SERVER['SERVER_NAME'].RAIZ;	
	}
	static function datos_post(){

	}
	static function datos_get($var_get=''){
		$dato = array();
	    if($_GET) {
	        if(array_key_exists("$var_get", $_GET)) {
	            $dato = $_GET["$var_get"];
	        }
	    }
	    return $dato;
		
	}
	static function mensaje_vista($html,$mensaje = array()){

		$html = str_replace('display: none;', '""', $html);
		$html = str_replace('{MENSAJE}', $mensaje['mensaje'], $html);
		$html = str_replace('{TIPO_MENSAJE}', $mensaje['tipo_mensaje'], $html);
		
		return $html;

	}

}