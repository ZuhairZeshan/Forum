<?php

session_start();
echo "Done";
session_destroy();
header('Location: /zuhair/forum/index.php');

?>