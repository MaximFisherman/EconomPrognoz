<?php
// � PHP 4.1.0 � ����� ������ ������� ������� ������������ $HTTP_POST_FILES
// ������ $_FILES.

$uploaddir = '../Exel/';
$uploadfile = $uploaddir . basename($_FILES['fileToUpload']['name']);

echo '<pre>';
if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $uploadfile)) {
	$type_file = pathinfo($uploadfile, PATHINFO_EXTENSION);
    $name_file = $uploaddir . "Econom." . $type_file;
    rename($uploadfile, $name_file);
    echo "���� ��������� � ��� ������� ��������.\n";
} else {
    echo "��������� ����� � ������� �������� ��������!\n";
}

echo '��������� ���������� ����������:';
print_r($_FILES);

print "</pre>";
?>