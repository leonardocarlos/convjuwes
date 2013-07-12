<?php 
$id = $_SESSION['SSusuario_id'];

$inscricaoQuery = consultaDados("select 
        i.*,
        u.*
    from 
        inscricoes i,
        inscritos u
    where
        i.id_inscrito = u.id and       
        u.id = $id
    ");
/*
    if(isset($_GET['acao'])){
        $id = htmlspecialchars($_GET['id'], ENT_QUOTES);
    if($_GET['acao'] == 'excluir'){
        consultaDados("delete from evento where id = '$id'");
        $excluir = 'ok';
    }
    }
*/
    $totalQuery = consultaDados("select * FROM evento" ); // Seleciona toda Tabela
    // Conta quanto registro tem na tabela
    $total = mysql_num_rows($inscricaoQuery);
?>

<script type="text/javascript">
    function excluir(id){
        if(confirm("Você tem certeza que deseja EXCLUIR o evento?") == true){
          window.location = '?p=editevento&acao=excluir&id=' + id;
        }
    }
</script>
<div class="row-fluid well well-small">
<article>
    <h3>Eventos</h3>
    <br />
    <section>
        <strong>Total de Evento:</strong> <?php echo $total; ?> Evento
    </section> <br />
 <table class="table table-striped">
     <thead>
     <tr>
         <th width="40%">Evento</th>
         <th width="25%">Data</th>
         <th width="25%">Ativo</th>
         <th width="20%">Editar/Deletar</th>
     </tr>
     </thead>
     <tbody>
     <?php while($inscricao = mysql_fetch_array($inscricaoQuery)) {  ?>
     <tr>
     <th><?php echo $inscricao['nome_evento'];?></th>
     <th class="text-left"><?php //echo $evento['data_inicio'] .' - '. $evento['data_fim'];?>
     </th>
     <th><?php if($inscricao['tipo_pagamento'] == 1){echo "<span class='verde-negrito'>Sim</span>";}else{echo "<span class='vermelho-negrito'>Não</span>";};?></th>
     <th>
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="get">
        <a class="btn btn-small btn-success" href="?p=editevento&acao=editar&id=<?php echo $inscricao['id']; ?>" title="Clique para Editar"><i class="icon-edit icon-white"></i></a>
<!--       <a class="btn btn-small btn-success" href="javascript:func()" onclick="excluir('<?php //echo $inscricao['id']; ?>')" onclick="excluir" title="Clique para Excluir"><i class="icon-remove icon-white"></i></a>-->
            <?php echo '<input type="hidden" name="id" value="' . $inscricao['id'] . '" formmethod="get" />'; ?>
        <input type="hidden" name="acao" value="<?php echo $inscricao['id']; ?>" formmethod="get"/>
        <input type="hidden" name="acao" value="editar"/>
        </form>
     </th>
     </tr>

     <?php } ?>
     </tbody>
 </table>
</article>
<br />
<div class="span4 pull-right">
 <input type="button" value="Imprimir Relatório" onclick="window.print()" class="btn btn-primary"/>
</div>

</div>
<?php //} ?>