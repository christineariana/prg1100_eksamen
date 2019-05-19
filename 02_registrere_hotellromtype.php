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



<form method = "post" class="grid">

                <table>
                    <h3> Registrer romtype </h3>
                    <tr>
                        <tr>
                        <td>Hotellnavn</td>
                        <td><input name="hotellnavn" type="text" id="hotellnavn"></td>
                        </tr>
                        
                        <tr>
                        <td>Romtype</td>
                        <td><input name="romtype" type="text" id="romtype"></td>
                        </tr>

                        <tr>
                        <td>Antall</td>
                        <td><input name="antall" type="text" id="antall"></td>
                        </tr>

                    <tr>
                        <td><input type="submit" value="Registrer romtype" name="registrer" id="registrer" required></td>
                        <td><input type="reset" value="Nullstill skjema" name="nullstill" id="nullstill"/></td>   
                    </tr> 
                </table>

</form> 

</div>



<?php


if (isset($_POST["registrer"])) {

    $database = mysqli_connect("localhost", "139565", "Kp/oUrxV", "139565");

        if (mysqli_connect_error()) {

            alert ("Ingen kontakt med server.");

        } 

    $RegHotell =$_POST["hotellnavn"];
    $RegRomtype =$_POST["romtype"];
    $RegAntall =$_POST["antall"];

    if(!$RegHotell || !$RegRomtype || !$RegAntall){

        print ("Begge felt må fylles ut!");
    }

    else {

        $sqlSetning = "SELECT * FROM hotellromtype WHERE hotellnavn='$RegHotell' AND romtype='$RegRomtype';";
        $sqlResultat = mysqli_query($database, $sqlSetning) or die ("Ikke mulig å koble til databasen.");
        $antallRader = mysqli_num_rows($sqlResultat);
        

        if ($antallRader!=0) {

            print ("Romtypen er allerede registrert på dette hotellet.");
        }
        
        else {

            $sqlRegistrer = "INSERT INTO hotellromtype VALUES ('$RegHotell', '$RegRomtype', '$RegAntall');";
            
            mysqli_query ($database, $sqlRegistrer) or die ("Ikke mulig å registrere hotellet.");

            print ("$RegRomtype er nå registrert i databasen på $RegHotell.");

        }

    }
}
print ("</div>");
print ("</body>");
}
?>
