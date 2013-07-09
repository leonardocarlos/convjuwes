<?php
ini_set( 'default_charset', 'utf-8');

if(isset($_POST['enviar'])){
    $mensagem = '';
    $email = $_POST['email'];
    
    include 'classes/funcoes.php';
    require_once("phpmailer/class.phpmailer.php"); //caminho do arquivo da classe do phpmailer
    
    if(empty($email)){
        $mensagem .= '´Preencha com seu email para ser enviada a senha.<br />';
    }
    
    $temEmail = consultaDados("select * from inscritos where email = '$email'");
    
    if(mysql_numrows($temEmail) == 0){
        $mensagem .= 'O email ou login digitado não existe.<br />';
    }
    if(empty($mensagem)){
        $caracteres = array('a', 'e', 'i', 'u', '2', '3', '4', '5', '6', '7', '8', '9');
        $novaSenha = '';
        for($i = 0; $i < 6; $i++){
            $posicao = round(mt_rand(0, count($caracteres)));
            $novaSenha .= $caracteres[$posicao];
        }
        $dadosUsuario = mysql_fetch_array($temEmail);
        //$id = $dadosUsuario['id'];
        consultaDados("update inscritos set senha = '$novaSenha' where email = '$email'");
        
        
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
$mail->AddAddress ("{$dadosUsuario['email']}","{$dadosUsuario['nome']}");
//$mail->AddReplyTo("diretor@juventudewesleyana6.com.br","Juventude Wesleyana");
//$mail->AddAddress("eventos@juventudewesleyana6.com.br","Juventude Wesleyana");
// $mail->AddAddress("leonardo.leoartes@gmail.com"); // (opcional) só o envio pelo email
// $mail->AddReplyTo("{$form['email']}.copia","{$form['nome']}");
//$mail->AddCC("{$form['email']}","{$form['nome']}"); // Envia Cópia

//aqui você coloca o endereço de quem está enviando a mensagem pela sua página
$mail->WordWrap = 50; // Definição de quebra de linha
$mail->IsHTML(true); // envio como HTML se 'true'
$mail->Subject = "Solicitação de Nova Senha - Juwes - 6ª Região";

$mail->Body = 'A paz: <b>'.$dadosUsuario['nome']. '</b>';
$mail->Body .= '<br /><br />';
$mail->Body .= 'Foi solicitado o envio de uma nova senha para sua conta, segue abaixo a nova senha: <br /><br />';
$mail->Body .= '<br /><br />';
$mail->Body .= 'Nova Senha: ' . $novaSenha;
$mail->Body .= '<br /><br />';
$mail->Body .= 'Clique aqui para acessar: <a href="http://juventudewesleyana6.com.br">juventudewesleyana6.com.br</a>';
$mail->Body .= '<br /><br />';
$mail->Body .= 'Webmaster - #JUWES6';
$mail->Body .= '<br />';
$mail->Body .= 'E-mail: <a href="mailto:eventos@juventudewesleyana6.com.br">eventos@juventudewesleyana6.com.br</a>';
$mail->Body .= '<br />';
$mail->Body .= 'Redes: <a href="http://facebook.com/juwes6">facebook.com/juwes6</a>';

$mail->AltBody = 'A paz: <b>'.$dadosUsuario['nome']. '</b>';
$mail->AltBody .= '<br /><br />';
$mail->AltBody .= 'Foi solicitado o envio de uma nova senha para sua conta, segue abaixo a nova senha: <br /><br />';
$mail->AltBody .= '<br /><br />';
$mail->AltBody .= 'Nova Senha: ' . $novaSenha;
$mail->AltBody .= '<br /><br />';
$mail->AltBody .= 'Clique aqui para acessar: <a href="http://juventudewesleyana6.com.br">juventudewesleyana6.com.br</a>';
$mail->AltBody .= '<br /><br />';
$mail->AltBody .= 'Webmaster - #JUWES6';
$mail->AltBody .= '<br />';
$mail->AltBody .= 'E-mail: <a href="mailto:eventos@juventudewesleyana6.com.br">eventos@juventudewesleyana6.com.br</a>';
$mail->AltBody .= '<br />';
$mail->AltBody .= 'Redes: <a href="http://facebook.com/juwes6">facebook.com/juwes6</a>';
// Limpa os destinatários e os anexos
// $mail->ClearAllRecipients();
// $mail->ClearAttachments();

//Verifica se o e-mail foi enviado

if(!$mail->Send())
{
    echo "<script type='text/javascript'> alert('Ocorreu algum erro ao solicitar nova senha'); </script>";
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo 
 "<script type='text/javascript'> alert('Senha Enviada com Sucesso!'); 
window.location.href ='" . URL_BASE . "';     
</script>"; 
/* "<script type='text/javascript'> $('.alert') .alert('Mensagem Enviada com Sucesso!'); </script>"; */
}

}

}

?>
