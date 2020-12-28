
<?php
$url = isset($_GET['url']) ? $_GET['url'] : null;
$name = isset($_GET['title']) ? $_GET['title'] : null;

header("Content-Description: File Transfer"); 
header("Content-Type: application/octet-stream"); 
header("Content-Disposition: attachment; filename={$name}.mp4"); 

readfile(urlencode($url));
exit(); 
?>