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
                    <a href="index.php">Home</a>
                  </li>
                  <li><a href="#">Sobre o Evento</a></li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      Programação
                      <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                       <li><a href="#">Agenda do Evento</a></li>
                    </ul>
                  </li>
                  <li><a data-toggle="modal" href="#myModal" >Login</a></li>
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
    <div id="modalTab">
        <div class="tab-content">
          <div class="tab-pane active" id="login">

        <?php if(!empty($mensagem)) {echo $mensagem; } ?>
        <form method="POST" action="<?php echo URL_BASE ;?>login.php" accept-charset="UTF-8" >
      <p><label class="control-label" for="inputIcon">Email ou Login</label>
          <input type="text" class="span4" name="email" id="email" placeholder="Digite seu Email ou login"></p>
      <p>
          <label class="control-label" for="inputIcon">Senha</label>
          <input type="password" class="span4" name="senha" placeholder="Senha"></p>

      <p><button type="submit" class="btn btn-primary">Entrar</button>
          <input name="entrar" type="hidden" id="entrar">
        <a href="#forgotpassword" data-toggle="tab">Esqueceu a Senha?</a>
      </p>
        </form>
            </div>
  <!-- Recupera Senha -->
    <div class="tab-pane fade" id="forgotpassword">
      <form method="post" action='<?php echo URL_BASE ;?>recupera-senha.php' name="forgot_password">
        <p>Se você esqueceu a sua senha, basta preencher com seu email no campo abaixo 
para que seja enviada um nova senha!</p>
          <input type="text" class="span12" name="email" id="email" placeholder="Digite seu Email">
          <p><button type="submit" class="btn btn-primary" name="enviar">Enviar</button>
          <a href="#login" data-toggle="tab">Espere, eu me lembro agora!</a>
          </p>
          </form>
        
    </div>
        </div>
        <span class="preto pull-right">Se não tem cadastro, clique aqui!</span>
    </div>
    </div>
    
  <div class="modal-footer">
      <small class="preto pull-left">Se você participou do Fórum clique <a href="#forgotpassword" data-toggle="tab">AQUI</a> e <br> digite seu email para receber nova senha</small>
      <a href="?p=cadastro#inscreva" class="btn btn-primary">Inscrição</a>
  </div>
</div>