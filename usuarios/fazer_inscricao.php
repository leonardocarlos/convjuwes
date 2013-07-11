<?php

$id = $_SESSION['SSusuario_id'];

$eventoQuery = consultaDados("select * FROM evento where ativo = 1");

$tipo_pagamento['Depósito'] = 'Depósito';
$tipo_pagamento['Cartão'] = 'Pagseguro';

if(isset($_POST['inscrever'])){
$id_evento = $_POST['evento'];
$quantidade = $_POST['quantidade'];
$tipo_pagamento = $_POST['tipo_pagamento'];
$cartao = $_POST['cartao'];
$deposito = $_POST['deposito'];
$obs = $_POST['obs'];

if($tipo_pagamento == 'Depósito'){
    
  insereDados("insert INTO inscricoes(
    id_evento,
    id_inscrito,
    quantidade,
    tipo_pagamento,
    valor,
    obs,
    data_inscricao
    ) values (
    '$id_evento',
    '$id',
    '$quantidade',
    '$tipo_pagamento',
    '$deposito',
    '$obs',
    now()
    )");
       
        echo "<script>
        alert('Participante Cadastrado com sucesso! Confira seu email e efetue o pagamento.');
        window.location.href ='" . URL_BASE . "usuarios/painel_usuario.php';
        </script>";        
}else{
if($tipo_pagamento == 'Depósito'){
    
  insereDados("insert INTO inscricoes(
    id_evento,
    id_inscrito,
    quantidade,
    tipo_pagamento,
    valor,
    obs,
    data_inscricao
    ) values (
    '$id_evento',
    '$id',
    '$quantidade',
    '$tipo_pagamento',
    '$cartao',
    '$obs',
    now()
    )");    
}
}
}
?>
<?php while($evento = mysql_fetch_array($eventoQuery)) { ?>
<div class="well well-small display">
     <h3>Inscrição no Eventos</h3>
     <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
<div class="controls-row">     
    <div class="span6">
        <label for="">Selecione o Evento</label>
        <select name="evento" id="" class="span5">
         
        <option value="<?php echo $evento['id'];?>"><?php echo $evento['nome_evento'];?></option>
        
        </select>
    </div>
</div>
<div class="controls-row">
    <div class="span1">
        <label for="">Quantidade: </label>
        <select name="quantidade" id="quantidade" class="span1">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
        </select>
    </div>
    <div class="span6">
        <label for="">Tipo Pagamento: </label>
        <select name="tipo_pagamento" id="tipo_pagamento" class="span2">
            <option value="<?php echo $tipo_pagamento['Depósito'];?>"><?php echo $tipo_pagamento['Depósito'] . ' - R$ '.$evento['valor_deposito'];?></option>
            <option value="<?php echo $tipo_pagamento['Cartão'];?>"><?php echo $tipo_pagamento['Cartão'] . ' - R$ '.$evento['valor_cartao'];?></option>
        </select>  
    </div>     
</div>  <!-- controls-row --> 
<div class="controls-row">
	<div class="span5">
        <label for="">Observação: </label>
        <textarea name="obs" id="" cols="50" rows="3" class="span5"></textarea>
        <small>Caso deseja fazer a inscrição para para mais pessoas coloque na caixa
            acima o nome completo dos participantes com um documento RG ou CPF </small>
        </div>
</div>  <!-- controls-row --> 
<div class="controls-row">
<input type="hidden" value="<?php echo $evento['valor_deposito'];?>" name="deposito" />
<input type="hidden" value="<?php echo $evento['valor_cartao'];?>" name="cartao" />

</div>  <!-- controls-row -->
<div class="controls-row">
	<div class="span5">
<input type="submit" value="Inscrever" class="btn btn-primary pull-right" name="inscrever" formmethod="post"/>
	</div>
</div>  <!-- controls-row -->   
</form>
</div>
<?php } ?>