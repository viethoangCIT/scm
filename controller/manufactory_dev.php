<?php
class manufactory extends Main
{
	function index($id = "")
	{
		$this->loadModel("ManuFactory");
		$this->loadModel("Factory");
		
		$act = "";
		
		if(isset($_GET["act"])) $act = $_GET["act"];
		
		//echo "act: $act";
		if($act=="")
		{	
			//truy vấn dữ liệu từ bảng factory hiển thị lên selecbox nhà máy
			$array_factory = array(""=>array("id"=>"","name"=>"Chọn nhà máy"));
			$array_factory = $this->Factory->find("all",array("fields"=>"id,name"));
			
			$array_manufactory = $this->ManuFactory->find("all");
			
			$array_param = array(
				"array_factory"=>$array_factory,
				"array_manufactory"=>$array_manufactory,
			);
			
			$html_result = $this->View->render("add_manufactory.php",$array_param);
			echo $html_result;
			return;
		}
		if($act=="list")
		{
			$array_manufactory = $this->ManuFactory->find("all",array("order"=>"order_number ASC, id DESC"));
			$html_result = $this->View->render("list_manufactory.php",array("array_manufactory"=>$array_manufactory),false);
			echo $html_result;
			return;
		}		
		
		if($act=="save")
		{
			$array_manufactory = $_GET['data'];
			$id_factory = $array_manufactory["id_factory"];
			$array_manufactory["factory"] = $this->Factory->get_value(array("fields"=>"name","conditions"=>"id = '$id_factory'"));
			//print_r($array_manufactory);
			$this->ManuFactory->save($array_manufactory);
			return;
		}	
		if($act=="del")
		{
			$id =  "";
			if(isset($_GET['id'])) $id = $_GET['id'];
			$this->ManuFactory->delete($id);
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