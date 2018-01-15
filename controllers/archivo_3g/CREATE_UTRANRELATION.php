<?php
require_once("../Control_Archivo.php");
/////////////////////////////////////////////////////////////////////////
//Clase para la contruccion de la estrctura de los archivos xml, mos y mo
//Fecha de creacion: 29-05-2017
//Creador por: Wagner Rivera
//Fecha de Modificación: 01-06-2017
////////////////////////////////////////////////////////////////////////
class CREATE_UTRANRELATION extends Control_Archivos
{
    private $ruta    = "archivos/ENodoB/ENodoB_";
    private $Archivo = "/06.CREATE_UTRANRELATION_";
    private $nombre;
    private $nom_rnc;
	
	public function __construct($nombre_archivo, $nombre_rnc)
	{
        $this->nombre  = $nombre_archivo;
        $this->nom_rnc = $nombre_rnc;
	}
	/////////////////////////////////////////////////////////////////////////
	//Metodo para la creacion del archivo siteinstall el primero de la lista
	//Fecha de creacion: 29-05-2017
	//Creador por: Wagner Rivera
	//Fecha de Modificación: 01-06-2017
	////////////////////////////////////////////////////////////////////////	
	public function CREATE_UTRANRELATION_($p_p_6_1)
	{
		
		$cinsert = '/////////////////////////////////////////////////////////////
//
// SCRIPT     : CREATE IUB
// NEMONICO   : '.$this->nombre.'
// RNC        : '.$this->nom_rnc.'
// GENERADOR  : INCOBECH
// HORA       : '.$this->Horas().'
// FECHA      : '.$this->Fechas().'
//
/////////////////////////////////////////////////////////////
';
		$parte_uno = $this->Crear_cuerpo_uno($p_p_6_1);
		$cinsert  .= $parte_uno; 
        $estructura = $this->ruta.$this->nombre;
        $archivo 	= $estructura.$this->Archivo.$this->nombre.".mo";       
        $this->ElimarArchivo($archivo);       
		$this->CrearArchivo($archivo, $cinsert);	
		return true;	
	}

	public function Crear_cuerpo_uno($p_6_1){
        $contar = 0;
        foreach ($p_6_1 as $key => $value) {
          if($key == 'CELL'){
            foreach ($value as $valor) {
              $CELL[] = $valor;
            }
          }

          if($key == 'CELL_R'){
            foreach ($value as $valor) {
              $CELL_R[] = $valor;
            }
          }

          if($key == 'qOffset1sn'){
            foreach ($value as $valor) {
              $qOffset1sn[] = $valor;
            }
          }
          if($key == 'qOffset2sn'){
            foreach ($value as $valor) {
              $qOffset2sn[] = $valor;
            }
          }
          if($key == 'selectionPriority'){
              foreach ($value as $valor) {
                 $continido_1_1_1 .='
////////////////////////////////////////////////////////////
//UTRAN INTERNAL RELATION: '.$CELL[$contar].' -> '.$CELL_R[$contar].'
////////////////////////////////////////////////////////////

CREATE
(
parent "ManagedElement=1,RncFunction=1,UtranCell='.$CELL[$contar].'"
identity "'.$CELL_R[$contar].'"
moType UtranRelation
exception none
nrOfAttributes 1
utranCellRef Ref "ManagedElement=1,RncFunction=1,UtranCell='.$CELL_R[$contar].'"
)
SET
(
mo "ManagedElement=1,RncFunction=1,UtranCell='.$CELL[$contar].',UtranRelation='.$CELL_R[$contar].'"
exception none
qOffset1sn Integer 0
)
SET
(
mo "ManagedElement=1,RncFunction=1,UtranCell='.$CELL[$contar].',UtranRelation='.$CELL_R[$contar].'"
exception none
qOffset2sn Integer 0
)
SET
(
mo "ManagedElement=1,RncFunction=1,UtranCell='.$CELL[$contar].',UtranRelation='.$CELL_R[$contar].'"
exception none
selectionPriority Integer '.$valor.'
)
//';   
              $contar++;
            }
          }
        }
		return $continido_1_1_1;
	}  

    public function __destruct()
    {
        
    }
}
	
?>