<?php
class material extends Main {
	
	function import($type=1,$id = "") {
		$this->loadModel("MaterialImport", "material_import");
		$this->loadModel("MaterialImportDetail", "material_import_detail");
		$this->loadModel("Material", "material");
		$this->loadModel("Material_list", "material_list");
		$this->loadModel("Supplier","suppliers");
		$this->loadModel("User2","users");
		

		//BEGIN :Kiểm tra có dữ liệu để lưu
		if (isset($_POST["data"]) && isset($_POST["MaterialImport"])) 
		{
			
			$array_data = $_POST["data"];
			$array_material_import = $_POST["MaterialImport"];
			$array_material_import["day"] = date("Y-m-d", strtotime($array_material_import["day"]));
			$array_material_import["type"] = $type;

			$id_customer = $array_material_import["id_customer"];

			$id_warehouse = $array_material_import["id_warehouse"];

			$array_customer_name = $this->Supplier->find("all", array("conditions"=>"id = '$id_customer'"));

			$array_warehouse_name = $this->Material_list->find("all", array("conditions"=>"id = '$id_warehouse'"));

			$array_material_import["customer_name"] = $array_customer_name[0]["name"];

			$array_material_import["warehouse_name"] = $array_warehouse_name[0]["name"];



			//lưu vào bảng material_import
			$this->MaterialImport->save($array_material_import);

			//lấy id material_import
			$id_material_import = $array_material_import["id"];
			
			//nếu chưa có $id_material_import thì lấy $id_material_import vừa lưu
			if ($id_material_import=="") 	$id_material_import = $this->MaterialImport->get_value(array("fields" => "MAX(id)"));
			
			foreach ($array_data as $data) 
			{
				//chỉ lưu những trường hiển thị lên
				if($data["status"]=="1")
				{
					$data["id_warehouse"] = $array_material_import["id_warehouse"];
					$data["customer_name"] = $array_customer_name[0]["name"];
					$data["id_customer"] = $array_material_import["id_customer"];
					$data["warehouse_name"] = $array_warehouse_name[0]["name"];
					$data["material_name"] = $this->Material->get_value(array("fields" => "name","conditions"=>"id='".$data["id_material"]."'"));
					$data["price"] = str_replace(",","",$data["price"]);
					$data["id_user"] = $array_material_import["id_user"];
					$data["form_code"] = $array_material_import["code"];
					$data["day"] = $array_material_import["day"];
					$data["id_material_import"] = $id_material_import;
					$data["type"] = $type;
					$this->MaterialImportDetail->save($data);
				}

			}
			$this->redirect("/material/import_history/$type.html");

		}//end: if (isset($_POST["data"]) && isset($_POST["MaterialImport"])) 
		//END :Kiểm tra có dữ liệu để lưu
		
		//lấy nguyên liệu đưa vào combobox nguyên liệu
		$array_material = $this->Material->find("all", array("fields" => "id,name,code"));

		//truy van dư liệu từ bảng material_import theo id để hiển thi ra form trên table
		$array_material_import = null;
		$array_material_import_detail = null;
		if ($id != "") {

			$array_material_import = $this->MaterialImport->find("all", array("conditions" => "id='$id'"));

			$array_material_import_detail = $this->MaterialImportDetail->find("all", array("conditions" => "id_material_import='$id'"));

		}

		$array_user = $this->User2->find("all",array("fields"=>"id,fullname"));
		
		//lấy dữ liệu từ danh mục kho đưa vào combobox kho
		$array_warehouse = $this->Material_list->find("all", array("fields"=>"id, name"));
		
		$array_supplier = $this->Supplier->find("all", array("fields"=>"id, name"));

		$array_param = array(
			"array_user" => $array_user,
			"array_material" => $array_material,
			"array_warehouse" => $array_warehouse,
			"array_supplier" => $array_supplier,
			"array_material_import_detail" => $array_material_import_detail,
			"array_material_import" => $array_material_import,
			"type"=>$type
		);
		$html = $this->View->render("import_material.php", $array_param);
		echo $html;
	}

