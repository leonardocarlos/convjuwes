<?php
require_once '../admin/inc/servidor.php';
   
$participantesQuery = consultaDados("SELECT * 
    FROM
    participante 
    where 
    confirma_pagto != 2 
    order by 
    nome ASC 
    ");
// $participante = mysql_fetch_array($participantesQuery);
$total = mysql_num_rows($participantesQuery);

?>

<script type="text/javascript">
    function excluir(id){
        if(confirm("Você tem certeza que deseja EXCLUIR o participante?") == true){
          window.location = '?p=listparticipantes&acao=excluir&id=' + id;          
        }
    }
</script>
<div class="span12">
<article>
    <h3>Participantes</h3>
 <table class="table table-striped">
     <thead>
     <tr class="center">
         <th width="40%">Participantes</th>
         <th width="15%">Email</th>
         <th width="10%">Comprovante</th>
         <th width="20%">Confirmar Pagamento</th>
     </tr>
     </thead>
     <tbody>
     <?php while($participante = mysql_fetch_array($participantesQuery)) { ?>
     <tr>        
     <th><?php echo $participante['nome'];?></th>  
     <th><?php echo $participante['email'];?></th>
     <th class="text-center">
                 <?php if($participante['comprovante']  == "moip.jpg"){ 
             echo '---';              
             }else{
                 echo '<a href="' . URL_BASE . 'comprovantes/' . $participante['comprovante'] .'" target="_blank"><img src="img/imagem.png" width="16" height="14" title="Clique para Editar" /></a>'; };  ?>

     </th>
     <th class="text-center">
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="get">
        <a class="btn btn-small btn-success" href="?p=editpagamento&acao=editar&id=<?php echo $participante['id']; ?>" title="Clique para Editar"><i class="icon-shopping-cart icon-white"></i></a>            
        <?php // echo '<input type="hidden" name="id" value="' . $participante['id'] . '" />'; ?>
       <input type="hidden" name="acao" value="<?php echo $participante['id']; ?>" formmethod="get"/>
        <input type="hidden" name="acao" value="editar"/>        
        </form>
     </th>     
     <input type="hidden" name="acao" value="<?php echo $participante['id']; ?>" formmethod="get"/>
     <input type="hidden" name="acao" value="confirmar" formmethod="get"/>
     </tr>  
     <?php } ?>
     </tbody>
 </table>
</article>
<br />

</div>

<div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Confirmar Delete?</h3>
    </div>
    <div class="modal-body">
        <p class="error-text">Você tem certeza que deseja EXCLUIR o participante??</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
        <button class="btn btn-danger" data-dismiss="modal">Deletar</button>
    </div>
</div>

<?php 
    if(isset($_POST['editar'])){
        foreach ($_POST as $campo => $valor){
            $form[$campo] = htmlspecialchars($_POST[$campo], ENT_QUOTES);
        }
        $mensagem = '';
        
     if(empty($mensagem)){
         consultaDados("update participantes
             set          
            confirma_pagto = '{$form['confirma_pagto']}'
			where id = '$id'
            ");
          
//            $mensagem = 'Pagamento confirmado com sucesso';
//$participante1 = mysql_fetch_array($participantesQuery);
// $forumQuery = consultaDados("SELECT * FROM forum where id = '{$participante['id_forum']}'"); 
//$forum1 = mysql_fetch_object($forumQuery);

if($participante['id_forum'] == 1 ): $forumdata = 'Sul Fluminense de 18 a 20 de Janeiro de 2013'; elseif($participante['id_forum'] == 2 ): $forumdata =  'Baixada Fluminense de 25 a 27 de janeiro de 2013'; else :$forumdata =  'Capital de 1 a 3 de Fevereiro de 2013'; endif;


require_once("../phpmailer/class.phpmailer.php"); //caminho do arquivo da classe do phpmailer
// include("../phpmailer/class.smtp.php");

$mail = new PHPMailer();
date_default_timezone_set('America/Sao_Paulo');
$mail->IsSMTP(); // send via SMTP
$mail->Host       = "mail.juventudewesleyana6.com.br"; // SMTP server
// $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
$mail->SMTPAuth = true; // 'true' para autenticação
$mail->Username = "webmaster@juventudewesleyana6.com.br"; // usuário de SMTP
$mail->Password = "17041986"; // senha de SMTP
$mail->From = "webmaster@juventudewesleyana6.com.br";
//coloque aqui o seu correio, para que a autenticação não barre a mensagem

$mail->FromName = "Juventude Wesleyana - Sexta Região";
$mail->AddAddress("{$participante['email']}","{$participante['nome']}");
// $mail->AddAddress("leonardo.leoartes@gmail.com"); // (opcional) só o envio pelo email
// $mail->AddReplyTo("{$form['email']}.copia","{$form['nome']}");

// $mail->AddCC("{$form['email']}","{$form['nome']}"); // Envia Cópia
$mail->AddCC("webmaster@juventudewesleyana6.com.br"); // Envia Cópia

//aqui você coloca o endereço de quem está enviando a mensagem pela sua página
$mail->WordWrap = 50; // Definição de quebra de linha
$mail->IsHTML(true); // envio como HTML se 'true'
$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)

$mail->Subject = "Confirmação no Fórum de Liderança Jovem";
$mail->Body = '<img src="http://www.juventudewesleyana6.com.br/imagens/topo_email.jpg" width="600" height="89" alt="" />';
$mail->Body .= '<h2>Confirmação no Fórum de Liderança Jovem</h2>';
$mail->Body .= '</br></br>';
$mail->Body .= 'Olá <b>' . $participante['nome'] . '</b>, a paz de Cristo!';
$mail->Body .= '</br></br>';
$mail->Body .= 'Você está recebendo este email por ter se inscrito no Forum de Liderança Jovem: </br>';
$mail->Body .= '<h3>' . $forumdata . '</h3>';
$mail->Body .= '</br>';
$mail->Body .= '<b>Esse é seu Comprovante de Inscrição</b> </br>';
$mail->Body .= '</br>';
$mail->Body .= '<p>A sua inscrição está confirmada e sua participação garantida </br>';
$mail->Body .= 'Imprima-o e guarde em local seguro e apresente-o na portaria no dia do evento. </br>';
$mail->Body .= '</br></br>';
$mail->Body .= 'Quando estivermos chegando perto da data marcada para o evento, você receberá um email com orientações sobre o evento. </p>';
$mail->Body .= '</br></br>';
$mail->Body .= 'Qualquer coisa que podermos ajudar, fique a vontade para entrar em contato.';
$mail->Body .= '</br></br>';
$mail->Body .= '<p>A Direção - Juventude Wesleyana da 6ª Região</p>';

        
$mail->AltBody = '<img src="http://www.juventudewesleyana6.com.br/imagens/topo_email.jpg" width="600" height="89" alt="" />';
$mail->AltBody .= '<h2>Confirmação no Fórum de Liderança Jovem</h2>';
$mail->AltBody .= '</br></br>';
$mail->AltBody .= 'Olá <b>' . $participante['nome'] . '</b>, a paz de Cristo!';
$mail->AltBody .= '</br></br>';
$mail->AltBody .= 'Você está recebendo este email por ter se inscrito no Forum de Liderança Jovem: </br>';
$mail->AltBody .= '<h3>' . $forumdata . '</h3>';
$mail->AltBody .= '</br>';
$mail->AltBody .= '<b>Esse é seu Comprovante de Inscrição</b>';
$mail->AltBody .= '</br>';
$mail->AltBody .= '<p>A sua inscrição está confirmada e sua participação garantida </br>';
$mail->AltBody .= 'Imprima-o e guarde em local seguro e apresente-o na portaria no dia do evento. </br>';
$mail->AltBody .= '</br></br>';
$mail->AltBody .= 'Quando estivermos chegando perto da data marcada para o evento, você receberá um email com orientações sobre o evento. </p>';
$mail->AltBody .= '</br></br>';
$mail->AltBody .= 'Qualquer coisa que podermos ajudar, fique a vontade para entrar em contato.';
$mail->AltBody .= '</br></br>';
$mail->AltBody .= '<p>A Direção - Juventude Wesleyana da 6ª Região</p>';


// Define os anexos (opcional)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
// $mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo
//
// Limpa os destinatários e os anexos
//$mail->ClearAllRecipients();
//$mail->ClearAttachments();

//Verifica se o e-mail foi enviado

if(!$mail->Send())
{
    echo "Pagamento Não Confirmado! <br />";
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
        // $confirmar = 'Confirmação enviada para o email de' . $participante['nome'] ;
        echo "<script>
        alert('Confirmação enviada com sucesso, para o email: {$participante['email']} ');
        window.location.href ='" . URL_BASE . "admin/?page=confpagamento';
        </script>";         
}


     }
    
   

?>
 <?php  } ?> 