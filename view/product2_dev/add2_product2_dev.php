<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#tabs" ).tabs();
  } );
</script>

<!--===================================================================================================-->
<!-- BEGIN: TAB PRODUCT-->
<?php 																			
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
		//tạo tiêu đề hàm
		$function_title = "Nhập sản phẩm ".$id_edit_product;
		echo $this->Template->load_function_header($function_title);

		$str_form_product = "";
		//tạo textbox nhập tên tài sản

		$code = "";
		$name = "";
		$barcode = "";
		$id_customer = "";
		$id_line ="";
		$shop = "";
		$price = "";
		$outsourcing = "";
		$cycletime = "";
		$num = "";
		$amount = "";
		$id = "";
		$id_factory = "";
		$id_manufactory = "";
		if($array_edit_product != null)
		{
			$code = $array_edit_product["0"]["code"];
			$name = $array_edit_product["0"]["name"];
			$barcode = $array_edit_product["0"]["barcode"];
			$id_customer = $array_edit_product["0"]["id_customer"];
			$id_line = $array_edit_product["0"]["id_cat"];
			$shop = $array_edit_product["0"]["shop"];
			$price = $array_edit_product["0"]["price"];
			$outsourcing = $array_edit_product["0"]["outsourcing"];
			$cycletime = $array_edit_product["0"]["cycletime"];
			$num = $array_edit_product["0"]["num"];
			$amount = $array_edit_product["0"]["amount"];
			$id = $array_edit_product["0"]["id"];
			$id_factory = $array_edit_product[0]["id_factory"];
			$id_manufactory = $array_edit_product[0]["id_manufactory"];
		}
		
		if(isset($_GET["id_line"]) && $_GET["id_line"] != "") $id_line = $_GET["id_line"];
		if(isset($_GET["id_factory"]) && $_GET["id_factory"] != "") $id_factory = $_GET["id_factory"];
		if(isset($_GET["id_manufactory"]) && $_GET["id_manufactory"] != "") $id_manufactory = $_GET["id_manufactory"];

		//BEGIN: Tạo input chọn nhập
		$str_input_product_id = $this->Template->load_hidden(array("name"=>"data[id]","id"=>"id_product","value"=>"$id","style"=>"width:300px"));
		$str_input_product_line = $this->Template->load_selectbox(array("name"=>"id_line","style"=>"width:300px","id"=>"id_line", "onchange"=>"show()"),$array_line,$id_line);
		$str_input_factory = $this->Template->load_selectbox(array("name"=>"id_factory","style"=>"width:300px","id"=>"factory"),$array_factory,$id_factory);
		$str_input_manufactory = $this->Template->load_selectbox(array("name"=>"id_manufactory","style"=>"width:300px","id"=>"manufactory"),$array_manufactory,$id_manufactory);
		$str_input_product_customer = $this->Template->load_selectbox(array("name"=>"data[id_customer]","id"=>"customer","style"=>"width:300px"),$array_customer,$id_customer)."<span id='mate_customer1'></span>";
		$str_input_product_code = $this->Template->load_textbox(array("name"=>"data[code]","id"=>"code","value"=>"$code","style"=>"width:300px"))."<span id='mate_code1'></span>";
		$str_input_product_name = $this->Template->load_textbox(array("name"=>"data[name]","id"=>"name","value"=>"$name","style"=>"width:300px"))."<span id='mate_name1'></span>";
		$str_input_product_barcode = $this->Template->load_textbox(array("name"=>"data[barcode]","id"=>"barcode","value"=>"$code","style"=>"width:300px"))."<span id='mate_barcode1'></span>";
		$str_hidden_status = $this->Template->load_hidden(array("name"=>"data[status]","id"=>"status","value"=>"0","style"=>"width:300px"))."<span id='mate_price1'></span>";
		$str_save_button =  $this->Template->load_button(array("type"=>"button","onclick"=>"luu()"),"Lưu");
		//BEGIN: Tạo input chọn nhập
		
		
		//BEGIN: Tạo dòng nhập 
		$str_form_product .= $this->Template->load_form_row(array("title"=>"Nhà máy(<span style='color:red'>*</span>)","input"=>$str_input_factory));
		$str_form_product .= $this->Template->load_form_row(array("title"=>"Xưởng(<span style='color:red'>*</span>)","input"=>$str_input_manufactory));
		$str_form_product .= $this->Template->load_form_row(array("title"=>"Dòng sản phẩm(<span style='color:red'>*</span>)","input"=>$str_input_product_line));
		$str_form_product .= $this->Template->load_form_row(array("title"=>"Mã vạch(<span style='color:red'>*</span>)","input"=>$str_input_product_barcode.$str_input_product_id));
		$str_form_product .= $this->Template->load_form_row(array("title"=>"Mã sản phẩm(<span style='color:red'>*</span>)","input"=>$str_input_product_code.$str_input_product_id));
		$str_form_product .= $this->Template->load_form_row(array("title"=>"Tên sản phẩm(<span style='color:red'>*</span>)","input"=>$str_input_product_name));
		$str_form_product .= $this->Template->load_form_row(array("title"=>"Khách hàng(<span style='color:red'>*</span>)","input"=>$str_input_product_customer));
		//END: Tạo dòng nhập
		
		//BEGIN: LOAD thuộc tính của dòng sản phẩm khi chọn sản phẩm
		$str_table_tr = "";
		$stt = 0;
		if($array_product_cat_detail)
		{
			foreach($array_product_cat_detail as $detail)
			{
				
				$name = $detail["name"];
				$code = $detail["code"];
				
				$edit_detail = "";
				$str_hidden_id_detail="";
				if($id_edit_product !="")
				{
					$id = $detail["id"];
					$edit_detail = $detail["value"];
					
					$str_hidden_id_detail = $this->Template->load_hidden(array("name"=>"data_detail[$stt][id]","value"=>$id,"style"=>"width:300px"));
				}
				
				$str_input_product_detail = $this->Template->load_textbox(array("name"=>"data_detail[$code]","value"=>$edit_detail,"style"=>"width:300px"));
				$str_form_product .= $this->Template->load_form_row(array("title"=>"$name","input"=>$str_input_product_detail.$str_hidden_id_detail, "class"=>"detail"));
				$stt++;
			}
		}
		
		$str_form_product .= $this->Template->load_form_row(array("title"=>"","input"=>$str_save_button));
		//BEGIN: LOAD thuộc tính của dòng sản phẩm khi chọn sản phẩm
		
		//LOAD FORM
		$str_form_product = $this->Template->load_form(array("method"=>"GET","id"=>"form_nhap","action"=>"/product2/add/$id"),$str_form_product.$str_hidden_status); 																											
