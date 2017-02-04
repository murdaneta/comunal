<?php
require_once('controlador_vista.php');
require_once('../librerias/fpdf/fpdf.php');
/**
* 
*/
class pdfControlador
{

	static function habitantes($mensaje=array()){
		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->SetFont('Arial', '', 10);
		//$pdf->Image('../recursos/tienda.gif' , 10 ,8, 10 , 13,'GIF');
		//$pdf->Cell(18, 10, '', 0);
		$pdf->Cell(135.5, 10, 'GRAMOVEN I', 0);
		$pdf->SetFont('Arial', '', 9);
		$pdf->Cell(50, 10, 'Fecha: '.date('d-m-Y h:i:s a').'', 0);
		$pdf->Ln(15);
		$pdf->SetFont('Arial', 'B', 15);
		$pdf->Cell(65, 8, '', 0);
		$pdf->Cell(100, 8, 'Listado de Habitantes',0);
		$pdf->Ln(15);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->SetFillColor(221, 219, 219);
		$pdf->SetDrawColor(221, 219, 219);
		$pdf->Cell(40, 8, 'Nombre', 0.5,0,'',True);
		$pdf->Cell(40, 8, 'Apellido', 0.5,0,'',True);
		$pdf->Cell(20, 8, 'Cedula', 0.5,0,'',True);
		$pdf->Cell(30, 8, 'Fecha de Nacimineto', 0.5,0,'C',True);
		$pdf->Cell(30, 8, 'Numero de Casa', 0.5,0,'C',True);
		$pdf->Cell(25, 8, 'Nacionalidad', 0.5,0,'',True);
		$pdf->Ln(8);
		$pdf->SetFont('Arial', '', 8);
		$pdf->SetFillColor(255, 255, 255);
		$habitante=new Habitante();
		$todos=$habitante->all();
		if ($todos) {
			foreach ($todos as $habitante) {
				foreach ($habitante as $propiedad=>$valor) {
					if ($propiedad== 'nombre') {
						$pdf->Cell(40, 8,$valor, 1);						
					}
					elseif ($propiedad== 'apellido') {
						$pdf->Cell(40, 8,$valor, 1);
					}
					elseif ($propiedad== 'cedula') {
						$pdf->Cell(20, 8,$valor, 1,0,'');
					}
					elseif ($propiedad== 'fecha_nacimiento') {
						$pdf->Cell(30, 8,$valor, 1,0,'C');
					}
					elseif ($propiedad== 'numero_vivienda') {
						$pdf->Cell(30, 8,$valor, 1,0,'C');
					}
					elseif ($propiedad== 'nacionalidad') {
						$pdf->Cell(25, 8,$valor, 1);
						$pdf->Ln(8);
					}
		        };
	        };
		}else{
			$pdf->SetFont('Arial', 'B', 8);
			$pdf->Cell(185, 8,'No hay Habitantes registrados', 1,0,'C');
						$pdf->Ln(8);
		}
		$pdf->Output();
		//echo "hola mundo ";
	}
	static function residencia(){
		$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
		if (isset($_POST['cedula'])) {
			$habitante= new Habitante();
			$habitante->get($_POST['cedula']);
			if ($habitante->mensaje) {
				$pdf = new FPDF();
				$pdf->AddPage();
				$pdf->SetFont('Arial', '', 10);
				$pdf->Image('../../creativo/fotos/foto.jpg' , 10 ,10, 28 , 20,'JPG');
				$pdf->Image('../../creativo/fotos/foto2.jpg' , 170 ,10, 28 , 22,'JPG');
				//$pdf->Cell(18, 10, '', 0);
				$pdf->Cell(50, 5, '', 0);
				$pdf->Cell(86, 5, 'REPUBLICA BOLIVARIANA DE VENEZUELA', 0,0,'C');
				$pdf->SetFont('Arial', '', 9);
				$pdf->Cell(50, 5, '', 0);
				$pdf->Ln(5);
				$pdf->Cell(186, 5, 'MARACAIBO ESTADO- ZULIA', 0,0,'C');
				$pdf->Ln(5);
				$pdf->Cell(186, 5, 'CIUDAD LOSSADA- SECTOR CONJUNTO URBANISTICO GRAMOVEN l', 0,0,'C');
				$pdf->Ln(5);
				$pdf->Cell(186, 5, 'CONSEJO COMUNAL CONJUNTO URBANISTICO GRAMOVEN l', 0,0,'C');
				$pdf->Ln(5);
				$pdf->SetFont('Arial', 'B', 10);
				$pdf->Cell(186, 5, 'J-404696083', 0,0,'C');
				$pdf->Ln(15);
				$pdf->SetFont('Arial', 'B', 15);
				$pdf->Cell(186, 8, 'CONSTANCIA DE RESIDENCIA',0,0,'C');
				$pdf->Ln(15);
				$pdf->SetFont('Arial', '', 10);
				$pdf->MultiCell(186, 8, utf8_decode("Nosotros, Benjamín Segundo González Fernández, Ángela Escacia y Francisco Javier Diaz Padilla venezolano, mayor de edad, titular de la cedula identidad Nº 20.204.375, 6.885.286 y 9.444.405 actuado de carácter de vocero  del consejo comunal conjunto urbanístico gramoven l del sector ciudad lossada en la jurisdicción de la parroquia Idelfonso Vásquez del municipio Maracaibo del Estado Zulia, por medio de la presente "),0,'J',0);
				$pdf->SetFont('Arial', 'B', 10);
				$pdf->Ln(15);
				$pdf->Cell(186, 5, 'HACE CONSTAR',0,0,'C');
				$pdf->Ln(15);
				$date_actual = date('Y-m-d');//
				$diff = abs(strtotime($date_actual) - strtotime("$habitante->fecha_nacimiento"));
				$edad = floor($diff / (365*60*60*24));
				$diff2 = abs(strtotime($date_actual) - strtotime("2014-02-14"));
				$time = floor($diff2 / (30*60*60*24));
				if ($time<=12) {
					if ($time<=1) {
						$time =$time." mes";
					}else{
						$time =$time." meses";
					}
				}else{
					$time =floor($diff2 / (365*60*60*24));
					if ($time<=1) {
						$time =$time." año";
					}else{
						$time =$time." años";
					}
				}

				$pdf->MultiCell(186, 8, utf8_decode("Que el (la) Ciudadano ".$habitante->nombre." ".$habitante->apellido." Titular de la Cedula de Identidad: Nº: ".$habitante->cedula."  De ".$edad." año de edad,  Reside  en la siguiente dirección:_________________________________________________ desde hace ".$time." Quien ha demostrado  ser cumplidor(a) con las norma de Convivencia Comunitaria."),0,'J',0);
				$pdf->Ln(5);
				$fecha=" ".date('d')." del mes de ".$meses[date('n')-1]. " del ".date('Y');
				$pdf->MultiCell(186, 8, utf8_decode("Constancia que se expide a petición de la parte interesada solo para trámite de:______________________, en la Ciudad de Maracaibo a los".$fecha.", a las ".date('h:i:s a')),0,'J',0);
				$pdf->Ln(5);
				$pdf->Cell(186, 8, 'Quienes suscribe por el consejo comunal',0,0,'C');
				$pdf->Ln(25);
				$pdf->Cell(62, 8, '________________________',0,0,'C');
				$pdf->Cell(62, 8, '________________________',0,0,'C');
				$pdf->Cell(62, 8, '________________________',0,0,'C');
				$pdf->Ln(5);
				$pdf->Cell(62, 8, 'BENJAMIN GONZALEZ',0,0,'C');
				$pdf->Cell(62, 8, 'ANGELA ESCACIA',0,0,'C');
				$pdf->Cell(62, 8, 'FRANCISCO DIAZ',0,0,'C');
				$pdf->Ln(5);
				$pdf->Cell(62, 8, 'UNIDAD ADMINISTRATIVA',0,0,'C');
				$pdf->Cell(62, 8, 'CONTRALORIA SOCIAL',0,0,'C');
				$pdf->Cell(62, 8, 'UNIDAD ADMINISTRATIVA',0,0,'C');
				$pdf->Ln(5);
				$pdf->Cell(62, 8, 'CEDULA: 20.204.375',0,0,'C');
				$pdf->Cell(62, 8, 'CEDULA: 6.885.286',0,0,'C');
				$pdf->Cell(62, 8, 'CEDULA: 9.444.405',0,0,'C');
				$pdf->Ln(5);
				$pdf->Cell(62, 8, 'TELF: 0424.605.92.23',0,0,'C');
				$pdf->Cell(62, 8, 'TELF: 0416.016.38.56',0,0,'C');
				$pdf->Cell(62, 8, 'TELF: 0426.165.84.85',0,0,'C');
				$pdf->Ln(40);
				$pdf->SetFont('Arial', 'B', 8);
				$pdf->MultiCell(186, 5, 'EL CONJUNTO URBANISTICO GRAMOVEN l ESTA UBICADA DESTRAS DE COMANDO GAES ENTRE AV. 22-A CON CALLE 39B NUESTRA OFICINA ES   39A-109',0,'C',0);
				
				$pdf->Cell(186, 5, 'TELEFO:  0261. 745.13.81',0,0,'C');
				$pdf->Output();
			}else{
				Vistas::retornar_vista('principal',array(),array(
					'mensaje' => 'Lo sentimos pero el numero de cedula: '
					.$_POST['cedula'].
					' no se encuentra registrad','tipo_mensaje' => 'warning'));
			}
		}else{
			Vistas::retornar_vista('principal',array(),array(
					'mensaje' => 'Debe ingresar el numero de cedula para generar la Carta de Residecia','tipo_mensaje' => 'info'));
		}		
	}
	static function buena_conducta(){
		$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
		if (isset($_POST['cedula'])) {
			$habitante= new Habitante();
			$testigo1= new Habitante();
			$testigo2= new Habitante();
			$habitante->get($_POST['cedula']);
			$testigo1->get($_POST['cedula_testigo1']);
			$testigo2->get($_POST['cedula_testigo2']);
			if ($habitante->mensaje && $testigo1->mensaje && $testigo2->mensaje) {
				$pdf = new FPDF();
				$pdf->AddPage();
				$pdf->SetFont('Arial', '', 10);
				$pdf->Image('../../creativo/fotos/foto.jpg' , 10 ,10, 28 , 20,'JPG');
				$pdf->Image('../../creativo/fotos/foto2.jpg' , 170 ,10, 28 , 22,'JPG');
				//$pdf->Cell(18, 10, '', 0);
				$pdf->Cell(50, 5, '', 0);
				$pdf->Cell(86, 5, 'REPUBLICA BOLIVARIANA DE VENEZUELA', 0,0,'C');
				$pdf->SetFont('Arial', '', 9);
				$pdf->Cell(50, 5, '', 0);
				$pdf->Ln(5);
				$pdf->Cell(186, 5, 'MARACAIBO ESTADO- ZULIA', 0,0,'C');
				$pdf->Ln(5);
				$pdf->Cell(186, 5, 'CIUDAD LOSSADA- SECTOR CONJUNTO URBANISTICO GRAMOVEN l', 0,0,'C');
				$pdf->Ln(5);
				$pdf->Cell(186, 5, 'CONSEJO COMUNAL CONJUNTO URBANISTICO GRAMOVEN l', 0,0,'C');
				$pdf->Ln(5);
				$pdf->SetFont('Arial', 'B', 10);
				$pdf->Cell(186, 5, 'J-404696083', 0,0,'C');
				$pdf->Ln(15);
				$pdf->SetFont('Arial', 'B', 15);
				$pdf->Cell(186, 8, 'CONSTANCIA DE BUENA CONDUCTA',0,0,'C');
				$pdf->Ln(15);
				$pdf->SetFont('Arial', '', 10);
				$pdf->MultiCell(186, 8, utf8_decode("El consejo comunal Conjunto Urbanístico. Gramoven l, en su ámbito geográfico determinado por las familias adjudicadas que habitan en este sector, desde la Manzana Nº 1 Dometila flores hasta la Manzana Nº 8 de la casita, por medio de la presente"),0,'J',0);
				$pdf->SetFont('Arial', 'B', 10);
				$pdf->Ln(5);
				$pdf->Cell(186, 0, 'HACE CONSTAR',0,0,'C');
				$pdf->Ln(5);
				$date_actual = date('Y-m-d');//
				$diff = abs(strtotime($date_actual) - strtotime("$habitante->fecha_nacimiento"));
				$edad = floor($diff / (365*60*60*24));
				$diff2 = abs(strtotime($date_actual) - strtotime("2014-02-14"));
				$time = floor($diff2 / (30*60*60*24));
				if ($time<=12) {
					if ($time<=1) {
						$time =$time." mes";
					}else{
						$time =$time." meses";
					}
				}else{
					$time =floor($diff2 / (365*60*60*24));
					if ($time<=1) {
						$time =$time." año";
					}else{
						$time =$time." años";
					}
				}

				$pdf->MultiCell(186, 8, utf8_decode("Que el (la) Ciudadano ".$habitante->nombre." ".$habitante->apellido." Titular de la Cedula de Identidad: Nº: ".$habitante->cedula."  De ".$edad." año de edad, De Ocupación: ".$habitante->oficio."  Reside  en la siguiente dirección:__________________________________________ desde hace ".$time." hasta la fecha ha CONSERNADO UNA CONDUCTA ADECUADA A LA NORMA DE CIUDADANIA Y CONVIVENCIA COMUNITARIA."),0,'J',0);
				$pdf->MultiCell(186, 8, utf8_decode("Para testificar lo ante expuesto  presentaron a los ciudadanos (a): ".$testigo1->nombre." ".$testigo1->apellido." y ".$testigo2->nombre." ".$testigo2->apellido.". Mayores de edad portadores de la cedula de identidad: ".$testigo1->cedula." y ".$testigo2->cedula." reside en esta comunidad."),0,'J',0);
				$pdf->Ln(2);
				$fecha=" ".date('d')." del mes de ".$meses[date('n')-1]. " del ".date('Y');
				$pdf->MultiCell(186, 8, utf8_decode("Constancia que se expide a petición de la parte interesada solo para trámite de:______________________, en la Ciudad de Maracaibo a los".$fecha.", a las ".date('h:i:s a')),0,'J',0);
				$pdf->Ln(5);
				$pdf->Cell(186, 8, 'Quienes suscribe por el consejo comunal',0,0,'C');
				$pdf->Ln(20);
				$pdf->Cell(62, 8, '________________________',0,0,'C');
				$pdf->Cell(62, 8, '________________________',0,0,'C');
				$pdf->Cell(62, 8, '________________________',0,0,'C');
				$pdf->Ln(5);
				$pdf->Cell(62, 8, 'BENJAMIN GONZALEZ',0,0,'C');
				$pdf->Cell(62, 8, 'ANGELA ESCACIA',0,0,'C');
				$pdf->Cell(62, 8, 'FRANCISCO DIAZ',0,0,'C');
				$pdf->Ln(5);
				$pdf->Cell(62, 8, 'UNIDAD ADMINISTRATIVA',0,0,'C');
				$pdf->Cell(62, 8, 'CONTRALORIA SOCIAL',0,0,'C');
				$pdf->Cell(62, 8, 'UNIDAD ADMINISTRATIVA',0,0,'C');
				$pdf->Ln(5);
				$pdf->Cell(62, 8, 'CEDULA: 20.204.375',0,0,'C');
				$pdf->Cell(62, 8, 'CEDULA: 6.885.286',0,0,'C');
				$pdf->Cell(62, 8, 'CEDULA: 9.444.405',0,0,'C');
				$pdf->Ln(5);
				$pdf->Cell(62, 8, 'TELF: 0424.605.92.23',0,0,'C');
				$pdf->Cell(62, 8, 'TELF: 0416.016.38.56',0,0,'C');
				$pdf->Cell(62, 8, 'TELF: 0426.165.84.85',0,0,'C');
				$pdf->Ln(40);
				$pdf->SetFont('Arial', 'B', 8);
				$pdf->MultiCell(186, 5, 'EL CONJUNTO URBANISTICO GRAMOVEN l ESTA UBICADA DESTRAS DE COMANDO GAES ENTRE AV. 22-A CON CALLE 39B NUESTRA OFICINA ES   39A-109',0,'C',0);
				
				$pdf->Cell(186, 5, 'TELEFO:  0261. 745.13.81',0,0,'C');
				$pdf->Output();
			}else{

				if ($habitante->mensaje) {
					$hbc='<li> habitante solicitante'.$_POST['cedula'].'(si existe)</li>';
				}else{
					$hbc='<li class="text-danger"> habitante solicitante: '.$_POST['cedula'].'(no existe)</li>';
				}
				if ($testigo1->mensaje) {
					$hpt='<li>primer testigo: '.$_POST['cedula_testigo1'].'(si existe)</li>';
				}else{
					$hpt='<li class="text-danger"> primer testigo: '.$_POST['cedula_testigo1'].'(no existe)</li>';
				}
				if ($testigo2->mensaje) {
					$hst='<li>segundo testigo: '.$_POST['cedula_testigo2'].'(si existe)</li>';
				}else{
					$hst='<li class="text-danger">segundo testigo: '.$_POST['cedula_testigo2'].'(no existe)</li>';
				}
				Vistas::retornar_vista('principal',array(),array(
					'mensaje' => "Lo sentimos pero algunos de los numeros de cedulas no existen en el sistema: 
									<br><ul>$hbc $hpt $hst</ul>",'tipo_mensaje' => 'warning'));
			}
		}else{
			Vistas::retornar_vista('principal',array(),array(
					'mensaje' => 'Debe ingresar el numero de cedula para generar la Carta de Buena Conducta','tipo_mensaje' => 'info'));
		}
	}
	static function solteria(){
		$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
		if (isset($_POST['cedula'])) {
			$habitante= new Habitante();
			$testigo1= new Habitante();
			$testigo2= new Habitante();
			$habitante->get($_POST['cedula']);
			$testigo1->get($_POST['cedula_testigo_1']);
			$testigo2->get($_POST['cedula_testigo_2']);
			if ($habitante->mensaje && $testigo1->mensaje && $testigo2->mensaje) {
				$pdf = new FPDF();
				$pdf->AddPage();
				$pdf->SetFont('Arial', '', 10);
				$pdf->Image('../../creativo/fotos/foto.jpg' , 10 ,10, 28 , 20,'JPG');
				$pdf->Image('../../creativo/fotos/foto2.jpg' , 170 ,10, 28 , 22,'JPG');
				//$pdf->Cell(18, 10, '', 0);
				$pdf->Cell(50, 5, '', 0);
				$pdf->Cell(86, 5, 'REPUBLICA BOLIVARIANA DE VENEZUELA', 0,0,'C');
				$pdf->SetFont('Arial', '', 9);
				$pdf->Cell(50, 5, '', 0);
				$pdf->Ln(5);
				$pdf->Cell(186, 5, 'MARACAIBO ESTADO- ZULIA', 0,0,'C');
				$pdf->Ln(5);
				$pdf->Cell(186, 5, 'CIUDAD LOSSADA- SECTOR CONJUNTO URBANISTICO GRAMOVEN l', 0,0,'C');
				$pdf->Ln(5);
				$pdf->Cell(186, 5, 'CONSEJO COMUNAL CONJUNTO URBANISTICO GRAMOVEN l', 0,0,'C');
				$pdf->Ln(5);
				$pdf->SetFont('Arial', 'B', 10);
				$pdf->Cell(186, 5, 'J-404696083', 0,0,'C');
				$pdf->Ln(15);
				$pdf->SetFont('Arial', 'B', 15);
				$pdf->Cell(186, 8, 'CONSTANCIA DE SOLTERIA',0,0,'C');
				$pdf->Ln(15);
				$pdf->SetFont('Arial', '', 10);
				$pdf->MultiCell(186, 8, utf8_decode("El consejo comunal Conjunto Urbanístico. Gramoven l, en su ámbito geográfico determinado por las familias adjudicadas que habitan en este sector, desde la Manzana Nº 1 Dometila flores hasta la Manzana Nº 8 de la casita, por medio de la presente"),0,'J',0);
				$pdf->SetFont('Arial', 'B', 10);
				$pdf->Ln(5);
				$pdf->Cell(186, 0, 'HACE CONSTAR',0,0,'C');
				$pdf->Ln(5);
				$date_actual = date('Y-m-d');//
				$diff = abs(strtotime($date_actual) - strtotime("$habitante->fecha_nacimiento"));
				$edad = floor($diff / (365*60*60*24));
				$diff2 = abs(strtotime($date_actual) - strtotime("2014-02-14"));
				$time = floor($diff2 / (30*60*60*24));
				if ($time<=12) {
					if ($time<=1) {
						$time =$time." mes";
					}else{
						$time =$time." meses";
					}
				}else{
					$time =floor($diff2 / (365*60*60*24));
					if ($time<=1) {
						$time =$time." año";
					}else{
						$time =$time." años";
					}
				}

				$pdf->MultiCell(186, 8, utf8_decode("Que se han presentado ante este despacho los ciudadanos (as): ".$testigo1->nombre." ".$testigo1->apellido." y ".$testigo2->nombre." ".$testigo2->apellido.". Mayores de edad portadores de la cedula de identidad: ".$testigo1->cedula." y ".$testigo2->cedula.". quienes manifestaron conocer desde hace varios años, de vista, trato y comunicación a (el) (la) ciudadano(a): ".$habitante->nombre." ".$habitante->apellido." Titular de la Cedula de Identidad: Nº: ".$habitante->cedula."  De ".$edad." año de edad, Reside  en la siguiente dirección:__________________________________________ desde hace ".$time.", hasta la fecha ha es de estado Civil Soltero (a)."),0,'J',0);
				$pdf->Ln(2);
				$fecha=" ".date('d')." del mes de ".$meses[date('n')-1]. " del ".date('Y');
				$pdf->MultiCell(186, 8, utf8_decode("Constancia que se expide a petición de la parte interesada solo para trámite de:______________________, en la Ciudad de Maracaibo a los".$fecha.", a las ".date('h:i:s a')),0,'J',0);
				$pdf->Ln(5);
				$pdf->Cell(186, 8, 'Quienes suscribe por el consejo comunal',0,0,'C');
				$pdf->Ln(20);
				$pdf->Cell(62, 8, '________________________',0,0,'C');
				$pdf->Cell(62, 8, '________________________',0,0,'C');
				$pdf->Cell(62, 8, '________________________',0,0,'C');
				$pdf->Ln(5);
				$pdf->Cell(62, 8, 'BENJAMIN GONZALEZ',0,0,'C');
				$pdf->Cell(62, 8, 'ANGELA ESCACIA',0,0,'C');
				$pdf->Cell(62, 8, 'FRANCISCO DIAZ',0,0,'C');
				$pdf->Ln(5);
				$pdf->Cell(62, 8, 'UNIDAD ADMINISTRATIVA',0,0,'C');
				$pdf->Cell(62, 8, 'CONTRALORIA SOCIAL',0,0,'C');
				$pdf->Cell(62, 8, 'UNIDAD ADMINISTRATIVA',0,0,'C');
				$pdf->Ln(5);
				$pdf->Cell(62, 8, 'CEDULA: 20.204.375',0,0,'C');
				$pdf->Cell(62, 8, 'CEDULA: 6.885.286',0,0,'C');
				$pdf->Cell(62, 8, 'CEDULA: 9.444.405',0,0,'C');
				$pdf->Ln(5);
				$pdf->Cell(62, 8, 'TELF: 0424.605.92.23',0,0,'C');
				$pdf->Cell(62, 8, 'TELF: 0416.016.38.56',0,0,'C');
				$pdf->Cell(62, 8, 'TELF: 0426.165.84.85',0,0,'C');
				$pdf->Ln(40);
				$pdf->SetFont('Arial', 'B', 8);
				$pdf->MultiCell(186, 5, 'EL CONJUNTO URBANISTICO GRAMOVEN l ESTA UBICADA DESTRAS DE COMANDO GAES ENTRE AV. 22-A CON CALLE 39B NUESTRA OFICINA ES   39A-109',0,'C',0);
				
				$pdf->Cell(186, 5, 'TELEFO:  0261. 745.13.81',0,0,'C');
				$pdf->Output();
			}else{

				if ($habitante->mensaje) {
					$hbc='<li> habitante solicitante'.$_POST['cedula'].'(si existe)</li>';
				}else{
					$hbc='<li class="text-danger"> habitante solicitante: '.$_POST['cedula'].'(no existe)</li>';
				}
				if ($testigo1->mensaje) {
					$hpt='<li>primer testigo: '.$_POST['cedula_testigo_1'].'(si existe)</li>';
				}else{
					$hpt='<li class="text-danger"> primer testigo: '.$_POST['cedula_testigo_1'].'(no existe)</li>';
				}
				if ($testigo2->mensaje) {
					$hst='<li>segundo testigo: '.$_POST['cedula_testigo_2'].'(si existe)</li>';
				}else{
					$hst='<li class="text-danger">segundo testigo: '.$_POST['cedula_testigo_2'].'(no existe)</li>';
				}
				Vistas::retornar_vista('principal',array(),array(
					'mensaje' => "Lo sentimos pero algunos de los numeros de cedulas no existen en el sistema: 
									<br><ul>$hbc $hpt $hst</ul>",'tipo_mensaje' => 'warning'));
			}
		}else{
			Vistas::retornar_vista('principal',array(),array(
					'mensaje' => 'Debe ingresar el numero de cedula para generar la Carta de Solteria','tipo_mensaje' => 'info'));
		}
	}
	static function no_poseer_vivienda(){
	}
	static function union_concubinaria(){
		$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
		if (isset($_POST['cedula1']) && isset($_POST['cedula2'])) {
			$habitante1= new Habitante();
			$habitante2= new Habitante();
			$testigo1= new Habitante();
			$testigo2= new Habitante();
			$habitante1->get($_POST['cedula1']);
			$habitante2->get($_POST['cedula2']);
			$testigo1->get($_POST['cedula_testigo_1_c']);
			$testigo2->get($_POST['cedula_testigo_2_c']);
			if ($habitante1->mensaje && $habitante2->mensaje && $testigo1->mensaje && $testigo2->mensaje) {
				$pdf = new FPDF();
				$pdf->AddPage();
				$pdf->SetFont('Arial', '', 10);
				$pdf->Image('../../creativo/fotos/foto.jpg' , 10 ,10, 28 , 20,'JPG');
				$pdf->Image('../../creativo/fotos/foto2.jpg' , 170 ,10, 28 , 22,'JPG');
				//$pdf->Cell(18, 10, '', 0);
				$pdf->Cell(50, 5, '', 0);
				$pdf->Cell(86, 5, 'REPUBLICA BOLIVARIANA DE VENEZUELA', 0,0,'C');
				$pdf->SetFont('Arial', '', 9);
				$pdf->Cell(50, 5, '', 0);
				$pdf->Ln(5);
				$pdf->Cell(186, 5, 'MARACAIBO ESTADO- ZULIA', 0,0,'C');
				$pdf->Ln(5);
				$pdf->Cell(186, 5, 'CIUDAD LOSSADA- SECTOR CONJUNTO URBANISTICO GRAMOVEN l', 0,0,'C');
				$pdf->Ln(5);
				$pdf->Cell(186, 5, 'CONSEJO COMUNAL CONJUNTO URBANISTICO GRAMOVEN l', 0,0,'C');
				$pdf->Ln(5);
				$pdf->SetFont('Arial', 'B', 10);
				$pdf->Cell(186, 5, 'J-404696083', 0,0,'C');
				$pdf->Ln(15);
				$pdf->SetFont('Arial', 'B', 15);
				$pdf->Cell(186, 8, 'CONSTANCIA DE UNION  CONCUBINARIA',0,0,'C');
				$pdf->Ln(15);
				$pdf->SetFont('Arial', '', 10);
				$pdf->MultiCell(186, 8, utf8_decode("El consejo comunal Conjunto Urbanístico. Gramoven l, en su ámbito geográfico determinado por las familias adjudicadas que habitan en este sector, desde la Manzana Nº 1 Dometila flores hasta la Manzana Nº 8 de la casita, por medio de la presente"),0,'J',0);
				$pdf->SetFont('Arial', 'B', 10);
				$pdf->Ln(5);
				$pdf->Cell(186, 0, 'HACE CONSTAR',0,0,'C');
				$pdf->Ln(5);
				$date_actual = date('Y-m-d');//
				$diff = abs(strtotime($date_actual) - strtotime("$habitante->fecha_nacimiento"));
				$edad = floor($diff / (365*60*60*24));
				$diff2 = abs(strtotime($date_actual) - strtotime("2014-02-14"));
				$time = floor($diff2 / (30*60*60*24));
				if ($time<=12) {
					if ($time<=1) {
						$time =$time." mes";
					}else{
						$time =$time." meses";
					}
				}else{
					$time =floor($diff2 / (365*60*60*24));
					if ($time<=1) {
						$time =$time." año";
					}else{
						$time =$time." años";
					}
				}

				$pdf->MultiCell(186, 8, utf8_decode("Que ante este despacho, comparecieron los ciudadanos: ".$habitante1->nombre." ".$habitante1->apellido." y ".$habitante2->nombre." ".$habitante2->apellido." ambos mayores de edad, de estado civil soltero, portadores de las Cedulas de Identidad: Nº: ".$habitante1->cedula." y ".$habitante2->cedula."respectivamente, quienes bajo Fe de juramento manifestaron que mantienen una RELACION CONCUBINARIA, desde hace: ____ años.  Del cual  han procreado ____hijos y tiene su domicilio en la siguiente dirección:__________________________________________ ."),0,'J',0);
				$pdf->MultiCell(186, 8, utf8_decode("Para testificar lo ante expuesto  presentaron a los ciudadanos (a): ".$testigo1->nombre." ".$testigo1->apellido." y ".$testigo2->nombre." ".$testigo2->apellido.". Mayores de edad portadores de la cedula de identidad: ".$testigo1->cedula." y ".$testigo2->cedula." reside en esta comunidad."),0,'J',0);
				$pdf->Ln(2);
				$fecha=" ".date('d')." del mes de ".$meses[date('n')-1]. " del ".date('Y');
				$pdf->MultiCell(186, 8, utf8_decode("Constancia que se expide a petición de la parte interesada solo para trámite de:______________________, en la Ciudad de Maracaibo a los".$fecha.", a las ".date('h:i:s a')),0,'J',0);
				$pdf->Ln(5);
				$pdf->Cell(186, 8, 'Quienes suscribe por el consejo comunal',0,0,'C');
				$pdf->Ln(20);
				$pdf->Cell(62, 8, '________________________',0,0,'C');
				$pdf->Cell(62, 8, '________________________',0,0,'C');
				$pdf->Cell(62, 8, '________________________',0,0,'C');
				$pdf->Ln(5);
				$pdf->Cell(62, 8, 'BENJAMIN GONZALEZ',0,0,'C');
				$pdf->Cell(62, 8, 'ANGELA ESCACIA',0,0,'C');
				$pdf->Cell(62, 8, 'FRANCISCO DIAZ',0,0,'C');
				$pdf->Ln(5);
				$pdf->Cell(62, 8, 'UNIDAD ADMINISTRATIVA',0,0,'C');
				$pdf->Cell(62, 8, 'CONTRALORIA SOCIAL',0,0,'C');
				$pdf->Cell(62, 8, 'UNIDAD ADMINISTRATIVA',0,0,'C');
				$pdf->Ln(5);
				$pdf->Cell(62, 8, 'CEDULA: 20.204.375',0,0,'C');
				$pdf->Cell(62, 8, 'CEDULA: 6.885.286',0,0,'C');
				$pdf->Cell(62, 8, 'CEDULA: 9.444.405',0,0,'C');
				$pdf->Ln(5);
				$pdf->Cell(62, 8, 'TELF: 0424.605.92.23',0,0,'C');
				$pdf->Cell(62, 8, 'TELF: 0416.016.38.56',0,0,'C');
				$pdf->Cell(62, 8, 'TELF: 0426.165.84.85',0,0,'C');
				$pdf->Ln(40);
				$pdf->SetFont('Arial', 'B', 8);
				$pdf->MultiCell(186, 5, 'EL CONJUNTO URBANISTICO GRAMOVEN l ESTA UBICADA DESTRAS DE COMANDO GAES ENTRE AV. 22-A CON CALLE 39B NUESTRA OFICINA ES   39A-109',0,'C',0);
				
				$pdf->Cell(186, 5, 'TELEFO:  0261. 745.13.81',0,0,'C');
				$pdf->Output();
			}else{

				if ($habitante1->mensaje) {
					$hb1='<li> habitante solicitante(primer concubino): '.$_POST['cedula1'].'(si existe)</li>';
				}else{
					$hb1='<li class="text-danger"> habitante solicitante(primer concubino): '.$_POST['cedula1'].'(no existe)</li>';
				}
				if ($habitante2->mensaje) {
					$hb2='<li> habitante solicitante(segundo concubino): '.$_POST['cedula2'].'(si existe)</li>';
				}else{
					$hb2='<li class="text-danger"> habitante solicitante(segundo concubino): '.$_POST['cedula2'].'(no existe)</li>';
				}
				if ($testigo1->mensaje) {
					$hpt='<li>primer testigo: '.$_POST['cedula_testigo_1_c'].'(si existe)</li>';
				}else{
					$hpt='<li class="text-danger"> primer testigo: '.$_POST['cedula_testigo_1_c'].'(no existe)</li>';
				}
				if ($testigo2->mensaje) {
					$hst='<li>segundo testigo: '.$_POST['cedula_testigo_2_c'].'(si existe)</li>';
				}else{
					$hst='<li class="text-danger">segundo testigo: '.$_POST['cedula_testigo_2_c'].'(no existe)</li>';
				}
				Vistas::retornar_vista('principal',array(),array(
					'mensaje' => "Lo sentimos pero algunos de los numeros de cedulas no existen en el sistema: 
									<br><ul>$hb1 $hb2 $hpt $hst</ul>",'tipo_mensaje' => 'warning'));
			}
		}else{
			Vistas::retornar_vista('principal',array(),array(
					'mensaje' => 'Debe ingresar el numero de cedula para generar la Carta de Buena Conducta','tipo_mensaje' => 'info'));
		}
		
	}
}