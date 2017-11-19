<?php
header('Content-Type: text/html; charset=utf-8');

require_once("Base.php");
class Query extends Base
{

	function set_param_for_report()
	{
		$str="SELECT `id_param`, `start_year`, `year`, `activi_raschet`, `pasivi_raschet`, `stoimost_activ`, `econom_rentabelnost`, `nalog_na_pribil`, `chistaya_pribil`, `rentabelnost_sredstv`, `ocenka_kachestva_zadolj`, `rashod_materialov`, `dostatochnaya_potrebnost`, `dostatochn_lvl_liquid`, `koef_obsolut_liquid`, `koef_krit_fast_liquid`, `koef_tekysh_liquid`, `manevrenost_sobstv_oborot_activ`, `koef_obespech_sobstv_sredstv`, `koef_vostanov_pletejsposob`, `stepen_platejnosti_obsh`, `stepen_platejnosti_tekysh_pokazat` FROM `Param` WHERE 1";

				$res= mysqli_query($this->dlink, $str);
				
				$i = 0;
				$year = array();
				$activi_raschet = array();
				echo("<script>window.location.href = \"CreateReport.php?");
			
			
				while($arr = mysqli_fetch_array($res)) {
					
					echo("start_year[]=".$arr['start_year']."&");
					echo("year[]=".$arr['year']."&");
					echo("activi_raschet[]=".$arr['activi_raschet']."&");
					echo("pasivi_raschet[]=".$arr['pasivi_raschet']."&");
					echo("stoimost_activ[]=".$arr['stoimost_activ']."&");
					 
					$i++;
				}
				
				//Get fincnce situation
				$result=mysqli_query($this->dlink,"SELECT count(year) from MainTable");
					while($row1 = $result->fetch_assoc())
					$years=$row1["count(year)"];
					$i=0;
					 $result=mysqli_query($this->dlink,"SELECT * from MainTable");
					 while($row = $result->fetch_assoc()) {
							$ms_year[$i]=$row["year"];$ms_condition[$i]=$row["start_year"];$i++;
						}
						
				for($j=0;$j<$years;$j++)
				{	
					$rez=mysqli_query($this->dlink,"SELECT * from MainTable where year='".$ms_year[$j]."' && start_year='".$ms_condition[$j]."'  ");
					while($rows = $rez->fetch_assoc()) 
						{

							$obsh_sobstv_sredstva=$obsh_sobstv_sredstva+$rows["sobstvennie_sredstva"];
							$obsh_vneoborot_activ=$obsh_vneoborot_activ+$rows["money"]+$rows["osn_sredstv"]+$rows["nemat_activ"]+$rows["financ_vloj"];
							$obsh_dolgosroch_obyaz=$obsh_dolgosroch_obyaz+$rows["dolgosroch_obstoyatelstva_kreditov"];
							$obsh_kratkosroch_obyaz=$obsh_kratkosroch_obyaz+$rows["kratkosroch_obstoyatelstva"];
						}
				}
						$ec=$obsh_sobstv_sredstva-$obsh_vneoborot_activ;
						$et=$ec+$obsh_dolgosroch_obyaz;	

						$absolut_finance_ustoichivost=($obsh_sobstv_sredstva-$obsh_vneoborot_activ)+$obsh_dolgosroch_obyaz+$obsh_kratkosroch_obyaz;

						if($ec>=0&&$et>=0&&$absolut_finance_ustoichivost>=0)$sost="Absolute stability";
						if($ec<0&&$et>=0&&$absolut_finance_ustoichivost>=0)$sost="Normal stability";
						if($ec<0&&$et<0&&$absolut_finance_ustoichivost>=0)$sost="Unstable financial condition";
						if($ec<0&&$et<0&&$absolut_finance_ustoichivost<0)$sost="Crisis financial condition";
				
				
				
				
				
				//Показатели со страницы 2 
				$rez=mysqli_query($this->dlink,"SELECT * from Koeficienti");
					 while($rows = $rez->fetch_assoc()) {

					$k1=$rows['koef_koncentrac_sobstv_kapitala'];if($k1<=0.6)$k1norma="abnormal";else $k1norma="Optimum value";
					$k2=$rows['koef_finansirovania'];if($k2<=1)$k2norma="abnormal";else $k2norma="Optimum value";
					 $k3=$rows['koef_koncentrac_zaem_kapitala'];if($k3<=0.4)$k3norma="abnormal";else $k3norma="Optimum value";
					 $k4=$rows['koef_finance_ustoichivosti'];if($k4<=0.75)$k4norma="abnormal";else if(0.8<=$k4&&$k4<=0.9) $k4norma="Optimum value";
					 $k5=$rows['koef_manevrenost_sobstv_kapitala'];if($k5>=0.5&&$k5<0.6)$k5norma="Optimum value";else $k5norma="abnormal";
					 $k6=$rows['koef_obespech_zapasov_i_zatrat'];if($k6>=0.6)$k6norma="Optimum value";else $k6norma="abnormal";
					  $k7=$rows['koef_sootnosheniya_vneoborot_i_oborot_activ'];
					 

					 }
				
				echo("koef_koncentrac_sobstv_kapitala=".$k1."&");
				echo("koef_koncentrac_sobstv_kapitala_norma=".$k1norma."&");
				echo("koef_finansirovania=".$k2."&");
				echo("koef_finansirovania_norma=".$k2norma."&");
				echo("koef_koncentrac_zaem_kapitala=".$k3."&");
				echo("koef_koncentrac_zaem_kapitala_norma=".$k3norma."&");
				echo("koef_finance_ustoichivosti=".$k4."&");
				echo("koef_finance_ustoichivosti_norma=".$k4norma."&");
				echo("koef_manevrenost_sobstv_kapitala=".$k5."&");
				echo("koef_manevrenost_sobstv_kapitala_norma=".$k5norma."&");
				echo("koef_obespech_zapasov_i_zatrat=".$k6."&");
				echo("koef_obespech_zapasov_i_zatrat_norma=".$k6norma."&");
				echo("koef_sootnosheniya_vneoborot_i_oborot_activ=".$k7."&");
				echo("koef_sootnosheniya_vneoborot_i_oborot_activ_norma=".$k7norma."&");
				
				echo("sost_finance=".$sost."&");
				
				//Страница 3 
				
				$result=mysqli_query($this->dlink,"SELECT count(year) from MainTable");
					while($row1 = $result->fetch_assoc())
					$years=$row1["count(year)"];
					$i=0;
					 $result=mysqli_query($this->dlink,"SELECT * from MainTable");
					 while($row = $result->fetch_assoc()) {
							$ms_year[$i]=$row["year"];$ms_condition[$i]=$row["start_year"];$i++;
						}





					for($j=0;$j<$years;$j++)
					{



					$rez=mysqli_query($this->dlink,"SELECT * from Param where year='".$ms_year[$j]."' && start_year='".$ms_condition[$j]."' ");
					 while($rows = $rez->fetch_assoc()) {

					 
					$k1=$rows['koef_obsolut_liquid'];if($k1>=0.2&&$k1<=0.3)$k1norma="Optimum value";else $k1norma="abnormal";
					$k2=$rows['koef_krit_fast_liquid'];if($k2>=0.7&&$k2<=0.9)$k2norma="Optimum value";else $k2norma="abnormal";
					 $k3=$rows['koef_tekysh_liquid'];if($k3>=1.9)$k3norma="Optimum value";else $k3norma="abnormal";
					 $k4=$rows['koef_obespech_sobstv_sredstv'];if($k4>=0.1)$k4norma="Optimum value";else $k4norma="abnormal";
											 echo("koef_obsolut_liquid[]=".$k1."&");
											 echo("koef_obsolut_liquid_norma[]=".$k1norma."&");
											 echo("koef_krit_fast_liquid[]=".$k2."&");
											 echo("koef_krit_fast_liquid_norma[]=".$k2norma."&");
											 echo("koef_tekysh_liquid[]=".$k3."&");
											 echo("koef_tekysh_liquid_norma[]=".$k3norma."&");
											 echo("koef_obespech_sobstv_sredstv[]=".$k4."&");
											 echo("koef_obespech_sobstv_sredstv_norma[]=".$k4norma."&");
											 echo("year_liq[]=".$ms_year[$j]."&");

					 if($ms_condition[$j]=="Finish year")$ms_year[$j]++;; 
					 }
					}

				
				//Страница 4 
				$rez=mysqli_query($this->dlink,"SELECT * from Rentabelnost");
					 while($rows = $rez->fetch_assoc()) {

					$k1=$rows['rentabelnost_activov'];if($k1>=0.2&&$k1<=0.3)$k1norma="оптимальное значение";else $k1norma="отклонен от нормы";
					$k2=$rows['rentabelnost_produktsii'];if($k1>=0.7&&$k1<=0.9)$k2norma="оптимальное значение";else $k2norma="отклонен от нормы";
					 $k3=$rows['rentabelnost_prodaj'];if($k1>=1.9)$k3norma="оптимальное значение";else $k3norma="отклонен от нормы";
					 $k4=$rows['rentabelnost_sobstv_kapitala'];if($k4>=0.1)$k4norma="оптимальное значение";else $k4norma="отклонен от нормы";
					 $k5=$rows['rentabelnost_oborot_kapitala'];if($k5>=1)$k5norma="оптимальное значение";else $k5norma="отклонен от нормы";
					  $k6=$rows['rentabelnost_proizvodstv_fondov'];if($k1>=1.9)$k3norma="оптимальное значение";else $k3norma="отклонен от нормы";
					 $k7=$rows['rentabelnost_investic_predpriyat'];if($k4>=0.1)$k4norma="оптимальное значение";else $k4norma="отклонен от нормы";
					 
					 }
				
				
					 echo("rentabelnost_activov=".$k1."&");
					 echo("rentabelnost_produktsii=".$k2."&");
					 echo("rentabelnost_prodaj=".$k3."&");
					 echo("rentabelnost_prodaj_norma=".$k3."&");
					 echo("rentabelnost_sobstv_kapitala=".$k4."&");
					 echo("rentabelnost_sobstv_kapitala_norma=".$k4."&");
					 echo("rentabelnost_oborot_kapitala=".$k5."&");
					 echo("rentabelnost_oborot_kapitala_norma=".$k5."&");
					 echo("rentabelnost_proizvodstv_fondov=".$k6."&");
					 echo("rentabelnost_proizvodstv_fondov_norma=".$k6."&");
					 echo("rentabelnost_investic_predpriyat=".$k7."&");
					 echo("rentabelnost_investic_predpriyat_norma=".$k7."&");
					 
				 //Страница 5 
					 $rez=mysqli_query($this->dlink,"SELECT * from Bankrotstvo");
						 while($rows = $rez->fetch_assoc()) {

						$k1=$rows['dvuhfaktor'];if($k1<=0)$k1norma="The threat of bankruptcy in the next year for the enterprise is small.";else $k1norma="
There is a probability of bankruptcy within the next year.";
						$k2=$rows['cheturehfaktor'];if($k1>1.425)$k2norma="The probability of 95% that bankruptcy in the next year will not happen and 79% that bankruptcy will not happen within the next 5 years";else $k2norma="There is a probability of bankruptcy within the next year.";
						 $k3=$rows['pyatifaktor'];if($k1>=2.7)$k3norma="Low probability of bankruptcy";else $k3norma="High probability of bankruptcy";
						 }
						 
					 echo("dvuhfaktor=".$k1."&");
					 echo("cheturehfaktor=".$k2."&");
					 echo("pyatifaktor=".$k3."&");
					 echo("dvuhfaktor_norma=".$k1norma."&");
					 echo("cheturehfaktor_norma=".$k2norma."&");
					 echo("pyatifaktor_norma=".$k3norma."&");
				echo("test=1");
				echo("\"</script>");
				$_SESSION['activi_raschet'] = array($year);
				$_SESSION['year'] = array($activi_raschet);
	}
	
