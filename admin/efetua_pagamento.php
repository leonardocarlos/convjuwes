<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sem título</title>
</head>

<body>
<!-- INÍCIO DO CÓDIGO BCASH cod. produto herancacamp --> 
<form action='https://www.bcash.com.br/checkout/car/' method='post' target='carrinho'> 
<input type='hidden' value='add' name='acao'> 
<input type='hidden' value='vendaheranca@yahoo.com.br' name='email_loja'> 
<input type='hidden' value='herancacamp' name='cod_prod'> 
<input type='hidden' value='Herança Camp de 28 a 31 de Março de 2013' name='nome_prod'> 
<input type='hidden' value='180.00' name='valor_prod'> 
<input type='hidden' value='0' name='peso_prod'> 
<table border='0'><tr><td valign='middle'> 
Quant.:   <input type='text' maxLength='3' size='2' value='1' name='quant_prod' style='text-align:center'> </td> 
<td> </td><td><font size='1' color='#FF0000'>Frete Grátis</font> 

<input type='image' src='https://a248.e.akamai.net/f/248/96284/12h/www.bcash.com.br/webroot/img/bt_adicionar_ao_carrinho.png' value='Adicionar ao Carrinho' alt='Adicionar ao Carrinho' border='0' align='absbottom' /></td></tr> 
</table> 
</form> 
<!-- FIM DO CÓDIGO BCASH cod. produto herancacamp -->

<br>

<form name="bcash" action="https://www.bcash.com.br/checkout/pay/" method="post">

<input name="email_loja" type="hidden" value="vendaheranca@yahoo.com.br"> 
<input name="produto_codigo_1" type="hidden" value="herancacamp"> 
<input name="produto_descricao_1" type="hidden" value="Herança Camp de 28 a 31 de Março de 2013">
<input name="produto_qtde_1" type="hidden" value="1"> 
<input name="produto_valor_1" type="hidden" value="180.00" >
<input name="tipo_integracao" type="hidden" value="PAD">
<input name="frete" type="hidden" value="0">
<input type="image" src="https://a248.e.akamai.net/f/248/96284/12h/www.bcash.com.br/webroot/img/bt_comprar.gif" value="Comprar" alt="Comprar" border="0" align="absbottom" >

</form>
</body>
</html>