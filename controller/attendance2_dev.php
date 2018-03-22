<?php
class attendance2 extends Main {

	function index() {
		$this->loadModel("ChamCong", "chamcong");
		$this->loadModel("Department", "departments");
		$this->loadModel("Position", "positions");
		$this->loadModel("Job", "jobs");
		$this->loadModel("Factory", "factorys");
		$this->loadModel("Manufactory", "manufactorys");
		$this->loadModel("Group", "groups");

		$act = "";
		if (isset($_GET["act"])) {
			$act = $_GET["act"];
			if ($act == "edit") {
				$this->redirect("/attendance2/data");
			}
		}

		/* BEGIN: KIỂM TRA NẾU CÓ DỮ LIỆU TỪ FORM SUBMIT LÊN */

		$dk = "";
		//BEGIN: Tìm kiếm theo từ ngày 
		//tìm kiếm theo ngày
		
		$day = "";
		if (isset($_GET["day_from"])) $day = $_GET["day_from"];
		
		//nếu không có ngày thì lấy ngày hiện tại
		if($day =="") $day = date("Y-m-d");	
		
		if(isset($_GET["day"]) && $_GET["day"]!="") $day = $_GET["day"];
		
		$day = date("Y-m-d", strtotime($day));
		$dk .= " `day` >='$day'";
		//END: Tìm kiếm theo từ ngày 		
		
		//BEGIN: Tìm kiếm theo đến ngày 
		$day_to = "";
		if (isset($_GET["day_to"])) $day_to = $_GET["day_to"];
		//nếu không có ngày thì lấy ngày hiện tại
		if ($day_to == "") $day_to = date("Y-m-d");
		$day_to = date("Y-m-d", strtotime($day_to));
		
		if ($dk != "") $dk .= " AND ";
		$dk .= "`day` <='$day_to'";
		//BEGIN: Tìm kiếm theo đến ngày
		
		//BEGIN: tìm kiếm theo nhà máy
		$id_factory = "";
		if (isset($_GET["id_factory"])) 
		{
			$id_factory = $_GET["id_factory"];
			if ($id_factory != "") {
				if ($dk != "") $dk .= " AND ";
				$dk .= "id_factory = '$id_factory'";
			}
		}
		//END: tìm kiếm theo nhà máy
		
		//BEGIN: tìm kiếm theo xưởng
		$id_manufactory = "";
		if (isset($_GET["id_manufactory"])) {
			$id_manufactory = $_GET["id_manufactory"];
			if ($id_manufactory != "") {
				if ($dk != "") $dk .= " AND ";
				$dk .= "id_manufactory = '$id_manufactory'";
			}
		}
		//END: tìm kiếm theo xưởng
		
		//BEGIN: Tìm kiếm theo chức vụ
		$id_position = "";
		if (isset($_GET["id_position"])) {
			$id_position = $_GET["id_position"];
			if ($id_position != "") {
				if ($dk != "") {
					$dk .= " AND ";
				}

				$dk .= "id_position = '$id_position'";
			}
		}
		//END: Tìm kiếm theo chức vụ
		
		//BEGIN: Tìm kiếm theo bộ phận
		$id_job = "";
		if (isset($_GET["id_job"])) {
			$id_job = $_GET["id_job"];
			if ($id_job != "") {
				if ($dk != "") {
					$dk .= " AND ";
				}

				$dk .= "id_job = '$id_job'";
			}
		}
		//END: Tìm kiếm theo bộ phận
		
		//BEGIN:Tìm kiếm theo tổ
		$id_group = "";
		if (isset($_GET["id_group"])) {
			$id_group = $_GET["id_group"];
			if ($id_group != "") {
				if ($dk != "") {
					$dk .= " AND ";
				}

				$dk .= "id_group = '$id_group'";
			}
		}
		//END: Tìm kiếm theo tổ
		
		//BEGIN: Tìm theo tên, mã nhân viên
		$name = "";
		if (isset($_GET["name"])) {
			$name = $_GET["name"];
			if ($name != "") {
				if ($dk != "") {
					$dk .= " AND ";
				}
				$dk .= "user_fullname LIKE '%$name%' OR user_code LIKE '%$name%'";
			}
		}
		//END: Tìm kiếm theo nhân viên

		/*BEGIIN: TRUY VẤN DỮ LIỆU HIỂN THỊ FROM TÌM KIẾM*/

		// BEGIN:: CN TÌM KIẾM
		//
		//Load dữ liệu từ bảng positions để hiển thị lên selecbox chọn chức vụ
		$array_position = $this->Position->find("all", array("fields" => "id,name"));

		//Load dữ liệu từ bảng jobs để hiển thị lên selecbox chọn công việc
		$array_job = $this->Job->find("all", array("fields" => "id,name"));

		//Load dữ liệu từ bảng factory để hiển thị lên selecbox chọn công việc
		$array_factory = $this->Factory->find("all", array("fields" => "id,name"));

		//Load dữ liệu từ bảng factory để hiển thị lên selecbox chọn công việc
		$array_manufactory = $this->Manufactory->find("all", array("fields" => "id,name"));

		//load dữ liệu từ bảng groups để hiển thị lên selecbox tổ
		$array_group = $this->Group->find("all", array("fields" => "id,name"));

		// END: CN TÌM KIẾM

		$array_chamcong = $this->ChamCong->find("all", array("conditions" => $dk, "order" => "day DESC"));

		$array_param = array(
			"array_chamcong" => $array_chamcong,
			"array_position" => $array_position,
			"array_job" => $array_job,
			"array_factory" => $array_factory,
			"array_manufactory" => $array_manufactory,
			"array_group" => $array_group,
			"day" => $day,
			"id_position" => $id_position,
			"id_job" => $id_job,
			"id_factory" => $id_factory,
			"id_manufactory" => $id_manufactory,
			"id_group" => $id_group,
			"name"=>$name,
			"day_to"=>$day_to,
		);
		$html = $this->View->render("index_attendance2.php", $array_param);
		echo $html;
	}

