<?php 
ini_set( 'default_charset', 'utf-8');
include 'classes/funcoes.php';


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

    <meta name="description" content="Comunicação Social nas Igrejas ">
    <meta name="keywords" content="Estratégias, Endomarketing, Marketing Digital, Debates, Redes Sociais, twitter, facebook">
    <meta name="author" content="Léo Artes - Comunicação & Web">
    <meta name="generator" content="HTML5">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Google Chrome Frame for IE -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>2ª Convenção Regional da Juventude Wesleyana - 6ª Região</title>
<link href="<?php echo URL_BASE ;?>css/estilos.css" rel="stylesheet" type="text/css" media="all">
<!-- Bootstrap -->
<link href="<?php echo URL_BASE ;?>bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo URL_BASE ;?>bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
<link href="<?php echo URL_BASE ;?>css/overcast/jquery-ui-1.10.1.custom.css" rel="stylesheet" type="text/css">

<?php include 'js/scripts.php';?>

<!-- Favicon: Browser + iPhone Webclip -->
<link rel="shortcut icon" href="<?php echo URL_BASE ;?>imagens/favicon.ico" />
<link rel="apple-touch-icon" href="<?php echo URL_BASE ;?>imagens/iphone.png" />
</head>

<body>
<div id="wrap">
<div class="container">
    <div class="row-fluid">

        <?php include 'menu.php'; ?>

    <header>
<div class="row-fluid">
  <h1 class="text-center">2ª Convenção Regional da Juventude Wesleyana - 6ª Região</h1><br>
    	<div class="span8 text-center">
        <img src="imagens/logo.png" alt="Adorador por Excelencia">
      </div>
</div>
<div class="row-fluid">
        <div class="span7 text-center">
        <h3>Dias 02, 03 e 04 de Agosto de 2013</h3>
        <h4>Investimento</h4>
        <h4>R$ 180,00 - Parcelado em até 12 vezes</h4>
        <div class="btn-group">
        <a class="btn btn-inverse btn-large" data-toggle="modal" href="#myModal"><i class="icon-ok-sign"></i> Inscreva-se</a> 

<!-- INICIO FORMULARIO BOTAO PAGSEGURO --
<form target="pagseguro" action="https://pagseguro.uol.com.br/checkout/v2/cart.html?action=add" method="post">
<!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO --
<input type="hidden" name="itemCode" value="2AF6C1FBA5A5CACCC429EF825CDF234E" />
<input type="image" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/pagamentos/99x61-pagar-azul-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
</form>
<-- FINAL FORMULARIO BOTAO PAGSEGURO -->

      	</div>
        </div> <!-- span6 -->
</div>
        <hr>
        <div class="span11 alert alert-success text-center">
           <a href="?p=comochegar"><h3>LOCAL: Centro de Convenções João Wesley - <small>Avenida Venancia, 17 - Xerém - Duque de Caxias - RJ</small></h3></a>
        </div>
    </header> <!-- header -->

</div> <!-- row-fuid -->
<a name="inscreva"></a> <!-- Ancora -->
<hr>

<div class="row-fuid">

<?php
    if(isset($_GET['p']))
    {
        include ($_GET['p'] . ".php");

    }else{
        include 'home.php';
}
?>

</div><!-- #row-fuid -->

  <div class="row">
  	<div class="span12 text-center">  </div>
  </div>

</div> <!-- container -->

<div id="push"></div>
</div><!-- warp -->

<div id="footer">
<footer class="container">
  <hr>
<div class="span6">Todos os diretos reservados - <a href="<?php echo URL_BASE; ?>admin/" target="_blank">2013</a> | JUWES - 6ª Região</div>

<div class="span3 pull-right">
  <a href="http://www.imw6.com" target="_blank" title="6ª Região Eclesiástica"><img src="imagens/imw6.png" alt="6ª Região Eclesiástica"></a>
<a href="http://www.leoartes.com.br" target="_blank" title="Léo Artes - Comunicação & Web"><img src="imagens/logo_leo.png" alt="Léo Artes - Comunicação &amp; Web"></a> </div>

</footer>
</div> <!-- #footer -->

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1&appId=449153191809048";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
</div>
</body>
</html>