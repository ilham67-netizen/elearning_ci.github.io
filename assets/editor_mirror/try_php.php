<?php
$fp = fopen("jajal2.php", "w") or die("Unable to open file!");
$editorCode = $_POST['editor'];
fwrite($fp, $editorCode);
fclose($fp);
?>