<?php  
    
    include("start_minside.html");

?>


<div class="innlogging">

<h3>Book overnatting</h3>
<form action="" id="book"name="book" method="post">

<table class="center">
    <tr>
        <td>Hotell</td>
                    <td><select name="hotellnavn" id="hotellnavn">
                            <option><?php include_once("dynamiske_funksjoner.php"); listeboksHotellNavn();?> 
                            </option>
                             </select> </td>
    </tr>  
    <tr>
        <td>Romtype</td>
                    <td><select name="romtype" id="romtype">
                            <option><?php include_once("dynamiske_funksjoner.php"); listeboksRomtype()?> 
                            </option>
                             </select> </td>
    </tr>  
    <tr>
        <td>Ankomst </td>
                    <td><input id='datepicker1' name='datepicker1'> </td> <br />
    </tr>
    <tr>
        <td>Avreise </td>
                    <td><input id='datepicker2' name='datepicker2'> </td> <br />
    </tr>
    <tr>
        <td><input type="submit" name="bookHotell" id="bookHotell" value="Se tilgjengelighet!"> </td>
        <td><input type="reset" name="nullstill" id="nullstill" value="Nullstill"> <br /> </td>
    </tr>
</tr>
</table>
</form>

<script type="text/javascript">
  $( function() {
    $( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );
</script> 

<script type="text/javascript">
  $( function() {
    $( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );
</script> 

<?php

if (isset($_POST ["bookHotell"])){
    
    $database = mysqli_connect("localhost", "139565", "Kp/oUrxV", "139565");

    $hotellnavn=$_POST ["hotellnavn"];
    $romtype=$_POST["romtype"]; 
    $ankomst=$_POST["datepicker1"]; 
    $avreise=$_POST["datepicker2"]; 
    
    if (!$hotellnavn || !$romtype || !$ankomst || !$avreise) {
        
        print ("Alle felt må fylles ut. <br />");
    }
        
    else { 
        
        $sqlSetning="SELECT rom.hotellnavn, rom.romtype, rom.romnummer FROM rom left join bestilling on bestilling.romnummer = rom.romnummer
        WHERE ('$ankomst' < bestilling.til_dato and rom.romtype like '$romtype') or ('$avreise' > bestilling.fra_dato and rom.romtype like '$romtype')
        ORDER BY rom.romnummer;";
        $sqlResultat=mysqli_query($database,$sqlSetning) or die ("ikke mulig å hente data fra databasen");
        
    if (mysqli_num_rows($sqlResultat)!=0){
        
        print ("Vi har ledig rom i denne perioden! </br> <a href='01_registrere_minside.php'>Registrer deg for å booke rom i dag!</a> ");
    
    } else {

        print ("Vi har dessverre ingen rom ledig i denne perioden.");
        }
    }
}
        
        print ("</div>");
    
?>