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

    <h3>Endre antall romtyper</h3>
    <form method = "post" class= "grid" id="endreHotell" name="endreHotell">

        <table>
                <tr>
                    <tr>
                    <td>Hotell</td>
                    <td><select name="hotellnavn" id="hotellnavn">
                            <option><?php include_once("dynamiske_funksjoner.php"); listeboksHotellnavn();?> 
                            </option>
                             </select> </td>
                    </tr>  

                
                <tr>
                    <td><input type="submit" value="Finn hotell" name="finnHotell" id="finnHotell" required></td>  
                </tr> 
        </table>

    </form> 




<?php    

$database = mysqli_connect("localhost", "139565", "Kp/oUrxV", "139565");

if (mysqli_connect_error()) {

    alert ("Ingen kontakt med server.");

} 

if (isset($_POST ["finnHotell"])) {
    
    $hotell=$_POST["hotellnavn"]; 
    $sqlSetning="SELECT * FROM hotellromtype WHERE hotellnavn='$hotell';";
    $sqlResultat=mysqli_query($database,$sqlSetning) or die ("Ikke mulig å hente data fra databasen");

    $rad=mysqli_fetch_array($sqlResultat);

    $hotellnavn=$rad["hotellnavn"];  
    $romtype=$rad["romtype"];
    $antall=$rad["antall"];

    print("<br />");
    print ("<form method='POST' action='' id='endreHotell' name='endreHotell'>");
    print ("Hotell <input type='text' value='$hotell' name='hotellnavn' id='hotellnavn' readonly /> <br />");                  
    print ("Romtype <select name='romtype' id='romtype'>");                        
    
    listeboksRomtype($romtype);

    print ("</select> <br/>");
    print ("Antall rom <input type='text' value='$antall' name='antall' id='antall' required /> <br />");
    print ("<input type='submit' value='Endre antall' name='endreAntall' id='endreAntall'>");
    print ("</form>");}
            

    if (isset($_POST ["endreAntall"])) {
        
        $hotellnavn=$_POST ["hotellnavn"];
        $romtype=$_POST ["romtype"];
        $antall=$_POST ["antall"];

        $sqlSetning="SELECT * FROM hotellromtype WHERE rom='$hotellnavn';";
        $sqlResultat=mysqli_query($database,$sqlSetning) or die ("Ikke mulig å hente data fra databasen");
    
        $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
    
        $hotell=$rad["hotellnavn"]; 
        $rom=$rad["romtype"];
        $antall_rom=$rad["antall"];
        
        $database = mysqli_connect("localhost", "139565", "Kp/oUrxV", "139565");  
        $sqlSetning="UPDATE hotellromtype SET antall='$antall_rom' WHERE hotellnavn='$hotell';";
        $sqlResultat = mysqli_query($database, $sqlSetning) or die ("Ikke mulig å koble til databasen.");

                print ("$hotellnavn har nå oppdatert informasjon. <br/> Informasjon registrert nå er:<br/>");
                print ("<table>");
                print ("<tr>Hotellnavn: $RegHotellnavn </tr><br/>");
                print ("<tr>Sted: $RegSted </tr><br/>");
                print ("</table>");
            }

            print ("</div>");
        }
    ?>
    

    