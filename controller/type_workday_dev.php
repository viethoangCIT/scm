<?php
class type_workday extends Main {
	function index($id = "") {
		$this->loadModel("TypeWorkday","type_workday");
		
		if(isset($_POST["data"]))
		{
			$array_data = $_POST["data"];
			$this->TypeWorkday->save($array_data);
		}
		
		$act = "";
		$array_edit_workday = null;
		if(isset($_GET["act"]) && $_GET["act"] != "")
		{
			$act = $_GET["act"];
			if($act == "edit")
			{
				if($id != "") $array_edit_workday = $this->TypeWorkday->find("all",array("conditions"=>"id='$id'"));
			}
			else if ($act == "del") 
			{
				if ($id != "") $this->TypeWorkday->delete($id);
			}
		}
		
		$array_workday = $this->TypeWorkday->find("all");
		$array_param = array(
			"array_workday"=>$array_workday,
			"array_edit_workday"=>$array_edit_workday
		);
		$html = $this->View->render("index_type_workday.php",$array_param);
		echo $html;
	}

}
?>