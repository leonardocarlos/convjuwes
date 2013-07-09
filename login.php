<?php 
include 'classes/funcoes.php';

if(isset($_POST['entrar'])){
    $email = HTMLSPECIALCHARS($_POST['email'], ENT_QUOTES);
    $senha = $_POST['senha'];
    $mensagem = '';
    $temLogin = consultaDados("select * from inscritos where email = '$email' or login = '$email'");
    
    if(mysql_num_rows($temLogin)>0){
        $usuario = mysql_fetch_array($temLogin);
        if($usuario['senha'] == $senha){
            
    //Se a sessão não exisit, inicia uma
    if(!isset($_SESSION)) session_start ();
    
          $_SESSION['SSusuario_id'] = $usuario['id'];
          $_SESSION['SSnome'] = $usuario['nome'];
          $_SESSION['SScpf'] = $usuario['cpf'];
          $_SESSION['SSdata_nasc'] = $usuario['data_nasc'];
          $_SESSION['SSsexo'] = $usuario['sexo'];
          $_SESSION['SStelefone'] = $usuario['telefone'];
          $_SESSION['SScelular'] = $usuario['celular'];
          $_SESSION['SScep'] = $usuario['cep'];
          $_SESSION['SSendereco'] = $usuario['endereco'];
          $_SESSION['SSnumero'] = $usuario['numero'];
          $_SESSION['SScomplemento'] = $usuario['complemento'];
          $_SESSION['SSbairro'] = $usuario['bairro'];
          $_SESSION['SScidade'] = $usuario['cidade'];
          $_SESSION['SSestado'] = $usuario['estado'];
          $_SESSION['SSarea_atuacao'] = $usuario['area_atuacao'];
          $_SESSION['SSigreja'] = $usuario['igreja'];
          $_SESSION['SSpastor'] = $usuario['pastor'];
          $_SESSION['SSemail'] = $usuario['email'];
          $_SESSION['SSsenha'] = $usuario['senha'];

          $id_usuario = $usuario['id'];

            if(isset($_SESSION['SSpagina'])){
                //Redireciona o Visitante
                header("Location: " . $_SESSION['SSpagina']);  
                //header('Location:'.URL_BASE.'usuarios/painel_usuario.php');  
                }else{
                     header('Location:'.URL_BASE.'usuarios/painel_usuario.php');  
                }
            }else{
                $mensagem .= "<div class='alert alert-error'>
                			<a class='close' data-dismiss='alert' href='#'>x</a>A Email está incorreto, tente novamente!
           					</div>";
            }
        }else{
            $mensagem .= "<div class='alert alert-error'>
                	<a class='close' data-dismiss='alert' href='#'>x</a>O nome de usuário informado não existe.!
           		</div>";
  }
            echo  "<script type='text/javascript'> alert('O Usuário não existe!'); 
window.location.href ='index.php';     
</script>"; 
  }
?>