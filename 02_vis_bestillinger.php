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

$sqlSetning = "SELECT * FROM bestilling ORDER BY ordrenummer;";
$sqlResultat = mysqli_query($database, $sqlSetning) or die ("Ikke mulig å koble til database");
$antallRader = mysqli_num_rows($sqlResultat);

print ("<h3> Registrerte bestillinger</h3>");  
print ("<table border=1 class=\"visliste\">"); 
print ("<tr>
        <th align=left> Ordrenummer </th> 
        <th align=left> Hotell </th> 
        <th align=left> Romnummer </th> 
        <th align=left> Ankomst </th> 
        <th align=left> Avreise </th> 
        <th align=left> Kunde </th> 
        </tr>"); 

for ($r=1;$r<=$antallRader;$r++){
    
    $rad=mysqli_fetch_array($sqlResultat);  

    $ordrenummer=$rad["ordrenummer"];
    $hotellnavn=$rad["hotellnavn"]; 
    $romnummer=$rad["romnummer"]; 
    $ankomst=$rad["fra_dato"]; 
    $avreise=$rad["til_dato"]; 
    $kunde=$rad["brukernavn"];  

    print ("<tr> 
            <td> $ordrenummer </td> 
            <td> $hotellnavn </td> 
            <td> $romnummer </td> 
            <td> $ankomst </td> 
            <td> $avreise </td> 
            <td> $kunde </td> 
            </tr>"); 

}
    print ("</table>");  


    print ("</div>");
}
?>