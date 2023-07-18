<?php 
if(isset($_POST['email'])) { 
    $email_to = "pagliaccicesar@hotmail.com"; 
    $email_subject = "Inscripcion a Sacha Academia";   
 
    function died($error) { 
        echo "<h1>Whoops!</h1><h2>There appears to be something wrong with your completed form.</h2>"; 
        echo "<strong><p>The following items are not specified correctly.</p></strong><br />"; 
        echo $error."<br /><br />"; 
        echo "<p>Return to the form and try again.</p><br />";
		echo "<p><a href='index.php'>return to the homepage</a></p>";
        die(); 
    }
    $email_from = $_POST['email']; // required
    $curso = $_POST['curso'];  
    $first_name = $_POST['first_name']; // required 
    $last_name = $_POST['last_name']; // required
    $documento = $_POST['documento']; // not required
    $ciudad = $_POST['ciudad']; // not required  
    $telephone = $_POST['telephone']; // not required
    $estudio = $_POST['estudio']; // not required
    $alimentacion = $_POST['alimentacion']; // not required
    //$comments = $_POST['comments']; // required //
    $error_message = ""; 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) { 
    $error_message .= '<li><p>La dirección de correo electrónico es incorrecta<p></li>'; 
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/"; 
  if(!preg_match($string_exp,$first_name)) { 
    $error_message .= '<li><p>First name appears to be wrong</p></li>'; 
  }
 
  if(!preg_match($string_exp,$last_name)) { 
    $error_message .= '<li><p>Last name appears to be wrong</p></li>'; 
  }
 
  //if(strlen($comments) < 2) { 
    //$error_message .= '<li><p>Message appears to be incorrect</p></li>'; 
  //}
 
  if(strlen($error_message) > 0) { 
    died($error_message); 
  } 
    $email_message = "Form details are given below.\n\n"; 

    
    function clean_string($string) { 
      $bad = array("content-type","bcc:","to:","cc:","href"); 
      return str_replace($bad,"",$string); 
    }
    
    $email_message .= "Email Adress: ".clean_string($email_from)."\n";
    $email_message .= "Curso: ".clean_string($curso)."\n";
    $email_message .= "First Name: ".clean_string($first_name)."\n"; 
    $email_message .= "Last Name: ".clean_string($last_name)."\n";
    $email_message .= "Documento: ".clean_string($documento)."\n";
    $email_message .= "Ciudad: ".clean_string($ciudad)."\n";     
    $email_message .= "Telefono: ".clean_string($telephone)."\n";
    $email_message .= "Estudio: ".clean_string($estudio)."\n";
    $email_message .= "Alimentacion: ".clean_string($alimentacion)."\n";
    //$email_message .= "Comments: ".clean_string($comments)."\n";//
 
$headers = 'From: '.$email_from."\r\n". 
'Reply-To: '.$email_from."\r\n" . 
'X-Mailer: PHP/' . phpversion(); 
@mail($email_to, $email_subject, $email_message, $headers);   
?>

<?php
header("Location: https://www.pagliacci.ar/form.html"); // Redirecionamos a Baulphp
exit(); //terminamos la ejecución del script php, ya que si redirecionamos ya no nos interesa seguir con el codigo PHP anterior.
 
//<!-- include your own success html here --> 
//<!--<h1 style="backgrund-color: red">Thank you for your message!</h1> <h2>We will contact you as soon as possible.</h2>-->
//<br>//
//<br>//

//<button><a href="./index.html">Home</a></button> 
 
//<?php 
}
 //?>