<script type="text/javascript">
    $(document).ready(function(){
    $("input[name=consulta]").bind('input',function(){
        var consulta = $(this).val();
        var conta = $(this).val().length;
        
        if(conta>=1){
            $.post('consultausuario.php',{consulta_post:consulta}, function(retorna){
               $("#results").html(retorna) ;
            });
        }else{
            $("#results").html('Pesquise Algo!');
        }
    });
    
    $("#pesquisa").submit(function(){
        var consulta = $("input[name=consulta]").val();
        
        if(consulta == ''){
            $("#results").html('Pesquise Algo!');
        }else{
            $.post('consultausuario.php',{consulta_post:consulta}, function(retorna){
               $("#results").html(retorna) ;
            });            
        }
        return false;
    });
});
</script>
<?php

require_once '../classes/funcoes.php';

$nivel_necessario = 1;

//Verifica se não ha a vaiável da sessão qeu identifica o usuário
if($_SESSION['SSnivel']!= $nivel_necessario){
    
    echo "<div class='well well-small'><h2>Você não tem permissão para acessar esta página</h2></div>";
    //Redireciona devolta pro logn
//    header('Location:'.URL_BASE.'admin/index.php'); exit;
}else{

// Se houve busca, continue o script:    

?>
<div class="well well-small">
    <h3>Buscar Usuário</h3>
<div class="controls-row">
    <div class="span8">
        <form class="form-search" method="post" enctype="multpart/form-data">
         <div class="input-append">
            <input type="text" class="span3 search-query" name="consulta" id="pesquisa">
            <button type="submit" class="btn">Busca</button>
          </div>  
        </form> 
    </div>
</div>    
    <hr>
<div class="controls-row">      
    <div id="results">

    </div>
</div>
 
<?php } ?>    