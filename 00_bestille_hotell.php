<?php  

session_start();
@$innloggetBruker=$_SESSION["brukernavn"]; 

    if (!$innloggetBruker)  /* bruker er ikke innlogget */{
        print("Denne siden krever innlogging <br />");
        print("<a href=index.php>Tilbake til innlogging.</a>");
    }

    else {
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
                    <td><input type='hidden' value='<?php echo $_SESSION["brukernavn"];?>' name='brukernavn'> </td> <br />
    </tr>
    <tr>
        <td><input type="submit" name="bookHotell" id="bookHotell" value="Book hotell"> </td>
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
    $brukernavn=$_POST["brukernavn"]; 
    
    if (!$hotellnavn || !$romtype || !$ankomst || !$avreise) {
        
        print ("Alle felt må fylles ut. <br />");
    }
        
    else { 
        
        $sqlSetning="INSERT INTO bestilling (`ordrenummer`, `hotellnavn`, `romtype`, `fra_dato`, `til_dato`, `brukernavn`) VALUES ('','$hotellnavn','$romtype', '$ankomst', '$avreise', '$brukernavn');";
        mysqli_query($database,$sqlSetning) or die ("Ikke mulig å registrere i databasen.");
        

        print ("Reservesajonen er nå registrert. ");
        }
    }
        
        print ("</div>");
    
    }
?>