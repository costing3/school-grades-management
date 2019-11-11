<?php
session_start();
require_once("sql/db.php");
require_once("sql/date.php");
if(!($_SESSION['user']) || ($xrol!="adm")) // Acces Neautorizat
	require_once("sql/redirect.php");
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title>Catalog Virtual</title>
		<!-- CSS -->
		<link href="css/top.css" rel="stylesheet" />
		<link href="css/bootstrap.css" rel="stylesheet" />
		<link href="css/style_home.css" rel="stylesheet" />
		<link href="css/fonts/font-awesome.min.css" rel="stylesheet" />
		<link href="css/fonts/font-awesome-animation.css" rel="stylesheet" />
		<link href="css/butoane.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="css/alert.css" />
		<link rel="stylesheet" type="text/css" href="css/expand.css" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<!-- //CSS -->
		<style>
			.button {
				background-color: #0066ff;
				border: none;
				color: white;
				text-align: center;
				text-decoration: none;
				display: inline-block;
				font-size: 16px;
				margin: 4px 2px;
				cursor: pointer;
			}
			.button1 {padding: 10px 24px;}
			.button2 {padding: 12px 28px;}
			.button3 {padding: 14px 40px;}
			.button4 {padding: 32px 16px;}
			.button5 {padding: 16px;}
		</style>
	</head>
	<body>
			 <div class="meniu meniu-invers meniu-fixat-top">
			<!-- Crosshair  <div class="col-md-12 col-sm-12">
					<a  href="#services-sec">
					 <i class="fa fa-crosshairs fa-5x go-marg"></i> 
						</a> -->
			<div class="container">
				<div class="meniu-sus">
					<button type="button" class="meniu-toggle" data-toggle="2parti" data-target=".meniu-2parti">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="meniu-brand" href="javascript:void(0)">Catalog Virtual</a>
				</div>
				<div class="meniu-2parti 2parti">
					<ul class="nav meniu-nav meniu-right">
						<li><a href="home.php"><!--<img src="img/active.png" width="35px" height="20px"-->PRIMA PAGINĂ</a></li>
						<li><a href="http://cnvnt.ro/">CNV:NT</a></li>
			<!-- Administrator --> 
			<?php
				$admin    = "SELECT email FROM `utilizatori` WHERE `rol` = 'adm'";
				$result = mysql_query($admin, $db);
				while ($row = mysql_fetch_assoc($result)) 
					{if ($row['email']==$_SESSION['user'])
						echo "<li><a href='javascript:void(0)' name='logout'><u>ADMINISTRATOR</u></a></li>";
					}mysql_free_result($result);
				
			?>
			<!-- //Administrator -->
						<li style="float:right"><a href="sql/logout.php" name="logout"><img src="img/logout.png" width="26" height="26" style="margin-top:-4px;"></a></li>
						<li class="dropdown" style>
							<a href="javascript:void(0)" class="dropbtn"><!--Nume-->
			<!-- Utilizator Logat -->
			<?php
				if(!($_SESSION['user']))
				{require_once ("sql/redirect.php");} else 
				{	
					$sql1    = "SELECT Nume FROM `utilizatori` WHERE `email` = '".$_SESSION["user"]."'";
					$sql2    = "SELECT Prenume FROM `utilizatori` WHERE `email` = '".$_SESSION["user"]."'";
					$result1 = mysql_query($sql1, $db);
					$result2 = mysql_query($sql2, $db);
						while ($rand = mysql_fetch_assoc($result1)) {
							echo $row['Nume'],"\n";
						}mysql_free_result($result1);	
						while ($row = mysql_fetch_assoc($result2)) {
							echo $row['Prenume']; 
						}mysql_free_result($result2);	
				}
				$syntax   = "SELECT count(id) FROM clase;";
				$resulth = mysql_query($syntax, $db);
				while ($row = mysql_fetch_assoc($resulth)) {
					$nr=$row['count(id)'];}
				mysql_free_result($resulth);
			?>
			<!-- //Utilizator Logat -->
							</a>
							<div class="dropdown-content">
							  <a href="clasa.php">Profil</a>
							  <a href="#">Clasă</a>
							  <a href="#">Note & Absențe</a>
							  <a href="#">Editare profil</a>
							</div>
						</li>
					</ul>
			   </div>
			</div>
		</div>
		<center>
		<h1 class="g-coloana">  <i class="fa fa-crosshairs "></i>  Panou Administrator: </h1>
		<p style="margin-top:-2.5cm;"></p>
		<a href="#addelevi"><button class="button button3">Adaugă Elevi</button></a>
		<a href="#addclase"><button class="button button3">Adaugă Clase</button></a>
		<a href="#addprofesor"><button class="button button3">Adaugă Profesori</button></a>
		<a href="#changepass"><button class="button button3">Schimbă Parole</button></a>
		<a href="#changemail"><button class="button button3">Schimbă EMail</button></a>
		</center>
		<button onclick="topFunction()" id="myBtn" title="Go to top">Meniu</button>
		<section id="noutati">
			<div class="container">
				<div class="rand "><a id="addclase"></a>
				<h1 class="g-coloana"><i class="fa fa-crosshairs "></i>  Adaugă clase </h1>
					<center><form method="post">
						<div class="rand">
									
									<p style="margin-top:-2cm;">Câmpurile marcate cu <font color="red"><strong>*</strong></font> sunt obligatorii.</p><br>
									<div class="form-group">
									<?php
										if(isset($_POST['submitclasse']))
										{	
											for($i=1;$i<=10 && $ok=1;$i++)
											{	$nr=$_POST["nr$i"];
												$c=$_POST["cls$i"];
												$d=$_POST["drg$i"];
												if(($c!=NULL)&&($d!=NULL) && ($nr!=0))
												{	$sqlclase = mysql_query("INSERT INTO clase (nume,diriginte,elevi) VALUES('$c','$d','$nr');");
													$sqlprof  = mysql_query("INSERT INTO profesori (nume,dirigentie) VALUES('$d','$c');");	
													if($sqlclase) 
													  if($sqlprof)
															require_once("sql/add/success_clase.php");	// OK
														else require_once("sql/add/fail_clase.php"); // Duplicate
													else require_once("sql/add/fail_clase.php"); // Duplicate
														                                           
												}
												else $ok=0;
											}
										}
									?>
									<font color="red"><strong>*</strong></font>Clasa #1:
										<input type="text" class="form-control" required="required" name="cls1" placeholder="Ex. XII R2">
									</div><div class="form-group">
									<font color="red"><strong>*</strong></font>Diriginte #1:
										<input type="text" class="form-control" required="required" name="drg1" placeholder="Ex. Popa Matei">
									</div><div class="form-group">
									<font color="red"><strong>*</strong></font>Număr elevi #1:
										<input type="text" class="form-control" required="required" name="nr1" placeholder="Ex. Popa Matei">
									</div><div class="form-group">
									Clasa #2:
										<input type="text" class="form-control" name="cls2">
									</div><div class="form-group">
									Diriginte #2:
										<input type="text" class="form-control" name="drg2">
									</div><div class="form-group">
									Număr elevi #2:
										<input type="text" class="form-control" name="nr2">
									</div><div class="form-group">
									Clasa #3:
										<input type="text" class="form-control" name="cls3">
									</div><div class="form-group">
									Diriginte #3:
										<input type="text" class="form-control" name="drg3">
									</div><div class="form-group">
									Număr elevi #3:
										<input type="text" class="form-control" name="nr3">
									</div><div class="form-group">
									Clasa #4:
										<input type="text" class="form-control" name="cls4">
									</div><div class="form-group">
									Diriginte #4:
										<input type="text" class="form-control" name="drg4">
									</div><div class="form-group">
									Număr elevi #4:
										<input type="text" class="form-control" name="nr4">
									</div><div class="form-group">
									Clasa #5:
										<input type="text" class="form-control" name="cls5">
									</div><div class="form-group">
									Diriginte #5:
										<input type="text" class="form-control" name="drg5">
									</div><div class="form-group">
									Număr elevi #5:
										<input type="text" class="form-control" name="nr5">
									</div><div class="form-group">
									Clasa #6:
										<input type="text" class="form-control" name="cls6">
									</div><div class="form-group">
									Diriginte #6:
										<input type="text" class="form-control" name="drg6">
									</div><div class="form-group">
									Număr elevi #6:
										<input type="text" class="form-control" name="nr6">
									</div><div class="form-group">
									Clasa #7:
										<input type="text" class="form-control" name="cls7">
									</div><div class="form-group">
									Diriginte #7:
										<input type="text" class="form-control" name="drg7">
									</div><div class="form-group">
									Număr elevi #7:
										<input type="text" class="form-control" name="nr7">
									</div><div class="form-group">
									Clasa #8:
										<input type="text" class="form-control" name="cls8">
									</div><div class="form-group">
									Diriginte #8:
										<input type="text" class="form-control" name="drg8">
									</div><div class="form-group">
									Număr elevi #8:
										<input type="text" class="form-control" name="nr8">
									</div><div class="form-group">
									Clasa #9:
										<input type="text" class="form-control" name="cls9">
									</div><div class="form-group">
									Diriginte #9:
										<input type="text" class="form-control" name="drg9">
									</div><div class="form-group">
									Număr elevi #9:
										<input type="text" class="form-control" name="nr9">
									</div><div class="form-group">
									Clasa #10:
										<input type="text" class="form-control" name="cls10">
									</div><div class="form-group">
									Diriginte #10:
										<input type="text" class="form-control" name="drg10">
									</div><div class="form-group">
									Număr elevi #10:
										<input type="text" class="form-control" name="nr10">
									</div>
									<div class="form-group">
										<input type="submit" class="btn btn-success" name="submitclasse" value="Adaugă">
									</div>
								</div>
						</form>
					<!-- ADD Elevi -->
					</center><br><br><a id="addelevi"></a>
					<h1 class="g-coloana">  <i class="fa fa-crosshairs "></i>  Adaugă elevi </h1>
					<center>
					<p style="margin-top:-2cm;" >Câmpurile marcate cu <font color="red"><strong>*</strong></font> sunt obligatorii.</p><br>
					<?php
						if(isset($_POST['submitelev']))
						{$idclasa=$_POST['clase'];
						 $pass=$_POST['parola_comun'];
						 $query=mysql_query("SELECT `nume` from `clase` where `id`=$idclasa;");
						 $row=mysql_fetch_assoc($query);
						 $clasa=$row['nume'];
						 $ok=1;
						 for($i=1;$i<=30 && $ok=1;$i++)
							{	$n=$_POST["n$i"];
								$p=$_POST["p$i"];
								if(($n!=NULL)&&($p!=NULL)) // Nenule
								{  $intr=mysql_query("INSERT INTO utilizatori (nume,prenume,parola,clasa) VALUES('$n','$p','$pass','$clasa');");
								   if($intr) require_once("sql/add/success.php");	// OK
								}
								else $ok=0;
							}		
						}
					?>
					<form method="post">
						<div class="rand">
									<font color="red"><strong>*</strong></font>Clasa:
									<div class="form-group">
										<select name="clase" class="form-control">
											<option value="default" class="form-control">---</option>
												<!-- Afisare clase -->
												<?php 
													for($counter=1;$counter<=$nr;$counter++)
														require("sql/clase.php");
												 ?>			
												 <!-- //Afisare clase -->
										</select>
									</div>
									<div class="form-group">
									<font color="red"><strong>*</strong></font>Parolă la comun:
										<input type="password" class="form-control" required="required" name="parola_comun" placeholder="Ex. 12345">
									</div>
									<div class="form-group">
									<font color="red"><strong>*</strong></font>#1 Nume:
										<input type="text" class="form-control" required="required" name="n1" placeholder="Ex. Popescu">
									</div>
									<div class="form-group">
									<font color="red"><strong>*</strong></font>#1 Prenume:
										<input type="text" class="form-control" required="required" name="p1" placeholder="Ex. Marius-Ion">
									</div>
									<div class="form-group">
									#2 Nume:
										<input type="text" class="form-control" name="n2">
									</div>
									<div class="form-group">
									#2 Prenume:
										<input type="text" class="form-control" name="p2">
									</div>
									<div class="form-group">
									#3 Nume:
										<input type="text" class="form-control" name="n3">
									</div>
									<div class="form-group">
									#3 Prenume:
										<input type="text" class="form-control" name="p3">
									</div>
									<div class="form-group">
									#4 Nume:
										<input type="text" class="form-control" name="n4">
									</div>
									<div class="form-group">
									#4 Prenume:
										<input type="text" class="form-control" name="p4">
									</div>
									<div class="form-group">
									#5 Nume:
										<input type="text" class="form-control" name="n5">
									</div>
									<div class="form-group">
									#5 Prenume:
										<input type="text" class="form-control" name="p5">
									</div>
									<div class="form-group">
									#6 Nume:
										<input type="text" class="form-control" name="n6">
									</div>
									<div class="form-group">
									#6 Prenume:
										<input type="text" class="form-control" name="p6">
									</div>
									<div class="form-group">
									#7 Nume:
										<input type="text" class="form-control" name="n7">
									</div>
									<div class="form-group">
									#7 Prenume:
										<input type="text" class="form-control" name="p7">
									</div>
									<div class="form-group">
									#8 Nume:
										<input type="text" class="form-control" name="n8">
									</div>
									<div class="form-group">
									#8 Prenume:
										<input type="text" class="form-control" name="p8">
									</div>
									<div class="form-group">
									#9 Nume:
										<input type="text" class="form-control" name="n9">
									</div>
									<div class="form-group">
									#9 Prenume:
										<input type="text" class="form-control" name="p9">
									</div>
									<div class="form-group">
									#10 Nume:
										<input type="text" class="form-control" name="n10">
									</div>
									<div class="form-group">
									#10 Prenume:
										<input type="text" class="form-control" name="p10">
									</div>
									<div class="form-group">
									#11 Nume:
										<input type="text" class="form-control" name="n11">
									</div>
									<div class="form-group">
									#11 Prenume:
										<input type="text" class="form-control" name="p11">
									</div>
									<div class="form-group">
									#12 Nume:
										<input type="text" class="form-control" name="n12">
									</div>
									<div class="form-group">
									#12 Prenume:
										<input type="text" class="form-control" name="p12">
									</div>
									<div class="form-group">
									#13 Nume:
										<input type="text" class="form-control" name="n13">
									</div>
									<div class="form-group">
									#13 Prenume:
										<input type="text" class="form-control" name="p13">
									</div>
									<div class="form-group">
									#14 Nume:
										<input type="text" class="form-control" name="n14">
									</div>
									<div class="form-group">
									#14 Prenume:
										<input type="text" class="form-control" name="p14">
									</div>
									<div class="form-group">
									#15 Nume:
										<input type="text" class="form-control" name="n15">
									</div>
									<div class="form-group">
									#15 Prenume:
										<input type="text" class="form-control" name="p15">
									</div>
									<div class="form-group">
									#16 Nume:
										<input type="text" class="form-control" name="n16">
									</div>
									<div class="form-group">
									#16 Prenume:
										<input type="text" class="form-control" name="p16">
									</div>
									<div class="form-group">
									#17 Nume:
										<input type="text" class="form-control" name="n17">
									</div>
									<div class="form-group">
									#17 Prenume:
										<input type="text" class="form-control" name="p17">
									</div>
									<div class="form-group">
									#18 Nume:
										<input type="text" class="form-control" name="n18">
									</div>
									<div class="form-group">
									#18 Prenume:
										<input type="text" class="form-control" name="p18">
									</div>
									<div class="form-group">
									#19 Nume:
										<input type="text" class="form-control" name="n19">
									</div>
									<div class="form-group">
									#19 Prenume:
										<input type="text" class="form-control" name="p19">
									</div>
									<div class="form-group">
									#20 Nume:
										<input type="text" class="form-control" name="n20">
									</div>
									<div class="form-group">
									#20 Prenume:
										<input type="text" class="form-control" name="p20">
									</div>
									<div class="form-group">
									#21 Nume:
										<input type="text" class="form-control" name="n21">
									</div>
									<div class="form-group">
									#21 Prenume:
										<input type="text" class="form-control" name="p21">
									</div>
									<div class="form-group">
									#22 Nume:
										<input type="text" class="form-control" name="n22">
									</div>
									<div class="form-group">
									#22 Prenume:
										<input type="text" class="form-control" name="p22">
									</div>
									<div class="form-group">
									#23 Nume:
										<input type="text" class="form-control" name="n23">
									</div>
									<div class="form-group">
									#23 Prenume:
										<input type="text" class="form-control" name="p23">
									</div>
									<div class="form-group">
									#24 Nume:
										<input type="text" class="form-control" name="n24">
									</div>
									<div class="form-group">
									#24 Prenume:
										<input type="text" class="form-control" name="p24">
									</div>
									<div class="form-group">
									#25 Nume:
										<input type="text" class="form-control" name="n25">
									</div>
									<div class="form-group">
									#25 Prenume:
										<input type="text" class="form-control" name="p25">
									</div>
									<div class="form-group">
									#26 Nume:
										<input type="text" class="form-control" name="n26">
									</div>
									<div class="form-group">
									#26 Prenume:
										<input type="text" class="form-control" name="p26">
									</div>
									<div class="form-group">
									#27 Nume:
										<input type="text" class="form-control" name="n27">
									</div>
									<div class="form-group">
									#27 Prenume:
										<input type="text" class="form-control" name="p27">
									</div>
									<div class="form-group">
									#28 Nume:
										<input type="text" class="form-control" name="n28">
									</div>
									<div class="form-group">
									#28 Prenume:
										<input type="text" class="form-control" name="p28">
									</div>
									<div class="form-group">
									#29 Nume:
										<input type="text" class="form-control" name="n29">
									</div>
									<div class="form-group">
									#29 Prenume:
										<input type="text" class="form-control" name="p29">
									</div>
									<div class="form-group">
									#30 Nume:
										<input type="text" class="form-control" name="n30">
									</div>
									<div class="form-group">
									#30 Prenume:
										<input type="text" class="form-control" name="p30">
									</div>
									<div class="form-group">
										<input type="submit" class="btn btn-success" name="submitelev" value="Adaugă">
									</div>
								</div>
							</div>
						</form>
					</center><center>
					<?php
						if(isset($_POST['submitprof']))
						{$ok=1;
						 for($i=1;$i<=10 && $ok=1;$i++)
							{$prf=$_POST["prf$i"];
								if($prf=NULL) // Nenule
								{  $intr=mysql_query("INSERT INTO profesori (nume, dirigentie) VALUES('$prf');");	
								   if($intr) require_once("sql/add/success.php");	// OK
								}
								else $ok=0;
							}	
						}
					?>
					<form method="post">
						<div class="rand"><a id="addprofesor"></a>
							<h1 class="g-coloana">  <i class="fa fa-crosshairs "></i>  Adaugă Profesori </h1>
									<p style="margin-top:-2cm;">Câmpurile marcate cu <font color="red"><strong>*</strong></font> sunt obligatorii.</p><br>
									<div class="form-group">
									<font color="red"><strong>*</strong></font>Profesor #1:
										<input type="text" class="form-control" required="required" name="prf1" placeholder="Ex. Popescu Marius">
									</div><div class="form-group">
									Profesor #2:
										<input type="text" class="form-control" name="prf2">
									</div><div class="form-group">
									Profesor #3:
										<input type="text" class="form-control" name="prf3">
									</div><div class="form-group">
									Profesor #4:
										<input type="text" class="form-control" name="prf4">
									</div><div class="form-group">
									Profesor #5:
										<input type="text" class="form-control" name="prf5">
									</div><div class="form-group">
									Profesor #6:
										<input type="text" class="form-control" name="prf6">
									</div><div class="form-group">
									Profesor #7:
										<input type="text" class="form-control" name="prf7">
									</div><div class="form-group">
									Profesor #8:
										<input type="text" class="form-control" name="prf8">
									</div><div class="form-group">
									Profesor #9:
										<input type="text" class="form-control" name="prf9">
									</div><div class="form-group">
									Profesor #10:
										<input type="text" class="form-control" name="prf10">
									</div>
										<input type="submit" class="btn btn-success" name="submitprof" value="Adaugă">
									<div class="form-group">
									</div>
								</div>
						</form>
					</center>
					<?php
						
					?>
					<center>
					<form method="post">
						<div class="rand"><a id="changepass"></a>
							<h1 class="g-coloana">  <i class="fa fa-crosshairs "></i>  Schimbă Parola </h1>
									<p style="margin-top:-2cm;">Câmpurile marcate cu <font color="red"><strong>*</strong></font> sunt obligatorii.</p><br>
									<div class="form-group">
									<font color="red"><strong>*</strong></font>Nume
										<input type="text" class="form-control" required="required" name="pnume" placeholder="Ex. Popescu">
									</div><div class="form-group">
									<font color="red"><strong>*</strong></font>Prenume
										<input type="text" class="form-control" required="required" name="pprenume" placeholder="Ex. Marius">
									</div><div class="form-group">
									<font color="red"><strong>*</strong></font>Noua parolă
										<input type="password" class="form-control" required="required" name="newpass" placeholder="Ex. 123123">
									</div>
										<input type="submit" class="btn btn-success" name="submitnewpass" value="Schimbă">
									<div class="form-group">
									</div>
								</div>
						</form>
					</center>
		</section>
	   <section  id="contact-sec">
			<div class="container">
				<div class="rand g-coloana">
					  <h1 class="g-coloana">  <i class="fa fa-crosshairs"></i> Detalii utilizare  </h1>
					
					  
					<div class="col-md-6 ">
					 
						<p>
							 <strong> Număr utilizatori: </strong> 
							<?php
							
							?>
							 <br>
							 <strong> Număr utilizatori înregistrați: </strong> &nbsp;Continut 1234567890  <br>
							 <strong> Număr profesori: </strong> &nbsp;Continut 1234567890  <br>
							 <strong> Număr clase: </strong> &nbsp;Continut 1234567890   <br>
						</p>
						
					</div>
				</div>
			</div>
		</section>
		<div id="footer">
			© Speed | 2017 
			 
		</div>
		<script src="js/close_alert.js"></script>
		<script>
		function showHide(shID) {
		if (document.getElementById(shID)) {
			if (document.getElementById(shID+'-show').style.display != 'none') {
				document.getElementById(shID+'-show').style.display = 'none';
				document.getElementById(shID).style.display = 'block';
			}
			else {
				document.getElementById(shID+'-show').style.display = 'inline';
				document.getElementById(shID).style.display = 'none';
				}
			}
		}
		</script>
		<script src="js/top.js"></script>
	</body>
</html>