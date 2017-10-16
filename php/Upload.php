<?php
// В PHP 4.1.0 и более ранних версиях следует использовать $HTTP_POST_FILES
// вместо $_FILES.

$uploaddir = '../Exel/';
$uploadfile = $uploaddir . basename($_FILES['fileToUpload']['name']);

echo '<pre>';
if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $uploadfile)) {
	$type_file = pathinfo($uploadfile, PATHINFO_EXTENSION);
    $name_file = $uploaddir . "Econom." . $type_file;
    rename($uploadfile, $name_file);
    echo "Файл корректен и был успешно загружен.\n";
} else {
    echo "Возможная атака с помощью файловой загрузки!\n";
}

echo 'Некоторая отладочная информация:';
print_r($_FILES);

print "</pre>";
?>