?>
<!-- END: TAB PRODUCT-->
<!--===================================================================================================-->


<!--===================================================================================================-->
<!-- BEGIN: TAB CYCLETIME-->
<?php 

	//BEGIN: LẤY DỮ LIỆU ĐỂ SỬA
	$id_product_machine = "";
	$id_machine = "";
	$cavity = "";
	$cycletime = "";
	$desc_product_machine = "";
	
	if($array_edit_product_machine)
	{
		$id_product_machine = $array_edit_product_machine[0]["id"];
		$id_machine = $array_edit_product_machine[0]["id_machine"];
		$cavity = $array_edit_product_machine[0]["cavity"];
		$cycletime = $array_edit_product_machine[0]["cycletime"];
		$desc_product_machine = $array_edit_product_machine[0]["desc"];	
	}
	//END: LẤY DỮ LIỆU ĐỂ SỬA

	$str_cycletime_header = "";
	//BEGIN: LOAD HEADER 	
	$array_header_cycletime =  null;
	$array_header_cycletime["col1"]=array("STT",array("style"=>"text-align:center; width:3%"));
	$array_header_cycletime["col2"]=array("Máy",array("style"=>"text-align:center; width:8%"));
	$array_header_cycletime["col3"]=array("Cavity",array("style"=>"text-align:center; width:8%"));
	$array_header_cycletime["col4"]=array("Cycletime",array("style"=>"text-align:center; width:8%"));
	$array_header_cycletime["col5"]=array("Ghi chú",array("style"=>"text-align:center; width:8%"));
	$array_header_cycletime["col6"]=array("Chức năng",array("style"=>"text-align:center; width:8%"));
	
	$str_cycletime_header = $this->Template->load_table_header($array_header_cycletime);
	//END: LOAD HEADER
	
	//BEGIN: LOAD INPUT
	$str_hidden_id = $this->Template->load_hidden(array("name"=>"data2[id]","value"=>$id_product_machine));
	$str_selectbox_cycletime_machine = $this->Template->load_selectbox(array("name"=>"data2[id_machine]","style"=>"width:200px;"),$array_machine,$id_machine);
	$str_input_cycletime = $this->Template->load_textbox(array("name"=>"data2[cycletime]","value"=>$cycletime,"style"=>"width:100px;"));
	$str_input_cycletime_cavity = $this->Template->load_textbox(array("name"=>"data2[cavity]","value"=>$cavity,"style"=>"width:100px;"));
	$str_input_cycletime_desc = $this->Template->load_textbox(array("name"=>"data2[desc]","value"=>$desc_product_machine,"style"=>"width:150px;"));
	$str_save_button_cycletime =  $this->Template->load_button(array("type"=>"summit"),"Lưu");
	//$str_save_button_cycletime =  $this->Template->load_button(array("type"=>"button","onclick"=>"luu_cycle()"),"Lưu");
	//END: LOAD INPUT
	
	//BEGIN: LOAD DONG NHAP
	$str_cycletime_row_input = "";
	$array_cycletime_input =  null;
	$array_cycletime_input["col1"]=array($str_hidden_id);
	$array_cycletime_input["col2"]=array($str_selectbox_cycletime_machine,array("style"=>"text-align:center;"));
	$array_cycletime_input["col3"]=array($str_input_cycletime_cavity,array("style"=>"text-align:center;"));
	$array_cycletime_input["col4"]=array($str_input_cycletime,array("style"=>"text-align:center;"));
	$array_cycletime_input["col5"]=array($str_input_cycletime_desc,array("style"=>"text-align:center;"));
	$array_cycletime_input["col6"]=array($str_save_button_cycletime,array("style"=>"text-align:center;"));
	
	$str_cycletime_row_input .= $this->Template->load_table_row($array_cycletime_input);
	
	//BEGIN: LOAD ROW
	$str_product_machine_row = "";
	if($array_product_machine){
		$stt=0;
		foreach ($array_product_machine as $product_machine) {
			$stt++;
			$id_product_machine = $product_machine['id'];
			$link_sua="/product2/add/$id/$id_product_machine?act=edit_cycle#tabs-2";
			$link_xoa="/product2/add/$id/$id_product_machine?act=del_cycle#tabs-2";
			$link_sua  = $this->Template->load_link("edit","Sửa",$link_sua);
			$link_xoa  = $this->Template->load_link("del","Xóa",$link_xoa);
			$link_action = $link_sua . $link_xoa;

		//BEGIN: LOAD thông tin bảng product_machine
		
		//END:LOAD thông tin bảng product_machine
		
		$array_product_machine_row =  null;
		$array_product_machine_row["col1"]=array($stt,array("style"=>"text-align:center; width:3%"));
		$array_product_machine_row["col2"]=array($product_machine["machine_control"],array("style"=>"text-align:center; width:8%"));
		$array_product_machine_row["col3"]=array($product_machine["cavity"],array("style"=>"text-align:center; width:8%"));
		$array_product_machine_row["col4"]=array($product_machine["cycletime"],array("style"=>"text-align:center; width:8%"));
		$array_product_machine_row["col5"]=array($product_machine["desc"],array("style"=>"text-align:center; width:8%"));
		$array_product_machine_row["col6"]=array($link_action,array("style"=>"text-align:center;"));
		$str_product_machine_row .= $this->Template->load_table_row($array_product_machine_row);

		}//END: foreach ($array_product_rate as $product ) {
	}//END: if($array_product_rate){
	else
	{	
		$array_product_machine_row =  null;
		$array_product_machine_row["col1"]=array("Không có dữ liệu",array("style"=>"text-align:center;","colspan"=>"5"));
		$str_product_machine_row .= $this->Template->load_table_row($array_product_machine_row);
	}
	//END: LOAD ROW
	
	$str_table_cycletime =  $this->Template->load_table($str_cycletime_header.$str_cycletime_row_input.$str_product_machine_row);
	$str_form_cycletime = $this->Template->load_form(array("method" => "POST","id"=>"form_nhap_cycle", "action" => "/product2/add/$id"), $str_table_cycletime);
	//echo $this->Template->load_function_body($str_form_cycletime);
