  <nav>
        <div class="navbar navbar-inverse">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="brand">Painel Usuário</div>

                    <div class="nav-collapse collapse">
                      <ul class="nav">
                          
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="icon-user icon-white"></i> Dados
                      <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
	               <li><a href="?p=perfil">Perfil</a></li>
                       <li><a href="?p=fotos">Foto</a></li>
                       <li><a href="?p=altera_senha">Alterar Senha</a></li>
                    </ul>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                     <i class="icon-shopping-cart icon-white"></i> Inscrições
                      <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                       <li><a href="?p=fazer_inscricao">Fazer Inscrição</a></li>                       
                       <li><a href="?p=listarinscricoes">Listar Inscrições</a></li>                       
                       <li><a href="?p=confirma_inscricoes">Confirmar Inscrições</a></li>                       
                    </ul>
                  </li>                    
<!--                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                     <i class="icon-list-alt icon-white"></i> Relat&oacute;rios
                      <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                       <li><a href="#">Parcicipantes Pagos</a></li>
                       <li><a href="#">Formas de Pagamento</a></li>
                       <li><a href="#">Pagamentos confirmados</a></li>
                    </ul>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                     <i class="icon-map-marker icon-white"></i> Eventos
                      <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                       <li><a href="?p=cadevento">Cadastrar Evento</a></li>
                       <li><a href="?p=listarevento">Listar Evento</a></li>
                    </ul>
                  </li>-->
                      </ul>
                      <div class="pull-right">
                        <ul class="nav pull-right">
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Seja Bem-vindo,
                            <?php if(isset($_SESSION['SSnome'])) {?>
                             <?php echo $_SESSION['SSnome']; }?> <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/user/preferences"><i class="icon-cog"></i> Preferences</a></li>
                                    <li><a href="/help/support"><i class="icon-user"></i> Usu&aacute;rios</a></li>
                                    <li><a href="/help/support"><i class="icon-envelope"></i> Contactar o Suporte</a></li>
                                    <li class="divider"></li>
                                    <li><a href="logout.php"><i class="icon-off"></i> Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </nav> <!-- nav -->