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

//$inscricaoQuery = consultaDados("select DISTINCT * from inscricao order by data_inicio ASC");
/*
if(isset($_POST['buscar'])){
  
$id_evento = $_POST['evento'];
    
$inscritoQuery = consultaDados("select 
        i.*,
        e.*,
        u.*
    from 
        inscricoes i,
        evento e,
        inscritos u
    WHERE
        i.id_evento = e.id and
        i.id_inscrito = u.id 
    and       
        e.id = '$id_evento'
    ");

$sucesso = true;       
     
}  */
?>
<div class="well well-small">
    <h3>Listar Inscritos</h3>
 
 <form action="?p=listar_inscrito_evento" method="post" class="form-search">    
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
</div><!--
<div class="controls-row">      
    <div class="span2">
        <label>Pagamento Confirmado</label>
        <select name="pagto_confirma" id="tipo_pagamento" class="span1">
            <option value="">Todos</option>
            <option value="1">Sim</option>
            <option value="0">Não</option>
        </select>  
    </div>    
</div>     -->
     <br>
<div class="controls-row">  
    <div class="span2">
         <button type="submit" class="btn btn-primary" name="buscar" formmethod="post">OK</button>
    </div>	   
 </div>	   
 </form>
    
</div> 
  <?php } ?> 