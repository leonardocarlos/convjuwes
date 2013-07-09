<?php 
$id = $_SESSION['SSusuario_id'];
$usuariosQuery = consultaDados("select * FROM inscritos where id = $id");


if(isset($_POST['editar'])){
    foreach ($_POST as $campo => $valor) {
        $form[$campo] = htmlspecialchars($_POST[$campo], ENT_QUOTES);
    }
    
   $usuario1 = mysql_fetch_array($usuariosQuery);
    if($usuario1['senha'] == $_POST['senha_atual']){
        $novaSenha = ($form['senha']);
        consultaDados("update inscritos set
        senha = '$novaSenha'
            where id = '$id'
        ");
    $mensagem = 'Dados Atualizados com sucesso!';
}else{
    $mensagem = 'Senha atual Incorreta! Tente Novamente';
}
}
 ?>
    
<div class="well well-small display">
        <h3>Area do Usuário</h3>
       
<?php $usuariosQuery = consultaDados("select * FROM inscritos where id = $id");?>
    
<?php while($usuario = mysql_fetch_array($usuariosQuery)) {?>
<div class="span3">
    <a href="#" title="Clique para Alterar a Foto">
        <?php if(!empty($usuario['foto'])){
          echo '<img src='.URL_BASE . 'imagens/fotos_usuarios/'.$usuario['foto'].' class="img-polaroid" widht="200px" alt="">';
        }else{
          echo '<img src="http://placehold.it/200x200/bbb/&text=Your%20Logo" class="img-polaroid" alt="">';
        }
        ?>
    </a>
</div>    
<?php }?>   
        
<div class="span8">
 <?php if(!empty($mensagem)) {echo $mensagem; } ?>    
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>">
<div class="controls-row">    
	<div class="span2">
        <label>Senha Atual:</label>
        <input type="password" name="senha_atual" class="span2" placeholder="Digite sua Senha Atual"/>
    </div>
</div><!-- controls-row -->
    
<div class="controls-row">
	<div class="span2">
		<label>Senha:</label>
		<input type="password" name="senha" class="span2"  placeholder="Digite sua Senha"/>
    </div>
    <div class="span2">
    	<label>Corfirma Senha:</label>
 		<input type="password" name="confirmaSenha" class="span2" placeholder="Confirma Senha"/>
    </div>
</div>  <!-- controls-row -->

<div class="controls-row">
	<div class="span2">
            <input type="submit" value="Editar" class="btn btn-primary" name="editar" formmethod="post"/>
	</div>
</div>  <!-- controls-row -->
</form>
</div><!-- span8-->
</div> <!-- container -->