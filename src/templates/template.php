<?php
print_r($_POST);
$uploaddir = '/home/roma/slim/src/download_files/';
$uploadfile = $uploaddir . basename($_FILES['file']['tmp_name']);
if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
    echo "Файл корректен и был успешно загружен.\n";
} else {
    echo "Возможная атака с помощью файловой загрузки!\n";
}
