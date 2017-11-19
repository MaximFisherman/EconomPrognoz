<?php

/*
  An Example PDF Report Using FPDF
  by Matt Doyle

  From "Create Nice-Looking PDFs with PHP and FPDF"
  http://www.elated.com/articles/create-nice-looking-pdfs-php-fpdf/
*/

require_once("../Library/FPDF/PDF_LineGraph.php");
require_once( "../Classes/Base.php" );
require_once( "../Classes/Query.php" );


// Начало конфигурации

$textColour = array( 0, 0, 0 );
$headerColour = array( 100, 100, 100 );
$tableHeaderTopTextColour = array( 255, 255, 255 );
$tableHeaderTopFillColour = array( 125, 152, 179 );
$tableHeaderTopProductTextColour = array( 0, 0, 0 );
$tableHeaderTopProductFillColour = array( 143, 173, 204 );
$tableHeaderLeftTextColour = array( 99, 42, 57 );
$tableHeaderLeftFillColour = array( 184, 207, 229 );
$tableBorderColour = array( 50, 50, 50 );
$tableRowFillColour = array( 213, 170, 170 );
$reportName = "Report created M inc";
$reportNameYPos = 160;
$logoFile = "widget-company-logo.png";
$logoXPos = 50;
$logoYPos = 108;
$logoWidth = 110;
$columnLabels = array( "Q1", "Q2", "Q3", "Q4" );

//График активов
$rowLabels = $_GET['year'];
$chartXPos = 10;
$chartYPos = 160;
$chartWidth = 160;
$chartHeight = 80;
$chartXLabel = "Year";
$chartYLabel = "Cost";
$chartYStep = 2000;

$chartColours = array(
                  array( 255, 100, 100 ),
                  array( 100, 255, 100 ),
                  array( 100, 100, 255 ),
                  array( 255, 255, 100 ),
                );

$data = array(
          array( 9940, 10, 9490, 11730 ),
          array( 19310, 21140, 20560, 22590 ),
          array( 25110, 26260, 25210, 28370 ),
          array( 27650, 24550, 30040, 31980 ),
        );

// Конец конфигурации

$pdf = new PDF_LineGraph('P', 'mm', 'A4');
$pdf->AddPage();
/**
  Создаем титульную страницу
**/
$pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );


/**
  Создаем колонтитул, заголовок и вводный текст
**/
$pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
$pdf->SetFont( 'Arial', '', 17 );
$pdf->Cell( 0, 15, $reportName, 0, 0, 'C' );
$pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
$pdf->SetFont( 'Arial', '', 20 );
$pdf->Write( 19, "Report created M inc" );
$pdf->Ln( 16 );
$pdf->SetFont( 'Arial', '', 12 );
$pdf->Write( 6, "Calculating the value of assets and liabilities at the end and the beginning of the year:" );
$pdf->Ln( 8 );

$active_massiv = array();
$passive_massiv = array();
$total_massiv = array();

for($i = 0; $i < count($_GET['year']); $i++)
{
	$active_massiv[$_GET['year'][$i]." ".substr($_GET['start_year'][$i],0 ,5)] = $_GET['activi_raschet'][$i];
}

for($i = 0; $i < count($_GET['year']); $i++)
{
	$passive_massiv[$_GET['year'][$i]." ".substr($_GET['start_year'][$i],0 ,5)] = $_GET['pasivi_raschet'][$i];
}

for($i = 0; $i < count($_GET['year']); $i++)
{
	$total_massiv[$_GET['year'][$i]." ".substr($_GET['start_year'][$i],0 ,5)] = $_GET['stoimost_activ'][$i];
}

// print_r($active_massiv);
 
$pdf->SetFont('Arial','',10);
$data = array(
    'Active' => $active_massiv,
    'Passiv' => $passive_massiv,
	'Total Assets' => $total_massiv
);

$colors = array(
    'Active' => array(114,171,237),
    'Passiv' => array(163,36,153),
	'Total Assets' => array(255, 0, 0)
);

// Display options: all (horizontal and vertical lines, 4 bounding boxes)
// Colors: fixed
// Max ordinate: 6
// Number of divisions: 3

$pdf->LineGraph(190,100,$data,'VHkBvBgBdB',$colors,6,3);

