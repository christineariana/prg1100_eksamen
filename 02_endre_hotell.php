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

    <h3>Endre informasjon om hotell</h3>
    <form method = "post" class= "grid" id="endreHotell" name="endreHotell">

        <table>
                <tr>
                    <tr>
                    <td>Hotell</td>
                    <td><select name="hotellnavn" id="hotellnavn">
                            <option><?php include_once("dynamiske_funksjoner.php"); listeboksHotellNavn();?> 
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
    
    $hotellnavn=$_POST ["hotellnavn"];  
    $sqlSetning="SELECT * FROM hotell WHERE hotellnavn='$hotellnavn';";
    $sqlResultat=mysqli_query($database,$sqlSetning) or die ("Ikke mulig å hente data fra databasen");

    $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */

    $hotellnavn=$rad["hotellnavn"];  
    $sted=$rad["sted"];

    print("<br />");
    print ("<form method='POST' action='' id='endreHotell' name='endreHotell'>");
    print ("Hotellnavn <input type='text' value='$hotellnavn' name='hotellnavn' id='hotellnavn' required /> <br />");
    print ("Sted <input type='text' value='$sted' name='sted' id='sted' required /> <br />");

    print ("<input type='submit' value='Endre hotellinformasjonen' name='endreHotellinfo' id='endreHotellinfo'>");
    print ("</form>");}
            

    if (isset($_POST ["endreHotellinfo"])) {
        
        $RegHotellnavn=$_POST["hotellnavn"];
        $RegSted=$_POST["sted"];

        $sqlSetning="SELECT * FROM hotell WHERE hotellnavn='$RegHotellnavn';";
        $sqlResultat=mysqli_query($database,$sqlSetning) or die ("Ikke mulig å hente data fra databasen");
    
        $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
    
        $hotellnavn=$rad["hotellnavn"]; 
        $sted=$rad["sted"];
        
        $database = mysqli_connect("localhost", "139565", "Kp/oUrxV", "139565");  
        $sqlSetning="UPDATE hotell SET hotellnavn='$RegHotellnavn', sted='$RegSted' WHERE hotellnavn='$hotellnavn';";
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
    