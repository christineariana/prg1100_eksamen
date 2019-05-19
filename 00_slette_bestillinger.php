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

<div class="kontaktskjema">

<h3>Slett bestilling</h3>

<form method="post" action="" onSubmit="bekreft()">
                <tr>
                    <td>Bestilling</td>
                    <td><select name="ordrenummer" id="ordrenummer"> 
                                <option><?php include_once("dynamiske_funksjoner.php"); listeboksOrdre();?> </option>
                            </select>  <br/>
                        </td>
                </tr>

            <input type="submit" value="Slett bestilling" name="slettBestilling" id="slettBestilling" /> 
</form>


<script>
function bekreft(){
    return confirm ("Er du sikker?");
    }
</script>
<?php


if (isset($_POST["slettBestilling"])) {
    
    $database = mysqli_connect("localhost", "139565", "Kp/oUrxV", "139565");

        if (mysqli_connect_error()) {

     alert ("Ingen kontakt med server.");

} 

    $ordrenummer =$_POST["ordrenummer"];


    if(!$ordrenummer){

        print ("Hotell må fylles ut.");
    }

    else {

        $sqlSetning = "DELETE FROM bestilling WHERE ordrenummer='$ordrenummer';";
        $sqlResultat = mysqli_query($database, $sqlSetning) or die ("Ikke mulig å koble til databasen.");
        
            print ("<p>Bestilling med ordrenummer $ordrenummer er nå slettet.</p>");

        }

    }

    print ("</div>");

}

?>