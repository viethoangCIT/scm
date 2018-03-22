<?php
class salary extends Main {
	function import_salary()
	{
		if (isset($_GET["file"])) {
			$file = $_GET["file"];

			//đọc file excel và lưu vào CSDL
			$this->loadLib("Excel", "excel");

			//mở file excel
			$excel_file = $this->root_folder . "files/" . $this->Company->upload_folder . "/" . $file;
			$data = $this->Excel->open($excel_file);
			//print_r($data);
			// lay so hang cua sheet
			$rowsnum = $data->rowcount($sheet_index = 0);

			// lay so cot cua sheet
			$colsnum = $data->colcount($sheet_index = 0);
			for ($i = 5; $i <= $rowsnum; $i++) 
			{
				//$array_luu = NULL;
				$array_luu["fullname"] = $data->val($i, 2);
				
			}
		}
		
		$html_result = $this->View->render("import_salary.php");
		echo $html_result;
	}
	
	function add($id = "") {
		$this->loadModel('User2', "users");
		$this->loadModel("Salary", "salary");
		$this->loadModel("Department");
		$this->loadModel("Position");
		$this->loadModel("Job");
		$this->loadModel("Factory");
		$this->loadModel("Manufactory");
		$this->loadModel("UserSalary", "user_salary");
		$this->loadModel("Group", "groups");

		// kiểm tra dữ liệu submit từ form để lưu dữ liệu vào bảng salary
		if (isset($_POST['data'])) {
			$data = $_POST['data'];
			$thang = "";
			if (isset($_POST['ngay'])) {
				$thang = "01-" . $_POST['ngay'];
			}
			$thang = date("Y-m-d", strtotime($thang));

			foreach ($data as $salary) 
			{
				// Thay dấu , = "" trong dữ liệu submit quotemeta(str)
				
				//tạo phần tử tháng cho mảng salary

				
				if(isset($salary["kiemnhiem"]) && isset($salary["luong_coban"]) && $thang != "1970-01-01")
				{
					
					$salary['thang'] = $thang; 
					$salary["luong_coban"] 	= str_replace(",", "", $salary["luong_coban"]);
					$salary["trachnhiem"] = str_replace(",", "", $salary["trachnhiem"]);
					$salary["phucap_luong"] = str_replace(",", "", $salary["phucap_luong"]);
					$salary["kiemnhiem"] = str_replace(",", "", $salary["kiemnhiem"]);
					$salary["phucap_dilai"] = str_replace(",", "", $salary["phucap_dilai"]);
					$salary["chuyencan"] = str_replace(",", "", $salary["phucap_dilai"]);
					$salary["phucap_dienthoai"] = str_replace(",", "", $salary["phucap_dienthoai"]);
					$salary["luong_baohiem"] = str_replace(",", "", $salary["luong_baohiem"]);
					$salary["songay"] = str_replace(",", "", $salary["songay"]);
					$salary["mucthuong"] = str_replace(",", "", $salary["mucthuong"]);
				

				// kiểm tra phần tử id của mảng có giá trị hay không, nếu có thì sửa, không có thì thêm
				// Chỉ lưu giá trị ngày tháng khi nhập
					//print_r($salary);
					$this->Salary->save($salary);
				}
			}
			//chuyển về trang danh sách lương
			$this->redirect("/salary/index_salary.html");
		}

		// kiểm tra nếu có id thì sửa
		if ($id != "") {
			$array_edit = $this->Salary->find("all", array("conditions" => "id=$id"));
			$html_result = $this->View->render("edit_salary.php", array("array_edit" => $array_edit));
			echo $html_result;
		}

		// BEGIN: Kiểm tra điều kiện submit từ form tìm kiếm
		$dk = "";
		$name = "";
		$dk = "fullname LIKE '%%'";

		// Kiểm tra có tham số name hay không để đưa vào điều kiện tìm kiếm theo họ tên
		if (isset($_GET["name"])) {
			$name = $_GET["name"];
			$dk = "A.fullname LIKE '%$name%'";
		}

		// Kiểm tra có tham số  id_department hay không để đưa vào điều kiện tìm kiếm theo phòng ban
		$id_department = "";
		if (isset($_GET["id_department"])) {
			$id_department = $_GET["id_department"];
			if ($id_department != "") {
				if ($dk != "") {
					$dk .= " AND ";
				}

				$dk .= "A.id_department = '$id_department' ";
			}
		}

		// Kiểm tra có tham số  id_position hay không để đưa vào điều kiện tìm kiếm theo chức vụ
		$id_position = "";
		if (isset($_GET["id_position"]) && $_GET["id_position"] != "") {
			$id_position = $_GET["id_position"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " A.id_position = '$id_position' ";

		}

		// Kiểm tra có tham số  id_job hay không để đưa vào điều kiện tìm kiếm theo công việc
		$id_job = "";
		if (isset($_GET["id_job"]) && $_GET["id_job"] != "") {
			$id_job = $_GET["id_job"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " A.id_job = '$id_job' ";

		}
		// Kiểm tra có tham số  id_factory hay không để đưa vào điều kiện tìm kiếm theo nhà máy
		$id_factory = "";
		if (isset($_GET["id_factory"]) && $_GET["id_factory"] != "") {
			$id_factory = $_GET["id_factory"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= "A.id_factory = '$id_factory' ";

		}

		// Kiểm tra có tham số  id_manufactory hay không để đưa vào điều kiện tìm kiếm theo phân xưởng
		$id_manufactory = "";
		if (isset($_GET["id_manufactory"]) && $_GET["id_manufactory"] != "") {
			$id_manufactory = $_GET["id_manufactory"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= "A.id_manufactory = '$id_manufactory' ";
		}

		$id_group = "";
		if (isset($_GET["id_group"]) && $_GET["id_group"] != "") {
			$id_group = $_GET["id_group"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= "A.id_group = '$id_group' ";
		}
		// END: Kiểm tra điều kiện submit từ form tìm kiếm

		if (isset($_GET[""])) {
			$date_to = $_GET["date_to"];
		}
		$thang = "";
		if(isset($_GET["thang"]) && $_GET["thang"] != "")
		{
			$thang = "01-".$_GET["thang"];
			$thang = date("Y-m-d",strtotime($thang));
		}
		
		if($dk !="") $dk = " AND $dk";
		$sql_user = "SELECT A.*, B.thang,B.id_user FROM 
					(SELECT * FROM scm_users) AS A
					LEFT JOIN
					(SELECT * FROM scm_salary WHERE thang='$thang') AS B
					ON A.id = B.id_user WHERE B.id_user IS NULL $dk";
		$array_user = $this->User2->query($sql_user);
		
		// gọi hàm find trong đối tượng User2 với tham số là all để lấy tất cả dữ liệu trong bảng user
		//$array_user = $this->User2->find("all", array("conditions" => $dk));
		$array_salary = $this->Salary->find("all");
		$array_department = $this->Department->find("all", array("fields" => "id,name"));
		$array_position = $this->Position->find("all", array("fields" => "id,name"));
		$array_job = $this->Job->find("all", array("fields" => "id,name"));
		$array_factory = $this->Factory->find("all", array("fields" => "id,name"));
		$array_manufactory = $this->Manufactory->find("all", array("fields" => "id,name"));
		$array_group = $this->Group->find("all", array("fields" => "id,name"));
		$array_params_in_view = array("array_user" => $array_user,
			"array_salary" => $array_salary,
			"array_department" => $array_department,
			"array_position" => $array_position,
			"array_job" => $array_job,
			"array_factory" => $array_factory,
			"array_manufactory" => $array_manufactory,
			"array_group" => $array_group,
			"name" => $name,
			"id_department" => $id_department,
			"id_job" => $id_job,
			"id_position" => $id_position,
			"id_factory" => $id_factory,
			"id_manufactory" => $id_manufactory,
			"id_group" => $id_group,
			"thang"=>$thang
		);

		$html_result = $this->View->render("add_salary.php", $array_params_in_view);
		echo $html_result;
	}

	function index() {
		$this->loadModel('User2', "users");
		$this->loadModel("Salary", "salary");
		$this->loadModel("Department");
		$this->loadModel("Position");
		$this->loadModel("Job");
		$this->loadModel("Factory");
		$this->loadModel("Manufactory");
		$this->loadModel("Ext");
		$this->loadModel("Group", "groups");

		$department = "";
		$position = "";
		$factory = "";
		$job = "";
		$manufactory = "";

		$dk = "";
		$name = "";
		$date_from = "";
		$date_to = "";

		// BEGIN: KIỂM TRA ĐIỀU KIỆN

		if (isset($_GET["name"]) && $_GET["name"] != "") {
			$name = $_GET["name"];
			$dk = "full_name LIKE '%$name%'";
		}

		if (isset($_GET["date_from"]) && $_GET["date_from"] != "") {
			$date_from = "01-" . $_GET["date_from"];

			$date_from = date("Y-m-d", strtotime($date_from));
			if ($dk != "") {
				$dk .= "AND";
			}
			$dk .= " thang >= '$date_from'";

		}

		if (isset($_GET["date_to"]) && $_GET["date_to"] != "") {
			$date_to = "01-" . $_GET["date_to"];

			$date_to = date("Y-m-d", strtotime($date_to));
			if ($dk != "") {
				$dk .= "AND";
			}
			$dk .= " thang <= '$date_to'";
		}
		$id_department = "";
		if (isset($_GET["id_department"]) && $_GET["id_department"] != "") {
			$id_department = $_GET["id_department"];
			if ($id_department != "") {
				if ($dk != "") {
					$dk .= " AND ";
				}

				$dk .= " id_department = '$id_department' ";
			}
		}

		$id_factory = "";
		if (isset($_GET["id_factory"]) && $_GET["id_factory"] != "") {
			$id_factory = $_GET["id_factory"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_factory = '$id_factory' ";
		}

		$id_job = "";
		if (isset($_GET["id_job"]) && $_GET["id_job"] != "") {
			$id_job = $_GET["id_job"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_job = '$id_job' ";
		}

		$id_position = "";
		if (isset($_GET["id_position"]) && $_GET["id_position"] != "") {
			$id_position = $_GET["id_position"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_position = '$id_position' ";
		}

		$id_manufactory = "";
		if (isset($_GET["id_manufactory"]) && $_GET["id_manufactory"] != "") {
			$id_manufactory = $_GET["id_manufactory"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_manufactory = '$id_manufactory' ";
		}

		$id_group = "";
		if (isset($_GET["id_group"]) && $_GET["id_group"] != "") {
			$id_group = $_GET["id_group"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_group = '$id_group' ";
		}
		// END: KIỂM TRA ĐIỀU KIỆN

		// BEGIN: LẤY DỮ LIỆU THEO CÂU TRUY VẤN
		$array_department = $this->Department->find("all", array("fields" => "id,name"));
		$array_position = $this->Position->find("all", array("fields" => "id,name"));
		$array_job = $this->Job->find("all", array("fields" => "id,name"));
		$array_factory = $this->Factory->find("all", array("fields" => "id,name"));
		$array_manufactory = $this->Manufactory->find("all", array("fields" => "id,name"));
		$array_group = $this->Group->find("all", array("fields" => "id,name"));
		$array_salary = $this->Salary->find("all", array("conditions" => "$dk"));
		$array_ext = $this->Ext->find("all", array("fields" => "luong_om"));
		// END: LẤY DỮ LIỆU THEO CÂU TRUY VẤN

		$array_params_in_view = array(
			"array_salary" => $array_salary,
			"array_department" => $array_department,
			"array_position" => $array_position,
			"array_job" => $array_job,
			"array_factory" => $array_factory,
			"array_manufactory" => $array_manufactory,
			"array_group" => $array_group,
			// "array_edit_user" => $array_edit_user,
			"name" => $name,
			"array_ext" => $array_ext,
			"date_to" => $date_to,
			"date_from" => $date_from,
			"id_department" => $id_department,
			"id_job" => $id_job,
			"id_position" => $id_position,
			"id_factory" => $id_factory,
			"id_manufactory" => $id_manufactory,
			"id_group" => $id_group,
		);
		$html_result = $this->View->render("index_salary.php", $array_params_in_view);
		echo $html_result;
	}
	function salary_sheet() {

		$this->loadModel('User2', "users");
		$this->loadModel("Department");
		$this->loadModel("Position");
		$this->loadModel("Job");
		$this->loadModel("Factory");
		$this->loadModel("Manufactory");
		$this->loadModel("Salary", "salary");

		// BEGIN: KIỂM TRA ĐIỀU KIỆN
		$dk = "";
		$name = "";
		if (isset($_GET["name"]) && $_GET["name"] != "") {
			$name = $_GET["name"];
			$dk = "full_name LIKE '%$name%'";
		}
	
		$date_from = "";
		if (isset($_GET["date_from"]) && $_GET["date_from"] != "") {
			$date_from = "01-" . $_GET["date_from"];

			$date_from = date("Y-m-d", strtotime($date_from));
			if ($dk != "") {
				$dk .= "AND";
			}
			$dk .= " thang >= '$date_from'";

		}
		$date_to = "";
		if (isset($_GET["date_to"]) && $_GET["date_to"] != "") {
			$date_to = "01-" . $_GET["date_to"];

			$date_to = date("Y-m-d", strtotime($date_to));
			if ($dk != "") {
				$dk .= "AND";
			}
			$dk .= " thang <= '$date_to'";
		}
		$id_department = "";
		if (isset($_GET["id_department"]) && $_GET["id_department"] != "") {
			$id_department = $_GET["id_department"];
			if ($id_department != "") {
				if ($dk != "") {
					$dk .= " AND ";
				}

				$dk .= " id_department = '$id_department' ";
			}
		}

		$id_factory = "";
		if (isset($_GET["id_factory"]) && $_GET["id_factory"] != "") {
			$id_factory = $_GET["id_factory"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_factory = '$id_factory' ";
		}

		$id_job = "";
		if (isset($_GET["id_job"]) && $_GET["id_job"] != "") {
			$id_job = $_GET["id_job"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_job = '$id_job' ";
		}

		$id_position = "";
		if (isset($_GET["id_position"]) && $_GET["id_position"] != "") {
			$id_position = $_GET["id_position"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_position = '$id_position' ";
		}

		$id_manufactory = "";
		if (isset($_GET["id_manufactory"]) && $_GET["id_manufactory"] != "") {
			$id_manufactory = $_GET["id_manufactory"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_manufactory = '$id_manufactory' ";
		}
		// END: KIỂM TRA ĐIỀU KIỆN
		$array_user = $this->User2->find("all");
		$array_department = $this->Department->find("all", array("fields" => "id,name"));
		$array_position = $this->Position->find("all", array("fields" => "id,name"));
		$array_job = $this->Job->find("all", array("fields" => "id,name"));
		$array_factory = $this->Factory->find("all", array("fields" => "id,name"));
		$array_manufactory = $this->Manufactory->find("all", array("fields" => "id,name"));
		$array_salary = $this->Salary->find("all",array("conditions"=>$dk));

		$array_params_view = array(
			"array_salary"=>$array_salary,
			"array_user" => $array_user,
			"array_department" => $array_department,
			"array_position" => $array_position,
			"array_job" => $array_job,
			"array_factory" => $array_factory,
			"array_manufactory" => $array_manufactory,
			"name" => $name,
			"date_to" => $date_to,
			"date_from" => $date_from,
			"id_department" => $id_department,
			"id_job" => $id_job,
			"id_position" => $id_position,
			"id_factory" => $id_factory,
			"id_manufactory" => $id_manufactory,
		);
		$html_result = $this->View->render("salary_sheet.php", $array_params_view,false);
		echo $html_result;
	}

	function print_salary()
	{
		$this->loadModel("Salary","salary");
		//$file_url = "dulieu_tonkho.xls";
		//header('Content-Type: application/octet-stream');
		//header("Content-Transfer-Encoding: Binary");
		//header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");
		$dk = "";
		$name = "";
		if (isset($_GET["name"]) && $_GET["name"] != "") {
			$name = $_GET["name"];
			$dk = "full_name LIKE '%$name%'";
		}
	
		$date_from = "";
		if (isset($_GET["date_from"]) && $_GET["date_from"] != "") {
			$date_from = "01-" . $_GET["date_from"];

			$date_from = date("Y-m-d", strtotime($date_from));
			if ($dk != "") {
				$dk .= "AND";
			}
			$dk .= " thang >= '$date_from'";

		}
		$date_to = "";
		if (isset($_GET["date_to"]) && $_GET["date_to"] != "") {
			$date_to = "01-" . $_GET["date_to"];

			$date_to = date("Y-m-d", strtotime($date_to));
			if ($dk != "") {
				$dk .= "AND";
			}
			$dk .= " thang <= '$date_to'";
		}
		$id_department = "";
		if (isset($_GET["id_department"]) && $_GET["id_department"] != "") {
			$id_department = $_GET["id_department"];
			if ($id_department != "") {
				if ($dk != "") {
					$dk .= " AND ";
				}

				$dk .= " id_department = '$id_department' ";
			}
		}

		$id_factory = "";
		if (isset($_GET["id_factory"]) && $_GET["id_factory"] != "") {
			$id_factory = $_GET["id_factory"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_factory = '$id_factory' ";
		}

		$id_job = "";
		if (isset($_GET["id_job"]) && $_GET["id_job"] != "") {
			$id_job = $_GET["id_job"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_job = '$id_job' ";
		}

		$id_position = "";
		if (isset($_GET["id_position"]) && $_GET["id_position"] != "") {
			$id_position = $_GET["id_position"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_position = '$id_position' ";
		}

		$id_manufactory = "";
		if (isset($_GET["id_manufactory"]) && $_GET["id_manufactory"] != "") {
			$id_manufactory = $_GET["id_manufactory"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_manufactory = '$id_manufactory' ";
		}
		$array_salary = $this->Salary->find("all",array("conditions"=>$dk));
		$array_salary = array(
			"array_salary" => $array_salary,
		);
		$html = $this->View->render("print_salary.php", $array_salary, false);
		echo $html;
		
	}
	function temp_income_tax() {
		$this->loadModel("Income_tax", "income_tax");
		$this->loadModel("Department");
		$this->loadModel("Position");
		$this->loadModel("Job");
		$this->loadModel("Factory");
		$this->loadModel("Manufactory");

		// BEGIN:KIỂM TRA ĐIỀU KIỆN SUBMIT TỪ FORM SEARCH
		$dk = "";

		// KIỂM TRA ĐIỀU KIỆN TÊN
		$name = "";
		if (isset($_GET["name"])) {
			$name = $_GET["name"];
			$dk = "full_name LIKE '%$name%'";
		}

		// KIỂM TRA ĐIỀU KIỆN TỪ NGÀY
		$date_from = "";
		if (isset($_GET["date_from"]) && ($_GET["date_from"]) != "") {
			$date_from = "01-" . $_GET["date_from"];

			$date_from = date("Y-m-d", strtotime($date_from));
			if ($dk != "") {
				$dk .= "AND";
			}
			$dk .= " thang >= '$date_from'";
		}

		// KIỂM TRA ĐIỀU KIỆN ĐẾN NGÀY
		$date_to = "";
		if (isset($_GET["date_to"]) && ($_GET["date_to"]) != "") {

			$date_to = "30-" . $_GET["date_to"];
			$date_to = date("Y-m-d", strtotime($date_to));
			if ($dk != "") {
				$dk .= "AND";
			}
			$dk .= " thang <= '$date_to'";
		}

		// KIỂM TRA ĐIỀU KIỆN CỦA PHÒNG BAN
		$id_department = "";
		if (isset($_GET["id_department"])) {
			$id_department = $_GET["id_department"];
			if ($id_department != "") {
				if ($dk != "") {
					$dk .= " AND ";
				}

				$dk .= " id_department = '$id_department' ";
			}
		}

		// KIỂM TRA ĐIỀU KIỆN CỦA NHÀ MÁY
		$id_factory = "";
		if (isset($_GET["id_factory"]) && $_GET["id_factory"] != "") {
			$id_factory = $_GET["id_factory"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_factory = '$id_factory' ";
		}

		// KIỂM TRA ĐIỀU KIỆN CỦA CÔNG VIỆC
		$id_job = "";
		if (isset($_GET["id_job"]) && $_GET["id_job"] != "") {
			$id_job = $_GET["id_job"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= "id_job= '$id_job' ";
		}

		// KIỂM TRA ĐIỀU KIỆN CỦA CHỨC VỤ
		$id_position = "";
		if (isset($_GET["id_position"]) && $_GET["id_position"] != "") {
			$id_position = $_GET["id_position"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_position = '$id_position' ";
		}

		// KIỂM TRA ĐIỀU KIỆN CỦA PHÂN XƯỞNG
		$id_manufactory = "";
		if (isset($_GET["id_manufactory"]) && $_GET["id_manufactory"] != "") {
			$id_manufactory = $_GET["id_manufactory"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_manufactory = '$id_manufactory' ";
		}
		// BEGIN:KIỂM TRA ĐIỀU KIỆN SUBMIT TỪ FORM SEARCH
		$array_income_tax = $this->Income_tax->find("all", array("conditions" => $dk));
		$array_department = $this->Department->find("all", array("fields" => "id,name"));
		$array_position = $this->Position->find("all", array("fields" => "id,name"));
		$array_job = $this->Job->find("all", array("fields" => "id,name"));
		$array_factory = $this->Factory->find("all", array("fields" => "id,name"));
		$array_manufactory = $this->Manufactory->find("all", array("fields" => "id,name"));
		$array_params_in_view = array(
			"array_income_tax" => $array_income_tax,
			"array_department" => $array_department,
			"array_position" => $array_position,
			"array_job" => $array_job,
			"array_factory" => $array_factory,
			"array_manufactory" => $array_manufactory,
			"date_to" => $date_to,
			"date_from" => $date_from,
			"id_department" => $id_department,
			"id_job" => $id_job,
			"id_position" => $id_position,
			"id_factory" => $id_factory,
			"id_manufactory" => $id_manufactory,
			"name" => $name,
		);
		$html_result = $this->View->render("list_income_tax.php", $array_params_in_view);
		echo $html_result;
	}

	function add_temp_income_tax($id = "") {
		$this->loadModel("Income_tax", "income_tax");
		$this->loadModel('User2', "users");
		$this->loadModel("Salary", "salary");
		$this->loadModel("Department");
		$this->loadModel("Position");
		$this->loadModel("Job");
		$this->loadModel("Factory");
		$this->loadModel("Manufactory");
		if (isset($_POST["data"])) {
			$data = $_POST["data"];
			$thang = "01-" . $_POST["thang"];
			$tien = $_POST["tien"];
			$thue_5 = $_POST["5"];
			$thue_10 = $_POST["10"];
			$thue_15 = $_POST["15"];
			$thue_20 = $_POST["20"];
			$thang = date("Y-m-01 ", strtotime($thang));

			foreach ($data as $value) {
				$value["tien"] = $tien;
				$value["thue_5"] = $thue_5;
				$value["thue_10"] = $thue_10;
				$value["thue_15"] = $thue_15;
				$value["thue_20"] = $thue_20;

				$value["thang"] = $thang;
				// Thay dấu , = "" trong dữ liệu submit qua
				$value["tien"] = str_replace(",", "", $value["tien"]);
				$value["thue_5"] = str_replace(",", "", $value["thue_5"]);
				$value["thue_10"] = str_replace(",", "", $value["thue_10"]);
				$value["thue_15"] = str_replace(",", "", $value["thue_15"]);
				$value["thue_20"] = str_replace(",", "", $value["thue_20"]);
				$value["kt_banthan"] = str_replace(",", "", $value["kt_banthan"]);

				// kiểm tra user nào có dữ liệu thì mới lưu
				if ($value["kt_banthan"] != "" || $value["songuoi"] != "") {
					$this->Income_tax->save($value);
				}

			}
			$this->redirect("/salary/temp_income_tax");

		}

		// BEGIN: KIỂM TRA ĐIỀU KIỆN SUBMIT TỪ FORM
		$dk = "";
		$name = "";
		if (isset($_GET["name"])) {
			$name = $_GET["name"];
			$dk = "fullname LIKE '%$name%'";
		}
		$id_department = "";
		if (isset($_GET["id_department"])) {
			$id_department = $_GET["id_department"];
			if ($id_department != "") {
				if ($dk != "") {
					$dk .= " AND ";
				}

				$dk .= " id_department = '$id_department' ";
			}
		}

		$id_factory = "";
		if (isset($_GET["id_factory"]) && $_GET["id_factory"] != "") {
			$id_factory = $_GET["id_factory"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_factory = '$id_factory' ";

		}

		$id_job = "";
		if (isset($_GET["id_job"]) && $_GET["id_job"] != "") {
			$id_job = $_GET["id_job"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= "id_work= '$id_job' ";

		}

		$id_position = "";
		if (isset($_GET["id_position"]) && $_GET["id_position"] != "") {
			$id_position = $_GET["id_position"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_position = '$id_position' ";

		}

		$id_manufactory = "";
		if (isset($_GET["id_manufactory"]) && $_GET["id_manufactory"] != "") {
			$id_manufactory = $_GET["id_manufactory"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_manufactory = '$id_manufactory' ";
		}
		// END: KIỂM TRA ĐIỀU KIỆN SUBMIT TỪ FORM

		$array_user = $this->User2->find("all", array("conditions" => $dk));
		$array_department = $this->Department->find("all", array("fields" => "id,name"));
		$array_position = $this->Position->find("all", array("fields" => "id,name"));
		$array_job = $this->Job->find("all", array("fields" => "id,name"));
		$array_factory = $this->Factory->find("all", array("fields" => "id,name"));
		$array_manufactory = $this->Manufactory->find("all", array("fields" => "id,name"));

		$array_edit = $this->Income_tax->find("all", array("conditions" => "id='$id'"));
		$array_params_in_view = array(
			"array_user" => $array_user,
			"array_department" => $array_department,
			"array_position" => $array_position,
			"array_job" => $array_job,
			"array_factory" => $array_factory,
			"array_manufactory" => $array_manufactory,
			"array_edit" => $array_edit,
			"id_department" => $id_department,
			"id_job" => $id_job,
			"id_position" => $id_position,
			"id_factory" => $id_factory,
			"id_manufactory" => $id_manufactory,
			"name" => $name,
		);

		$html_result = $this->View->render("add_income_tax.php", $array_params_in_view);
		echo $html_result;

	}
	function add_fee($id = "") {
		$this->loadModel("Fee", "fee");
		$this->loadModel('User2', "users");
		$this->loadModel("Department");
		$this->loadModel("Position");
		$this->loadModel("Job");
		$this->loadModel("Factory");
		$this->loadModel("Manufactory");
		$this->loadModel("Group");
		if (isset($_POST["data"])) {
			$data = $_POST["data"];
			$thang = "01-" . $data["thang"];
			$thang = date("Y-m-d", strtotime($thang));
			$data["thang"] = $thang;
			$id_user = $data["id_user"];
			$array_user2 = $this->User2->find("all",array("conditions"=>"id='$id_user'"));
			$data["user_code"] = $array_user2[0]["user_code"];
			$data["full_name"] = $array_user2[0]["fullname"];
			$data["id_factory"] = $array_user2[0]["id_factory"];
			$data["id_manufactory"] = $array_user2[0]["id_manufactory"];
			$data["id_position"] = $array_user2[0]["id_position"];
			$data["id_job"] = $array_user2[0]["id_job"];
			$data["id_group"] = $array_user2[0]["id_group"];
			$this->Fee->save($data);
			$this->redirect("/salary/fee");
		}
		
		if ($id != "") {
			$array_edit = $this->Fee->find("all", array("conditions" => "id=$id"));
			$html_result = $this->View->render("edit_fee.php", array("array_edit" => $array_edit));
			echo $html_result;

		}

		// BEGIN: KIỂM TRA ĐK KIỆN TỪ FORM SEARCH
		$dk = "";

		$id_factory = "";
		if (isset($_GET["id_factory"]) && $_GET["id_factory"] != "") {
			$id_factory = $_GET["id_factory"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_factory = '$id_factory' ";

		}
		
		$id_manufactory = "";
		if (isset($_GET["id_manufactory"]) && $_GET["id_manufactory"] != "") {
			$id_manufactory = $_GET["id_manufactory"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_manufactory = '$id_manufactory' ";
		}
		
		$id_position = "";
		if (isset($_GET["id_position"]) && $_GET["id_position"] != "") {
			$id_position = $_GET["id_position"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_position = '$id_position' ";

		}

		$id_job = "";
		if (isset($_GET["id_job"]) && $_GET["id_job"] != "") {
			$id_job = $_GET["id_job"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= "id_job= '$id_job' ";

		}
		
		$id_group = "";
		if (isset($_GET["id_group"]) && $_GET["id_group"] != "") {
			$id_group = $_GET["id_group"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= "id_group= '$id_group' ";

		}
		
		$name = "";
		if (isset($_GET["name"]) && $_GET["name"] != "") {
			$name = $_GET["name"];
			$dk = "fullname LIKE '%$name%' OR user_code LIKE '%$name%'";
		}
		
		// BEGIN: KIỂM TRA ĐK KIỆN TỪ FORM SEARCH
		$array_user = array(""=>array("id"=>"","fullname"=>"Chọn nhân viên"));
		$array_user += $this->User2->find("all", array("fields"=>"id,fullname","conditions" => $dk));
		
		$array_factory = array(""=>array("id"=>"","name"=>"Chọn nhà máy"));
		$array_factory += $this->Factory->find("all", array("fields" => "id,name"));
		
		$array_manufactory = array(""=>array("id"=>"","name"=>"Chọn xưởng"));
		$array_manufactory += $this->Manufactory->find("all", array("fields" => "id,name"));
		
		$array_position = array(""=>array("id"=>"","name"=>"Chọn chức vụ"));
		$array_position += $this->Position->find("all", array("fields" => "id,name"));
		
		$array_job = array(""=>array("id"=>"","name"=>"Chọn bộ phận"));
		$array_job += $this->Job->find("all", array("fields" => "id,name"));
		
		$array_group = array(""=>array("id"=>"","name"=>"Chọn tổ"));
		$array_group += $this->Group->find("all", array("fields" => "id,name"));

		$array_params_view = array(
			"array_user" => $array_user,
			"array_position" => $array_position,
			"array_job" => $array_job,
			"array_factory" => $array_factory,
			"array_manufactory" => $array_manufactory,
			"array_group"=>$array_group,
			"name" => $name,
			"id_job" => $id_job,
			"id_position" => $id_position,
			"id_factory" => $id_factory,
			"id_manufactory" => $id_manufactory,
			"id_group"=>$id_group,
		);
		$html_result = $this->View->render("add_work_fee.php", $array_params_view);
		echo $html_result;
	}

	function fee() {

		$this->loadModel("Fee", "fee");
		$this->loadModel("Department");
		$this->loadModel("Position");
		$this->loadModel("Job");
		$this->loadModel("Factory");
		$this->loadModel("Manufactory");

		// BEGIN: KIỂM TRA ĐIỀU KIỆN TỪ FORM SEARCH
		$dk = "";
		$name = "";
		$date_from = "";
		$date_to = "";
		if (isset($_GET["name"]) && $_GET["name"] != "") {
			$name = $_GET["name"];
			$dk = "full_name LIKE '%$name%'";
		}
		if (isset($_GET["date_from"]) && $_GET["date_from"] != "") {
			$date_from = "01-" . $_GET["date_from"];

			$date_from = date("Y-m-d", strtotime($date_from));
			if ($dk != "") {
				$dk .= "AND";
			}
			$dk .= " thang >= '$date_from'";

		}

		if (isset($_GET["date_to"]) && $_GET["date_to"] != "") {
			$date_to = "01-" . $_GET["date_to"];

			$date_to = date("Y-m-d", strtotime($date_to));
			if ($dk != "") {
				$dk .= "AND";
			}
			$dk .= " thang <= '$date_to'";
		}
		$id_department = "";
		if (isset($_GET["id_department"]) && $_GET["id_department"] != "") {
			$id_department = $_GET["id_department"];

			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_department = '$id_department' ";

		}

		$id_factory = "";
		if (isset($_GET["id_factory"]) && $_GET["id_factory"] != "") {
			$id_factory = $_GET["id_factory"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_factory = '$id_factory' ";

		}

		$id_job = "";
		if (isset($_GET["id_job"]) && $_GET["id_job"] != "") {
			$id_job = $_GET["id_job"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= "id_job= '$id_job' ";

		}

		$id_position = "";
		if (isset($_GET["id_position"]) && $_GET["id_position"] != "") {
			$id_position = $_GET["id_position"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_position = '$id_position' ";

		}

		$id_manufactory = "";
		if (isset($_GET["id_manufactory"]) && $_GET["id_manufactory"] != "") {
			$id_manufactory = $_GET["id_manufactory"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_manufactory = '$id_manufactory' ";
		}
		// END: KIỂM TRA ĐIỀU KIỆN TỪ FORM SEARCH

		$array_fee = $this->Fee->find("all", array("conditions" => $dk));
		$array_department = $this->Department->find("all", array("fields" => "id,name"));
		$array_position = $this->Position->find("all", array("fields" => "id,name"));
		$array_job = $this->Job->find("all", array("fields" => "id,name"));
		$array_factory = $this->Factory->find("all", array("fields" => "id,name"));
		$array_manufactory = $this->Manufactory->find("all", array("fields" => "id,name"));

		$array_params_view = array(
			"array_department" => $array_department,
			"array_position" => $array_position,
			"array_job" => $array_job,
			"array_factory" => $array_factory,
			"array_manufactory" => $array_manufactory,
			"array_fee" => $array_fee,
			"name" => $name,
			"id_department" => $id_department,
			"id_job" => $id_job,
			"id_position" => $id_position,
			"id_factory" => $id_factory,
			"id_manufactory" => $id_manufactory,
			"date_from" => $date_from,
			"date_to" => $date_to,
		);
		$html_result = $this->View->render("list_work_fee.php", $array_params_view);
		echo $html_result;
	}

	function add_ext($id = "") {

		$this->loadModel("Ext", "exts");
		$this->loadModel('User2', "users");
		$this->loadModel("Department");
		$this->loadModel("Position");
		$this->loadModel("Job");
		$this->loadModel("Factory");
		$this->loadModel("Manufactory");
		if (isset($_POST["data"])) {
			$data = $_POST["data"];
			$thang = "01-" . $_POST["thang"];

			$thang = date("Y-m-01 ", strtotime($thang));

			foreach ($data as $value) {
				$value["thang"] = $thang;
				$value["luong_om"] = str_replace(",", "", $value["luong_om"]);
				$value["luong_dieuchinh"] = str_replace(",", "", $value["luong_dieuchinh"]);
				$value["tien_dienthoai"] = str_replace(",", "", $value["tien_dienthoai"]);
				$value["tien_noiquy"] = str_replace(",", "", $value["tien_noiquy"]);
				$value["tien_ng"] = str_replace(",", "", $value["tien_ng"]);
				$value["tien_dulich"] = str_replace(",", "", $value["tien_dulich"]);
				$value["tien_dongphuc"] = str_replace(",", "", $value["tien_dongphuc"]);
				$value["tru_luongung"] = str_replace(",", "", $value["tru_luongung"]);

				if ($value["luong_om"] != "" && $value["luong_dieuchinh"] != "") {
					$this->Ext->save($value);
				}

			}
			$this->redirect("/salary/ext");
		}

		if ($id != "") {
			$array_edit = $this->Ext->find("all", array("conditions" => "id=$id"));

		}

		// BEGIN: KIỂM TRA ĐK TỪ FORM SEARCH
		$dk = "";
		$name = "";
		if (isset($_GET["name"])) {
			$name = $_GET["name"];
			$dk = "fullname LIKE '%$name%'";
		}
		$id_department = "";
		if (isset($_GET["id_department"])) {
			$id_department = $_GET["id_department"];
			if ($id_department != "") {
				if ($dk != "") {
					$dk .= " AND ";
				}

				$dk .= " id_department = '$id_department' ";
			}
		}

		$id_factory = "";
		if (isset($_GET["id_factory"]) && $_GET["id_factory"] != "") {
			$id_factory = $_GET["id_factory"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_factory = '$id_factory' ";

		}

		$id_job = "";
		if (isset($_GET["id_job"]) && $_GET["id_job"] != "") {
			$id_job = $_GET["id_job"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= "id_work= '$id_job' ";

		}

		$id_position = "";
		if (isset($_GET["id_position"]) && $_GET["id_position"] != "") {
			$id_position = $_GET["id_position"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_position = '$id_position' ";

		}

		$id_manufactory = "";
		if (isset($_GET["id_manufactory"]) && $_GET["id_manufactory"] != "") {
			$id_manufactory = $_GET["id_manufactory"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_manufactory = '$id_manufactory' ";
		}
		// END: KIỂM TRA ĐK TỪ FORM SEARCH

		$array_user = $this->User2->find("all", array("conditions" => $dk));
		$array_department = $this->Department->find("all", array("fields" => "id,name"));
		$array_position = $this->Position->find("all", array("fields" => "id,name"));
		$array_job = $this->Job->find("all", array("fields" => "id,name"));
		$array_factory = $this->Factory->find("all", array("fields" => "id,name"));
		$array_manufactory = $this->Manufactory->find("all", array("fields" => "id,name"));
		$array_params_view = array(
			"array_user" => $array_user,
			"array_department" => $array_department,
			"array_position" => $array_position,
			"array_job" => $array_job,
			"array_factory" => $array_factory,
			"array_manufactory" => $array_manufactory,
			"array_edit" => $array_edit,
			"name" => $name,
			"id_department" => $id_department,
			"id_job" => $id_job,
			"id_position" => $id_position,
			"id_factory" => $id_factory,
			"id_manufactory" => $id_manufactory,
		);

		$html_result = $this->View->render("add_ext.php", $array_params_view);
		echo $html_result;
	}

	function ext() {

		$this->loadModel("Ext", "exts");
		$this->loadModel("Department");
		$this->loadModel("Position");
		$this->loadModel("Job");
		$this->loadModel("Factory");
		$this->loadModel("Manufactory");

		$dk = "";
		$name = "";
		$date_from = "";
		$date_to = "";

		// BEGIN: KIỂM TRA ĐK TỪ FORM SEARCH
		if (isset($_GET["name"]) && $_GET["name"] != "") {
			$name = $_GET["name"];
			$dk = "full_name LIKE '%$name%'";
		}
		if (isset($_GET["date_from"]) && $_GET["date_from"] != "") {
			$date_from = "01-" . $_GET["date_from"];

			$date_from = date("Y-m-d", strtotime($date_from));
			if ($dk != "") {
				$dk .= "AND";
			}
			$dk .= " thang >= '$date_from'";

		}

		if (isset($_GET["date_to"]) && $_GET["date_to"] != "") {
			$date_to = "01-" . $_GET["date_to"];

			$date_to = date("Y-m-d", strtotime($date_to));
			if ($dk != "") {
				$dk .= "AND";
			}
			$dk .= " thang <= '$date_to'";

		}
		$id_department = "";
		if (isset($_GET["id_department"]) && $_GET["id_department"] != "") {
			$id_department = $_GET["id_department"];

			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_department = '$id_department' ";

		}

		$id_factory = "";
		if (isset($_GET["id_factory"]) && $_GET["id_factory"] != "") {
			$id_factory = $_GET["id_factory"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_factory = '$id_factory' ";

		}

		$id_job = "";
		if (isset($_GET["id_job"]) && $_GET["id_job"] != "") {
			$id_job = $_GET["id_job"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= "id_job= '$id_job' ";

		}

		$id_position = "";
		if (isset($_GET["id_position"]) && $_GET["id_position"] != "") {
			$id_position = $_GET["id_position"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_position = '$id_position' ";

		}

		$id_manufactory = "";
		if (isset($_GET["id_manufactory"]) && $_GET["id_manufactory"] != "") {
			$id_manufactory = $_GET["id_manufactory"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_manufactory = '$id_manufactory' ";
		}
		// END: KIỂM TRA ĐK TỪ FORM SEARCH

		$array_ext = $this->Ext->find("all", array("conditions" => $dk));
		$array_department = $this->Department->find("all", array("fields" => "id,name"));
		$array_position = $this->Position->find("all", array("fields" => "id,name"));
		$array_job = $this->Job->find("all", array("fields" => "id,name"));
		$array_factory = $this->Factory->find("all", array("fields" => "id,name"));
		$array_manufactory = $this->Manufactory->find("all", array("fields" => "id,name"));

		$array_params_view = array(
			"array_ext" => $array_ext,
			"array_department" => $array_department,
			"array_position" => $array_position,
			"array_job" => $array_job,
			"array_factory" => $array_factory,
			"array_manufactory" => $array_manufactory,
			"name" => $name,
			"id_department" => $id_department,
			"id_job" => $id_job,
			"id_position" => $id_position,
			"id_factory" => $id_factory,
			"id_manufactory" => $id_manufactory,
			"date_from" => $date_from,
			"date_to" => $date_to,
		);
		$html_result = $this->View->render("list_ext.php", $array_params_view);
		echo $html_result;
	}

	function add_maternity($id = "") {

		$this->loadModel('User2', "users");
		$this->loadModel("Salary", "salary");
		$this->loadModel("Salary_Maternity", "salary_maternities");
		$this->loadModel("Department");
		$this->loadModel("Position");
		$this->loadModel("Job");
		$this->loadModel("Factory");
		$this->loadModel("Manufactory");
		if (isset($_POST['data'])) {
			$data = $_POST['data'];
			$thang = "01-" . $_POST['ngay'];
			foreach ($data as $maternity) {
				if ($maternity["id"] == "") {
					$thang = date("Y-m-01", strtotime($thang));
					$maternity['thang'] = $thang;
				}

				// Thay dấu , = "" trong dữ liệu submit qua
				$maternity["tien_thaisan"] = str_replace(",", "", $maternity["tien_thaisan"]);
				$maternity["phucap_thaisan"] = str_replace(",", "", $maternity["phucap_thaisan"]);

				// Kiểm tra điều kiện nhập vào trước khi lưu
				if (($maternity["tien_thaisan"] != "") || ($maternity["phucap_thaisan"] != "")) {
					$this->Salary_Maternity->save($maternity);
				}
			}
			$this->redirect("/salary/maternity.html");
		}
		if (isset($_GET["id_department"])) {
			$id_department = $_GET["id_department"];
		}

		if (isset($_GET["id_position"])) {
			$id_position = $_GET["id_position"];
		}

		if (isset($_GET["id_factory"])) {
			$id_factory = $_GET["id_factory"];
		}

		if (isset($_GET["id_job"])) {
			$id_job = $_GET["id_job"];
		}

		if (isset($_GET["id_manufactory"])) {
			$id_manufactory = $_GET["id_manufactory"];
		}

		if (isset($_GET["date_from"])) {
			$date_from = $_GET["date_from"];
		}

		if (isset($_GET["date_to"])) {
			$date_to = $_GET["date_to"];
		}

		$dk = "";
		$name = "";
		$thang = "";
		if (isset($_GET["thang"])) {
			$thang = $_GET["thang"];
		}

		if (isset($_GET["name"])) {
			$name = $_GET["name"];
			$dk = "fullname LIKE '%$name%'";
		}
		$id_department = "";
		if (isset($_GET["id_department"])) {
			$id_department = $_GET["id_department"];
			if ($id_department != "") {
				if ($dk != "") {
					$dk .= " AND ";
				}

				$dk .= " id_department = '$id_department' ";
			}
		}

		$id_factory = "";
		if (isset($_GET["id_factory"]) && $_GET["id_factory"] != "") {
			$id_factory = $_GET["id_factory"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_factory = '$id_factory' ";
		}

		$id_job = "";
		if (isset($_GET["id_job"]) && $_GET["id_job"] != "") {
			$id_job = $_GET["id_job"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= "id_work = '$id_job' ";
		}

		$id_position = "";
		if (isset($_GET["id_position"]) && $_GET["id_position"] != "") {
			$id_position = $_GET["id_position"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_position = '$id_position' ";
		}

		$id_manufactory = "";
		if (isset($_GET["id_manufactory"]) && $_GET["id_manufactory"] != "") {
			$id_manufactory = $_GET["id_manufactory"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_manufactory = '$id_manufactory' ";
		}

		$array_user = $this->User2->find("all", array("conditions" => $dk));
		$array_salary = $this->Salary->find("all");
		$array_department = $this->Department->find("all", array("fields" => "id,name"));
		$array_position = $this->Position->find("all", array("fields" => "id,name"));
		$array_job = $this->Job->find("all", array("fields" => "id,name"));
		$array_factory = $this->Factory->find("all", array("fields" => "id,name"));
		$array_manufactory = $this->Manufactory->find("all", array("fields" => "id,name"));
		$array_edit = null;

		if ($id != "") {
			$array_edit = $this->Salary_Maternity->find("all", array("conditions" => "`id`=$id"));
		}

		$array_params_in_view = array(
			"array_user" => $array_user,
			"array_salary" => $array_salary,
			"array_department" => $array_department,
			"array_position" => $array_position,
			"array_job" => $array_job,
			"array_factory" => $array_factory,
			"array_manufactory" => $array_manufactory,
			"array_edit" => $array_edit,
			"thang" => $thang,
			"id_department" => $id_department,
			"id_job" => $id_job,
			"id_position" => $id_position,
			"id_factory" => $id_factory,
			"id_manufactory" => $id_manufactory,
			"name" => $name,
		);
		$html_result = $this->View->render("add_salary_maternity.php", $array_params_in_view);
		echo $html_result;
	}

	function maternity() {

		$this->loadModel("Salary_Maternity", "salary_maternities");
		$this->loadModel("Department");
		$this->loadModel("Position");
		$this->loadModel("Job");
		$this->loadModel("Factory");
		$this->loadModel("Manufactory");

		if (isset($_POST['data'])) {
			$data = $_POST['data'];
			foreach ($data as $value) {

				$department = $value["id_department"];
				$position = $value["id_position"];
				$factory = $value["id_factory"];
				$job = $value["id_job"];
				$manufactory = $value["id_manufactory"];

			}
		}
		if (isset($_POST["id_department"])) {
			$id_department = $_POST["id_department"];
		}

		if (isset($_POST["id_position"])) {
			$id_position = $_POST["id_position"];
		}

		if (isset($_POST["id_factory"])) {
			$id_factory = $_POST["id_factory"];
		}

		if (isset($_POST["id_job"])) {
			$id_job = $_POST["id_job"];
		}

		if (isset($_POST["id_manufactory"])) {
			$id_manufactory = $_POST["id_manufactory"];
		}

		if (isset($_POST["date_from"])) {
			$date_from = $_POST["date_from"];
		}

		if (isset($_POST["date_to"])) {
			$date_to = $_POST["date_to"];
		}

		// BEGIN: FORM SEARCH
		$dk = "";
		$name = "";
		$date_from = "";
		$date_to = "";
		if (isset($_GET["name"]) && $_GET["name"] != "") {
			$name = $_GET["name"];
			$dk = "full_name LIKE '%$name%'";
		}
		if (isset($_GET["date_from"]) && $_GET["date_from"] != "") {
			$date_from = "01-" . $_GET["date_from"];

			$date_from = date("Y-m-d", strtotime($date_from));
			if ($dk != "") {
				$dk .= "AND";
			}
			$dk .= " thang >= '$date_from'";
		}

		if (isset($_GET["date_to"]) && $_GET["date_to"] != "") {
			$date_to = "01-" . $_GET["date_to"];

			$date_to = date("Y-m-d", strtotime($date_to));
			if ($dk != "") {
				$dk .= "AND";
			}
			$dk .= " thang <= '$date_to'";

		}
		$id_department = "";
		if (isset($_GET["id_department"]) && $_GET["id_department"] != "") {
			$id_department = $_GET["id_department"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_department = '$id_department' ";
		}

		$id_factory = "";
		if (isset($_GET["id_factory"]) && $_GET["id_factory"] != "") {
			$id_factory = $_GET["id_factory"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_factory = '$id_factory' ";

		}

		$id_job = "";
		if (isset($_GET["id_job"]) && $_GET["id_job"] != "") {
			$id_job = $_GET["id_job"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= "id_job = '$id_job' ";

		}

		$id_position = "";
		if (isset($_GET["id_position"]) && $_GET["id_position"] != "") {
			$id_position = $_GET["id_position"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_position = '$id_position' ";

		}

		$id_manufactory = "";
		if (isset($_GET["id_manufactory"]) && $_GET["id_manufactory"] != "") {
			$id_manufactory = $_GET["id_manufactory"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_manufactory = '$id_manufactory' ";
		}
		// END: FORM SEARCH

		$array_salary_maternity = $this->Salary_Maternity->find("all", array("conditions" => $dk));
		$array_department = $this->Department->find("all", array("fields" => "id,name"));
		$array_position = $this->Position->find("all", array("fields" => "id,name"));
		$array_job = $this->Job->find("all", array("fields" => "id,name"));
		$array_factory = $this->Factory->find("all", array("fields" => "id,name"));
		$array_manufactory = $this->Manufactory->find("all", array("fields" => "id,name"));

		$array_params_in_view = array(
			"array_salary_maternity" => $array_salary_maternity,
			"array_department" => $array_department,
			"array_position" => $array_position,
			"array_job" => $array_job,
			"array_factory" => $array_factory,
			"array_manufactory" => $array_manufactory,
			"date_from" => $date_from,
			"date_to" => $date_to,
			"id_department" => $id_department,
			"id_job" => $id_job,
			"id_position" => $id_position,
			"id_factory" => $id_factory,
			"id_manufactory" => $id_manufactory,
			"name" => $name);
		$html_result = $this->View->render("list_salary_maternity.php", $array_params_in_view);
		echo $html_result;
	}
	function retire() {
		$this->loadModel("Salary", "salary");
		$this->loadModel("Department");
		$this->loadModel("Position");
		$this->loadModel("Job");
		$this->loadModel("Factory");
		$this->loadModel("Manufactory");

		// BEGIN: FORM SEARCH
		$dk = "";
		$name = "";
		$date_from = "";
		$date_to = "";
		$thang = date('Y-m-d');
		if (isset($_GET["name"]) && $_GET["name"] != "") {
			$name = $_GET["name"];
			$dk = "full_name LIKE '%$name%'";
		}
		if (isset($_GET["date_from"]) && $_GET["date_from"] != "") {
			$date_from = "01-" . $_GET["date_from"];

			$date_from = date("Y-m-d", strtotime($date_from));
			if ($dk != "") {
				$dk .= "AND";
			}
			$dk .= " thang >= '$date_from'";
		}

		if (isset($_GET["date_to"]) && $_GET["date_to"] != "") {
			$date_to = "01-" . $_GET["date_to"];

			$date_to = date("Y-m-d", strtotime($date_to));
			if ($dk != "") {
				$dk .= "AND";
			}
			$dk .= " thang <= '$date_to'";

		}
		$id_department = "";
		if (isset($_GET["id_department"]) && $_GET["id_department"] != "") {
			$id_department = $_GET["id_department"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_department = '$id_department' ";
		}

		$id_factory = "";
		if (isset($_GET["id_factory"]) && $_GET["id_factory"] != "") {
			$id_factory = $_GET["id_factory"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_factory = '$id_factory' ";

		}

		$id_job = "";
		if (isset($_GET["id_job"]) && $_GET["id_job"] != "") {
			$id_job = $_GET["id_job"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= "id_job = '$id_job' ";

		}

		$id_position = "";
		if (isset($_GET["id_position"]) && $_GET["id_position"] != "") {
			$id_position = $_GET["id_position"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_position = '$id_position' ";

		}

		$id_manufactory = "";
		if (isset($_GET["id_manufactory"]) && $_GET["id_manufactory"] != "") {
			$id_manufactory = $_GET["id_manufactory"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_manufactory = '$id_manufactory' ";
		}
		// END: FORM SEARCH

		// $array_user = $this->Salary->find("all",array("conditions"=>$dk));
		$sql = "SELECT A.`date_join`, S.* FROM scm_users AS A JOIN scm_salary AS S ON S.`id_user`=A.`id`";

		$array_user = $this->Salary->query($sql);

		$array_department = $this->Department->find("all", array("fields" => "id,name"));
		$array_position = $this->Position->find("all", array("fields" => "id,name"));
		$array_job = $this->Job->find("all", array("fields" => "id,name"));
		$array_factory = $this->Factory->find("all", array("fields" => "id,name"));
		$array_manufactory = $this->Manufactory->find("all", array("fields" => "id,name"));

		$array_params_view = array(
			"array_user" => $array_user,
			"array_department" => $array_department,
			"array_position" => $array_position,
			"array_job" => $array_job,
			"array_factory" => $array_factory,
			"array_manufactory" => $array_manufactory,
			"name" => $name,
			"date_from" => $date_from,
			"date_to" => $date_to,
			"id_department" => $id_department,
			"id_job" => $id_job,
			"id_position" => $id_position,
			"id_factory" => $id_factory,
			"id_manufactory" => $id_manufactory,
			"name" => $name,
		);
		$html_result = $this->View->render("list_salary_leave.php", $array_params_view);
		echo $html_result;
	}

	function product() {

		$this->loadModel("Attendance_Product", "attendance_products");
		$this->loadModel("Department");
		$this->loadModel("Position");
		$this->loadModel("Job");
		$this->loadModel("Factory");
		$this->loadModel("Manufactory");
		$dk = "";
		$name = "";
		$date_from = "";
		$date_to = "";

		// BEGIN: kiểm tra đk submit từ form tìm kiếm
		if (isset($_GET["name"]) && $_GET["name"] != "") {
			$name = $_GET["name"];
			$dk = "fullname LIKE '%$name%'";
		}

		if (isset($_GET["date_from"]) && $_GET["date_from"] != "") {
			$date_from = "01-" . $_GET["date_from"];

			$date_from = date("Y-m-d", strtotime($date_from));
			if ($dk != "") {
				$dk .= " AND ";
			}
			$dk .= " date >= '$date_from' ";
		}
		if (isset($_GET["date_to"]) && $_GET["date_to"] != "") {
			$date_to = "01-" . $_GET["date_to"];
			$date_to = date("Y-m-d", strtotime($date_to));
			if ($dk != "") {
				$dk .= " AND ";
			}
			$dk .= " date <= '$date_to'";

		}
		$id_department = "";
		if (isset($_GET["id_department"]) && $_GET["id_department"] != "") {
			$id_department = $_GET["id_department"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_department = '$id_department' ";
		}

		$id_factory = "";
		if (isset($_GET["id_factory"]) && $_GET["id_factory"] != "") {
			$id_factory = $_GET["id_factory"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_factory = '$id_factory' ";

		}

		$id_job = "";
		if (isset($_GET["id_job"]) && $_GET["id_job"] != "") {
			$id_job = $_GET["id_job"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_work = '$id_job' ";

		}

		$id_position = "";
		if (isset($_GET["id_position"]) && $_GET["id_position"] != "") {
			$id_position = $_GET["id_position"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_position = '$id_position' ";

		}

		$id_manufactory = "";
		if (isset($_GET["id_manufactory"]) && $_GET["id_manufactory"] != "") {
			$id_manufactory = $_GET["id_manufactory"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_manufactory = '$id_manufactory' ";
		}
		// END: kiểm tra đk submit từ form tìm kiếm
		if ($dk != "") {
			$dk = " WHERE " . $dk;
		}

		// $array_user = $this->Attendance_Product->find("all",array("conditions"=>$dk));
		$array_department = $this->Department->find("all", array("fields" => "id,name"));
		$array_position = $this->Position->find("all", array("fields" => "id,name"));
		$array_job = $this->Job->find("all", array("fields" => "id,name"));
		$array_factory = $this->Factory->find("all", array("fields" => "id,name"));
		$array_manufactory = $this->Manufactory->find("all", array("fields" => "id,name"));
		$sql_user = "SELECT *,
			SUM(`thanhtien`) AS thanhtien,
			SUM( CASE WHEN  (`type_workday` =7) THEN  `thanhtien` ELSE 0 END ) AS tongso_luong_chunhat
		  FROM `scm_attendance_products` $dk GROUP BY `fullname`,`thang` ORDER BY `thang` DESC";

		$array_user = $this->Attendance_Product->query($sql_user);
		$array_params_in_view = array(
			"array_user" => $array_user,
			"array_department" => $array_department,
			"array_position" => $array_position,
			"array_job" => $array_job,
			"array_factory" => $array_factory,
			"array_manufactory" => $array_manufactory,
			"name" => $name,
			"date_from" => $date_from,
			"date_to" => $date_to,
			"id_department" => $id_department,
			"id_factory" => $id_factory,
			"id_job" => $id_job,
			"id_position" => $id_position,
			"id_manufactory" => $id_manufactory,
		);
		$html_result = $this->View->render("list_salary_product.php", $array_params_in_view);
		echo $html_result;
	}
	function summary() {

		$this->loadModel('User2', "users");
		$this->loadModel("Salary", "salary");
		$this->loadModel("Department");
		$this->loadModel("Position");
		$this->loadModel("Job");
		$this->loadModel("Factory");
		$this->loadModel("Manufactory");
		$this->loadModel("Ext");

		// BEGIN: KIỂM TRA CÓ TỒN TẠI DỮ LIỆU SUBMIT TỪ FORM LƯU HAY KHÔNG
		if (isset($_POST["data"])) {
			$data = ($_POST["data"]);
			$department = $data["id_department"];
			$position = $data["id_position"];
			$factory = $data["id_factory"];
			$job = $data["id_job"];
			$manufactory = $data["id_manufactory"];
		}
		// END: KIỂM TRA CÓ TỒN TẠI DỮ LIỆU SUBMIT TỪ FORM LƯU HAY KHÔNG

		$dk = "";
		$name = "";
		$date_from = "";
		$date_to = "";
		$dk_fee = "";
		$dk_thang_chamcong = "";

		// BEGIN: KIỂM TRA ĐIỀU KIỆN SUBMIT TỪ FORM SEARCH
		// KIỂM TRA ĐIỀU KIỆN  NAME RỒI GÁN CHO $DK
		if (isset($_GET["name"]) && $_GET["name"] != "") {

			$name = $_GET["name"];
			echo "name:" . $name;
			$dk = " A.fullname LIKE '%$name%' ";

			$dk_thang_chamcong = " fullname LIKE '%$name%'	";

			$dk_fee .= " full_name LIKE '%$name%'";

		}

		// KIỂM TRA ĐIỀU KIỆN TỪ NGÀY RỒI GÁN CHO $DK
		if (isset($_GET["date_from"]) && $_GET["date_from"] != "") {
			$date_from = "01-" . $_GET["date_from"];
			$date_from = date("Y-m-d", strtotime($date_from));
			if ($dk != "") {
				$dk .= " AND ";
			}
			$dk .= " B.thang >= '$date_from'";

			if ($dk_thang_chamcong != "") {
				$dk_thang_chamcong .= " AND";
			}

			// nếu có đk từ ngày thì lấy tháng chấm công >= tháng đã chọn
			$dk_thang_chamcong .= " `month` >= '$date_from'";
			if ($dk_fee != "") {
				$dk_fee .= " AND ";
			}

			$dk_fee .= "thang >= '$date_from'";

		}

		// KIỂM TRA ĐIỀU KIỆN ĐẾN NGÀY RỒI GÁN CHO $DK
		if (isset($_GET["date_to"]) && $_GET["date_to"] != "") {
			$date_to = "01-" . $_GET["date_to"];
			$date_to = date("Y-m-d", strtotime($date_to));
			if ($dk != "") {
				$dk .= " AND ";
			}
			$dk .= " B.thang <= '$date_to'";

			// nếu có đk đến ngày thì lấy tháng chấm công <= tháng đã chọn
			if ($dk_thang_chamcong != "") {
				$dk_thang_chamcong .= " AND";
			}

			$dk_thang_chamcong = " `month` <= '$date_to'";
			if ($dk_fee != "") {
				$dk_fee .= " AND ";
			}

			$dk_fee .= "thang <= '$date_to'";
		}

		if ($dk_fee != "") {
			$dk_fee = " WHERE " . $dk_fee;
		}

		// KIỂM TRA ĐIỀU KIỆN PHÒNG BAN RỒI GÁN CHO $DK
		$id_department = "";
		if (isset($_GET["id_department"])) {
			$id_department = $_GET["id_department"];
			if ($id_department != "") {
				if ($dk != "") {
					$dk .= " AND ";
				}

				$dk .= " A.id_department = '$id_department' ";
			}
		}

		// KIỂM TRA ĐIỀU KIỆN NHÀ MÁY RỒI GÁN CHO $DK
		$id_factory = "";
		if (isset($_GET["id_factory"]) && $_GET["id_factory"] != "") {
			$id_factory = $_GET["id_factory"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " A.id_factory = '$id_factory' ";

		}

		// KIỂM TRA ĐIỀU KIỆN CÔNG VIỆC RỒI GÁN CHO $DK
		$id_job = "";
		if (isset($_GET["id_job"]) && $_GET["id_job"] != "") {
			$id_job = $_GET["id_job"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " A.id_job = '$id_job' ";

		}

		// KIỂM TRA ĐIỀU KIỆN CHỨC VỤ RỒI GÁN CHO $DK
		$id_position = "";
		if (isset($_GET["id_position"]) && $_GET["id_position"] != "") {
			$id_position = $_GET["id_position"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " A.id_position = '$id_position' ";

		}

		// KIỂM TRA ĐIỀU KIỆN PHÂN XƯỞNG RỒI GÁN CHO $DK
		$id_manufactory = "";
		if (isset($_GET["id_manufactory"]) && $_GET["id_manufactory"] != "") {
			$id_manufactory = $_GET["id_manufactory"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " A.id_manufactory = '$id_manufactory' ";

		}
		if ($dk != "") {
			$dk = " AND " . $dk;
		}
		// END: KIỂM TRA ĐIỀU KIỆN SUBMIT TỪ FORM SEARCH

		$array_department = $this->Department->find("all", array("fields" => "id,name"));
		$array_position = $this->Position->find("all", array("fields" => "id,name"));
		$array_job = $this->Job->find("all", array("fields" => "id,name"));
		$array_factory = $this->Factory->find("all", array("fields" => "id,name"));
		$array_manufactory = $this->Manufactory->find("all", array("fields" => "id,name"));

		//$array_salary = $this->Salary->find("all",array("conditions"=>"$dk"));
		
		/*
		// lấy id, user_code, fullname,.... từ bảng A(scm_users) và thang, trachnhiem... từ bảng B(scm_salary)
		$sql_col = "A.`id`, A.`user_code`, A.`fullname`,A. `id_number`,A.`bank_account`,A.`date_join`, B.`songay`, B.`phucap_luong`, B.`phucap_dienthoai`,
		B.`kiemnhiem`, B.`luong_baohiem`, B.`mucthuong`,
		B.`thang`, B.`trachnhiem`, B.`luong_coban`, C.`tien_dienthoai`, C.`luong_om`, C.`luong_dieuchinh`, C.`tien_dulich`, C.`tien_ng`, C.`tien_noiquy`, C.`tru_luongung`, C.`soluong_ao`, C.`soluong_non`, C.`soluong_aokt`,C.`soluong_giaykt`, C.`soluong_thekeo`";

		// join 2 bảng A và B
		$sql_salary = "SELECT $sql_col FROM `scm_users` A, `scm_salary` B, `scm_exts` C WHERE (A.`id` = B.`id_user`) AND (A.`id` = C.`id_user`) AND (A.`type` <>1) $dk ";

		// hàng 1: lấy tổng số h đi làm nhóm theo `id_user`,`fullname`, `month` = giá trị cột tongso_gio
		// hàng 2: lấy tổng số h đi làm  nhóm theo `id_user`,`fullname`, `month` khi num_hour <=8
		// hàng 3: lấy tổng số ngày đi làm nhóm theo `id_user`,`fullname`, `month` khi num_hour >=8.5 thì lấy 1 ngược lại lấy 0
		$sql_chamcong_col = "`id_user`,`fullname`,`month` ,
		SUM(  `num_hour` ) tongso_gio,
		SUM( CASE WHEN  (`num_hour` <=8 AND `shift` <>3) THEN  `num_hour` ELSE 0 END ) AS tongso_gio_ngaylam_duoi_8h,
		SUM( CASE WHEN  (`num_hour` <=8 AND `shift` =3) THEN  `num_hour` ELSE 0 END ) AS tongso_gio_ngaylam_duoi_8h_ca3,
		SUM( CASE WHEN  (`shift` =3) THEN  `num_hour` ELSE 0 END ) AS tongso_gio_ca3,
		SUM( IF( (`num_hour` >= 8.5 AND `shift` <>3), 1, 0 ) ) songay_hanhchinh_lamhon_8h,
		SUM( IF( (`num_hour` >= 8.5 AND `shift` =3), 1, 0 ) ) songay_lamhon_8h_ca3,
		SUM(case when `id_date_allowance` = 8 then 1 else 0 end) as ngaynghi_vophep,
		SUM(case when `num_hour` > 8.5 then 1 else 0 end) as ngaycong_lamhon_8h,
		SUM(case when `id_date_allowance` = 1 then 1 else 0 end) as so_ngaycong_hethang,
		SUM(case when `id_date_allowance` = 2 then 1 else 0 end) as so_ngaycong_hethang_khongluong,
		SUM(case when `id_date_allowance` = 3 then 1 else 0 end) as ngaynghi_baohiem,
		SUM(case when `id_date_allowance` = 9 then 1 else 0 end) as ngaycong_khong_bamthe,
		SUM(case when `id_date_allowance` = 11 then 1 else 0 end) as ngaycong_dimuon_du8h,
		SUM(case when `id_date_allowance` = 10 then 1 else 0 end) as ngaycong_tinh_tiensua,
		SUM(case when `id_date_allowance` = 6 then 1 else 0 end) as ngaycong_chunhat";

		// nếu có điều kiện tháng chấm công
		if ($dk_thang_chamcong != "") {
			$dk_thang_chamcong = " WHERE " . $dk_thang_chamcong;
		}

		$sql_chamcong = "
		SELECT  $sql_chamcong_col FROM  `scm_attendace_times` $dk_thang_chamcong
		GROUP BY  `id_user` , `fullname` ,  `month`
		ORDER BY  `month`";

		// lấy giá đồng phục
		$sql_uniform = "SELECT `price` FROM `scm_uniforms` ";
		$array_uniform = $this->Salary->query($sql_uniform);

		$sql_fee = "SELECT thang, id_user, SUM( thanhtien ) AS tienxang_congtac FROM scm_fee $dk_fee GROUP BY  `id_user` , thang  ";
		$sql_letet = "SELECT thang, id_user, COUNT(`id_user`) AS songay_letet FROM scm_salary_holidays $dk_fee GROUP BY  `id_user` , thang  ";
		$sql_tax = "SELECT thang, id_user, kt_banthan, songuoi, tien,thue_5, thue_10,thue_15,thue_20 FROM scm_income_tax $dk_fee GROUP BY `id_user`, `thang`";

		$sql_col_summary = "SALARY.*, CHAMCONG.`tongso_gio`, CHAMCONG.`tongso_gio_ngaylam_duoi_8h`, CHAMCONG.`songay_hanhchinh_lamhon_8h`, CHAMCONG.`tongso_gio_ngaylam_duoi_8h_ca3`, CHAMCONG.`songay_lamhon_8h_ca3`, CHAMCONG.`ngaycong_chunhat`, CHAMCONG.`tongso_gio_ca3`, CHAMCONG.`ngaycong_tinh_tiensua`, FEE.`tienxang_congtac`, CHAMCONG.`ngaycong_khong_bamthe`, TET.`songay_letet`, TAX.`kt_banthan`, TAX.`songuoi`, TAX.`tien`, TAX.`thue_5`, TAX.`thue_10`, TAX.`thue_15`, TAX.`thue_20` ";

		$sql_sumary = "SELECT $sql_col_summary
						FROM ($sql_salary) SALARY
						LEFT JOIN ($sql_chamcong) AS CHAMCONG
						ON SALARY.`id` = CHAMCONG.`id_user` AND SALARY.`thang` = CHAMCONG.`month`
						LEFT JOIN ($sql_fee) FEE
						ON SALARY.`id` = FEE.`id_user` AND SALARY.`thang`= FEE.`thang`
						LEFT JOIN ($sql_letet) TET
						ON SALARY.`id` = TET.`id_user` AND SALARY.`thang` = TET.`thang`
						LEFT JOIN ($sql_tax) TAX
						ON SALARY.`id` = TAX.`id_user` AND SALARY.`thang` = TAX.`thang`
						";

		*/
		$sql_col_user = "id, user_code, fullname, id_number, bank_account, day_type";
		$sql_user = "SELECT ($sql_col_user) FROM `scm_users`";
		
		$array_salary = $this->User2->query($sql_user);
		
		$array_params_in_view = array(
			"array_salary" => $array_salary,
			"array_department" => $array_department,
			"array_position" => $array_position,
			"array_job" => $array_job,
			"array_factory" => $array_factory,
			"array_manufactory" => $array_manufactory,
			"name" => $name,
			"date_to" => $date_to,
			"date_from" => $date_from,
			"id_department" => $id_department,
			"id_job" => $id_job,
			"id_position" => $id_position,
			"id_factory" => $id_factory,
			"id_manufactory" => $id_manufactory,
			//"array_uniform" => $array_uniform,
		);

		$html_result = $this->View->render("summary.php", $array_params_in_view);

		echo $html_result;
	}

	function add_month_13th() {
		$this->loadModel("Salary_13", "salary_month_13th");
		$this->loadModel("User2", "users");
		$this->loadModel("Department");
		$this->loadModel("Position");
		$this->loadModel("Job");
		$this->loadModel("Factory");
		$this->loadModel("Manufactory");
		if (isset($_POST["data"])) {

			$array_data = $_POST["data"];
			print_r($array_data);
			foreach ($array_data as $data) {
				// print_r($data);
				// $this->Salary_13->save($data);
			}
			// $this->redirect("salary/month_13th");
		}

		$array_user = $this->User2->find("all");
		$array_department = $this->Department->find("all", array("fields" => "id,name"));
		$array_position = $this->Position->find("all", array("fields" => "id,name"));
		$array_job = $this->Job->find("all", array("fields" => "id,name"));
		$array_factory = $this->Factory->find("all", array("fields" => "id,name"));
		$array_manufactory = $this->Manufactory->find("all", array("fields" => "id,name"));
		$html_result = $this->View->render("add_month_13th_salary.php", array("array_user" => $array_user, "array_department" => $array_department, "array_position" => $array_position, "array_job" => $array_job, "array_factory" => $array_factory, "array_manufactory" => $array_manufactory));
		echo $html_result;
	}
	function month_13th() {
		$this->loadModel("User2", "users");
		$this->loadModel("Salary", "salary");
		$this->loadModel("Department");
		$this->loadModel("Position");
		$this->loadModel("Job");
		$this->loadModel("Factory");
		$this->loadModel("Manufactory");
		$dk = "";
		$name = "";
		$date_from = "";
		$date_to = "";

		// BEGIN: kiểm tra đk submit từ form tìm kiếm
		if (isset($_GET["name"]) && $_GET["name"] != "") {
			$name = $_GET["name"];
			$dk = "fullname LIKE '%$name%'";
		}

		if (isset($_GET["date_from"]) && $_GET["date_from"] != "") {
			$date_from = "01-" . $_GET["date_from"];

			$date_from = date("Y-m-d", strtotime($date_from));
			if ($dk != "") {
				$dk .= " AND ";
			}
			$dk .= " date >= '$date_from' ";
		}
		if (isset($_GET["date_to"]) && $_GET["date_to"] != "") {
			$date_to = "01-" . $_GET["date_to"];
			$date_to = date("Y-m-d", strtotime($date_to));
			if ($dk != "") {
				$dk .= " AND ";
			}
			$dk .= " date <= '$date_to'";

		}
		$id_department = "";
		if (isset($_GET["id_department"]) && $_GET["id_department"] != "") {
			$id_department = $_GET["id_department"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_department = '$id_department' ";
		}

		$id_factory = "";
		if (isset($_GET["id_factory"]) && $_GET["id_factory"] != "") {
			$id_factory = $_GET["id_factory"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_factory = '$id_factory' ";

		}

		$id_job = "";
		if (isset($_GET["id_job"]) && $_GET["id_job"] != "") {
			$id_job = $_GET["id_job"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_work = '$id_job' ";

		}

		$id_position = "";
		if (isset($_GET["id_position"]) && $_GET["id_position"] != "") {
			$id_position = $_GET["id_position"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_position = '$id_position' ";

		}

		$id_manufactory = "";
		if (isset($_GET["id_manufactory"]) && $_GET["id_manufactory"] != "") {
			$id_manufactory = $_GET["id_manufactory"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_manufactory = '$id_manufactory' ";
		}
		// END: kiểm tra đk submit từ form tìm kiếm
		if ($dk != "") {
			$dk = " WHERE " . $dk;
		}

		// $array_user = $this->User2->find("all",array("conditions"=>$dk));
		$array_department = $this->Department->find("all", array("fields" => "id,name"));
		$array_position = $this->Position->find("all", array("fields" => "id,name"));
		$array_job = $this->Job->find("all", array("fields" => "id,name"));
		$array_factory = $this->Factory->find("all", array("fields" => "id,name"));
		$array_manufactory = $this->Manufactory->find("all", array("fields" => "id,name"));

		$sql_col = "U.*, S.`luong_coban`, A.`ngaynghi_vophep_9`, A.`id_user`, A.`ngaynghi_vophep_10`,A.`ngaynghi_vophep_1`,`ngaynghi_vophep_2`,`ngaynghi_vophep_3`,`ngaynghi_vophep_4`,A.`ngaynghi_vophep_5`,A.`ngaynghi_vophep_6`,A.`ngaynghi_vophep_7`,A.`ngaynghi_vophep_8`,A.`ngaynghi_vophep_11`,A.`ngaynghi_vophep_12`,A.`ngaynghi_cophep_10`,A.`ngaynghi_cophep_1`,A.`ngaynghi_cophep_2`,A.`ngaynghi_cophep_3`,A.`ngaynghi_cophep_4`,A.`ngaynghi_cophep_5`,A.`ngaynghi_cophep_6`,A.`ngaynghi_cophep_7`,A.`ngaynghi_cophep_8`,A.`ngaynghi_cophep_9`,A.`ngaynghi_cophep_11`,A.`ngaynghi_cophep_12`, A.`ngaycong_trongthang_9`, A.`ngaycong_trongthang_10`";

		$sql = "SELECT  $sql_col FROM scm_users AS U
		LEFT JOIN scm_salary AS S ON U.`id`=S.`id_user`
		LEFT JOIN
		(SELECT `id_user`,
		SUM(case when `id_date_allowance` = 8 AND `month`='2017-09-01' then 1 else 0 end) as ngaynghi_vophep_9,
		SUM(case when `id_date_allowance` = 8 AND `month`='2017-10-01' then 1 else 0 end) as ngaynghi_vophep_10,
		SUM(case when `id_date_allowance` = 8 AND `month`='2017-01-01' then 1 else 0 end) as ngaynghi_vophep_1,
		SUM(case when `id_date_allowance` = 8 AND `month`='2017-02-01' then 1 else 0 end) as ngaynghi_vophep_2,
		SUM(case when `id_date_allowance` = 8 AND `month`='2017-03-01' then 1 else 0 end) as ngaynghi_vophep_3,
		SUM(case when `id_date_allowance` = 8 AND `month`='2017-04-01' then 1 else 0 end) as ngaynghi_vophep_4,
		SUM(case when `id_date_allowance` = 8 AND `month`='2017-05-01' then 1 else 0 end) as ngaynghi_vophep_5,
		SUM(case when `id_date_allowance` = 8 AND `month`='2017-06-01' then 1 else 0 end) as ngaynghi_vophep_6,
		SUM(case when `id_date_allowance` = 8 AND `month`='2017-07-01' then 1 else 0 end) as ngaynghi_vophep_7,
		SUM(case when `id_date_allowance` = 8 AND `month`='2017-08-01' then 1 else 0 end) as ngaynghi_vophep_8,
		SUM(case when `id_date_allowance` = 8 AND `month`='2017-11-01' then 1 else 0 end) as ngaynghi_vophep_11,
		SUM(case when `id_date_allowance` = 8 AND `month`='2017-12-01' then 1 else 0 end) as ngaynghi_vophep_12,
		SUM(case when `id_date_allowance` = 7 AND `month`='2017-01-01' then 1 else 0 end) as ngaynghi_cophep_1,
		SUM(case when `id_date_allowance` = 7 AND `month`='2017-02-01' then 1 else 0 end) as ngaynghi_cophep_2,
		SUM(case when `id_date_allowance` = 7 AND `month`='2017-03-01' then 1 else 0 end) as ngaynghi_cophep_3,
		SUM(case when `id_date_allowance` = 7 AND `month`='2017-04-01' then 1 else 0 end) as ngaynghi_cophep_4,
		SUM(case when `id_date_allowance` = 7 AND `month`='2017-05-01' then 1 else 0 end) as ngaynghi_cophep_5,
		SUM(case when `id_date_allowance` = 7 AND `month`='2017-06-01' then 1 else 0 end) as ngaynghi_cophep_6,
		SUM(case when `id_date_allowance` = 7 AND `month`='2017-07-01' then 1 else 0 end) as ngaynghi_cophep_7,
		SUM(case when `id_date_allowance` = 7 AND `month`='2017-08-01' then 1 else 0 end) as ngaynghi_cophep_8,
		SUM(case when `id_date_allowance` = 7 AND `month`='2017-09-01' then 1 else 0 end) as ngaynghi_cophep_9,
		SUM(case when `id_date_allowance` = 7 AND `month`='2017-10-01' then 1 else 0 end) as ngaynghi_cophep_10,
		SUM(case when `id_date_allowance` = 7 AND `month`='2017-11-01' then 1 else 0 end) as ngaynghi_cophep_11,
		SUM(case when `id_date_allowance` = 7 AND `month`='2017-12-01' then 1 else 0 end) as ngaynghi_cophep_12,
		SUM(case when `id_go_work` = 1 AND `month`='2017-09-01' then 1 else 0 end) as ngaycong_trongthang_9,
		SUM(case when `id_go_work` = 1 AND `month`='2017-10-01' then 1 else 0 end) as ngaycong_trongthang_10
		FROM scm_attendace_times  GROUP BY `id_user`) AS A ON U.`id`=A.`id_user`";
		//echo $sql;
		$array_user = $this->Salary->query($sql);

		$array_params_in_view = array(
			"array_user" => $array_user,
			"array_department" => $array_department,
			"array_position" => $array_position,
			"array_job" => $array_job,
			"array_factory" => $array_factory,
			"array_manufactory" => $array_manufactory,
			"name" => $name,
			"date_from" => $date_from,
			"date_to" => $date_to,
			"id_department" => $id_department,
			"id_factory" => $id_factory,
			"id_job" => $id_job,
			"id_position" => $id_position,
			"id_manufactory" => $id_manufactory,
		);
		$html_result = $this->View->render("month_13th_salary.php", $array_params_in_view);
		echo $html_result;
	}
	function del($id = "") {
		if ($id != "") {
			$this->loadModel("Salary_Maternity", "salary_maternities");
			$this->Salary_Maternity->delete($id);
			$this->redirect("/salary/maternity.html");

		}

	}

	function del_salary($id = "") {
		if ($id != "") {

			$this->loadModel("Salary", "salary");
			$this->Salary->delete($id);
			$this->redirect("/salary/index.html");
		}

	}
	function del_income($id = "") {
		if ($id != "") {

			$this->loadModel("Income_tax", "income_tax");
			$this->Income_tax->delete($id);
			$this->redirect("/salary/temp_income_tax.html");
		}

	}
	function del_fee($id = "") {
		if ($id != "") {

			$this->loadModel("Fee", "fee");
			$this->Fee->delete($id);
			$this->redirect("/salary/fee.html");
		}

	}
	function del_ext($id = "") {
		if ($id != "") {

			$this->loadModel("Ext", "exts");
			$this->Ext->delete($id);
			$this->redirect("/salary/ext.html");
		}

	}

	function user_salary() {
		$this->loadModel("User2", "users");
		$this->loadModel("UserSalary", "user_salary");
		$this->loadModel("Department", "departments");
		$this->loadModel("Position", "positions");
		$this->loadModel("Job", "jobs");
		$this->loadModel("Factory", "factorys");
		$this->loadModel("Manufactory", "manufactorys");

		if (isset($_POST["data"])) {
			$array_data_user = $_POST["data"];
			foreach ($array_data_user as $data) {
				//Cập nhật lại lương nhân viên bên bảng users
				// $array_user = null;
				// $id_user = $data["id_user"];
				// if ($id_user != "") {
				// 	$array_user["id"] = $id_user;
				// 	$array_user["salary"] = $data["luong_coban"];
				// 	$array_user["subsidies_salary"] = $data["phucap_luong"];
				// 	$array_user["telephone_allowance"] = $data["phucap_dienthoai"];
				// 	$array_user["travel_allowance"] = $data["phucap_dilai"];
				// 	$this->User2->save($array_user);
				// }

				// //kiem tra neu da co user thi cap nhat lai
				// $id_salary = $this->UserSalary->get_value(array("fiedls" => "id", "conditions" => "id_user='$id_user'"));
				// if ($id_salary) {
				// 	$data["id"] = $id_salary;
				// }
				//print_r($data);
				$this->UserSalary->save($data);
			}
			$this->redirect("/salary/user_salary");
		}

		/* BEGIN: KIỂM TRA NẾU CÓ DỮ LIỆU TỪ FORM SUBMIT LÊN */

		$dk = "";
		$id_department = "";
		$id_position = "";
		$id_job = "";
		$id_factory = "";
		$id_manufactory = "";
		$name = "";

		if (isset($_GET["name"])) {
			$name = $_GET["name"];
			if ($name != "") {
				$dk .= "fullname LIKE '%$name%'";
			}
		}

		//nếu có tham số id_department truyền lên thì lấy và đưa vào biên điều kiện
		if (isset($_GET["id_department"])) {
			$id_department = $_GET["id_department"];
			if ($id_department != "") {
				if ($dk != "") {
					$dk .= " AND ";
				}
				$dk .= "id_department = '$id_department'";
			}
		}

		if (isset($_GET["id_position"])) {
			$id_position = $_GET["id_position"];
			if ($id_position != "") {
				if ($dk != "") {
					$dk .= " AND ";
				}

				$dk .= "id_position = '$id_position'";
			}
		}

		if (isset($_GET["id_job"])) {
			$id_job = $_GET["id_job"];
			if ($id_job != "") {
				if ($dk != "") {
					$dk .= " AND ";
				}

				$dk .= "id_job = '$id_job'";
			}
		}

		if (isset($_GET["id_factory"])) {
			$id_factory = $_GET["id_factory"];
			if ($id_factory != "") {
				if ($dk != "") {
					$dk .= " AND ";
				}

				$dk .= "id_factory = '$id_factory'";
			}
		}

		if (isset($_GET["id_manufactory"])) {
			$id_manufactory = $_GET["id_manufactory"];
			if ($id_manufactory != "") {
				if ($dk != "") {
					$dk .= " AND ";
				}

				$dk .= "id_manufactory = '$id_manufactory'";
			}
		}

		$array_user2 = $this->User2->find("all", array("conditions" => $dk));

		/*BEGIIN: TRUY VẤN DỮ LIỆU HIỂN THỊ FROM TÌM KIẾM*/

		//Load dữ liệu từ bảng departments để hiển thị lên selecbox chọn phòng ban-bộ phận
		$array_department = $this->Department->find("all", array("fields" => "id,name"));

		//Load dữ liệu từ bảng positions để hiển thị lên selecbox chọn chức vụ
		$array_position = $this->Position->find("all", array("fields" => "id,name"));

		//Load dữ liệu từ bảng jobs để hiển thị lên selecbox chọn công việc
		$array_job = $this->Job->find("all", array("fields" => "id,name"));

		//Load dữ liệu từ bảng factory để hiển thị lên selecbox chọn công việc
		$array_factory = $this->Factory->find("all", array("fields" => "id,name"));

		//Load dữ liệu từ bảng factory để hiển thị lên selecbox chọn công việc
		$array_manufactory = $this->Manufactory->find("all", array("fields" => "id,name"));

		/*BEGIIN: TRUY VẤN DỮ LIỆU HIỂN THỊ FROM TÌM KIẾM*/

		$array_param = array(
			"array_user2" => $array_user2,
			"array_department" => $array_department,
			"array_position" => $array_position,
			"array_job" => $array_job,
			"array_factory" => $array_factory,
			"array_manufactory" => $array_manufactory,
		);

		$html = $this->View->render("add_user_salary.php", $array_param);
		echo $html;
	}

}
?>