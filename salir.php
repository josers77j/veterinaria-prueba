<?php
session_start();

session_destroy();
header("Location: dash.php");
exit();

?>
