<?php
//header('Content-Type: text/html; charset=utf-8');
require_once("Base.php");
class Parser extends Base
{
	
	public $activi_raschet= array();	//������ ����������� � �������(������)
	public $pasivi_raschet= array();	//������� ����������� � �������(������)
	public $stoimost_activ= array();	//��������� ������ �������(������)
		
	public $econom_rentabelnost= array();	//������������� ��������������(������)
	public $nalog_na_pribil= array();	//����� �� �������(������)
	public $chistaya_pribil= array();	//������ �������(������)
	public $rentabelnost_sredstv= array();	//�������������� ����������� �������(������)
		
	public $ocenka_kachestva_zadolj= array();	//������ �������� ����������� �������������(������)
		
	public $rashod_materialov= array();	//����������� ������ ����������(������)
	public $dostatochnaya_potrebnost= array();	//����������� ����������� � ����������� ��������� �������(������)
	public $dostatochn_lvl_liquid= array();	//����������� ������� ����������� ������� �����������(������)
	


	//////////////////  �� ��������� 
  public $rentabelnost_activov;	//�������������� �������(����������)
	public $rentabelnost_produktsii;	//�������������� ���������(����������)
	public $rentabelnost_prodaj;	//�������������� ������ (����������)
	public $rentabelnost_sobstv_kapitala;	//�������������� ������������ �������� (����������)
	public $rentabelnost_oborot_kapitala;	//�������������� ��������� �������� (����������)
	public $rentabelnost_proizvodstv_fondov;	//�������������� ���������������� ������(����������)
	public $rentabelnost_investic_predpriyat;	//�������������� ���������� � �����������(����������)
	public $rentabelnost_financ_vloj; //�������������� ���������� �������� � ����������� (����������)
	 //////////////////  �� ��������� 



	public $koef_obsolut_liquid= array();	//���������� ��������� ����������� (������)
	public $koef_krit_fast_liquid= array();	//���������� ����������� ��� ������� ����������� (������)
	public $koef_tekysh_liquid= array();	//���������� ������� ����������� (������)
	public $manevrenost_sobstv_oborot_activ= array();	//������������� ����������� �������� ������� (������)
	public $koef_obespech_sobstv_sredstv= array();	//���������� �������������� ���. ���������� (������)
	public $koef_vostanov_pletejsposob= array();	//���������� �������������� ������������������� ����������� (������)
		
	public $stepen_platejnosti_obsh= array();	//������� ������������������ ����� (������)
	public $stepen_platejnosti_tekysh_pokazat= array();	//������� ������������������ �� ������� ����������� (������)
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
      for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->prochie_kratkosroch_obyasatelstva[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}  $i=$i+4;
        ////////////////////////////////////////////////////////////////////
 for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->analitich_balanc[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}$i++;
       
 for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->sobstvennie_sredstva[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}$i++;
       
 for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->zaemnie_sredstva[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}$i++;
      
