<?php
	//tạo tiêu đề hàm
	$function_title = "Lịch Bảo Trì Máy";
	echo $this->Template->load_function_header($function_title);

	//tạo cái mảng $str_form_machine khi chúng ta không thực hiện việc gì hết thì nó sẽ là 1 cái form bình thường
	$str_form_machine = "";

	//khởi tạo các biến đều bằng rông vì nếu như khi chúng ta sửa chi cả thì các ô sẽ không có giá trị gì cả
	$id = "";
	$day = "";
	$cycle = "";
	$content = "";

	//kiểm tra cái mảng $array_edit_machine có khác NULL hay không nếu như khác NULL thì đi vào câu điều kiện if và thực hiện công việc tiếp theo
	if($array_edit_machine != NULL)
	{
		//tạo cái mảng $array_edit_machine có phần tử thứ 0 và giá trị là id
		$id = $array_edit_machine[0]["id"];
		$day = $array_edit_machine[0]["day"];
		$cycle = $array_edit_machine[0]["cycle"];
		$content = $array_edit_machine[0]["content"];
	}

	//tạo textbox
	$str_input_machine_id = $this->Template->load_hidden(array("name"=>"data[id]","id"=>"id","value"=>"$id","style"=>"width:300px"));	
	
	$str_hidden_id_machine = $this->Template->load_hidden(array("name"=>"data[id_machine]","value"=>$id_machine));	
	
	$str_input_machine_day = $this->Template->load_textbox(array("name"=>"data[day]","id"=>"day","value"=>$day,"style"=>"width:200px"));
	
	$str_input_machine_cycle = $this->Template->load_textbox(array("name"=>"data[cycle]","id"=>"cycle","value"=>$cycle,"style"=>"width:200px"));	

	$str_input_machine_content = $this->Template->load_textarea(array("name"=>"data[content]","id"=>"content","value"=>"","style"=>"width:200px; height:100px;"),$content);
	
	
	//tạo dòng textbox
	$str_form_machine = $this->Template->load_form_row(array("title"=>"Tên máy ","input"=>$str_machine_name.$str_input_machine_id . $str_hidden_id_machine));

	$str_form_machine .= $this->Template->load_form_row(array("title"=>"Ngày bảo trì","input"=>$str_input_machine_day));
		
	$str_form_machine .= $this->Template->load_form_row(array("title"=>"Chu kỳ","input"=>$str_input_machine_cycle));
		
	$str_form_machine .= $this->Template->load_form_row(array("title"=>"Nội dung dự kiến","input"=>$str_input_machine_content));

	//tạo nút lưu	
	$str_save_button =  $this->Template->load_button(array("type"=>"submit"),"Lưu");
	$str_form_machine .= $this->Template->load_form_row(array("title"=>"","input"=>$str_save_button));

	//đưa vào form
	$str_form_machine = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"/machine/maintenance?debug=code"),$str_form_machine);
	echo $str_form_machine;


	//1: tao mang table header 	
	$array_header_machine["col1"] = array("STT",array("style"=>"text-align:center; width:3%"));  
	$array_header_machine["col2"] = array("Tên máy ",array("style"=>"text-align:center; width:8%"));
	$array_header_machine["col3"] = array("Chu kỳ ",array("style"=>"text-align:center; width:8%"));
	$array_header_machine["col4"] = array("Ngày bảo trì ",array("style"=>"text-align:center; width:8%"));
	$array_header_machine["col5"] = array("Nội dung bảo trì ",array("style"=>"text-align:center; width:8%"));
	$array_header_machine["col6"] = array("Sửa ",array("style"=>"text-align:center; width:8%"));
	$array_header_machine["col7"] = array("Xóa",array("style"=>"text-align:center; width:8%"));

	//2: lấy dòng tr header
	$str_header_machine = $this->Template->load_table_header($array_header_machine);


	//khởi tạo biến id bằng 0 tức là id của bảng machines_maintenance lúc này bằng 0
	$id = 0;

	//khởi tạo biến str_row_machine rỗng 
	$str_row_machine = "";

	//kiểm tra mảng$array_machine_main khác null hay không
	if($array_machine_main!=NULL)
	{

		//dùng vòng lặp foreach để lặp số dòng theo cột trong csdl
		foreach($array_machine_main as $machine)
		{
			//tăng id lên 1
			$id++;
	
			//tảo mảng chứa giá trị của phần tử id
			$id = $machine["id"];
			$id_machine = $machine["id_machine"];
			//tạo link sửa theo id
			$link_sua = "/machine/maintenance/$id_machine/$id.html";
	
			//tạo link xóa theo id
			$link_xoa = "/machine/del_main/$id_machine/$id.html";
	
			//gọi hàm load_link của đối tượng Template để tạo link sửa
			$link_sua = $this->Template->load_link("edit","Sửa",$link_sua);
	
			//gọi hàm load_link của đối tượng Template để tạo link xóa
			$link_xoa = $this->Template->load_link("del","Xóa",$link_xoa);
	
			//tạo biến nhóm 2 link sửa và xóa
			$link_action = $link_sua.$link_xoa;
	
			//tạo mảng để chứa dòng theo cột
			$array_row_machine["col1"] =  array($id,array("style"=>"text-align:center; width:3%"));
			$array_row_machine["col2"] =  array($machine["machine_name"],array("style"=>"text-align:center; width:3%"));
			$array_row_machine["col3"] =  array($machine["cycle"],array("style"=>"text-align:center; width:3%"));
			$array_row_machine["col4"] =  array($machine["day"],array("style"=>"text-align:center; width:3%"));
			$array_row_machine["col5"] =  array($machine["content"],array("style"=>"text-align:center; width:3%"));
			$array_row_machine["col6"] =  array($link_sua,array("style"=>"text-align:center; width:3%"));
			$array_row_machine["col7"] =  array($link_xoa,array("style"=>"text-align:center; width:3%"));
			
			//gọi hàm load_table_row của đối tượng Template để tạo thẻ tr td
			$str_row_machine .= $this->Template->load_table_row($array_row_machine);
	
		}
	}
	//Đưa nội dung str_allowance vào thẻ table
	$str_machine =  $this->Template->load_table($str_header_machine.$str_row_machine);

	echo $str_machine;	
?>

<script>
	$( "#day" ).datepicker({dateFormat: "dd-mm-yy"});
	$( "#cycle" ).datepicker({dateFormat: "dd-mm-yy"});
</script>