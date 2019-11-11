<?php
session_start();
require_once("sql/db.php");
require_once("sql/date.php");
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title>Catalog Virtual</title>
		<!-- CSS -->
		<link href="css/bootstrap.css" rel="stylesheet" />
		<link href="css/style_home.css" rel="stylesheet" />
		<link href="css/fonts/font-awesome.min.css" rel="stylesheet" />
		<link href="css/fonts/font-awesome-animation.css" rel="stylesheet" />
		<link href="css/butoane.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="css/alert.css" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<!-- //CSS -->
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
						<li><a href="javascript:void(0)"><!--<img src="img/active.png" width="35px" height="20px"--><u>PRIMA PAGINA</u></a></li>
						<li><a href="http://cnvnt.ro/">CNV:NT</a></li>
			<!-- Administrator --> 
			<?php
				$admin    = "SELECT email FROM `utilizatori` WHERE `admin` = 'da'";
				$result = mysql_query($admin, $db);
				while ($row = mysql_fetch_assoc($result)) 
					{if ($row['email']==$_SESSION['user'])
						echo "<li><a href='#' name='logout'>ADMINISTRATOR</a></li>";
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
							  <a href="#">Profil</a>
							  <a href="#">Clasa</a>
							  <a href="#">Note & Absen?e</a>
							  <a href="#">Editare profil</a>
							</div>
						</li>
					</ul>
			   </div>
			</div>
		</div>
		<section id="noutati">
			<div class="container">
				<div class="rand ">
					<h1 class="g-coloana">  <i class="fa fa-crosshairs "></i>  Adauga elevi </h1>
					<center><form>
						<div class="rand">
									Clasa:
									<div class="form-group">
										<select name="clase" class="form-control">
											<option value="default" class="form-control">---</option>
												<!-- Afisare clase 
													<?php
													for($i=1;$i<=$nr;$i++)
														require("sql/clase.php");
													?>
												 <!-- //Afisare clase -->
										</select>
									</div>
									<div class="form-group">
									Parola la comun:
										<input type="password" class="form-control" required="required">
									</div>
									<div class="form-group">
									#1 Nume:
										<input type="text" class="form-control" required="required">
									</div>
									<div class="form-group">
									#1 Prenume:
										<input type="text" class="form-control" required="required">
									</div>
									<div class="form-group">
									#2 Nume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#2 Prenume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#3 Nume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#3 Prenume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#4 Nume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#4 Prenume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#5 Nume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#5 Prenume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#6 Nume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#6 Prenume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#7 Nume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#7 Prenume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#8 Nume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#8 Prenume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#9 Nume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#9 Prenume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#10 Nume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#10 Prenume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#11 Nume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#11 Prenume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#12 Nume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#12 Prenume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#13 Nume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#13 Prenume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#14 Nume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#14 Prenume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#15 Nume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#15 Prenume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#16 Nume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#16 Prenume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#17 Nume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#17 Prenume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#18 Nume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#18 Prenume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#19 Nume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#19 Prenume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#20 Nume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#20 Prenume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#21 Nume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#21 Prenume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#22 Nume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#22 Prenume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#23 Nume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#23 Prenume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#24 Nume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#24 Prenume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#25 Nume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#25 Prenume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#26 Nume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#26 Prenume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#27 Nume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#27 Prenume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#28 Nume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#28 Prenume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#29 Nume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#29 Prenume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#30 Nume:
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
									#30 Prenume:
										<input type="text" class="form-control">
									</div>
									<!-- Prenume:
									<div class="form-group">
										<input type="text" class="form-control" required="required" disabled>
									</div>
									Email:
									<div class="form-group">
										<input type="text" class="form-control" required="required" <disabled>
									</div>
									Clasa:
									<div class="form-group">
										<select name="clase" class="form-control">
											<option value="default" class="form-control">---</option>
												<!-- Afisare clase 
													<? php
													for($i=1;$i<=$nr;$i++)
														require("php/clase.php");
													?>
												 <!-- //Afisare clase 
										</select>
									</div>
									Data Na?terii:
									<div class="form-group">
										<input type="text" class="form-control" required="required" name="dob_day" placeholder="zi">
										<select name="luna_nastere" class="form-control">
											<option value="default1" class="form-control">luna</option>
											<option value='01'> Ianuarie </option>
											<option value='02'> Februarie </option>
											<option value='03'> Martie </option>
											<option value='04'> Aprilie </option>
											<option value='05'> Mai </option>
											<option value='06'> Iunie </option>
											<option value='07'> Iulie </option>
											<option value='08'> August </option>
											<option value='09'> Septembrie </option>
											<option value='10'> Octombrie </option>
											<option value='11'> Noiembrie </option>
											<option value='12'> Decembrie </option>
										</select>
										<input type="text" class="form-control" required="required" name="dob_day" placeholder="an">
									</div>
							</div>
							<div class="rand">
								<div class="col-md-12 ">
									<div class="form-group">
										<textarea name="message" id="message" required="required" class="form-control" rands="3" placeholder="Message"></textarea>
									</div>
									-->
									<div class="form-group">
										<button type="submit" class="btn btn-success">Submit Request</button>
									</div>
								</div>
							</div>
						</form>
					</center>
			   </div>
			</div>
		</section>
	   <section  id="contact-sec">
			<div class="container">
				<div class="rand g-coloana">
					  <h1 class="g-coloana">  <i class="fa fa-crosshairs"></i> Contact Info  </h1>
					
					  
					<div class="col-md-6 ">
						<h2>Lorem ipsum dolor sit amet</h2>
					 
						<p>
							 <strong> Address: </strong> &nbsp;Newyork City, Your Country, Pin-000000.  
							<br />
							Lorem ipsum dolor sit amet, consectetur adipiscing elit.
							 Curabitur nec nisl odio. Mauris vehicula at nunc id posuere.
							   Lorem ipsum dolor sit amet, consectetur adipiscing elit.
							 Curabitur nec nisl odio. Mauris vehicula at nunc id posuere.              
						</p>
						
					</div>
					<div class="col-md-6">
					   <iframe class="cnt" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2999841.293321206!2d-75.80920404999999!3d42.75594204999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew+York!5e0!3m2!1sen!2s!4v1395313088825" s ></iframe>

					</div>
				</div>
			</div>
		</section>
		<div id="footer">
			© Speed | 2017 
			 
		</div>
		<!-- JQUERY -->
		<script src="assets/plugins/jquery-1.10.2.js"></script>
		<!-- BOOTSTRAP -->
		<script src="assets/plugins/bootstrap.min.js"></script>  
		 <!-- ISOTOPE -->
		<script src="assets/plugins/jquery.isotope.min.js"></script>   
		<!-- CUSTOM -->
		<script src="assets/js/custom.js"></script>
	</body>
</html>
