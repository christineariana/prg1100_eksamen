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
                    <h3> Registrer hotellrom </h3>
                    <tr>
                        <tr>
                        <td>Hotellnavn</td>
                        <td><select name="hotellnavn" id="hotellnavn">
                            <option><?php include_once("dynamiske_funksjoner.php"); listeboksHotellNavn();?> 
                            </option>
                            </select>
                        </td>
                        </tr>
                        <td>Romtype</td>
                        <td>
                        <select name="romtype" id="romtype">
                            <option><?php include_once("dynamiske_funksjoner.php"); listeboksRomtype();?> 
                            </option>
                             </select>
                        </td>
                        </tr>

                        <tr>
                        <td>Romnummer</td>
                        <td><input name="romnummer" type="text" id="romnummer"></td>
                        </tr>

                    <tr>
                        <td><input type="submit" value="Registrer hotellrom" name="registrer" id="registrer" required></td>
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
    $RegRomnummer =$_POST["romnummer"];

    if(!$RegHotell || !$RegRomtype || !$RegRomnummer){

        print ("Begge felt må fylles ut!");
    }

    else {

        $sqlSetning = "SELECT * FROM rom WHERE romnummer='$RegRomnummer';";
        $sqlResultat = mysqli_query($database, $sqlSetning) or die ("Ikke mulig å koble til databasen.");
        $antallRader = mysqli_num_rows($sqlResultat);
        

        if ($antallRader!=0) {

            print ("Hotelletrommet er allerede registrert.");
        }
        
        else {

            $database = mysqli_connect("localhost", "139565", "Kp/oUrxV", "139565");

            $sqlRegistrer = "INSERT INTO rom VALUES ('$RegHotell', '$RegRomtype', '$RegRomnummer');";
            mysqli_query ($database, $sqlRegistrer) or die ("Ikke mulig å registrere rommet.");

            print ("$RegRomnummer på hotell $RegHotell er nå registrert i databasen.");

        }

    }
}
print ("</div>");
print ("</body>");
}
?>
