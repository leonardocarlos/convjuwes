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
$eventoQuery = consultaDados("select * from evento order by data_inicio ASC");

    if(isset($_GET['acao'])){
        $id = htmlspecialchars($_GET['id'], ENT_QUOTES);
    if($_GET['acao'] == 'excluir'){
        consultaDados("delete from evento where id = '$id'");
        $excluir = 'ok';
    }
    }

    $totalQuery = consultaDados("select * FROM evento" ); // Seleciona toda Tabela
    // Conta quanto registro tem na tabela
    $total = mysql_num_rows($totalQuery);
?>

<script type="text/javascript">
    function excluir(id){
        if(confirm("Você tem certeza que deseja EXCLUIR o evento?") == true){
          window.location = '?page=editevento&acao=excluir&id=' + id;
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
     <?php while($evento = mysql_fetch_array($eventoQuery)) {  ?>
     <tr>
     <th><?php echo $evento['nome_evento'];?></th>
     <th class="text-left"><?php echo $evento['data_inicio'] .' - '. $evento['data_fim'];?>
     </th>
     <th><?php if($evento['ativo'] == 1){echo "<span class='verde-negrito'>Sim</span>";}else{echo "<span class='vermelho-negrito'>Não</span>";};?></th>
     <th>
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="get">
        <a class="btn btn-small btn-success" href="?page=editevento&acao=editar&id=<?php echo $evento['id']; ?>" title="Clique para Editar"><i class="icon-edit icon-white"></i></a>
       <a class="btn btn-small btn-success" href="javascript:func()" onclick="excluir('<?php echo $evento['id']; ?>')" onclick="excluir" title="Clique para Excluir"><i class="icon-remove icon-white"></i></a>
            <?php echo '<input type="hidden" name="id" value="' . $evento['id'] . '" formmethod="get" />'; ?>
        <input type="hidden" name="acao" value="<?php echo $evento['id']; ?>" formmethod="get"/>
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
 <?PHP $excel->close();
    echo "<a href=\"listagem_geral.xls\" class=\"btn btn-primary \" target=\"_blank\">Baixar Planilha</a>";
?>
 <input type="button" value="Imprimir Relatório" onclick="window.print()" class="btn btn-primary"/>
</div>

</div>
<?php } ?>