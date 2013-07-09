<?php

if(isset($_POST['enviar'])){
    $nome_evento = $_POST['nome_evento'];
    $data_inicio = $_POST['data_inicio'];
    $data_fim = $_POST['data_fim'];
    $valor_deposito = $_POST['valor_deposito'];
    $valor_cartao = $_POST['valor_cartao'];
    $local = $_POST['local'];
    $ativo = $_POST['ativo'];

/*    foreach ($_POST as $campo => $valor){
        $form[$campo] = htmlspecialchars($_POST[$campo], ENT_QUOTES);
    }
    $mensagem =''; */
    if(strlen($nome_evento) <2){
    $mensagem .= "
		<div class='alert alert-error'>
         <a class='close' data-dismiss='alert' href='#'>x</a>Nome do Evento Obrigatório!
         </div>
	";
    }
    if(empty($mensagem)){
       insereDados("insert INTO evento(
   	nome_evento,
	data_inicio,
    data_fim,
    valor_deposito,
    valor_cartao,
    local,
    ativo
	) values (
	'$nome_evento',
	'$data_inicio',
    '$data_fim',
    '$valor_deposito',
    '$valor_cartao',
    '$local',
    '$ativo'
	)");


       $mensagem = "<div class='alert alert-error'>
         <a class='close' data-dismiss='alert' href='#'>x</a>Evento cadastrado com sucesso!
         </div>";
}

}

?>
<div class="well well-small">
	<h3>Cadastre seu Evento</h3>
    <hr>
           <?php if(!empty($mensagem)){ echo $mensagem; }  ?>

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
<fieldset>
<div class="controls-row">
    <div class="span6">
        <label>Nome Evento:</label>
        <input type="text" name="nome_evento" required class="span6" value=""/>
    </div>
</div>  <!-- controls-row -->
<div class="controls-row">
    <div class="span6">
        <label>Local:</label>
        <input type="text" name="local" required class="span6" value=""/>
    </div>
</div>  <!-- controls-row -->
<div class="controls-row">
    <div class="span2">
    <label>Data Início:</label>
    <input type="text" name="data_inicio" required  class="span2" value="" id="datepicker"/>
    </div>
    <div class="span2">
    <label>Data Fim:</label>
    <input type="text" name="data_fim" required  class="span2" value="" id="datepicker1"/>
    </div>
</div> <!-- controls-row -->

<div class="controls-row">
	<div class="span2">
    	<label>Valor Depósito:</label>
    	<input type="text" name="valor_deposito" class="span2 dinheiro" required id=""> <small>Somente número</small>
    </div>
    <div class="span2">
        <label>Valor Cartão:</label>
        <input type="text" name="valor_cartao" class="span2 dinheiro" required id=""><small>Somente número</small>
    </div>
</div> <!-- controls-row -->

<div class="controls-row">
    <div class="span2">
    <label>Ativar:</label>
    <select name="ativo" id="" class="span2">
            <option value="1">Ativo</option>
            <option value="2">Desativado</option>
        </select>
    </div>
</div> <!-- controls-row -->

<div class="controls-row">
	<div class="span2">
<input type="submit" value="Enviar" class="btn btn-primary" name="enviar" formmethod="post"/>
	</div>
</div>  <!-- controls-row -->
</fieldset>
</form>

</div>