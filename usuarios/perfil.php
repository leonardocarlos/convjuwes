<?php 
$id = $_SESSION['SSusuario_id'];
$usuariosQuery = consultaDados("select * FROM inscritos where id = $id");


if(isset($_POST['editar'])){
    foreach ($_POST as $campo => $valor) {
        $form[$campo] = htmlspecialchars($_POST[$campo], ENT_QUOTES);
    }
    consultaDados("update inscritos set
        nome = '{$form['nome']}',
        cpf = '{$form['cpf']}',
        data_nasc = '{$form['data_nasc']}',
        sexo = '{$form['sexo']}',
        email = '{$form['email']}',
        cep = '{$form['cep']}',
        endereco = '{$form['endereco']}',
        numero = '{$form['numero']}',
        complemento = '{$form['complemento']}',
        bairro = '{$form['bairro']}',
        cidade = '{$form['cidade']}',
        estado = '{$form['estado']}',
        telefone = '{$form['telefone']}',
        celular = '{$form['celular']}',
        area_atuacao = '{$form['area_atuacao']}',
        igreja = '{$form['igreja']}',
        pastor = '{$form['pastor']}',
        distrito = '{$form['distrito']}',
        regiao = '{$form['regiao']}',
        delegado = '{$form['delegado']}'
      where 
      id = $id
     ");
    //$mensagem = 'Dados Atualizados com sucesso!';
echo "<script>
        alert('Dados Atualizado com Sucesso!');
        window.location.href ='" . URL_BASE . "usuarios/painel_usuario.php?p=perfil';
        </script>";        
}
 ?>
    
<div class="well well-small display">
    
<h3>Area do Usuário</h3>

<?php if(!empty($mensagem)) {echo $mensagem; } ?>    

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>">        

<?php while($usuario = mysql_fetch_array($usuariosQuery)) {?>
<div class="span3">
    <a href="?p=fotos" title="Clique para Alterar a Foto">
        <?php if(!empty($usuario['foto'])){
          echo '<img src='.URL_BASE . 'imagens/fotos_usuarios/'.$usuario['foto'].' class="img-polaroid" widht="200px" alt="">';
        }else{
          echo '<img src="http://placehold.it/200x200/bbb/&text=Your%20Logo" class="img-polaroid" alt="">';
        }
        ?>
    </a>
</div>
 
<div class="span8">
<div class="controls-row">
    <div class="span5">
        <label>Nome:</label>
        <input type="text" name="nome" class="span5" required value="<?php echo $usuario['nome'] ;?> "/>
    </div>
    <div class="span2">
        <label>CPF:</label>
        <input type="text" name="cpf" id="cpf" required class="span2" value="<?php echo $usuario['cpf'] ;?> "/>
        <span class="help-block">Somente Números</span>
    </div>
</div>  <!-- controls-row -->

<div class="controls-row">
    <div class="span2">
    <label>Data Nascimento:</label>
    <input type="text" name="data_nasc" class="span2" id="datepicker" value="<?php echo /*formataData($usuario['data_nasc'], 'd-m-Y')*/ $usuario['data_nasc'] ;?>"/>
    </div>
    <div class="span2">
    <label>Sexo:</label>
    <select name="sexo" id="" class="span2">
            <option value="<?php echo $usuario['sexo'] ;?>" active><?php echo $usuario['sexo'] ;?></option>
            <option value="Feminino">Feminino</option>
            <option value="Masculino">Masculino</option>
        </select>
    </div>
	<div class="span3">
        <label>Email:</label>
        <input type="email" name="email" required class="span3" value="<?php echo $usuario['email'] ;?>"/>
    </div>    
</div><!-- controls-row -->

<div class="controls-row">
	<div class="span1">
    	<label>CEP:</label>
    	<input type="text" name="cep" class="span1" id="cep" value="<?php echo $usuario['cep'] ;?>">
    </div>
    <div class="span5">
		<label>Endereço:</label>
		<input type="text" name="endereco" class="span5" required id="endereco" value="<?php echo $usuario['endereco'] ;?>"/>
    </div>
    <div class="span1">
  		<label>Número:</label>
		<input type="text" name="numero" class="span1" value="<?php echo $usuario['numero'] ;?>"/>
    </div>
</div> <!-- controls-row -->

<div class="controls-row">
    <div class="span1">
  		<label>Complemento:</label>
		<input type="text" name="complemento" class="span1" value="<?php echo $usuario['complemento'] ;?>"/>
    </div>
	<div class="span2">
   		<label>Bairro:</label>
		<input type="text" name="bairro" class="span2" id="bairro" value="<?php echo $usuario['bairro'] ;?>"/>
    </div>
	<div class="span3">
   		<label>Cidade:</label>
		<input type="text" name="cidade" class="span3" id="cidade" value="<?php echo $usuario['cidade'] ;?>"/>
    </div>
    <div class="span1">
        <label>Estado:</label>
	<select name="estado" id="estado" class="span1">
        <option value="<?php echo $usuario['estado'] ;?>" active><?php echo $usuario['estado'] ;?></option>    
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
</div> <!-- controls-row -->

<div class="controls-row">
    <div class="span2">
		<label>Telefone:</label>
        <input type="tel" name="telefone" required pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4}" class="span2" placeholder="(xx) xxxx-xxxx" value="<?php echo $usuario['telefone'] ;?>"/>
    </div>
        <div class="span2">
		<label>Celular:</label>
        <input type="tel" name="celular" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4}" class="span2" placeholder="(xx) xxxx-xxxx" value="<?php echo $usuario['celular'] ;?>"/>
    </div>
