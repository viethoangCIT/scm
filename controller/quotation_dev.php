<?php
	class  quotation extends Main
	{
		function add()
		{
			//tạo đối tượng loadModel để liên kết bảng khách hàng
			$this->loadModel("Customer", "customers");
			$this->loadModel("Supplier", "suppliers");
			$this->loadModel("Machine", "machines");
			$this->loadModel("Material", "material");
			
			//truy vấn để lấy dữ liệu
			$array_customer = $this->Customer->find("all", array("fields"=>"id, fullname"));
			$array_customer = array(""=>array("id"=>"", "name"=>"...")) + $array_customer;
			
			$array_supplier = $this->Supplier->find("all", array("fields"=>"id, name"));
			$array_supplier = array(""=>array("id"=>"", "name"=>"...")) + $array_supplier;
			
			$array_machine = $this->Machine->find("all", array("fields"=>"id, name"));
			$array_machine = array(""=>array("id"=>"", "name"=>"...")) + $array_machine;
			
			$array_material = $this->Material->find("all", array("fields"=>"id, name"));
			$array_material = array(""=>array("id"=>"", "name"=>"...")) + $array_material;
			
			//nhóm các mảng lại với nhau
			$array_param = array("array_customer"=>$array_customer,
								"array_supplier"=>$array_supplier,
								"array_machine"=>$array_machine,
								"array_material"=>$array_material
								);
			
			$html = $this->View->render("add_quotation.php", $array_param);
			echo $html;
		}
		
		function index()
		{
			$html = $this->View->render("index_quotation.php");
			echo $html;
		}
	}
?>