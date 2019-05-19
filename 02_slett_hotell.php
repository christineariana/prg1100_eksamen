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

<h3>Slett hotell</h3>

<form method="post" action="" onSubmit="bekreft()">
    
Hotell  <select name="hotellnavn" id="hotellnavn">
                <option><?php 
                include_once("dynamiske_funksjoner.php"); listeboksHotellnavn();
                ?> </option>
            </select> 

            <input type="submit" value="Slett hotell" name="slettHotell" id="slettHotell" /> 
</form>


<script>
function bekreft(){
    return confirm ("Er du sikker?");
    }
</script>
<?php




if (isset($_POST["slettHotell"])) {
    
    $database = mysqli_connect("localhost", "139565", "Kp/oUrxV", "139565");

        if (mysqli_connect_error()) {

     alert ("Ingen kontakt med server.");

} 

    $RegHotell =$_POST["hotellnavn"];


    if(!$RegHotell){

        print ("Hotell må fylles ut.");
    }

    else {

        $sqlSetning = "DELETE FROM hotell WHERE hotellnavn='$RegHotell';";
        $sqlResultat = mysqli_query($database, $sqlSetning) or die ("Ikke mulig å koble til databasen.");
        
            print ("<p>$RegHotell er nå slettet.</p>");

        }

    }

    print ("</div>");

}

?>
