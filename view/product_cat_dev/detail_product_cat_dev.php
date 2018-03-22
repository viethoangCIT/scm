<?php

		//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tạo tiêu đề hàm
	$function_title = "Chi tiết dòng sản phẩm ".$product_cat_name;
	echo $this->Template->load_function_header($function_title);

	$str_form_product_cat = "";
	//tạo textbox nhập tên tài sản
	
	$id= "";
	$name = "";
	$code = "";
	if($array_edit_detail_product_cat)
	{
		$id = $array_edit_detail_product_cat[0]["id"];
		$name = $array_edit_detail_product_cat[0]["name"];
		$code = $array_edit_detail_product_cat[0]["code"];
	}

	//BEGIN: Tạo input
	$str_input_product_cat_id = $this->Template->load_hidden(array("name"=>"data[id]","id"=>"id_product_cat","value"=>$id,"style"=>"width:300px"));
	$str_input_product_cat_name = $this->Template->load_textbox(array("name"=>"data[name]","id"=>"name","value"=>$name,"style"=>"width:300px"))."<span id='mate_name1'></span>";
	$str_input_product_cat_code = $this->Template->load_textbox(array("name"=>"data[code]","id"=>"code","value"=>$code,"style"=>"width:300px"))."<span id='mate_code1'></span>";
	$str_save_button =  $this->Template->load_button(array("type"=>"button","onclick"=>"save()"),"Lưu");
	//END: Tạo input
	
	//BEGIN: Tạo dòng nhập
	$str_form_product_cat .= $this->Template->load_form_row(array("title"=>"Tên thuộc tính(<span style='color:red'>*</span>)","input"=>$str_input_product_cat_name));
	$str_form_product_cat .= $this->Template->load_form_row(array("title"=>"Mã thuộc tính(<span style='color:red'>*</span>)","input"=>$str_input_product_cat_code));
	$str_form_product_cat .= $this->Template->load_form_row(array("title"=>"","input"=>$str_save_button));
	//END: Tạo dòng nhập
	
	//LOAD FORM
	$str_form_product_cat = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"
		/product_cat/detail/$id_product_cat"),$str_form_product_cat.$str_input_product_cat_id);
	echo $str_form_product_cat;
	
	/*
	$str_input_product_cat_name = $this->Template->load_textbox(array("name"=>"tensp","autocomplete"=>"off","value"=>"$tensp","id"=>"attendance_day", "placeholder"=>"Nhập tên sản phẩm"));

	$str_input_product_cat_code = $this->Template->load_textbox(array("name"=>"masp","autocomplete"=>"off","value"=>"$masp","id"=>"attendance_day", "placeholder"=>"Nhập mã sản phẩm"));
	// mã sản phẩm
    
 	$str_btn_timkiem = "<input type='submit' class='timkiem' value='Tìm kiếm' style='font-size: 13.4px'>";
    $str_input_attendance_day ="<div id = 'search_bar'> Mã sản phẩm  $str_input_product_cat_code  &nbsp;&nbsp; Tên sản phẩm $str_input_product_cat_name &nbsp; $str_btn_timkiem </br/> </div>";

	$array_form = array("method"=>"GET","action"=>"/product_cat/index");
	$str_form_product_cat = $this->Template->load_form($array_form, $str_input_attendance_day);


	echo $str_form_product_cat;
	*/

	//1: tao mang table header 	
	$array_header_product_cat["col1"] = array("STT",array("style"=>"text-align:left; width:3%"));
	$array_header_product_cat["col2"] = array("Tên thuộc tính",array("style"=>"text-align:left; width:8%"));
	$array_header_product_cat["col3"] = array("Mã Thuộc tính",array("style"=>"text-align:left; width:8%"));
	$array_header_product_cat["col4"] = array("Chức năng",array("style"=>"text-align:left; width:8%"));

		//2: lấy dòng tr header
	$str_product_cat = $this->Template->load_table_header($array_header_product_cat);

	//lấy dòng nội dung table
	$stt=0;
	if($array_product_cat)
	{
		foreach ($array_product_cat as $product_cat ) {
			$stt++;
			$id_product_cat_detail = $product_cat['id'];
			$link_sua="/product_cat/detail/$id_product_cat/$id_product_cat_detail.html";
			$link_xoa="/product_cat/del_detail/$id_product_cat/$id_product_cat_detail.html";
			$link_sua  = $this->Template->load_link("edit","Sửa",$link_sua);
			$link_xoa  = $this->Template->load_link("del","Xóa",$link_xoa);
			$link_action = $link_sua.$link_xoa;
	
	
		$array_product_cats["col1"] = array($stt,array("style"=>"text-align:left; width:3%"));
		$array_product_cats["col2"] = array($product_cat["name"],array("style"=>"text-align:left; width:8%"));
		$array_product_cats["col3"] = array($product_cat["code"],array("style"=>"text-align:left; width:8%"));
		$array_product_cats["col4"] = array($link_action,array("style"=>"text-align:left; width:8%"));
		
		$str_product_cat .= $this->Template->load_table_row($array_product_cats);
		
		}
	}
	//Đưa nội dung str_product_cat vào thẻ table
	$str_product_cat =  $this->Template->load_table($str_product_cat);
	echo $str_product_cat;

?>

<script>
	function save()
	{
		var name = document.getElementById('name').value;
		var code = document.getElementById('code').value;
		if(name =="")
		{
			alert('Xin nhập thuộc tính');
			document.getElementById('name').focus();
			return;
		}
		if(code =="")
		{
			alert('Xin nhập mã thuộc tính');
			document.getElementById('code').focus();
			return;
		}
		else
			document.getElementById('form_nhap').submit();
	}
</script>