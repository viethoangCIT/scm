<?php
//*****************************************
	//FUNCTION HEADER
	//*****************************************
	$function_title = "Import Dữ Liệu Chấm Công";
	echo $this->Template->load_function_header($function_title);
	//*****************************************
	//END FUNCTION HEADER
	//*****************************************	

	
	$str_form_customer = "";

	//tạo text box có name = file, id = file
	$str_input_upload = $this->Template->load_textbox(array("name"=>"file","id"=>"file","value"=>"","style"=>"width: 80%")); //"<input typ>"



	//Tạo thanh upload_bar 
	$str_input_upload .=$this->Template->load_upload_bar("upload_button","upload_container","upload_hinhanh1","list_hinhanh1","ketqua_upload1");

	$str_form_customer .= $this->Template->load_form_row(array("title"=>"Upload file","input" =>$str_input_upload));	//<div></div><div></div>

	$str_form_customer .= $this->Template->load_form_row(array("title"=>"","input"=>$this->Template->load_button(array("type"=>"submit"),"Import")));


	$str_form_customer = $this->Template->load_form(array("method"=>"GET","action"=>"/attendance2/import.html"),$str_form_customer);
	
	echo $str_form_customer;
	
	echo $this->Template->load_upload_js("file","upload_button","upload_container","upload_hinhanh1","list_hinhanh1","ketqua_upload1","uploader1",array("Files Cham Cong"=>"dat"));
	

?>

