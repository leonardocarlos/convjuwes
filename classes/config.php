<?php

require ('conexaomysql.class.php');

// $conexao->fechar();

if(!defined('URL_BASE')){
    
    if($_SERVER['SERVER_NAME'] == "localhost"){
    define('URL_BASE', "http://localhost/convjuwes/", true);
    $conexao = new ConexaoMysql('localhost','root','','juwes6');
    $conexao->conectar();
    $conexao->selecionarBD();
    
    
    }elseif($_SERVER['SERVER_NAME'] == "juventudewesleyana6.com.br" || $_SERVER['SERVER_NAME'] == "www.juventudewesleyana6.com.br"){
    define('URL_BASE', "http://www.juventudewesleyana6.com.br/convjuwes/", true); 
    $conexao = new ConexaoMysql('mysql04.hstbr.net','juwes6','123456','forum');
    $conexao->conectar();
    $conexao->selecionarBD();
}

}

?>