<?php
class product_material extends Main
{
	function add()
	{
		$html_result = $this->View->render("add_product_material.php");
		echo $html_result;
	}

	function day()
	{
		
		$html_result = $this->View->render("add_product2_attendance2.php");
		echo $html_result;
	}

}
?>