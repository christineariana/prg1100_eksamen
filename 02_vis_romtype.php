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

$sqlSetning = "SELECT * FROM romtype ORDER BY romtype;";
$sqlResultat = mysqli_query($database, $sqlSetning) or die ("Ikke mulig å koble til database");
$antallRader = mysqli_num_rows($sqlResultat);

print ("<h3> Registrerte rom</h3>");  
print ("<table border=1 class=\"visliste\">"); 
print ("<tr>
        <th align=left> Romtype </th> 
        <th align=left> Sengeplasser </th> 
        <th align=left> Antall senger </th> 
        </tr>"); 

for ($r=1;$r<=$antallRader;$r++){
    
    $rad=mysqli_fetch_array($sqlResultat);  

    $romtype=$rad["romtype"]; 
    $sengeplass=$rad["sengeplasser"]; 
    $antall=$rad["antall_senger"]; 

    print ("<tr> 
            <td> $romtype </td> 
            <td> $sengeplass </td> 
            <td> $antall </td> 
            </tr>"); 

}
    print ("</table>");  


    print ("</div>");
    }
?>