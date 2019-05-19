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
                    <h3> Registrer hotell </h3>
                    <tr>
                        <tr>
                        <td>Hotellnavn</td>
                        <td><input name="hotellnavn" type="text" id="hotellnavn"></td>
                        </tr>
                        
                        <tr>
                        <td>Sted</td>
                        <td><input name="sted" type="text" id="sted"></td>
                        </tr>

                    <tr>
                        <td><input type="submit" value="Registrer hotell" name="registrer" id="registrer" required></td>
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
    $RegSted =$_POST["sted"];

    if(!$RegHotell || !$RegSted){

        print ("Begge felt må fylles ut!");
    }

    else {

        $sqlSetning = "SELECT * FROM hotell WHERE hotellnavn='$RegHotell';";
        $sqlResultat = mysqli_query($database, $sqlSetning) or die ("Ikke mulig å koble til databasen.");
        $antallRader = mysqli_num_rows($sqlResultat);
        

        if ($antallRader!=0) {

            print ("Hotellet er allerede registrert.");
        }
        
        else {

            $sqlRegistrer = "INSERT INTO `hotell`(`hotellnavn`, `sted`) VALUES ('$RegHotell', '$RegSted');";
            
            mysqli_query ($database, $sqlRegistrer) or die ("Ikke mulig å registrere hotellet.");

            print ("$RegHotell er nå registrert i databasen.");

        }

    }
}
print ("</div>");
print ("</body>");
}
?>
