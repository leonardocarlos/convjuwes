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
        i.id_inscrito = u.id and
        i.pagto_confirma <= '0'
    and       
        i.id_inscrito = '{$_SESSION['SSusuario_id']}'
    ");

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
<div class="well well-small">

    <h3>Eventos</h3>
    <div class="row-fluid">
    <br />
        <section>
            <strong>Total de Evento:</strong> <?php echo $total; ?> Evento 
        </section> <br /><?php //echo $_SESSION['SSusuario_id']; ?>
    </div>
 <table class="table table-striped">
     <thead>
     <tr>
         <th width="40%">Evento</th>
         <th width="5%">Quant.</th>
         <th width="10%">Valor</th>
         <th width="10%">Valor C/ Desc.</th>
         <th width="5%">Pago</th>
         <th width="10%">Confirmar Inscrição</th>
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

     <tr>
     <th><?php echo $inscricao['nome_evento'];?></th>
     <th class="text-left"> <?php echo $inscricao['quantidade'];?>
     <th class="text-left">R$ <?php  $resultado = $inscricao['valor']*$inscricao['quantidade']; echo number_format($resultado,2,",",".");?>
     <th class="text-left">R$ <?php echo number_format($valordesconto,2,",",".");?>
     </th>
     <th><?php if($inscricao['tipo_pagamento'] == 1){echo "<span class='verde-negrito'>Sim</span>";}else{echo "<span class='vermelho-negrito'>Não</span>";};?></th>
     <th class="text-left">
        <a class="btn btn-small btn-success" href="?p=envia_comprovante" title="Clique para Enviar Comprovante"><i class="icon-shopping-cart icon-white"></i> Confirmar</a>
         
 <!--       <form action="<?php //echo $_SERVER['REQUEST_URI']; ?>" method="get">
          <a class="btn btn-small btn-success" href="?p=editevento&acao=editar&id=<?php //echo $inscricao['id']; ?>" title="Clique para Editar"><i class="icon-edit icon-white"></i></a>
            <?php //echo '<input type="hidden" name="id" value="' . $inscricao['id'] . '" formmethod="get" />'; ?>
        <input type="hidden" name="acao" value="<?php //echo $inscricao['id']; ?>" formmethod="get"/>
        <input type="hidden" name="acao" value="editar"/>
        </form>  -->              
     </tr>

     <?php } ?>
     </tbody>
 </table>
</div>
<?php //} ?>