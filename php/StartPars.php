<?php
require_once("../Classes/Parser.php");
$parser = new Parser;
$mass=$parser->pars();
$parser->Add_to_base_excel_param($mass);
$parser->show($mass);
$parser->calculate_main();
echo("<script>window.location.href = \"../pages/MainPage.html\"</script>");
?>