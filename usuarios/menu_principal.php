    <div class="row-fluid">
    <nav>
        <div class="navbar navbar-fixed-top">
          <div class="navbar-inner">
            <div class="container">

              <!-- .btn-navbar é usado como alternador para conteúdo de barra de navegação colapsável -->
              <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </a>

              <!-- Tenha certeza de deixar a marca se você quer que ela seja mostrada
              <a class="brand" href="#">Home</a> -->

              <!-- Tudo que você queira escondido em 940px ou menos, coloque aqui -->
              <div class="nav-collapse collapse">
                <!-- .nav, .navbar-search, .navbar-form, etc -->

                <ul class="nav">
                  <li class="active">
                    <a href="painel_usuario.php">Home</a>
                  </li>
                  <li><a href="?p=sobre-o-evento">Sobre o Evento</a></li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      Programação
                      <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                       <li><a href="?p=palestrantes">Palestrantes</a></li>
                       <li><a href="?p=programacao">Agenda do Evento</a></li>
                    </ul>
                  </li>
                  <li><a href="?p=contato">Contato</a></li>
                  <li><a href="?p=comochegar">Como Chegar</a></li>
                </ul>

              </div> <!-- nav-collapse collapse -->

            </div> <!-- container -->
          </div> <!-- navbar-inner -->
        </div> <!-- navbar -->
    </nav> <!-- nav -->

<div class="modal hide" id="myModal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">x</button>
    <h3>Area do Participante</h3>
  </div>
  <div class="modal-body ">
        <?php// if(!empty($mensagem)) {echo $mensagem; } ?>
        <form method="POST" action="login.php" accept-charset="UTF-8" >
          <div class="control-group">
            <label class="control-label" for="inputIcon">Email</label>
            <div class="controls">
              <div class="input-prepend"> <span class="add-on"><i class="icon-envelope"></i></span>
                <input class="span6" id="inputIcon" type="email" placeholder="Digite seu Email" name="email">
              </div>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputIcon">Senha</label>
            <div class="controls">
              <div class="input-prepend"> <span class="add-on"><i class="icon-asterisk"></i></span>
                <input class="span6" id="inputIcon" type="password" placeholder="senha" name="senha">
              </div>
            </div>
          </div>
      <p><button type="submit" class="btn btn-primary">Entrar</button>
          <input name="entrar" type="hidden" id="entrar">
        <a href="#">Esqueceu a Senha?</a>
      </p>
    </form>
  </div>
  <div class="modal-footer">
    Já fez sua inscrição?
    <a href="#" class="btn btn-primary">Inscrição</a>
  </div>
</div>

    <header>
    	<div class="span5"> <img src="<?php echo URL_BASE ;?>imagens/logo.png" alt="Adorador por Excelencia"></div>
        <div class="span6 text-center">
                <h2>2ª Convenção Regional da Juventude Wesleyana - 6ª Região</h2>
        </div> <!-- span6 -->
    </header> <!-- header -->

</div> <!-- row-fuid -->