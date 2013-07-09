<?php ini_set( 'default_charset', 'utf-8'); ?>
<?php

require_once 'inc/config.php';
require_once 'inc/servidor.php';

if(isset($_POST['enviar'])){
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $data_nascimento = $_POST['data_nascimento'];
    $sexo = $_POST['sexo'];
    $telefone = $_POST['telefone'];
    $celular = $_POST['celular'];
    $cep = $_POST['cep'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $area_atuacao = $_POST['area_atuacao'];
    $igreja = $_POST['igreja'];
    $pastor = $_POST['pastor'];
    $email = $_POST['email'];
	$senha = $_POST['senha'];
    $confirmaSenha = $_POST['confirmaSenha'];

/*    foreach ($_POST as $campo => $valor){
        $form[$campo] = htmlspecialchars($_POST[$campo], ENT_QUOTES);
    }
    $mensagem =''; */
    if(empty($cpf)){
        $mensagem = "
		<div class='alert alert-error'>
         <a class='close' data-dismiss='alert' href='#'>x</a>O Campo cpf é obrigatório!
         </div>"
		;
		}else{ // Consulta o banco para constar se ja existe um cpf
			$jaTeCpf = consultaDados("Select id from participante where cpf = '$cpf'");
			if(mysql_num_rows($jaTeCpf) > 0){
				$mensagem .= "<div class='alert alert-error'><a class='close' data-dismiss='alert' href='#'>x</a>
				O cpf ja existe, <a href='?p=recupera-senha'>recupere sua senha clicando aqui</a>.</div>";
			}
    if(empty($email)){
        $mensagem = "
		<div class='alert alert-error'>
         <a class='close' data-dismiss='alert' href='#'>x</a>O Campo email � obrigat�rio!
         </div>";
		}else{ // Consulta o banco para constar se ja existe um email
			$jaTemEmail = consultaDados("Select id from participante where email = '$email'");
			if(mysql_num_rows($jaTemEmail) > 0){
				$mensagem .= "<div class='alert alert-error'><a class='close' data-dismiss='alert' href='#'>x</a>
				O email ja existe, <a href='?p=recupera-senha'>recupere sua senha clicando aqui</a>.</div>";
			}
    if(strlen($senha) <6){
    $mensagem .= "
		<div class='alert alert-error'>
         <a class='close' data-dismiss='alert' href='#'>x</a>Digite no mínio 6 caracteres para senha!
         </div>
	";
	}elseif($senha != $confirmaSenha){
    $mensagem .= "
		<div class='alert alert-error'>
         <a class='close' data-dismiss='alert' href='#'>x</a>A Confirmaão da senha está incorreta!
         </div>
	";
	}

    if(empty($mensagem)){
       insereDados("insert INTO participante(
    nome,
    cpf,
    data_nascimento,
    sexo,
    telefone,
    celular,
    cep,
    endereco,
    numero,
    complemento,
    bairro,
    cidade,
    estado,
    area_atuacao,
    igreja,
    pastor,
    email,
    senha
		) values (
    '$nome',
    '$cpf',
    '$data_nascimento',
    '$sexo',
    '$telefone',
    '$celular',
    '$cep',
    '$endereco',
    '$numero',
    '$complemento',
    '$bairro',
    '$cidade',
    '$estado',
    '$area_atuacao',
    '$igreja',
    '$pastor',
    '$email',
    '$senha'
    )");


require_once("phpmailer/class.phpmailer.php"); //caminho do arquivo da classe do phpmailer
// include("phpmailer/class.smtp.php");

$mail = new PHPMailer();
date_default_timezone_set('America/Sao_Paulo');
$mail->IsSMTP(); // send via SMTP
$mail->CharSet = "UTF-8"; // Define a Codificação
$mail->Host       = "mail.crentequefazmarketing.com.br"; // SMTP server
//$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
//$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
//$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
//$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
$mail->SMTPAuth = true; // 'true' para autentica��o
$mail->Username = "evento@crentequefazmarketing.com.br"; // usuário de SMTP
$mail->Password = "leo123456"; // senha de SMTP
$mail->From = "evento@crentequefazmarketing.com.br";
//coloque aqui o seu correio, para que a autentica��o n�o barre a mensagem

$mail->FromName = "Crente que faz Marketing";
$mail->AddAddress("evento@crentequefazmarketing.com.br","Crente que faz Marketing");
$mail->AddReplyTo("leandropedras02@gmail.com","Leandro Pedras");
$mail->AddAddress("leandropedras02@gmail.com");
// $mail->AddReplyTo("{$form['email']}.copia","{$form['nome']}");

$mail->AddCC("$email","$nome"); // Envia Cópia

// Se voc� quiser anexar aquivos, pode utilizar os comandos abaixo, caso n�o v� enviar anexos, remova os comandos
// $mail->AddAttachment("/var/tmp/file.tar.gz"); // Arquivo Anexo 1
//$mail->AddAttachment("$destino$nome_imagem"); // Arquivo Anexo 2
// $mail->AddAttachment($arquivo['tmp_name'], $arquivo['name']);
//
//aqui voc� coloca o endere�o de quem est� enviando a mensagem pela sua p�gina
$mail->WordWrap = 50; // Defini��o de quebra de linha
$mail->IsHTML(true); // envio como HTML se 'true'
$mail->Subject = "Pedido de Inscrição";
$mail->Body = '<h2>Inscrição do Fórum de Marketing Evangélico</h2>';
$mail->Body .= '</br></br>';
$mail->Body .= 'Seu pedido de Inscrição foi Relizado com sucesso</br>';
$mail->Body .= 'Efetua o pagamento para receber seu email de confirmação!</br>';
$mail->Body .= '</br>';
$mail->Body .= 'Acesso o link <a href="http://www.crentequefazmarketing.com.br/" target="_blank">Login</a></br>';
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
$mail->AltBody .= 'Acesso o link <a href="http://www.crentequefazmarketing.com.br/" target="_blank">Login</a></br>';
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
        alert('Participante Cadastrado com sucesso! Faça o login e escolha a forma de pagamento.');
        window.location.href ='" . URL_BASE . "?p=login';
        </script>";
}

}
}
}
}

