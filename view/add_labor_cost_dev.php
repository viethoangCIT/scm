<?php
	echo "Them danh sach nhan cong";
	echo "<form action='/labor_cost/add' method='POST'>";
	echo "<label>Year:</label>";
	echo "<input type='text' name='year'>";
	echo "<br>";
	echo "<label>Price:</label>";
	echo "<input type='text' name='price'>";
	echo "<br>";
	echo "<label>Unit:</label>";
	echo "<input type='text' name='unit'>";
	echo "<br>";	
	echo "<input type='submit' value='Them moi'>";
	echo "</form>";
?>