?>
<!-- END: TAB CYCLETIME-->
<!--===================================================================================================-->

<!--===================================================================================================-->
<!-- BEGIN: TAB ĐỊNH MỨC-->
<?php 

	//BEGIN: LẤY DỮ LIỆU ĐỂ SỬA TAB ĐỊNH MỨC VẬT TƯ
	$id_product_rate = "";
	$id_material = "";
	$desc_product_rate = "";
	$quota = "";
	if($array_edit_product_rate)
	{
		$id_product_rate = $array_edit_product_rate[0]["id"];
		$id_material = $array_edit_product_rate[0]["id_material"];
		$desc_product_rate = $array_edit_product_rate[0]["desc"];
		$quota = $array_edit_product_rate[0]["quota"];
	}
	//END: LẤY DỮ LIỆU ĐỂ SỬA TAB ĐỊNH MỨC VẬT TƯ
	
	
	$str_rate_header = "";
	//BEGIN: LOAD HEADER 	
	$array_header_rate =  null;
	$array_header_rate["col1"]=array("STT",array("style"=>"text-align:center; width:3%"));
	$array_header_rate["col2"]=array("Mã vạch",array("style"=>"text-align:center; width:8%"));
	$array_header_rate["col3"]=array("Mã",array("style"=>"text-align:center; width:8%"));
	$array_header_rate["col4"]=array("Tên",array("style"=>"text-align:center; width:8%"));
	$array_header_rate["col5"]=array("Đơn vị tính",array("style"=>"text-align:center; width:8%"));
	$array_header_rate["col6"]=array("Định mức",array("style"=>"text-align:center; width:8%"));
	$array_header_rate["col7"]=array("Ghi chú",array("style"=>"text-align:center; width:8%"));
	$array_header_rate["col8"]=array("Chức năng",array("style"=>"text-align:center; width:9%"));
	
	$str_rate_header = $this->Template->load_table_header($array_header_rate);
	//END: LOAD HEADER
	
	//BEGIN: LOAD INPUT
	$str_rate_hidden_id = $this->Template->load_hidden(array("name"=>"data_rate[id]","value"=>$id_product_rate));
	$str_rate_select_material = $this->Template->load_selectbox(array("name"=>"data_rate[id_material]","style"=>"width:100px;"),$array_material,$id_material);
	$str_rate_input_dinhmuc = $this->Template->load_textbox(array("name"=>"data_rate[quota]","value"=>"","style"=>"width:100px;"));
	$str_rate_input_desc = $this->Template->load_textbox(array("name"=>"data_rate[desc]","value"=>$desc_product_rate,"style"=>"width:100px;"));
	$str_rate_save_button =  $this->Template->load_button(array("type"=>"submit"),"Lưu");
	//END: LOAD INPUT
	
	//BEGIN: LOAD DONG NHAP
	$str_rate_row_input = "";
	$array_rate_input =  null;
	$array_rate_input["col1"]=array($str_rate_hidden_id);
	$array_rate_input["col2"]=array("",array("style"=>"text-align:center;"));
	$array_rate_input["col3"]=array("",array("style"=>"text-align:center;"));
	$array_rate_input["col4"]=array($str_rate_select_material,array("style"=>"text-align:center;"));
	$array_rate_input["col5"]=array("",array("style"=>"text-align:center;"));
	$array_rate_input["col6"]=array("",array("style"=>"text-align:center;"));
	$array_rate_input["col7"]=array($str_rate_input_desc,array("style"=>"text-align:center;"));
	$array_rate_input["col8"]=array($str_rate_save_button,array("style"=>"text-align:center;"));
	
	$str_rate_row_input .= $this->Template->load_table_row($array_rate_input);
		
	//BEGIN: LOAD ROW
	$str_product_rate_row = "";
	if($array_product_rate){
		$stt=0;
		foreach ($array_product_rate as $rate) {
			$stt++;
			$id_rate = $rate['id'];
			$link_sua="/product2/add/$id/$id_rate?act=edit_rate#tabs-3";
			$link_xoa="/product2/add/$id/$id_rate?act=del_rate#tabs-3";
			$link_sua  = $this->Template->load_link("edit","Sửa",$link_sua);
			$link_xoa  = $this->Template->load_link("del","Xóa",$link_xoa);
			$link_action = $link_sua . $link_xoa;
			
		$array_product_rate_row =  null;
		$array_product_rate_row["col1"]=array($stt,array("style"=>"text-align:center; width:3%"));
		$array_product_rate_row["col2"]=array($rate["material_code_bar"],array("style"=>"text-align:center; width:8%"));
		$array_product_rate_row["col3"]=array($rate["material_code"],array("style"=>"text-align:center; width:8%"));
		$array_product_rate_row["col4"]=array($rate["material_name"],array("style"=>"text-align:center; width:8%"));
		$array_product_rate_row["col5"]=array($rate["unit"],array("style"=>"text-align:center; width:8%"));
		$array_product_rate_row["col6"]=array($rate["quota"],array("style"=>"text-align:center; width:5%"));
		$array_product_rate_row["col7"]=array($rate["desc"],array("style"=>"text-align:center; width:8%"));
		$array_product_rate_row["col8"]=array($link_action,array("style"=>"text-align:center;"));
		$str_product_rate_row .= $this->Template->load_table_row($array_product_rate_row);

		}//END: foreach ($array_product_rate as $product ) {
	}//END: if($array_product_rate){
	else
	{	
		$array_product_rate_row =  null;
		$array_product_rate_row["col1"]=array("Không có dữ liệu",array("style"=>"text-align:center;","colspan"=>"5"));
		$str_product_rate_row .= $this->Template->load_table_row($array_product_rate_row);
	}
	//END: LOAD ROW
	
	$str_table_rate =  $this->Template->load_table($str_rate_header.$str_rate_row_input.$str_product_rate_row);
	$str_form_rate = $this->Template->load_form(array("method" => "POST","id"=>"form_nhap_rate", "action" => "/product2/add/$id"), $str_table_rate);
	//echo $this->Template->load_function_body($str_form_cycletime);
