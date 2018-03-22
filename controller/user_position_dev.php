<?php
class user_position extends Main {
	function position($id_user = "", $id_user_position = "") {

		$this->loadModel('User2', "users");
		$this->loadModel('PoUser', "position_users");
		$this->loadModel('Position');

		if (isset($_POST["data"])) {

			$data = $_POST["data"];
			$date = $data['date'];
			$data['date'] = date("Y-m-d ", strtotime($date));
			$data1 = $data['id_position'];
			$array_position1 = $this->Position->find("all", array("conditions" => "id='$data1'"));
			$data["fullname"] = $this->User2->get_value(array("fields" => "fullname", "conditions" => "id='$id_user'"));
			$data["user_code"] = $this->User2->get_value(array("fields" => "user_code", "conditions" => "id='$id_user'"));
			$data['position'] = $array_position1[0]['name'];

			// lưu dữ liệu vào bảng chức vụ
			$this->PoUser->save($data);

			//  lấy id_user, id_position, date để update ngày lên chức vụ cho nhân viên
			$user = NULL;
			$user["id"] = $data["id_user"];
			$user["id_position"] = $data["id_position"];
			$user["position"] = $data["position"];
			$user["date_position"] = $data["date"];
			$user["position_factor"] = $data["position_factor"];

			// lưu ngày chức vụ và tên chức vụ vào bảng user
			$this->User2->save($user);

		}
		$array_edit_po_user = null;
		if ($id_user_position != "") {
			$array_edit_po_user = $this->PoUser->find("all", array("conditions" => "`id` = '$id_user_position'"));
		}

		//truy vấn dữ liệu từ bảng uses
		$fullname = $this->User2->get_value(array("fields" => "fullname", "conditions" => "`id` = '$id_user'"));

		//truy vấn tất cả chức vụ của nhân viên
		$array_po_user = $this->PoUser->find("all", array("conditions" => "`id_user` = '$id_user'"));

		//truy vấn tất cả chức vụ trong danh mục chức vụ để đưa vào selectbox chức vụ
		$array_position = $this->Position->find("all", array("fields" => "id,name"));

		$array_param = array(
			"array_position" => $array_position,
			"array_po_user" => $array_po_user,
			"array_edit_po_user" => $array_edit_po_user,
			"fullname" => $fullname,
			"id_user" => $id_user,
		);

		$html_result = $this->View->render("list_position.php", $array_param);

		echo $html_result;
	}

	// xóa
	function del($id_user = "", $id_position = "") {
		if ($id_position != "") {
			// xóa sản phẩm theo id
			$this->loadModel('Pouser', "position_users");
			$this->Pouser->delete($id_position);
			$this->redirect("/user_position/position/$id_user");

		} //END: if ($id_position != "")

	} //END:function del($id_user = "", $id_position = "")

//end_class

}
?>