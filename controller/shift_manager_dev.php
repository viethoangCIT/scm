	<?php
class shift_manager extends Main {
	function index($id = "") {

		$this->loadModel("Shift", "shift");

		//BEGIN:Kiểm tra nếu có dữ liệu submit để lưu
		if (isset($_POST["data"])) {
			$array_data = $_POST["data"];
			$this->Shift->save($array_data);
		}
		//END:Kiểm tra nếu có dữ liệu submit để lưu

		// BEGIN: Kiểm nếu có tham số act để sửa xóa
		$act = "";
		$array_edit = null;
		if (isset($_GET["act"])) {
			$act = $_GET["act"];
			if ($act == "edit") {
				if ($id != "") {
					$array_edit = $this->Shift->find("all", array("conditions" => "id='$id'"));

				}
			} else if ($act == "del") {
				if ($id != "") {
					$this->Shift->delete($id);
				}
			}
		}

		$array_data = $this->Shift->find("all");

		$array_param = array(
			"array_data" => $array_data,
			"array_edit" => $array_edit,
		);

		$html = $this->View->render("view_shift.php", $array_param);
		echo $html;
	}

}
?>