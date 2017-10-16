<?php


// ���������: ��� ����� ����, ���� ��������� � �.�.
  $sInFile = $sPath.'../Exel/Econom.xls';
  $sPath = dirname(__FILE__);
  date_default_timezone_set('Europe/Moscow');

  // ���������� ����������:
  require_once '../Library/PHPExcel.php';
  $oExcel = PHPExcel_IOFactory::load($sInFile);

  // � ����� ����� ���������� ������
  $iStart = 2;

  $aRes = array();
  
  for ($i= $iStart; $i <= 1000; $i++)
  {
     $oRow = new stdClass();
       $oRow->id = 0;

       $Num =                    $oExcel->getActiveSheet()->getCell('A'.$i )->getValue(); // #
       $oRow->title =            $oExcel->getActiveSheet()->getCell('B'.$i )->getValue(); // �.�.�. ����� ���
		echo("<BR>".$oRow->title);
       //���������� ������, ���� ������� ��� ����
       if(!$oRow->title)
       {
         continue;
       }

       $oRow->sex =                $oExcel->getActiveSheet()->getCell('C'.$i )->getValue(); // ��� 
       $oRow->number =            $oExcel->getActiveSheet()->getCell('D'.$i )->getValue(); // � ������������ ������ 
       $oRow->date_of_entry =    $oExcel->getActiveSheet()->getCell('E'.$i )->getValue(); // ���� ���������� � ��� 

       // ����������� ���� �� MS ������� � "�������"
       $oRow->date_of_birth = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($oRow->date_of_birth));


     $aRes[] = $oRow;
  }

?>