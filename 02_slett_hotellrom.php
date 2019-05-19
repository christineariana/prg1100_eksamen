<?php  

session_start();
@$innloggetBruker=$_SESSION["brukernavn"]; 

    if (!$innloggetBruker)  /* bruker er ikke innlogget */{
        print("Denne siden krever innlogging <br />");
        print("<a href=innlogg_admin.php>Tilbake til innlogging.</a>");
    }
    
    else {
        include("start_admin.html");



?>

<div class="kontaktskjema">

<h3>Slett rom</h3>

<form method="post" action="" onSubmit="bekreft()">
    
Romnummer  <select name="rom" id="rom">
                <option><?php 
                include_once("dynamiske_funksjoner.php"); listeboksHotellrom();
                ?> </option>
            </select> 

            <input type="submit" value="Slett rom" name="slettRom" id="slettRom" /> 
</form>


<script>
function bekreft(){
    return confirm ("Er du sikker?");
    }
</script>
<?php




if (isset($_POST["slettRom"])) {
    
    $database = mysqli_connect("localhost", "139565", "Kp/oUrxV", "139565");

        if (mysqli_connect_error()) {

     alert ("Ingen kontakt med server.");

} 

    $RegRom =$_POST["rom"];


    if(!$RegHotell){

        print ("Hotell må fylles ut.");
    }

    else {

        $sqlSetning = "DELETE FROM rom WHERE romnummer='$RegRom';";
        $sqlResultat = mysqli_query($database, $sqlSetning) or die ("Ikke mulig å koble til databasen.");
        
            print ("<p>$RegRom er nå slettet.</p>");

        }

    }

    print ("</div>");
}
?>