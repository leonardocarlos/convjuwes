<?php

ini_set("set_time_limit", '0');
ini_set("post_max_size", '5M');
ini_set("upload_max_size", '5M');

$id = $_SESSION['SSusuario_id'];

require_once('../phpmailer/class.phpmailer.php'); //caminho do arquivo da classe do phpmailer

$inscricaoQuery = consultaDados("select 
        i.*,
        e.*,
        u.id
    from 
        inscricoes i,
        evento e,
        inscritos u
    WHERE
        i.id_evento = e.id and
        i.id_inscrito = u.id 
    and       
        i.id_inscrito = '{$_SESSION['SSusuario_id']}'
    ");

        
if(isset($_POST['enviar'])){
    $evento1 = mysql_fetch_array($inscricaoQuery);
    $_SESSION['SSusuario_id'] = $evento1['id_inscrito'];
    $_SESSION['SSevento_id'] = $evento1['id_evento'];
    foreach ($_POST as $campo => $valor) {
        $form[$campo] = htmlspecialchars($_POST[$campo], ENT_QUOTES);
    }
/*   $ConsultaFoto = mysql_fetch_array($usuariosQuery);
    if(!empty($ConsultaFoto['foto'])){
            echo "<script> 
                alert('Apague primeiro a foto da pasta!');
                       window.location.href ='" . URL_BASE . "usuarios/painel_usuario.php?p=fotos';
        </script>";        
    }
*/
    if(is_uploaded_file($_FILES['comprovante']['tmp_name'])){
        $tiposPermitidos = array('image/jpg', 'image/jpeg','image/gif', 'image/png');
        list($largura, $altura) = getimagesize($_FILES['comprovante']['tmp_name']);

        if($largura > 2592 || $altura > 1944){
            $mensagem .= 'A Imagem não pode ser maior do que 2592 x 1944. <br />';
        }

        if(!in_array($_FILES['comprovante']['type'], $tiposPermitidos)){
            $mensagem .= 'O arquivo enviado está incorreto, somente permitido "jpeg, jpg, gif ou png".<br />';
        }

        if($_FILES['comprovante']['size'] > (1500*1024)){
            $mensagem .= "O arquivo deve ser menor do que 1500Kb. <br />";
        }

    if(empty($mensagem)){
        // Pega extensão da imagem 
//        preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext); 
        $nome_imagem = uniqid(time()).'-'.$_FILES['comprovante']['name'];
//        $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
        $destino = '../comprovantes/' ;

        if(is_dir($destino)){
                move_uploaded_file($_FILES['comprovante']['tmp_name'], $destino . $nome_imagem);
            }else{
                mkdir($destino, '777');
                move_uploaded_file($_FILES['comprovante']['tmp_name'], $destino . $nome_imagem);
            }
        }
    }
        
        //insere no banco de dados
        consultaDados("update inscricoes set
        comprovante = '$nome_imagem'
            where id_evento = '{$_SESSION['SSevento_id']}'
            and id_inscrito = '{$_SESSION['SSusuario_id']}';         
        ");
       
        
$mail = new PHPMailer();
date_default_timezone_set('America/Sao_Paulo');
$mail->IsSMTP(); // send via SMTP
$mail->CharSet = "UTF-8"; // Define a Codificação
$mail->Host       = "mail.juventudewesleyana6.com.br"; // SMTP server
//$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
$mail->SMTPAuth = true; // 'true' para autenticação
$mail->Username = "webmaster@juventudewesleyana6.com.br"; // usuário de SMTP
$mail->Password = "17041986"; // senha de SMTP
$mail->From = "webmaster@juventudewesleyana6.com.br";
//coloque aqui o seu correio, para que a autenticação não barre a mensagem

$mail->FromName = "Juventude Wesleyana - Sexta Região";
$mail->AddAddress ($_SESSION['SSemail'],$_SESSION['SSnome']);
//$mail->AddReplyTo("diretor@juventudewesleyana6.com.br","Juventude Wesleyana");
$mail->AddAddress("eventos@juventudewesleyana6.com.br","Juventude Wesleyana");
// $mail->AddAddress("leonardo.leoartes@gmail.com"); // (opcional) só o envio pelo email
// $mail->AddReplyTo("{$form['email']}.copia","{$form['nome']}");
//$mail->AddCC("{$form['email']}","{$form['nome']}"); // Envia Cópia

//aqui você coloca o endereço de quem está enviando a mensagem pela sua página
$mail->WordWrap = 50; // Definição de quebra de linha
$mail->IsHTML(true); // envio como HTML se 'true'
$mail->Subject = "Envio de Comprovante - Juwes - 6ª Região";

$mail->Body = '<h2>Inscrição no '.$evento1['nome_evento'].'</h2>';
$mail->Body .= '</br></br>';
$mail->Body .= 'Seu envio de Comprovante foi efetuado com sucesso</br>';
$mail->Body .= 'Assim que confirmarmos enviaremos seu comprovante de Inscrição, VOUCHER!</br>';
$mail->Body .= '</br>';
$mail->Body .= 'Acesso o link <a href="http://www.juventudewesleyana.com.br/" target="_blank">Login</a></br>';
$mail->Body .= '</br>';
$mail->Body .= 'Para acessar o sistema e gerar seu boleto de Pagamento!</br>';
$mail->Body .= '</br>';
$mail->Body .= 'As opções são Cartão de Crédito, Boleto ou Transferência Bancária!</br>';
$mail->Body .= '</br>';
$mail->Body .= '<strongDados para acesso:</strong></br>';
$mail->Body .= '<strong>Email:</strong> ' . $_SESSION['SSemail'] . '</br>';
$mail->Body .= '<strong>Senha:</strong> ' . $_SESSION['SSsenha'] . '</br>,';
//$mail->Body .= 'Efetue por esse link: <a href="http://www.juventudewesleyana6.com.br/forum/?p=efetuapagamento">Efetue o Pagamento</a></br>';

$mail->AltBody = '<h2>Inscrição no '.$nome_evento.'</h2>';
$mail->AltBody .= '</br></br>';
$mail->AltBody .= 'Seu pedido de Inscrição foi Relizado com sucesso</br>';
$mail->AltBody .= 'Efetua o pagamento para receber seu email de confirmação!</br>';
$mail->AltBody .= '</br>';
$mail->AltBody .= 'Acesso o link <a href="http://www.juventudewesleyana.com.br/" target="_blank">Login</a></br>';
$mail->AltBody .= '</br>';
$mail->AltBody .= 'Para acessar o sistema e gerar seu boleto de Pagamento!</br>';
$mail->AltBody .= '</br>';
$mail->AltBody .= 'As opções são Cartão de Crédito, Boleto ou Transferência Bancária!</br>';
$mail->AltBody .= '</br>';
$mail->AltBody .= '<strongDados para acesso:</strong></br>';
$mail->AltBody .= '<strong>Email:</strong> ' . $_SESSION['SSemail'] . '</br>';
$mail->AltBody .= '<strong>Senha:</strong> ' . $_SESSION['SSsenha'] . '</br>,';

// Limpa os destinat�rios e os anexos
// $mail->ClearAllRecipients();
// $mail->ClearAttachments();

//Verifica se o e-mail foi enviado

if(!$mail->Send())
{
    echo "<script type='text/javascript'> alert('Ocorreu algum erro ao enviar o formulário'); </script>";
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
        // $mensagem = 'Participante Cadastrado com sucesso!';
        // $mensagem .= '<a href="?p=efetuapagamento>Clique aqui para Efetuar o Pagamento</a>"';
        //     header("Location: ?p=efetuapagamento.php");
            echo "<script> 
                alert('Comprovante enviado com Sucesso!');
                       window.location.href ='" . URL_BASE . "usuarios/painel_usuario.php?p=listarinscricoes';
        </script>";
}
}    
    if(isset($_POST['apagar'])){
        $comprovantedeleta = mysql_fetch_array($inscricaoQuery);
        $deleta = consultaDados("update inscricoes set
        comprovante = ''
        where
        id_evento = '{$_SESSION['SSevento_id']}'
        and id_inscrito = '{$_SESSION['SSusuario_id']}';
        ");
        unlink('../comprovantes/'.$comprovantedeleta["comprovante"]);
        
        if($deleta ==''){
            echo 'erro ao Deletar';
        }else{
            echo "<script> 
                alert('Comprovante Deletado com Sucesso!');
                       window.location.href ='" . URL_BASE . "usuarios/painel_usuario.php?p=envia_comprovante';
        </script>";
            
        }        
    }

    if(isset($_POST['salvar'])){
    foreach ($_POST as $campo => $valor) {
        $form[$campo] = htmlspecialchars($_POST[$campo], ENT_QUOTES);
    }
    
   $transacao = mysql_fetch_array($inscricaoQuery);

        consultaDados("update inscricoes set
        cod_transacao = '{$form['cod_transacao']}'
            where id_evento = '{$_SESSION['SSevento_id']}'
            and id_inscrito = '{$_SESSION['SSusuario_id']}';
        ");
            
    echo "<script>
        alert('Código de Transação Atualizado com Sucesso!');
        window.location.href ='" . URL_BASE . "usuarios/painel_usuario.php?p=listarinscricoes';
        </script>";

}

        
?>

<div class="well well-small">

<h3>Inserir ou Alterar Comprovante</h3>
<div class="controls-row">
  <div class="span6">
    <h2><?php if(!empty($mensagem)) {echo $mensagem; } ?>  </h2>
    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">    
    
    <div class="controls-row"> 
        <label>Enviar Imagem:</label>
        <input type="file" name="comprovante" />
    </div><!-- controls-row -->

    <div class="controls-row">
	<div class="span4">
            <input type="submit" value="Enviar" class="btn btn-primary" name="enviar" formmethod="post"/>
            <input type="submit" value="Apagar Comprovante" class="btn btn-primary" name="apagar" formmethod="post"/>
        </div>
    </div>  <!-- controls-row -->
    </form>
    
</div><!-- span6 -->
<?php while($inscricoes = mysql_fetch_array($inscricaoQuery)) {?>

    <div class="span5">

            <?php if(!empty($inscricoes['comprovante'])){
              echo '<a href='.URL_BASE . 'comprovantes/'.$inscricoes['comprovante'].' target="_blank"><img src='.URL_BASE . 'comprovantes/'.$inscricoes['comprovante'].' class="img-polaroid" widht="" alt=""></a>';
            }else{
              echo '<img src="http://placehold.it/200x200/bbb/&text=Your%20Logo" class="img-polaroid" alt="">';
            }
            ?>

    </div>      
</div>      
<?php }?>
<br>
    <div class="controls-row">
<hr>        
      <div class="span6">
        <h2><?php if(!empty($mensagem)) {echo $mensagem; } ?>  </h2>
    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">    

        <div class="controls-row"> 
                    <label>Digite o Código de Transação do PagSeguro confirmar sua inscrição</label>
                    <input type="text" name="cod_transacao" required/>
        </div><!-- controls-row -->

        <div class="controls-row">
            <div class="span4">
                <input type="submit" value="Salvar" class="btn btn-primary" name="salvar" formmethod="post"/>
            </div>
        </div>  <!-- controls-row -->
        </form>

    </div><!-- span6 -->
    </div>  
</div> <!-- well well-samall -->