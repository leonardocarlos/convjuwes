<?php 

function select($nome, $valores, $selecionado =''){ //
    $saida = '<select name="' . $nome .'" class=input>';
    foreach ($valores as $key => $value) { // Varre todas as informações do array valores
        $saida .= '<option value="' .$value .'"'; //
        if($value == $selecionado){  // Ser o valor for igual ao selecionado
            $saida .= ' selected="selected"'; // então então exiba-o
        }
        $saida .= '>' . $key .'</option>';
    }
    $saida .= '</select>';

    return $saida;
}

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
?>
<?php
function mostaMapa($endereco){
echo ("</pre><div id=\"ResultDiv\" style=\"text-align: center;\"></div><pre>");
$key = "AIzaSyC4NDC5_q-ewlnCqf2kzMmWptbf-RsSxzQ";
echo "<script src=\"http://maps.googleapis.com/maps/api/js?key=" . $key . "&sensor=true\" type=\"text/javascript\"></script>";
}
?>