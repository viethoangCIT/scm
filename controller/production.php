<?php
	class production extends Main
	{
		function index()
		{
			echo "hello";
			$html_result = $this->View->render("list_production.php");
		}
	}
?>
