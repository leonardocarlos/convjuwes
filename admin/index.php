<?php ini_set( 'default_charset', 'utf-8'); ?>
<?php 
include '../classes/funcoes.php';
/*
// Verifica se houve POST e se o usuário ou a são é vazio
if(!empty($_POST) AND (empty($_POST['login']) or empty($_POST['senha']))){
    header('Location:'.URL_BASE.'admin/index.php'); exit;
}

$login = $_POST['login'];
$senha = $_POST['senha'];

// validação dos Dados Digitados 
$temLogin = consultaDados("select * from usuarios where login = '$login' AND senha = '$senha'");
$usuario = mysql_fetch_array($temLogin);

if($usuario!= 1) {
    // mensagem de erra quando os ddos são inválidos e/ou o usuário não for encontrado
     $mensagem = "<div class='alert alert-error'>
               <a class='close' data-dismiss='alert' href='#'>x</a>A Login inválido, tente novamente!
                    </div>"; exit;
}else{
    // Salva os dados encontrado na váriavel $resutlado
    $resultado = mysql_fetch_assoc($usuario);
    
    //Se a sessão não exisit, inicia uma
    if(!isset($_SESSION)) session_start ();
    
    // Salva os dados encontrados na sessão
    $_SESSION['SSusuario_id'] = $resultado['id'];
    $_SESSION['SSnome'] = $resultado['nome'];
    $_SESSION['SSusuario'] = $resultado['login'];    
    $_SESSION['SSnivel'] = $resultado['nivel']; 
    
    //Redireciona o Visitante
    header('Location:'.URL_BASE.'admin/index2.php');
}

//include_once '../admin/inc/config.php';
//include_once '../admin/inc/servidor.php';
 */
if(isset($_POST['entrar'])){
    $login = HTMLSPECIALCHARS($_POST['login'], ENT_QUOTES);
    $senha = $_POST['senha'];
    $mensagem = '';
    $temLogin = consultaDados("select * from usuarios where login = '$login'");

    if(mysql_num_rows($temLogin)>0){
        $usuario = mysql_fetch_array($temLogin);
        if($usuario['senha'] == $senha){
    //Se a sessão não exisit, inicia uma
    if(!isset($_SESSION)) session_start ();
    
     // Salva os dados encontrados na sessão
    $_SESSION['SSusuario_id'] = $usuario['id'];
    $_SESSION['SSnome'] = $usuario['nome'];
    $_SESSION['SSusuario'] = $usuario['login'];
    $_SESSION['SSnivel'] = $usuario['nivel'];
    
    $id_usuario = $usuario['id'];

            if(isset($_SESSION['SSpagina'])){
                //Redireciona o Visitante
                header("Location: " . $_SESSION['SSpagina']);
            }else{
                 header('Location:'.URL_BASE.'admin/index2.php');
                }
            }else{
                $mensagem .= "<div class='alert alert-error'>
                			<a class='close' data-dismiss='alert' href='#'>x</a>A senha está incorreta, tente novamente!
           					</div>";
            }
        }else{
            $mensagem .= "<div class='alert alert-error'>
                			<a class='close' data-dismiss='alert' href='#'>x</a>O nome de usuário informado não existe.!
           					</div>";
        }
    } 
?>
<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Google Chrome Frame for IE -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Juventude Wesleyana - 6ª Região</title>
<!-- Bootstrap -->
<link href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="../bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
<link href="bootstrap/estilo.css" rel="stylesheet" type="text/css" media="all">
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">
        <div class="row">
            <div class="span4 offset4">
              <div class="form-signin">
                <legend>Painel de Controle</legend>
                <?php if(!empty($mensagem)) {echo $mensagem; } ?>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" accept-charset="UTF-8" >
                    <div class="control-group">
                      <label class="control-label" for="inputIcon">Usu&aacute;rio</label>
                      <div class="controls">
                        <div class="input-prepend">
                          <span class="add-on"><i class="icon-user"></i></span>
                          <input class="span2" id="inputIcon" type="text" placeholder="usuario" name="login" required>
                        </div>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label" for="inputIcon">Senha</label>
                      <div class="controls">
                        <div class="input-prepend">
                          <span class="add-on"><i class="icon-asterisk"></i></span>
                          <input class="span2" id="inputIcon" type="password" placeholder="senha" name="senha" required>
                        </div>
                      </div>
                    </div>  <!--
                    <label class="checkbox">
                        <input type="checkbox" name="remember" value="1"> Relembrar Senha
                    </label> -->

                    <label><a href="#">Esqueci minha senha</a></label>
                  <button class="btn-info btn" type="submit">Login</button>
                    <input name="entrar" type="hidden" id="entrar">
                </form>
              </div>
            </div>
        </div>

</div>
</body>
</html>