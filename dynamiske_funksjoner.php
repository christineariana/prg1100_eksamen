<?php

function listeboksBrukernavn (){
    
    $database = mysqli_connect("localhost", "139565", "Kp/oUrxV", "139565");

        if (mysqli_connect_error()) {

            return true;

        }
    
        else {
            
            $sqlSetning="SELECT * FROM `kunde`ORDER BY `brukernavn`;";
            $sqlResultat=mysqli_query($database,$sqlSetning) or die ("ikke mulig å hente data fra databasen");  
            $antallRader=mysqli_num_rows($sqlResultat); 

    for($r=1;$r<=$antallRader;$r++){
        
        $rad=mysqli_fetch_array($sqlResultat); 
        $ordrenummer=$rad["ordrenummer"];   
        $hotellnavn=$rad["hotellnavn"];  
        $romnummer=$rad["romnummer"];    
        $fra_dato=$rad["fra_dato"]; 
        $til_dato=$rad["til_dato"]; 
        $brukernavn=$rad["brukernavn"]; 

        print("<option value='$brukernavn'>$brukernavn</option>");}

    }

}


function listeboksOrdre (){
    
    $database = mysqli_connect("localhost", "139565", "Kp/oUrxV", "139565");

        if (mysqli_connect_error()) {

            return true;

        }
    
        else {
            
            $brukernavn=$_SESSION["brukernavn"];

            $sqlSetning="SELECT * FROM `bestilling` WHERE brukernavn='$brukernavn' ORDER BY `ordrenummer`;";
            $sqlResultat=mysqli_query($database,$sqlSetning) or die ("ikke mulig å hente data fra databasen");  
            $antallRader=mysqli_num_rows($sqlResultat); 

    for($r=1;$r<=$antallRader;$r++){
        
        $rad=mysqli_fetch_array($sqlResultat); 
        $ordrenummer=$rad["ordrenummer"];   
        $hotellnavn=$rad["hotellnavn"];  
        $romtype=$rad["romtype"];    
        $fra_dato=$rad["fra_dato"]; 
        $til_dato=$rad["til_dato"]; 
        $brukernavns=$rad["brukernavn"]; 

        print("<option value='$ordrenummer'>$ordrenummer</option>");}

    }

}


function listeboksSted (){
    
    $database = mysqli_connect("localhost", "139565", "Kp/oUrxV", "139565");

        if (mysqli_connect_error()) {

            return true;

        }
    
        else {
            
            $sqlSetning="SELECT * FROM `hotell`ORDER BY `sted`;";
            $sqlResultat=mysqli_query($database,$sqlSetning) or die ("ikke mulig å hente data fra databasen");  
            $antallRader=mysqli_num_rows($sqlResultat); 

    for($r=1;$r<=$antallRader;$r++){
        
        $rad=mysqli_fetch_array($sqlResultat); 
        $hotellnavn=$rad["hotellnavn"];    
        $sted=$rad["sted"];

        print("<option value='$sted'>$sted</option>");}

    }

}

function listeboksHotell (){
    
    $database = mysqli_connect("localhost", "139565", "Kp/oUrxV", "139565");

        if (mysqli_connect_error()) {

            return true;

        }
    
        else {
            
            $sqlSetning="SELECT * FROM `hotellromtype` ORDER BY `hotellnavn`;";
            $sqlResultat=mysqli_query($database,$sqlSetning) or die ("ikke mulig å hente data fra databasen");  
            $antallRader=mysqli_num_rows($sqlResultat); 

    for($r=1;$r<=$antallRader;$r++){
        
        $rad=mysqli_fetch_array($sqlResultat); 
        $hotellnavn=$rad["hotellnavn"];    
        $romtype=$rad["romtype"];
        $antall=$rad["antall"];

        print("<option value='$hotellnavn'>$hotellnavn</option>");}

    }

}

function listeboksHotellNavn (){
    
    $database = mysqli_connect("localhost", "139565", "Kp/oUrxV", "139565");

        if (mysqli_connect_error()) {

            return true;

        }
    
        else {
            
            $sqlSetning="SELECT * FROM `hotell` ORDER BY `hotellnavn`;";
            $sqlResultat=mysqli_query($database,$sqlSetning) or die ("ikke mulig å hente data fra databasen");  
            $antallRader=mysqli_num_rows($sqlResultat); 

    for($r=1;$r<=$antallRader;$r++){
        
        $rad=mysqli_fetch_array($sqlResultat); 
        $hotellnavn=$rad["hotellnavn"];    
        $sted=$rad["sted"];

        print("<option value='$hotellnavn'>$hotellnavn</option>");}

    }
}


function listeboksRomtype (){
    
    $database = mysqli_connect("localhost", "139565", "Kp/oUrxV", "139565");

        if (mysqli_connect_error()) {

            return true;

        }
    
        else {
            
            $sqlSetning="SELECT * FROM romtype ORDER BY romtype;";
            $sqlResultat=mysqli_query($database,$sqlSetning) or die ("ikke mulig å hente data fra databasen");  
            $antallRader=mysqli_num_rows($sqlResultat); 

    for($r=1;$r<=$antallRader;$r++){
        
        $rad=mysqli_fetch_array($sqlResultat); 
        $romtype=$rad["romtype"];    

        print("<option value='$romtype'>$romtype</option>");}

    }
}
function listeboksHotellrom(){
    
    $database = mysqli_connect("localhost", "139565", "Kp/oUrxV", "139565");

        if (mysqli_connect_error()) {

            return true;

        }
    
        else {
            
            $sqlSetning="SELECT * FROM hotellromtype ORDER BY hotellnavn;";
            $sqlResultat=mysqli_query($database,$sqlSetning) or die ("ikke mulig å hente data fra databasen");  
            $antallRader=mysqli_num_rows($sqlResultat); 

    for($r=1;$r<=$antallRader;$r++){
        
        $rad=mysqli_fetch_array($sqlResultat); 
        $hotellnavn=$rad["hotellnavn"];    
        $romtype=$rad["romtype"];
        $antall=$rad["antall"];

        print("<option value='$hotellnavn'>$hotellnavn</option>");}

    }
}

function listeboksRom(){
    
    $database = mysqli_connect("localhost", "139565", "Kp/oUrxV", "139565");

        if (mysqli_connect_error()) {

            return true;

        }
    
        else {
            
            $sqlSetning="SELECT * FROM rom ORDER BY romnummer;";
            $sqlResultat=mysqli_query($database,$sqlSetning) or die ("ikke mulig å hente data fra databasen");  
            $antallRader=mysqli_num_rows($sqlResultat); 

    for($r=1;$r<=$antallRader;$r++){
        
        $rad=mysqli_fetch_array($sqlResultat); 
        $hotellnavn=$rad["hotellnavn"];    
        $romtype=$rad["romtype"];
        $romnummer=$rad["romnummer"];

        print("<option value='$romnummer'>$romnummer</option>");}

    }
}

function listeboksRomtypetilhotell (){
    
    $database = mysqli_connect("localhost", "139565", "Kp/oUrxV", "139565");

        if (mysqli_connect_error()) {

            return true;

        }
    
        else {
            
            $sqlSetning="SELECT * FROM hotellromtype ORDER BY romtype;";
            $sqlResultat=mysqli_query($database,$sqlSetning) or die ("ikke mulig å hente data fra databasen");  
            $antallRader=mysqli_num_rows($sqlResultat); 

    for($r=1;$r<=$antallRader;$r++){
        
        $rad=mysqli_fetch_array($sqlResultat); 
        $romtype=$rad["romtype"];    

        print("<option value='$romtype'>$romtype</option>");}

    }
}
?>