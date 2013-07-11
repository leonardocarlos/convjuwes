<?php
include 'config.php';

    // Selecionar os Dados
    function consultaDados($sql){
        $result = mysql_query($sql) or die ('Não foi possível conectar'.  db_erro());
        return $result;
    }
    
    // Função para inserir dados
    function insereDados($sql){
        $result = mysql_query($sql) or die ('Não foi possível conectar'. db_erro() . '<br />' . mysql_error());
        // somente retorno o id inserido caso o comando mysql_query retorno verdadeiro
        if($result){
            $id = mysql_insert_id() or die (db_erro());
            return $id;
        }else{
            die();
        }        
    }
    
    function fetch($objeto){
        return mysql_fetch_array($objeto);
    }

    

function select($nome, $valores, $selecionado =''){ //
    $saida = '<select name="' . $nome .'" class=input>';
    foreach ($valores as $key => $value) { // Varre todas as informações do array valores
        $saida .= '<option value="' .$value .'"'; //
        if($value == $selecionado){  // Ser o valor for igual ao selecionado
            //$saida .= ' selected="selected"'; // então então exiba-o
            $saida .= ' active'; // então então exiba-o
        }
        $saida .= '>' . $key .'</option>';
    }
    $saida .= '</select>';

    return $saida;
}

// Formatação da data
function formataData($data, $formato = 'd-m-y'){
    // 2010-07-15 09:55:02

    $dia = substr($data, 8, 2);
    $mes = substr($data, 5, 2);
    $ano = substr($data, 0, 4);

    $hora = substr($data, 11, 2);
    $minuto = substr($data, 14, 2);
    $segundo = substr($data, 17, 2);

    return date($formato, mktime($hora, $minuto, $segundo, $mes, $dia, $ano));
}

function session_checker(){
 
    if (!isset($_SESSION['SSusuario_id'])){
 
        header ("Location:index.php");
        exit(); 
 
    }
 
}

function Paginacao($tabela,$limite){

$totalBusca = consultaDados("select id from $tabela");

// defina o número de registros exibidos por página
$limite = $limite;

// descubra o número da página que será exibida
// se o numero da página não for informado, definir como 1
/*  if (!$pagina) {
     $pagina = 1;
  }*/
if (!isset($_GET["pagina"])) {
$pagina = 1;
}
else {
$pagina = $_GET["pagina"];

}
// construa uma cláusula SQL "SELECT" que nos retorne somente os registros desejados
// definir o número do primeiro registro da página.
// Faça a continha na calculadora que você entenderá minha fórmula
$inicio = $pagina - 1;
$inicio = $limite * $inicio;

$sql2=("select * from $tabela LIMIT $inicio,$limite");
$query2=mysql_query($sql2);

// construa e exiba um painel de navegabilidade entre as páginas

$totalPaginas = ceil(mysql_num_rows($totalBusca)/$limite);

$anterior = $pagina - 1;
$proximo = $pagina + 1;


// se página maior que 1 (um), então temos link para a página anterior
if ($pagina > 1) {
    $prev_link = "<a href=".$_SERVER['PHP_SELF']."&pagina=$anterior>Anterior</a>";
  } else { // senão não há link para a página anterior
    $prev_link = "Anterior";
  }
// se número total de páginas for maior que a página corrente, 
// então temos link para a próxima página
if ($totalPaginas > $pagina) {
    $next_link = "<a href=" .$_SERVER['PHP_SELF']."&pagina=$proximo>Próxima</a>";
  } else { 
// senão não há link para a próxima página
    $next_link = "Próxima";
  }

  // exibir painel na tela
    return "$prev_link | $next_link";

  }
?>