	function add_product($id = "") {

		$this->loadModel('User2', "users");
		$this->loadModel('Att_Product', "attendance_products");
		$this->loadModel('Product');
		$this->loadModel('Attendance');
		$this->loadModel('Department');
		$this->loadModel('Position');
		$this->loadModel('Job');
		$this->loadModel('Factory');
		$this->loadModel('Manufactory');
		$this->loadModel("ProductAssign", "product_assign");

		// kiểm tra dữ liệu  data từ form có co hay ko để lưu vào bảng attendance_products
		if (isset($_POST['data'])) {
			//đua ten vao bang csdl
			$data = $_POST['data'];
			$date = $_POST['date'];

			$type_workday = $_POST["type_workday"];
			foreach ($data as $att_product) {

				$date = date("Y-m-d ", strtotime($date));
				//tạo phần tử ngay cho mảng salary
				$att_product['date'] = $date;
				$att_product['type_workday'] = $type_workday;
				$att_product['thang'] = date("Y-m-01 ", strtotime($date));

				//lấy dữ liệu id để đưa sang

				$data1 = $att_product['id_product'];

				if ($att_product['nguoi_ga'] == "" || $att_product['nguoi_ga'] == "0") {
					$att_product['nguoi_ga'] = 1;
				}

				if ($data1 != 0) {

					$array_product1 = $this->Product->find("all", array("fields" => "id, code, name, price", "conditions" => "`id`=$data1"));

					$att_product['product_code'] = $array_product1[0]['code'];
					$att_product['product_name'] = $array_product1[0]['name'];
					$att_product['price'] = $array_product1[0]['price'];
					$att_product['thanhtien'] = $array_product1[0]['price'] * $att_product["number_work"] / $att_product['nguoi_ga'];
					$this->Att_Product->save($att_product);
				}
			}

			// lưu xog chuyển về trang danh sách chấm công sản phẩm
			$this->redirect("/attendance2/product.html");
		}

		$dk = "";

		//kiểm tra có tham số name không, để lọc dữ liệu fullname
		$name = "";
		if (isset($_GET["name"]) && $_GET["name"] != "") {
			$name = $_GET["name"];
			$dk = " fullname LIKE '%$name%'";
		}

		$id_department = "";

		if (isset($_GET["id_department"]) && $_GET["id_department"] != "") {
			$id_department = $_GET["id_department"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_department = '$id_department'";

		}

		$id_position = "";

		if (isset($_GET["id_position"]) && $_GET["id_position"] != "") {
			$id_position = $_GET["id_position"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " `id_position` = '$id_position'";
		}

		$id_factory = "";

		if (isset($_GET["id_factory"]) && $_GET["id_factory"] != "") {
			$id_factory = $_GET["id_factory"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " `id_factory` = '$id_factory'";
		}

		$id_manufactory = "";

		if (isset($_GET["id_manufactory"]) && $_GET["id_manufactory"] != "") {
			$id_manufactory = $_GET["id_manufactory"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " `id_manufactory` = '$id_manufactory'";
		}

		$id_work = "";

		if (isset($_GET["id_work"]) && $_GET["id_work"] != "") {
			$id_work = $_GET["id_work"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " `id_work` = '$id_work'";
		}

		$array_user = $this->User2->find("all", array("conditions" => "$dk"));
		//$array_product_assign = $this->ProductAssign->find("all");
		$array_department = $this->Department->find("all", array("fields" => "id,name"));
		$array_position = $this->Position->find("all", array("fields" => "id,name"));
		$array_work = $this->Job->find("all", array("fields" => "id,name"));
		$array_factory = $this->Factory->find("all", array("fields" => "id,name"));
		$array_manufactory = $this->Manufactory->find("all", array("fields" => "id,name"));
		$array_product = $this->Product->find("all", array("fields" => "id,concat(code ,'-',name,'-',price,' VND') AS san_pham , price"));

		//truy vấn dữ liệu từ bảng product_assign để lấy sản phẩm mà đã gán cho nhân viên
		$array_product2 = $this->Product->find("all");

		$sql_product_assign = "
			SELECT B . * , A.id AS id_product_assign, A.id_product, A.product_name, A.id_user
			FROM scm_product_assign A
			LEFT JOIN scm_users B ON A.id_user = B.id";
		$array_product_assign = $this->ProductAssign->query($sql_product_assign);

		$array_edit_product = null;

		if ($id != "") {
			$array_edit_product = $this->Att_Product->find("all", array("conditions" => "id='$id'"));
		}
		// print_r($array_edit_product);

		$array_param_view = array(
			"array_user" => $array_user,
			"array_department" => $array_department,
			"array_position" => $array_position,
			"array_work" => $array_work,
			"array_factory" => $array_factory,
			"array_manufactory" => $array_manufactory,
			"array_product" => $array_product,
			"array_product2" => $array_product2,
			"array_edit_product" => $array_edit_product,
			"id_position" => $id_position,
			"id_department" => $id_department,
			"id_work" => $id_work,
			"id_factory" => $id_factory,
			"id_manufactory" => $id_manufactory,
			"name" => $name,
			"array_product_assign" => $array_product_assign,
		);
		$html_result = $this->View->render("add_product_attendance2.php", $array_param_view);

		echo $html_result;
	}

	function product() {
		$this->loadModel('Att_Product', "attendance_products");
		$this->loadModel('Department');
		$this->loadModel('Position');
		$this->loadModel('Product');
		$this->loadModel('Job');
		$this->loadModel('Factory');
		$this->loadModel('Manufactory');
		$this->loadModel('Department');

		// BEGIN: KIỂM TRA ĐIỀU KIỆN SUBMIT TỪ FORM TÌM KIẾM
		$dk = "";
		//kiểm tra có tham số name không có dữ liệu fullname
		$name = "";
		if (isset($_GET["name"]) && $_GET["name"] != "") {
			$name = $_GET["name"];
			$dk = " fullname LIKE '%$name%'";
		}

		$date_from = "";
		//kiểm tra có tham sô date_form không, để lọc dữ liệu
		if (isset($_GET['date_from']) && $_GET['date_from'] != "") {
			$date_from = $_GET["date_from"];

			$date_from = date("Y-m-d", strtotime($date_from));
			// echo $date_from;
			if ($dk != "") {
				$dk .= " AND ";
			}

			// so sanh cột date vs du iệu lấy
			$dk .= " date >= '$date_from'";

		}

		$date_to = "";

		//kiểm tra có tham sô date_to không, để lọc dữ liệu
		if (isset($_GET['date_to']) && $_GET['date_to'] != "") {
			$date_to = $_GET["date_to"];

			$date_to = date("Y-m-d", strtotime($date_to));

			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " date <= '$date_to'";

		}

		// kiểm tra có tham số id_department không, để lọc dữ liệu id_department
		$id_department = "";

		if (isset($_GET["id_department"]) && $_GET["id_department"] != "") {
			$id_department = $_GET["id_department"];
			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_department = '$id_department'";
		}

		// kiểm tra có tham số id_position không, để lọc dữ liệu id_position
		$id_position = "";

		if (isset($_GET["id_position"]) && $_GET["id_position"] != "") {
			$id_position = $_GET["id_position"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_position = '$id_position'";
		}

		// kiểm tra có tham số id_factory không, để lọc dữ liệu id_factory
		$id_factory = "";

		if (isset($_GET["id_factory"]) && $_GET["id_factory"] != "") {
			$id_factory = $_GET["id_factory"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_factory = '$id_factory'";
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

		// kiểm tra có tham số id_work không, để lọc dữ liệu id_work
		$id_work = "";

		if (isset($_GET["id_work"]) && $_GET["id_work"] != "") {
			$id_work = $_GET["id_work"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_work = '$id_work'";
		}
		// END: KIỂM TRA ĐIỀU KIỆN SUBMIT TỪ FORM TÌM KIẾM

		$array_product1 = $this->Product->find("all", array("fields" => "id,name"));

		$array_attendance_product = $this->Att_Product->find("all", array("conditions" => $dk, "order" => " date, id_user"));
		$array_department = $this->Department->find("all", array("fields" => "id,name"));
		$array_position = $this->Position->find("all", array("fields" => "id,name"));
		$array_work = $this->Job->find("all", array("fields" => "id,name"));
		$array_factory = $this->Factory->find("all", array("fields" => "id,name"));
		$array_manufactory = $this->Manufactory->find("all", array("fields" => "id,name"));

		$array_param_view = array(
			"array_attendance_product" => $array_attendance_product,
			"array_department" => $array_department,
			"array_position" => $array_position,
			"array_work" => $array_work,
			"array_factory" => $array_factory,
			"array_manufactory" => $array_manufactory,
			"name" => $name,
			"date_from" => $date_from,
			"date_to" => $date_to,
			"array_product1" => $array_product1,
			"id_manufactory" => $id_manufactory,
			"id_position" => $id_position,
			"id_factory" => $id_factory,
			"id_department" => $id_department,
			"id_work" => $id_work,
		);
		$html_result = $this->View->render("product_attendance2.php", $array_param_view);

		echo $html_result;
	}

	function day_shift() {

		$this->loadModel('Administrative_time', "attendace_times");

		$this->loadModel('Department');
		$this->loadModel('Position');
		$this->loadModel('Job');
		$this->loadModel('Factory');
		$this->loadModel('Manufactory');

		$dk = "";

		//kiểm tra có tham số name không
		$name = "";
		if (isset($_GET["name"]) && $_GET["name"] != "") {
			$name = $_GET["name"];
			$dk = " fullname LIKE '%$name%'";
		}

		$date_from = "";
		//kiểm tra có tham sô date_form không, để lọc dữ liệu
		if (isset($_GET['date_from']) && $_GET['date_from'] != "") {
			$date_from = $_GET["date_from"];

			$date_from = date("Y-m-d", strtotime($date_from));

			if ($dk != "") {
				$dk .= " AND ";
			}

			// so sanh cột date vs du iệu lấy
			$dk .= " date >= '$date_from'";
		}

		$date_to = "";
		//kiểm tra có tham số date_to không, để lọc dữ liệu
		if (isset($_GET['date_to']) && $_GET['date_to'] != "") {
			$date_to = $_GET["date_to"];
			$date_to = date("Y-m-d", strtotime($date_to));

			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " date <= '$date_to'";
		}

		//sửa lại department thanh id_department
		$id_department = "";
		if (isset($_GET["id_department"]) && $_GET["id_department"] != "") {
			$id_department = $_GET["id_department"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_department = '$id_department'";
		}

		$id_position = "";

		if (isset($_GET["id_position"]) && $_GET["id_position"] != "") {
			$id_position = $_GET["id_position"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_position = '$id_position'";
		}

		$id_factory = "";

		if (isset($_GET["id_factory"]) && $_GET["id_factory"] != "") {
			$id_factory = $_GET["id_factory"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_factory = '$id_factory'";
		}

		$id_manufactory = "";

		if (isset($_GET["id_manufactory"]) && $_GET["id_manufactory"]) {
			$id_manufactory = $_GET["id_manufactory"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_manufactory = '$id_manufactory'";
		}
		$id_work = "";

		if (isset($_GET["id_work"]) && $_GET["id_work"] != "") {
			$id_work = $_GET["id_work"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_work = '$id_work'";
		}

		if ($dk != "") {
			$dk = " AND " . $dk;
		}

		$array_attendance = $this->Administrative_time->find("all", array("conditions" => " `type` = 0  $dk  "));
		$array_department = $this->Department->find("all", array("fields" => "id,name"));
		$array_position = $this->Position->find("all", array("fields" => "id,name"));
		$array_work = $this->Job->find("all", array("fields" => "id,name"));
		$array_factory = $this->Factory->find("all", array("fields" => "id,name"));
		$array_manufactory = $this->Manufactory->find("all", array("fields" => "id,name"));
		$array_param_view = array(
			"array_attendance" => $array_attendance,
			"array_department" => $array_department,
			"array_position" => $array_position,
			"array_work" => $array_work,
			"array_factory" => $array_factory,
			"array_manufactory" => $array_manufactory,
			"name" => $name,
			"date_from" => $date_from,
			"date_to" => $date_to,
			"id_work" => $id_work,
			"id_manufactory" => $id_manufactory,
			"id_department" => $id_department,
			"id_position" => $id_position,
			"id_factory" => $id_factory,
		);

		$html_result = $this->View->render("day_shift_attendance2.php", $array_param_view);

		echo $html_result;
	}

	function add_day_shift($id = "") {

		$this->loadModel('User2', "users");
		$this->loadModel('Administrative_time', "attendace_times");
		$this->loadModel('Department');
		$this->loadModel('Position');
		$this->loadModel('Job');
		$this->loadModel('Factory');
		$this->loadModel('Manufactory');

		// BENGIN: LẤY DỮ LIỆU POST SUBMIT TỪ FORM
		if (isset($_POST['data'])) {
			$data = $_POST['data'];
			$date = $_POST['date'];

			$array_word_type = array("1" => "Có", "0" => "Không");

			foreach ($data as $attendance) {
				$id_go_work = $attendance['id_go_work'];
				$attendance['go_work'] = $array_word_type[$id_go_work];

				$date = date("Y-m-d ", strtotime($date));
				$month = date("Y-m-01", strtotime($date));

				//tạo phần tử ngay cho mảng salary
				$attendance['date'] = $date;
				$attendance['month'] = $month;

				//Nếu type = 0(điểm danh hành chính) thì  shift(ca) = 0
				if ($attendance['type'] == 0) {
					$attendance['shift'] = 0;
				}

				$this->Administrative_time->save($attendance);
			} //end: foreach ($data as  $attendance)

			$this->redirect("/attendance2/day_shift.html");
		} // end: if (isset($_POST['data']))
		// END: LẤY DỮ LIỆU POST SUBMIT TỪ FORM

		// BEGIN: KIỂM TRA DỮ LIỆU SUBMIT TỪ FORM SEARCH
		$dk = "";
		//kiểm tra có tham số name không
		$name = "";
		if (isset($_GET["name"]) && $_GET["name"] != "") {
			$name = $_GET["name"];
			$dk = " fullname LIKE '%$name%'";
		}
		//sửa lại department thanh id_department

		$id_department = "";

		if (isset($_GET["id_department"]) && $_GET["id_department"] != "") {
			$id_department = $_GET["id_department"];
			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_department = '$id_department'";
		}

		$id_position = "";

		if (isset($_GET["id_position"]) && $_GET["id_position"] != "") {
			$id_position = $_GET["id_position"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_position = '$id_position'";
		}

		$id_factory = "";

		if (isset($_GET["id_factory"]) && $_GET["id_factory"] != "") {
			$id_factory = $_GET["id_factory"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_factory = '$id_factory'";
		}

		$id_manufactory = "";

		if (isset($_GET["id_manufactory"]) && $_GET["id_manufactory"] != "") {
			$id_manufactory = $_GET["id_manufactory"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_manufactory = '$id_manufactory'";
		}

		$id_work = "";

		if (isset($_GET["id_work"]) && $_GET["id_work"] != "") {
			$id_work = $_GET["id_work"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_work = '$id_work'";
		}
		// END: KIỂM TRA DỮ LIỆU SUBMIT TỪ FORM SEARCH

		$array_department = $this->Department->find("all", array("fields" => "id,name"));
		$array_position = $this->Position->find("all", array("fields" => "id,name"));
		$array_work = $this->Job->find("all", array("fields" => "id,name"));
		$array_factory = $this->Factory->find("all", array("fields" => "id,name"));
		$array_manufactory = $this->Manufactory->find("all", array("fields" => "id,name"));
		$array_user = $this->User2->find("all", array("conditions" => "$dk"));
		$array_edit_day_shift = null;

		// KIỂM TRA NẾU CÓ $ID TRUYỀN VỀ THÌ SỬA
		if ($id != "") {
			$array_edit_day_shift = $this->Administrative_time->find("all", array("conditions" => "id='$id'"));
		}

		$array_param_view = array(
			"array_user" => $array_user,
			"array_department" => $array_department,
			"array_position" => $array_position,
			"array_work" => $array_work,
			"array_factory" => $array_factory,
			"array_manufactory" => $array_manufactory,
			"array_edit_day_shift" => $array_edit_day_shift,
			"name" => $name,
			"id_position" => $id_position,
			"id_department" => $id_department,
			"id_work" => $id_work,
			"id_factory" => $id_factory,
			"id_manufactory" => $id_manufactory,
		);
		$html_result = $this->View->render("add_day_shift_attendance2.php", $array_param_view);

		echo $html_result;

	}

	function night_shift() {

		$this->loadModel('Administrative_time', "attendace_times");
		$this->loadModel('Department');
		$this->loadModel('Position');
		$this->loadModel('Job');
		$this->loadModel('Factory');
		$this->loadModel('Manufactory');

		$this->loadModel('Department');

		// BEGIN: KIỂM TRA ĐK SUBMIT TỪ FORM SEARCH
		$dk = "";
		$dk_name = "";
		//kiểm tra có tham số name không
		$name = "";
		if (isset($_GET["name"]) && $_GET["name"] != "") {
			$name = $_GET["name"];
			$dk = " fullname LIKE '%$name%'";
		}

		// BEGIN: kiểm tra có tham sô date_form không, để lọc dữ liệu
		$date_from = "";
		if (isset($_GET['date_from']) && $_GET['date_from'] != "") {
			$date_from = $_GET["date_from"];

			$date_from = date("Y-m-d", strtotime($date_from));
		} else {
			$date_from = date("Y-m-01");
		}

		if ($dk != "") {
			$dk .= " AND ";
		}

		$dk .= " date >= '$date_from'";
		// BEGIN: kiểm tra có tham sô date_form không, để lọc dữ liệu

		$date_to = "";
		// BEGIN: kiểm tra có tham số date_to không, để lọc dữ liệu
		if (isset($_GET['date_to']) && $_GET['date_to'] != "") {
			$date_to = $_GET["date_to"];
			$date_to = date("Y-m-d", strtotime($date_to));

		} else {
			$date_to = date("Y-m-t");
		}
		if ($dk != "") {
			$dk .= " AND ";
		}

		$dk .= " date <= '$date_to'";

		$id_department = "";

		if (isset($_GET["id_department"]) && $_GET["id_department"] != "") {
			$id_department = $_GET["id_department"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_department = '$id_department'";

		}
		// BEGIN: kiểm tra có tham số date_to không, để lọc dữ liệu

		$id_position = "";

		if (isset($_GET["id_position"]) && $_GET["id_position"] != "") {
			$id_position = $_GET["id_position"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_position = '$id_position'";
		}

		$id_factory = "";

		if (isset($_GET["id_factory"]) && $_GET["id_factory"] != "") {
			$id_factory = $_GET["id_factory"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_factory = '$id_factory'";
		}

		$id_manufactory = "";

		if (isset($_GET["id_manufactory"]) && $_GET["id_manufactory"] != "") {
			$id_manufactory = $_GET["id_manufactory"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_manufactory = '$id_manufactory'";
		}

		$id_work = "";

		if (isset($_GET["id_work"]) && $_GET["id_work"] != "") {
			$id_work = $_GET["id_work"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_work = '$id_work'";
		}
		if ($dk != "") {
			$dk = " AND " . $dk;
		}

		// END: KIỂM TRA ĐK SUBMIT TỪ FORM SEARCH

		$array_attendance = $this->Administrative_time->find("all", array("conditions" => "`type`=1 $dk "));
		$array_department = $this->Department->find("all", array("fields" => "id,name"));
		$array_position = $this->Position->find("all", array("fields" => "id,name"));
		$array_work = $this->Job->find("all", array("fields" => "id,name"));
		$array_factory = $this->Factory->find("all", array("fields" => "id,name"));
		$array_manufactory = $this->Manufactory->find("all", array("fields" => "id,name"));

		$array_param_view = array(
			"array_attendance" => $array_attendance,
			"array_department" => $array_department,
			"array_position" => $array_position,
			"array_work" => $array_work,
			"array_factory" => $array_factory,
			"array_manufactory" => $array_manufactory,
			"name" => $name,
			"date_from" => $date_from,
			"date_to" => $date_to,
			"id_position" => $id_position,
			"id_work" => $id_work,
			"id_department" => $id_department,
			"id_factory" => $id_factory,
			"id_manufactory" => $id_manufactory,
		);
		$html_result = $this->View->render("night_shift_attendance2.php", $array_param_view);

		echo $html_result;
	}

	function add_night_shift($id = "") {

		$this->loadModel('User2', "users");
		$this->loadModel('Administrative_time', "attendace_times");
		$this->loadModel('Attendance');
		$this->loadModel('Department');
		$this->loadModel('Position');
		$this->loadModel('Job');
		$this->loadModel('Factory');
		$this->loadModel('Manufactory');

		// BEGIN: LẤY DỮ LIỆU SUBMIT TỪ FORM
		if (isset($_POST['data'])) {
			//đua ten vao bang csdl
			$data = $_POST['data'];

			$type = $_POST['type'];
			$date = $_POST['date'];

			$shift = $_POST['shift_hidden'];

			$array_word_type = array("1" => "Có", "0" => "Không");

			$array_work_attendance = array("1" => "Ngày công hết hàng cho về", "2" => "Ngay công hết hàng không lương", "3" => "Ngày nghỉ bảo hiểm hoặc bệnh", "4" => "Ngày công lớn hơn 8 tiếng", "5" => "Ngày công thường tính xét thưởng", "6" => "Ngày công chủ nhật", "7" => "Ngày nghỉ có phép", "8" => "Ngày nghỉ vô phép", "9" => "Ngày không bấm thẻ", "10" => "Ngày công tính tiền sữa", "11" => "Ngày công đi muộn(đủ 8h)");
			foreach ($data as $attendance) {

				$id_go_work = $attendance['id_go_work'];
				$word_attendance = $attendance['id_date_allowance'];
				$attendance['go_work'] = $array_word_type[$id_go_work];
				$attendance['date_allowance'] = $array_work_attendance[$word_attendance];

				$date = date("Y-m-d ", strtotime($date));
				$month = date("Y-m-01", strtotime($date));
				//tạo phần tử ngay cho mảng salary
				$attendance['date'] = $date;
				$attendance['month'] = $month;
				$attendance['type'] = $type;
				$attendance['shift'] = $shift;
				if ($id_go_work == 0) {
					$attendance['shift'] = "";
				}

				$this->Administrative_time->save($attendance);

			}

			$this->redirect("/attendance2/night_shift.html");
		}
		// END: LẤY DỮ LIỆU SUBMIT TỪ FORM

		// BEGIN: KIỂM TRA ĐIỀU KIỆN SUBMIT TỪ FORM SEARCH
		$dk = "";
		//kiểm tra có tham số name không
		$name = "";
		if (isset($_GET["name"]) && $_GET["name"] != "") {
			$name = $_GET["name"];
			$dk = " fullname LIKE '%$name%'";
		}

		// kiểm tra đk phòng ban
		$id_department = "";
		if (isset($_GET["id_department"]) && $_GET["id_department"] != "") {
			$id_department = $_GET["id_department"];
			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_department = '$id_department'";
		}

		// kiểm tra đk chức vụ
		$id_position = "";
		if (isset($_GET["id_position"]) && $_GET["id_position"] != "") {
			$id_position = $_GET["id_position"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_position = '$id_position'";
		}

		// kiểm tra dk nhà máy
		$id_factory = "";
		if (isset($_GET["id_factory"]) && $_GET["id_factory"] != "") {
			$id_factory = $_GET["id_factory"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_factory = '$id_factory'";
		}

		// kiểm tra đk phân xưởng
		$id_manufactory = "";
		if (isset($_GET["id_manufactory"]) && $_GET["id_manufactory"] != "") {
			$id_manufactory = $_GET["id_manufactory"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_manufactory = '$id_manufactory'";
		}

		// kiểm tra đk công việc
		$id_work = "";
		if (isset($_GET["id_work"]) && $_GET["id_work"] != "") {
			$id_work = $_GET["id_work"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_work = '$id_work'";
		}
		// END: KIỂM TRA ĐIỀU KIỆN SUBMIT TỪ FORM SARCH

		$array_department = $this->Department->find("all", array("fields" => "id,name"));
		$array_position = $this->Position->find("all", array("fields" => "id,name"));
		$array_job = $this->Job->find("all", array("fields" => "id,name"));
		$array_factory = $this->Factory->find("all", array("fields" => "id,name"));
		$array_user = $this->User2->find("all", array("conditions" => "$dk"));
		$array_manufactory = $this->Manufactory->find("all", array("fields" => "id,name"));
		$array_edit_night_shitf = null;

		// BEGIN: KIỂM TRA NẾU CÓ THAM SỐ ID THÌ SỬA
		if ($id != "") {
			$array_edit_night_shitf = $this->Administrative_time->find("all", array("conditions" => "id='$id'"));
			$html_result = $this->View->render("edit_night_shift_attendance2.php", array("array_edit_night_shitf" => $array_edit_night_shitf));
			echo $html_result;
			return;
		}
		// END: KIỂM TRA NẾU CÓ THAM SỐ ID THÌ SỬA

		$array_param_view = array(
			"array_user" => $array_user,
			"array_department" => $array_department,
			"array_position" => $array_position,
			"array_work" => $array_job,
			"array_factory" => $array_factory,
			"array_manufactory" => $array_manufactory,
			"array_edit_night_shitf" => $array_edit_night_shitf,
			"name" => $name,
			"id_department" => $id_department,
			"id_work" => $id_work,
			"id_position" => $id_position,
			"id_factory" => $id_factory,
			"id_manufactory" => $id_manufactory,
		);
		$html_result = $this->View->render("add_night_shift_attendance2.php", $array_param_view);

		echo $html_result;

	}
	function import() {
		$file_name = "";

		// Nếu có tham số thì echo ra giá trị tham số không thì hiển thị forrm để import file
		if (isset($_GET['file'])) {
			$table_prefix = $this->Company->table_prefix;

			$table_name = $table_prefix . "dulieu_chamcong_" . $this->User->username;
			$sql_checktable = "SHOW TABLES LIKE '$table_name'";
			$array_check_table = $this->DB->query($sql_checktable);

			//Kiểm tra có bảng tạm chấm công chưa
			if ($array_check_table) {
				$sql_truncate = "TRUNCATE TABLE  $table_name";

				// nếu có thì xoá hết dữ liệu, chưa có thì tạo với tên người dùng
				$this->DB->excute($sql_truncate);
			} else {

				//Tạo bảng du lieu chấm công _ tên người dùng
				$sql_create_table = "CREATE TABLE  `$table_name` (
									`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
									`user_code` INT NULL ,
									`date_time` DATETIME NULL ,
									`time` TIME NULL ,
									`id_machine` INT NULL
									) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_unicode_ci";

				$this->DB->excute($sql_create_table);
			}

			$file_name = $_GET['file'];

			$file_folder = $this->root_folder . "files/scm/";
			//đọc file chấm công
			$file = fopen($file_folder . $file_name, "r") or exit("Unable to open file!");

			$this->loadModel("DataChamCong", $table_name);
			$str_data_line = "";
			$user_code = "";
			$date_time = "";
			$id_machine = "";
			$kytu_phancach = chr(9);

			//Output a line of the file until the end is reached
			while (!feof($file)) {

				$str_data_line = fgets($file);

				//Cắt chuỗi str_datalline thành một mảng
				$array_data_line = explode($kytu_phancach, $str_data_line);

				//nếu có phần tử 0 thì user_code = phần tử 0
				if (isset($array_data_line[0])) {
					$user_code = $array_data_line[0];
				}

				//Nếu có phần tử 1 thì $date_time = giá trị phần tử 1
				if (isset($array_data_line[1])) {
					$date_time = $array_data_line[1];
				}

				//Nếu có phần tử 2 thì $id_machine = giá trị phần tử 2
				if (isset($array_data_line[2])) {
					$id_machine = $array_data_line[2];
				}

				$array_data_cham_cong = null;
				if ($user_code != "") {
					$array_data_cham_cong['user_code'] = $user_code;
					$array_data_cham_cong['date_time'] = $date_time;
					$array_data_cham_cong['id_machine'] = $id_machine;

					// print_r($array_data_cham_cong);
					// echo fgets($file). "<br>";
					$this->DataChamCong->save($array_data_cham_cong);
				}
			} //end: while

			fclose($file);

			echo "import_ok";
		} //end: if (isset($_GET['file']))
		else {
			$html_result = $this->View->render("import_attendance2.php");
			echo $html_result;
		}
	}

	function data() {
		$this->loadModel('ChamCong', "chamcong");
		$this->loadModel("User2", "users");
		$this->loadModel("Shift", "shift");
		$this->loadModel("Position", "positions");
		$this->loadModel("Job", "jobs");
		$this->loadModel("Factory", "factorys");
		$this->loadModel("Manufactory", "manufactorys");
		$this->loadModel("Group", "groups");
		$this->loadModel("TypeWorkday","type_workday");
		

		if (isset($_POST["data"]) && isset($_POST["day"])) 
		{
			$array_chamcong = $_POST["data"];
			
			
			$day = date("Y-m-d",strtotime($_POST["day"]));
			$str_day = date("d-m-Y",strtotime($_POST["day"]));
			//print_r($array_chamcong);
			foreach ($array_chamcong as $data_chamcong) {
				$data_chamcong["day"] = $day;
				//print_r($data_chamcong);
				$dk = "";
				$user_code = $data_chamcong["user_code"];
				$dk .= "user_code = '$user_code'";

				//truy vấn dữ liệu user từ bảng users để lưu danh mục công việc vào bảng chấm công
				$array_data_user = $this->User2->find("all", array("conditions" => $dk));
				
				$data_chamcong["id_department"] = $array_data_user[0]["id_department"];
				$data_chamcong["department_name"] = $array_data_user[0]["department"];
				$data_chamcong["id_factory"] = $array_data_user[0]["id_factory"];
				$data_chamcong["factory_name"] = $array_data_user[0]["factory"];
				$data_chamcong["id_manufactory"] = $array_data_user[0]["id_manufactory"];
				$data_chamcong["manufactory_name"] = $array_data_user[0]["manufactory"];
				$data_chamcong["id_job"] = $array_data_user[0]["id_job"];
				$data_chamcong["job_name"] = $array_data_user[0]["job"];
				$data_chamcong["id_group"] = $array_data_user[0]["id_group"];
				$data_chamcong["group_name"] = $array_data_user[0]["group_name"];
				
				//print_r($data_chamcong);
				$this->ChamCong->save($data_chamcong);
			}
			$this->redirect("/attendance2/index.html?day=$str_day");
			// return;
		}
		
		
		$id_factory = "4";
		$id_position = "";
		$id_job = "";
		$id_group = "";
		$name = "";
		
		
		$dieukien = "";
		
		if(isset($_GET['id_factory'])) $id_factory = $_GET['id_factory'];
		
		//điều kiện tìm kiếm theo nhà máy
		$dieukien = " status = '1'";
		
		if($id_factory != "")	$dieukien .= " AND (id_factory = '$id_factory')";
			
		$id_manufactory = "1";
		if(isset($_GET['id_manufactory'])) $id_manufactory = $_GET['id_manufactory'];
		if($id_manufactory != "") 
		{
			if($dieukien !="") $dieukien .= " AND ";
			$dieukien.=" id_manufactory = '$id_manufactory'";
		}
		if(isset($_GET['id_position']) && $_GET['id_position'] != "" )
		{
			$id_position = $_GET['id_position'];
			if($dieukien !="") $dieukien .= " AND ";
			$dieukien.=" id_position = '$id_position'";
			
		}
		if(isset($_GET['id_job']) && $_GET['id_job'] != "" )
		{
			$id_job = $_GET['id_job'];
			if($dieukien !="") $dieukien .= " AND ";
			$dieukien.="id_job = '$id_job'";
			
		}
		if(isset($_GET['id_group']) && $_GET['id_group'] != "" )
		{
			$id_group = $_GET['id_group'];
			if($dieukien !="") $dieukien .= " AND ";
			$dieukien.="id_group = '$id_group'";
			
		}
		if(isset($_GET['name']) && $_GET['name'] != "" )
		{
			$name = $_GET['name'];
			if($dieukien !="") $dieukien .= " AND ";
			$dieukien.="((fullname LIKE '%$name%') OR (user_code = '$name'))";
			
		}
		$group = "";
		if (isset($_GET["group"])) {
			$group = $_GET["group"];
			if ($group != "") {
				if ($dieukien != "") {
					$dieukien .= " AND ";
				}
				$dieukien .= "group_name LIKE '%$group%'";
			}
		}
		
		//lấy ngày chấm công, mặc định là ngày hiện tại
		$date = date("Y-m-d");
		if (isset($_GET['date'])) $date = date("Y-m-d",strtotime($_GET["date"]));
			
		//Lấy ngày hôm sau
		$next_day = date('Y-m-d', strtotime($date . "+1 days"));
		
		if($dieukien != "") $dieukien = " WHERE $dieukien";
		
		//$sql_data = "SELECT A.* FROM (SELECT * FROM scm_users ) AS A ";
		$str_col_user = " id, fullname, user_code, factory, manufactory, job, shift, group_name,shift_type";
		$sql_user = "SELECT $str_col_user FROM scm_users $dieukien";
		$sql_chamcong = "SELECT * FROM `scm_chamcong` WHERE day = '$date'";
		$sql_data = "SELECT * FROM `scm_dulieu_chamcong_admin` WHERE date_time >='$date 00:00:00' AND date_time <='$next_day 11:00:00' ORDER BY date_time ASC";
		$sql_user_chamcong = "SELECT A.*, B.id_user FROM ($sql_user) AS A LEFT JOIN ($sql_chamcong) AS B ON A.id = B.id_user WHERE B.id_user IS NULL";
		$sql_user_chamcong_data = "SELECT C.*, max(date_time), GROUP_CONCAT(D.date_time ORDER BY date_time ASC  SEPARATOR 's') AS gio_diemdanh FROM ($sql_user_chamcong) AS C LEFT JOIN ($sql_data) AS D ON C.user_code = D.user_code GROUP BY $str_col_user";
		
		//echo $sql_user_chamcong_data;
		
		//Truy vấn dữ liệu từ bảng chamcong
		//$array_data_chamcong = $this->DataChamCong->query($sql_chamcong);
		$array_user = $this->User2->query($sql_user_chamcong_data);
		
		
		//truy vẫn dữ liệu từ bảng shift để đổ ra selectbox lịch làm việc
		$array_work_shift = array(""=>array("id"=>"","name"=>"Chọn ca"));
		$array_work_shift += $this->Shift->find("all", array("fields" => "id, name","conditions"=>"type='lich_dong'"));
		
		$array_shift_tmp = $this->Shift->find("all");
		$array_shift = null;
		if($array_shift_tmp)
		{
			foreach($array_shift_tmp as $shift)
			{
				$array_shift[$shift["code"]]=$shift;
			}
		}		
		
		//Load dữ liệu từ bảng positions để hiển thị lên selecbox chọn chức vụ
		$array_position = array(""=>array("id"=>"","name"=>"Chọn chức vụ"));
		$array_position += $this->Position->find("all", array("fields" => "id,name"));

		//Load dữ liệu từ bảng jobs để hiển thị lên selecbox chọn công việc
		$array_job = array(""=>array("id"=>"","name"=>"Chọn bộ phận"));
		$array_job += $this->Job->find("all", array("fields" => "id,name"));

		//Load dữ liệu từ bảng factory để hiển thị lên selecbox chọn công việc
		$array_factory = array(""=>array("id"=>"","name"=>"Chọn nhà máy"));
		$array_factory += $this->Factory->find("all", array("fields" => "id,name"));

		//Load dữ liệu từ bảng factory để hiển thị lên selecbox chọn công việc
		$array_manufactory = array(""=>array("id"=>"","name"=>"Chọn xưởng"));
		$array_manufactory += $this->Manufactory->find("all", array("fields" => "id,name"));

		//load dữ liệu từ bảng groups để hiển thị lên selecbox tổ
		$array_group = array(""=>array("id"=>"","name"=>"Chọn tổ"));
		$array_group += $this->Group->find("all", array("fields" => "id,name"));
		
		//load dữ liệu từ bảng type_workday hiển thi lên selectbox loại ngày công
		$array_type_workday = $this->TypeWorkday->find("all",array("fields"=>"code,name"));
	
		
		//lấy ngày tháng đưa vào textbox ngày
		$str_date = date("d-m-Y",strtotime($date));

		$array_param = array(
			"array_user"=>$array_user,
			"array_factory"=>$array_factory,
			"array_manufactory"=>$array_manufactory,
			"array_position"=>$array_position,
			"array_job"=>$array_job,
			"array_group"=>$array_group,
			"array_work_shift"=>$array_work_shift,
			"array_type_workday"=>$array_type_workday,
			"str_date"=>$str_date,
			"id_factory"=>$id_factory,
			"id_manufactory"=>$id_manufactory,
			"id_position"=>$id_position,
			"id_job"=>$id_job,
			"id_group"=>$id_group,
			"name"=>$name,
			"array_shift"=>$array_shift,
			"group"=>$group,
		);
		$html_result = $this->View->render("data2_attendance2.php", $array_param);
		echo $html_result;

	}

	function edit($id = "") {
		$this->loadModel("ChamCong", "chamcong");
		$this->loadModel("TypeWorkday","type_workday");
		
		if (isset($_POST["data"])) {
			$array_data_chamcong = $_POST["data"];
			$day_from = $array_data_chamcong["day"];
			$this->ChamCong->save($array_data_chamcong);
			$this->redirect("/attendance2/index?day_from=$day_from&day_to=$day_from");
		}

		// $id = "";
		// if (isset($_GET["id"])) {
		// 	$id = $_GET["id"];
		// }
		if ($id != "") {
			$array_chamcong = $this->ChamCong->find("all", array("conditions" => "id='$id'"));
		}
		$array_typework = array(""=>array("code"=>"","name"=>"Chọn ngày công"));
		$array_typework += $this->TypeWorkday->find("all",array("fields"=>"code, name"));
		$array_param = array(
			"array_chamcong" => $array_chamcong,
			"array_typework"=>$array_typework,
		);

		$html = $this->View->render("edit_attendance2.php", $array_param);
		echo $html;
	}
	function del_chamcong($id = "") {
		if ($id != "") {
			$this->loadModel("ChamCong", "chamcong");
			$this->ChamCong->delete($id);
			$this->redirect("/attendance2/index");
		}
	}
	function detal_night() {

		$html_result = $this->View->render("detail_night_attendance2.php");
		echo $html_result;
	}
	function detail_day() {

		$html_result = $this->View->render("detail_day_attendance2.php");
		echo $html_result;
	}

	function summary() {
		$this->loadModel('User2', "users");
		$this->loadModel('Sum', "attendance_sums");
		$this->loadModel('Att_Product', "attendance_products");
		$this->loadModel('Attendance');
		$this->loadModel('Position');
		$this->loadModel('Job');
		$this->loadModel('Factory');
		$this->loadModel('Manufactory');
		$this->loadModel('Group');

		
		//end: kiểm tra có yêu cầu request lấy số liệu ngày bằng ajax
				
		$dk = "";
		$dk_date_from = "";
		$str_dk_user = "";
		$dieukien_chamcong = "";

		
		//kiểm tra có tham số date_from không
		$date_from = date("01-m-Y");
		if (isset($_GET["date_from"]) && $_GET["date_from"] != "") {
			$date_from = "01-" . $_GET["date_from"];
			$dk_date_from = date("Y-m-d ", strtotime($date_from));
			$dieukien_chamcong = " `day` >= '$dk_date_from'";
		}

		
		//kiểm tra có tham số date_to không
		$date_to = date("t-m-Y");
		$dk_date_to = "";
		if (isset($_GET["date_to"]) && $_GET["date_to"] != "") {
			$date_to = "01-" . $_GET["date_to"];

			// chuyển $date về định dạng ngày của database, "Y-m-t" chữ t tức là lấy ngày cuối cùng của tháng đó
			$dk_date_to = date("Y-m-t ", strtotime($date_to));
			if($dieukien_chamcong != "") $dieukien_chamcong .= " AND ";
			$dieukien_chamcong .= " `day` <= '$dk_date_to' ";
		}
		if($dieukien_chamcong != "") $dieukien_chamcong = " WHERE $dieukien_chamcong";

		//kiểm tra có tham số name không
		$name = "";
		if (isset($_GET["name"]) && $_GET["name"] != "") {

			$name = $_GET["name"];
			if ($dk != "") {
				$dk .= " AND ";
			}
			$dk .= " (fullname LIKE '%$name%' OR user_code = '$name')";
		}
		//sửa lại department thanh id_department

		$id_position = "";

		if (isset($_GET["id_position"]) && $_GET["id_position"] != "") {
			$id_position = $_GET["id_position"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " `id_position` = '$id_position'";
		}
		
		$id_job = "";
		if (isset($_GET["id_job"]) && $_GET["id_job"] != "") {
			$id_job = $_GET["id_job"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}
			$dk .= " `id_job` = '$id_job'";
		}
		


		//begin: kiểm tra điều kiện id_factory
		$id_factory = "";
		if (isset($_GET["id_factory"]) && $_GET["id_factory"] != "") $id_factory = $_GET["id_factory"];
	
		// kiểm tra điều kiện xem chấm công theo nhà máy
		if ($dk != "") $dk .= " AND ";
		$dk .= " `id_factory` = '$id_factory'";
	
		//kiểm tra điều kiện truy vấn nhân viên theo nhà máy
		if ($str_dk_user != "") $str_dk_user .= " AND ";
		$str_dk_user .= " `id_factory` = '$id_factory'";
		//end: kiểm tra điều kiện id_factory

		
		//begin: kiểm tra truy vấn theo điều kiện phân xưởng
		$id_manufactory = "";
		if (isset($_GET["id_manufactory"]) && $_GET["id_manufactory"] != "") $id_manufactory = $_GET["id_manufactory"];

		if($id_manufactory !="")
		{
			if ($dk != "") 	$dk .= " AND ";
			$dk .= " `id_manufactory` = '$id_manufactory'";
		
			if ($str_dk_user != "") $str_dk_user .= " AND ";
			$str_dk_user .= " `id_manufactory` = '$id_manufactory'";
		}
		//end: kiểm tra theo điều kiện phân xưởng	

		//begin: kiểm tra truy vấn theo điều kiện tổ
		$id_group = "";
		if (isset($_GET["id_group"]) && $_GET["id_group"] != "") $id_group = $_GET["id_group"];
			
		if ($dk != "") $dk .= " AND ";
		$dk .= " `id_group` = '$id_group'";
		//end: kiểm tra truy vấn theo điều kiện tổ


		$id_work = "";


		if ($dk != "") $dk = " WHERE " . $dk;

		if ($str_dk_user != "") {
			$str_dk_user = " AND " . $str_dk_user;
		}

		$array_user = $this->User2->find("all");
		
		$array_group = array(""=>array("id"=>"","name"=>"Chọn tổ")); 
		$array_group += $this->Group->find("all", array("fields" => "id,name"));
		
		$array_position = array(""=>array("id"=>"","name"=>"Chọn chức vụ")); 
		$array_position += $this->Position->find("all", array("fields" => "id,name"));

		$array_job = array(""=>array("id"=>"","name"=>"Chọn bộ phận")); 
		$array_job += $this->Job->find("all", array("fields" => "id,name"));
		
		$array_factory = array(""=>array("id"=>"","name"=>"Chọn nhà máy")); 
		$array_factory += $this->Factory->find("all", array("fields" => "id,name"));
		

		$array_manufactory = $this->Manufactory->find("all", array("fields" => "id,name","conditions"=>"id_factory='$id_factory'"));
		if($array_manufactory)	$array_manufactory = array(""=>array("id"=>"","name"=>"Chọn xưởng")) + $array_manufactory; 
		else $array_manufactory = array(""=>array("id"=>"","name"=>"Chọn xưởng")); 
					
		$str_col_user = "id,user_code, fullname, id_factory, factory, id_manufactory, manufactory, id_position, position, id_job, job, id_group, group_name";
		$sql_user = "SELECT $str_col_user FROM scm_users $dk";
		
		
		//begin: kiểm tra có yêu cầu request lấy số liệu ngày bằng ajax
		if(isset($_GET["request"]) && $_GET["request"] =="ajax" )
		{
			
			$sql_chamcong = "SELECT * FROM scm_chamcong $dieukien_chamcong";
			$sql_tonghop_chamcong = "SELECT A.id,A.fullname,B.hour,B.day_type,concat(A.id,'-',B.day) as id_day FROM ($sql_user) AS A LEFT JOIN ($sql_chamcong) AS B ON A.id = B.id_user ";
			
			$array_chamcong = $this->DB->query($sql_tonghop_chamcong);
			$str_json = json_encode($array_chamcong);
			
			echo $str_json;
			return;	
		}
		//end: kiểm tra có yêu cầu request lấy số liệu ngày bằng ajax
		$sql_col_chamcong_sum = "
		,SUM(case when `day_type` = 'HH' then 1 else 0 end) as so_ngaycong_hethang,
		SUM(case when `day_type` = 'BT' then 1 else 0 end) as ngaycong_binhthuong,
		SUM(case when `day_type` = 'MUON-8h' then 1 else 0 end) as so_ngaycong_muon_8h,
		SUM(case when `day_type` = 'HH-KL' then 1 else 0 end) as hethang_khongluong,
		SUM(case when `day_type` = 'BH' then 1 else 0 end) as nghiphep_baohiem,
		SUM(case when `day_type` = 'PHEP' then 1 else 0 end) as ngaynghi_cophep,
		SUM(case when `day_type` = 'VOPHEP' then 1 else 0 end) as ngaynghi_vophep,
		SUM(case when `day_type` = 'THUONG' then 1 else 0 end) as ngaycong_xetthuong,
		SUM(case when `day_type` = 'CN' then 1 else 0 end) as ngaycong_chunhat,
		SUM(case when `day_type` = 'KHONGBAMTHE' then 1 else 0 end) as ngay_khong_bamthe,
		SUM(case when `day_type` = '8H' then 1 else 0 end) as ngaycong_hon8h,
		SUM(case when `day_type` = 'SUA' then 1 else 0 end) as ngaycong_tinh_tiensua,
		SUM(case when `hour` >= 8 then 1 else 0 end) as ngaycong_lamhon_8h,
		SUM(case when `hour` < 8 then `hour` else 0 end) as tongsogio_ngaylamduoi_8h,
		SUM(case when `day_type` = 'CN' then `hour` else 0 end) as tonggio_chunhat,
		SUM(case when `day_type` = 'NGAYLE' then `hour` else 0 end) as tonggio_ngayle,
		SUM(case when `day_type` = 'TROCAP' then 1 else 0 end) as ngaycong_tinh_trocap,
		SUM(case when `day_type` <> 'CN' AND `hour`<8 then `hour` else 0 end) as tonggio_duoi7_khac_cn,
		SUM(case when `day_type` <> 'CN' AND `hour`>=8 then 1 else 0 end) as ngaycong_hon8_khac_cn,
		SUM(`hour`) AS tong_gio_cong
		";
		$sql_col_chamcong = "id_user, user_fullname, user_code $sql_col_chamcong_sum";
		$sql_chamcong = "SELECT $sql_col_chamcong FROM scm_chamcong $dieukien_chamcong GROUP BY id_user, user_fullname, user_code ORDER BY id_user ASC";
		 
		$sql_col_tonghop = "B.ngaycong_binhthuong, B.so_ngaycong_hethang, B.so_ngaycong_muon_8h, B.hethang_khongluong";
		$sql_col_tonghop .= ", B.nghiphep_baohiem, B.ngaynghi_cophep, B.ngaynghi_vophep";
		$sql_col_tonghop .= ", B.ngaycong_xetthuong, B.ngaycong_chunhat, B.ngay_khong_bamthe";
		$sql_col_tonghop .= ", B.ngaycong_hon8h, B.ngaycong_tinh_tiensua, B.tong_gio_cong";
		$sql_col_tonghop .= ", B.ngaycong_lamhon_8h, B.tongsogio_ngaylamduoi_8h, B.tonggio_chunhat";
		$sql_col_tonghop .= ", B.tonggio_ngayle, B.ngaycong_tinh_trocap,B.tonggio_duoi7_khac_cn, B.ngaycong_hon8_khac_cn";
		
		$sql_tonghop_chamcong = "SELECT A.*, $sql_col_tonghop FROM ($sql_user) AS A LEFT JOIN ($sql_chamcong) AS B ON A.id = B.id_user ";
		//echo $sql_tonghop_chamcong;
		/*$sql_adtendance = "SELECT `id_user`, `month`,

		SUM(case when `id_date_allowance` = 1 then 1 else 0 end) as so_ngaycong_hethang,
		SUM(case when `id_date_allowance` = 2 then 1 else 0 end) as so_ngaycong_hethang_khongluong,
		SUM(case when `id_date_allowance` = 3 then 1 else 0 end) as ngaynghi_baohiem,
		SUM(case when `id_date_allowance` = 7 then 1 else 0 end) as ngaynghi_cophep,
		SUM(case when `id_date_allowance` = 8 then 1 else 0 end) as ngaynghi_khongphep,
		SUM(case when `id_date_allowance` = 11 then 1 else 0 end) as ngaycong_dimuon_du8h,
		SUM(case when `id_date_allowance` = 6 then 1 else 0 end) as ngaycong_chunhat,
		SUM(case when `id_date_allowance` = 9 then 1 else 0 end) as ngaycong_khong_bamthe,
		SUM(case when `num_hour` > 8 then 1 else 0 end) as ngaycong_lamhon_8h,
		SUM(case when `id_date_allowance` = 10 then 1 else 0 end) as ngaycong_tinh_tiensua,
		SUM(`num_hour`) AS tong_gio_cong,
		SUM(case when `type` = 0 then `num_hour` else 0 end) as tong_gio_cong_hanhchinh,
		SUM(case when `id_date_allowance` = 6 then `num_hour` else 0 end) as tong_gio_cong_chunhat
		FROM scm_attendace_times $dk GROUP BY `id_user`, `month`";

		$sql_sum_attendance = "SELECT a.*, b.`month`, b.`so_ngaycong_hethang`, b.`ngaynghi_baohiem`, b.`ngaynghi_cophep`, b.`ngaynghi_khongphep`, b.`ngaycong_dimuon_du8h`, b.`ngaycong_chunhat`, b.`ngaycong_khong_bamthe`, b.`ngaycong_lamhon_8h`, b.`ngaycong_tinh_tiensua`, b.`tong_gio_cong`, b.`tong_gio_cong_hanhchinh`, b.`tong_gio_cong_chunhat`, b.`so_ngaycong_hethang_khongluong`
		FROM scm_users AS a, ($sql_adtendance) AS b WHERE a.id = b.id_user $str_dk_user AND `type` <> 1  ORDER BY `month`";
		*/
		$array_attendance = $this->Attendance->query($sql_tonghop_chamcong);
		$array_param_view = array(
			"array_position" => $array_position,
			"array_job" => $array_job,
			"array_group" => $array_group,
			"array_factory" => $array_factory,
			"array_manufactory" => $array_manufactory,
			"array_user" => $array_user,
			"array_attendance" => $array_attendance,
			"name" => $name,
			"date_to"=>$date_to,
			"date_from" => $date_from,
			"id_job" => $id_job,
			"id_position" => $id_position,
			"id_group"=>$id_group,
			"id_factory" => $id_factory,
			"id_manufactory" => $id_manufactory,

		);
		$html_result = $this->View->render("summary_attendance2.php", $array_param_view);

		echo $html_result;
	}
	function add_holiday($id = "") {
		$this->loadModel('User2', "users");

		$this->loadModel('Salary_holiday', "salary_holidays");
		$this->loadModel('Department');
		$this->loadModel('Position');
		$this->loadModel('Job');
		$this->loadModel('Factory');
		$this->loadModel('Manufactory');

		// print_r($array_department);
		if (isset($_POST['data'])) {
			//đua ten vao bang csdl
			$data = $_POST['data'];
			$date = $_POST['date'];
			$status = $_POST['dilam'];

			$array_word_type = array("1" => "Có", "2" => "Không");
			foreach ($data as $salary_holiday) {
				$salary_holiday['status'] = $array_word_type[$status];
				$date = date("Y-m-d ", strtotime($date));

				$salary_holiday['thang'] = date("Y-m-01", strtotime($date));
				//tạo phần tử ngay cho mảng
				$salary_holiday['date'] = $date;
				$this->Salary_holiday->save($salary_holiday);
			}

			$this->redirect("/attendance2/holiday.html");
		}

		// BEGIN: KIỂM TRA ĐIỀU KIỆN SUBMIT TỪ FORM SEARCH
		$dk = "";
		//kiểm tra có tham số name không
		$name = "";
		if (isset($_GET["name"]) && $_GET["name"] != "") {
			$name = $_GET["name"];
			$dk = " fullname LIKE '%$name%'";
		}

		// kiểm tra đk phòng ban
		$id_department = "";
		if (isset($_GET["id_department"]) && $_GET["id_department"] != "") {
			$id_department = $_GET["id_department"];
			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_department = '$id_department'";
		}

		// kiểm tra đk chức vụ
		$id_position = "";
		if (isset($_GET["id_position"]) && $_GET["id_position"] != "") {
			$id_position = $_GET["id_position"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_position = '$id_position'";
		}

		// kiểm tra dk nhà máy
		$id_factory = "";
		if (isset($_GET["id_factory"]) && $_GET["id_factory"] != "") {
			$id_factory = $_GET["id_factory"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_factory = '$id_factory'";
		}

		// kiểm tra đk phân xưởng
		$id_manufactory = "";
		if (isset($_GET["id_manufactory"]) && $_GET["id_manufactory"] != "") {
			$id_manufactory = $_GET["id_manufactory"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_manufactory = '$id_manufactory'";
		}

		// kiểm tra đk công việc
		$id_work = "";
		if (isset($_GET["id_work"]) && $_GET["id_work"] != "") {
			$id_work = $_GET["id_work"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " id_work = '$id_work'";
		}
		// END: KIỂM TRA ĐIỀU KIỆN SUBMIT TỪ FORM SARCH

		// BEGIN: KIỂM TRA NẾU CÓ THAM SỐ ID THÌ SỬA
		if ($id != "") {
			$array_edit = $this->Salary_holiday->find("all", array("conditions" => "id='$id'"));
			$html_result = $this->View->render("edit_holiday.php", array("array_edit" => $array_edit));
			echo $html_result;
			return;
		}
		// END: KIỂM TRA NẾU CÓ THAM SỐ ID THÌ SỬA

		$array_user = $this->User2->find("all", array("conditions" => $dk));
		$array_department = $this->Department->find("all", array("fields" => "id,name"));
		$array_position = $this->Position->find("all", array("fields" => "id,name"));

		$array_work = $this->Job->find("all", array("fields" => "id,name"));

		$array_factory = $this->Factory->find("all", array("fields" => "id,name"));

		$array_manufactory = $this->Manufactory->find("all", array("fields" => "id,name"));

		$array_edit_salary_holiday = null;
		if ($id != "") {
			$array_edit_salary_holiday = $this->Salary_holiday->find("all", array("conditions" => "id='$id'"));
		}

		$array_param_view = array(
			"array_user" => $array_user,
			"array_department" => $array_department,
			"array_position" => $array_position,
			"array_work" => $array_work,
			"array_factory" => $array_factory,
			"array_manufactory" => $array_manufactory,
			"array__edit_salary_holiday" => $array_edit_salary_holiday,
			"name" => $name,
			"id_manufactory" => $id_manufactory,
			"id_position" => $id_position,
			"id_factory" => $id_factory,
			"id_work" => $id_work,
			"id_department" => $id_department,
		);
		$html_result = $this->View->render("add_holiday_attendance2.php", $array_param_view);

		echo $html_result;
	}

	function holiday() {

		$this->loadModel('Salary_holiday');
		$this->loadModel('Department');
		$this->loadModel('Position');
		$this->loadModel('Job');
		$this->loadModel('Factory');
		$this->loadModel('Manufactory');

		$dk = "";

		$str_dk_user = "";
		//kiểm tra có tham số date_from không
		$date_from = "";
		if (isset($_GET["date_from"]) && $_GET["date_from"] != "") {
			$date_from = $_GET["date_from"];
			$dk_date_from = date("Y-m-d ", strtotime($date_from));
			$dk = " `date` >= '$dk_date_from' ";
		}

		//kiểm tra có tham số date_to không
		$date_to = "";
		if (isset($_GET["date_to"]) && $_GET["date_to"] != "") {
			$date_to = $_GET["date_to"];

			// chuyển $date về định dạng ngày của database,
			$dk_date_to = date("Y-m-d ", strtotime($date_to));

			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " `date` <= '$dk_date_to' ";
		}

		//kiểm tra có tham số name không
		$name = "";
		if (isset($_GET["name"]) && $_GET["name"] != "") {

			$name = $_GET["name"];
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " fullname LIKE '%$name%'";
			$str_dk_user = " fullname LIKE '%$name%'";
		}
		//sửa lại department thanh id_department

		$id_department = "";

		if (isset($_GET["id_department"]) && $_GET["id_department"] != "") {
			$id_department = $_GET["id_department"];
			if ($id_department != "") {
				// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
				if ($dk != "") {
					$dk .= " AND ";
				}

				$dk .= " id_department = '$id_department'";

				if ($str_dk_user != "") {
					$str_dk_user .= " AND ";
				}

				$str_dk_user .= " id_department = '$id_department'";
			}
		}

		$id_position = "";

		if (isset($_GET["id_position"]) && $_GET["id_position"] != "") {
			$id_position = $_GET["id_position"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " `id_position` = '$id_position'";

			if ($str_dk_user != "") {
				$str_dk_user .= " AND ";
			}

			$str_dk_user .= " `id_position` = '$id_position'";
		}

		$id_factory = "";

		if (isset($_GET["id_factory"]) && $_GET["id_factory"] != "") {
			$id_factory = $_GET["id_factory"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " `id_factory` = '$id_factory'";
			if ($str_dk_user != "") {
				$str_dk_user .= " AND ";
			}

			$str_dk_user .= " `id_factory` = '$id_factory'";
		}

		$id_manufactory = "";

		if (isset($_GET["id_manufactory"]) && $_GET["id_manufactory"] != "") {
			$id_manufactory = $_GET["id_manufactory"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " `id_manufactory` = '$id_manufactory'";
			if ($str_dk_user != "") {
				$str_dk_user .= " AND ";
			}

			$str_dk_user .= " `id_manufactory` = '$id_manufactory'";
		}

		$id_work = "";

		if (isset($_GET["id_work"]) && $_GET["id_work"] != "") {
			$id_work = $_GET["id_work"];

			// kiểm tra có điều kiện chưa, nếu có rồi thì phải thêm chữ AND
			if ($dk != "") {
				$dk .= " AND ";
			}

			$dk .= " `id_work` = '$id_work'";
			if ($str_dk_user != "") {
				$str_dk_user .= " AND ";
			}

			$str_dk_user .= " `id_work` = '$id_work'";
		}

		$array_salary_holiday = $this->Salary_holiday->find("all", array("conditions" => $dk));
		$array_department = $this->Department->find("all", array("fields" => "id,name"));
		$array_position = $this->Position->find("all", array("fields" => "id,name"));

		$array_work = $this->Job->find("all", array("fields" => "id,name"));

		$array_factory = $this->Factory->find("all", array("fields" => "id,name"));

		$array_manufactory = $this->Manufactory->find("all", array("fields" => "id,name"));

		$array_param_view = array(
			"array_salary_holiday" => $array_salary_holiday,
			"array_department" => $array_department,
			"array_position" => $array_position,
			"array_work" => $array_work,
			"array_factory" => $array_factory,
			"array_manufactory" => $array_manufactory,
			"name" => $name,
			"id_manufactory" => $id_manufactory,
			"id_position" => $id_position,
			"id_factory" => $id_factory,
			"id_work" => $id_work,
			"id_department" => $id_department,
			"dk_date_from" => $dk_date_from,
			"dk_date_to" => $dk_date_to,
		);

		$html_result = $this->View->render("holiday_attendance2.php", $array_param_view);

		echo $html_result;
	}

	// xóa của ca
	function del($id = "") {
		if ($id != "") {
			// xóa sản phẩm theo id
			$this->loadModel('Administrative_time', "attendace_times");
			$this->Administrative_time->delete($id);

			// chuyển về trang index

			$this->redirect("/attendance2/night_shift.html");
		}
	}
	// xóa của holiday
	function del1($id = "") {
		if ($id != "") {
			// xóa sản phẩm theo id
			$this->loadModel('Salary_holiday', "salary_holidays");
			$this->Salary_holiday->delete($id);

			// chuyển về trang index

			$this->redirect("/attendance2/holiday.html");
		}
	}
	//xóa của hành chính
	function del2($id = "") {
		if ($id != "") {
			// xóa sản phẩm theo id
			$this->loadModel('Administrative_time', "attendace_times");
			$this->Administrative_time->delete($id);

			// chuyển về trang index

			$this->redirect("/attendance2/day_shift.html");
		}
	}
	// xóa chi tiết san phẩm
	function del3($id = "") {
		if ($id != "") {
			// xóa sản phẩm theo id
			$this->loadModel('Att_Product', "attendance_products");
			$this->Att_Product->delete($id);

			// chuyển về trang index

			$this->redirect("/attendance2/product.html");
		}
	}
}
?>