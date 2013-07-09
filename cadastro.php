<?php 
//include 'classes/funcoes.php';
require_once("phpmailer/class.phpmailer.php"); //caminho do arquivo da classe do phpmailer

if(isset($_POST['cadastrar'])){
 
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $data_nasc = $_POST['data_nasc'];
        $sexo = $_POST['sexo'];
        $email = $_POST['email'];
        $cep = $_POST['cep'];
        $endereco = $_POST['endereco'];
        $numero = $_POST['numero'];
        $complemento = $_POST['complemento'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $telefone = $_POST['telefone'];
        $celular = $_POST['celular'];
        $area_atuacao = $_POST['area_atuacao'];
        $igreja = $_POST['igreja'];
        $pastor = $_POST['pastor'];
        $distrito = $_POST['distrito'];
        $regiao = $_POST['regiao'];
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        $confirmaSenha = $_POST['confirmaSenha'];
                    
    
    $jatemCadastro = consultaDados("select id from inscritos where email = '$email'");
    if(mysql_num_rows($jatemCadastro) > 0){
        $mensagem = 'Email ja cadastrado no sistema! Recupere sua senha clicando aqui: <a data-toggle="modal" href="#myModal" >Login</a> <br/>';
    }
    $jatemCadastro = consultaDados("select id from inscritos where email = '$cpf'");
    if(mysql_num_rows($jatemCadastro) > 0){
        $mensagem .= 'Cpf já existe! <br/>';
    }    
    if(strlen($login)<3){
        $mensagem .= 'O login tem que ter no mínimo 6 caracteres!<br/>';
    }else{
      $jatemCadastro = consultaDados("select id from inscritos where login = '$login'");  
        if(mysql_num_rows($jatemCadastro) > 0){
        $mensagem .= 'Login já existe! <br/>';
    }
    }
    if(strlen($senha)<3){
        $mensagem .= " A senha tem que ter no mínimo 5 caracteres!<br/>";
    }elseif($senha != $confirmaSenha){
        $mensagem .= 'A confirmação de senha está incorreta <br/>';
    }
    
    
    if(empty($mensagem)){
        insereDados("insert INTO inscritos(
            nome,
            cpf,
            data_nasc,
            sexo,
            email,
            cep,
            endereco,
            numero,
            complemento,
            bairro,
            cidade,
            estado,
            telefone,
            celular,
            area_atuacao,
            igreja,
            pastor,
            distrito,
            regiao,
            login,
            senha
            ) values (
            '$nome',
            '$cpf',
            '$data_nasc',
            '$sexo',
            '$email',
            '$cep',
            '$endereco',
            '$numero',
            '$complemento',
            '$bairro',
            '$cidade',
            '$estado',
            '$telefone',
            '$celular',
            '$area_atuacao',
            '$igreja',
            '$pastor',
            '$distrito',
            '$regiao',
            '$login',
            '$senha'
            )");
    }            
            // $mensagem = "Usuário Cadastrado com sucesso, veja seu email com os dados para acesso.";
            
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
$mail->Subject = "Solicitação de Cadastro - Juwes - 6ª Região";

$mail->Body = 'A paz: <b>'.$nome. '</b>';
$mail->Body .= '<br /><br />';
$mail->Body .= 'Seu cadastro foi efetuado com sucesso use seu email ou login <br /> para acessar o sistema e efetuar sua inscrição.<br />';
$mail->Body .= '<br />';
$mail->Body .= 'Email: ' . $email;
$mail->Body .= '<br />';
$mail->Body .= 'Login: ' . $login;
$mail->Body .= '<br />';
$mail->Body .= 'Senha: ' . $senha;
$mail->Body .= '<br /><br />';
$mail->Body .= 'Clique aqui para acessar: <a href="http://juventudewesleyana6.com.br">juventudewesleyana6.com.br</a>';
$mail->Body .= '<br /><br />';
$mail->Body .= 'Webmaster - #JUWES6';
$mail->Body .= '<br />';
$mail->Body .= 'E-mail: <a href="mailto:eventos@juventudewesleyana6.com.br">eventos@juventudewesleyana6.com.br</a>';
$mail->Body .= '<br />';
$mail->Body .= 'Redes: <a href="http://facebook.com/juwes6">facebook.com/juwes6</a>';

$mail->AltBody = 'A paz: <b>'.$nome. '</b>';
$mail->AltBody .= '<br /><br />';
$mail->AltBody .= 'Seu cadastro foi efetuado com sucesso use seu email ou login <br /> para acessar o sistema e efetuar sua inscrição.<br />';
$mail->AltBody .= '<br />';
$mail->AltBody .= 'Email: ' . $email;
$mail->AltBody .= '<br />';
$mail->AltBody .= 'Login: ' . $login;
$mail->AltBody .= '<br />';
$mail->AltBody .= 'Senha: ' . $senha;
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
    echo "<script type='text/javascript'> alert('Ocorreu algum erro ao solicitar cadastro'); </script>";
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo 
 "<script type='text/javascript'> alert('Cadastro Efetuado com Sucesso! Veja seu email com os dados para acesso'); 
window.location.href ='" . URL_BASE . "';     
</script>"; 
/* "<script type='text/javascript'> $('.alert') .alert('Mensagem Enviada com Sucesso!'); </script>"; */
}
            
    }


 ?>
    
<div class="well well-small display">
    <a name="#inscreva"></a>   
<h3>Cadastro de Usuário</h3>

