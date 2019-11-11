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
		<link rel="stylesheet" type="text/css" href="css/expand.css" />
		<link rel="stylesheet" type="text/css" href="css/table.css" />
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
				$admin    = "SELECT email FROM `utilizatori` WHERE `rol` = 'admin'";
				$result = mysql_query($admin, $db);
				while ($row = mysql_fetch_assoc($result)) 
					{if ($row['email']==$_SESSION['user'])
						echo "<li><a href='settings.php' name='logout'>ADMINISTRATOR</a></li>";
					}mysql_free_result($result);
			?>
			<!-- //Administrator -->
						<li style="float:right"><a href="sql/logout.php" name="logout"><img src="img/logout.png" width="26" height="26" style="margin-top:-4px;"></a></li>
						<li class="dropdown" style>
							<a href="javascript:void(0)" class="dropbtn"><!--Nume-->
			<!-- Utilizator Logat -->
			<?php
				if(!($_SESSION['user']))
				{require_once ("sql/redirect.php");} else  // Acces Neautorizat
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
				$syntax   = "SELECT count(id) FROM anunturi;";
				$resulth = mysql_query($syntax, $db);
				while ($row = mysql_fetch_assoc($resulth)) {
					$nr=$row['count(id)'];}
				mysql_free_result($resulth);
			?>
			<!-- //Utilizator Logat -->
							</a>
							<div class="dropdown-content">
							  <a href="clasa.php">Profil</a>
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
					<h1 class="g-coloana">  </i>Salut, <?php echo $xprenume."!"; ?></h1>
					
					<div class="col-md-6 ">
						<h2>Test Bottom</h2>
					 
						<p>
						<!-- Administrator --> 
						<?php
							$admin    = "SELECT email FROM `utilizatori` WHERE `rol` = 'admin'";
							$result = mysql_query($admin, $db);
							while ($row = mysql_fetch_assoc($result)) 
								{if ($row['email']==$_SESSION['user'])
									echo "<li><a href='settings.php' name='logout'>ADMINISTRATOR</a></li>";
								}mysql_free_result($result);
						?>
						<!-- //Administrator -->
						<div class="datagrid"><table>
<thead><tr><th>header</th><th>header</th><th>header</th><th>header</th></tr></thead>
<tfoot><tr><td colspan="4"><div id="paging"><ul><li><a href="#"><span>Previous</span></a></li><li><a href="#" class="active"><span>1</span></a></li><li><a href="#"><span>2</span></a></li><li><a href="#"><span>3</span></a></li><li><a href="#"><span>4</span></a></li><li><a href="#"><span>5</span></a></li><li><a href="#"><span>Next</span></a></li></ul></div></tr></tfoot>
<tbody><tr><td>data</td><td>data</td><td>data</td><td>data</td></tr>
<tr class="alt"><td>data</td><td>data</td><td>data</td><td>data</td></tr>
<tr><td>data</td><td>data</td><td>data</td><td>data</td></tr>
<tr class="alt"><td>data</td><td>data</td><td>data</td><td>data</td></tr>
<tr><td>data</td><td>data</td><td>data</td><td>data</td></tr>
</tbody>
</table></div>
							 <strong> Administreaza Site-ul </strong> &nbsp;Continut 1234567890  
							<br>
							Paragraf           
						</p>
			 <!-- Anunturi -->
			<!-- <php 
				for($i=1;$i<=$nr;$i++)
					require("sql/anunturi.php");
			 ?>             
			<!-- // Anunturi -->
				   </div>
			   </div>
			</div>
		</section>
		
	   <section  id="contact-sec">
			<div class="container">
				<div class="rand g-coloana">
					  <h1 class="g-coloana">  <i class="fa fa-crosshairs"></i> Contact Info  </h1>
					
					  
					<div class="col-md-6 ">
						<h2>Test Bottom</h2>
					 
						<p>
							 <strong> Text STrong </strong> &nbsp;Continut 1234567890  
							<br>
							Paragraf           
						</p>
						<form>
							<div class="rand">
								<div class="col-md-6 ">
									<div class="form-group">
										<input type="text" class="form-control" required="required" placeholder="Name">
									</div>
								</div>
								<div class="col-md-6 ">
									<div class="form-group">
										<input type="text" class="form-control" required="required" placeholder="Email address">
									</div>
								</div>
							</div>
							<div class="rand">
								<div class="col-md-12 ">
									<div class="form-group">
										<textarea name="message" id="message" required="required" class="form-control" rands="3" placeholder="Message"></textarea>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-success">Submit Request</button>
									</div>
								</div>
							</div>
						</form>
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
	</body>
</html>