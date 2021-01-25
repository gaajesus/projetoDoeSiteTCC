<?php
require_once('src/PHPMailer.php');
require_once('src/SMTP.php');
require_once('src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

$nome = $_POST['nomeInstituicao'];
$cidade = $_POST['cidadeInstituicao'];
$email = $_POST['emailInstituicao'];
$endereco = $_POST['enderecoInstituicao'];
$cnpj = $_POST['cnpjInstituicao'];
$celular = $_POST['celularInstituicao'];
$cep = $_POST['cepInstituicao'];

try {
	// $mail->SMTPDebug = SMTP::DEBUG_SERVER;
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->Username = 'noreply.smartdev@gmail.com';
	$mail->Password = 'smartdevtcc';
	$mail->Port = 587;
	$mail->CharSet = 'UTF-8';
	
	$mail->setFrom('noreply.smartdev@gmail.com');
	$mail->addAddress('smartdevcti@gmail.com');
	$mail->isHTML(true);

	$mail->Subject = 'Nova pendência de cadastro!';
    $mail->Body = 'A instituição '.$nome.' cadastrou-se no app!<br><br>'. 
    'Segue os dados para confirmar a autenticidade:<br><br>'. 
    'Nome: '.$nome.'<br>'.
    'CNPJ: '.$cnpj.'<br>'. 
    'E-mail: '.$email.'<br>'.
    'Celular: '.$celular.'<br>'. 
    'CEP: '.$cep.'<br>'.  
    'Cidade: '.$cidade.'<br>'. 
    'Endereço: '.$endereco.'<br>';
    $mail->AltBody = 'Nova pendência de cadastro!';

} catch (Exception $e) {
	echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
}
?>