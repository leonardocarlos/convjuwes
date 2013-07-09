<?php
include '../classes/funcoes.php';
session_start();
session_destroy();

header("Location:" .URL_BASE. "index.php"); exit;

?>