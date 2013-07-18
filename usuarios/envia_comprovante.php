<?php

ini_set("set_time_limit", '0');
ini_set("post_max_size", '5M');
ini_set("upload_max_size", '5M');

$id = $_SESSION['SSusuario_id'];

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
       
        
        //Se os daados foram inseridos com sucesso
        
            echo "<script> 
                alert('Comprovante enviado com Sucesso!');
                       window.location.href ='" . URL_BASE . "usuarios/painel_usuario.php?p=listarinscricoes';
        </script>";

        
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
        
?>

<div class="well well-small display">

<h3>Inserir ou Alterar Comprovante</h3>

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
<?php }?>
</div> <!-- well well-samall -->