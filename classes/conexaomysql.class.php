<?php
/**
 * Description of conexaomysql
 *
 * @author Leonardo
 */
class conexaomysql {
    //Declarar a variaveis protegidas
    protected $servidor;
    protected $usuario;
    protected $senha;
    protected $bandoDeDados;

    public function __construct($servidor,$usuario,$senha,$bancoDeDados){
    $this->servidor = $servidor;
    $this->usuario = $usuario;
    $this->senha = $senha;
    $this->bancoDeDados = $bancoDeDados;
}

    // Ação de conectar ao banco
    public function conectar(){
        mysql_connect($this->servidor,$this->usuario,$this->senha) or die ('Não foi possível conectar'.mysql_error());
            
        mysql_query("SET NAMES 'utf8'");
        mysql_query("SET character_set_connection=utf8");
        mysql_query("SET character_set_client=utf8");
        mysql_query("SET character_set_results=utf8");
        
}
    // Seleciona o Banco de dados
    public function selecionarBD(){
            mysql_select_db($this->bancoDeDados) or die ('Não foi possível conectar'.mysql_error());
            
}

    // Fecha o Banco de Dados
    public function fechar(){
            mysql_close();
    }
}

?>
