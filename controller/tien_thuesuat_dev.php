<?php
class tien_thuesuat extends Main {
	function index() {

		//lấy ra model dữ liệ
		$this->loadModel("ThueSuat", "tien_thuesuat");

		//truy vấn dữ liệu
		$array_thuesuat = $this->ThueSuat->find("all");

		$array_param = array(
			"array_thuesuat" => $array_thuesuat,
		);

		$html = $this->View->render('index_tien_thuesuat.php', $array_param);
		echo $html;
	}

	//them
	function add($id = "") {
		$this->loadModel("ThueSuat", "tien_thuesuat");

		if (isset($_POST["data"])) {

			$date = date("Y-m-d");

			$array_thuesuat = $_POST["data"];
			$array_thuesuat["thoidiem"] = date("Y-m-d", strtotime($array_thuesuat["thoidiem"]));

			$this->ThueSuat->save($array_thuesuat);

			$this->redirect("/tien_thuesuat/index");
		}

		$array_thuesuat = null;

		if ($id != "") {
			$array_thuesuat = $this->ThueSuat->find("all", array("conditions" => "`id` = '$id'"));

		}

		$html = $this->View->render("add_tien_thuesuat.php", array("array_thuesuat" => $array_thuesuat));
		echo $html;
	}

	function del($id = "") {
		if ($id != "") {
			$this->loadModel("ThueSuat", "tien_thuesuat");
			$this->ThueSuat->delete($id);
			$this->redirect("/tien_thuesuat/index");
		}
	}

}
?>