<?php
class factory extends Main
{
	function index($id = "")
	{
		$this->loadModel("Factory");
		$act = "";
		
		if(isset($_GET["act"])) $act = $_GET["act"];
		
		//echo "act: $act";
		if($act=="")
		{
			$html_result = $this->View->render("add_factory.php");
			echo $html_result;
			return;
		}
		if($act=="list")
		{
			$array_factory = $this->Factory->find("all",array("conditions"=> "status = 1","order"=>"order_number ASC, id DESC"));
			$html_result = $this->View->render("list_factory.php",array("array_factory"=>$array_factory),false);
			echo $html_result;
			return;
		}		
		
		
		if($act=="save")
		{
			$array_factory = $_GET['data'];
			print_r($array_factory);
			$this->Factory->save($array_factory);
			return;
		}	
		if($act=="del")
		{
			$id =  "";
			if(isset($_GET['id'])) $id = $_GET['id'];
			$this->Factory->delete($id);
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