 for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->nre[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}$i++;   
for ($j = 1; $j < $nColumn; $j++) 
  {$oRow->finance_izderjki[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}$i=$i+3;
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

  for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->komerch_rashodu[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}$i++;
      for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->upravlench_rashodu[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}$i++;
      for ($j = 1; $j < $nColumn; $j++) 
        {$oRow->neraspred_pribil[$j-1]=$oExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();}

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
   <tr><th><b>������</b></th>
';
  for ($i=0; $i <($nColumn-1)/2 ; $i++) { echo '<th>������ ����</th><th> ����� ���� |</th>';
     
   } 
   echo '</tr>';
        
 
  echo ' <tr><td>���</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->year[$i].'</td>'; }
  echo '</tr>';
  echo ' <tr><td>�������������� ������</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->nemat_activ[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>�������� ��������</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->osn_sredstv[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>������������� �������������</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->nezav_stroi[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>�������� �������� � ������������ ��������</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->vloj_i_cennosti[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>������������ � ������������ ���������� ��������</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->financ_vloj[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>������ ������������ ������</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->neoborot_activ[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>������</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->zapas[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>����� �� ����������� ��������� �� ������������� ���������</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->nalog[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>����������� �������������</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->deb_zadolj[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>�������� ��������</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->money[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>������ ��������� ������</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->prochie_obor_activ[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>������������ ������������� �� ������ � ��������</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->dolgosroch_obstoyatelstva_kreditov[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>������ ������������ �������������</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->prochie_dolgosroch_obstoyatelstva[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>������������� �������������</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->kratkosroch_obstoyatelstva[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>������������ ������������</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->kreditorskaya_zadolj[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>������������� ���������� �� ������� �������</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->zadolj_po_viplate[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>������� ����������� �������� </td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->rezervi_rashodov[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>������ ������������� �������������</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->prochie_kratkosroch_obyasatelstva[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>������������� ������</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->analitich_balanc[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>����������� ��������</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->sobstvennie_sredstva[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>������� ��������</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->zaemnie_sredstva[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>����</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->nre[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>���������� �������� �� ������� ���������</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->finance_izderjki[$i].'</td>'; }
  echo '</tr>';



echo ' <tr><td>����������� � �������� �������</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->potrebn_oborot_activ[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>����������� ����������� �������������</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->beznadej_debitorskaya_zadolj[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>������� �� ������� �������</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->viruchka_prodaj[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>������������� ������������ ���������</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->sebestoimost_produkcii[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>������������ �������</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->mater_zatrati[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>����� ���� � ������������� �������</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->chislo_dnei_vperiod[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>����������� ����� ������������ �������� �������</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->zapas_oborot_sredstv[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>����������� ������� ������� ������� �������</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->faktich_sred_ostatki[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>������� ������� ������������� ������������</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->srednie_ostatki_kratkosroch_obyaz[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>���������� ��� (� %)</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->opf[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>������������ ������� </td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->komerch_rashodu[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>�������������� �������</td>';
  for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->upravlench_rashodu[$i].'</td>'; }
  echo '</tr>';
echo ' <tr><td>���������������� ������� </td>';
 for ($i=0; $i <$nColumn-1 ; $i++) {  echo '<td>'.$oRow->neraspred_pribil[$i].'</td>'; }
  echo '</tr>
  </table>';
  echo "----------------------------------------------------------------------------------------------------------";
  echo "<br>";
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
					mysqli_query($this->dlink,"INSERT INTO `MainTable`(`start_year`, `year`, `nemat_activ`, `osn_sredstv`, `nezav_stroi`, `vloj_i_cennosti`, `financ_vloj`, `neoborot_activ`, `zapas`, `nalog`, `deb_zadolj`, `money`, `prochie_obor_activ`, `dolgosroch_obstoyatelstva_kreditov`, `prochie_dolgosroch_obstoyatelstva`, `kratkosroch_obstoyatelstva`, `kreditorskaya_zadolj`, `zadolj_po_viplate`, `rezervi_rashodov`, `prochie_kratkosroch_obyasatelstva`, `analitich_balanc`, `sobstvennie_sredstva`, `zaemnie_sredstva`, `nre`, `finance_izderjki`, `potrebn_oborot_activ`, `beznadej_debitorskaya_zadolj`, `viruchka_prodaj`, `sebestoimost_produkcii`, `mater_zatrati`, `chislo_dnei_vperiod`, `zapas_oborot_sredstv`, `faktich_sred_ostatki`, `srednie_ostatki_kratkosroch_obyaz`, `opf`, `komerch_rashodu`, `upravlench_rashodu`,`neraspred_pribil`) VALUES (
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
           '".$oRow->finance_izderjki[$i]."',
					 '".$oRow->potrebn_oborot_activ[$i]."',
					 '".$oRow->beznadej_debitorskaya_zadolj[$i]."',
					 '".$oRow->viruchka_prodaj[$i]."',
					 '".$oRow->sebestoimost_produkcii[$i]."',
					 '".$oRow->mater_zatrati[$i]."',
					 '".$oRow->chislo_dnei_vperiod[$i]."',
					 '".$oRow->zapas_oborot_sredstv[$i]."',
					 '".$oRow->faktich_sred_ostatki[$i]."',
					 '".$oRow->srednie_ostatki_kratkosroch_obyaz[$i]."',
					 '".$oRow->opf[$i]."',
           '".$oRow->komerch_rashodu[$i]."',
           '".$oRow->upravlench_rashodu[$i]."',
           '".$oRow->neraspred_pribil[$i]."'
					 )");
			}
			if($i % 2 != 0){
				mysqli_query($this->dlink,"INSERT INTO `MainTable`(`start_year`, `year`, `nemat_activ`, `osn_sredstv`, `nezav_stroi`, `vloj_i_cennosti`, `financ_vloj`, `neoborot_activ`, `zapas`, `nalog`, `deb_zadolj`, `money`, `prochie_obor_activ`, `dolgosroch_obstoyatelstva_kreditov`, `prochie_dolgosroch_obstoyatelstva`, `kratkosroch_obstoyatelstva`, `kreditorskaya_zadolj`, `zadolj_po_viplate`, `rezervi_rashodov`, `prochie_kratkosroch_obyasatelstva`, `analitich_balanc`, `sobstvennie_sredstva`, `zaemnie_sredstva`, `nre`, `finance_izderjki`, `potrebn_oborot_activ`, `beznadej_debitorskaya_zadolj`, `viruchka_prodaj`, `sebestoimost_produkcii`, `mater_zatrati`, `chislo_dnei_vperiod`, `zapas_oborot_sredstv`, `faktich_sred_ostatki`, `srednie_ostatki_kratkosroch_obyaz`, `opf`, `komerch_rashodu`, `upravlench_rashodu`, `neraspred_pribil`) VALUES (
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
           '".$oRow->finance_izderjki[$i]."',
					 '".$oRow->potrebn_oborot_activ[$i]."',
					 '".$oRow->beznadej_debitorskaya_zadolj[$i]."',
					 '".$oRow->viruchka_prodaj[$i]."',
					 '".$oRow->sebestoimost_produkcii[$i]."',
					 '".$oRow->mater_zatrati[$i]."',
					 '".$oRow->chislo_dnei_vperiod[$i]."',
					 '".$oRow->zapas_oborot_sredstv[$i]."',
					 '".$oRow->faktich_sred_ostatki[$i]."',
					 '".$oRow->srednie_ostatki_kratkosroch_obyaz[$i]."',
					 '".$oRow->opf[$i]."',
           '".$oRow->komerch_rashodu[$i]."',
           '".$oRow->upravlench_rashodu[$i]."',
           '".$oRow->neraspred_pribil[$i]."'
					 )");
			}
		} 
	}

