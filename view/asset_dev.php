<?php
class asset extends Main
{
	function index()
	{
		$html_result = $this->View->render("index_asset.php");
		echo $html_result;
	}
	
	
	function add()
	{
		$html_result = $this->View->render("add_asset.php");
		echo $html_result;
	}
}
?>