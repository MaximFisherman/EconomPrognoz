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
  
  for ($i= $iStart; $i <= 1000; $i++)
  {
     $oRow = new stdClass();
       $oRow->id = 0;

       $Num =                    $oExcel->getActiveSheet()->getCell('A'.$i )->getValue(); // #
       $oRow->title =            $oExcel->getActiveSheet()->getCell('B'.$i )->getValue(); // Ф.И.О. члена ППО
		echo("<BR>".$oRow->title);
       //Пропускаем строку, если столбец ФИО пуст
       if(!$oRow->title)
       {
         continue;
       }

       $oRow->sex =                $oExcel->getActiveSheet()->getCell('C'.$i )->getValue(); // Пол 
       $oRow->number =            $oExcel->getActiveSheet()->getCell('D'.$i )->getValue(); // № профсоюзного билета 
       $oRow->date_of_entry =    $oExcel->getActiveSheet()->getCell('E'.$i )->getValue(); // Дата вступления в ППО 

       // Преобразуем дату из MS формата в "обычный"
       $oRow->date_of_birth = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($oRow->date_of_birth));


     $aRes[] = $oRow;
  }

?>