?>
  <script>
  $(function() {
    $( "#datepicker" ).datepicker({
		dateFormat: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
		dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
		});
  });

$(document).ready(function(){
    $("#cep").blur(function(e){
        if($.trim($("#cep").val()) != ""){
            $.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#cep").val(), function(){
                if(resultadoCEP["resultado"]){
                    $("#endereco").val(unescape(resultadoCEP["tipo_logradouro"])+": "+unescape(resultadoCEP["logradouro"]));
                    $("#bairro").val(unescape(resultadoCEP["bairro"]));
                    $("#cidade").val(unescape(resultadoCEP["cidade"]));
                    $("#estado").val(unescape(resultadoCEP["uf"]));
                }else{
                    alert("N�o foi possivel encontrar o endere�o");
                }
            });
        }
    })
});
  </script>
<div class="well well-small">
<div class"row-fluid">

	<h3>Formul&aacute;rio de Inscri&ccedil;&otilde;es</h3>
    <hr>
           <?php if(!empty($mensagem)){ echo $mensagem; }  ?>

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
<fieldset>
<div class="controls-row">
    <div class="span6">
        <label>Nome:</label>
        <input type="text" name="nome" required class="span6" value=""/>
    </div>
    <div class="span2">
        <label>CPF:</label>
        <input type="text" name="cpf" id="cpf" required class="span2" value=""/>
        <span class="help-block">Somente Números</span>
    </div>

</div>  <!-- controls-row -->

<div class="controls-row">
    <div class="span2">
    <label>Data Nascimento:</label>
    <input type="text" name="data_nascimento" required  class="span2" value="" id="datepicker" placeholder="00/00/0000"/>
    </div>
    <div class="span2">
    <label>Sexo:</label>
    <select name="sexo" id="" class="span2">
            <option value="F">Feminino</option>
            <option value="M">Masculino</option>
        </select>
    </div>
    <div class="span2">
		<label>Telefone:</label>
        <input type="tel" name="telefone" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4}" class="span2" required placeholder="(xx) xxxx-xxxx"/>
    </div>
        <div class="span2">
		<label>Celular:</label>
        <input type="tel" name="celular" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4}" class="span2" placeholder="(xx) xxxx-xxxx"/>
    </div>
</div> <!-- controls-row -->

<div class="controls-row">
	<div class="span2">
    	<label>CEP:</label>
    	<input type="text" name="cep" class="span2" required id="cep">
    </div>
    <div class="span5">
		<label>Endereço:</label>
		<input type="text" name="endereco" class="span5" value="" required id="endereco"/>
    </div>
    <div class="span1">
  		<label>Número:</label>
		<input type="text" name="numero" class="span1" required value=""/>
    </div>
</div> <!-- controls-row -->

<div class="controls-row">
    <div class="span2">
  		<label>Complemento:</label>
		<input type="text" name="complemento" class="span2" required value=""/>
    </div>
	<div class="span2">
   		<label>Bairro:</label>
		<input type="text" name="bairro" class="span2" required value="" id="bairro"/>
    </div>
	<div class="span3">
   		<label>Cidade:</label>
		<input type="text" name="cidade" class="span3" required value="" id="cidade"/>
    </div>
	<div class="span1">
   		<label>Estado:</label>
		<input type="text" name="estado" class="span1" required value="" id="estado"/>
    </div>
</div> <!-- controls-row -->

<div class="controls-row">
	<div class="span2">
		<label>Área de Atuação:</label>
		<select name="area_atuacao" id="" class="span2">
                <option value="Membro">Membro</option>
                <option value="Pastor">Pastor</option>
                <option value="Designer">Designer</option>
            	<option value="Marketing">Marketing</option>
            	<option value="Vocal">Publicitário</option>
            	<option value="Outros">Outros</option>
		</select>
    </div>
	<div class="span3">
		<label>Igreja:</label>
		<input type="text" name="igreja" class="span3" value=""/>
	</div>
	<div class="span3">
		<label>Pastor:</label>
		<input type="text" name="pastor" class="span3" value=""/>
	</div>
</div> <!-- controls-row -->

<div class="controls-row">
	<div class="span3">
        <label>Email:</label>
        <input type="email" name="email" required value="" class="span3"/>
    </div>
	<div class="span2">
		<label>Senha:</label>
		<input type="password" name="senha" class="span2" value="" required placeholder="Digite sua Senha"/>
    </div>
    <div class="span2">
    	<label>Corfirma Senha:</label>
 		<input type="password" name="confirmaSenha" class="span2" value=""  required placeholder="Confirma Senha"/>
    </div>
</div>  <!-- controls-row -->

<div class="controls-row">
	<div class="span2">
<input type="submit" value="Enviar" class="btn btn-primary" name="enviar" formmethod="post"/>
	</div>
</div>  <!-- controls-row -->
</fieldset>
</form>
  </div>
</div>

