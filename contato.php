<?php
if (isset($_POST['Enviar'])){

$nome = $_POST[nome];
$email = $_POST[email];
$assunto = $_POST[assunto];
$mensagem = $_POST[mensagem];
// $aviso = "";

require_once("phpmailer/class.phpmailer.php"); //caminho do arquivo da classe do phpmailer
// include("phpmailer/class.smtp.php");

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
$mail->AddAddress("juventudewesleyana6@gmail.com","Juventude Wesleyana");
$mail->AddReplyTo("diretor@juventudewesleyana6.com.br","Juventude Wesleyana");
$mail->AddAddress("eventos@juventudewesleyana6.com.br","Juventude Wesleyana");
// $mail->AddAddress("leonardo.leoartes@gmail.com"); // (opcional) só o envio pelo email
// $mail->AddReplyTo("{$form['email']}.copia","{$form['nome']}");

$mail->AddCC("{$form['email']}","{$form['nome']}"); // Envia Cópia

//aqui você coloca o endereço de quem está enviando a mensagem pela sua página
$mail->WordWrap = 50; // Definição de quebra de linha
$mail->IsHTML(true); // envio como HTML se 'true'
$mail->Subject = "Formulário de Contato - Juwes - 6ª Região";

$mail->Body = 'O usuario: ' . $nome;
$mail->Body .= '<br /><br />';
$mail->Body .= 'Com o email: ' . $email;
$mail->Body .= '<br /><br />';
$mail->Body .= 'Assunto: ' . $assunto;
$mail->Body .= '<br /><br />';
$mail->Body .= '<strong>Enviou a mensagem:</strong> <br />' . $mensagem . '<br /><br />';

$mail->AltBody = 'O usuario: ' . $nome;
$mail->AltBody .= '<br /><br />';
$mail->AltBody .= 'Com o email: ' . $email;
$mail->AltBody .= '<br /><br />';
$mail->AltBody .= 'Assunto: ' . $assunto;
$mail->AltBody .= '<br /><br />';
$mail->AltBody .= '<strong>Enviou a mensagem:</strong> <br />' . $mensagem . '<br /><br />';

// Limpa os destinatários e os anexos
// $mail->ClearAllRecipients();
// $mail->ClearAttachments();

//Verifica se o e-mail foi enviado

if(!$mail->Send())
{
    echo "<script type='text/javascript'> alert('Ocorreu algum erro ao enviar o formul&aacute;rio'); </script>";
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo 
 "<script type='text/javascript'> alert('Mensagem Enviada com Sucesso!'); </script>"; 
/* "<script type='text/javascript'> $('.alert') .alert('Mensagem Enviada com Sucesso!'); </script>"; */
}

}
?>

<div class="row-fluid well well-small">
<h2>Contato</h2>
    <div class="span4">
<p>
        Em caso de dúvidas, sugestões, entre em contato.<br>
         Se preferir, preencha o formulário ao lado e envie-nos seu e-mail. <br>
          Tão logo  retornaremos sua mensagem.
</p>
<br />
<address>
	<h4>Telefones:</h4>
 	<abbr title="phone">Tels.:</abbr>
</address>
<address>
<strong>E-mail: </strong><br>
<a href="mailto:eventos@juventudewesleyana6.com.br">eventos@juventudewesleyana6.com.br</a><br><br>
<strong>Rede</strong><br>
<a href="http://facebook.com/juwes6" target="_blank">facebook.com/juwes6</a>
</address>
    </div> <!-- span4 -->

    <?php if(!empty($aviso)){ echo '<h3>' . $aviso . '</h3>'; }  ?>

     <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" id="form" >
<div class="span3 offset1">
     <label for="nome">Nome: </label>
     <input type="text" id="nome" name="nome" class="input-large" required placeholder="Digite seu nome..."/><br />
	 <label for="email">E-mail: </label>
     <input type="email" id="email" name="email" class="input-large" required placeholder="Digite seu email..."/><br />
     <label for="assunto">Assunto: </label>
     <input type="text" id="assunto" name="assunto" class="input-large" placeholder="Digite o assunto..."/><br />
</div> <!-- span4 -->
<div class="span4">
	<label for="mensagem">Mensagem: </label>
	<textarea id="mensagem" name="mensagem" class="input-xlarge" rows="5" ></textarea>
         <br />
                    <button type="Submit" class="btn btn-primary" />Enviar</button>
        <button type="reset" class="btn btn-primary" />Limpar</button>
        <input name="Enviar" type="hidden" value="Enviar">
</div><!-- span4 -->
    </form>
</div>
