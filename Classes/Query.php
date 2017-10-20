<?php
//header('Content-Type: text/html; charset=utf-8');
require_once("Base.php");
class Query extends Base
{
	function Select_excel_file_param()
	{
		echo('
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
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
											<td>Win 95+</td>
											<td class=\"center\">4</td>
											<td class=\"center\">X</td>
											<td>Internet Explorer 4.0</td>
											<td>Win 95+</td>
											<td class=\"center\">4</td>
											<td class=\"center\">X</td>		
											<td>Internet Explorer 4.0</td>
											<td>Win 95+</td>
											
											<td>Internet Explorer 4.0</td>
											<td>Win 95+</td>
											<td>Internet Explorer 4.0</td>
											<td>Win 95+</td>
											<td>Win 95+</td>
											<td>Internet Explorer 4.0</td>
											<td>Win 95+</td>	

											<td>Win 95+</td>
											<td>Win 95+</td>
											<td>Internet Explorer 4.0</td>
											<td>Win 95+</td>
											
											<td>Internet Explorer 4.0</td>
											<td>Win 95+</td>
											
											<td>Win 95+</td>
											<td>Win 95+</td>
											<td>Internet Explorer 4.0</td>
											<td>Win 95+</td>
											<td>Win 95+</td>
											<td>Win 95+</td>
											<td>Win 95+</td>
											<td>Win 95+</td>
											
											<td>Win 95+</td>
										</tr>
						 ");
				}
								
		echo('						</tbody>
									</table>');
	}
}
?>