?>
<!-- END: TAB ĐỊNH MỨC-->
<!--===================================================================================================-->



<!--===================================================================================================-->
<!--BEGIN:TAB NHÂN CÔNG-->

<?php 

	//BEGIN: LOAD DƯ LIỆU TAB ĐỊN MỨC CÔNG NHÂN ĐỂ SỬA
	$id_product_user = "";
	$id_work = "";
	$id_user = "";
	$id_shift = "";
	$id_group = "";
	if($array_edit_product_user)
	{
		$id_product_user = $array_edit_product_user[0]["id"];
		$id_work = $array_edit_product_user[0]["id_work"];
		$id_group = $array_edit_product_user[0]["id_group"];
		$id_user = $array_edit_product_user[0]["id_user"];
		$id_shift = $array_edit_product_user[0]["id_shift"];
	}
	if(isset($_GET["id_group"]) && $_GET["id_group"] != "") $id_group = $_GET["id_group"];
	//END: LOAD DƯ LIỆU TAB ĐỊN MỨC CÔNG NHÂN ĐỂ SỬA

	//BEGIN: LOAD INPUT
	$str_user_hidden_id = $this->Template->load_hidden(array("name"=>"data_user[id]","value"=>$id_product_user));
	$str_user_hidden_status = $this->Template->load_hidden(array("name"=>"status_user","value"=>"0","id"=>"status_user"));
	$str_user_selectbox_job = $this->Template->load_selectbox(array("name"=>"data_user[id_work]","style"=>"width:200px;"),$array_job,$id_work);
	$str_user_selectbox_group = $this->Template->load_selectbox(array("name"=>"id_group","style"=>"width:200px;","onchange"=>"show_user()"),$array_group,$id_group);
	//$str_user_input_usercode = $this->Template->load_textbox(array("name"=>"data_user[user_code]","user_code","value"=>"","style"=>"width:100px;"));
	$str_user_selectbox_id_user = $this->Template->load_selectbox(array("name"=>"data_user[id_user]","style"=>"width:200px;"),$array_user2,$id_user);
	$str_user_selectbox_id_shift = $this->Template->load_selectbox(array("name"=>"data_user[id_shift]","style"=>"width:150px;"),$array_shift,$id_shift);
	$str_user_save_button =  $this->Template->load_button(array("type"=>"button","onclick"=>"submit_form_user()"),"Lưu");
	//END: LOAD INPUT

	
	//BEGIN: LOAD HEADER 	
	$str_product_user_header = "";
	$array_header_product_user =  null;
	$array_header_product_user["col1"]=array("STT",array("style"=>"text-align:center; width:3%"));
	$array_header_product_user["col2"]=array("Công việc",array("style"=>"text-align:center; width:8%"));
	$array_header_product_user["col3"]=array("Tổ",array("style"=>"text-align:center; width:8%"));
	$array_header_product_user["col4"]=array("Mã nhân viên",array("style"=>"text-align:center; width:8%"));
	$array_header_product_user["col5"]=array("Nhân viên",array("style"=>"text-align:center; width:8%"));
	$array_header_product_user["col6"]=array("Ca",array("style"=>"text-align:center; width:5%"));
	$array_header_product_user["col7"]=array("Chức năng",array("style"=>"text-align:center; width:10%"));
	
	$str_product_user_header = $this->Template->load_table_header($array_header_product_user);
	//END: LOAD HEADER
	
	
	
	//BEGIN: LOAD DONG NHAP
	$str_product_user_row_input = "";
	$array_product_user_input =  null;
	$array_product_user_input["col1"]=array($str_user_hidden_id.$str_user_hidden_status);
	$array_product_user_input["col2"]=array($str_user_selectbox_job,array("style"=>"text-align:center;"));
	$array_product_user_input["col3"]=array($str_user_selectbox_group,array("style"=>"text-align:center;"));
	$array_product_user_input["col4"]=array("",array("style"=>"text-align:center;"));
	$array_product_user_input["col5"]=array($str_user_selectbox_id_user,array("style"=>"text-align:center;"));
	$array_product_user_input["col6"]=array($str_user_selectbox_id_shift,array("style"=>"text-align:center;"));
	$array_product_user_input["col7"]=array($str_user_save_button,array("style"=>"text-align:center;"));
	
	$str_product_user_row_input .= $this->Template->load_table_row($array_product_user_input);
	//BEGIN: LOAD ROW
	
	//BEGIN: LOAD FORM
	
	
	$str_product_user_row = "";
	
	if($array_product_user){
		$stt=0;
		foreach ($array_product_user as $product_user) {
			$stt++;
			$id_product_user = $product_user['id'];
			$link_sua="/product2/add/$id/$id_product_user?act=edit_user#tabs-4";
			$link_xoa="/product2/add/$id/$id_product_user?act=del_user#tabs-4";
			$link_sua  = $this->Template->load_link("edit","Sửa",$link_sua);
			$link_xoa  = $this->Template->load_link("del","Xóa",$link_xoa);
			$link_action = $link_sua . $link_xoa;

		//BEGIN: LOAD thông tin bảng product_machine
		
		//END:LOAD thông tin bảng product_machine
		
		$array_product_user =  null;
		$array_product_user["col1"]=array($stt,array("style"=>"text-align:center; width:3%"));
		$array_product_user["col2"]=array($product_user["work_name"],array("style"=>"text-align:center; width:8%"));
		$array_product_user["col3"]=array($product_user["group_name"],array("style"=>"text-align:center; width:8%"));
		$array_product_user["col4"]=array($product_user["user_code"],array("style"=>"text-align:center; width:8%"));
		$array_product_user["col5"]=array($product_user["user_fullname"],array("style"=>"text-align:center; width:8%"));
		$array_product_user["col6"]=array($product_user["shift"],array("style"=>"text-align:center; width:8%"));
		$array_product_user["col7"]=array($link_action,array("style"=>"text-align:center;"));
		$str_product_user_row .= $this->Template->load_table_row($array_product_user);

		}//END: foreach ($array_product_rate as $product ) {
	}//END: if($array_product_rate){
	else
	{	
		$array_product_user =  null;
		$array_product_user["col1"]=array("Không có dữ liệu",array("style"=>"text-align:center;","colspan"=>"5"));
		$str_product_user_row .= $this->Template->load_table_row($array_product_user);
	}
	//END: LOAD ROW
	
