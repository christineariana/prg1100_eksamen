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

    <h3>Slett hotellromtype</h3>
    <form method="post" action="">

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


<script>
function bekreft(){
    return confirm ("Er du sikker?");
    }
</script>

<?php


if (isset($_POST ["finnHotell"])) {

    $database = mysqli_connect("localhost", "139565", "Kp/oUrxV", "139565");
    $hotell=$_POST["hotellnavn"]; 

    $sqlSetning="SELECT * FROM hotellromtype WHERE hotellnavn='$hotell';";
    $sqlResultat=mysqli_query($database,$sqlSetning) or die ("Ikke mulig å hente data fra databasen");

    $rad=mysqli_fetch_array($sqlResultat);

    $hotellnavn=$rad["hotellnavn"];  
    $romtype=$rad["romtype"];
    $antall=$rad["antall"];

    print("<br />");
    print ("<form method='POST' action='' id='endreHotell' name='endreHotell'  onSubmit='bekreft()'>");
    print ("Hotell <input type='text' value='$hotell' name='hotellnavn' id='hotellnavn' readonly /> <br />");                  
    print ("Romtype <select name='romtype' id='romtype'>");                        
    
    listeboksRomtypetilhotell($romtype);

    print ("</select> <br/>");
    print ("<input type='submit' value='Slett romtype' name='slettType' id='slettType'>");
    print ("</form>");}
            
    if (isset($_POST ["slettType"])) {
        
        $hotellnavn=$_POST ["hotellnavn"];
        $romtype=$_POST ["romtype"];
        
        $database = mysqli_connect("localhost", "139565", "Kp/oUrxV", "139565");  
        $sqlSetning="DELETE FROM hotellromtype WHERE romtype='$romtype' AND hotellnavn='$hotellnavn';";
        $sqlResultat = mysqli_query($database, $sqlSetning) or die ("Ikke mulig å koble til databasen.");

                print ("$romtype er nå slettet fra $hotellnavn.<br/>");
            }

            print ("</div>");
        }
    ?>