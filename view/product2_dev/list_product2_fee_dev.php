<?php
	//BEGIN: FUNCTION HEADER

	$function_title = "Danh Sách Chi Phí Sản Phẩm";
	echo $this->Template->load_function_header($function_title);

	//END: FUNCTION HEADER

	$id_fee = "";
	$name 	= "";
	$money  = "";
	$unit 	= "";

	if($array_edit_fee!=NULL)
	{
		$id_fee = $array_edit_fee[0]['id'];
		$name  	= $array_edit_fee[0]['name'];
		$money  = $array_edit_fee[0]['money'];
		$unit  	= $array_edit_fee[0]['unit'];

	}


	//BEGIN: tạo form nhập chi phi
	//1.1 dùng hàm $this->Template->load_textbox để tạo textbox
	$array_textbox_name = array("name"=>"data[name]","value"=>$name,"style"=>"width:800px;");
	$str_textbox_name = $this->Template->load_textbox($array_textbox_name);
		
	//1.2. tạo dòng nhập tên chi phí có textbox tên chi phí
	$array_row_name = array("title"=>"Tên chi phí","input"=>$str_textbox_name);
	$str_form_content = $this->Template->load_form_row($array_row_name);


	//1.1 dùng hàm $this->Template->load_textbox để tạo textbox
	$array_textbox_money = array("name"=>"data[money]","value"=>$money,"style"=>"width:800px;");
	$str_textbox_money = $this->Template->load_textbox($array_textbox_money);
		
	//1.2. tạo dòng nhập tiêu đề có textbox tiêu đề 
	$array_row_money = array("title"=>"Số tiền","input"=>$str_textbox_money);
	$str_form_content .= $this->Template->load_form_row($array_row_money);


	//1.1 dùng hàm $this->Template->load_textbox để tạo textbox
	$array_textbox_unit = array("name"=>"data[unit]","value"=>$unit,"style"=>"width:800px;");
	$str_textbox_unit = $this->Template->load_textbox($array_textbox_unit);
		
	//1.2. tạo dòng nhập tiêu đề có textbox tiêu đề 
	$array_row_unit = array("title"=>"Đơn vị","input"=>$str_textbox_unit);
	$str_form_content .= $this->Template->load_form_row($array_row_unit);


	//***********************************
	//BEGIN: Tạo input hidden đựng giá trị id
	$array_hidden_id = array("name"=>"data[id]","value"=>$id_fee);
	$str_hidden_id = $this->Template->load_hidden($array_hidden_id);

	$array_hidden_id_product = array("name"=>"data[id_product]","value"=>$id_product);
	$str_hidden_id_product = $this->Template->load_hidden($array_hidden_id_product);

	//END: Tạo input hidden đựng giá trị id
	//***********************************


	//gọi hàm $this->Template->load_button() để tạo string input type = button, nút bấm để lưu
	$str_save_button = $this->Template->load_button(array("value"=>"Lưu","type"=>"submit"),"Lưu");
	$array_row_save = array("title"=>"","input"=>$str_save_button.$str_hidden_id);
	$str_form_content.= $this->Template->load_form_row($array_row_save);

	$str_form_content.= $str_hidden_id_product;

	//end: gọi hàm $this->Template->load_button() để tạo string input type = button, nút bấm để lưu

	//begin: gọi hàm load_form của đối tượng Template để lấy thẻ form
	$array_form = array("method"=>"POST","action"=>"/product2/list_fee");
	$str_form_fee = $this->Template->load_form($array_form, $str_form_content);


	echo $str_form_fee;


	echo "Danh sách chi phí của sản phẩm: ".$title_fee;

	//BEGIN: 1. TABLE HEADER MODULE
	$array_table_fee_header =  NULL;
	$array_table_fee_header["num"] = array("STT",array("style"=>"width:1%;text-align:center"));
	$array_table_fee_header["name"] = array("Tên chi phí", array("style"=>"width:2%;text-align:center"));
	$array_table_fee_header["money"] = array("Số tiền", array("style"=>"width:1%;text-align:center"));
	$array_table_fee_header["unit"]   = array("Đơn vị",array("style"=>"width:2%;text-align:center"));
	$array_table_fee_header["edit"]   = array("Sửa",array("style"=>"width:2%;text-align:center"));	
	$array_table_fee_header["del"]   = array("Xóa",array("style"=>"width:2%;text-align:center"));	
		
	/* gọi hàm $this->Template->load_table_header() tạo thẻ 
		<tr>
			<td thuộc tính>nội dung</td>
			<td thuộc tính>nội dung</td>
			...
		</tr> từ array_table_post_header
		và gán vào chuỗi str_table_post_header
	*/
	$str_table_fee_header = $this->Template->load_table_header($array_table_fee_header);
	
	//END: 1. TABLE HEADE BÀI VIẾT


	//BEGIN: 2.TABLE DANH SÁCH BÀI VIẾT
	$stt = 0;
	$str_table_fee_row = "";

	foreach($array_data as $fee)
	{
		//tạo mảng để chứa dòng thông tin module
		$stt++;
		$array_table_fee_row = null;
		$array_table_fee_row["num"]     = array($stt, array("style"=>"text-align:center"));
		$array_table_fee_row["name"] 	 = array($fee["name"], array("style"=>"text-align:center"));
		$array_table_fee_row["money"] = array($fee["money"], array("style"=>"text-align:center"));
		$array_table_fee_row["unit"]   = array($fee["unit"], array("style"=>"text-align:center"));

		//tạo link sửa đến hàm add của controller module2
		$tmp_id_fee = $fee["id"];
		$tmp_id_product = $fee["id_product"];

		$str_link_edit = $this->Template->load_link("edit","Sửa","/product2/list_fee/$tmp_id_product/$tmp_id_fee.html");

		$array_table_fee_row["edit"] = array($str_link_edit, array("style"=>"text-align:center"));

		//tạo link xóa đến hàm del của controller module2
		$str_link_delete = $this->Template->load_link("del","Xóa","/product2/del_fee/$tmp_id_product/$tmp_id_fee.html");
		$array_table_fee_row["option"] = array($str_link_delete,array("style"=>"text-align:center"));

		//gọi hàm $this->Template->load_table_row để tạo cặp thẻ <tr><td></td></tr> từ mảng $array_table_test_row
		$str_table_fee_row .=  $this->Template->load_table_row($array_table_fee_row);
	}//end : foreach($array_post as $post)

		//BEGIN: 3.TẠO TABLE

		/* gọi hàm $this->Template->load_table() tạo <table>nội dung là giá trị của biến str_table_test_header</table> 
			và gán vào chuỗi str_table_test
		*/
		$str_table_product =  $this->Template->load_table($str_table_fee_header.$str_table_fee_row,array("align"=>"center","id"=>"table_product"));
		echo $str_table_product;

		//END: 3.TẠO TABLE	


?>