	function import_history($type="") {
		$this->loadModel("MaterialImport", "material_import");

		$array_material = $this->MaterialImport->find("all",array("conditions"=>"type='$type'"));

		$array_param = array(
			"array_material" => $array_material,
			"type"=>$type
		);

		$html = $this->View->render("import_history.php", $array_param);
		echo $html;
	}
	
	//begin: function del_import
	function del_import($id_material_import = "",$id_material_import_detail = "") 
	{
		$this->loadModel("MaterialImportDetail", "material_import_detail");
		
		if($id_material_import_detail != "")
		{
			$this->MaterialImportDetail->delete($id_material_import_detail);
			$this->Session->set_flash("msg","del_ok");
			$this->redirect("/material/import/$id_material_import.html");
		}
	}//end: function del_import($id_material_import = "",$id_material_import_detail = "") 

	function export($id = "") {
		$this->loadModel("MaterialExport", "material_export");
		$this->loadModel("MaterialExportDetail", "material_export_detail");
		$this->loadModel("Material", "material");

		if (isset($_POST["data"]) && isset($_POST["MaterialExport"])) {
			$array_data = $_POST["data"];
			$array_material_export = $_POST["MaterialExport"];
			$array_material_export["day"] = date("Y-m-d", strtotime($array_material_export["day"]));

			//lưu vào bảng material_export
			$this->MaterialExport->save($array_material_export);

			//lấy id material_export vừa lưu
			$id_material_export = "";
			if (!isset($array_material_export["id"])) {
				$id_material_export = $this->MaterialExport->get_value(array("fields" => "MAX(id)"));
			}

			//lưu vào bảng material_export_detail

			//print_r($array_data);
			foreach ($array_data as $data) {
				$data["id_warehouse"] = $array_material_export["id_warehouse"];
				// $data["id_customer"] = $array_material_export["id_customer"];
				$data["id_user"] = $array_material_export["id_user"];
				$data["form_code"] = $array_material_export["code"];
				$data["day"] = $array_material_export["day"];
				$data["id_material_export"] = $id_material_export;
				if ($array_material_export["id"] != "") {
					$data["id_material_export"] = $array_material_export["id"];
				}
				if ($data["status"] == "1") {
					//lưu vào bàng
					$this->MaterialExportDetail->save($data);
				}

			}
			$this->redirect("/material/export_history");

		}

		//lấy nguyên liệu đưa vào combobox nguyên liệu
		$array_material = $this->Material->find("all", array("fields" => "id,name,code"));

		//truy van dư liệu từ bảng material_export theo id để hiển thi ra form trên table
		$array_material_export = null;
		$array_material_export_detail = null;
		if ($id != "") {

			$array_material_export = $this->MaterialExport->find("all", array("conditions" => "id='$id'"));

			$array_material_export_detail = $this->MaterialExportDetail->find("all", array("conditions" => "id_material_export='$id'"));

		}

		$array_param = array(
			"array_material" => $array_material,
			"array_material_export_detail" => $array_material_export_detail,
			"array_material_export" => $array_material_export,
		);
		$html = $this->View->render("export_material.php", $array_param);
		echo $html;
	}

	function export_history() {
		$this->loadModel("MaterialExport", "material_export");

		$array_material = $this->MaterialExport->find("all");

		$array_param = array(
			"array_material" => $array_material,
		);

		$html = $this->View->render("export_history.php", $array_param);
		echo $html;
	}

	function index_material() {

		$this->loadModel("Material", "material");

		//kiểm tra có tham số search từ trình duyệt không
		$search = "";
		if (isset($_GET['search'])) {
			//lấy dữ liệu submit lên vào biến $search
			$search = $_GET['search'];
		}

		//gọi hàm find của đối tượng Material để truy vấn tất cả dữ liệu từ bảng material, đưa vào mảng $array_material
		$array_material = $this->Material->find("all", array("conditions" => "name LIKE '%$search%' OR code LIKE '%$search%'"));

		//dùng hàm render của đối tượng View để truy cập tới file danh sách material: index_material.php, trả kết quả về biến html
		$html_result = $this->View->render('index_material.php', array('array_material' => $array_material, "search" => $search));
		echo $html_result;
	}

