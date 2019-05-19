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
                        <td>Romtype</td>
                        <td><input name="romtype" type="text" id="romtype"></td>
                        </tr>
                        <tr>
                        <td>Sengeplasser</td>
                        <td><input name="sengeplass" type="text" id="sengeplass"></td>
                        </tr>

                        <tr>
                        <td>Antall senger</td>
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

    $RegRomtype =$_POST["romtype"];
    $RegSengeplass =$_POST["sengeplass"];
    $RegSeng =$_POST["antall"];

    if(!$RegRomtype){

        print ("Feltet må fylles ut!");
    }

    else {

        $sqlSetning = "SELECT * FROM romtype WHERE romtype='$RegRomtype';";
        $sqlResultat = mysqli_query($database, $sqlSetning) or die ("Ikke mulig å koble til databasen.");
        $antallRader = mysqli_num_rows($sqlResultat);
        

        if ($antallRader!=0) {

            print ("Romtypen er allerede registrert.");
        }
        
        else {

            $sqlRegistrer = "INSERT INTO romtype VALUES ('$RegRomtype', '$RegSengeplass', '$RegSeng');";
            
            mysqli_query ($database, $sqlRegistrer) or die ("Ikke mulig å registrere romtypen.");

            print ("$RegRomtype er nå registrert.");

        }

    }
}
print ("</div>");
print ("</body>");
}
?>
