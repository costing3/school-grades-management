<?php
		$clase = "SELECT nume FROM `clase` WHERE `id` = $counter;";
		$result = mysql_query($clase, $db);
		echo "<option value='$counter' name='$counter'>";
		while ($row = mysql_fetch_assoc($result)) {
			echo $row['nume'],"\n";
		}mysql_free_result($result);
		echo "</option>";
?>