<html>
    <head>
		<title>Catalog Virtual v3.3</title>
        <meta charset="UTF-8" /> <!-- Diacritice -->
        <link rel="shortcut icon" href="favicon.png"> 
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/form.css" />
		<link rel="stylesheet" type="text/css" href="css/form_anim.css" />
		<link rel="stylesheet" type="text/css" href="css/alert.css" />
    </head>
    <body>
        <div class="container">
            <div class="codrops-top">
                <a href="">
                    <strong>Bara de anunturi</strong>
                </a>
                <span class="right">
                    <a href="google.ro">
                        <strong>Link</strong>
                    </a>
                </span>
                <div class="clr"></div>
            </div>
				<header>
					<img src="img/logo.png">
					<h1>Catalog Virtual</span></h1>
				</header>
	<?php
		session_start();
		 error_reporting(E_WARNING); // Scoate erori - sterge inainte sa testezi altceva -
		if(($_SESSION['user'])) // Acces Neautorizat
			header("Location: home.php"); 
		if(isset($_POST['register']))
		{	$nume=$_POST['nume'];
			$prenume=$_POST['prenume'];
			$email=$_POST['email_register'];
			$parola=$_POST['pass1'];
			$parola2=$_POST['pass2'];
			require_once("sql/db.php");
			if(strcmp("$parola","$parola2")==0)
			{	if(!mysql_select_db("site"))
					{	$rez=mysql_query("create database site;");
						$baza=mysql_select_db("site");	
						$tabel=mysql_query("CREATE TABLE utilizatori (id int primary key auto_increment, nume char(30) unique key, prenume char(30), parola char(30), email char(30) unique key, varsta int, clasa char(10)), admin char(3);");
						$tabel1=mysql_query("CREATE TABLE anunturi (id INT NOT NULL AUTO_INCREMENT, data TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, titlu CHAR(61) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL, continut TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;");
						$tabel2=mysql_query("CREATE TABLE clase (id int primary key auto_increment, nume char(9) unique key, diriginte char(60) unique key, elevi int");
					}
				else
					$baza=mysql_select_db("site");
					$intr=mysql_query("INSERT INTO utilizatori (nume,prenume,parola,email,admin) VALUES('$nume','$prenume','$parola','$email','N');");
					if($intr)
						{
							echo "<div class='alert success'>
					  <strong>Success!</strong> Contul tau a fost inregistrat. Click <a href='#autentificare'><strong>aici</strong></a> pentru a te autentifica </a>
					  <span class='closebtn'>&times;</span>
					</div>";
						}
						else
						{
							echo "<div class='alert warning'>
					  <strong>Eroare!</strong> Una din datele introduse apartine unui alt cont.
					  <span class='closebtn'>&times;</span>
					</div>";
						}
			}
			else
			echo "<div class='alert warning'>
					  <strong>Eroare!</strong> Parolele nu corespund!
					  <span class='closebtn'>&times;</span>
					</div>";
		}else if(isset($_POST['login']))
		{		$utilizator=$_POST['email_login'];
				require_once("sql/db.php");
				if ($_POST['email_login'] != NULL && $_POST['password'] != NULL) 
				{	$email_l=$_POST['email_login'];
					$parola_l=$_POST['password'];
					$query="SELECT * FROM `utilizatori` WHERE `email` = '".$email_l."'";
					$result= mysql_query($query);
					$row=mysql_fetch_array($result);
					if ($parola_l != $row['parola']) 
					{	echo "<div class='alert warning'>
						  <strong>Eroare!</strong> Datele introduse nu se afla in baza de date.
						  <span class='closebtn'>&times;</span>
						</div>";
					} 			
					else {
						$_SESSION["user"]=$utilizator;
						echo "<div class='alert success'>
						  <strong>Success!</strong> Te-ai autentificat! Vei fi redirectionat in cateva secunde.
						  <span class='closebtn'>&times;</span>
						</div>";
						echo "<script>
							setTimeout(function () {
							   window.location.href= 'home.php'; 
							},3000);
							</script>";
					}
				}			
			}
?>
			<script src="js/close_alert.js"></script>
            <section>				
                <div id="container_demo" >
                    <a class="hiddenanchor" id="inregistrare"></a>
                    <a class="hiddenanchor" id="autentificare"></a>
	<!-- LOGIN -->
                    <div id="wrapper">
                        <div id="login" class="animate form">
                            <form autocomplete="on" method="post"> 
                                <h1>Autentificare</h1> 
                                <p> 
                                    <label for="username" class="uname" data-icon="u" > Email </label>
                                    <input id="username" name="email_login" required="required" type="text" placeholder="Ex: nume@mail.com" />
                                </p>
                                <p> 
                                    <label for="password" class="youpasswd" data-icon="p"> Parola </label>
                                    <input id="password" name="password" required="required" type="password" placeholder="Ex: 1As@da1&5" /> 
                                </p>
                               <!--  <p class="keeplogin"> 
									<input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" /> 
									<label for="loginkeeping">Pastreaza-ma autentificat</label> -->
								</p>
                                <p class="login button"> 
                                    <input type="submit" value="Login" name="login"/> 
								</p>
                                <p class="change_link">
									Nu ai cont?
									<a href="#inregistrare" class="to_register">Click aici</a>
								</p>
                            </form>
                        </div>
	<!-- //LOGIN -->
	<!-- INREGISTRARE -->
                        <div id="register" class="animate form">
                            <form  autocomplete="on" method="post"> 
                                <h1> Inregistrare </h1> 
                                <p> 
                                    <label for="usernamesignup" class="uname" data-icon="u">Nume</label>
                                    <input id="usernamesignup" required="required" type="text" placeholder="Ex. Popescu" name="nume">
                                </p><p> 
                                    <label for="usernamesignup" class="uname" data-icon="u">Prenume</label>
                                    <input id="usernamesignup" required="required" type="text" placeholder="Ex. Ion sau Ion-Marius" name="prenume" />
                                </p>
								<p> 
                                    <label for="emailsignup" class="youmail" data-icon="e" >Email</label>
                                    <input id="emailsignup" required="required" type="email" placeholder="Ex. nume@mail.com" name="email_register" /> 
                                </p>
                                <p> 
                                    <label for="passwordsignup" class="youpasswd" data-icon="p">Parola</label>
                                    <input id="passwordsignup" required="required" type="password" placeholder="Ex. 1As@da1&5"/ name="pass1">
                                </p>
                                <p> 
                                    <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Confirma Parola </label>
                                    <input id="passwordsignup_confirm" required="required" type="password" placeholder="Ex. 1As@da1&5" name="pass2"/>
                                </p>
                                <p class="signin button"> 
									<input type="submit" value="Sign up" name="register"/> 
								</p>
                                <p class="change_link">  
									Ai deja cont?
									<a href="#autentificare" class="to_register"> Autentifica-te </a>
								</p>
                            </form>
                        </div>
	<!-- //INREGISTRARE -->

                    </div>
                </div>				
            </section>
        </div>
    </body>
	<script>
</html>