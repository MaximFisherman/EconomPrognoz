<?php
$file = '../Main excel file/Econom.xls';

if(!$file){ // file does not exist
    die('file not found');
} else {
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=Example.xls");
    header("Content-Type: application/zip");
    header("Content-Transfer-Encoding: binary");

    // read the file from disk
    readfile($file);
}

	echo("<script>window.location.href = \"../pages/index.html\"</script>");
?>