<?php

    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $data_nascimento = $_POST['data_nascimento'];
    $sexo = $_POST['sexo'];
    $telefone = $_POST['telefone'];
    $celular = $_POST['celular'];
    $cep = $_POST['cep'];	
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];	
    $complemento = $_POST['complemento'];		
    $bairro = $_POST['bairro'];		
    $cidade = $_POST['cidade'];	
    $estado = $_POST['estado'];	
    $email = $_POST['email'];
	

	$tellimpo = preg_replace("/[^a-zA-Z0-9]/", "", $telefone);
	$cellimpo = preg_replace("/[^a-zA-Z0-9]/", "", $telefone);

?>
<div class="well well-small">   
<div class"row-fluid">
<form name="bcash" action="https://www.bcash.com.br/checkout/pay/" method="post">

<input name="email_loja" type="hidden" value="vendaheranca@yahoo.com.br"> 
<input name="produto_codigo_1" type="hidden" value="herancacamp"> 
<input name="produto_descricao_1" type="hidden" value="Herança Camp de 28 a 31 de Março de 2013">
<input name="produto_qtde_1" type="hidden" value="1"> 
<input name="produto_valor_1" type="hidden" value="180.00" >
<input name="tipo_integracao" type="hidden" value="PAD">
<input name="id_pedido" type="hidden" value="1001"> 
<input name="email" type="hidden" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>" > 
<input name="nome" type="hidden" value="<?php if(isset($_POST['nome'])){echo $_POST['nome'];} ?>">
<input name="cpf" type="hidden" value="<?php if(isset($_POST['cpf'])){echo $_POST['cpf'];} ?>">
<input name="sexo" type="hidden" value="<?php if(isset($_POST['cpf'])){echo $_POST['sexo'];} ?>">
<input name="data_nascimento" type="hidden" value="<?php if(isset($_POST['cpf'])){echo $_POST['data_nascimento'];} ?>">
<input name="telefone" type="hidden" value="<?php if(isset($_POST['endereco'])){echo $tellimpo;} ?>"> 
<input name="celular" type="hidden" value="<?php if(isset($_POST['endereco'])){echo $cellimpo;} ?>"> 
<input name="endereco" type="hidden" value="<?php if(isset($_POST['endereco'])){echo $_POST['endereco'] . ',' .$_POST['numero'];} ?>">
<input name="complemento" type="hidden" value="<?php if(isset($_POST['complemento'])){echo $_POST['complemento'];} ?>">
<input name="bairro" type="hidden" value="<?php if(isset($_POST['bairro'])){echo $_POST['bairro'];} ?>">
<input name="cidade" type="hidden" value="<?php if(isset($_POST['cidade'])){echo $_POST['cidade'];} ?>">
<input name="estado" type="hidden" value="<?php if(isset($_POST['estado'])){echo $_POST['estado'];} ?>">
<input name="cep" type="hidden" value="<?php if(isset($_POST['cep'])){echo $_POST['cep'];} ?>">
<input name="free" type="hidden" value="">
<input name="url_retorno" type="hidden" value="https://www.herancacamp.com.br/retorno.php">
<input name="url_aviso" type="hidden" value="https://www.herancacamp.com.br/aviso.php">
<input name="parcela_maxima" type="hidden" value="12">
<input name="meio_pagamento" type="hidden" value="1">
<input name="frete" type="hidden" value="0">
<input type="image" src="https://a248.e.akamai.net/f/248/96284/12h/www.bcash.com.br/webroot/img/bt_comprar.gif" value="Comprar" alt="Comprar" border="0" align="absbottom" >

</form>
</div>
</div>

<!-- INICIO FORMULARIO BOTAO PAGSEGURO -->
<form target="pagseguro" action="https://pagseguro.uol.com.br/checkout/v2/cart.html?action=add" method="post">
<!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
<input type="hidden" name="itemCode" value="1D92D4741212FCF444F0AFAB9F08D92C" />
<input type="image" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/pagamentos/84x35-pagar.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
</form>
<!-- FINAL FORMULARIO BOTAO PAGSEGURO -->