$str_table_user =  $this->Template->load_table($str_product_user_header.$str_product_user_row_input.$str_product_user_row);
	
//LOAD FORM
$str_form_product_user = $this->Template->load_form(array("method" => "GET", "action" => "/product2/add/$id#tabs-4","id"=>"form_nhap_user"), $str_table_user);

?>

<!--END:TAB NHÂN CÔNG-->
<!--===================================================================================================-->

<!--===================================================================================================-->
<!-- BEGIN: TAB CHI PHÍ-->
<?php 
	$str_fee_header = "";
	//BEGIN: LOAD HEADER 	
	$array_header_fee =  null;
	$array_header_fee["col1"]=array("STT",array("style"=>"text-align:center; width:3%"));
	$array_header_fee["col2"]=array("Tên chi phí",array("style"=>"text-align:center; width:8%"));
	$array_header_fee["col3"]=array("Số tiền",array("style"=>"text-align:center; width:8%"));
	$array_header_fee["col4"]=array("Đơn vị",array("style"=>"text-align:center; width:8%"));
	$array_header_fee["col5"]=array("Ghi chú",array("style"=>"text-align:center; width:8%"));
	
	$str_fee_header = $this->Template->load_table_header($array_header_fee);
	//END: LOAD HEADER
	
	//BEGIN: LOAD DONG NHAP
	$str_fee_row_input = "";
	$array_fee_input =  null;
	$array_fee_input["col1"]=array("");
	$array_fee_input["col2"]=array("",array("style"=>"text-align:center;"));
	$array_fee_input["col3"]=array("",array("style"=>"text-align:center;"));
	$array_fee_input["col4"]=array("",array("style"=>"text-align:center;"));
	$array_fee_input["col5"]=array("",array("style"=>"text-align:center;"));
	
	$str_fee_row_input .= $this->Template->load_table_row($array_fee_input);
	//BEGIN: LOAD ROW
	
	$str_form_fee =  $this->Template->load_table($str_fee_header.$str_fee_row_input);

