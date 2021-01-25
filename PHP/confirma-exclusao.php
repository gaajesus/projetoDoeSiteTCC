
<?php
 echo "<script type='text/javascript'>alert('Ocorreu um erro!')</script>";
    include "PHP/conecta.php";

	// $bodyEmail = $_SESSION['bodyEmail'];
if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }	

	

    require_once('src/PHPMailer.php');
	require_once('src/SMTP.php');
	require_once('src/Exception.php');

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;


        $mail = new PHPMailer(true);

            if($_SESSION['logou'] != "s"){
                echo '<script>alert("faça login ou cadastre-se para continuar!");
                window.location.href="login.php";
                </script>';
}
            else{
                $id_exclui = $_SESSION['id'];
                }


                            $sql = "SELECT email_ong from ongs WHERE id_ong = $id_exclui";
                            $resultado = pg_query($conecta, $sql);
                            $row = pg_fetch_array($resultado);
                            $email_ong = $row['email_ong'];
                   
              

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
        $mail->addBCC($email_ong);
		$mail->isHTML(true);
		$mail->Subject = 'DOE te enviou um e-mail!';
		$mail->Body = 'Sua conta no aplicativo DOE foi excluída. Agradecemos a experiência!';
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