	function add_material() {
		$this->loadModel("Material", "material");
		$this->loadModel("Material_group", "material_groups");
		if (isset($_POST["name"])) {

			$array_material = NULL;
			$array_material = array(
				"name" => $_POST["name"],
				"code" => $_POST["code"],
				"bar_code" => $_POST["bar_code"],
				"unit" => $_POST["unit"],
				"quota" => $_POST["quota"],
				"id" => $_POST["id"],
				"id_group" => $_POST["id_group"]);

			$id = $array_material["id"];
			if ($id == "") {
				$msg = "add_material";
			} else {
				$msg = "edit";
			}

			$id_group = $array_material["id_group"];

			$array_id_group = $this->Material_group->find("all", array("conditions"=>"id = '$id_group'"));

			$array_material["name_group"] = $array_id_group[0]["name"];

			$this->Material->save($array_material);
			$this->redirect("/material/index_material?msg=$msg");
		}

		$array_edit_material = NULL;
		if (isset($_GET["id"])) {
			$id = $_GET["id"];
			$array_edit_material = $this->Material->find("all", array('conditions' => "`id`= '$id'"));

		}

		$array_group = $this->Material_group->find("all", array("fields"=>"id, name"));

		//Thêm phần tử của mảng đầu tiên array_user
		$array_group  = array(""=>array("id"=>"","name"=>"..."))+ $array_group;

		$html_form_list_material = $this->View->render('add_material.php', array('array_edit_material' => $array_edit_material, "array_group"=>$array_group));
		echo $html_form_list_material;
	}

	function del() {
		$msg = "del";
		$this->loadModel("Material", "material");
		if (isset($_GET["id"])) {
			$id = $_GET["id"];
			$this->Material->delete($id);
			$this->redirect("/material/index_material?msg=$msg");

		}
	}

	//TỒN KHO
	function inventoriy() {
		$this->loadModel("MaterialImportDetail", "material_import_detail");
		$this->loadModel("MaterialExportDetail", "material_export_detail");

		$dk = "";
		$id_warehouse = "";
		$start_day = "";
		$end_day = "";
		if (isset($_GET["data"])) {
			if ($_GET["data"]["id_warehouse"]) {
				$id_warehouse = $_GET["data"]["id_warehouse"];
				$dk .= "AND A.id_warehouse = $id_warehouse";
			}
			if ($_GET["data"]["start_day"] != "" && $_GET["data"]["end_day"] != "") {
				$start_day = $_GET["data"]["start_day"];
				$end_day = $_GET["data"]["end_day"];
				$dk .= " AND A.day BETWEEN '$start_day' AND '$end_day'";
			}
		}

		//tuy van du lieu 2 bang material_import_detail vaf material_export_detail
		$table_prefix = $this->Company->table_prefix;
		$table_material = $table_prefix ."material";
		$table_material_import_detail = $table_prefix ."material_import_detail";
		
		$sql_nguyenlieu = "SELECT * FROM $table_material";
		$sql_nhapkho  = "SELECT id_material, SUM(num) as tong_nhap FROM $table_material_import_detail WHERE type =1 GROUP BY id_material  ";
		$sql_xuatkho  = "SELECT id_material, SUM(num) as tong_xuat FROM $table_material_import_detail WHERE type =2 GROUP BY id_material  ";
		
		$sql_ton   = " SELECT A.*,B.tong_nhap,C.tong_xuat FROM ($sql_nguyenlieu) as A LEFT JOIN ($sql_nhapkho) as B ON A.id = B.id_material LEFT JOIN ($sql_xuatkho) as C ON A.id=C.id_material WHERE B.tong_nhap>0 OR C.tong_xuat>0";
		$array_data = $this->MaterialImportDetail->query($sql_ton);

		$array_param = array(
			"array_data" => $array_data,
			"id_warehouse" => $id_warehouse,
			"start_day" => $start_day,
			"end_day" => $end_day,
		);

		$html = $this->View->render("inventoriy_material.php", $array_param);
		echo $html;
	}

