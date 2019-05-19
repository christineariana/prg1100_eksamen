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
<?php

$database = mysqli_connect("localhost", "139565", "Kp/oUrxV", "139565");

if (mysqli_connect_error()) {

    alert ("Ingen kontakt med server.");

} 

$sqlSetning = "SELECT * FROM rom ORDER BY hotellnavn;";
$sqlResultat = mysqli_query($database, $sqlSetning) or die ("Ikke mulig å koble til database");
$antallRader = mysqli_num_rows($sqlResultat);

print ("<h3> Registrerte rom</h3>");  
print ("<table border=1 class=\"visliste\">"); 
print ("<tr>
        <th align=left> Hotellnavn </th> 
        <th align=left> Romtype </th> 
        <th align=left> Romnummer </th> 

        </tr>"); 

for ($r=1;$r<=$antallRader;$r++){
    
    $rad=mysqli_fetch_array($sqlResultat);  

    $hotellnavn=$rad["hotellnavn"];
    $romtype=$rad["romtype"]; 
    $romnummer=$rad["romnummer"]; 

    print ("<tr> 
            <td> $hotellnavn </td> 
            <td> $romtype </td> 
            <td> $romnummer </td> 
            </tr>"); 

}
    print ("</table>");  


    print ("</div>");
}
?>