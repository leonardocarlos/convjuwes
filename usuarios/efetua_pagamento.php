<?php

$id = $_SESSION['SSusuario_id'];

$inscricaoQuery = consultaDados("select 
        i.*,
        e.*,
        u.id
    from 
        inscricoes i,
        evento e,
        inscritos u
    WHERE
        i.id_evento = e.id and
        i.id_inscrito = u.id 
    and       
        i.id_inscrito = '{$_SESSION['SSusuario_id']}'
    ");


/*  
          $_SESSION['SSusuario_id'] = $usuario['id'];
          $_SESSION['SSnome'] = $usuario['nome'];
          $_SESSION['SScpf'] = $usuario['cpf'];
          $_SESSION['SSdata_nasc'] = $usuario['data_nasc'];
          $_SESSION['SSsexo'] = $usuario['sexo'];
          $_SESSION['SStelefone'] = $usuario['telefone'];
          $_SESSION['SScelular'] = $usuario['celular'];
          $_SESSION['SScep'] = $usuario['cep'];
          $_SESSION['SSendereco'] = $usuario['endereco'];
          $_SESSION['SSnumero'] = $usuario['numero'];
          $_SESSION['SScomplemento'] = $usuario['complemento'];
          $_SESSION['SSbairro'] = $usuario['bairro'];
          $_SESSION['SScidade'] = $usuario['cidade'];
          $_SESSION['SSestado'] = $usuario['estado'];
          $_SESSION['SSarea_atuacao'] = $usuario['area_atuacao'];
          $_SESSION['SSigreja'] = $usuario['igreja'];
          $_SESSION['SSpastor'] = $usuario['pastor'];
          $_SESSION['SSemail'] = $usuario['email'];
          $_SESSION['SSsenha'] = $usuario['senha'];
        
    $nome = $_SESSION['SSnome'];
    $cpf = $_SESSION['SScpf'];
    $data_nascimento = $_SESSION['SSdata_nasc'];
    $sexo = $_SESSION['SSsexo'];
    $telefone = $_SESSION['SStelefone'];
    $celular = $_SESSION['SScelular'];
    $cep = $_SESSION['SScep'];	
    $endereco = $_SESSION['SSendereco'];
    $numero =  $_SESSION['SSnumero'];	
    $complemento = $_SESSION['SScomplemento'];		
    $bairro = $_SESSION['SSbairro'];		
    $cidade = $_SESSION['SScidade'];	
    $estado = $_SESSION['SSestado'];	
    $email = $_SESSION['SSemail'];
	*/

	$tellimpo = preg_replace("/[^a-zA-Z0-9]/", "", $_SESSION['SStelefone']);
	$cellimpo = preg_replace("/[^a-zA-Z0-9]/", "", $_SESSION['SScelular']);

?>
<div class="well well-small">   
<div class="row-fluid">
<!-- PAGAMENTO DO PAGSEGURO -->
<div class="row-fluid">
         <?php while($inscricao = mysql_fetch_array($inscricaoQuery)) { 
             
         if($inscricao['codigo_desconto'] == $inscricao['codigo1']){
             //$percentual = $inscricao['desconto1'] / 100.0; // 15% 
             $valordesconto = $inscricao['valor']-$inscricao['desconto1'];
         }elseif($inscricao['codigo_desconto'] == $inscricao['codigo2']){
             $valordesconto = $inscricao['valor']-$inscricao['desconto2'];
         }elseif($inscricao['codigo_desconto'] == $inscricao['codigo3']){
                 $valordesconto = $inscricao['valor']-$inscricao['desconto3'];
         }else{
             $valordesconto = $inscricao['valor'] - 0;
         } 
         
         ?>
    <?php echo $inscricao['codigo_evento'] ;?> - <?php echo number_format($valordesconto,2,",",".") ;?>
  <!-- Declaração do formulário -->
<form target="pagseguro" method="post"
action="https://pagseguro.uol.com.br/v2/checkout/payment.html">

    <!-- Campos obrigatórios -->
    <input type="hidden" name="receiverEmail" value="eventos@juventudewesleyana6.com.br">
    <input type="hidden" name="currency" value="BRL">

    <!-- Itens do pagamento (ao menos um item é obrigatório) -->
    <input type="hidden" name="itemId1" value="<?php echo $inscricao['codigo_evento'] ;?>">
    <input type="hidden" name="itemDescription1" value="<?php echo $inscricao['nome_evento'] ;?>">
    <input type="hidden" name="itemAmount1" value="<?php echo number_format($valordesconto,2,".","");?>">
    <input type="hidden" name="itemQuantity1" value="<?php echo $inscricao['quantidade'] ;?>">
    <input type="hidden" name="itemWeight1" value="1000">

    <!-- Código de referência do pagamento no seu sistema (opcional) -->
    <input type="hidden" name="reference" value="<?php echo $inscricao['codigo_evento'] ;?>">

    <!-- Informações de frete (opcionais)-->
    <input type="hidden" name="shippingType" value="3">
    <input type="hidden" name="shippingAddressPostalCode" value="<?php echo $_SESSION['SScep'] ;?>">
    <input type="hidden" name="shippingAddressStreet" value="<?php echo $_SESSION['SSendereco'] ;?>">
    <input type="hidden" name="shippingAddressNumber" value="<?php echo $_SESSION['SSnumero'] ;?>">
    <input type="hidden" name="shippingAddressComplement" value="<?php echo $_SESSION['SScomplemento'] ;?>">
    <input type="hidden" name="shippingAddressDistrict" value="<?php echo $_SESSION['SSbairro'] ;?>">
    <input type="hidden" name="shippingAddressCity" value="<?php echo $_SESSION['SScidade'] ;?>">
    <input type="hidden" name="shippingAddressState" value="<?php echo $_SESSION['SSestado'] ;?>">
    <input type="hidden" name="shippingAddressCountry" value="BRA">

    <!-- Dados do comprador (opcionais) -->
    <input type="hidden" name="senderName" value="<?php echo $_SESSION['SSnome'] ;?>">
    <input type="hidden" name="senderAreaCode" value="21">
    <input type="hidden" name="senderPhone" value="<?php echo $_SESSION['SStelefone'] ;?>">
    <input type="hidden" name="senderEmail" value="<?php echo $_SESSION['SSemail'] ;?>">

  <!-- submit do form (obrigatório) -->
<p>Clique no botão abaixo para escolher a forma de Pagamento</p>
<input type="submit" value="Efetue o pagamento" class="btn btn-primary" name="Comprar" formmethod="post"/>

</form>
    <?php } ?>
</div><!-- #container -->