	function Select_excel_file_param()
	{
		echo('
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
										<th>Период</th>
                                        <th>Год</th>
                                        <th>Нематериальные активы</th>
                                        <th>Основные средства</th>
                                        <th>Незавершенное строительство</th>
                                        <th>Доходы от вложения</th>
										<th>Долгосрочные и краткосрочные вложения</th>
                                        <th>Прочие внеоборотные активы</th>
										<th>Запасы</th>
                                        <th>Налог на добавленную стоимость по приобретенным ценностям</th>
										<th>Дебиторская задолженность</th>
                                        <th>Денежные средства</th>
										<th>Прочие оборотные активы</th>
										
                                        <th>Долгосрочные обязательства по займам и кредитам</th>
										<th>Прочие долгосрочные обязательства</th>
                                        <th>Краткосрочне обязательства</th>
										<th>Кредиторская задолженность</th>
                                        <th>Задолженность участникам по выплате доходов</th>
										<th>Резервы предстоящих расходов</th>
                                        <th>Прочие краткосрочне обязательства</th>	

										<th>Аналитический баланс</th>
										<th>Собственные средства</th>
                                        <th>Заемные средства</th>
										<th>НРЭЕ</th>
										
                                        <th>Потребность в оборотных активах</th>
										<th>Безнадежная дебиторская задолженность</th>
										
										<th>Выручка от продаж товаров</th>
                                        <th>Себестоимость реализованной продукции</th>
										<th>Материальные затраты</th>
                                        <th>Число днец в анализируемом периоде</th>
										<th>Необходимый запас материальных оборотных средств</th>
										<th>Фактические средние остатки оборотных активов</th>
                                        <th>Средние остатки краткосрочных обязательств</th>					
										
										<th>Показатели ОПФ</th>
                                    </tr>
                                </thead>
								<tbody>
								');
			//Вывод из БД
			$str="SELECT start_year, year, `nemat_activ`, `osn_sredstv`, `nezav_stroi`, `vloj_i_cennosti`, `financ_vloj`, `neoborot_activ`, `zapas`, `nalog`, `deb_zadolj`, `money`, `prochie_obor_activ`, `dolgosroch_obstoyatelstva_kreditov`, `prochie_dolgosroch_obstoyatelstva`, `kratkosroch_obstoyatelstva`, `kreditorskaya_zadolj`, `zadolj_po_viplate`, `rezervi_rashodov`, `prochie_kratkosroch_obyasatelstva`, `analitich_balanc`, `sobstvennie_sredstva`, `zaemnie_sredstva`, `nre`, `potrebn_oborot_activ`, `beznadej_debitorskaya_zadolj`, `viruchka_prodaj`, `sebestoimost_produkcii`, `mater_zatrati`, `chislo_dnei_vperiod`, `zapas_oborot_sredstv`, `faktich_sred_ostatki`, `srednie_ostatki_kratkosroch_obyaz`, `opf` FROM `MainTable` WHERE 1";

				$res= mysqli_query($this->dlink, $str);

				while($arr = mysqli_fetch_array($res)) {
					echo(" 
										<tr class=\"odd gradeX\">
											<td>".$arr["start_year"]."</td>
											<td>".$arr["year"]."</td>
											<td>".$arr["nemat_activ"]."</td>
											<td class=\"center\">".$arr["osn_sredstv"]."</td>
											<th>".$arr["nezav_stroi"]."</th>
											<th>".$arr["vloj_i_cennosti"]."</th>
											<td>".$arr["financ_vloj"]."</td>
											<td>".$arr["neoborot_activ"]."</td>
											<td class=\"center\">".$arr["zapas"]."</td>
											<td class=\"center\">".$arr["nalog"]."</td>		
											<td>".$arr["deb_zadolj"]."</td>
											<td>".$arr["money"]."</td>
											
											<td>".$arr["prochie_obor_activ"]."</td>
											<td>".$arr["dolgosroch_obstoyatelstva_kreditov"]."</td>
											<td>".$arr["prochie_dolgosroch_obstoyatelstva"]."</td>
											<td>".$arr["kratkosroch_obstoyatelstva"]."</td>
											<td>".$arr["kreditorskaya_zadolj"]."</td>
											<td>".$arr["zadolj_po_viplate"]."</td>
											<td>".$arr["rezervi_rashodov"]."</td>	

											<td>".$arr["prochie_kratkosroch_obyasatelstva"]."</td>
											<td>".$arr["analitich_balanc"]."</td>
											<td>".$arr["sobstvennie_sredstva"]."</td>
											<td>".$arr["zaemnie_sredstva"]."</td>
											
											<td>".$arr["nre"]."</td>
											<td>".$arr["potrebn_oborot_activ"]."</td>
											
											<td>".$arr["beznadej_debitorskaya_zadolj"]."</td>
											<td>".$arr["viruchka_prodaj"]."</td>
											<td>".$arr["sebestoimost_produkcii"]."</td>
											<td>".$arr["mater_zatrati"]."</td>
											<td>".$arr["chislo_dnei_vperiod"]."</td>
											<td>".$arr["zapas_oborot_sredstv"]."</td>
											<td>".$arr["faktich_sred_ostatki"]."</td>
											<td>".$arr["srednie_ostatki_kratkosroch_obyaz"]."</td>
											
											<td>".$arr["opf"]."</td>
										</tr>
						 ");
				}
								
		echo('						</tbody>
									</table>');
	}


	function Select_parametri()
	{
	echo '

<head>
<style>
.four {
  background: #ffffff;
  padding: 50px 20px;
  text-align: left;
} 
.four h1 {
  font-family: "Merriweather", serif;
  position: relative;
  color: #3CA1D9;
  font-size: 50px;
  font-weight: normal;
  padding: 8px 20px 7px 20px;
  border-top: 4px solid;
  border-left: 4px solid;
  display: inline-block;
  margin: 0;
  line-height: 1;
}
.four h1:before {
  content: ""; 
  position: absolute;
  width: 28px;
  height: 28px;
  top: -28px;
  left: -28px;
  border: 4px solid #3CA1D9;
  box-sizing: border-box;
}
@media (max-width: 450px) {
  .four h1 {font-size: 36px;}
  .four h1:before {
    width: 20px;
    height: 20px;
    top: -20px;
    left: -20px;
  }
}</style></head>
<div class="four"><h1>График активов предприятия</h1></div>
<div id="myfirstchart" style="height: 250px;"></div>';


$result=mysqli_query($this->dlink,"SELECT count(year) from MainTable");
while($row1 = $result->fetch_assoc())
$years=$row1["count(year)"];
$i=0;
 $result=mysqli_query($this->dlink,"SELECT * from MainTable");
 while($row = $result->fetch_assoc()) {
        $ms_year[$i]=$row["year"];$ms_condition[$i]=$row["start_year"];$i++;
    }





for($j=0;$j<$years;$j++)
{

$rez=mysqli_query($this->dlink,"SELECT * from Param where year='".$ms_year[$j]."' && start_year='".$ms_condition[$j]."'  ");
 while($rows = $rez->fetch_assoc()) 

{$activ=$rows["activi_raschet"];$passiv=$rows["pasivi_raschet"];$stoimost_activ=$rows["stoimost_activ"];
}
 if($ms_condition[$j]=="Finish year")$ms_year[$j]++;
if($j+1==$years)
$str=$str."{ year: '".$ms_year[$j]."', a: ".$activ.", b: ".$passiv.", c: ".$stoimost_activ."}";
else $str=$str."{ year: '".$ms_year[$j]."', a: ".$activ.", b: ".$passiv.", c: ".$stoimost_activ."},"; 

}


echo "
<script>
		new Morris.Line({

  element: 'myfirstchart',

  data: [".$str."
    
  ], 
  xkey: 'year',
  ykeys: ['a','b','c'],
   labels: ['Активы предприятия', 'Пассивы предприятия', 'Стоимость чистых активов']
});
</script>
";

for($j=0;$j<$years;$j++)
{

$rez=mysqli_query($this->dlink,"SELECT * from MainTable where year='".$ms_year[$j]."' && start_year='".$ms_condition[$j]."'  ");
 while($rows = $rez->fetch_assoc()) 

{

	$obsh_sobstv_sredstva=$obsh_sobstv_sredstva+$rows["sobstvennie_sredstva"];
	$obsh_vneoborot_activ=$obsh_vneoborot_activ+$rows["money"]+$rows["osn_sredstv"]+$rows["nemat_activ"]+$rows["financ_vloj"];
	$obsh_dolgosroch_obyaz=$obsh_dolgosroch_obyaz+$rows["dolgosroch_obstoyatelstva_kreditov"];
	$obsh_kratkosroch_obyaz=$obsh_kratkosroch_obyaz+$rows["kratkosroch_obstoyatelstva"];
}

	}
$ec=$obsh_sobstv_sredstva-$obsh_vneoborot_activ;
$et=$ec+$obsh_dolgosroch_obyaz;	


$absolut_finance_ustoichivost=($obsh_sobstv_sredstva-$obsh_vneoborot_activ)+$obsh_dolgosroch_obyaz+$obsh_kratkosroch_obyaz;

if($ec>=0&&$et>=0&&$absolut_finance_ustoichivost>=0)$sost="Абсолютная устойчивость";
if($ec<0&&$et>=0&&$absolut_finance_ustoichivost>=0)$sost="Нормальная устойчивость";
if($ec<0&&$et<0&&$absolut_finance_ustoichivost>=0)$sost="Неустойчивое финансовое состояние";
if($ec<0&&$et<0&&$absolut_finance_ustoichivost<0)$sost="Кризисное финансовое состояние";


	  echo ' <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i>Финансовое состояние
                        </div>
                        
                        <div class="panel-body">
                            <div class="list-group">
                       
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-money fa-fw"></i> '.$sost.'
                                    <span class="pull-right text-muted small">
                                    </span>
                                </a>
                            </div>';
}

function Select_stability()
{





$rez=mysqli_query($this->dlink,"SELECT * from Koeficienti");
 while($rows = $rez->fetch_assoc()) {

$k1=$rows['koef_koncentrac_sobstv_kapitala'];if($k1<=0.6)$k1norma="отклонен от нормы";else $k1norma="оптимальное значение";
$k2=$rows['koef_finansirovania'];if($k2<=1)$k2norma="отклонен от нормы";else $k2norma="оптимальное значение";
 $k3=$rows['koef_koncentrac_zaem_kapitala'];if($k3<=0.4)$k3norma="отклонен от нормы";else $k3norma="оптимальное значение";
 $k4=$rows['koef_finance_ustoichivosti'];if($k4<=0.75)$k4norma="отклонен от нормы";else if(0.8<=$k4&&$k4<=0.9) $k4norma="оптимальное значение";
 $k5=$rows['koef_manevrenost_sobstv_kapitala'];if($k5>=0.5&&$k5<0.6)$k5norma="оптимальное значение";else $k5norma="отклонен от нормы";
 $k6=$rows['koef_obespech_zapasov_i_zatrat'];if($k6>=0.6)$k6norma="оптимальное значение";else $k6norma="отклонен от нормы";
  $k7=$rows['koef_sootnosheniya_vneoborot_i_oborot_activ'];
 

 }



	


	  echo ' 
                            <div class="list-group">
                       
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-money fa-fw"></i> Коэффициент концентрации собственного капитала
                                    <span class="pull-right text-muted small" style="color:black">
                                    '.$k1.'
                                    </span>
                                    <span class="pull-right text-muted small" style="color:black;margin-right:50px;position:relative" >
                                    '.$k1norma.'
                                    </span>
                                </a>
                                 <a href="#" class="list-group-item">
                                    <i class="fa fa-money fa-fw"></i> Коэффициент финансирования
                                    <span class="pull-right text-muted small" style="color:black">
                                    '.$k2.'
                                    </span>
                                    <span class="pull-right text-muted small" style="color:black;margin-right:50px;position:relative" >
                                    '.$k2norma.'
                                    </span>
                                </a>
                                 <a href="#" class="list-group-item">
                                    <i class="fa fa-money fa-fw"></i> Коэффициент концентрации заемного капитала
                                    <span class="pull-right text-muted small" style="color:black">
                                    '.$k3.'
                                    </span>
                                    <span class="pull-right text-muted small" style="color:black;margin-right:50px;position:relative" >
                                    '.$k3norma.'
                                    </span>
                                </a>
                                 <a href="#" class="list-group-item">
                                    <i class="fa fa-money fa-fw"></i> Коэффициент финансовой устойчивости
                                    <span class="pull-right text-muted small" style="color:black">
                                    '.$k4.'
                                    </span>
                                    <span class="pull-right text-muted small" style="color:black;margin-right:50px;position:relative" >
                                    '.$k4norma.'
                                    </span>
                                </a>
                                  <a href="#" class="list-group-item">
                                    <i class="fa fa-money fa-fw"></i> Коэффициент маневренности собственного капитала
                                    <span class="pull-right text-muted small" style="color:black">
                                    '.$k5.'
                                    </span>
                                    <span class="pull-right text-muted small" style="color:black;margin-right:50px;position:relative" >
                                    '.$k5norma.'
                                    </span>
                                </a>
                                  <a href="#" class="list-group-item">
                                    <i class="fa fa-money fa-fw"></i> Коэффициент обеспеченности запасов и затрат собственными источниками финансирования
                                    
                                    <span class="pull-right text-muted small" style="color:black" >
                                    '.$k6.'
                                    </span>
                                    <span class="pull-right text-muted small" style="color:black;margin-right:50px;position:relative" >
                                    '.$k6norma.'
                                    </span>

                                </a>

                                 </a>
                                  <a href="#" class="list-group-item">
                                    <i class="fa fa-money fa-fw"></i> Коэффициент соотношения внеоборотных и оборотных активов

                                  
                                    <span class="pull-right text-muted small" style="color:black">
                                   '.$k7.'
                                    </span>
                                </a>
                                 </a>
                               
                            </div>';
							
}


function Select_liquid()
{


$result=mysqli_query($this->dlink,"SELECT count(year) from MainTable");
while($row1 = $result->fetch_assoc())
$years=$row1["count(year)"];
$i=0;
 $result=mysqli_query($this->dlink,"SELECT * from MainTable");
 while($row = $result->fetch_assoc()) {
        $ms_year[$i]=$row["year"];$ms_condition[$i]=$row["start_year"];$i++;
    }





for($j=0;$j<$years;$j++)
{



$rez=mysqli_query($this->dlink,"SELECT * from Param where year='".$ms_year[$j]."' && start_year='".$ms_condition[$j]."' ");
 while($rows = $rez->fetch_assoc()) {

 
$k1=$rows['koef_obsolut_liquid'];if($k1>=0.2&&$k1<=0.3)$k1norma="оптимальное значение";else $k1norma="отклонен от нормы";
$k2=$rows['koef_krit_fast_liquid'];if($k2>=0.7&&$k2<=0.9)$k2norma="оптимальное значение";else $k2norma="отклонен от нормы";
 $k3=$rows['koef_tekysh_liquid'];if($k3>=1.9)$k3norma="оптимальное значение";else $k3norma="отклонен от нормы";
 $k4=$rows['koef_obespech_sobstv_sredstv'];if($k4>=0.1)$k4norma="оптимальное значение";else $k4norma="отклонен от нормы";


 if($ms_condition[$j]=="Finish year")$ms_year[$j]++;
if($j+1==$years)
$str=$str."{ year: '".$ms_year[$j]."', a: ".$k1.", b: ".$k2.", c: ".$k3.", d: ".$k4."}";
else $str=$str."{ year: '".$ms_year[$j]."', a: ".$k1.", b: ".$k2.", c: ".$k3.", d: ".$k4."},"; 

 }
}

/*
echo "
<script>

Morris.Bar({
  element: 'bar-example',
  data: [
			{ type: 'абслютная ликвиность', a: ".$k1."},
            { type: 'быстрая ликвидность ', a: ".$k2."},
            { type: 'текущая ликвидность', a:".$k3."},
            { type: 'обеспеченность соб. средствами', a: ".$k4."},
            { type: 'платежеспособность предприятия', a: ".$k5."}
  ],
  xkey: 'type',
  ykeys: ['a'],
  labels: ['Series A']
});



</script>
";
*/
echo "
<script>
		new Morris.Line({

  element: 'bar-example',

  data: [".$str."
    
  ], 
  xkey: 'year',
  ykeys: ['a','b','c','d'],
   labels: ['абслютная ликвиность', 'быстрая ликвидность', 'текущая ликвидность', 'обеспеченность соб. средствами']
});
</script>
";

  
echo '<div id="bar-example" style="height: 250px;"></div>';

    				
	

$rez=mysqli_query($this->dlink,"SELECT * from Param where start_year='Finish year' ");
 while($rows = $rez->fetch_assoc()) {
if($rows['start_year']=="Finish year"){
	$k1=$rows['koef_obsolut_liquid'];if($k1>=0.2&&$k1<=0.3)$k1norma="оптимальное значение";else $k1norma="отклонен от нормы";
$k2=$rows['koef_krit_fast_liquid'];if($k2>=0.7&&$k2<=0.9)$k2norma="оптимальное значение";else $k2norma="отклонен от нормы";
 $k3=$rows['koef_tekysh_liquid'];if($k3>=1.9)$k3norma="оптимальное значение";else $k3norma="отклонен от нормы";
 $k4=$rows['koef_obespech_sobstv_sredstv'];if($k4>=0.1)$k4norma="оптимальное значение";else $k4norma="отклонен от нормы";

	echo ' <p style="font-size:16px">Год '.$rows['year'].' </p>
                           <div class="list-group">
                       
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-money fa-fw"></i>Коэфициент абслютной ликвидности
                                    <span class="pull-right text-muted small" style="color:black">
                                    '.$k1.'
                                    </span>
                                    <span class="pull-right text-muted small" style="color:black;margin-right:50px;position:relative" >
                                    '.$k1norma.'
                                    </span>
                                </a>
                                 <a href="#" class="list-group-item">
                                    <i class="fa fa-money fa-fw"></i> Коэфициент критической или быстрой ликвидности
                                    <span class="pull-right text-muted small" style="color:black">
                                    '.$k2.'
                                    </span>
                                    <span class="pull-right text-muted small" style="color:black;margin-right:50px;position:relative" >
                                    '.$k2norma.'
                                    </span>
                                </a>
                                 <a href="#" class="list-group-item">
                                    <i class="fa fa-money fa-fw"></i> Коэфициент текущей ликвидности
                                    <span class="pull-right text-muted small" style="color:black">
                                    '.$k3.'
                                    </span>
                                    <span class="pull-right text-muted small" style="color:black;margin-right:50px;position:relative" >
                                    '.$k3norma.'
                                    </span>
                                </a>
                                 <a href="#" class="list-group-item">
                                    <i class="fa fa-money fa-fw"></i> Коэфициент обеспеченности соб. средствами
                                    <span class="pull-right text-muted small" style="color:black">
                                    '.$k4.'
                                    </span>
                                    <span class="pull-right text-muted small" style="color:black;margin-right:50px;position:relative" >
                                    '.$k4norma.'
                                    </span>
                                </a>
                              
                                
                               
                            </div>';}}
}

function Select_Rentabelnost()
{

$rez=mysqli_query($this->dlink,"SELECT * from Rentabelnost");
 while($rows = $rez->fetch_assoc()) {


$k1=$rows['rentabelnost_activov'];if($k1>=0.2&&$k1<=0.3)$k1norma="оптимальное значение";else $k1norma="отклонен от нормы";
$k2=$rows['rentabelnost_produktsii'];if($k1>=0.7&&$k1<=0.9)$k2norma="оптимальное значение";else $k2norma="отклонен от нормы";
 $k3=$rows['rentabelnost_prodaj'];if($k1>=1.9)$k3norma="оптимальное значение";else $k3norma="отклонен от нормы";
 $k4=$rows['rentabelnost_sobstv_kapitala'];if($k4>=0.1)$k4norma="оптимальное значение";else $k4norma="отклонен от нормы";
 $k5=$rows['rentabelnost_oborot_kapitala'];if($k5>=1)$k5norma="оптимальное значение";else $k5norma="отклонен от нормы";
  $k6=$rows['rentabelnost_proizvodstv_fondov'];if($k6>=1.9)$k6norma="оптимальное значение";else $k6norma="отклонен от нормы";
 $k7=$rows['rentabelnost_investic_predpriyat'];if($k7>=0.1)$k7norma="оптимальное значение";else $k7norma="отклонен от нормы";

 
 }
   	  
$str="{ type: 'Коэфициент абслютной ликвидности', a:0.3, b: ".$k1."},
            { type: 'Коэфициент критической или быстрой ликвидности', a:0.8, b: ".$k2."},
            { type: 'Коэфициент текущей ликвидности', a:2, b: ".$k3."},
            { type: 'Коэфициент обеспеченности соб. средствами', a:0.1, b: ".$k4."},
            { type: 'Коэфициент восстановления полатежеспособности предприятия', a:1, b: ".$k5."},
			            { type: 'Коэфициент критической или быстрой ликвидности', a:0.8, b: ".$k6."},
            { type: 'Коэфициент текущей ликвидности', a:2, b: ".$k7."}";


echo "
<script>

Morris.Bar({
  element: 'bar-example1',
  data: [
			{ type: 'активы', a: ".$k1."},
            { type: 'продукции ', a: ".$k2."},
            { type: 'продажи', a:".$k3."},
            { type: 'собственный капитал', a: ".$k4."},
            { type: 'оборотный капитал', a: ".$k5."},
			 { type: 'производственые фонды', a: ".$k6."},
            { type: 'инвестиции', a: ".$k7."}
			
  ],
  xkey: 'type',
  ykeys: ['a'],
  labels: ['Series A']
});
</script>
";


  


    echo ' 


<div id="bar-example1" style="height: 250px;"></div>
                            <div class="list-group">
                       
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-money fa-fw"></i> Рентабельность активов
                                    <span class="pull-right text-muted small" style="color:black">
                                    '.$k1.'
                                    </span>
                                    <span class="pull-right text-muted small" style="color:black;margin-right:50px;position:relative" >
                                    '.$k1norma.'
                                    </span>
                                </a>
                                 <a href="#" class="list-group-item">
                                    <i class="fa fa-money fa-fw"></i> Рентабельность продукции
                                    <span class="pull-right text-muted small" style="color:black">
                                    '.$k2.'
                                    </span>
                                    <span class="pull-right text-muted small" style="color:black;margin-right:50px;position:relative" >
                                     '.$k2norma.'
                                    </span>
                                </a>
                                 <a href="#" class="list-group-item">
                                    <i class="fa fa-money fa-fw"></i> Рентабельность продаж
                                    <span class="pull-right text-muted small" style="color:black">
                                    '.$k3.'
                                    </span>
                                    <span class="pull-right text-muted small" style="color:black;margin-right:50px;position:relative" >
                                     '.$k3norma.'
                                    </span>
                                </a>
                                 <a href="#" class="list-group-item">
                                    <i class="fa fa-money fa-fw"></i> Рентабельность собственного капитала
                                    <span class="pull-right text-muted small" style="color:black">
                                    '.$k4.'
                                    </span>
                                    <span class="pull-right text-muted small" style="color:black;margin-right:50px;position:relative" >
                                     '.$k4norma.'
                                    </span>
                                </a>
                                  <a href="#" class="list-group-item">
                                    <i class="fa fa-money fa-fw"></i> Рентабельность оборотного капитала
                                    <span class="pull-right text-muted small" style="color:black">
                                    '.$k5.'
                                    </span>
                                    <span class="pull-right text-muted small" style="color:black;margin-right:50px;position:relative" >
                                    '.$k5norma.'
                                    </span>
                                </a>
								 <a href="#" class="list-group-item">
                                    <i class="fa fa-money fa-fw"></i>Рентабельность производственных фондов
                                    <span class="pull-right text-muted small" style="color:black">
                                    '.$k6.'
                                    </span>
                                    <span class="pull-right text-muted small" style="color:black;margin-right:50px;position:relative" >
                                    '.$k6norma.'
                                    </span>
                                </a>
								 <a href="#" class="list-group-item">
                                    <i class="fa fa-money fa-fw"></i> Рентабельность инвестиции предприятия
                                    <span class="pull-right text-muted small" style="color:black">
                                    '.$k7.'
                                    </span>
                                    <span class="pull-right text-muted small" style="color:black;margin-right:50px;position:relative" >
                                    '.$k7norma.'
                                    </span>
                                </a>
                                
                               
                            </div>';
}


function Select_Bankrotstvo()
{

$rez=mysqli_query($this->dlink,"SELECT * from Bankrotstvo");
 while($rows = $rez->fetch_assoc()) {

$k1=$rows['dvuhfaktor'];if($k1<=0)$k1norma="Угроза банкротства в течение ближайшего года для предприятия мала.";else $k1norma="Есть вероятность банкротства в течение ближайшего года.";
$k2=$rows['cheturehfaktor'];if($k1>1.425)$k2norma="Вероятность 95% что банкротства в ближайший год не произойдет и 79% что банкротство не произойдет в течение следующийх 5 лет";else $k2norma="Есть вероятность банкротства в течение ближайшего года.";
 $k3=$rows['pyatifaktor'];if($k1>=2.7)$k3norma="Низкая вероятность банкротства";else $k3norma="Высокая вероятность банкротства";
 }

/*   	  
$str="{ type: 'Коэфициент абслютной ликвидности', a:0.3, b: ".$k1."},
            { type: 'Коэфициент критической или быстрой ликвидности', a:0.8, b: ".$k2."},
            { type: 'Коэфициент текущей ликвидности', a:2, b: ".$k3."},
            { type: 'Коэфициент обеспеченности соб. средствами', a:0.1, b: ".$k4."},
            { type: 'Коэфициент восстановления полатежеспособности предприятия', a:1, b: ".$k5."},
			            { type: 'Коэфициент критической или быстрой ликвидности', a:0.8, b: ".$k6."},
            { type: 'Коэфициент текущей ликвидности', a:2, b: ".$k7."}";

echo "

<script>

Morris.Bar({
  element: 'bar-example1',
  data: [
			{ type: 'активы', a: ".$k1."},
            { type: 'продукции ', a: ".$k2."},
            { type: 'продажи', a:".$k3."},
            { type: 'собственный капитал', a: ".$k4."},
            { type: 'оборотный капитал', a: ".$k5."},
			 { type: 'производственые фонды', a: ".$k6."},
            { type: 'инвестиции', a: ".$k7."}
			
  ],
  xkey: 'type',
  ykeys: ['a'],
  labels: ['Series A']
});
</script>
";

*/
  


    echo ' 
<head>
<style>
.four {
  background: #ffffff;
  padding: 50px 20px;
  text-align: left;
} 
.four h1 {
  font-family: "Merriweather", serif;
  position: relative;
  color: #3CA1D9;
  font-size: 50px;
  font-weight: normal;
  padding: 8px 20px 7px 20px;
  border-top: 4px solid;
  border-left: 4px solid;
  display: inline-block;
  margin: 0;
  line-height: 1;
}
.four h1:before {
  content: ""; 
  position: absolute;
  width: 28px;
  height: 28px;
  top: -28px;
  left: -28px;
  border: 4px solid #3CA1D9;
  box-sizing: border-box;
}
@media (max-width: 450px) {
  .four h1 {font-size: 36px;}
  .four h1:before {
    width: 20px;
    height: 20px;
    top: -20px;
    left: -20px;
  }

  </style></head>
<div class="four"><h1>Двухфакторная модель</h1></div>

<p style="font-size:18px;">Коефициент '.$k1.'</p> Вывод: '.$k1norma.'
<div class="four" style="color:green"><h1>Четырехфакторная модель</h1></div>
<p style="font-size:18px;">Коефициент '.$k2.' </p>Вывод: '.$k2norma.'
<div class="four" style="color:lightred"><h1>Пятифакторная модель</h1></div>
<p style="font-size:18px;">Коефициент '.$k3.'</p>Вывод: '.$k3norma.'';


}

}
?>