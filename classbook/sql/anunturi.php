<?php
		
		$titlu    = "SELECT titlu FROM `anunturi` WHERE `id` = $i;";
		$continut = "SELECT continut FROM `anunturi` WHERE `id` = $i;";
		$resultt = mysql_query($titlu, $db);
		$resultc = mysql_query($continut, $db);
		echo "<div class='col-md-4 col-sm-4'>";
			while ($row = mysql_fetch_assoc($resultt)) {
				echo "<h4>";
				echo $row['titlu'],"\n";
				echo "</h4>";
			}mysql_free_result($resultt);	
			while ($row = mysql_fetch_assoc($resultc)) {
				echo "<p>";
				echo $row['continut']; 
			}mysql_free_result($resultc);	
		echo "</p>
			 </div>";
?>