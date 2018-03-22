<?php
	echo "Danh sach gia nhan cong";
	echo "<br>";
	//print_r($array_labor_cost);//

	echo "<table border='1'>";
	echo "<tr><td>STT</td><td>Year</td><td>Price</td><td>Edit</td><td>Delete</td></tr>";

	
	foreach($array_labor_cost as $index => $labor_cost)
	{
		$year = $labor_cost["year"];
		$price = $labor_cost["price"];
		$link_edit = "<a href='' >Edit</a>";
		$link_delete = "<a href='' >Delete</a>";
	    echo "<tr><td>$index</td><td>$year</td><td>$price</td><td>$link_edit</td><td>$link_delete</td></tr>";
	}
	
	echo "</table>";
?>