<?php


// Настройки: где брать файл, куда выгружать и т.д.
  $sInFile = $sPath.'../Exel/Econom.xls';
  $sPath = dirname(__FILE__);
  date_default_timezone_set('Europe/Moscow');

  // Подключаем библиотеку:
  require_once '../Library/PHPExcel.php';
  $oExcel = PHPExcel_IOFactory::load($sInFile);

  // С какой линии начинаются данные
  $iStart = 2;

  $aRes = array();
  
 $i= $iStart;

     $oRow = new stdClass();
       

       $oRow->year0=                    $oExcel->getActiveSheet()->getCell('A'.$i )->getValue(); // #
       $oRow->year1=            $oExcel->getActiveSheet()->getCell('B'.$i )->getValue(); 


       $oRow->nemat_activ_0=                    $oExcel->getActiveSheet()->getCell('A'.$i )->getValue(); // #
       $oRow->nemat_activ_1=            $oExcel->getActiveSheet()->getCell('B'.$i )->getValue();
$i++;

       $oRow->osn_sredstv_0=                    $oExcel->getActiveSheet()->getCell('A'.$i )->getValue(); // #
       $oRow->osn_sredstv_1=            $oExcel->getActiveSheet()->getCell('B'.$i )->getValue();
$i++;

       $oRow->nezav_stroi_0=                    $oExcel->getActiveSheet()->getCell('A'.$i )->getValue(); // #
       $oRow->nezav_stroi_1=            $oExcel->getActiveSheet()->getCell('B'.$i )->getValue();
$i++;

       $oRow->vloj_i_cennosti_0=                    $oExcel->getActiveSheet()->getCell('A'.$i )->getValue(); // #
       $oRow->vloj_i_cennosti_1=            $oExcel->getActiveSheet()->getCell('B'.$i )->getValue();
$i++;

       $oRow->financ_vloj_0=                    $oExcel->getActiveSheet()->getCell('A'.$i )->getValue(); // #
       $oRow->financ_vloj_1=            $oExcel->getActiveSheet()->getCell('B'.$i )->getValue();
$i++;

       $oRow->neoborot_activ_0=                    $oExcel->getActiveSheet()->getCell('A'.$i )->getValue(); // #
       $oRow->neoborot_activ_1=            $oExcel->getActiveSheet()->getCell('B'.$i )->getValue();
$i++;

       $oRow->zapas_0=                    $oExcel->getActiveSheet()->getCell('A'.$i )->getValue(); // #
       $oRow->zapas_1=            $oExcel->getActiveSheet()->getCell('B'.$i )->getValue();
$i++;

       $oRow->nalog_0=                    $oExcel->getActiveSheet()->getCell('A'.$i )->getValue(); // #
       $oRow->nalog_1=            $oExcel->getActiveSheet()->getCell('B'.$i )->getValue();
$i++;

       $oRow->deb_zadolj_0=                    $oExcel->getActiveSheet()->getCell('A'.$i )->getValue(); // #
       $oRow->deb_zadolj_1=            $oExcel->getActiveSheet()->getCell('B'.$i )->getValue();
$i++;

       $oRow->money_0=                    $oExcel->getActiveSheet()->getCell('A'.$i )->getValue(); // #
       $oRow->money_1=            $oExcel->getActiveSheet()->getCell('B'.$i )->getValue();
$i++;

       $oRow->prochie_obor_activ_0=                    $oExcel->getActiveSheet()->getCell('A'.$i )->getValue(); // #
       $oRow->prochie_obor_activ_1=            $oExcel->getActiveSheet()->getCell('B'.$i )->getValue();
$i++;

        $oRow->itogo_0=                    $oExcel->getActiveSheet()->getCell('A'.$i )->getValue(); // #
       $oRow->itogo_1=            $oExcel->getActiveSheet()->getCell('B'.$i )->getValue();
       
       $i=$i+2;

       $oRow->dolgosroch_obstoyatelstva_kreditov_0=                    $oExcel->getActiveSheet()->getCell('A'.$i )->getValue(); // #
       $oRow->dolgosroch_obstoyatelstva_kreditov_1=            $oExcel->getActiveSheet()->getCell('B'.$i )->getValue();
$i++;

       $oRow->prochie_dolgosroch_obstoyatelstva_0=                    $oExcel->getActiveSheet()->getCell('A'.$i )->getValue(); // #
       $oRow->prochie_dolgosroch_obstoyatelstva_1=            $oExcel->getActiveSheet()->getCell('B'.$i )->getValue();
$i++;


       $oRow->kratkosroch_obstoyatelstva_0=                    $oExcel->getActiveSheet()->getCell('A'.$i )->getValue(); // #
       $oRow->kratkosroch_obstoyatelstva_1=            $oExcel->getActiveSheet()->getCell('B'.$i )->getValue(); 
$i++;

       $oRow->kreditorskaya_zadolj_0=                    $oExcel->getActiveSheet()->getCell('A'.$i )->getValue(); // #
       $oRow->kreditorskaya_zadolj_1=            $oExcel->getActiveSheet()->getCell('B'.$i )->getValue(); 
$i++;

       $oRow->zadolj_po_viplate_0=                    $oExcel->getActiveSheet()->getCell('A'.$i )->getValue(); // #
       $oRow->zadolj_po_viplate_1=            $oExcel->getActiveSheet()->getCell('B'.$i )->getValue();$i++;

       $oRow->rezervi_rashodov_0=                    $oExcel->getActiveSheet()->getCell('A'.$i )->getValue(); // #
       $oRow->rezervi_rashodov_1=            $oExcel->getActiveSheet()->getCell('B'.$i )->getValue();$i++;

        $oRow->prochie_kratkosroch_obyasatelstva_0=                    $oExcel->getActiveSheet()->getCell('A'.$i )->getValue(); // #
       $oRow->prochie_kratkosroch_obyasatelstva_1=            $oExcel->getActiveSheet()->getCell('B'.$i )->getValue();
     
	
     $aRes[] = $oRow;
  }

?>