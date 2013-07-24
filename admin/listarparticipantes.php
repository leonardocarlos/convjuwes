<?php 
require_once '../classes/funcoes.php';

$nivel_necessario = 1;

//Verifica se não ha a vaiável da sessão qeu identifica o usuário
if($_SESSION['SSnivel']!= $nivel_necessario){
    
    echo "<div class='well well-small'><h2>Você não tem permissão para acessar esta página</h2></div>";
    //Redireciona devolta pro logn
//    header('Location:'.URL_BASE.'admin/index.php'); exit;
}else{
   
   //Incluir a classe excelwriter
   include("../admin/inc/excelwriter.inc.php");

   //Você pode colocar aqui o nome do arquivo que você deseja salvar.
    $excel=new ExcelWriter("listagem_geral.xls");

    if($excel==false){
        echo $excel->error;
   }
/*   
      //Escreve o nome dos campos de uma tabela
   $myArr=array('NOME','CPF','DATA DE NASCIMENTO','SEXO','EMAIL','IGREJA','DISTRITO','TELEFONE','AREA DE ATUAÇÃO','FÓRUM','FORMA DE PAGTO');
   $excel->writeLine($myArr);
   
*/
$totalQuery = consultaDados("select * from inscritos");

// defina o número de registros exibidos por página
$limite = 50;

// descubra o número da página que será exibida
// se o numero da página não for informado, definir como 1
if (!isset($_GET["pagina"])) {
$pagina = 1;
}
else {
$pagina = $_GET["pagina"];

}
// construa uma cláusula SQL "SELECT" que nos retorne somente os registros desejados
// definir o número do primeiro registro da página.
// Faça a continha na calculadora que você entenderá minha fórmula
$inicio = $pagina * $limite - $limite;

$participantesQuery = consultaDados("select * from inscritos order by nome asc limit $inicio, $limite");
        
    if(isset($_GET['acao'])){
        $id = htmlspecialchars($_GET['id'], ENT_QUOTES);
    if($_GET['acao'] == 'excluir'){
        consultaDados("delete from inscritos where id = '$id'");
        $excluir = 'ok';
    }
    }    
    
    // Conta quanto registro tem na tabela
    $total = mysql_num_rows($totalQuery);
    // construa e exiba um painel de navegabilidade entre as páginas

    $totalPaginas = ceil(mysql_num_rows($totalQuery)/$limite);

    $anterior = $pagina - 1;
    $proximo = $pagina + 1;


    // se página maior que 1 (um), então temos link para a página anterior
    if ($pagina > 1) {
        $prev_link = "<a href=" .$_SERVER['PHP_SELF']."?p=listarparticipantes&pagina=$anterior>Anterior</a>";
      } else { // senão não há link para a página anterior
        $prev_link = "Anterior";
      }
    // se número total de páginas for maior que a página corrente, 
    // então temos link para a próxima página
    if ($totalPaginas > $pagina) {
        $next_link = "<a href=" .$_SERVER['PHP_SELF']."?p=listarparticipantes&pagina=$proximo>Próxima</a>";
      } else { 
    // senão não há link para a próxima página
        $next_link = "Próxima";
      }    
?>

<script type="text/javascript">
    function excluir(id){
        if(confirm("Você tem certeza que deseja EXCLUIR o participante?") == true){
          window.location = '?p=listarparticipantes&acao=excluir&id=' + id;          
        }
    }
</script>
<div class="well well-small">
    <h3>Participantes</h3>
<div class="row-fluid">
<div class="span4">
    <section>
        <strong>Total de Participantes:</strong> <?php echo $total; ?> Inscritos <br><br>
        <?php echo "$prev_link | $next_link"; ?>
    </section> <br />    
</div>
    <div class="span4 pull-right">
 <?PHP   //  $excel->close();
  //  echo "<a href=\"listagem_geral.xls\" class=\"btn btn-primary\" target=\"_blank\">Baixar Planilha</a>";
?>
 <input type="button" value="Imprimir Relatório" onclick="window.print()" class="btn btn-primary"/>
</div>
</div> 
<div class="row-fluid">
<div class="span12">
 <table class="table table-striped table-condensed" width="">
     <thead>
     <tr>
         <th width="40%">Participantes</th>
         <th width="25%">Email</th>
         <th width="15%">Editar/Deletar</th>
     </tr>
     </thead>
     <tbody>
     <?php while($participante = mysql_fetch_array($participantesQuery)) {  ?>
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
<?php echo "$prev_link | $next_link"; ?>

</div>
    <div class="span4 pull-right">
 <?PHP   //  $excel->close();
  //  echo "<a href=\"listagem_geral.xls\" class=\"btn btn-primary\" target=\"_blank\">Baixar Planilha</a>";
?>
 <input type="button" value="Imprimir Relatório" onclick="window.print()" class="btn btn-primary"/>
</div>
</div>
</div>
<?php } ?>