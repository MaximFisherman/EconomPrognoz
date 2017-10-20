<?php
require_once("../Classes/Parser.php");
$parser = new Parser;
$mass=$parser->pars();
$parser->Add_to_base_excel_param($mass);
$parser->show($mass);

echo("<script>window.location.href = \"../pages/MainPage.html\"</script>");
?>