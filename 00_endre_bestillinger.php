<?php  

session_start();
@$innloggetBruker=$_SESSION["brukernavn"]; 

    if (!$innloggetBruker)  /* bruker er ikke innlogget */{
        print("Denne siden krever innlogging <br />");
        print("<a href=index.php>Tilbake til innlogging.</a>");
    }
    
    else {
    include("start_minside.html");

?>

<head>
<meta charset="utf-8">
        <title>Endre bestilling</title>
        <link rel="stylesheet" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   
</head>

<h3>Endre bestilling</h3>

<form method="post" action="" id="endreBestilling" name="endreBestilling">

<table>
                <tr>
                    <td>Bestilling</td>
                    <td><select name="ordrenummer" id="ordrenummer"> 
                                <option><?php include_once("dynamiske_funksjoner.php"); listeboksOrdre();?> </option>
                            </select>  <br/>
                        </td>
                </tr>
                <tr>
                    <td><input type="submit"  value="Finn bestilling" name="finnBestilling" id="finnBestilling"></td>
                </tr>
</table>
</form>


<script type="text/javascript">
  $( function() {
    $( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );
</script> 

<script type="text/javascript">
  $( function() {
    $( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );
</script> 
<?php 

   $database = mysqli_connect("localhost", "139565", "Kp/oUrxV", "139565");

   if (mysqli_connect_error()) {

    alert ("Ingen kontakt med server.");

} 


if (isset($_POST["finnBestilling"])){

    $ordrenummer=$_POST["ordrenummer"]; 

    $sqlSetning="SELECT * FROM `bestilling` WHERE `ordrenummer`=$ordrenummer;";
    $sqlResultat=mysqli_query($database,$sqlSetning) or die ("Ikke mulig å koble til databasen");
    
    $rad=mysqli_fetch_array($sqlResultat); 
    
    $ordrenummer=$rad["ordrenummer"];   
    $hotellnavn=$rad["hotellnavn"];  
    $romtype=$rad["romtype"];    
    $fra_dato=$rad["fra_dato"]; 
    $til_dato=$rad["til_dato"]; 
    $brukernavn=$rad["brukernavn"]; 



    print ("<form method='post' action='' id='endreBestillingSkjema' name='endreBestillingSkjema'>");
    print ("Ordrenummer <input type='text' value='$ordrenummer' name='ordrenummer' id='ordrenummer' readonly /> <br />");
    print ("Hotellnavn <input type='text' value='$hotellnavn' name='hotellnavn' id='hotellnavn' readonly /> <br />");
    print ("Romtype <input type='text' value='$romtype' name='romtype' id='romtype' readonly /> <br />");
    print ("Ankomst <input type='text' value='$fra_dato' name='datepicker1' id='datepicker1' required /> <br />");
    print ("Avreise <input type='text' value='$til_dato' name='datepicker2' id='datepicker2' required /> <br />");
    print ("<input type='submit' value='Endre bestilling' name='endreBestilling' id='endreBestilling'>");
    print ("</form>");

}


if (isset($_POST ["endreBestilling"])){
    
    $ordrenummer=$_POST ["ordrenummer"];
    $hotellnavn=$_POST ["hotellnavn"];
    $romtype=$_POST ["romtype"];
    $fra_dato=$_POST ["datepicker1"];
    $til_dato=$_POST ["datepicker2"];
    
    if (!$fra_dato || !$til_dato){
        print ("Dato for ankomst eller avreise dato må fylles ut.");  

    } else {
        
        $database = mysqli_connect("localhost", "139565", "Kp/oUrxV", "139565");        
        $sqlSetning="UPDATE `bestilling` SET `fra_dato`='$fra_dato',`til_dato`='$til_dato'  WHERE `ordrenummer`='$ordrenummer';";
        mysqli_query($database,$sqlSetning) or die ("Ikke mulig å oppdatere databasen");
        
        print ("Bookingen din er nå oppdatert.<br />");
    }
}
        print ("</div>");

}

?>

