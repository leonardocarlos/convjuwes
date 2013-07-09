<?php ini_set( 'default_charset', 'utf-8'); 
// A sessão precisa ser iniciada em cada página diferente
if(!isset($_SESSION)) session_start (); 

include 'classes/funcoes.php';

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
<title>Fórum de Marketing Evangélico</title>
<link href="css/estilos.css" rel="stylesheet" type="text/css" media="all">
<!-- Bootstrap -->
<link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
<link href="<?php echo URL_BASE ;?>css/overcast/jquery-ui-1.10.1.custom.css" rel="stylesheet" type="text/css">

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo URL_BASE ;?>js/jquery-ui-1.10.1.custom.js"></script>

<!-- Favicon: Browser + iPhone Webclip -->
<link rel="shortcut icon" href="<?php echo URL_BASE ;?>imagens/favicon.ico" />
<link rel="apple-touch-icon" href="<?php echo URL_BASE ;?>imagens/iphone.png" />

</head>

<body>
<div id="wrap">
<div class="container">
    <div class="row-fluid">
    <nav>
        <div class="navbar navbar-fixed-top">
          <div class="navbar-inner">
            <div class="container">

              <!-- .btn-navbar é usado como alternador para conteúdo de barra de navegação colapsável -->
              <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </a>

              <!-- Tenha certeza de deixar a marca se você quer que ela seja mostrada
              <a class="brand" href="#">Home</a> -->

              <!-- Tudo que você queira escondido em 940px ou menos, coloque aqui -->
              <div class="nav-collapse collapse">
                <!-- .nav, .navbar-search, .navbar-form, etc -->

                <ul class="nav">
                  <li class="active">
                    <a href="index.php">Home</a>
                  </li>
                  <li><a href="?p=sobre-o-evento">Sobre o Evento</a></li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      Programação
                      <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                       <li><a href="?p=palestrantes">Palestrantes</a></li>
                       <li><a href="?p=programacao">Agenda do Evento</a></li>
                    </ul>
                  </li>
                  <li><a href="?p=inscricoes">Inscrições</a></li>
                  <li><a data-toggle="modal" href="#myModal" >Login</a></li>
                  <li><a href="?p=contato">Contato</a></li>
                  <li><a href="?p=comochegar">Como Chegar</a></li>
                </ul>

              </div> <!-- nav-collapse collapse -->

            </div> <!-- container -->
          </div> <!-- navbar-inner -->
        </div> <!-- navbar -->
    </nav> <!-- nav -->

<div class="modal hide" id="myModal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">x</button>
    <h3>Area do Participante</h3>
  </div>
  <div class="modal-body ">
        <?php// if(!empty($mensagem)) {echo $mensagem; } ?>
        <form method="POST" action="login.php" accept-charset="UTF-8" >
          <div class="control-group">
            <label class="control-label" for="inputIcon">Email</label>
            <div class="controls">
              <div class="input-prepend"> <span class="add-on"><i class="icon-envelope"></i></span>
                <input class="span6" id="inputIcon" type="email" placeholder="Digite seu Email" name="email">
              </div>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputIcon">Senha</label>
            <div class="controls">
              <div class="input-prepend"> <span class="add-on"><i class="icon-asterisk"></i></span>
                <input class="span6" id="inputIcon" type="password" placeholder="senha" name="senha">
              </div>
            </div>
          </div>
      <p><button type="submit" class="btn btn-primary">Entrar</button>
          <input name="entrar" type="hidden" id="entrar">
        <a href="#">Esqueceu a Senha?</a>
      </p>
    </form>
  </div>
  <div class="modal-footer">
    Já fez sua inscrição?
    <a href="#" class="btn btn-primary">Inscrição</a>
  </div>
</div>

    <header>
    	<div class="span5"><img src="imagens/logo.png" alt="Logo Herança Camp"></div>
        <div class="span6 text-center">
                <h2>Comunicação Social nas Igrejas</h2>
        <p>Estratégias :: Endomarketing :: Marketing Digital :: Debates <br> Redes Sociais</p>
        </div> <!-- span6 -->
    </header> <!-- header -->

</div> <!-- row-fuid -->
<hr>

<div class="row-fuid">
    
  <nav>
        <div class="navbar nav">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="/">Painel Usuário</a>

                    <div class="nav-collapse collapse">
                      <ul class="nav">
                          
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="icon-user icon-white"></i> Dados
                      <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
	               <li><a href="?p=inscricoes">Perfil</a></li>
                       <li><a href="?p=listarparticipantes">Foto</a></li>
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

    
<div class="well well-small">
<h3>Area do Usuário</h3>

