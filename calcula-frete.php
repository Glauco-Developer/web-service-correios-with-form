<!--Calculo Frete-->
<div class="container calcfrete">
    <div class="row">
        <div class="col-lg-12">
	 <h1 class="product_title2">Calcular Frete</h1>
        <form name="correios" method="post" action="?acao=ok">
            <input type="number" name="sCepDestino" placeholder="INSIRA SEU CEP">
            <input type="submit" value="OK">
        </form>
        <div class="naoseicep">
	  <a target="_blank" href="http://www.buscacep.correios.com.br/sistemas/buscacep/default.cfm">Não sei meu CEP</a>
        </div>
		<div class="resultado-simulador">
	  	<?php
	  	 $acao = $_GET['acao']; 
	  	 $data['nCdEmpresa'] = '';
	  	 $data['sDsSenha'] = '';
	  	 $data['sCepOrigem'] = '91751000';
	  	 $data['sCepDestino'] = $_POST['sCepDestino'];
	  	 $data['nVlPeso'] = '1';
	  	 $data['nCdFormato'] = '1';
	  	 $data['nVlComprimento'] = '16';
	  	 $data['nVlAltura'] = '2';
	  	 $data['nVlLargura'] = '11';
	  	 $data['nVlDiametro'] = '0';
	  	 $data['sCdMaoPropria'] = 'n';
	  	 $data['nVlValorDeclarado'] = '0';
	  	 $data['sCdAvisoRecebimento'] = 'n';
	  	 $data['StrRetorno'] = 'xml';
	  	 $data['nCdServico'] = '40010,41106';//codigos dos serviços dos correios (Sedes, Pac)
	  	 $data = http_build_query($data);
	
	  	 $url = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx';
	
	  	 $curl = curl_init($url . '?' . $data);
	  	 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	
	  	 $result = curl_exec($curl);
	  	 $result = simplexml_load_string($result);
	  	 if ($acao=='ok') {
	  	?>
	
		<?php
	  	foreach($result -> cServico as $row) {}
	  	
	  	if($row -> Erro == 0) {?>
	  	<img class="iconCorr" src="<?php bloginfo('template_directory')?>/images/sedex-pac.png" alt="">
	  	<?php }else{} ?>
	  	<?php 
	
	  	 foreach($result -> cServico as $row) {
	  	 if($row -> Erro == 0) {
	  	    ?><span>R$ </span><?php
	  	     echo $row -> Valor . ' - Estimativa de entrega ';
	  	     echo $row -> PrazoEntrega . ' dias <br>';
	  	     /*echo $row -> ValorMaoPropria . '<br>';
	  	     echo $row -> ValorAvisoRecebimento . '<br>';
	  	     echo $row -> ValorValorDeclarado . '<br>';
	  	     echo $row -> EntregaDomiciliar . '<br>';*/
	  	 } else {
	  	     echo $row -> MsgErro;
	  	 }
	  	 
	  	 }
	  	 echo '<div class="camporesultadofrete"><p class="fretes-gratis">FRETE GRÁTIS para Porto Alegre e Região Metropolitana | <a href="" title="Cidades com frete grátis">Confira as cidades com frete grátis</a></p>
	  	        <p class="fretes-gratis">FRETE GRÁTIS nas compras acima de R$ 500,00 por Encomenda Normal - PAC e SEDEX.</p></div>';
	  	}
		 ?>
		</div>
        </div>
    </div>
</div>