?>
<!-- END: TAB CHI PHÍ-->
<!--===================================================================================================-->


<div>
<?php
	//echo $str_form_product;
?>
<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Thông tin sản phẩm</a></li>
    <li><a href="#tabs-2">Cycletime</a></li>
    <li><a href="#tabs-3">Định mức vật tư</a></li>
    <li><a href="#tabs-4">Định mức công nhân</a></li>
  </ul>
  <div id="tabs-1">
    <?php
		echo $str_form_product;
	?>
  </div>
  <div id="tabs-2">
   	<?php
		echo $str_form_cycletime;
	?>
  </div>
  <div id="tabs-3">
   	<?php
		echo $str_form_rate;
	?>
  </div>
  <div id="tabs-4">
    <?php
		echo $str_form_product_user;
	?>
  </div>
</div>
</div>

<script>
	function show()
	{
		document.getElementById("status").value = "0";
		document.getElementById("form_nhap").submit();
	}
	function luu()
	{
		var dong_sp = document.getElementById("id_line").value;
		var customer = document.getElementById("customer").value;
		var factory = document.getElementById("factory").value;
		var manufactory = document.getElementById("manufactory").value;
		var ma_sp = document.getElementById("code").value;
		var ten_sp = document.getElementById("name").value;
		
		if(factory =="") 
		{
			alert("Vui lòng chọn nhà máy");
			return;
		}
		if(manufactory =="") 
		{
			alert("Vui lòng chọn xưởng");
			return;
		}
		if(dong_sp =="") 
		{
			alert("Vui lòng chọn dòng sản phẩm");
			return;
		}
		if(ma_sp =="")
		{
			alert("Vui lòng nhập mã sản phẩm");
			document.getElementById("code").focus();
			return;
		}
		
		if(ten_sp =="")
		{
			alert("Vui lòng nhập tên sản phẩm");
			document.getElementById("name").focus();
			return;
		}
		
		if(customer =="") 
		{
			alert("Vui lòng chọn khách hàng");
			return;
		}
		else 
		{
			document.getElementById("status").value = "1";
			document.getElementById("form_nhap").submit();
		}
	}
	function show_user()
	{
		document.getElementById("form_nhap_user").submit();
	}
	function submit_form_user()
	{
		document.getElementById("status_user").value = "1";
		document.getElementById("form_nhap_user").submit();
	}
</script>
