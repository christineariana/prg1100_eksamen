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


<div class="kontaktskjema">

<h3>Registrer deg som kunde!</h3>


<form action="" id="registrerBrukerSkjema"name="registrerBrukerSkjema" method="post">
<table class="center">
        <tr>
                <tr>
                        <td>Brukernavn </td>
                        <td><input name="brukernavn" type="text" id="brukernavn"> </td><br />
                </tr>
                <tr>
                        <td>Passord </td>
                        <td><input name="passord" type="password" id="passord"  > </td> <br />
                </tr>
                <tr>
                        <td>Fornavn </td>
                        <td><input name="fornavn" type="text" id="fornavn"  > </td> <br />
                </tr>
                <tr>
                        <td>Etternavn </td>
                        <td><input name="etternavn" type="text" id="etternavn"  > </td> <br />
                </tr>
                <tr>
                        <td>Email </td>
                        <td><input name="email" type="text" id="email"  > </td> <br />
                </tr>
                <tr>
                        <td>Telenornummer </td>
                        <td><input name="telefonnr" type="text" id="telefonnr"  > </td> <br />
                </tr>
                <tr>
                        <td>Fødselsdato </td>
                        <td><input id='datepicker' name='datepicker'> </td> <br />
                </tr>
                <tr>
                        <td><input type="submit" name="registrerBrukerKnapp" value="Registrer deg!"> </td>
                        <td><input type="reset" name="nullstill" id="nullstill" value="Nullstill"> <br /> </td>
        </tr>
        </tr>
</table>
                
</form> 

<script type="text/javascript">
  $( function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );
</script> 

<?php

$database = mysqli_connect("localhost", "139565", "Kp/oUrxV", "139565");

if (mysqli_connect_error()) {

 alert ("Ingen kontakt med server.");

} 

if (isset($_POST ["registrerBrukerKnapp"])){
    
    $database = mysqli_connect("localhost", "139565", "Kp/oUrxV", "139565");

    $RegBrukernavn=$_POST ["brukernavn"];
    $RegPassord=$_POST["passord"]; 
    $RegFornavn=$_POST["fornavn"]; 
    $RegEtternavn=$_POST["etternavn"]; 
    $RegEmail=$_POST["email"]; 
    $RegTlfnr=$_POST["telefonnr"]; 
    $RegFdato=$_POST["datepicker"]; 
    
    if (!$RegBrukernavn || !$RegPassord || !$RegFornavn || !$RegEtternavn || !$RegEmail || !$RegTlfnr || !$RegFdato) {
        
        print ("Alle felt må fylles ut <br />");
    }
        
    else { 
        
        $sqlSetning="SELECT * FROM kunde WHERE brukernavn ='$RegBrukernavn';";
        $sqlResultat=mysqli_query($database,$sqlSetning) or die ("Ikke mulig å hente data fra databasen");
        
    if (mysqli_num_rows($sqlResultat)!=0)  /* brukernavnet er registrert fra før */{
        
        print ("Brukeren er allerede registrert. <br />");
    
    } else {
        
        $sqlSetning="INSERT INTO kunde VALUES ('$RegBrukernavn','$RegFornavn','$RegEtternavn','$RegEmail','$RegTlfnr','$RegFdato','$RegPassord');";
        mysqli_query($database,$sqlSetning) or die ("Ikke mulig å registrere i databasen.");
        

        print ("Brukeren: $RegBrukernavn er nå registrert.<br />  <br />");
        print ("<a href='innlogg.php'>Gå til innloggingsside </a>");}}}
        
        print ("</div>");

?>
