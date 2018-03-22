<?php

	//BEGIN: FUNCTION HEADER

	$function_title = "Nhân sự sản xuất sản phẩm <br>".$product_name;
	echo $this->Template->load_function_header($function_title);
	
	//BEGIN: Lấy thông tin để sửa
	$id = "";
	$id_user = "";
	$id_work = "";
	if($array_edit)
	{
		$id=$array_edit[0]["id"];
		$id_user=$array_edit[0]["id_user"];
		$id_work=$array_edit[0]["id_work"];
	}
	
	//BEGIN: LOAD INPUT
	$str_hidden_id = $this->Template->load_hidden(array("name"=>"data[id]","value"=>$id,"style"=>"width:300px;"));
	$str_selectbox_job = $this->Template->load_selectbox(array("name"=>"data[id_work]","style"=>"width:300px;"),$array_job,$id_work);
	$str_selectbox_user = $this->Template->load_selectbox(array("name"=>"data[id_user]","style"=>"width:300px;"),$array_user, $id_user);
	$str_save_button =  $this->Template->load_button(array("type"=>"submit"),"Lưu");
	//END: LOAD INPUT

	
	//BEGIN: LOAD HEADER 	
	$str_product_header = "";
	$array_header_product =  null;
	$array_header_product["col1"]=array("STT",array("style"=>"text-align:left; width:3%"));
	$array_header_product["col2"]=array("Công việc",array("style"=>"text-align:left; width:8%"));
	$array_header_product["col3"]=array("Nhân viên",array("style"=>"text-align:left; width:8%"));
	$array_header_product["col4"]=array("Chức năng",array("style"=>"text-align:left; width:8%"));
	
	$str_product_header = $this->Template->load_table_header($array_header_product);
	//END: LOAD HEADER
	
	
	
	//BEGIN: LOAD DONG NHAP
	$str_product_row_input = "";
	$array_product_input =  null;
	$array_product_input["col1"]=array("",array("style"=>"text-align:left; width:3%"));
	$array_product_input["col2"]=array($str_selectbox_job,array("style"=>"text-align:left; width:8%"));
	$array_product_input["col3"]=array($str_selectbox_user,array(""));
	$array_product_input["col4"]=array($str_save_button,array("style"=>"text-align:left; width:8%"));
	
	$str_product_row_input .= $this->Template->load_table_row($array_product_input);
	//BEGIN: LOAD ROW
	
	//BEGIN: LOAD FORM
	
	
	$str_product_row = "";
	
	$str_product_row = "";
	if($array_product_user){
		$stt=0;
		foreach ($array_product_user as $product_user) {
			$stt++;
			$id_product_user = $product_user['id'];
			$link_sua="/product2/product_user/$id_product/$id_product_user.html?act=edit";
			$link_xoa="/product2/product_user/$id_product/$id_product_user.html?act=del";
			$link_sua  = $this->Template->load_link("edit","Sửa",$link_sua);
			$link_xoa  = $this->Template->load_link("del","Xóa",$link_xoa);
			$link_action = $link_sua . $link_xoa;

		//BEGIN: LOAD thông tin bảng product_machine
		
		//END:LOAD thông tin bảng product_machine
		
		$array_product_user =  null;
		$array_product_user["col1"]=array($stt,array("style"=>"text-align:left; width:3%"));
		$array_product_user["col2"]=array($product_user["work_name"],array("style"=>"text-align:left; width:8%"));
		$array_product_user["col3"]=array($product_user["user_fullname"],array("style"=>"text-align:left; width:8%"));
		$array_product_user["col4"]=array($link_action,array("style"=>"text-align:left; width:8%"));
		$str_product_row .= $this->Template->load_table_row($array_product_user);

		}//END: foreach ($array_product_rate as $product ) {
	}//END: if($array_product_rate){
	else
	{	
		$array_product_user =  null;
		$array_product_user["col1"]=array("Không có dữ liệu",array("style"=>"text-align:center;","colspan"=>"4"));
		$str_product_row .= $this->Template->load_table_row($array_product_user);
	}
	//END: LOAD ROW
	
$str_load_table =  $this->Template->load_table($str_product_header.$str_product_row_input.$str_product_row);
	
//LOAD FORM
$str_form = $this->Template->load_form(array("method" => "POST", "action" => "/product2/product_user/$id_product"), $str_load_table.$str_hidden_id);
echo $str_form;		

?>