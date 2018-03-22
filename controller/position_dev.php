<?php
class position extends Main
{
	function index($id = "")
	{
		$this->loadModel("Position");
		$act = "";
		
		if(isset($_GET["act"])) $act = $_GET["act"];
		
		//echo "act: $act";
		if($act=="")
		{
			$html_result = $this->View->render("add_position.php");
			echo $html_result;
			return;
		}
		if($act=="list")
		{
			$array_position = $this->Position->find("all",array("conditions"=> "status = 1","order"=>"order_number ASC, id DESC"));
			$html_result = $this->View->render("list_position.php",array("array_position"=>$array_position),false);
			echo $html_result;
			return;
		}		
		
		
		if($act=="save")
		{
			$array_position = $_GET['data'];
			print_r($array_position);
			$this->Position->save($array_position);
			return;
		}	
		if($act=="del")
		{
			$id =  "";
			if(isset($_GET['id'])) $id = $_GET['id'];
			$this->Position->delete($id);
			return;
		}		
	
	//end function		
	}
	
	//them
	function add()
	{
		
		
	}
	
	//xoa
	function del($id = "")
	{	
	
	}
}
?>