<?php


require_once '../classes/funcoes.php';

$nivel_necessario = 1;

//Verifica se não ha a vaiável da sessão qeu identifica o usuário
if($_SESSION['SSnivel']!= $nivel_necessario){
    
    echo "<div class='well well-small'><h2>Você não tem permissão para acessar esta página</h2></div>";
    //Redireciona devolta pro logn
//    header('Location:'.URL_BASE.'admin/index.php'); exit;
}else{
$sucesso = false;

$eventoQuery = consultaDados("select * from evento order by data_inicio ASC");


?>
<div class="well well-small">
    <h3>Confirmar Pagamento</h3>
 
 <form action="?p=confirma_pagamento" method="post" class="form-search">    
<div class="controls-row">      
    <div class="span5">  
        <label>Selecione O Evento</label>
        <select name="evento" id="" class="span5"> 
<?php while($evento = mysql_fetch_array($eventoQuery)) {  ?>            
        <option value="<?php echo $evento['id'];?>"><?php echo $evento['nome_evento'];?></option>
  <?php } ?>       
        </select>
    </div>	
</div>	
<div class="controls-row">      
    <div class="span2">
        <label>Tipo de Pagamento</label>
        <select name="tipo_pagamento" id="tipo_pagamento" class="span2">
            <option value="">Todos</option>
            <option value="Deposito">Depósito</option>
            <option value="PagSeguro">PagSeguro</option>
        </select>  
    </div>    
</div>
     <br>
<div class="controls-row">  
    <div class="span2">
         <button type="submit" class="btn btn-primary" name="buscar" formmethod="post">OK</button>
    </div>	   
 </div>	   
 </form>
    
</div> 
  <?php } ?> 