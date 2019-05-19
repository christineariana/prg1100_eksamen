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

    <h3>Endre romtype</h3>
    <form method = "post" class= "grid" id="endreRomtype" name="endreRomtype">

        <table>
                <tr>
                    <tr>
                    <td>Romtype</td>
                    <td><select name="romtype" id="romtype">
                            <option><?php include_once("dynamiske_funksjoner.php"); listeboksRomtype();?> 
                            </option>
                             </select> </td>
                    </tr>  
            
                <tr>
                    <td><input type="submit" value="Finn romtype" name="finnRomtype" id="finnRomtype" required></td>  
                </tr> 
        </table>

    </form> 

<?php    

$database = mysqli_connect("localhost", "139565", "Kp/oUrxV", "139565");

if (mysqli_connect_error()) {

    alert ("Ingen kontakt med server.");

} 

if (isset($_POST ["finnRomtype"])) {
    
    $romtype=$_POST ["romtype"];  
    $sqlSetning="SELECT * FROM romtype WHERE romtype='$romtype';";
    $sqlResultat=mysqli_query($database,$sqlSetning) or die ("Ikke mulig å hente data fra databasen");

    $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */

    $romtype=$rad["romtype"];  
    $sengeplass=$rad["sengeplasser"];
    $senger=$rad["antall_senger"];

    print("<br />");
    print ("<form method='POST' action='' id='endreHotell' name='endreHotell'>");
    print ("Romtype <input type='text' value='$romtype' name='romtype' id='romtype' readonly /> <br />");
    print ("Antall sengeplasser: <input type='text' value='$sengeplass' name='sengeplass' id='sengeplass' required /> <br />");
    print ("Antall senger: <input type='text' value='$senger'name='seng' id='seng' required /> <br />");
    print ("<input type='submit' value='Oppdater informasjon' name='endreRomtypeinfo' id='endreRomtypeinfo'>");
    print ("</form>");}
            

    if (isset($_POST ["endreRomtypeinfo"])) {
        
        $sengeplass=$_POST["sengeplass"];
        $senger=$_POST["seng"];
        $romtype=$_POST["romtype"];
        
        $sqlSetning="UPDATE romtype SET sengeplasser='$sengeplass', antall_senger='$senger' WHERE romtype='$romtype';";
        $sqlResultat = mysqli_query($database, $sqlSetning) or die ("Ikke mulig å koble til databasen.");

                print ("Endringen er nå utført.<br/>");

            }

            print ("</div>");
        }
    ?>
    