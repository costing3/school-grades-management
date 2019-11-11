<?php
	$xemail=$_SESSION['user'];
	$sqlnume    = "SELECT Nume FROM `utilizatori` WHERE `email` = '$xemail';";
	$sqlprenume    = "SELECT Prenume FROM `utilizatori` WHERE `email` = '$xemail';";
	$sqlrol = "SELECT rol FROM `utilizatori` where `email`='$xemail';"; 
	$resultnume = mysql_query($sqlnume, $db);
	$resultprenume = mysql_query($sqlprenume, $db);
	$resultrol = mysql_query($sqlrol, $db);
		while ($row = mysql_fetch_assoc($resultnume)) {
			$xnume=$row['Nume'];
		}mysql_free_result($resultnume);	
		
		while ($row = mysql_fetch_assoc($resultprenume)) {
			$xprenume=$row['Prenume']; 
		}mysql_free_result($resultprenume);	
		
		while ($row = mysql_fetch_assoc($resultrol)) {
			$xrol=$row['rol']; 
		}mysql_free_result($resultrol);	
?>