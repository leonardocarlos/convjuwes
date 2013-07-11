<?php ini_set( 'default_charset', 'utf-8'); 
// A sessão precisa ser iniciada em cada página diferente
if(!isset($_SESSION)) session_start (); 

include '../classes/funcoes.php';

$nivel_necessario = 1;

//Verifica se não ha a vaiável da sessão qeu identifica o usuário
if(!isset($_SESSION['SSusuario_id']) or ($_SESSION['SSnivel']!= $nivel_necessario)){
    //Destrói a sessão por segurança
    session_destroy();
    
    echo "<script>
        alert('Você não tem permissão para acessar está Área!');
        window.location.href ='" . URL_BASE . "admin/index.php';
        </script>";
    
    //Redireciona devolta pro logn
    //header('Location:'.URL_BASE.'admin/index.php'); exit;
}

?>

<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Google Chrome Frame for IE -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Administração - Juventude Wesleyana 6ª Região</title>
<!-- Bootstrap -->
<link href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="../bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
<link href="bootstrap/estilo.css" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo URL_BASE ;?>css/overcast/jquery-ui-1.10.1.custom.css" rel="stylesheet" type="text/css">

<?php include '../js/scripts.php';?>
</head>

<body>
<div class="container">
  <nav>
        <div class="navbar nav">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="/">Adminstra&ccedil;&atilde;o</a>

                    <div class="nav-collapse collapse">
                      <ul class="nav">
                          <li class="divider-vertical"></li>
                          <li><a href="index2.php"><i class="icon-home icon-white"></i> In&iacute;cio</a></li>

                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="icon-user icon-white"></i> Usuários
                      <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
	               <li><a href="?p=../cadastro">Cadastrar Usário</a></li>
                       <li><a href="?p=listarparticipantes">Listar Usuário</a></li>
                       <li><a href="?p=buscausuario">Buscar Usuário</a></li>
                    </ul>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                     <i class="icon-shopping-cart icon-white"></i> Inscrições
                      <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                       <li><a href="#">Listar Inscritos</a></li>
                       <li><a href="#">Confirmar Pagamento</a></li>
                    </ul>
                  </li>                  
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                     <i class="icon-list-alt icon-white"></i> Relat&oacute;rios
                      <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                       <li><a href="#">Parcicipantes Pagos</a></li>
                       <li><a href="#">Formas de Pagamento</a></li>
                       <li><a href="#">Pagamentos confirmados</a></li>
                    </ul>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                     <i class="icon-map-marker icon-white"></i> Eventos
                      <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                       <li><a href="?p=cadevento">Cadastrar Evento</a></li>
                       <li><a href="?p=listarevento">Listar Evento</a></li>
                    </ul>
                  </li>
                      </ul>
                      <div class="pull-right">
                        <ul class="nav pull-right">
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Seja Bem-vindo,
                            <?php if(isset($_SESSION['SSnome'])) {?>
                             <?php echo $_SESSION['SSnome']; }?> <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/user/preferences"><i class="icon-cog"></i> Preferences</a></li>
                                    <li><a href="/help/support"><i class="icon-user"></i> Usu&aacute;rios</a></li>
                                    <li><a href="/help/support"><i class="icon-envelope"></i> Contactar o Suporte</a></li>
                                    <li class="divider"></li>
                                    <li><a href="logout.php"><i class="icon-off"></i> Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </nav> <!-- nav -->

<div class="row-fuid">

<?php
    if(isset($_GET['p']))
    {
        include ($_GET['p'] . ".php");

    }else{
        include 'principal.php';
}
?>

</div><!-- #container -->


</div> <!-- container-->
<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markermanager/src/markermanager.js"></script>
<script type="text/javascript">
var myLatlng = new google.maps.LatLng(-25.4283563, -49.2732515);
var myOptions = {
zoom: 18,
center: myLatlng,
mapTypeId: google.maps.MapTypeId.ROADMAP,
draggable: true,
mapTypeControl: false,
navigationControl : true
}
var address = <?php echo "'".$endereco."'"; ?>;
map = new google.maps.Map(document.getElementById("ResultDiv"), myOptions);
var addr = address+', Parana, Brasil';
var geocoder = new google.maps.Geocoder();
 
geocoder.geocode( { 'address': addr}, function(results, status) {
if (status == google.maps.GeocoderStatus.OK) {
map.setCenter(results[0].geometry.location);
var marker = new google.maps.Marker({
map: map,
position: results[0].geometry.location,
title: 'Wagner Pro'
});
 
} else {
alert('Geocode não funcionou corretamente : ' + status);
}
});
</script>
</body>
</html>