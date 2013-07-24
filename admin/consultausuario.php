<?php

require_once '../classes/funcoes.php';

$word = $_POST['consulta_post'];
$getResults = consultaDados("select * FROM inscritos WHERE nome LIKE '$word%'");

if(@mysql_num_rows($getResults) <= 0){
    echo 'Nada Encontrado';
}else{
    $total = mysql_num_rows($getResults);
    
    //while($res = fetch($getResults)){
      //  echo $res['nome'].'<br/>';
?>


<script type="text/javascript">
    function excluir(id){
        if(confirm("Você tem certeza que deseja EXCLUIR o participante?") == true){
          window.location = '?p=listarparticipantes&acao=excluir&id=' + id;          
        }
    }
</script>
<div class="span4">
    <section>
        <strong>Total:</strong> <?php echo $total; ?> Usuários<br><br>
        <?php //echo "$prev_link | $next_link"; ?>
    </section> <br />    
</div> 
<div class="row-fluid">
<div class="span12">
 <table class="table table-striped table-condensed" width="">
     <thead>
     <tr>
         <th width="60%">Participantes</th>
         <th width="25%">Email</th>
         <th width="15%">Editar/Deletar</th>
     </tr>
     </thead>
     <tbody>
     <?php while($participante = mysql_fetch_array($getResults)) {  ?>
     <tr>        
     <th><?php echo $participante['nome'];?></th>
     <th class="text-left"><?php echo $participante['email'];?></th>
    <th>
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="get">
        <a class="btn btn-small btn-success" href="?p=editusuario&acao=editar&id=<?php echo $participante['id']; ?>" title="Clique para Editar"><i class="icon-edit icon-white"></i></a>
       <a class="btn btn-small btn-success" href="javascript:func()" onclick="excluir('<?php echo $participante['id']; ?>')" onclick="excluir" title="Clique para Excluir"><i class="icon-remove icon-white"></i></a>      
            <?php echo '<input type="hidden" name="id" value="' . $participante['id'] . '" formmethod="get" />'; ?>
        <input type="hidden" name="acao" value="<?php echo $participante['id']; ?>" formmethod="get"/>
        <input type="hidden" name="acao" value="editar"/>
        </form>
     </th>     
     </tr>
     
    
     <?php } ?>
     </tbody>
 </table>
</div>
</div>            
<div class="row-fluid">
<div class="span4">
<?php //echo "$prev_link | $next_link"; ?>

</div>
    <div class="span4 pull-right">
 <?PHP   //  $excel->close();
   // echo "<a href=\"listagem_geral.xls\" class=\"btn btn-primary\" target=\"_blank\">Baixar Planilha</a>";
?>
 <input type="button" value="Imprimir Relatório" onclick="window.print()" class="btn btn-primary"/>
</div>
<?php }  ?>