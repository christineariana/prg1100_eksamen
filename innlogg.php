
<!DOCTYPE html>

<head>
<meta charset="utf-8">
        <title>Eksamensoppgave</title>
        <link rel="stylesheet" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   
</head>

<header>
<h1> Logg inn på Min Side </h1>
</header>


<div class="innlogging">

<h3>Innlogging </h3>
<form action="" id="innloggingSkjema" name="innloggingSkjema" method="post">


<table class="center">
        <tr>
                <tr>
                        <td>Brukernavn </td>
                        <td><input name="brukernavn" type="text" id="brukernavn"> </td><br />
                <tr>
                        <td>Passord </td>
                        <td><input name="passord" type="password" id="passord"  > </td> <br />
                </tr>
                <tr>
                <td><input type="submit" name="logginnKnapp" value="Logg inn"></td>
                <td><input type="reset" name="nullstill" id="nullstill" value="Nullstill"> <br /> </td>
                </tr>
        </tr>
</table>
                
</form> 

<h3>Ny bruker? </h3>
<a href="01_registrere_minside.php">Registrer deg her</a> <br /> <br />

<?php

function sjekkBrukernavnPassord($brukernavn,$passord){

        $database = mysqli_connect("localhost", "139565", "Kp/oUrxV", "139565");
        $brukernavn = $_POST["brukernavn"];
        
        $lovligBruker=true;
        $sqlSetning="SELECT * FROM kunde WHERE brukernavn='$brukernavn';";
        $sqlResultat=mysqli_query($database,$sqlSetning);
        
        
        if (!$sqlResultat) {
            
            $lovligBruker=false;
        
        } 
        
        else {
            
            $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
            $lagretBrukernavn=$rad["brukernavn"];
            $lagretPassord=$rad["passord"];  /* brukernavn og passord hentet fra databasen */
            
            if($brukernavn!=$lagretBrukernavn ||  $passord!=$lagretPassord) {
                
                $lovligBruker=false;  
                
            }
        }
        
        return $lovligBruker;
    
    }
    

if (isset($_POST ["logginnKnapp"])){
    
    $database = mysqli_connect("localhost", "139565", "Kp/oUrxV", "139565");

    $brukernavn=$_POST ["brukernavn"];
    $passord=$_POST["passord"];  
    
    if (!sjekkBrukernavnPassord($brukernavn,$passord))  /* brukernavn og passord er ikke korrekt */{
        
        print("Feil brukernavn/passord <br />");
    
    } else  /* brukernavn og passord er korrekt */{
    
        session_start();
        $_SESSION["brukernavn"]=$brukernavn;  /* brukernavn lagt inn i session-variabelen */
        
        print("<meta http-equiv='refresh' content='0;url=00_bestille_hotell.php'>");/* redirigering til hoved-siden (hoved.php) */
        }
}

?>

