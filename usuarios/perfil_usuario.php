<div class="well well-small display">

<h3>Estatísticas do Usuário</h3>

<?php // if(!empty($mensagem)) {echo $mensagem; } ?>    

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>">       
    
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

</div>

