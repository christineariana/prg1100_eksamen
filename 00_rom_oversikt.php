<?php  
    
    include("start_hoved.html");

?>

<div class="kontaktskjema">

<h3>Vis tilgjengelige romtyper på ønsket hotell:</h3>
    <form method = "post" class= "grid" id="finnRomtype" name="finnRomtype">

        <table>
                <tr>
                    <tr>
                    <td>Hotell</td>
                    <td><select name="hotellnavn" id="hotellnavn">
                            <option><?php include_once("dynamiske_funksjoner.php"); listeboksHotell();?> 
                            </option>
                             </select> </td>
                    </tr>  
                
                <tr>
                    <td><input type="submit" value="Vis hotell" name="visRomtype" id="visRomtype" required></td>  
                </tr> 
        </table>

    </form> 


<?php    

$database = mysqli_connect("localhost", "139565", "Kp/oUrxV", "139565");

if (mysqli_connect_error()) {

    alert ("Ingen kontakt med server.");

}

if (isset($_POST ["visRomtype"])) {
    
    $hotellnavn=$_POST ["hotellnavn"];  
    $sqlSetning= "SELECT * FROM hotellromtype WHERE hotellnavn='$hotellnavn';";
    $sqlResultat=mysqli_query($database,$sqlSetning) or die ("Ikke mulig å hente data fra databasen");
    $antallRader = mysqli_num_rows($sqlResultat);

    print ("<h3>Vi har følgende romtyper på hotell $hotellnavn:</h3>");  
    print ("<table border=1 class=\"visliste\">"); 
    print ("<tr>
    <th align=left> Romtype </th> 
    <th align=left> Antall </th> 

    </tr>"); 

    for ($r=1;$r<=$antallRader;$r++){

        $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */

    $romtype=$rad["romtype"];
    $antall=$rad["antall"];

    print("<br />");
    print(" <tr> 
            <td> $romtype </td> 
            <td> $antall </td> 
            </tr>"); 

    }

    print ("</table>"); 

}

    print ("</div>");
    ?>