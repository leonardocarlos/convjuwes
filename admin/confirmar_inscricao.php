<?php

require_once '../classes/funcoes.php';

if(isset($_POST['buscar'])){
  
$id_evento = $_POST['evento'];

if($_POST['tipo_pagamento'] == '') $inscritoQuery = consultaDados("select 
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
        i.tipo_pagamento = '{$_POST['tipo_pagamento']}' and       
        i.id_evento = '$id_evento' and
        e.ativo = 1
    order by
        u.nome            
    ");
}

?>
