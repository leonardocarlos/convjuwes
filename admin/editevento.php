<?php
$nivel_necessario = 1;

      $valores_status['Desativado'] = 2;
      $valores_status['Ativo'] = 1;
      
//Verifica se não ha a vaiável da sessão qeu identifica o usuário
if($_SESSION['SSnivel']!= $nivel_necessario){
    
    echo "<div class='well well-small'><h2>Você não tem permissão para acessar esta página</h2></div>";
    //Redireciona devolta pro logn
//    header('Location:'.URL_BASE.'admin/index.php'); exit;
}else{
$id = $_GET['id'];

$eventoQuery = consultaDados("select * FROM evento where id = $id");

if(isset($_POST['editar'])){
    //$id = htmlspecialchars($_GET['id'], ENT_QUOTES);
        if(strlen($_POST['nome_evento']) <2){
    $mensagem .= "
		<div class='alert alert-error'>
         <a class='close' data-dismiss='alert' href='#'>x</a>Nome do Evento Obrigatório!
         </div>
	";
    }
    
    foreach ($_POST as $campo => $valor) {
        $form[$campo] = htmlspecialchars($_POST[$campo], ENT_QUOTES);
    }
    consultaDados("update evento set
        codigo_evento = '{$form['codigo_evento']}',
        nome_evento = '{$form['nome_evento']}',
        local = '{$form['local']}',
        data_inicio = '{$form['data_inicio']}',
        data_fim = '{$form['data_fim']}',
        valor_deposito = '{$form['valor_deposito']}',
        valor_cartao = '{$form['valor_cartao']}',
        codigo1 = '{$form['codigo1']}',
        desconto1 = '{$form['desconto1']}',
        codigo2 = '{$form['codigo2']}',
        desconto2 = '{$form['desconto2']}',
        codigo3 = '{$form['codigo3']}',
        desconto3 = '{$form['desconto3']}',
        ativo = '{$form['ativo']}'
      where 
      id = $id
     ");
    //$mensagem = 'Dados Atualizados com sucesso!';
echo "<script>
        alert('Dados Atualizado com Sucesso!');
        window.location.href ='" . URL_BASE . "admin/index2.php?p=listarevento';
        </script>"; 


/*       $mensagem = "<div class='alert alert-error'>
         <a class='close' data-dismiss='alert' href='#'>x</a>Evento cadastrado com sucesso!
         </div>"; */
}


?>
<div class="well well-small">
	<h3>Cadastre seu Evento</h3>
    <hr>
           <?php if(!empty($mensagem)){ echo $mensagem; }  ?>

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">

<?php while($evento = mysql_fetch_array($eventoQuery)) {?>    

    <fieldset>
<div class="controls-row">
    <div class="span5">
        <label>Codigo Evento:</label>
        <input type="text" name="codigo_evento" required class="span2" value="<?php echo $evento['codigo_evento'] ;?>"/> <small> Máximo 10 caracteres</small>
    </div>
</div>  <!-- controls-row -->  
<div class="controls-row">
    <div class="span6">
        <label>Nome Evento:</label>
        <input type="text" name="nome_evento" required class="span6" value="<?php echo $evento['nome_evento'] ;?>"/>
    </div>
</div>  <!-- controls-row -->
<div class="controls-row">
    <div class="span6">
        <label>Local:</label>
        <input type="text" name="local" required class="span6" value="<?php echo $evento['local'] ;?>"/>
    </div>
</div>  <!-- controls-row -->
<div class="controls-row">
    <div class="span2">
    <label>Data Início:</label>
    <input type="text" name="data_inicio" required  class="span2" value="<?php echo $evento['data_inicio'] ;?>" id="datepicker"/>
    </div>
    <div class="span2">
    <label>Data Fim:</label>
    <input type="text" name="data_fim" required  class="span2" value="<?php echo $evento['data_fim'] ;?>" id="datepicker1"/>
    </div>
</div> <!-- controls-row -->

<div class="controls-row">
	<div class="span2">
    	<label>Valor Depósito:</label>
    	<input type="text" name="valor_deposito" class="span2 dinheiro" required id="" value="<?php echo $evento['valor_deposito'] ;?>"> <small>Somente número</small>
    </div>
    <div class="span2">
        <label>Valor Cartão:</label>
        <input type="text" name="valor_cartao" class="span2 dinheiro" required id="" value="<?php echo $evento['valor_cartao'] ;?>"><small>Somente número</small>
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
        <input type="text" name="codigo1" class="span1"  id="" value="<?php echo $evento['codigo1'] ;?>">
    </div> 
    <div class="span1">
        <label>Valor 1:</label>        
    	<input type="text" name="desconto1" class="span1 dinheiro"  id="" value="<?php echo $evento['desconto1'] ;?>">
    </div>
</div><!-- controls-row -->
<div class="controls-row">    
    <div class="span1">
        <label>Código 2:</label>
        <input type="text" name="codigo2" class="span1"  id="" value="<?php echo $evento['codigo2'] ;?>"> 
    </div> 
    <div class="span1">
        <label>Valor 2:</label>        
        <input type="text" name="desconto2" class="span1 dinheiro"  id="" value="<?php echo $evento['desconto2'] ;?>">
    </div>
</div><!-- controls-row -->
<div class="controls-row">    
    <div class="span1">
        <label>Código 3:</label>
        <input type="text" name="codigo3" class="span1"  id="" value="<?php echo $evento['codigo3'] ;?>">
    </div> 
    <div class="span1">
        <label>Valor 3:</label>
        <input type="text" name="desconto3" class="span1 dinheiro"  id="" value="<?php echo $evento['desconto3'] ;?>">
    </div>    
</div> <!-- controls-row -->


<div class="controls-row">
    <div class="span2">
    <label>Ativar:</label>
    <?php echo select('ativo',$valores_status,$valores_status);?>
    </div>
</div> <!-- controls-row -->

<div class="controls-row">
	<div class="span2">
<input type="submit" value="Enviar" class="btn btn-primary" name="editar" formmethod="post"/>
	</div>
</div>  <!-- controls-row -->
</fieldset>
<?php } ?>
</form>

</div>
<?php } ?>