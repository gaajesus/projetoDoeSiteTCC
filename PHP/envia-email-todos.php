<?php
    include "PHP/conecta.php";

	// $bodyEmail = $_SESSION['bodyEmail'];
	if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
	if(!isset($_SESSION['bodyEmail'])) {
		$bodyEmail = $_SESSION['bodyEmail'];
	}

    require_once('src/PHPMailer.php');
	require_once('src/SMTP.php');
	require_once('src/Exception.php');

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	$mail = new PHPMailer(true);

	$bodyEmail = $_POST['bodyEmail'];
	// $nome = $_SESSION['nomeInstituicao'];
	// $email = $_SESSION['emailInstituicao'];


	try {
		$mail->SMTPSecure = 'tls';
		// $mail->SMTPDebug = SMTP::DEBUG_SERVER;
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'noreply.smartdev@gmail.com';
		$mail->Password = 'smartdevtcc';
		$mail->Port = 587;
		$mail->CharSet = 'UTF-8';

        $mail->setFrom('noreply.smartdev@gmail.com');
        $sql = "SELECT email_ong FROM public.ongs WHERE excluido_ong = FALSE;";
        $resultado = pg_query($conecta, $sql);
        while($row = pg_fetch_array($resultado)){
            $emailInst = $row['email_ong'];
			$mail->addBCC($emailInst);
        }
		$mail->isHTML(true);
		$mail->Subject = 'DOE te enviou um e-mail!';
		$mail->Body = $bodyEmail;
		$mail->AltBody = 'DOE te enviou um e-mail!';

		if($mail->send()) {
            echo "<script>alert('E-mail enviado!')</script>";
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../pag_admin.php'>";
		} else {
            echo "<script>alert('E-mail não enviado!')</script>";
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../pag_admin.php'>";
		}
	} catch (Exception $e) {
		echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
	}