<div class="controls-row">
    <div class="span6">
        <label>Nome:</label>
        <input type="text" name="nome" disabled class="span6" value="<?php echo $_SESSION['SSnome'] ;?> "/>
    </div>
    <div class="span2">
        <label>CPF:</label>
        <input type="text" name="cpf" id="cpf" disabled class="span2" value="<?php echo $_SESSION['SScpf'] ;?> "/>
        <span class="help-block">Somente Números</span>
    </div>

</div>  <!-- controls-row -->

<div class="controls-row">
    <div class="span2">
    <label>Data Nascimento:</label>
    <input type="text" name="data_nascimento" disabled  class="span2" id="datepicker" value="<?php echo $_SESSION['SSdata_nascimento'] ;?>"/>
    </div>
    <div class="span2">
    <label>Sexo:</label>
    <select name="sexo" id="" class="span2" disabled>
            <option value="<?php echo $_SESSION['SSsexo'] ;?>" active><?php echo $_SESSION['SSsexo'] ;?></option>
            <option value="F">Feminino</option>
            <option value="M">Masculino</option>
        </select>
    </div>
    <div class="span2">
		<label>Telefone:</label>
        <input type="tel" name="telefone" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4}" class="span2" disabled placeholder="(xx) xxxx-xxxx" value="<?php echo $_SESSION['SStelefone'] ;?>"/>
    </div>
        <div class="span2">
		<label>Celular:</label>
        <input type="tel" name="celular" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4}" class="span2" disabled placeholder="(xx) xxxx-xxxx" value="<?php echo $_SESSION['SScelular'] ;?>"/>
    </div>
</div> <!-- controls-row -->

<div class="controls-row">
	<div class="span2">
    	<label>CEP:</label>
    	<input type="text" name="cep" class="span2" disabled id="cep" value="<?php echo $_SESSION['SScep'] ;?>">
    </div>
    <div class="span5">
		<label>Endereço:</label>
		<input type="text" name="endereco" class="span5" disabled id="endereco" value="<?php echo $_SESSION['SSendereco'] ;?>"/>
    </div>
    <div class="span1">
  		<label>Número:</label>
		<input type="text" name="numero" class="span1" disabled value="<?php echo $_SESSION['SSnumero'] ;?>"/>
    </div>
</div> <!-- controls-row -->

<div class="controls-row">
    <div class="span2">
  		<label>Complemento:</label>
		<input type="text" name="complemento" class="span2" disabled value="<?php echo $_SESSION['SScomplemento'] ;?>"/>
    </div>
	<div class="span2">
   		<label>Bairro:</label>
		<input type="text" name="bairro" class="span2" disabled id="bairro" value="<?php echo $_SESSION['SSbairro'] ;?>"/>
    </div>
	<div class="span3">
   		<label>Cidade:</label>
		<input type="text" name="cidade" class="span3" disabled id="cidade" value="<?php echo $_SESSION['SScidade'] ;?>"/>
    </div>
	<div class="span1">
   		<label>Estado:</label>
		<input type="text" name="estado" class="span1" disabled id="estado" value="<?php echo $_SESSION['SSestado'] ;?>"/>
    </div>
</div> <!-- controls-row -->

<div class="controls-row">
	<div class="span2">
		<label>Área de Atuação:</label>
		<select name="area_atuacao" id="" class="span2" disabled>
                <option value="<?php echo $_SESSION['SSarea_atuacao'] ;?>" active><?php echo $_SESSION['SSarea_atuacao'] ;?></option>
                <option value="Músico">Músico</option>
                <option value="Pastor">Pastor</option>
                <option value="Ministro">Ministro</option>
                <option value="Técnico de Som">Técnico de Som</option>
        	<option value="Membro">Membro</option>
        	<option value="Vocal">Vocal</option>
        	<option value="Outros">Outros</option>
		</select>
    </div>
	<div class="span3">
		<label>Igreja:</label>
		<input type="text" name="igreja" class="span3" disabled value="<?php echo $_SESSION['SSigreja'] ;?>"/>
	</div>
	<div class="span3">
		<label>Pastor:</label>
		<input type="text" name="pastor" class="span3" disabled value="<?php echo $_SESSION['SSpastor'] ;?>"/>
	</div>
</div> <!-- controls-row -->