<?php if(!empty($mensagem)) {echo $mensagem; } ?>    

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="cadastro">        

<div class="controls-row">
    <div class="span5">
        <label>Nome:</label>
        <input type="text" name="nome" class="span5" required value=""/>
    </div>
    <div class="span2">
        <label>CPF:</label>
        <input type="text" name="cpf" id="cpf" required class="span2" value=""/>
        <span class="help-block">Somente Números</span>
    </div>
    <div class="span2">
    <label>Data Nascimento:</label>
    <input type="text" name="data_nasc" class="span2" id="datepicker" value=""/>
    </div>    
    <div class="span2">
    <label>Sexo:</label>
    <select name="sexo" id="" class="span2">
            <option value="Feminino">Feminino</option>
            <option value="Masculino">Masculino</option>
        </select>
    </div>    
</div>  <!-- controls-row -->

<div class="controls-row">
	<div class="span3">
        <label>Email:</label>
        <input type="email" name="email" required class="span3" value="" id="email"/>
    </div> 
	<div class="span2">
    	<label>CEP:</label>
    	<input type="text" name="cep" class="span2" id="cep" value="">
    </div>
    <div class="span5">
		<label>Endereço:</label>
		<input type="text" name="endereco" class="span5" required id="endereco" value=""/>
    </div>
    <div class="span1">
  		<label>Número:</label>
		<input type="text" name="numero" class="span1" value=""/>
    </div>
    
</div><!-- controls-row -->

<div class="controls-row">
    <div class="span1">
  		<label>Complemento:</label>
		<input type="text" name="complemento" class="span1" value=""/>
    </div>
    <div class="span2">
    	<label>Bairro:</label>
	<input type="text" name="bairro" class="span2" id="bairro" value=""/>
    </div>
    <div class="span3">
   	<label>Cidade:</label>
	<input type="text" name="cidade" class="span3" id="cidade" value=""/>
    </div>
    <div class="span1">
        <label>Estado:</label>
	<select name="estado" id="estado" class="span1">
        <option value="AC">AC</option>
        <option value="AL">AL</option>
        <option value="AM">AM</option>
        <option value="AP">AP</option>
        <option value="BA">BA</option>
        <option value="CE">CE</option>
        <option value="DF">DF</option>
        <option value="ES">ES</option>
        <option value="GO">GO</option>
        <option value="MA">MA</option>
        <option value="MG">MG</option>
        <option value="MS">MS</option>
        <option value="MT">MT</option>
        <option value="PA">PA</option>
        <option value="PB">PB</option>
        <option value="PE">PE</option>
        <option value="PI">PI</option>
        <option value="PR">PR</option>
        <option value="RJ">RJ</option>
        <option value="RN">RN</option>
        <option value="RO">RO</option>
        <option value="RR">RR</option>
        <option value="RS">RS</option>
        <option value="SC">SC</option>
        <option value="SE">SE</option>
        <option value="SP">SP</option>
        <option value="TO">TO</option>
        </select>
    </div>  
    <div class="span2">
		<label>Telefone:</label>
        <input type="tel" name="telefone" required pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4}" class="span2" placeholder="(xx) xxxx-xxxx" value=""/>
    </div>
        <div class="span2">
		<label>Celular:</label>
        <input type="tel" name="celular" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4}" class="span2" placeholder="(xx) xxxx-xxxx" value=""/>
    </div>    
</div> <!-- controls-row -->

<div class="controls-row">

</div> <!-- controls-row -->

<div class="controls-row">  
	<div class="span2">
		<label>Área de Atuação:</label>
		<select name="area_atuacao" id="" class="span2">
                <option value="Músico">Músico</option>
                <option value="Pastor">Pastor</option>
                <option value="Ministro">Ministro</option>
                <option value="Técnico de Som">Técnico de Som</option>
        	<option value="Membro">Membro</option>
        	<option value="Vocal">Vocal</option>
        	<option value="Outros">Outros</option>
		</select>
    </div>
	<div class="span4">
		<label>Igreja:</label>
		<input type="text" name="igreja" required class="span4" value=""/>
	</div>
	<div class="span3">
		<label>Pastor:</label>
		<input type="text" name="pastor" class="span3" value=""/>
	</div>
	<div class="span2">
		<label>Distrito:</label>
		<select name="distrito" id="" class="span2">
                <option value="Mesquita">Mesquita</option>
                <option value="Nova Iguaçu">Nova Iguaçu</option>
		</select>
    </div>
	<div class="span2">
		<label>Região:</label>
		<select name="regiao" id="" class="span2">               
                <option value="1ª Região">1ª Região</option>
                <option value="2ª Região">2ª Região</option>
                <option value="3ª Região">3ª Região</option>
                <option value="4ª Região">4ª Região</option>
                <option value="5ª Região">5ª Região</option>
                <option value="6ª Região">6ª Região</option>
                <option value="Região Nordeste">Região Nordeste</option>
                <option value="Região Européia">Região Européia</option>
                <option value="Outra">Outra</option>

		</select>
    </div>      
</div> <!-- controls-row -->

<div class="controls-row">
	<div class="span2">
            <label>Login:</label>
            <input type="text" name="login" class="span2" value="" id=""/>
            <small>

            </small>
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
            <input type="submit" value="Cadastrar" class="btn btn-primary" name="cadastrar" formmethod="post"/>
	</div>
</div>  <!-- controls-row -->

</form>

</div> <!-- container -->