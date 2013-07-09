<?php
require_once("class.phpmailer.php"); //caminho do arquivo da classe do phpmailer

$mail = new PHPMailer();
$mail->IsSMTP(); // send via SMTP
$mail->Host = "mail.seudominio"; //seu servidor SMTP
$mail->SMTPAuth = true; // 'true' para autenticação
$mail->Username = "usuario@seudominio"; // usuário de SMTP
$mail->Password = "senhaxx"; // senha de SMTP
$mail->From = "de@seudominio";
//coloque aqui o seu correio, para que a autenticação não barre a mensagem
$mail->FromName = "remetente";
$mail->AddAddress("email@destinatario","Nome do Destinatario ");
$mail->AddAddress("email@destinatario"); // (opcional) só o envio pelo email
$mail->AddReplyTo("email@destinatario.copia","Nome do Destinatario para quem ira a resposta");
//aqui você coloca o endereço de quem está enviando a mensagem pela sua página
$mail->WordWrap = 50; // Definição de quebra de linha
$mail->IsHTML(true); // envio como HTML se 'true'
$mail->Subject = "Assunto da mensagem ";
$mail->Body = "Conteúdo da mensagem HTML ";
$mail->AltBody = "Para mensagens somente texto";
//Verifica se o e-mail foi enviado
if(!$mail->Send())
{
    echo "Mensagem não enviada<br />";
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Mensagem enviada";
}
?>