<div class="controls-row">
	<div class="span3">
        <label>Email:</label>
        <input type="email" name="email" disabled class="span3" value="<?php echo $_SESSION['SSemail'] ;?>"/>
    </div>
	<div class="span2">
		<label>Senha:</label>
		<input type="password" name="senha" class="span2"  disabled placeholder="Digite sua Senha"/>
    </div>
    <div class="span2">
    	<label>Corfirma Senha:</label>
 		<input type="password" name="confirmaSenha" class="span2" disabled placeholder="Confirma Senha"/>
    </div>
</div>  <!-- controls-row -->

<div class="controls-row">
	<div class="span2">
<input type="submit" value="Editar" class="btn btn-primary" disabled name="editar" formmethod="post"/>
	</div>
</div>  <!-- controls-row -->

<hr>

<!-- PAGAMENTO DO PAGSEGURO -->
<div class="row-fluid">
  <!-- Declaração do formulário -->
<form target="pagseguro" method="post"
action="https://pagseguro.uol.com.br/v2/checkout/payment.html">

    <!-- Campos obrigatórios -->
    <input type="hidden" name="receiverEmail" value="leandropedras02@gmail.com">
    <input type="hidden" name="currency" value="BRL">

    <!-- Itens do pagamento (ao menos um item é obrigatório) -->
    <input type="hidden" name="itemId1" value="forummkt">
    <input type="hidden" name="itemDescription1" value="1 Forum de Marketing Evangelico">
    <input type="hidden" name="itemAmount1" value="68.00">
    <input type="hidden" name="itemQuantity1" value="1">
    <input type="hidden" name="itemWeight1" value="1000">

    <!-- Código de referência do pagamento no seu sistema (opcional) -->
    <input type="hidden" name="reference" value="forummkt">

    <!-- Informações de frete (opcionais)-->
    <input type="hidden" name="shippingType" value="3">
    <input type="hidden" name="shippingAddressPostalCode" value="<?php echo $_SESSION['SScep'] ;?>">
    <input type="hidden" name="shippingAddressStreet" value="<?php echo $_SESSION['SSendereco'] ;?>">
    <input type="hidden" name="shippingAddressNumber" value="<?php echo $_SESSION['SSnumero'] ;?>">
    <input type="hidden" name="shippingAddressComplement" value="<?php echo $_SESSION['SScomplemento'] ;?>">
    <input type="hidden" name="shippingAddressDistrict" value="<?php echo $_SESSION['SSbairro'] ;?>">
    <input type="hidden" name="shippingAddressCity" value="<?php echo $_SESSION['SScidade'] ;?>">
    <input type="hidden" name="shippingAddressState" value="<?php echo $_SESSION['SSestado'] ;?>">
    <input type="hidden" name="shippingAddressCountry" value="BRA">

    <!-- Dados do comprador (opcionais) -->
    <input type="hidden" name="senderName" value="<?php echo $_SESSION['SSnome'] ;?>">
    <input type="hidden" name="senderAreaCode" value="21">
    <input type="hidden" name="senderPhone" value="<?php echo $_SESSION['SStelefone'] ;?>">
    <input type="hidden" name="senderEmail" value="<?php echo $_SESSION['SSemail'] ;?>">

  <!-- submit do form (obrigatório) -->
<p>Clique no botão abaixo para escolher a forma de Pagamento</p>
<input type="submit" value="Efetue o pagamento" class="btn btn-primary" name="Comprar" formmethod="post"/>

</form>

</div><!-- #container -->

<hr>
  <h4>Confirmação de Pagamento</h4>
    <div class="controls-row"> 
      <div class="span5">
      <label for="">Digite abaixo seu ID de transação do Pagseguro</label>
      <input type="text" name="id_transacao" placeholder="9XX99X99-XX99-9999-999X-X999XXX9XX9X" class="span5">
    </div>
    <div class="span2">
      <label for=""></label><br>
      <input type="submit" value="Enviar" class="btn btn-primary" name="confirma" formmethod="post"/>
      </div>
    </div> <!-- controls-row -->

</div> <!-- container -->

<div id="push"></div>
</div><!-- warp -->
<hr>
<div id="footer">
<footer class="container">
<div class="span6">Todos os diretos reservados</div>

<div class="span4 pull-right">
<a href="http://www.leoartes.com.br" target="_blank" title="Léo Artes - Comunicação & Web"><img src="imagens/logo_leo.png" alt="Léo Artes - Comunicação &amp; Web"></a> & <a href="http://www.leoartes.com.br" target="_blank" title="Léo Artes - Comunicação & Web"><img src="imagens/logo_bernad.png" alt="Léo Artes - Comunicação &amp; Web"></a> </div>

</footer>
</div> <!-- #footer -->
<?php } ?>
</body>
</html>