<?php 
$id = $_SESSION['SSusuario_id'];
/*
$inscricaoQuery = consultaDados("select 
        inscricoes.*,
        evento.nome_evento,
        inscritos.id
    from 
        inscricoes
    INNER JOIN
        inscritos
    ON
        inscricoes.id_inscrito = inscritos.id
    and       
        inscricoes.id_inscrito = '{$_SESSION['SSusuario_id']}'
    ");*/
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
 * 
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
    </section> <br /><?php //echo $_SESSION['SSusuario_id']; ?>
 <table class="table table-striped">
     <thead>
     <tr>
         <th width="40%">Evento</th>
         <th width="5%">Quantidade</th>
         <th width="10%">Valor</th>
         <th width="10%">Valor C/ Desc.</th>
         <th width="5%">Pago</th>
         <th width="5%">Alterar</th>
         <th width="20%">Efetue Pagamento</th>
     </tr>
     </thead>
     <tbody>
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
         
         
         
         <?php echo $inscricao['codigo_evento'] ;?>
     <tr>
     <th><?php echo $inscricao['nome_evento'];?></th>
     <th class="text-left"> <?php echo $inscricao['quantidade'];?>
     <th class="text-left">R$ <?php  $resultado = $inscricao['valor']*$inscricao['quantidade']; echo number_format($resultado,2,",",".");?>
     <th class="text-left">R$ <?php echo number_format($valordesconto,2,",",".");?>
     </th>
     <th><?php if($inscricao['tipo_pagamento'] == 1){echo "<span class='verde-negrito'>Sim</span>";}else{echo "<span class='vermelho-negrito'>Não</span>";};?></th>
     <th class="text-left">
 <!--       <form action="<?php //echo $_SERVER['REQUEST_URI']; ?>" method="get">
          <a class="btn btn-small btn-success" href="?p=editevento&acao=editar&id=<?php //echo $inscricao['id']; ?>" title="Clique para Editar"><i class="icon-edit icon-white"></i></a>
            <?php //echo '<input type="hidden" name="id" value="' . $inscricao['id'] . '" formmethod="get" />'; ?>
        <input type="hidden" name="acao" value="<?php //echo $inscricao['id']; ?>" formmethod="get"/>
        <input type="hidden" name="acao" value="editar"/>
        </form>  -->              
     <th>
        <a class="btn btn-small btn-success" href="?p=efetua_pagamento" title="Clique para Efetuar o Pagamento"><i class="icon-shopping-cart icon-white"></i> PagSeguro</a>
        <a class="btn btn-small btn-success" href="?p=envia_comprovante" title="Clique para Enviar Comprovante"><i class="icon-shopping-cart icon-white"></i> Depósito</a>
<!--       <a class="btn btn-small btn-success" href="javascript:func()" onclick="excluir('<?php //echo $inscricao['id']; ?>')" onclick="excluir" title="Clique para Excluir"><i class="icon-remove icon-white"></i></a>-->
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