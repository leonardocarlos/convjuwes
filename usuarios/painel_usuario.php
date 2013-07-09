<?php ini_set( 'default_charset', 'utf-8'); 
// A sessão precisa ser iniciada em cada página diferente
if(!isset($_SESSION)) session_start (); 

include '../classes/funcoes.php';
//include '../login_facebook.php';

// session_checker(); // chama a função que verifica se a session iniciada da acesso à página.
if(isset($_SESSION['SSusuario_id'])){
    $id = $_SESSION['SSusuario_id'];


if(isset($_POST['confirma'])){
    $id_transacao = $_POST['id_transacao'];

    if(empty($id_transacao)){
        $mensagem = "
    <div class='alert alert-error'>
         <a class='close' data-dismiss='alert' href='#'>x</a>O Campo ID TRANSAÇÃO é obrigatório!
         </div>";
}

 if(empty($mensagem)){
       insereDados("insert INTO participante(
    id_transacao
    ) values (
    '$id_transacao'
    )");
     }
   }
 ?>
<!doctype html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="pt-br"><![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="pt-br"><![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="pt-br"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="pt-br">
<!--<![endif]-->
<head>
<meta charset="utf-8">

    <meta name="description" content="Herança Camp - Retiro para músicos, ministros e pastores ">
    <meta name="keywords" content="música, palestras, show instrumental, ministros, pastores, eventos gospel, ministrações, herança, ministério herança,
    andré santos, rogério dy castro, felipe alves, johny mafra, serginho jarchelli, roque divino, angelo torres, Pr. Daniel Branco, Pr. Agnaldo Valadares,
    Benair Lemos, Ronald Fonseca, charles Miranda">
    <meta name="author" content="Léo Artes - Comunicação & Web">
    <meta name="generator" content="HTML5">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Google Chrome Frame for IE -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Juventude Wesleyana 6ª Região - Painel do Usuário</title>
<link href="<?php echo URL_BASE ;?>/css/estilos.css" rel="stylesheet" type="text/css" media="all">
<!-- Bootstrap -->
<link href="<?php echo URL_BASE ;?>bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo URL_BASE ;?>bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
<link href="<?php echo URL_BASE ;?>css/overcast/jquery-ui-1.10.1.custom.css" rel="stylesheet" type="text/css">

<?php include '../js/scripts.php';?>

<!-- Favicon: Browser + iPhone Webclip -->
<link rel="shortcut icon" href="<?php echo URL_BASE ;?>imagens/favicon.ico" />
<link rel="apple-touch-icon" href="<?php echo URL_BASE ;?>imagens/iphone.png" />

</head>

<body>
<div id="wrap">
<div class="container">
<?php include 'menu_principal.php'; ?>
<hr>

<div class="row-fuid">
    
<?php include 'menu_usuario.php'; ?>

    
<div class="row-fuid well well-small">
<?php
    if(isset($_GET['p']))
    {
        include ($_GET['p'] . ".php");

    }else{
        include 'perfil_usuario.php';
}
?>
</div> <!-- container -->

<div id="push"></div>
</div><!-- warp -->
<hr>
<div id="footer">
<footer class="container">
<div class="span6">Todos os diretos reservados | JUWES - 6ª Região</div>

<div class="span3 pull-right">
<a href="http://www.imw6.com" target="_blank" title="6ª Região Eclesiástica">
    <img src="<?php echo URL_BASE ;?>imagens/imw6.png" alt="6ª Região Eclesiástica"></a>    
<a href="http://www.leoartes.com.br" target="_blank" title="Léo Artes - Comunicação & Web">
    <img src="<?php echo URL_BASE ;?>imagens/logo_leo.png" alt="Léo Artes - Comunicação &amp; Web"></a>
</div>

</footer>
</div> <!-- #footer -->
<?php } ?>
</body>
</html>