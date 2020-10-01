<?php
echo file_get_contents("http://127.0.0.1:1234/?".$_SERVER['QUERY_STRING']);
?>