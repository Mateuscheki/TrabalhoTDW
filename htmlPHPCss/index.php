<?php
include './includes/header.php';

$page = $_GET['page'] ?? 'home';
$pagePath = "pages/$page.php";

if (file_exists($pagePath)) {
    include $pagePath;
} else {
    echo "<h1>Página não encontrada!</h1>";
}

?>