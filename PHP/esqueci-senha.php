<?php
error_reporting(0);
    include "conecta.php";
    
    function gerar_senha($tamanho, $maiusculas, $minusculas, $numeros, $simbolos){
        $ma = "ABCDEFGHIJKLMNOPQRSTUVYXWZ"; // $ma contem as letras maiúsculas
        $mi = "abcdefghijklmnopqrstuvyxwz"; // $mi contem as letras minusculas
        $nu = "0123456789"; // $nu contem os números
      
        if ($maiusculas){
              // se $maiusculas for "true", a variável $ma é embaralhada e adicionada para a variável $senha
              $senha .= str_shuffle($ma);
        }
      
          if ($minusculas){
              // se $minusculas for "true", a variável $mi é embaralhada e adicionada para a variável $senha
              $senha .= str_shuffle($mi);
          }
      
          if ($numeros){
              // se $numeros for "true", a variável $nu é embaralhada e adicionada para a variável $senha
              $senha .= str_shuffle($nu);
          }
          // retorna a senha embaralhada com "str_shuffle" com o tamanho definido pela variável $tamanho
          return substr(str_shuffle($senha),0,$tamanho);
      }
   
    $novasenha = gerar_senha(10, true, true, true, true);

    require_once('src/PHPMailer.php');
	require_once('src/SMTP.php');
	require_once('src/Exception.php');

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	$mail = new PHPMailer(true);

	$email = $_POST['emailInstituicao'];

	try {
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'noreply.smartdev@gmail.com';
		$mail->Password = 'smartdevtcc';
		$mail->Port = 587;
		$mail->CharSet = 'UTF-8';

		$mail->setFrom('noreply.smartdev@gmail.com');
		$mail->addAddress($email);

		$mail->isHTML(true);
		$mail->Subject = 'Solicitação para trocar de senha';
        $mail->Body = 'Sua nova senha: '.$novasenha;
		$mail->AltBody = 'Solicitação para trocar de senha';

		if($mail->send()){
            $senhacrip = password_hash ($novasenha , PASSWORD_BCRYPT);
            $sql = "UPDATE ongs SET senha_ong='$senhacrip' WHERE email_ong = '$email'";
            $resultado=pg_query($conecta,$sql);
            $linhas=pg_affected_rows($resultado);
            if ($linhas > 0){ 
                echo "<script type='text/javascript'>alert('Um email com a nova senha foi enviado. Assim que possível, altere sua senha!')</script>";
                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../login.php'>";
            }
            else
            {
                echo "<script type='text/javascript'>alert('Tivemos um problema, tente mais tarde!')</script>";
                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../login.php'>";
                pg_close($conecta);
            }
		} else {
			echo 'Email nao enviado';
		}
	} catch (Exception $e) {
		echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
	}   
?>

