<?php 

require_once '../classes/funcoes.php';

if(isset($_POST['buscar'])){
  
$id_evento = $_POST['evento'];

if($_POST['tipo_pagamento'] == ''){

    $inscritoQuery = consultaDados("select 
        i.*,
        e.*,
        u.*
    from 
        inscricoes i,
        evento e,
        inscritos u
    WHERE
        i.id_inscrito = u.id and
        i.id_evento = e.id and          
        i.id_evento = '$id_evento' and    
        e.ativo = 1
    order by
        u.nome            
    ");  
    
}else{
$inscritoQuery = consultaDados("select 
        i.*,
        e.*,
        u.*
    from 
        inscricoes i,
        evento e,
        inscritos u
    WHERE
        i.id_inscrito = u.id and
        i.id_evento = e.id and
        i.tipo_pagamento = '{$_POST['tipo_pagamento']}' 
    and       
        i.id_evento = '$id_evento' and
        e.ativo = 1
    order by
        u.nome            
    ");
}
    if(isset($_GET['acao'])){
        $id = htmlspecialchars($_GET['id'], ENT_QUOTES);
    if($_GET['acao'] == 'excluir'){
        consultaDados("delete from inscricoes where id_inscrito = '$id'");
        $excluir = 'ok';
    }  
    }
$total = mysql_num_rows($inscritoQuery);     
     
}     
?>

<script type="text/javascript">
    function excluir(id){
        if(confirm("Você tem certeza que deseja EXCLUIR o participante?") == true){
          window.location = '?p=listar_inscrito_evento&acao=excluir&id=' + id;          
        }
    }
</script>
<div class="well well-small">
    <h3>Participantes</h3>
<div class="row-fluid">
<div class="span4">
    <section>
        <strong>Total de Participantes:</strong> <?php echo $total; ?> Inscritos <br><br>
        <?php //echo "$prev_link | $next_link"; ?>
        <?php //print_r ($id_evento); ?> 
    </section> <br />    
</div>
    <div class="span4 pull-right">
 <?PHP    // $excel->close();
   // echo "<a href=\"listagem_geral.xls\" class=\"btn btn-primary\" target=\"_blank\">Baixar Planilha</a>";
?>
 <input type="button" value="Imprimir Relatório" onclick="window.print()" class="btn btn-primary"/>
</div>
</div> 
<div class="row-fluid">
<div class="span12">
 <table class="table table-striped table-condensed" width="">
     <thead>
     <tr>
         <th width="30%">Participantes</th>
         <th width="25%">Email</th>
         <th width="5%">Quant.</th>
         <th width="10%">Valor</th>
         <th width="10%">Forma de Pagamento</th>
         <th width="5%">Pagamento Confirmado</th>
         <th width="10%">Editar/Deletar</th>
     </tr>
     </thead>
     <tbody>
     <?php while($participante = mysql_fetch_array($inscritoQuery)) {  
         
         if($participante['codigo_desconto'] == $participante['codigo1']){
             //$percentual = $inscricao['desconto1'] / 100.0; // 15% 
             $valordesconto = $participante['valor']-$participante['desconto1'];
         }elseif($participante['codigo_desconto'] == $participante['codigo2']){
             $valordesconto = $participante['valor']-$participante['desconto2'];
         }elseif($participante['codigo_desconto'] == $participante['codigo3']){
                 $valordesconto = $participante['valor']-$participante['desconto3'];
         }else{
            $valordesconto = $participante['valor'] - 0;
         } 
         ?>
     <tr>        
     <th><?php echo $participante['nome'];?></th>
     <th class="text-left"><?php echo $participante['email'];?></th>
     
     <th class="text-left"><?php echo $participante['quantidade'];?></th>
     
     <th class="text-left">R$ <?php  $resultado = $valordesconto*$participante['quantidade']; echo number_format($resultado,2,",",".");?></th>
     
     <th class="text-left"><?php echo $participante['tipo_pagamento'];?></th>       
     
     <th><?php if($participante['pagto_confirma'] == 0){echo "<span class='verde-negrito'>Não</span>";}else{echo "<span class='vermelho-negrito'>Sim</span>";};?></th>
     
     <th>
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="get">
<!--        <a class="btn btn-small btn-success" href="?p=editusuario&acao=editar&id=<?php // echo $participante['id']; ?>" title="Clique para Editar"><i class="icon-edit icon-white"></i></a> -->
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
  //  echo "<a href=\"listagem_geral.xls\" class=\"btn btn-primary\" target=\"_blank\">Baixar Planilha</a>";
?>
 <input type="button" value="Imprimir Relatório" onclick="window.print()" class="btn btn-primary"/>
</div>
</div>
</div>
<?php //} ?>