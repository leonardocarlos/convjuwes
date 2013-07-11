<?php
//require_once 'classes/funcoes.php';

$id_evento = $_POST['id_evento'];

$eventoQuery = consultaDados("select * from evento where id_evento = $id_evento and ativo = 1");
$evento = mysql_fetch_array($eventoQuery);

?>
<?php
$id_evento = $_POST['marca'];

$eventoQuery = consultaDados("select * from evento where id_evento = $id_evento and ativo = 1");
$evento = mysql_fetch_array($eventoQuery);

if(mysql_num_rows($qr) == 0){
   echo  '<option value="0">'.htmlentities('Aguardando marca...').'</option>';
   
}else{
   	  echo '<option value="0">Selecione modelo...</option>';
   while($ln = mysql_fetch_assoc($qr)){
      echo '<option value="'.$ln['id'].'">'.$ln['modelo'].'</option>';
	  
   }
}
?>

<input type="text" class="span1" id="recebendo" disabled name="valor" value=""/>
<?php
/*
echo "<dt>Distrito: </dt><dd><select name='distrito'>";
while($reg = mysql_fetch_array($rs)){
    echo "<option value='" . $reg['nome'] . "'>" . $reg['nome'] . "</option>";
}
echo "</select></dd>";*/
?>