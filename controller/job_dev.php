<?php
class job extends Main
{
	function index($id = "")
	{
		$this->loadModel("Job");
		$act = "";
		
		if(isset($_GET["act"])) $act = $_GET["act"];
		
		//echo "act: $act";
		if($act=="")
		{
			$html_result = $this->View->render("add_job.php");
			echo $html_result;
			return;
		}
		if($act=="list")
		{
			$array_job = $this->Job->find("all",array("conditions"=> "status = 1","order"=>"order_number ASC, id DESC"));
			$html_result = $this->View->render("list_job.php",array("array_job"=>$array_job),false);
			echo $html_result;
			return;
		}		
		
		
		if($act=="save")
		{
			$array_job = $_GET['data'];
			print_r($array_job);
			$this->Job->save($array_job);
			return;
		}	
		if($act=="del")
		{
			$id =  "";
			if(isset($_GET['id'])) $id = $_GET['id'];
			$this->Job->delete($id);
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