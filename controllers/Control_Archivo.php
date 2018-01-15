<?php

class Control_Archivos{
	//Control para la informacion de las mac de el direcionamiento ip
	public $mask = array ('24' =>'255.255.255.0' ,
			 '25' =>'255.255.255.128' ,
			 '26' =>'255.255.255.192' ,
			 '27' =>'255.255.255.224' ,
			 '28' =>'255.255.255.240' ,
			 '29' =>'255.255.255.248' ,
			 '30' =>'255.255.255.252' 	 
		);

	public $eth = array ("SFP 1bₒ" => "SFP",
							"SFP 3bₒ" => "SFP",
							"ETH 4ₑ" => "gigabit",
							"E1 0-1ₑ" => "SFP",
							"ETH 7ₑ" => "gigabit"
		);

	public $I_RND = array("ANER01" => "203",
							"ANR01" => "201",
							"ANR02" => "202",
							"CHR02" => "805",
							"COER01" => "811",
							"COR02" => "803",
							"COR03" => "804",
							"COR04" => "806",
							"COER01" => "811",
							"CPR01" => "301",
							"CPR02" => "302",
							"CUR01" => "702",
							"CUR02" => "705",
							"CUR03" => "706",
							"CYR01" => "1101",
							"IQR02" => "103",
							"IQR03" => "104",
							"LSR03" => "403",
							"LSR04" => "404",
							"LSER01" => "405",
							"PAR01" => "1201",
							"PMR01" => "1001",
							"PMR02" => "1002",
							"PMR03" => "1004",
							"PR01" => "1390",
							"QUR01" => "504",
							"QUR02" => "507",
							"RAR01" => "601",
							"RAR02" => "602",
							"RAR03" => "603",
							"RAR04" => "604",
							"SAER01" => "1321",
							"SAER02" => "1322",
							"SAER03" => "1323",
							"SAER04" => "1324",
							"SAER05" => "1325",
							"SAER06" => "1326",
							"SAER07" => "1327",
							"SAER08" => "1328",
							"SAR06" => "1306",
							"SAR07" => "1307",
							"SAR08" => "1308",
							"SAR09" => "1309",
							"SAR10" => "1320",
							"SAR11" => "1311",
							"SAR12" => "1312",
							"SAR13" => "1313",
							"SAR14" => "1314",
							"SNR01" => "505",
							"SNR02" => "508",
							"SPER01" => "1330",
							"SPR01" => "1310",
							"TAR01" => "701",
							"TAR02" => "703",
							"TAR03" => "704",
							"TAR04" => "707",
							"TER01" => "901",
							"TER02" => "902",
							"TER03" => "903",
							"VAR03" => "503",
							"VAR04" => "506",
							"VAER01" => "509",
							"SPER01" => "1330",
							"VDR01" => "1003",
							"VDR02" => "1005",
							"CPR04" => "304",
							"CPR03" => "303");
	public $SectorNumero = array('1' => "BU1_A",
							    '2' => "BU1_B",
							    '3' => "BU1_C",
							    '4' => "BU1_A",
							    '5' => "BU1_B",
							    '6' => "BU1_C");
	//Metodo para la creacion de la capetas en diferentes rutas
	protected function crear_carpeta($carpeta){
        if(!file_exists($carpeta)){ 
            mkdir($carpeta, 0777, true);
        }
    }
    //Metodo para crear el archivo dentro la capeta previanemente creada
    protected function CrearArchivo($archivo, $contenido){    	
    	$file=fopen($archivo,"a") or die("Problemas");
		fputs($file,$contenido);
		fputs($file,"\n");			
		fclose($file);
    }
    //Metodo para la eliminacion de los archivos creados
    protected function ElimarArchivo($archivo){
        if(file_exists($archivo)){ 
           unlink($archivo);
        }
    }
    //Metodo para la eliminacion de la carpeta
    protected function eliminarDir($carpeta)
    {
        foreach(glob($carpeta . "/*") as $archivos_carpeta)
        {
     
            if (is_dir($archivos_carpeta))
            {
                eliminarDir($archivos_carpeta);
            }
            else
            {
                unlink($archivos_carpeta);
            }
        }
     	if(file_exists($carpeta))
        	rmdir($carpeta);
    }
    
    public function eliminarDirFinal($carpeta)
    {
        foreach(glob($carpeta . "/*") as $archivos_carpeta)
        {
     
            if (is_dir($archivos_carpeta))
            {
                eliminarDir($archivos_carpeta);
            }
            else
            {
                unlink($archivos_carpeta);
            }
        }
     	if(file_exists($carpeta)){
        	$borrar=rmdir($carpeta);
        	if($borrar){
        		return true;
        	}
        	else{
        		return false;
        	}
     	}
    }
    //Metodo para generar fecha actual de la cracion de los archivos
    protected function Fechas(){
    	date_default_timezone_set('America/Santiago');
        $fecha = date("d").'/'.date("m").'/'.date("Y");
        return $fecha; 
    }
    //Metodo para generar hora actual de la creacio  de los archivos
    protected function Horas(){
    	date_default_timezone_set('America/Santiago');
        $hora = date("H:i:s");
        return $hora; 
    }
}

?>