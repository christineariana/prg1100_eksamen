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

$sqlSetning = "SELECT * FROM kunde ORDER BY brukernavn;";
$sqlResultat = mysqli_query($database, $sqlSetning) or die ("Ikke mulig å koble til database");
$antallRader = mysqli_num_rows($sqlResultat);

print ("<h3> Registrerte kunder</h3>");  
print ("<table border=1 class=\"visliste\">"); 
print ("<tr>
        <th align=left> Brukernavn </th> 
        <th align=left> Fornavn </th> 
        <th align=left> Etternavn </th> 
        <th align=left> Email </th> 
        <th align=left> Telefonnr </th> 
        <th align=left> Fødselsdato </th> 
        </tr>"); 

for ($r=1;$r<=$antallRader;$r++){
    
    $rad=mysqli_fetch_array($sqlResultat);  

    $brukernavn=$rad["brukernavn"];
    $fornavn=$rad["fornavn"]; 
    $etternavn=$rad["etternavn"]; 
    $email=$rad["email"]; 
    $telefonnr=$rad["telefonnr"]; 
    $fødselsdato=$rad["fødselsdato"];  

    print ("<tr> 
            <td> $brukernavn </td> 
            <td> $fornavn </td> 
            <td> $etternavn </td> 
            <td> $email </td> 
            <td> $telefonnr </td> 
            <td> $fødselsdato </td> 
            </tr>"); 

}
    print ("</table>");  


    print ("</div>");
}
?>