$pdf->Ln( 105 );
$pdf->SetFont( 'Arial', '', 12 );
$pdf->Write( 6, "The financial situation of the enterprise on the basis of analysis is: ".$_GET['sost_finance']."" );

$pdf->Ln( 8 );
$pdf->Write( 6, "Coefficient of concentration of own capital: ".$_GET['koef_koncentrac_sobstv_kapitala']." (".$_GET['koef_koncentrac_sobstv_kapitala_norma'].")" );
$pdf->Ln( 5 );
$pdf->Write( 6, "Coefficient of financing: ".$_GET['koef_finansirovania']." (".$_GET['koef_finansirovania_norma'].")" );
$pdf->Ln( 5 );
$pdf->Write( 6, "Concentration factor of borrowed capital: ".$_GET['koef_koncentrac_zaem_kapitala']." (".$_GET['koef_koncentrac_zaem_kapitala_norma'].")" );
$pdf->Ln( 5 );
$pdf->Write( 6, "Coefficient of financial stability: ".$_GET['koef_finance_ustoichivosti']."" );
$pdf->Ln( 5 );
$pdf->Write( 6, "Coefficient of maneuverability of equity capital: ".$_GET['koef_manevrenost_sobstv_kapitala']." (".$_GET['koef_manevrenost_sobstv_kapitala_norma'].")" );
$pdf->Ln( 5 );
$pdf->Write( 6, "Coefficient of supply and cost of own sources of financing: ".$_GET['koef_obespech_zapasov_i_zatrat']." (".$_GET['koef_obespech_zapasov_i_zatrat_norma'].")" );
$pdf->Ln( 5 );
$pdf->Write( 6, "Ratio of non-current and current assets: ".$_GET['koef_sootnosheniya_vneoborot_i_oborot_activ']." " );
$pdf->Ln( 7 );


//Bar diagram
$data2 = array('concentration of own capital' => $_GET['koef_koncentrac_sobstv_kapitala'], 'financing' => $_GET['koef_finansirovania'], 'factor of borrowed capital' => $_GET['koef_koncentrac_zaem_kapitala'], 'financial stability' => $_GET['koef_finance_ustoichivosti'], 'maneuverability of equity capital' => $_GET['koef_manevrenost_sobstv_kapitala'], 'supply and cost of own sources of financing' => $_GET['koef_obespech_zapasov_i_zatrat'], 'non-current and current assets' => $_GET['koef_sootnosheniya_vneoborot_i_oborot_activ']);

//Bar diagram
$pdf->SetFont('Arial', 'BIU', 12);
$pdf->Cell(0, 5, 'Indicators of financial stability of the enterprise', 0, 1);
$pdf->Ln(8);
$valX = $pdf->GetX();
$valY = $pdf->GetY();
$pdf->BarDiagram(190, 70, $data2, '%l : %v (%p)', array(255,175,100));
$pdf->SetXY($valX, $valY + 80);

$pdf->Ln( 150 );

$pdf->SetFont( 'Arial', '', 12 );


//Bar diagram
$data3 = array('Assets' => $_GET['rentabelnost_activov'], 'Products' => $_GET['rentabelnost_produktsii'], 'Selling' => $_GET['rentabelnost_prodaj'], 'Equity' => $_GET['rentabelnost_sobstv_kapitala'], 'Working capital' => $_GET['rentabelnost_oborot_kapitala'], 'Production funds' => $_GET['rentabelnost_proizvodstv_fondov'], 'Investments' => $_GET['rentabelnost_investic_predpriyat']);

//Bar diagram
$pdf->SetFont('Arial', 'BIU', 12);
$pdf->Cell(0, 5, 'Indicators of profitability (profitability) of the enterprise', 0, 1);
$pdf->Ln(8);
$valX = $pdf->GetX();
$valY = $pdf->GetY();
$pdf->BarDiagram(190, 70, $data3, '%l : %v (%p)', array(255,175,100));
$pdf->SetXY($valX, $valY + 80);


$pdf->Ln(15);
//Bar diagram
$data3 = array('Assets' => $_GET['dvuhfaktor'], 'Products' => $_GET['cheturehfaktor'], 'Selling' => $_GET['pyatifaktor']);

