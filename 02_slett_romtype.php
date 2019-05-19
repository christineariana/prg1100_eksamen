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

<h3>Slett romtype</h3>

<form method="post" action="" onSubmit="bekreft()">
    
Romtype  <select name="romtype" id="romtype">
                <option><?php 
                include_once("dynamiske_funksjoner.php"); listeboksRomtype();
                ?> </option>
            </select> 

            <input type="submit" value="Slett romtype" name="slettRomtype" id="slettRomtype" /> 
</form>


<script>
function bekreft(){
    return confirm ("Er du sikker?");
    }
</script>
<?php




if (isset($_POST["slettRomtype"])) {
    
    $database = mysqli_connect("localhost", "139565", "Kp/oUrxV", "139565");

        if (mysqli_connect_error()) {

     alert ("Ingen kontakt med server.");

} 

    $RegRomtype =$_POST["romtype"];


    if(!$RegHotell){

        print ("Hotell må fylles ut.");
    }

    else {

        $sqlSetning = "DELETE FROM romtype WHERE romtype='$RegRomtype';";
        $sqlResultat = mysqli_query($database, $sqlSetning) or die ("Ikke mulig å koble til databasen.");
        
            print ("<p>$RegRomtype er nå slettet.</p>");

        }

    }

    print ("</div>");
}
?>