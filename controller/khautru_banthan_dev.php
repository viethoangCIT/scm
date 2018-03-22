<?php
class khautru_banthan extends Main {
	function index() {

		//lấy ra model dữ liệu
		$this->loadModel("KhauTru", "khautru_banthan");

		//truy vấn dữ liệu
		$array_khautru = $this->KhauTru->find("all");

		$array_param = array(
			"array_khautru" => $array_khautru,
		);

		$html = $this->View->render('index_khautru_banthan.php', $array_param);
		echo $html;
	}

	//them
	function add($id = "") {
		$this->loadModel("KhauTru", "khautru_banthan");

		if (isset($_POST["data"])) {

			$date = date("Y-m-d");

			$array_khautru = $_POST["data"];
			$array_khautru["thoidiem"] = date("Y-m-d", strtotime($array_khautru["thoidiem"]));
			$array_khautru["created"] = $date;
			$array_khautru["modified"] = $date;

			$this->KhauTru->save($array_khautru);

			$this->redirect("/khautru_banthan/index");
		}

		$array_khautru = null;

		if ($id != "") {
			$array_khautru = $this->KhauTru->find("all", array("conditions" => "`id` = '$id'"));

		}

		$html = $this->View->render("add_khautru_banthan.php", array("array_khautru" => $array_khautru));
		echo $html;
	}

	function del($id = "") {
		if ($id != "") {
			$this->loadModel("KhauTru", "khautru_banthan");
			$this->KhauTru->delete($id);
			$this->redirect("/khautru_banthan/index");
		}
	}

}
?>