//Bar diagram
$pdf->SetFont('Arial', 'BIU', 12);
$pdf->Cell(0, 5, 'Forecasting bankruptcy', 0, 1);
$pdf->Ln(8);
$valX = $pdf->GetX();
$valY = $pdf->GetY();
$pdf->BarDiagram(190, 70, $data3, '%l : %v (%p)', array(255,175,100));
$pdf->SetXY($valX, $valY + 80);

$pdf->SetFont( 'Arial', '', 12 );

$pdf->Write( 6, "Analysis report:" );
$pdf->Ln(5);
$pdf->Write( 6, "Two-factor model: ".$_GET['dvuhfaktor_norma']." ");
$pdf->Ln(5);
$pdf->Write( 6, "four-factor model: ".$_GET['cheturehfaktor_norma']." ");
$pdf->Ln(5);
$pdf->Write( 6, "Five-factor model: ".$_GET['pyatifaktor_norma']." ");


$pdf->AddPage();


//График пассив
$rowLabels = $_GET['year_liq'];
$chartXPos = 10;
$chartYPos = 160;
$chartWidth = 160;
$chartHeight = 80;
$chartXLabel = "Year";
$chartYLabel = "Cost";
$chartYStep = 2000;

		
$data2 = array('Absolute liquidation' => $_GET['koef_obsolut_liquid'], 'Fast liquidity' => $_GET['koef_krit_fast_liquid'], 'Current liquidity' => $_GET['koef_tekysh_liquid'], 'Security of own. means' => $_GET['koef_obespech_sobstv_sredstv']);

$a1 = array();
$a2 = array();
$a3 = array();
$a4 = array();

for($i = 0; $i < count($_GET['year_liq']); $i++)
{
	$a1[$_GET['year_liq'][$i]] = $_GET['koef_obsolut_liquid'][$i];
	$a2[$_GET['year_liq'][$i]] = $_GET['koef_krit_fast_liquid'][$i];
	$a3[$_GET['year_liq'][$i]] = $_GET['koef_tekysh_liquid'][$i];
	$a4[$_GET['year_liq'][$i]] = $_GET['koef_obespech_sobstv_sredstv'][$i];
}

// print_r($active_massiv);
 
$pdf->SetFont('Arial','',10);
$data = array(
    'Absolute liquidation' => $a1,
    'Fast liquidity' => $a2,
	'Current liquidity' => $a3, 
	'Security of own. means' => $a4
);
$colors = array(
    'Absolute liquidation' => array(114,171,237),
    'Fast liquidity' => array(163,36,153),
	'Current liquidity' => array(255, 0, 0),
	'Security of own. means' => array(255, 230, 102)
);

// Display options: all (horizontal and vertical lines, 4 bounding boxes)
// Colors: fixed
// Max ordinate: 6
// Number of divisions: 3

$pdf->SetFont( 'Arial', '', 12 );
$pdf->Write( 6, "Calculating the value of assets and liabilities at the end and the beginning of the year:" );
$pdf->Ln( 10 );
$pdf->LineGraph(190,100,$data ,'VHkBvBgBdB',$colors,6,3);
$pdf->Ln( 120 );

$pdf->SetFont( 'Arial', '', 12 );
for($i = 0; $i < count($_GET['year_liq']); $i++)
{
	$pdf->Write( 6, "Year".$_GET['year_liq'][$i]." ");
	$pdf->Ln( 5 );
	$pdf->Write( 6, "Absolute liquidation: ".$_GET['koef_obsolut_liquid'][$i]." (".$_GET['koef_obsolut_liquid_norma'][$i].")" );
	$pdf->Ln( 5 );
	$pdf->Write( 6, "Fast liquidity: ".$_GET['koef_krit_fast_liquid'][$i]." (".$_GET['koef_krit_fast_liquid_norma'][$i].")" );
	$pdf->Ln( 5 );
	$pdf->Write( 6, "Current liquidity: ".$_GET['koef_tekysh_liquid'][$i]." (".$_GET['koef_tekysh_liquid_norma'][$i].")" );
	$pdf->Ln( 5 );
	$pdf->Write( 6, "Security of own. means: ".$_GET['koef_obespech_sobstv_sredstv'][$i]." (".$_GET['koef_obespech_sobstv_sredstv_norma'][$i].")" );
	$pdf->Ln( 10 );
}




$pdf->Output();
?>

