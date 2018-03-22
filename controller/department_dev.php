<?php
class department extends Main
{
	function index($id = "")
	{
		$this->loadModel("Department");
		$act = "";
		
		if(isset($_GET["act"])) $act = $_GET["act"];
		
		//echo "act: $act";
		if($act=="")
		{
			$html_result = $this->View->render("add_department.php");
			echo $html_result;
			return;
		}
		if($act=="list")
		{
			$array_department = $this->Department->find("all",array("conditions"=> "status = 1","order"=>"order_number ASC, id DESC"));
			$html_result = $this->View->render("list_department.php",array("array_department"=>$array_department),false);
			echo $html_result;
			return;
		}		
		
		
		if($act=="save")
		{
			$array_department = $_GET['data'];
			print_r($array_department);
			$this->Department->save($array_department);
			return;
		}	
		if($act=="del")
		{
			$id =  "";
			if(isset($_GET['id'])) $id = $_GET['id'];
			$this->Department->delete($id);
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