function calculate_main()
{

$result=mysqli_query($this->dlink,"SELECT count(year) from MainTable");
while($row1 = $result->fetch_assoc())
$years=$row1["count(year)"];
$i=0;
 $result=mysqli_query($this->dlink,"SELECT * from MainTable");
 while($row = $result->fetch_assoc()) {
        $ms_year[$i]=$row["year"];$ms_condition[$i]=$row["start_year"];$i++;
    }




mysqli_query($this->dlink,"DELETE FROM Param;");
for($j=0;$j<$years;$j++)
{

$rez=mysqli_query($this->dlink,"SELECT * from MainTable where year='".$ms_year[$j]."' && start_year='".$ms_condition[$j]."'  ");
 while($rows = $rez->fetch_assoc()) {
$this->activi_raschet[$j]=$rows["nemat_activ"]+$rows["osn_sredstv"]+$rows["nezav_stroi"]+$rows["vloj_i_cennosti"]+$rows["financ_vloj"]+$rows["neoborot_activ"]+$rows["zapas"]+$rows["nalog"]+$rows["deb_zadolj"]+$rows["money"]+$rows["prochie_obor_activ"];
$this->pasivi_raschet[$j]=$rows["dolgosroch_obstoyatelstva_kreditov"]+$rows["prochie_dolgosroch_obstoyatelstva"]+$rows["kratkosroch_obstoyatelstva"]+$rows["kreditorskaya_zadolj"]+$rows["zadolj_po_viplate"]+$rows["rezervi_rashodov"]+$rows["prochie_kratkosroch_obyasatelstva"];
$this->stoimost_activ[$j]=$this->activi_raschet[$j]-$this->pasivi_raschet[$j];
$this->econom_rentabelnost[$j]=$rows["nre"]/$rows["analitich_balanc"]*100;
$pribil_nalogoobloj=$rows["nre"]-$rows["finance_izderjki"];
$this->nalog_na_pribil[$j]=$pribil_nalogoobloj*0.20;
$this->chistaya_pribil[$j]=$pribil_nalogoobloj-$this->nalog_na_pribil[$j];
$this->rentabelnost_sredstv[$j]=$this->chistaya_pribil[$j]/$rows["sobstvennie_sredstva"]*100;
$this->ocenka_kachestva_zadolj[$j]=1+($rows["potrebn_oborot_activ"]+$rows["beznadej_debitorskaya_zadolj"])/$rows["kratkosroch_obstoyatelstva"];
$this->rashod_materialov[$j]=$rows["mater_zatrati"]/$rows["chislo_dnei_vperiod"];
$this->dostatochnaya_potrebnost[$j]=$this->rashod_materialov[$j]*$rows["zapas_oborot_sredstv"];
$this->dostatochn_lvl_liquid[$j]=($this->dostatochnaya_potrebnost[$j]+$rows["beznadej_debitorskaya_zadolj"]+$rows["srednie_ostatki_kratkosroch_obyaz"])/$rows["srednie_ostatki_kratkosroch_obyaz"];

$this->koef_obsolut_liquid[$j]=($rows["money"]+$rows["financ_vloj"])/$rows["kratkosroch_obstoyatelstva"];


$this->koef_krit_fast_liquid[$j]=($rows["money"]+$rows["financ_vloj"]+$rows["beznadej_debitorskaya_zadolj"])/$rows["kratkosroch_obstoyatelstva"];
$this->koef_tekysh_liquid[$j]=$rows["zapas_oborot_sredstv"]/$rows["kratkosroch_obstoyatelstva"];
$this->manevrenost_sobstv_oborot_activ[$j]=$rows["money"]/$rows["sobstvennie_sredstva"];
$this->koef_obespech_sobstv_sredstv[$j]=$rows["sobstvennie_sredstva"]/$rows["zapas_oborot_sredstv"];




$this->stepen_platejnosti_obsh[$j]=($rows["dolgosroch_obstoyatelstva_kreditov"]+$rows["kratkosroch_obstoyatelstva"]+$rows["prochie_kratkosroch_obyasatelstva"])/$rows["viruchka_prodaj"];
$this->stepen_platejnosti_tekysh_pokazat[$j]=$rows["kratkosroch_obstoyatelstva"]/$rows["viruchka_prodaj"];

$obsh_chist_prib=$obsh_chist_prib+$this->chistaya_pribil[$j];
$obsh_pribil=$obsh_pribil+$rows["viruchka_prodaj"];
$obsh_sebestoimost=$obsh_sebestoimost+$rows["sebestoimost_produkcii"];
$sred_vel_activov=$sred_vel_activov+$this->activi_raschet[$j];

$obsh_activ=$obsh_activ+$this->activi_raschet[$j]; 
$obsh_passiv=$obsh_passiv+$this->pasivi_raschet[$j]; 
$obsh_money=$obsh_money+$rows["money"];
$obsh_dolgosroch_obyaz=$obsh_dolgosroch_obyaz+$rows["dolgosroch_obstoyatelstva_kreditov"];

$dob_pribil=$dob_pribil+$pribil_nalogoobloj;  
$obsh_opf=$obsh_opf+$rows["opf"];
$obsh_mat_sredstv=$obsh_mat_sredstv+$dostatochnaya_potrebnost[$j];
$obsh_sobstv_sredstva=$obsh_sobstv_sredstva+$rows["sobstvennie_sredstva"];

$oborot_kapital=$oborot_kapital+$rows["zapas"]+$rows["nalog"]+$rows["deb_zadolj"]+$rows["money"]+$rows["prochie_obor_activ"];
$obsh_kratkosroch_obyaz=$obsh_kratkosroch_obyaz+$rows["kratkosroch_obstoyatelstva"];
/////
$obsh_oborot_activ=$obsh_oborot_activ+$rows["potrebn_oborot_activ"];
$obsh_zaemn_sredstva=$obsh_zaemn_sredstva+$rows["zaemnie_sredstva"];
$mater_aktivi=$mater_aktivi+$rows["osn_sredstv"]+$rows["nezav_stroi"]+$rows["vloj_i_cennosti"]+$rows["financ_vloj"]+$rows["neoborot_activ"]+$rows["zapas"]+$rows["nalog"]+$rows["deb_zadolj"]+$rows["money"]+$rows["prochie_obor_activ"];
$obsh_viruchka=$obsh_viruchka+$rows["viruchka_prodaj"];

$obsh_komerch=$obsh_komerch+$rows["komerch_rashodu"];
$obsh_upravlench=$obsh_upravlench+$rows["upravlench_rashodu"];
$obsh_neraspred_pribil=$obsh_neraspred_pribil+$rows["neraspred_pribil"];
$obsh_oborot_sredstva=$obsh_oborot_sredstva+$rows["zapas_oborot_sredstv"];
$obsh_zatrati=$obsh_zatrati+$rows["mater_zatrati"];
$obsh_zapas=$obsh_zapas+$rows["zapas"];
$obsh_vneoborot_activ=$obsh_vneoborot_activ+$rows["money"]+$rows["osn_sredstv"]+$rows["nemat_activ"]+$rows["financ_vloj"];

///////////////////
echo "<b>���".$ms_year[$j]." ".$ms_condition[$j]."</b><br>";
echo "������ ����������� � ������� = ".$this->activi_raschet[$j]."<br>";
echo "������� ����������� � ������� = ".$this->pasivi_raschet[$j]."<br>";
echo "��������� ������ ������� = ".$this->stoimost_activ[$j]."<br>";
echo "������������� �������������� = ".$this->econom_rentabelnost[$j]."<br>";
echo "����� �� ������� = ".$this->nalog_na_pribil[$j]."<br>";

echo "������ ������� = ".$this->chistaya_pribil[$j]."<br>";

echo "�������������� ����������� ������� = ".$this->rentabelnost_sredstv[$j]."<br>";

echo "������ �������� ����������� ������������� = ".$this->ocenka_kachestva_zadolj[$j]."<br>";

echo "����������� ������ ���������� = ".$this->rashod_materialov[$j]."<br>";

echo "����������� ����������� � ����������� ��������� ������� = ".$this->dostatochnaya_potrebnost[$j]."<br>";
echo "����������� ������� ����������� ������� ����������� = ".$this->dostatochn_lvl_liquid[$j]."<br>";
echo "���������� ��������� ����������� = ".$this->koef_obsolut_liquid[$j]."<br>";
echo "���������� ����������� ��� ������� ����������� = ".$this->koef_krit_fast_liquid[$j]."<br>"; 
 echo "���������� ������� ����������� = ".$this->koef_tekysh_liquid[$j]."<br>"; 
 echo "������������� ����������� �������� ������� = ".$this->manevrenost_sobstv_oborot_activ[$j]."<br>"; 
  echo "���������� �������������� ���. ���������� = ".$this->koef_obespech_sobstv_sredstv[$j]."<br>";  
 echo "���������� �������������� ������������������� ����������� = ".$this->koef_vostanov_pletejsposob[$j]."<br>";  

echo "������� ������������������ ����� = ".$this->stepen_platejnosti_obsh[$j]."<br>";//������� ������������������ ����� (������)
echo "������� ������������������ �� ������� ����������� = ".$this->stepen_platejnosti_tekysh_pokazat[$j]."<br>"; //������� ������������������ �� ������� ����������� (������)
echo "<br>";



        mysqli_query($this->dlink,"INSERT INTO `Param`(`start_year`, `year`, `activi_raschet`, `pasivi_raschet`, `stoimost_activ`, `econom_rentabelnost`, `nalog_na_pribil`, `chistaya_pribil`, `rentabelnost_sredstv`, `ocenka_kachestva_zadolj`, `rashod_materialov`, `dostatochnaya_potrebnost`, `dostatochn_lvl_liquid`, `koef_obsolut_liquid`, `koef_krit_fast_liquid`, `koef_tekysh_liquid`, `manevrenost_sobstv_oborot_activ`, `koef_obespech_sobstv_sredstv`, `koef_vostanov_pletejsposob`, `stepen_platejnosti_obsh`, `stepen_platejnosti_tekysh_pokazat`) VALUES (
           '".$ms_condition[$j]."',
           '".$ms_year[$j]."',
           '".$this->activi_raschet[$j]."',
           '".$this->pasivi_raschet[$j]."',
           '".$this->stoimost_activ[$j]."',
           '".$this->econom_rentabelnost[$j]."',
           '".$this->nalog_na_pribil[$j]."',
           '".$this->chistaya_pribil[$j]."',
           '".$this->rentabelnost_sredstv[$j]."',
           '".$this->ocenka_kachestva_zadolj[$j]."',
           '".$this->rashod_materialov[$j]."',
           '".$this->dostatochnaya_potrebnost[$j]."',
           '".$this->dostatochn_lvl_liquid[$j]."',
           '".$this->koef_obsolut_liquid[$j]."',
           '".$this->koef_krit_fast_liquid[$j]."',
           '".$this->koef_tekysh_liquid[$j]."',
           '".$this->manevrenost_sobstv_oborot_activ[$j]."',
           '".$this->koef_obespech_sobstv_sredstv[$j]."',
           '".$this->koef_vostanov_pletejsposob[$j]."',
           '".$this->stepen_platejnosti_obsh[$j]."',
           '".$this->stepen_platejnosti_tekysh_pokazat[$j]."'
           )");
      


}
////////////////////////

}

//���������� ������������
$absolut_finance_ustoichivost=($obsh_sobstv_sredstva-$obsh_vneoborot_activ)+$obsh_dolgosroch_obyaz+$obsh_kratkosroch_obyaz;
//////////////������ ���������������
$sred_kapital=($obsh_activ+$obsh_passiv)/$years;
$sred_vel_activov=$sred_vel_activov/$years;

$this->rentabelnost_activov=$obsh_chist_prib*100/$sred_vel_activov;
$this->rentabelnost_produktsii=$obsh_pribil*100/$obsh_sebestoimost;
$this->rentabelnost_prodaj=$obsh_pribil*100/($obsh_sebestoimost+$dob_pribil);
$this->rentabelnost_sobstv_kapitala=$obsh_chist_prib*100/$sred_kapital;

$this->rentabelnost_oborot_kapitala=$obsh_chist_prib*100/$obsh_activ;
$this->rentabelnost_proizvodstv_fondov=$obsh_chist_prib*100/(($obsh_opf+$obsh_oborot_sredstva)/$years);
$this->rentabelnost_investic_predpriyat=$obsh_chist_prib*100/(($obsh_activ+$obsh_passiv+$obsh_dolgosroch_obyaz)/$years);

echo "----------------------------------------------<br>";
echo "�������������� �������=".$this->rentabelnost_activov."<br>";
echo "�������������� ���������=".$this->rentabelnost_produktsii."<br>";  
echo "�������������� ������ =".$this->rentabelnost_prodaj."<br>";
echo "�������������� ������������ �������� =".$this->rentabelnost_sobstv_kapitala."<br>";
echo "�������������� ��������� �������� =".$this->rentabelnost_oborot_kapitala."<br>";
echo "�������������� ���������������� ������ =".$this->rentabelnost_proizvodstv_fondov."<br>";
echo "�������������� ���������� � ����������� =".$this->rentabelnost_investic_predpriyat."<br>";
echo "----------------------------------------------<br>";
///////////////////////////
mysqli_query($this->dlink,"DELETE FROM Rentabelnost;");
 mysqli_query($this->dlink,"INSERT INTO `Rentabelnost`(`rentabelnost_activov`, `rentabelnost_produktsii`, `rentabelnost_prodaj`, `rentabelnost_sobstv_kapitala`, `rentabelnost_oborot_kapitala`, `rentabelnost_proizvodstv_fondov`, `rentabelnost_investic_predpriyat`) VALUES (
           '".$this->rentabelnost_activov."',
           '".$this->rentabelnost_produktsii."',
           '".$this->rentabelnost_prodaj."',
           '".$this->rentabelnost_sobstv_kapitala."',
           '".$this->rentabelnost_oborot_kapitala."',
           '".$this->rentabelnost_proizvodstv_fondov."',
           '".$this->rentabelnost_investic_predpriyat."'
           )");
      


///////������ ��������������� �����������
$z1=-0.3877-1.0736*$obsh_oborot_activ+0.0579*($obsh_zaemn_sredstva/$obsh_passiv);
$z2=19.892*($obsh_chist_prib/$mater_aktivi)+0.047*($obsh_oborot_activ/$obsh_kratkosroch_obyaz)+0.7141*($obsh_viruchka/$mater_aktivi)+0.4860*($obsh_sebestoimost/($obsh_komerch+$obsh_upravlench));
$z3=1.2*($oborot_kapital/$obsh_activ)+1.4*($neraspred_pribil/$obsh_activ)+3.3*($dob_pribil/$obsh_activ)+0.6*($rentabelnost_sobstv_kapitala/$obsh_passiv)+1.0*($obsh_viruchka/$obsh_activ);
echo "������������� ������=".$z1.";<br>";
echo "���������������� ������=".$z2.";<br>";
echo "������������ ������������� ������=".$z3.";<br>";
mysqli_query($this->dlink,"DELETE FROM Bankrotstvo;");
 mysqli_query($this->dlink,"INSERT INTO `Bankrotstvo`(`dvuhfaktor`, `cheturehfaktor`, `pyatifaktor`) VALUES (
           '".$z1."',
           '".$z2."',
           '".$z3."'
           )");

echo "----------------------------------------------<br>";
/////�����������
$koef_koncentrac_sobstv_kapitala=$obsh_money/11;
$koef_finansirovania=$obsh_money/$obsh_zaemn_sredstva;
$koef_koncentrac_zaem_kapitala=$obsh_zaemn_sredstva/$obsh_activ;
$koef_finance_ustoichivosti=$obsh_money+$obsh_zaemn_sredstva/$obsh_activ;
$koef_manevrenost_sobstv_kapitala=$obsh_oborot_sredstva/$obsh_vneoborot_activ;
$koef_obespech_zapasov_i_zatrat=$obsh_oborot_sredstva/($obsh_zatrati+$obsh_zapas);
$koef_sootnosheniya_vneoborot_i_oborot_activ=$obsh_vneoborot_activ/$obsh_oborot_activ;
$koef_immushestva_proizvodstv=$obsh_oborot_sredstva/$obsh_activ;

echo "����������� ������������ ������������ ��������=".$koef_koncentrac_sobstv_kapitala."<br>";
echo "����������� ��������������=".$koef_finansirovania."<br>";
echo "����������� ������������ �������� ��������=".$koef_koncentrac_zaem_kapitala."<br>";
echo "����������� ���������� ������������=".$koef_finance_ustoichivosti."<br>";
echo "����������� ������������� ������������ ��������=".$koef_manevrenost_sobstv_kapitala."<br>";
echo "����������� �������������� ������� � ������ ������������ ����������� ��������������=".$koef_obespech_zapasov_i_zatrat."<br>";
echo "����������� ����������� ������������ � ��������� �������=".$koef_sootnosheniya_vneoborot_i_oborot_activ."<br>";
echo "����������� �������� �����������=".$koef_immushestva_proizvodstv."<br>";
mysqli_query($this->dlink,"DELETE FROM Koeficienti;");
 mysqli_query($this->dlink,"INSERT INTO `Koeficienti`(`koef_koncentrac_sobstv_kapitala`, `koef_finansirovania`, `koef_koncentrac_zaem_kapitala`,`koef_finance_ustoichivosti`, `koef_manevrenost_sobstv_kapitala`, `koef_obespech_zapasov_i_zatrat`, `koef_sootnosheniya_vneoborot_i_oborot_activ`, `koef_immushestva_proizvodstv`) VALUES (
           '".$koef_koncentrac_sobstv_kapitala."',
           '".$koef_finansirovania."',
           '".$koef_koncentrac_zaem_kapitala."',
           '".$koef_finance_ustoichivosti."',
           '".$koef_manevrenost_sobstv_kapitala."',
           '".$koef_obespech_zapasov_i_zatrat."',
           '".$koef_sootnosheniya_vneoborot_i_oborot_activ."',
           '".$koef_immushestva_proizvodstv."'
           )");



}
}
?>