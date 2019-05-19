<?php  
    
    include("start_hoved.html");

?>

<div class="kontaktskjema">

    <h3>Vis hoteller i vår kjede</h3>
    <form method = "post" class= "grid" id="finnHotell" name="finnHotell">

        <table>
                <tr>
                    <tr>
                    <td>Sted</td>
                    <td><select name="sted" id="sted">
                            <option><?php include_once("dynamiske_funksjoner.php"); listeboksSted();?> 
                            </option>
                             </select> </td>
                    </tr>  
                
                <tr>
                    <td><input type="submit" value="Vis hotell" name="visHotell" id="visHotell" required></td>  
                </tr> 
        </table>

    </form> 


<?php    

$database = mysqli_connect("localhost", "139565", "Kp/oUrxV", "139565");

if (mysqli_connect_error()) {

    alert ("Ingen kontakt med server.");

}

if (isset($_POST ["visHotell"])) {
    
    $sted=$_POST ["sted"];  
    $sqlSetning= "SELECT * FROM hotell WHERE sted='$sted';";
    $sqlResultat=mysqli_query($database,$sqlSetning) or die ("Ikke mulig å hente data fra databasen");
    $antallRader = mysqli_num_rows($sqlResultat);

    print ("<h3>Våre hoteller i valgt område:</h3>");  
    print ("<table border=1 class=\"visliste\">"); 
    print ("<tr>
    <th align=left> Hotellnavn </th> 
    <th align=left> Sted </th> 

    </tr>"); 

    for ($r=1;$r<=$antallRader;$r++){

        $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */

    $hotellnavn=$rad["hotellnavn"];
    $sted=$rad["sted"];

    print("<br />");
    print(" <tr> 
            <td> $hotellnavn </td> 
            <td> $sted </td> 
            </tr>"); 

    }

    print ("</table>"); 

}

    print ("</div>");

    ?>