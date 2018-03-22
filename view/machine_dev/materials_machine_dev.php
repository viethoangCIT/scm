<?php
	//tạo tiêu đề hàm
	$function_title = "Nhập Vật Tư";
	echo $this->Template->load_function_header($function_title);

	$str_form_machine = "";

	//khởi tạo các biến có giá trị bằng rỗng
	$id= "";
	$name = "";
	$code = "";
	$unit = "";
	$num = "";

	//kiểm tra mảng có khác null hay không
	if($array_edit_machine!=NULL)
	{
		$id = $array_edit_machine[0]["id"];
		$name = $array_edit_machine[0]["name"];
		$code = $array_edit_machine[0]["code"];
		$unit = $array_edit_machine[0]["unit"];
		$num = $array_edit_machine[0]["num"];
	}

	//tạo textbox số lượng
	$str_input_machine_name = $this->Template->load_textbox(array("name"=>"data[name]","id"=>"code","value"=>$name,"style"=>"width:300px"));	
	$str_form_machine = $this->Template->load_form_row(array("title"=>"Tên vật tư","input"=>$str_input_machine_name));

	//tạo textbox số lượng
	$str_input_machine_code = $this->Template->load_textbox(array("name"=>"data[code]","id"=>"code","value"=>$code,"style"=>"width:300px"));	
	$str_form_machine .= $this->Template->load_form_row(array("title"=>"Mã vật tư","input"=>$str_input_machine_code));

	//tạo textbox số lượng
	$str_input_machine_unit = $this->Template->load_textbox(array("name"=>"data[unit]","id"=>"code","value"=>$unit,"style"=>"width:300px"));	
	$str_form_machine .= $this->Template->load_form_row(array("title"=>"Đơn vị","input"=>$str_input_machine_unit));

	//tạo textbox số lượng
	$str_input_machine_num = $this->Template->load_textbox(array("name"=>"data[num]","id"=>"code","value"=>$num,"style"=>"width:300px"));	
	$str_form_machine .= $this->Template->load_form_row(array("title"=>"Số lượng","input"=>$str_input_machine_num));

	$str_input_hidden = $this->Template->load_hidden(array("name"=>"data[id]","id"=>"id","value"=>$id,"style"=>"width:300px"));

	//tạo nút lưu	
	$str_save_button =  $this->Template->load_button(array("type"=>"submit"),"Lưu");
	$str_form_machine .= $this->Template->load_form_row(array("title"=>"","input"=>$str_save_button.$str_input_hidden));
	
	//đưa vào form
	$str_form_machine = $this->Template->load_form(array("method"=>"GET","id"=>"form_nhap","action"=>"/machine/materials?debug=code"),$str_form_machine);
	echo $str_form_machine;


	$function_title = "Danh Sách Vật Tư";
	echo $this->Template->load_function_header($function_title);

	//*****************************************
	//END FUNCTION HEADER
	//*****************************************


	//1: tao mang table header 	
	$array_header_machine =  array("Stt"=>array("Stt",array("style"=>"text-align:center; width:3%")),
								"ten"=>array("Tên vật tư ",array("style"=>"text-align:center; width:8%")),
								"ma"=>array("Mã vật tư",array("style"=>"text-align:center; width:8%;white-space: nowrap")),						
								"dv"=>array("Đơn vị",array("style"=>"text-align:center; width:8%;white-space: nowrap")),
								"sl"=>array("Số lượng",array("style"=>"text-align:center; width:8%;white-space: nowrap")),
								"chucnang"=>array("Chức năng",array("style"=>"text-align:center; width:8%"))
							);

	//2: lấy dòng tr header
	$str_header_machine = $this->Template->load_table_header($array_header_machine);

	//khởi tạo biến id bằng 0 tức là id của bảng machines_maintenance lúc này bằng 0
$id = 0;

	//khởi tạo biến str_row_machine rỗng 
$str_row_machine = "";

	//kiểm tra mảng$array_machine_main khác null hay không
if($array_machine!=NULL)
{

	//dùng vòng lặp foreach để lặp số dòng theo cột trong csdl
	foreach($array_machine as $machine)
	{
		//tăng id lên 1
		$id++;

		//tảo mảng chứa giá trị của phần tử id
		$id_machine = $machine["id"];

		//tạo link sửa theo id
		$link_sua = "/machine/materials/$id_machine.html";

		//tạo link xóa theo id
		$link_xoa = "/machine/del_materials/$id_machine.html";

		//gọi hàm load_link của đối tượng Template để tạo link sửa
		$link_sua = $this->Template->load_link("edit","Sửa",$link_sua);

		//gọi hàm load_link của đối tượng Template để tạo link xóa
		$link_xoa = $this->Template->load_link("del","Xóa",$link_xoa);

		//tạo biến nhóm 2 link sửa và xóa
		$link_action = $link_sua.$link_xoa;

		//tạo mảng để chứa dòng theo cột
		$array_row_machine = array("Stt"=>array($id,"style"=>"text-align:center; width:3%"),
			"ten"=>array($machine["name"],"style"=>"text-align:center; width:8%"),
			"ma"=>array($machine["code"],"style"=>"text-align:center; width:8%"),
			"dv"=>array($machine["unit"],"style"=>"text-align:center; width:8%"),
			"sl"=>array($machine["num"],"style"=>"text-align:center; width:8%"),
			"chucnang"=>array($link_action,"style"=>"text-align:center; width:8%")
		);
		
		//gọi hàm load_table_row của đối tượng Template để tạo thẻ tr td
		$str_row_machine .= $this->Template->load_table_row($array_row_machine);

	}
}
	//Đưa nội dung str_allowance vào thẻ table
	$str_machine =  $this->Template->load_table($str_header_machine.$str_row_machine);
	echo $str_machine;	
?>