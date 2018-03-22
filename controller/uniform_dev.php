<?php
class uniform extends Main
{
	function index($id="")
	{
		//tạo đối tượng model tương ứng với table uniform
		$this->loadModel("Uniform");
	// thêm dữ liệu
		//kiểm tra có dữ liệu submit kèm theo không
		if(isset($_POST['data']))
		{

			
			//lấy dữ liệu từ browser sumit lên
			$data = $_POST['data'];
			
			//lưu dữ liệu vào bảng uniform
			$this->Uniform->save($data);

		}

	// sửa
		//truy vấn dữ liệu sản phẩm hiện tại theo id để đưa vào form nhập sản phẩm
		$array_edit_uniform=null;
		if($id !="")
		{

			$array_edit_uniform=$this->Uniform->find("all",array("conditions"=>"id='$id'"));
		}


		//truy vấn dữ liệu từ bảng uniform
		$array_uniform =$this->Uniform->find("all");
		$html_result = $this->View->render("index_uniform.php",array("array_uniform"=>$array_uniform
			,"array_edit_uniform"=>$array_edit_uniform));
		echo $html_result;
	}

	// xóa 
	 function del($id="")
	 {
	 	if ($id != "")
	 	{
	 		// xóa sản phẩm theo id
   		$this->loadModel("Uniform");
    		$this->Uniform->delete($id);

    		// chuyển về trang index

     		$this->redirect("/uniform.html");
		}
	 }


//end_class	


}
?>