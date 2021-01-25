<?php
error_reporting(0);
	require_once('src/PHPMailer.php');
	require_once('src/SMTP.php');
	require_once('src/Exception.php');

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	$mail = new PHPMailer(true);

	$nome = $_POST['nomeInstituicao'];
	$email = $_POST['emailInstituicao'];

	try {
		$mail->isSMTP();
		$mail->SMTPSecure = 'tls';
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'noreply.smartdev@gmail.com';
		$mail->Password = 'smartdevtcc';
		$mail->Port = 587;
		$mail->CharSet = 'UTF-8';

		$mail->setFrom('noreply.smartdev@gmail.com');
		$mail->addBCC($email);

		$mail->isHTML(true);
		$mail->Subject = 'Cadastro realizado com sucesso!';
		$mail->Body = 'Seu cadastro no aplicativo DOE foi concluído com sucesso!<br>
		Aguarde enquanto confirmamos a autenticidade da instituição '.$nome.'!';
		$mail->AltBody = 'Cadastro realizado com sucesso';

		if($mail->send()) {
			echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../login.php'>";
			echo "<script>alert('Cadastro realizado com sucesso. Um e-mail foi enviado para você!')</script>";
		} else {
			echo "<script>alert('Erro ao cadastrar!')</script>";
		}
	} catch (Exception $e) {
		echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
	}
?>