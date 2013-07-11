<?php

$id_evento = $_POST['evento'];

$eventoQuery = consultaDados("select * from evento where id_evento = $id_evento and ativo = 1");
$evento = mysql_fetch_array($eventoQuery);

if(mysql_num_rows($evento) == 0){
   echo  '<option value="0">'.htmlentities('---').'</option>';
   
}else{
   	  echo '<option value="0">'.htmlentities('Aguardando valor...').'</option>';
 //  while($ln = mysql_fetch_assoc($evento)){
      echo '<option value="'.$evento['valor_deposito'].'">Depósito</option>';
      echo '<option value="'.$evento['valor_cartao'].'">Cartão</option>';
      //echo '<input type="text" class="span1" disabled name="valor" value=""/>';
	  
  // }
}

?>
