<?php
//header('Content-Type: text/html; charset=utf-8');
require_once("Base.php");
class Parser extends Base
{
	
	public $activi_raschet= array();	//Активы принимаемые к расчету(массив)
	public $pasivi_raschet= array();	//Пассивы принимаемые к расчету(массив)
	public $stoimost_activ= array();	//Стоимость чистых активов(массив)
		
	public $econom_rentabelnost= array();	//Экономическая рентабельность(массив)
	public $nalog_na_pribil= array();	//Налог на прибыль(массив)
	public $chistaya_pribil= array();	//Чистая прибыль(массив)
	public $rentabelnost_sredstv= array();	//Рентабельность собственных средств(массив)
		
	public $ocenka_kachestva_zadolj= array();	//Оценка качества дебиторской задолженности(массив)
		
	public $rashod_materialov= array();	//Однодневный расход материалов(массив)
	public $dostatochnaya_potrebnost= array();	//Достаточная потребность в матриальных оборотных средств(массив)
	public $dostatochn_lvl_liquid= array();	//Достаточный уровень коэфициента текущей ликвидности(массив)
		
	public $rentabelnost_activov;	//Рентабельность активов(переменная)
	public $rentabelnost_produktsii;	//Рентабельность продукции(переменная)
	public $rentabelnost_prodaj;	//Рентабельность продаж (переменная)
	public $rentabelnost_sobstv_kapitala;	//Рентабельность собственного капитала (переменная)
	public $rentabelnost_oborot_kapitala;	//Рентабельность обротного капитала (переменная)
	public $rentabelnost_proizvodstv_fondov;	//Рентабельность производственных фондов(переменная)
	public $rentabelnost_investic_predpriyat;	//Рентабельность инвестиций в предприятие(переменная)
	public $rentabelnost_financ_vloj; //Рентабельность финансовых вложений в предприятие (переменная)
		
	public $koef_obsolut_liquid= array();	//Коэфициент абслютной ликвидности (массив)
	public $koef_krit_fast_liquid= array();	//Коэфициент критической или быстрой ликвидности (массив)
	public $koef_tekysh_liquid= array();	//Коэфициент текущей ликвидности (массив)
	public $manevrenost_sobstv_oborot_activ= array();	//Маневренность собственных обортных активов (массив)
	public $koef_obespech_sobstv_sredstv= array();	//Коэфициент обеспеченности соб. средствами (массив)
	public $koef_vostanov_pletejsposob= array();	//Коэфициент восстановления полатежеспособности предприятия (массив)
		
	public $stepen_platejnosti_obsh= array();	//Степень платежеспособности общая (массив)
	public $stepen_platejnosti_tekysh_pokazat= array();	//Степень платежеспособности по текущим показателям (массив)
	public $aRes = array();
	
