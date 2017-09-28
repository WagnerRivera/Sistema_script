<?php
require_once("../Control_Archivo.php");
/////////////////////////////////////////////////////////////////////////
//Clase para la contruccion de la estrctura de los archivos xml, mos y mo
//Fecha de creacion: 29-05-2017
//Creador por: Wagner Rivera
//Fecha de Modificación: 01-06-2017
////////////////////////////////////////////////////////////////////////
class CREATE_UTRANCELL_IN_BSC_MSC extends Control_Archivos
{
    private $ruta    = "archivos/ENodoB/ENodoB_";
    private $Archivo = "/12.CREATE_UTRANCELL_IN_BSC_MSC_";
    private $nombre;
    private $nom_rnc;
    private $DEFINITION = array('1' => '
@COMMENT +------------------------------------------------+##
@COMMENT ¦    DEFINITION OF UTRAN CELLS IN MSC ANMS01     ¦##
@COMMENT +------------------------------------------------+##
eaw ANMS01;
@T 2', 
'2' => '
exit;

@COMMENT +------------------------------------------------+##
@COMMENT ¦    DEFINITION OF UTRAN CELLS IN MSC CHMBC01    ¦##
@COMMENT +------------------------------------------------+##
eaw NE=CHMBC01,CSL=1;
@T 2',
'3' => '
exit;

@COMMENT +------------------------------------------------+##
@COMMENT ¦    DEFINITION OF UTRAN CELLS IN MSC COMSS01    ¦##
@COMMENT +------------------------------------------------+##
eaw COMSS01;
@T 2',
'4' => '
exit;

@COMMENT +------------------------------------------------+##
@COMMENT ¦    DEFINITION OF UTRAN CELLS IN MSC PMMSS01    ¦##
@COMMENT +------------------------------------------------+##
eaw PMMSS01;
@T 2',
'5' => '
exit;

@COMMENT +------------------------------------------------+##
@COMMENT ¦    DEFINITION OF UTRAN CELLS IN MSC RAMSS01    ¦##
@COMMENT +------------------------------------------------+##
eaw RAMSS01;
@T 2',
'6' => '
exit;

@COMMENT +------------------------------------------------+##
@COMMENT ¦    DEFINITION OF UTRAN CELLS IN MSC SAMBC01    ¦##
@COMMENT +------------------------------------------------+##
eaw NE=SAMBC01,CSL=1;
@T 2',
'7' => '
exit;

@COMMENT +------------------------------------------------+##
@COMMENT ¦    DEFINITION OF UTRAN CELLS IN MSC SAMS01     ¦##
@COMMENT +------------------------------------------------+##
eaw SAMS01;
@T 2',
'8' => '
exit;

@COMMENT +------------------------------------------------+##
@COMMENT ¦    DEFINITION OF UTRAN CELLS IN MSC SAMSS02    ¦##
@COMMENT +------------------------------------------------+##
eaw SAMSS02;
@T 2',
'9' => '
exit;

@COMMENT +------------------------------------------------+##
@COMMENT ¦    DEFINITION OF UTRAN CELLS IN MSC SAMBC02    ¦##
@COMMENT +------------------------------------------------+##
eaw SAMBC02;
@T 2',
'10' => '
exit;
@COMMENT +------------------------------------------------+##
@COMMENT ¦    DEFINITION OF UTRAN CELLS IN MSC IQMBC01    ¦##
@COMMENT +------------------------------------------------+##
eaw IQMBC01;
@T 2',
'11' => '
exit;

@COMMENT +------------------------------------------------+##
@COMMENT ¦    DEFINITION OF UTRAN CELLS IN MSC VAMSS01    ¦##
@COMMENT +------------------------------------------------+##
eaw VAMSS01;
@T 2');
	
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
	public function CREATE_UTRANCELL_IN_BSC_MSC_($p_p_12_1, $p_p_12_2)
	{
		$parte_uno = $this->Crear_cuerpo_uno($p_p_12_1);
    $parte_2   = $this->Crear_cuerpo_2($p_p_12_2);
		$cinsert  .= $parte_uno;
    $cinsert  .= $parte_2; 
        $estructura = $this->ruta.$this->nombre;
        $archivo 	= $estructura.$this->Archivo.$this->nombre.".mo";
        $this->ElimarArchivo($archivo);
		$this->CrearArchivo($archivo, $cinsert);	
		return true;	
	}

	public function Crear_cuerpo_uno($p_12_1){
      @$continido_1_1_1 .='@COMMENT +------------------------------------------------+##
@COMMENT ¦     DEFINITION OF UTRAN CELLS IN BSC      ¦##
@COMMENT +------------------------------------------------+##
eaw';
      $contar = 0;
      foreach ($p_12_1 as $key => $value) {
        if($key == 'RNC'){
          foreach ($value as $valor) {
             $RNC[] = $valor;
          }
        }

        if($key == 'Utrancell'){
          foreach ($value as $valor) {
            $Utrancell[] = $valor;
          }
        }

        if($key == 'cellBroadcastSac'){
          foreach ($value as $valor) {
             $cellBroadcastSac[] = $valor;
          }
        }

        if($key == 'primaryScramblingCode'){
          foreach ($value as $valor) {
             $primaryScramblingCode[] = $valor;
          }
        }

        if($key == 'uarfcnDl'){
          foreach ($value as $valor) {
            $continido_1_1_1 .='
RLDEI:CELL='.$Utrancell[$contar].',EXT,UTRAN;
RLDEC:CELL='.$Utrancell[$contar].',FDDARFCN='.$valor.',SCRCODE='.$primaryScramblingCode[$contar].',UTRANID=730-01-31312-'.$cellBroadcastSac[$contar].'-'.$this->I_RND[$RNC[$contar]].',MRSL=22;
RLDEP:CELL='.$Utrancell[$contar].';';
        $contar++;
        }
      }
    }
    $continido_1_1_1 .='

@COMMENT +------------------------------------------------+##
@COMMENT ¦     DEFINITION OF UTRAN NEIGHBOURING CELLS     ¦##
@COMMENT +------------------------------------------------+##
RLNRI:CELL=,CELLR=,SINGLE; !!

RLUMC:CELL=,ADD,UMFI=--NODIV; 

exit;
';
		return $continido_1_1_1;
	}

  public function Crear_cuerpo_2($p_12_2){
      $contar = 0;
          foreach ($this->DEFINITION as $key1 => $value1) {
            $continido_1_1_1 .=$value1;
            foreach ($p_12_2 as $key => $value) {
            if($key == 'RNC'){
              foreach ($value as $valor) {
                 $RNC[] = $valor;
              }
            }

            if($key == 'UtranCell'){
              foreach ($value as $valor) {
                $Utrancell[] = $valor;
              }
            }

            if($key == 'LOCNO'){
              foreach ($value as $valor) {
                 $LOCNO[] = $valor;
              }
            }

            if($key == 'RO'){
              foreach ($value as $valor) {
                 $RO[] = $valor;
              }
            }

            if($key == 'EA'){
              foreach ($value as $valor) {
                 $EA[] = $valor;
              }
            }

            if($key == 'ERIND=1'){
              foreach ($value as $valor) {
                 $ERIND1[] = $valor;
              }
            }

            if($key == 'ERIND=2'){
              foreach ($value as $valor) {
                 $ERIND2[] = $valor;
              }
            }

            if($key == 'ERIND=3'){
              foreach ($value as $valor) {
                 $ERIND3[] = $valor;
              }
            }

            if($key == 'ERIND=4'){
              foreach ($value as $valor) {
                 $ERIND4[] = $valor;
              }
            }

            if($key == 'ERIND=5'){
              foreach ($value as $valor) {
                 $ERIND5[] = $valor;
              }
            }

            if($key == 'ERIND=6'){
              foreach ($value as $valor) {
                 $ERIND6[] = $valor;
              }
            }

            if($key == 'ERIND=7'){
              foreach ($value as $valor) {
                 $ERIND7[] = $valor;
              }
            }

            if($key == 'ERIND=8'){
              foreach ($value as $valor) {
                 $ERIND8[] = $valor;
              }
            }

            if($key == 'ERIND=9'){
              foreach ($value as $valor) {
                 $ERIND9[] = $valor;
              }
            }

            if($key == 'ERIND=10'){
              foreach ($value as $valor) {
                 $ERIND10[] = $valor;
              }
            }

            if($key == 'ERIND=11'){
              foreach ($value as $valor) {
                 $ERIND11[] = $valor;
              }
            }

            if($key == 'ERIND=12'){
              foreach ($value as $valor) {
                $continido_1_1_1 .='

MGAAI:AREA='.$Utrancell[$contar].',SAI=730-01-31312-'.substr($Utrancell[$contar], 1).';
MGAAC:AREA='.$Utrancell[$contar].',RO='.$RO[$contar].',EA='.$EA[$contar].';
MGAAP:AREA='.$Utrancell[$contar].';
MGLNI:LOCNO='.$LOCNO[$contar].';
MGLCI:LOCNO='.$LOCNO[$contar].',AREA='.$Utrancell[$contar].';
MGLNP:LOCNO='.$LOCNO[$contar].';
MGLCP:AREA='.$Utrancell[$contar].';
MGRCI:AREA='.$Utrancell[$contar].',EC='.$ERIND1[$contar].',ERIND=1;
MGRCI:AREA='.$Utrancell[$contar].',EC='.$ERIND2[$contar].',ERIND=2;
MGRCI:AREA='.$Utrancell[$contar].',EC='.$ERIND3[$contar].',ERIND=3;
MGRCI:AREA='.$Utrancell[$contar].',EC='.$ERIND4[$contar].',ERIND=4;
MGRCI:AREA='.$Utrancell[$contar].',EC='.$ERIND5[$contar].',ERIND=5;
MGRCI:AREA='.$Utrancell[$contar].',EC='.$ERIND6[$contar].',ERIND=6;
MGRCI:AREA='.$Utrancell[$contar].',EC='.$ERIND7[$contar].',ERIND=7;
MGRCI:AREA='.$Utrancell[$contar].',EC='.$ERIND8[$contar].',ERIND=8;
MGRCI:AREA='.$Utrancell[$contar].',EC='.$ERIND9[$contar].',ERIND=9;
MGRCI:AREA='.$Utrancell[$contar].',EC='.$ERIND10[$contar].',ERIND=10;
MGRCI:AREA='.$Utrancell[$contar].',EC='.$ERIND11[$contar].',ERIND=11;
MGRCI:AREA='.$Utrancell[$contar].',EC='.$valor.',ERIND=12;
MGRCP:AREA='.$Utrancell[$contar].';';
            $contar++;
          }
        }
      }

      if($key1 == 11){
         @$continido_1_1_1 .='
exit;';
      }
    }    
      
    return $continido_1_1_1;
  }

  public function __destruct()
  {
      
  }
}
	
?>