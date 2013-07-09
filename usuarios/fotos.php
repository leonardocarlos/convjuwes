<?php
ini_set("set_time_limit", '0');
ini_set("post_max_size", '5M');
ini_set("upload_max_size", '5M');

$id = $_SESSION['SSusuario_id'];
$usuariosQuery = consultaDados("select * FROM inscritos where id = $id");

if(isset($_POST['enviar'])){
    foreach ($_POST as $campo => $valor) {
        $form[$campo] = htmlspecialchars($_POST[$campo], ENT_QUOTES);
    }
    $ConsultaFoto = mysql_fetch_array($usuariosQuery);
    if(!empty($ConsultaFoto['foto'])){
            echo "<script> 
                alert('Apague primeiro a foto da pasta!');
                       window.location.href ='" . URL_BASE . "usuarios/painel_usuario.php?p=fotos';
        </script>";        
    }

    if(is_uploaded_file($_FILES['imagem']['tmp_name'])){
        $tiposPermitidos = array('image/jpg', 'image/jpeg','image/gif', 'image/png');
        list($largura, $altura) = getimagesize($_FILES['imagem']['tmp_name']);

        if($largura > 2592 || $altura > 1944){
            $mensagem .= 'A Imagem não pode ser maior do que 2592 x 1944. <br />';
        }

        if(!in_array($_FILES['imagem']['type'], $tiposPermitidos)){
            $mensagem .= 'O arquivo enviado está incorreto, somente permitido "jpeg, jpg, gif ou png".<br />';
        }

        if($_FILES['imagem']['size'] > (1500*1024)){
            $mensagem .= "O arquivo deve ser menor do que 1500Kb. <br />";
        }

    if(empty($mensagem)){
        $nome_imagem = $_FILES['imagem']['name'];
        $destino = '../imagens/fotos_usuarios/' ;

        if(is_dir($destino)){
                move_uploaded_file($_FILES['imagem']['tmp_name'], $destino . $nome_imagem);
            }else{
                mkdir($destino, '777');
                move_uploaded_file($_FILES['imagem']['tmp_name'], $destino . $nome_imagem);
            }
        }
    }
        
        //insere no banco de dados
        consultaDados("update inscritos set
        foto = '$nome_imagem'
            where id = '$id'            
        ");
       
        
        //Se os daados foram inseridos com sucesso
        
            echo "<script> 
                alert('Foto Alterada com Sucesso!');
                       window.location.href ='" . URL_BASE . "usuarios/painel_usuario.php?p=perfil';
        </script>";

        
    }
    
    if(isset($_POST['apagar'])){
        $usuariodeleta = mysql_fetch_array($usuariosQuery);
        $deleta = consultaDados("update inscritos set
        foto = ''
        ");
        unlink('../imagens/fotos_usuarios/'.$usuariodeleta["foto"]);
        
        if($deleta ==''){
            echo 'erro ao Deletar';
        }else{
            echo "<script> 
                alert('Foto Deletada com Sucesso!');
                       window.location.href ='" . URL_BASE . "usuarios/painel_usuario.php?p=fotos';
        </script>";
            
        }        
    }

/*        if(isset($mensagem)){
            echo '<script type="text/javascript"> alert("Livro cadastrado com sucesso!"); window.location = "?page=listlivraria"</script>';
        }*/
?>


<div class="well well-small display">

<h3>Inserir ou Alterar Foto</h3>

  

<?php while($usuario = mysql_fetch_array($usuariosQuery)) {?>
<div class="span3">
   
        <?php if(!empty($usuario['foto'])){
          echo '<img src='.URL_BASE . 'imagens/fotos_usuarios/'.$usuario['foto'].' class="img-polaroid" widht="200px" alt="">';
        }else{
          echo '<img src="http://placehold.it/200x200/bbb/&text=Your%20Logo" class="img-polaroid" alt="">';
        }
        ?>
   
</div>    
<?php }?>
<div class="span8">
    <h2><?php if(!empty($mensagem)) {echo $mensagem; } ?>  </h2>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">    
    
    <div class="controls-row"> 
                <label>Enviar Imagem:</label>
                <input type="file" name="imagem" />
    </div><!-- controls-row -->

    <div class="controls-row">
	<div class="span4">
            <input type="submit" value="Enviar" class="btn btn-primary" name="enviar" formmethod="post"/>
            <input type="submit" value="Apagar Foto" class="btn btn-primary" name="apagar" formmethod="post"/>
        </div>
    </div>  <!-- controls-row -->
    </form>
    
</div><!-- span8 -->
</div> <!-- well well-samall -->