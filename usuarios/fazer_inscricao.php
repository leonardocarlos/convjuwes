<?php

$id = $_SESSION['SSusuario_id'];

$eventoQuery = consultaDados("select * FROM evento where ativo = 1");

if(isset($_POST['inscrever'])){
$nome_evento = $_POST['nome_evento'];
$quantidade = $_POST['quantidade'];
$tipo_pagamento = $_POST['tipo_pagamento'];
$cartao = $_POST['cartao'];
$deposito = $_POST['deposito'];
$obs = $_POST['obs'];

if($tipo_pagamento == 'Deposito'){
    
  insereDados("insert INTO inscricoes(
    nome_evento,
    id_inscrito,
    quantidade,
    tipo_pagamento,
    valor,
    obs,
    data_inscricao
    ) values (
    '$nome_evento',
    '$id',
    '$quantidade',
    '$tipo_pagamento',
    '$deposito',
    '$obs',
    now()
    )");
       
        echo "<script>
        alert('Participante Cadastrado com sucesso! Confira seu email e efetue o pagamento.');
        window.location.href ='" . URL_BASE . "usuarios/painel_usuario.php';
        </script>";        
}else{
if($tipo_pagamento == 'PagSeguro'){
    
  insereDados("insert INTO inscricoes(
    nome_evento,
    id_inscrito,
    quantidade,
    tipo_pagamento,
    valor,
    obs,
    data_inscricao
    ) values (
    '$nome_evento',
    '$id',
    '$quantidade',
    '$tipo_pagamento',
    '$cartao',
    '$obs',
    now()
    )");    
}
}


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
$mail->AddAddress ("$email","$nome");
//$mail->AddReplyTo("diretor@juventudewesleyana6.com.br","Juventude Wesleyana");
//$mail->AddAddress("eventos@juventudewesleyana6.com.br","Juventude Wesleyana");
// $mail->AddAddress("leonardo.leoartes@gmail.com"); // (opcional) só o envio pelo email
// $mail->AddReplyTo("{$form['email']}.copia","{$form['nome']}");
//$mail->AddCC("{$form['email']}","{$form['nome']}"); // Envia Cópia

//aqui você coloca o endereço de quem está enviando a mensagem pela sua página
$mail->WordWrap = 50; // Definição de quebra de linha
$mail->IsHTML(true); // envio como HTML se 'true'
$mail->Subject = "Inscrição - Juwes - 6ª Região";

$mail->Body = '<h2>Inscrição no '.$nome_evento.'</h2>';
$mail->Body .= '</br></br>';
$mail->Body .= 'Seu pedido de Inscrição foi Relizado com sucesso</br>';
$mail->Body .= 'Efetua o pagamento para receber seu email de confirmação!</br>';
$mail->Body .= '</br>';
$mail->Body .= 'Acesso o link <a href="http://www.juventudewesleyana.com.br/" target="_blank">Login</a></br>';
$mail->Body .= '</br>';
$mail->Body .= 'Para acessar o sistema e gerar seu boleto de Pagamento!</br>';
$mail->Body .= '</br>';
$mail->Body .= 'As opções são Cartão de Crédito, Boleto ou Transferência Bancária!</br>';
$mail->Body .= '</br>';
$mail->Body .= '<strongDados para acesso:</strong></br>';
$mail->Body .= '<strong>Email:</strong> ' . $email . '</br>';
$mail->Body .= '<strong>Senha:</strong> ' . $senha . '</br>,';
//$mail->Body .= 'Efetue por esse link: <a href="http://www.juventudewesleyana6.com.br/forum/?p=efetuapagamento">Efetue o Pagamento</a></br>';

$mail->AltBody = '<h2>Inscrição do Fórum de Marketing Evangélico</h2>';
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
$mail->AltBody .= '<strong>Dados para acesso:</strong></br>';
$mail->AltBody .= '<strong>Email:</strong> ' . $email . '</br>';
$mail->AltBody .= '<strong>Senha:</strong> ' . $senha . '</br>,';

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
        alert('Inscrição Realizada com sucesso! Efetue o pagamento para confirmar sua presena.');
        window.location.href ='" . URL_BASE . "?p=efetua_pagamento';
        </script>";
}

}
?>
<?php while($evento = mysql_fetch_array($eventoQuery)) {
$cartao = $evento['valor_cartao'];
$deposito = $evento['valor_deposito'];   
    ?>

<div class="well well-small display">
     <h3>Inscrição no Eventos</h3>
     <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
<div class="controls-row">     
    <div class="span6">
        <label for="">Selecione o Evento</label>
        <select name="evento" id="" class="span5">
         
        <option value="<?php echo $evento['nome_evento'];?>"><?php echo $evento['nome_evento'];?></option>
        
        </select>
    </div>
</div>
<div class="controls-row">
    <div class="span1">
        <label for="">Quantidade: </label>
        <select name="quantidade" id="quantidade" class="span1">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
        </select>
    </div>
    <div class="span6">
        <label for="">Valor e Tipo de Pagamento: </label>
        <select name="tipo_pagamento" id="tipo_pagamento" class="span2">
            <option value="Deposito"><?php echo 'Depósito - R$ '.$evento['valor_deposito'];?></option>
            <option value="PagSeguro"><?php echo 'PagSeguro - R$ '.$evento['valor_cartao'];?></option>
        </select>  
    </div>     
</div>  <!-- controls-row --> 
<div class="controls-row">
	<div class="span5">
        <label for="">Observação: </label>
        <textarea name="obs" id="" cols="50" rows="3" class="span5"></textarea>
        <small>Caso deseja fazer a inscrição para para mais pessoas coloque na caixa
            acima o nome completo dos participantes com um documento RG ou CPF </small>
        </div>
</div>  <!-- controls-row --> 
<div class="controls-row">
<input type="hidden" value="<?php echo $evento['valor_deposito'];?>" name="deposito" />
<input type="hidden" value="<?php echo $evento['valor_cartao'];?>" name="cartao" />

</div>  <!-- controls-row -->
<div class="controls-row">
	<div class="span5">
<input type="submit" value="Inscrever" class="btn btn-primary pull-right" name="inscrever" formmethod="post"/>
	</div>
</div>  <!-- controls-row -->   
</form>
</div>
<?php } ?>