</div> <!-- controls-row -->

<div class="controls-row">  
	<div class="span2">
		<label>Área de Atuação:</label>
		<select name="area_atuacao" id="" class="span2">
                <option value="<?php echo $usuario['area_atuacao'] ;?>" active><?php echo $usuario['area_atuacao'] ;?></option>
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
		<input type="text" name="igreja" required class="span4" value="<?php echo $usuario['igreja'] ;?>"/>
	</div>
	<div class="span3">
		<label>Pastor:</label>
		<input type="text" name="pastor" class="span3" value="<?php echo $usuario['pastor'] ;?>"/>
	</div>
	<div class="span2">
		<label>Distrito:</label>
		<select name="distrito" id="" class="span2">
                <option value="<?php echo $usuario['distrito'] ;?>" active><?php echo $usuario['distrito'] ;?></option>
                <option value="Mesquita">Mesquita</option>
                <option value="Nova Iguaçu">Nova Iguaçu</option>
		</select>
    </div>
	<div class="span2">
		<label>Região:</label>
		<select name="regiao" id="" class="span2">
                <option value="<?php echo $usuario['regiao'] ;?>" active><?php echo $usuario['regiao'] ;?></option>
                <option value="1ª Região">1ª Região</option>
                <option value="2ª Região">2ª Região</option>
                <option value="3ª Região">3ª Região</option>
                <option value="4ª Região">4ª Região</option>
                <option value="5ª Região">5ª Região</option>
                <option value="6ª Região">6ª Região</option>
                <option value="Região Nordeste">Região Nordeste</option>
                <option value="Região Européia">Região Européia</option>

		</select>
    </div>  
	<div class="span1">
		<label>Delegado:</label>
		<select name="delegado" id="" class="span1">
                <option value="<?php echo $usuario['delegado'] ;?>" active><?php echo $usuario['delegado'] ;?></option>                    
                <option value="Sim">Sim</option>
                <option value="Não">Não</option>
		</select>
    </div>       
</div> <!-- controls-row -->

<div class="controls-row">
	<div class="span2">
            <label>Login:</label>
            <input type="text" name="login" disabled class="span2" value="<?php echo $usuario['login'] ;?>"/>
        </div>
  
</div>  <!-- controls-row -->

<div class="controls-row">
	<div class="span2">
            <input type="submit" value="Atualizar" class="btn btn-primary" name="editar" formmethod="post"/>
	</div>
</div>  <!-- controls-row -->
</div><!-- span8-->
</form>
<?php } ?>
</div> <!-- container -->