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
    if(strlen($nome_evento) >10 ){
    $mensagem .= "
		<div class='alert alert-error'>
         <a class='close' data-dismiss='alert' href='#'>x</a>Limite de Caracteres ultrapassou! Máximo 10.
         </div>
	";
    }
    if(strlen($nome_evento) <2 ){
    $mensagem .= "
		<div class='alert alert-error'>
         <a class='close' data-dismiss='alert' href='#'>x</a>Código do Evento Obrigatório!
         </div>
	";
    }      
    if(strlen($nome_evento) <2){
    $mensagem .= "
		<div class='alert alert-error'>
         <a class='close' data-dismiss='alert' href='#'>x</a>Nome do Evento Obrigatório!
         </div>
	";
    }
    if(empty($mensagem)){
       insereDados("insert INTO evento(
   	codigo_evento,
   	nome_evento,
	data_inicio,
    data_fim,
    valor_deposito,
    valor_cartao,
    local,
    codigo1,
    desconto1,
    codigo2,
    desconto2,
    codigo3,
    desconto3,
    ativo
	) values (
        '$codigo_evento',
	'$nome_evento',
	'$data_inicio',
    '$data_fim',
    '$valor_deposito',
    '$valor_cartao',
    '$local',
    '$codigo1',
    '$desconto1',
    '$codigo2',
    '$desconto2',
    '$codigo3',
    '$desconto3',
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
    <div class="span4">
        <label>Codigo Evento:</label>
        <input type="text" name="codigo_evento" required class="span1" value=""/> <small> Máximo 10 caracteres</small>
    </div>
</div>  <!-- controls-row -->    
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
<br>
<div class="controls-row">
    <div class="span5">
        <p>Digite o valor da porcentagem sem o sinal de % </p>
    </div> 
</div><!-- controls-row -->
<div class="controls-row">
    
	<div class="span1">          
    	<label>Código 1:</label>
        <input type="text" name="codigo1" class="span1" id="">
    </div> 
    <div class="span1">
        <label>Valor 1:</label>        
    	<input type="text" name="desconto1" class="span1 dinheiro" id="">
    </div>
</div><!-- controls-row -->
<div class="controls-row">    
    <div class="span1">
        <label>Código 2:</label>
        <input type="text" name="codigo2" class="span1" id=""> 
    </div> 
    <div class="span1">
        <label>Valor 2:</label>        
        <input type="text" name="desconto2" class="span1 dinheiro"  id="">
    </div>
</div><!-- controls-row -->
<div class="controls-row">    
    <div class="span1">
        <label>Código 3:</label>
        <input type="text" name="codigo3" class="span1"  id="">
    </div> 
    <div class="span1">
        <label>Valor 3:</label>
        <input type="text" name="desconto3" class="span1 dinheiro"  id="">
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