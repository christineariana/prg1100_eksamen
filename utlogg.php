<?php     

$database = mysqli_connect("localhost", "139565", "Kp/oUrxV", "139565");

session_start();
unset($_SESSION['brukernavn']);
unset($_SESSION['passord']);
session_destroy();  /* sesjonen avsluttes */

print("<meta http-equiv='refresh' content='0;url=index.php'>");
/* redirigering tilbake til innloggings-siden (innlogging.php) */
/* eller header("Location: index.php"); */



?>
