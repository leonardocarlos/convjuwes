<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="<?php echo URL_BASE ;?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo URL_BASE ;?>bootstrap/js/bootstrap-tooltip.js"></script>
<script src="<?php echo URL_BASE ;?>js/jquery-ui-1.10.1.custom.js"></script>
<script type="text/javascript" src="<?php echo URL_BASE ;?>js/jquery.maskMoney.js" ></script>
<script src="<?php echo URL_BASE ;?>js/jquery.Jcrop.js"></script>
<script type="text/javascript" src="<?php echo URL_BASE ;?>js/jquery.maskedinput-1.1.4.pack.js"/></script>

<link rel="stylesheet" href="<?php echo URL_BASE ;?>css/jquery.Jcrop.css" type="text/css">

<script>
  $(function() {
    $( "#datepicker" ).datepicker({
		dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
		dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
		});
  });

  $(function() {
    $( "#datepicker1" ).datepicker({
    dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
    dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    });
  });

        $(document).ready(function(){
              $("input.dinheiro").maskMoney({showSymbol:true, symbol:"", decimal:".", thousands:""});
        });

$(document).ready(function(){
    $("#cep").blur(function(e){
        if($.trim($("#cep").val()) != ""){
            $.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#cep").val(), function(){
                if(resultadoCEP["resultado"]){
                    $("#endereco").val(unescape(resultadoCEP["tipo_logradouro"])+": "+unescape(resultadoCEP["logradouro"]));
                    $("#bairro").val(unescape(resultadoCEP["bairro"]));
                    $("#cidade").val(unescape(resultadoCEP["cidade"]));
                    $("#estado").val(unescape(resultadoCEP["uf"]));
                }else{
                    alert("Não foi possivel encontrar o endereço");
                }
            });
        }
    })
});

  </script>
  <script type="text/javascript">
$(document).ready(function(){
	$("#cpf").mask("999.999.999-99");
});
</script>      