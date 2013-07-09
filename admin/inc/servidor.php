<?php

// só inclui o config.php se ele nao foi incluido antes
if(!defined('DB_USUARIO')){
    require_once 'config.php';
}

if(!isset($conexao)){
    // a variável conexão vai relacionar os comandos mysqla esta conexão
    $conexao = mysql_connect(DB_SERVER, DB_USUARIO, DB_SENHA) or die (db_erro());
    mysql_select_db(DB_BASE, $conexao) or die (db_erro());
    mysql_set_charset('utf8', $conexao);

    function consultaDados($sql){
        global $conexao;
        $res = mysql_query($sql, $conexao) or die (db_erro());
        return $res;
    }
        function insereDados($sql){
        global $conexao;
        $res = mysql_query($sql, $conexao) or die (db_erro() . '<br />' . mysql_error());
        // somente retorno o id inserido caso o comando mysql_query retorno verdadeiro
        if($res){
            $id = mysql_insert_id() or die (db_erro());
            return $id;
        }else{
            die();
        }
    }
    function fetch($objeto){
        return mysql_fetch_array($objeto);
    }
}
include 'funcoes.php';