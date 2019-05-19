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

    <h3>Endre informasjon om hotellrom</h3>
    <form method = "post" class= "grid" id="endreHotellrom" name="endreHotellrom">

        <table>
                <tr>
                    <tr>
                    <td>Romnummer</td>
                    <td><select name="romnummer" id="romnummer">
                            <option><?php include_once("dynamiske_funksjoner.php"); listeboksRom();?> 
                            </option>
                             </select> </td>
                    </tr>  
                
                <tr>
                    <td><input type="submit" value="Finn rom" name="finnRom" id="finnRom" required></td>  
                </tr> 
        </table>

    </form> 

<?php    

$database = mysqli_connect("localhost", "139565", "Kp/oUrxV", "139565");

if (mysqli_connect_error()) {

    alert ("Ingen kontakt med server.");

} 

if (isset($_POST ["finnRom"])) {
    
    $romnummer=$_POST["romnummer"];  
    $sqlSetning="SELECT * FROM rom WHERE romnummer='$romnummer';";
    $sqlResultat=mysqli_query($database,$sqlSetning) or die ("Ikke mulig å hente data fra databasen");

    $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */

    $hotellnavn=$rad["hotellnavn"];  
    $romtype=$rad["romtype"];
    $romnummer=$rad["romnummer"];

    print("<br />");
    print ("<form method='POST' action='' id='endreHotellrom' name='endreHotellrom'>");
    print ("Hotellnavn <input type='text' value='$hotellnavn' name='hotellnavn' id='hotellnavn' required /> <br />");
    print ("Romtype <input type='text' value='$romtype' name='romtype' id='romtype' required /> <br />");
    print ("Romnummer <input type='text' value='$romnummer' name='romnummer' id='romnummer' readonly /> <br />");

    print ("<input type='submit' value='Endre rominformasjonen' name='endreHotellrominfo' id='endreHotellrominfo'>");
    print ("</form>");}
            

    if (isset($_POST ["endreHotellrominfo"])) {

        $database = mysqli_connect("localhost", "139565", "Kp/oUrxV", "139565");

        $romnummer=$_POST["romnummer"];  
        $RegHotellnavn=$_POST ["hotellnavn"];
        $RegRomtype=$_POST ["romtype"];

        $sqlSetningen="SELECT * FROM rom WHERE romnummer='$romnummer';";
        $sqlResultatet=mysqli_query($database,$sqlSetningen) or die ("Ikke mulig å hente data fra databasen");
    
        $rad=mysqli_fetch_array($sqlResultatet);  /* ny rad hentet fra spørringsresultatet */
    
        $hotellnavn=$rad["hotellnavn"];  
        $romtype=$rad["romtype"];
        $romnummer=$rad["romnummer"];
        
        $database = mysqli_connect("localhost", "139565", "Kp/oUrxV", "139565");  
        $sqlSetning="UPDATE rom SET hotellnavn='$RegHotellnavn', romtype='$RegRomtype' WHERE romnummer='$romnummer';";
        $sqlResultat = mysqli_query($database, $sqlSetning) or die ("Ikke mulig å koble til databasen.");

                print ("<br/> Informasjon om rommet er nå oppdatert.</br> Oppdarert informasjon:<br/>");
                print ("<table>");
                print ("<tr>Hotellnavn: $RegHotellnavn </tr><br/>");
                print ("<tr>Romtype: $RegRomtype </tr><br/>");
                print ("<tr>Romnummer: $romnummer </tr><br/>");
                print ("</table>");
            }

            print ("</div>");
        }
    ?>
    