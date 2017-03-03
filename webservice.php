<?php
/* @var $this WebserviceController */

$this->breadcrumbs=array(
	'Webservice',
	);

#die( print_r( $_POST['formBoletoXYZ'])  );

ini_set ( 'soap.wsdl_cache_enable' , 0 ); ini_set ( 'soap.wsdl_cache_ttl' , 0 );

$client=new SoapClient('http://111.11.11.11:1111/ws/WS_TITULOS.apw?WSDL');

if ($client === Null) {

	throw new CHttpException(404, 'The requested page does not exist');
	return $client;

}

          #$ctoken = 'intpitney2017@!';
          #$cnpj = Yii::app()->user->email; #00190373000172  00.915.792/0001-24 
          #$ctp = 'B';
          #$cdata = '20170101';
          #$cdadata = '20171231';


         # $object = array('CTOKEN' => 'intpitney2017@!', 'CCLIENTE' => 00190373000172, 'CTP' => 'B', 'CDATADE' => 20170101, 'CDATAATE' => 20171231);

$object = array('CTOKEN' => 'i11111111111!', 'CCLIENTE' => '00111111111', 'CTP' => 'B', 'CDATADE' => '2017', 'CDATAATE' => '2017');     

$result = $client->__soapCall("POSFIN",  array('POSFINRESULT' => $object));
/* 2 */
# Interpreta uma string XML e a transforma em um objeto
$xml = simplexml_load_string($result->POSFINRESULT, null, LIBXML_NOCDATA);
?>




<table class="table table-bordered table-striped">
	<thead>
		<tr style="color: #fff; background-color: #000;">
		<!--	<th style="color: #fff; background-color: #000;"></th>   -->        
			<th style="color: #fff; background-color: #000;">Numero</th>
			<th style="color: #fff; background-color: #000;">Emissão</th> 
			<th style="color: #fff; background-color: #000;">Vencimento</th>
			<th style="color: #fff; background-color: #000;">Valor</th>
			<th style="color: #fff; background-color: #000;">Juros</th>
			<th style="color: #fff; background-color: #000;">Multa</th> 
			<th style="color: #fff; background-color: #000;">N.Cliente</th> 
			<th style="color: #fff; background-color: #000;">CNPJ/CPF</th> 
			<th style="color: #fff; background-color: #000;">Baixa</th>
			<th style="color: #fff; background-color: #000;"></th>
		</tr>
	</thead> 

	
	<!--<form  method="post" name="formEnviarBoleto" action="actions\teste.php"> -->
	<form  method="post" name="formEnviarBoleto" action="index.php?r=Webservice/TodosTitulo">
	<?php
	#action="index.php?r=Webservice/TodosTitulo"
	foreach ($xml->TITULO as $key => $value) {
   
		#echo '<td>'.$value->RECNO.'</td>';            
        echo '<input type="hidden" name="linha".$key." value=".$value->RECNO.">';
		echo '<td>'.$value->E1_NUM.'</td>';
		echo '<td>'.$value->E1_EMISSAO.'</td>';
		echo '<td>'.$value->E1_VENCREA.'</td>';
		echo '<td>'.$value->E1_VALOR.'</td>';
		echo '<td>'.$value->E1_JUROS.'</td>';
		echo '<td>'.$value->E1_MULTA.'</td>';
		echo '<td>'.$value->E1_NOMCLI.'</td>';
		echo '<td>'.$value->A1_CGC.'</td>';
		echo '<td>'.$value->E1_BAIXA.'</td>';
        echo '<td><button class="btn btn-warning" name="select.$value->RECNO." value=".$value->RECNO.">'.'Boleto'.'</button></td>';
		echo '</tr>';


	}#foreach
          ?>
   </form>

?>