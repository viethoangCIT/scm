<?php
class  machine extends Main
{
	function add($id="")
	{
		//tạo đối tượng model Machine liên kết với bảng machines
		$this->loadModel("Machine", "machines");
		$this->loadModel("Manufactory", "manufactorys");
		
		//kiểm tra có dữ liệu submit kèm theo không
		if(isset($_POST['data']))
		{

			
			//lấy dữ liệu từ sumit lên
			$array_data = $_POST['data'];
			
			//Lấy giá trị của phần tử id_manufactory
			$id_manufactory = $array_data["id_manufactory"];
			
			////Dùng hàm find để truy vấn từ bảng manufactorys để lấy cột name theo id = $id_manufactory
			$array_manufactory_name = $this->Manufactory->find("all", array("conditions"=>"id = '$id_manufactory'"));
			
			////Tạo mảng $array_manufactory_name có phần tử 0 và giá trị name để lưu giá trị vào bảng manufactorys theo cột manufactory
			$array_data["manufactory"] = $array_manufactory_name[0]["name"];
			
			//chuyển chuỗi ngày định dạng d-m-y thành Y-m-d
			$array_data["day_near"] = date("Y-m-d",strtotime($array_data["day_near"]));
			$array_data["day_next"] = date("Y-m-d",strtotime($array_data["day_next"]));
			$array_data["day_use"] = date("Y-m-d",strtotime($array_data["day_use"]));
			
			//lưu dữ liệu vào bảng machaines
			$this->Machine->save($array_data);

			//dùng hàm redirect của đối tượng this đê chuyền về hàm index
			$this->redirect("/machine/index.html");

		}
		
		//dùng hàm find của đối tượng Manufactory để lấy dữ liệu 
		$array_manufactory = $this->Manufactory->find("all", array("fields"=>"id, name"));
		$array_manufactory = array(""=>array("id"=>"", "name"=>"...")) + $array_manufactory;
		
		
		$array_edit_machine=null;
		//kiểm tra id truyền lên có khác rỗng hay không
		if($id !="")
		{
			//Dùng hàm find của đối tượng Machine để lấy id sửa theo id
			$array_edit_machine=$this->Machine->find("all",array("conditions"=>"id='$id'"));
		}
		
		//tạo nhóm mảng 
		$array_param = array("array_manufactory"=>$array_manufactory,
							 "array_edit_machine"=>$array_edit_machine
						); 
		
		$html = $this->View->render("add_machine.php", $array_param);
		echo $html;
	}
	
	
	function index($id="")
	{
		//tạo đối tượng model Machine liên kết với bảng machines
		$this->loadModel("Machine", "machines");
		$this->loadModel("Manufactory", "manufactorys");
		$dk = "";
		$name = "";
		if(isset($_GET["name"]) && $_GET["name"]!="")
		{
			$name = $_GET["name"];
			$dk .= "id = '$name'";
		}
		
		$code = "";
		if(isset($_GET["code"]) && $_GET["code"]!="")
		{
			$code = $_GET["code"];
			if($dk!="")
			{
				$dk .= " AND ";
			}
			$dk .= "id = '$code'";
		}
		
		$status = "";
		if(isset($_GET["status"]) && $_GET["status"]!="")
		{
			$status = $_GET["status"];
			if($dk!="")
			{
				$dk .= " AND ";
			}
			$dk .= "status = '$status'";
		}
		
		// kiểm tra có tham số id_manufactory không, để lọc dữ liệu id_manufactory
		$id_manufactory = "";

		if (isset($_GET["id_manufactory"]) && $_GET["id_manufactory"] != "") {
			$id_manufactory = $_GET["id_manufactory"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_manufactory = '$id_manufactory'";
		}
		
		$type = "";
		if(isset($_GET["type"]) && $_GET["type"]!="")
		{
			$type = $_GET["type"];
			if($dk!="")
			{
				$dk .= " AND ";
			}
			$dk .= "id = '$type'";
		}

		
		$array_machine = $this->Machine->find("all", array("conditions"=>$dk));
		
		$array_machine_name = $this->Machine->find("all", array("fields"=>"id, name"));
		$array_machine_name = array(""=>array("id"=>"","name"=>"Chọn tên máy")) + $array_machine_name;
		
		$array_machine_code = $this->Machine->find("all", array("fields"=>"id, code"));
		$array_machine_code = array(""=>array("id"=>"","name"=>"Chọn mã máy")) + $array_machine_code;
		
		$array_machine_manufactory = $this->Manufactory->find("all", array("fields"=>"id, name"));
		$array_machine_manufactory = array(""=>array("id"=>"","name"=>"Chọn xưởng")) + $array_machine_manufactory;
		
		$array_machine_type = $this->Machine->find("all", array("fields"=>"id, type"));
		$array_machine_type = array(""=>array("id"=>"","name"=>"Chọn loại máy")) + $array_machine_type;
		
		
		$array_param = array("array_machine"=>$array_machine,
							 "array_machine_name"=>$array_machine_name,
							 "array_machine_code"=>$array_machine_code,
							 "array_machine_manufactory"=>$array_machine_manufactory,
							 "array_machine_type"=>$array_machine_type,
							 "name"=>$name,
							 "code"=>$code,
							 "status"=>$status,
							 "id_manufactory"=>$id_manufactory,
							 "type"=>$type
						);
		
		$html_result = $this->View->render("index_machine.php", $array_param);
		echo $html_result;
	}



	function del($id="")
	{
		if ($id != "")
		{
			// xóa sản phẩm theo id
    		$this->loadModel("Machine");
    		$this->Machine->delete($id);

    		// chuyển về trang index

    		$this->redirect("/machine/index.html");
		}
	}

	function info($id="", $id_history="")
	{
		//tạo đối tượng model Machine liên kết với bảng machines
		$this->loadModel("Machine", "machines");
		$this->loadModel("History", "machine_history");
		
		//kiểm tra id có submit lên hay không và khác rỗng hay không
		if(isset($_GET["id"]) && $_GET["id"]!="")
		{
			$id = $_GET["id"];
		}
		
		$array_machine = NULL;
		
		//kiểm tra id có rỗng hay không
		if($id!="")
		{
			//lấy tên machine_name từ bảng Product where id=$id
			$array_machine = $this->Machine->find("all", array("conditions"=> "id = '$id'"));
		}
		
		//kiểm tra dữ liệu submit lên 
		if(isset($_POST["data"]))
		{
			$array_data = $_POST["data"];
			
			$id_machine = $array_data["id_machine"];
			
			$array_data["day"] = date("Y-m-d", strtotime($array_data["day"]));
			
			$array_data["day_end"] = date("Y-m-d", strtotime($array_data["day_end"]));
			
			$this->History->save($array_data);
			
			$this->redirect("/machine/info/$id_machine.html");
		}
		
		//sửa
		$array_edit_history = NULL;
		if($id_history!="")
		{
			$array_edit_history = $this->History->find("all", array("conditions"=>"id = '$id_history'"));	
		}
		
		
		//tìm kiếm
		$dk = "id_machine = '$id'";
		$day = "";
		
		//kiểm tra có dữ liệ day submit lên không và có khác rỗng hay không
		if(isset($_GET['day']) && $_GET['day']!="")
		{
			$day = $_GET["day"];
			$day = date("Y-m-d", strtotime($day));
			
			$dk .= " AND day >= '$day'";	
		}
		
		$day_end = "";
		
		//kiểm tra có dữ liệ day_end submit lên không và có khác rỗng hay không
		if(isset($_GET['day_end']) && $_GET['day_end']!="")
		{
			$day_end = $_GET["day_end"];
			$day_end = date("Y-m-d", strtotime($day_end));
			
			$dk .= " AND day_end <= '$day_end'";	
		}
		
		
		//truy vấn 
		$array_machine_history = $this->History->find("all", array("conditions"=>$dk,"order"=>"id ASC"));
		
		$array_param =  array("array_machine"=>$array_machine,
						      "id"=>$id, 
							  "array_machine_history"=>$array_machine_history,
							  "array_edit_history"=>$array_edit_history,
							  "day"=>$day,
							  "day_end"=>$day_end
					);
		
		$html = $this->View->render("info_machine.php", $array_param);
		echo $html;
	}

	function del_info($id_machine="",$id="")
	{
		//kiểm tra id có khác rỗng hay không
		if($id!="")
		{
			$this->loadModel("History", "machine_history");
			
			//dùng hàm delete để xóa dữ liệu theo id của bảng machine_history
			$this->History->delete($id);
			
			//chuyển về lại hàm info
			$this->redirect("/machine/info/$id_machine.html");
		}
	}


	function maintenance($id_machine="",$id="")
	{

		//tạo đối tượng model Maintenance liên kết với bảng machines_manitenance
		$this->loadModel("Maintenance","machines_maintenance");

		//tạo đối tượng model Machine liên kết với bảng machines
		$this->loadModel("Machine", "machines");

		//kiểm tra có dữ liệu GET có submit lên hay không
		if(isset($_POST["data"]))
		{
			//lấy dữ liệu submit lên vào mảng $array_data
			$array_data = $_POST["data"];

			//lấy giá trị của phần tử id_machine 
			$id_machine = $array_data["id_machine"];

			//Lấy cột name từ bảng machine where id=$id_machine
			$array_machine_name = $this->Machine->find("all", array("conditions"=>"id = '$id_machine'"));

			//Tạo phần tử machine_name trong mảng $array_data để lưu giá trị cho cột machine_name vào bảng maintenance_machine
			$array_data["machine_name"] = $array_machine_name[0]["name"];
			
			//chuyển chuỗi ngày định dạng d-m-y thành Y-m-d
			$array_data["day"] = date("Y-m-d",strtotime($array_data["day"]));
			$array_data["cycle"] = date("Y-m-d",strtotime($array_data["cycle"]));
			

			//Dùng hàm save để lưu dữ liệu mảng $array_data vào bảng machines_maintenance
			$this->Maintenance->save($array_data);

			//dùng hàm redirect để chuyển về hàm maintenance
			$this->redirect("/machine/maintenance/$id_machine.html");
		}

		//tạo đối tượng model Machine liên kết với bảng machines
		$this->loadModel("Machine");

		//dùng hàm find của đối tượng Machine đọc dữ liệu từ bảng machines
		$array_machine = $this->Machine->find("all", array("fields"=>"id, name"));


		//tạo cái mảng có giá trị là NULL
		$array_edit_machine = NULL;

		//kiểm tra id sửa có khác rỗng hay không nếu khác rỗng thì đi vào câu lệnh if và thực hiện việc tiếp theo
		if($id != "")
		{
			//dùng hàm find của đối tượng Maintenance truy vấn dữ liệu theo id vào mảng $array_edit_machine
			$array_edit_machine = $this->Maintenance->find("all", array("conditions"=>"id = '$id'"));
		}
		
		$str_machine_name = "";
		
		//Lấy cột name từ bảng machine where id=$id_machine
		$array_machine_name = $this->Machine->find("all", array("conditions"=>"id = '$id_machine'"));
		
		if($array_machine_name!=NULL)
		{
			$str_machine_name = $array_machine_name[0]["name"];
		}
		
		//gọi hàm find của đối tượng Maintenance để truy vấn tất cả dữ liệu từ bảng machines_maintenance đưa vào mảng $array_machine_main
		$array_machine_main = $this->Maintenance->find("all",  array("conditions"=>"id_machine = '$id_machine'"));
		
		//nhóm mảng 
		$array_param = array("array_machine"=>$array_machine,
				"array_machine_main"=>$array_machine_main,
				"array_edit_machine"=>$array_edit_machine,
				"str_machine_name"=>$str_machine_name,
				"id_machine"=>$id_machine
			);

		//dùng hàm render của đối tượng View để truy cập tới file maintenance_machine.php và tạo mảng để đưa thông tin dữ liệu ra trình duyệt
		$html = $this->View->render("maintenance_machine.php",$array_param);
		echo $html;
	}

	function del_main($id_machine="", $id="")
	{
		//Kiểm tra $id có khác rỗng hay không nếu khác rỗng thì nó sẽ đi vào trong câu lệnh if và thực hiện câu lệnh tiếp theo
		if($id != "")
		{
			//tạo đối tượng model Maintenance liên kết với bảng machines_manitenance
			$this->loadModel("Maintenance","machines_maintenance");

			//dùng hàm delete của đối tượng Maintenance theo id để xóa
			$this->Maintenance->delete($id);

			//dùng hàm redirect để chuyển về hàm maintenance
			$this->redirect("/machine/maintenance/$id_machine.html");
		}
	}


	function materials($id="")
	{
		//tạo đối tượng model Materials liên kết với bảng machines_materials
		$this->loadModel("Materials","machines_materials");

		//kiểm tra có dữ liệu submit vào csdl hay không nếu có thì đi vào câu lệnh if
		if(isset($_GET["data"]))
		{
			//đưa dữ liệu submit lên vào mảng array_data
			$array_data = $_GET["data"];
			
			
			
			//dùng hàm save lưu mảng array_data vào bảng machines_materials
			$this->Materials->save($array_data);

			//dùng hàm redirect để chuyển về hàm materials
			$this->redirect("/machine/materials/");
		}

		//tạo mảng array_edit_machine có giá trị là NULL
		$array_edit_machine = NULL;

		//kiểm tra id sua có khác rỗng không
		if($id!="")
		{
			//truy vấn dữ liệu vào mảng array_edit_machaine
			$array_edit_machine = $this->Materials->find("all", array("conditions"=>"id = '$id'"));
		}

		//truy vấn tất cả dữ liệu vào mảng array_machine
		$array_machine = $this->Materials->find("all");

		$html = $this->View->render("materials_machine.php",array("array_machine"=>$array_machine,"array_edit_machine"=>$array_edit_machine));
		echo $html;
	}


	function del_materials($id="")
	{
		if($id!="")
		{
			//tạo đối tượng model Materials để liên kết với bảng machines_materials
			$this->loadModel("Materials","machines_materials");

			//dùng hàm delete để xóa theo id trong bảng
			$this->Materials->delete($id);

			//dùng hàm redirect để chuyền về hàm materials
			$this->redirect("/machine/materials/");
		}
	}

	// function index()
	// {
	// 	$html_result = $this->View->render("index_messages.php");
	// 	echo $html_result;
	// }

	// function add()
	// {
	// 	$html_result = $this->View->render("add_messages.php");
	// 	echo $html_result;
	// }




//end_class	
}
?>