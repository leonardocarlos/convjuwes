<?php
require_once '../admin/inc/config.php';

/*/* Formatação para número em reais com decimal 00
$number = "222934699";
echo "R$" .number_format($number, 2, ',', '.');
// resultado R$222.934.699,00 */

$inscritosQuery = consultaDados("
        select 
        e.id,
        e.valor_deposito,
        e.valor_cartao,
        e.ativo,
        i.id,
        i.id_evento,
        i.quantidade,
        i.tipo_pagamento,
        i.pagto_confirma
    FROM
        evento e,
        inscricoes i
    where
        i.id_evento = e.id and
        e.ativo = '1'
        ");
$participantesQuery = consultaDados("select * from participantes order by nome ASC");
$pagtoQuery = consultaDados("select * FROM participantes where confirma_pagto = '2' order by nome ASC");
$pagto1Query = consultaDados("select * FROM participantes where confirma_pagto = '1' order by nome ASC");
$eventoQuery = consultaDados("
        select 
        e.id,
        e.valor_deposito,
        e.valor_cartao,
        e.ativo,
        i.id,
        i.id_evento,
        i.quantidade,
        i.tipo_pagamento,
        i.pagto_confirma
    FROM
        evento e,
        inscricoes i
    where
        i.id_evento = e.id and
        e.ativo = '1'
        ");

    // Conta quanto registro tem na tabela
    $totalinscitos = mysql_num_rows($participantesQuery);
    $totalpago = mysql_num_rows($pagtoQuery);
    $totalnaopago = mysql_num_rows($pagto1Query);

    $valor = 68.00;
    $resultadovalorpago = $valor * $totalpago;
    $resultadovalornaopago = $valor * $totalnaopago
?>
<div class="well well-small">
<div class="row-fluid">
    <h3>Relatório Estatístico</h3>
    Total de Inscritos: <?php //echo $total; ?> <br>
    Total de Inscritos Pagos: <?php //echo $totalpago; ?><br>
    Total de Inscritos Não Pagos: <?php //echo $totalnaopago; ?><br>

    Valor Pago: R$ <?php //echo number_format($resultadovalorpago, 2, ',', '.'); ?><br>
    Valor Restante R$: <?php //echo number_format($resultadovalornaopago, 2, ',', '.') ; ?> <br>
</div>
</div>