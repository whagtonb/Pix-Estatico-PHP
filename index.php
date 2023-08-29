<?php


    require __DIR__.'/vendor/autoload.php';

    use \App\Pix\Payload;
    use Mpdf\QrCode\QrCode;
    use Mpdf\QrCode\Output;

//INSTANCIA PRINCIPAL DO PAYLOAD PIX
    $obPayload = (new Payload)->setPixkey('chavepix') //CHAVE PIX 
                              ->setDescription('descrição do pagamento') // @string QUALQUER NOME
                              ->setMerchantName('NOME DO DONO DA CONTA DESTINO') //@string COMPLETO DO DONO DA CONTA QUE VAI RECEBER
                              ->setMerchantCity('CIDADE DO DONO DA CONTA DESTINO ') //@string CIDADE SEM ACENTO E MAIUSCULA
                              ->setAmount('VALOR') //@double NÚMERO COM VÍRGULA TIRAR ASPAS
                              ->setTxid('ID PARA BANCO DE DADOS');  //@string ID DA TRANSLAÇÃO PARA SALVAR NO BANCO                       

//CÓDIGO DE PAGAMENTO PIX
$payloadQrCode = $obPayload->getPayload();

//QRCODE
$obQrCode = new Qrcode($payloadQrCode);

//IMAGEM QR CODE
$image = (new Output\Png)->output($obQrCode,400);


//header('Content-type: image/png');
//echo $image;

//echo"<pre>";
//print_r($payloadQrCode);
//echo "<pre>"; 


?>
<center><h1>EXEMPLO DE GERAÇÃO DE PAGAMENTO PIX ESTÁTICO<h1></center>
<center><h2>QR CODE PIX<h2></center>

<center><img src="data:image/png;base64, <?=base64_encode($image)?> "></center>

<br><br>

<center>Código pix: <br></center>
<center><strong><?=$payloadQrCode?></strong></center>