	 function pars()
	{
		  $sInFile = $sPath.'../Exel/Econom.xls';
  			$sPath = dirname(__FILE__);
  			 require_once '../Library/PHPExcel.php';
  			  $oExcel = PHPExcel_IOFactory::load($sInFile); 
          $oExcel->setActiveSheetIndex(0);
          $sheet = $oExcel->getActiveSheet();
  			  $iStart = 2;
      	   $i= $iStart;
    				 $oRow = new stdClass();
  
        $nColumn = PHPExcel_Cell::columnIndexFromString(
        $sheet->getHighestColumn());
  for ($j = 1; $j < $nColumn; $j++) {   
       $oRow->year[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue(); 
      } $i++;  
 for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->nemat_activ[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}$i++;
      
     
for ($j = 1; $j < $nColumn; $j++) 
       {$oRow->osn_sredstv[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}$i++;
      
      
 for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->nezav_stroi[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}$i++;
     
 for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->vloj_i_cennosti[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}$i++;
       
 for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->financ_vloj[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}$i++;
      
 for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->neoborot_activ[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}$i++;
      
 for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->zapas[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}$i++;
      
 for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->nalog[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}$i++;
       
 for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->deb_zadolj[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}$i++;
       
 for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->money[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}$i++;
       
 for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->prochie_obor_activ[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();} $i=$i+3;
       /////////////////////////////
     
 for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->dolgosroch_obstoyatelstva_kreditov[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}$i++;
      
 for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->prochie_dolgosroch_obstoyatelstva[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}$i++;
       
 for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->kratkosroch_obstoyatelstva[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}$i++;
     
 for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->kreditorskaya_zadolj[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}$i++;
      
 for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->zadolj_po_viplate[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}$i++;
       
 for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->rezervi_rashodov[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}$i++;
      
        {$oRow->prochie_kratkosroch_obyasatelstva[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}  $i=$i+4;
        ////////////////////////////////////////////////////////////////////
 for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->analitich_balanc[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}$i++;
       
 for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->sobstvennie_sredstva[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}$i++;
       
 for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->zaemnie_sredstva[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}$i++;
      
 for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->nre[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}$i=$i+4;
       ///////////////////////////////////////////////////////
 for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->potrebn_oborot_activ[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}$i++;
        
 for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->beznadej_debitorskaya_zadolj[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}$i=$i+4;
       ///////////////////////////////////////////////////
 for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->viruchka_prodaj[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}$i++;
         
 for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->sebestoimost_produkcii[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}$i++;
        
 for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->mater_zatrati[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}$i++;
         
 for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->chislo_dnei_vperiod[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}$i++;
         
 for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->zapas_oborot_sredstv[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}$i++;
      
 for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->faktich_sred_ostatki[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}$i++;
        
 for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->srednie_ostatki_kratkosroch_obyaz[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();} $i=$i+4;
 for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->opf[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}$i++;
    
$aRes=$oRow;
return $oRow;
	}
 function show($oRow)
	{
		 $sInFile = $sPath.'../Exel/Econom.xls';
        $sPath = dirname(__FILE__);
         require_once '../Library/PHPExcel.php';
          $oExcel = PHPExcel_IOFactory::load($sInFile); 
          $oExcel->setActiveSheetIndex(0);
          $sheet = $oExcel->getActiveSheet();
          $iStart = 2;          
        $nColumn = PHPExcel_Cell::columnIndexFromString(
        $sheet->getHighestColumn());
echo'<table>
   <tr><th><b>Активы</b></th>
';
  for ($i=0; $i <($nColumn-1)/2 ; $i++) { echo '<th>Начало года</th><th> Конец года |</th>';
     
   } 
   echo '</tr>';
        
 
  echo ' <tr><td>Год</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->year[$i].'</td>'; }
  echo '</tr>';
  echo ' <tr><td>Нематериальные активы</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->nemat_activ[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>Основные средства</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->osn_sredstv[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>Незавершенное строительство</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->nezav_stroi[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>Доходные вложения и материальные ценности</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->vloj_i_cennosti[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>Долгосрочные и кратксрочные финансовые вложения</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->financ_vloj[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>Прочие внеоборотные активы</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->neoborot_activ[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>Запасы</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->zapas[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>Налог на добавленную стоимость по приобретенным ценностям</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->nalog[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>Дебиторская задолженность</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->deb_zadolj[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>Денежные средства</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->money[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>Прочие оборотные активы</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->prochie_obor_activ[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>Долгосрочные обязательства по займам и кредитам</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->dolgosroch_obstoyatelstva_kreditov[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>Прочие долгосрочные обязательства</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->prochie_dolgosroch_obstoyatelstva[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>Краткосрочные обязательства</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->kratkosroch_obstoyatelstva[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>Кредиторская задолженость</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->kreditorskaya_zadolj[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>Задолженность участникам по выплате доходов</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->zadolj_po_viplate[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>Резервы предстоящих расходов </td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->rezervi_rashodov[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>Прочие кратксорочные обязательства</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->prochie_kratkosroch_obyasatelstva[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>Аналитический баланс</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->analitich_balanc[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>Собственные средства</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->sobstvennie_sredstva[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>Заемные средства</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->zaemnie_sredstva[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>НРЭЕ</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->nre[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>Потребность в обортных активах</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->potrebn_oborot_activ[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>Безнадежная дебиторская задолженность</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->beznadej_debitorskaya_zadolj[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>Выручка от продажи товаров</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->viruchka_prodaj[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>Себестоимость релизованной продукции</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->sebestoimost_produkcii[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>Материальные затраты</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->mater_zatrati[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>Число дней в анализируемом периоде</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->chislo_dnei_vperiod[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>Необходимый запас материальных обортных средств</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->zapas_oborot_sredstv[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>Фактические средние остатки оортных средств</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->faktich_sred_ostatki[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>Средние остатки краткосрочных обязательств</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->srednie_ostatki_kratkosroch_obyaz[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>Показатели ОПФ (в %)</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->opf[$i].'</td>'; }
  echo '</tr>
  </table>';
	}
	
	function Add_to_base_excel_param($oRow)
	{
		//Settings
		$sInFile = $sPath.'../Exel/Econom.xls';
        $sPath = dirname(__FILE__);
         require_once '../Library/PHPExcel.php';
          $oExcel = PHPExcel_IOFactory::load($sInFile); 
          $oExcel->setActiveSheetIndex(0);
          $sheet = $oExcel->getActiveSheet();
          $iStart = 2;          
        $nColumn = PHPExcel_Cell::columnIndexFromString(
        $sheet->getHighestColumn());

		mysqli_query($this->dlink,"DELETE FROM MainTable;");
		for($i=0; $i < $nColumn-1; $i++) {  
			if($i % 2 == 0){
					mysqli_query($this->dlink,"INSERT INTO `MainTable`(`start_year`, `year`, `nemat_activ`, `osn_sredstv`, `nezav_stroi`, `vloj_i_cennosti`, `financ_vloj`, `neoborot_activ`, `zapas`, `nalog`, `deb_zadolj`, `money`, `prochie_obor_activ`, `dolgosroch_obstoyatelstva_kreditov`, `prochie_dolgosroch_obstoyatelstva`, `kratkosroch_obstoyatelstva`, `kreditorskaya_zadolj`, `zadolj_po_viplate`, `rezervi_rashodov`, `prochie_kratkosroch_obyasatelstva`, `analitich_balanc`, `sobstvennie_sredstva`, `zaemnie_sredstva`, `nre`, `potrebn_oborot_activ`, `beznadej_debitorskaya_zadolj`, `viruchka_prodaj`, `sebestoimost_produkcii`, `mater_zatrati`, `chislo_dnei_vperiod`, `zapas_oborot_sredstv`, `faktich_sred_ostatki`, `srednie_ostatki_kratkosroch_obyaz`, `opf`) VALUES (
					 'Start year',
					 '".$oRow->year[$i]."',
					 '".$oRow->nemat_activ[$i]."',
					 '".$oRow->osn_sredstv[$i]."',
					 '".$oRow->nezav_stroi[$i]."',
					 '".$oRow->vloj_i_cennosti[$i]."',
					 '".$oRow->financ_vloj[$i]."',
					 '".$oRow->neoborot_activ[$i]."',
					 '".$oRow->zapas[$i]."',
					 '".$oRow->nalog[$i]."',
					 '".$oRow->deb_zadolj[$i]."',
					 '".$oRow->money[$i]."',
					 '".$oRow->prochie_obor_activ[$i]."',
					 '".$oRow->dolgosroch_obstoyatelstva_kreditov[$i]."',
					 '".$oRow->prochie_dolgosroch_obstoyatelstva[$i]."',
					 '".$oRow->kratkosroch_obstoyatelstva[$i]."',
					 '".$oRow->kreditorskaya_zadolj[$i]."',
					 '".$oRow->zadolj_po_viplate[$i]."',
					 '".$oRow->rezervi_rashodov[$i]."',
					 '".$oRow->prochie_kratkosroch_obyasatelstva[$i]."',
					 '".$oRow->analitich_balanc[$i]."',
					 '".$oRow->sobstvennie_sredstva[$i]."',
					 '".$oRow->zaemnie_sredstva[$i]."',
					 '".$oRow->nre[$i]."',
					 '".$oRow->potrebn_oborot_activ[$i]."',
					 '".$oRow->beznadej_debitorskaya_zadolj[$i]."',
					 '".$oRow->viruchka_prodaj[$i]."',
					 '".$oRow->sebestoimost_produkcii[$i]."',
					 '".$oRow->mater_zatrati[$i]."',
					 '".$oRow->chislo_dnei_vperiod[$i]."',
					 '".$oRow->zapas_oborot_sredstv[$i]."',
					 '".$oRow->faktich_sred_ostatki[$i]."',
					 '".$oRow->srednie_ostatki_kratkosroch_obyaz[$i]."',
					 '".$oRow->opf[$i]."'
					 )");
			}
			if($i % 2 != 0){
				mysqli_query($this->dlink,"INSERT INTO `MainTable`(`start_year`, `year`, `nemat_activ`, `osn_sredstv`, `nezav_stroi`, `vloj_i_cennosti`, `financ_vloj`, `neoborot_activ`, `zapas`, `nalog`, `deb_zadolj`, `money`, `prochie_obor_activ`, `dolgosroch_obstoyatelstva_kreditov`, `prochie_dolgosroch_obstoyatelstva`, `kratkosroch_obstoyatelstva`, `kreditorskaya_zadolj`, `zadolj_po_viplate`, `rezervi_rashodov`, `prochie_kratkosroch_obyasatelstva`, `analitich_balanc`, `sobstvennie_sredstva`, `zaemnie_sredstva`, `nre`, `potrebn_oborot_activ`, `beznadej_debitorskaya_zadolj`, `viruchka_prodaj`, `sebestoimost_produkcii`, `mater_zatrati`, `chislo_dnei_vperiod`, `zapas_oborot_sredstv`, `faktich_sred_ostatki`, `srednie_ostatki_kratkosroch_obyaz`, `opf`) VALUES (
					 'Finish year',
					 '".$oRow->year[$i]."',
					 '".$oRow->nemat_activ[$i]."',
					 '".$oRow->osn_sredstv[$i]."',
					 '".$oRow->nezav_stroi[$i]."',
					 '".$oRow->vloj_i_cennosti[$i]."',
					 '".$oRow->financ_vloj[$i]."',
					 '".$oRow->neoborot_activ[$i]."',
					 '".$oRow->zapas[$i]."',
					 '".$oRow->nalog[$i]."',
					 '".$oRow->deb_zadolj[$i]."',
					 '".$oRow->money[$i]."',
					 '".$oRow->prochie_obor_activ[$i]."',
					 '".$oRow->dolgosroch_obstoyatelstva_kreditov[$i]."',
					 '".$oRow->prochie_dolgosroch_obstoyatelstva[$i]."',
					 '".$oRow->kratkosroch_obstoyatelstva[$i]."',
					 '".$oRow->kreditorskaya_zadolj[$i]."',
					 '".$oRow->zadolj_po_viplate[$i]."',
					 '".$oRow->rezervi_rashodov[$i]."',
					 '".$oRow->prochie_kratkosroch_obyasatelstva[$i]."',
					 '".$oRow->analitich_balanc[$i]."',
					 '".$oRow->sobstvennie_sredstva[$i]."',
					 '".$oRow->zaemnie_sredstva[$i]."',
					 '".$oRow->nre[$i]."',
					 '".$oRow->potrebn_oborot_activ[$i]."',
					 '".$oRow->beznadej_debitorskaya_zadolj[$i]."',
					 '".$oRow->viruchka_prodaj[$i]."',
					 '".$oRow->sebestoimost_produkcii[$i]."',
					 '".$oRow->mater_zatrati[$i]."',
					 '".$oRow->chislo_dnei_vperiod[$i]."',
					 '".$oRow->zapas_oborot_sredstv[$i]."',
					 '".$oRow->faktich_sred_ostatki[$i]."',
					 '".$oRow->srednie_ostatki_kratkosroch_obyaz[$i]."',
					 '".$oRow->opf[$i]."'
					 )");
			}
		}
	}
}
?>