	function excel() {
		$this->loadModel("MaterialImportDetail", "material_import_detail");
		$this->loadModel("MaterialExportDetail", "material_export_detail");
		// ép dữ liệu để trình duyệt tải xuống máy không dữ liệu hiển thị ra máy
		$file_url = "dulieu_tonkho.xls";
		header('Content-Type: application/octet-stream');
		header("Content-Transfer-Encoding: Binary");
		header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");

		$dk = "";
		$id_warehouse = "";
		$start_day = "";
		$end_day = "";
		if ($_GET["id_warehouse"]) {
			$id_warehouse = $_GET["id_warehouse"];
			$dk .= "AND A.id_warehouse = $id_warehouse";
		}
		if ($_GET["start_day"] != "" && $_GET["end_day"] != "") {
			$start_day = $_GET["start_day"];
			$end_day = $_GET["end_day"];
			$dk .= " AND A.day BETWEEN '$start_day' AND '$end_day'";
		}
		$sql_excel = "
				SELECT A.material_name, A.code, A.num AS num_import,A.unit_price,B.num AS num_export,
				(A.num - B.num) AS rest, ((A.num - B.num)*A.unit_price) AS into_price
				FROM scm_material_import_detail A
				INNER JOIN scm_material_export_detail B
				ON A.id_warehouse = B.id_warehouse
				WHERE A.day = B.day $dk
				";

		$array_data = $this->MaterialImportDetail->query($sql_excel);

		$array_param = array(
			"array_data" => $array_data,
		);

		$html = $this->View->render("excel_material.php", $array_param, false);
		echo $html;
	}

	function material_group($id="")
	{
		//tạo đối tương model Material_group để liên kết với bảng material_groups
		$this->loadModel("Material_group", "material_groups");

		//kiểm tra có dữ liệu submit lưu vào bảng không
		if(isset($_POST["data"]))
		{
			$array_data = $_POST["data"];

			$this->Material_group->save($array_data);

			$this->redirect("/material/material_group.html");
		}

		$array_edit_group = "";
		if($id!="")
		{
			$array_edit_group = $this->Material_group->find("all", array("conditions"=>"id = '$id'"));
		}

		$array_group = $this->Material_group->find("all");

		$html = $this->View->render("material_group.php", array("array_group"=>$array_group, "array_edit_group"=>$array_edit_group));
		echo $html;
	}

	function del_group($id="")
	{
		if($id!="")
		{
			$this->loadModel("Material_group", "material_groups");
			$this->Material_group->delete($id);

			$this->redirect("/material/material_group.html");
		}
	}

	//hàm danh mục kho
	function list_material($id="")
	{
		//tạo đối tượng model Material_list để liên kết với bảng material_list
		$this->loadModel("Material_list", "material_list");

		//kiểm tra có dữ liệu submit lên không
		if(isset($_POST["data"]))
		{
			//lấy giá trị submit lên vào mảng $array_data
			$array_data = $_POST["data"];

			//chuyển chuỗi ngày định dạng d-m-y thành Y-m-d
			$array_data["day"] = date("Y-m-d",strtotime($array_data["day"]));

			//dùng hàm save để lưu mảng array_data vào csdl
			$this->Material_list->save($array_data);

			//dùng hàm redirect để chuyển về hàm list_material
			$this->redirect("/material/list_material.html");

		}

		//tạo mảng array_edit_list có giá trị là NULL
		$array_edit_list = NULL;

		//kiểm tra id có khác rỗng hay không
		if($id!="")
		{	
			//dùng hàm find của đối tượng Material_list để truy vấn theo id=$id đưa vào mảng $array_edit_list
			$array_edit_list = $this->Material_list->find("all", array("conditions"=>"id = '$id'"));
		}

		//dùng hàm find của đối tương Material_list để truy vấn tất cả dữ liệu có trong mảng ra view
		$array_list_material = $this->Material_list->find("all");

		//tạo mảng array_param để nhóm các phần tử và giá trị các mảng để đưa qua View
		$array_param = array("array_list_material"=>$array_list_material,
								"array_edit_list"=>$array_edit_list
							);

		$html_result = $this->View->render("list_material.php", $array_param);
		echo $html_result;
	}

	function del_list($id="")
	{
		if($id!="")
		{
			//tạo đối tượng Material_list để liên kết với bảng material_list
			$this->loadModel("Material_list","material_list");

			//dùng hàm delete để xóa theo id
			$this->Material_list->delete($id);

			//dùng hàm redirect để chuyển về hàm list_material
			$this->redirect("/material/list_material.html");
		}
	}

}
?>