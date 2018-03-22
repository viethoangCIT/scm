
<?php 																																																																																														
	//*****************************************
	//FUNCTION HEADER
	//*****************************************

$function_title = "Nhập Công Tác Phí";
echo $this->Template->load_function_header($function_title);

	//*****************************************
	//END FUNCTION HEADER
	//*****************************************

$str_select_factory = $this->Template->load_selectbox(array("name"=>"id_factory","autocomplete"=>"on","value"=>"","id"=>"id_factory","style"=>"width:130px"),$array_factory,$id_factory);
$str_select_part = $this->Template->load_selectbox(array("name"=>"id_manufactory","autocomplete"=>"on","value"=>"","id"=>"id_manufactory","style"=>"width:130px"),$array_manufactory,$id_manufactory);
$str_select_position = $this->Template->load_selectbox(array("name"=>"id_position","autocomplete"=>"on","value"=>"","id"=>"id_position","style"=>"width:130px"),$array_position,$id_position);
$str_select_job = $this->Template->load_selectbox(array("name"=>"id_job","autocomplete"=>"on","value"=>"","id"=>"id_job","style"=>"width:130px"),$array_job,$id_job);
$str_select_group = $this->Template->load_selectbox(array("name"=>"id_group","autocomplete"=>"on","value"=>"","id"=>"id_job","style"=>"width:130px"),$array_group, $id_group);
$str_input_name_staff = $this->Template->load_textbox(array("name"=>"name","autocomplete"=>"on","value"=>$name,"id"=>"name", "placeholder"=>"Nhập tên hoặc mã nhân viên"));


$str_btn_save = "<input type='submit' class='timkiem'value='Tìm kiếm' style='font-size: 13.4px'>";

$str_input_attendance_day ="$str_select_factory $str_select_part $str_select_position $str_select_job $str_select_group Tên $str_input_name_staff $str_btn_save";

$str_form_salary1 = $this->Template->load_form(array("method"=>"GET","id"=>"form_search","action"=>"", "style"=>"margin:50px;"),$str_input_attendance_day);
echo $str_form_salary1;

//BEGIN: Tạo header
$str_work_fee = "";
	
$array_header_work_fee = null;
$array_header_work_fee["col1"]=array("Tháng",array("style"=>"text-align:center; width:3%"));
$array_header_work_fee["col2"]=array("Nhân viên",array("style"=>"text-align:center; width:15%"));
$array_header_work_fee["col3"]=array("Số lít",array("style"=>"text-align:center; width:10%"));
$array_header_work_fee["col4"]=array("Đơn giá",array("style"=>"text-align:center; width:10%"));
$array_header_work_fee["col5"]=array("Điểm đến",array("style"=>"text-align:center; width:5%;"));
$array_header_work_fee["col6"]=array("Ghi chú",array("style"=>"text-align:center; width:10%;"));

$str_work_fee = $this->Template->load_table_header($array_header_work_fee);
//END: Tạo header

//BEGIN: Lấy dòng nội dung table
//
$str_hidden_id = $this->Template->load_hidden(array("name"=>"data[id]","value"=>""));	
$str_input_month = $this->Template->load_textbox(array("name"=>"data[thang]","value"=>"","id"=>"thang", "class"=>"day","style"=>"width:90px;"));
$str_selectbox_user = $this->Template->load_selectbox(array("name" => "data[id_user]", "style" => "width:200px"),$array_user);
$str_input_solit = $this->Template->load_textbox(array("name"=>"data[solit]","id"=>"solit","value"=>"","style"=>"width:100px"));
$str_input_dongia = $this->Template->load_textbox(array("name"=>"data[dongia]","id"=>"dongia","value"=>"","style"=>"width:100px"));
$str_input_diemden = $this->Template->load_textbox(array("name"=>"data[diemden]","id"=>"dongia","value"=>"","style"=>"width:100px"));
$str_input_ghichu = $this->Template->load_textbox(array("name"=>"data[ghichu]","id"=>"ghichu","value"=>"","style"=>"width:100px"));

//
//BEGIN: Lấy dòng nội dung table

//BEGIN: tạo dòng table
//
$str_work_fee_row = "";
$array_work_fee = null;
$array_work_fee["col1"] = array($str_input_month.$str_hidden_id,array("style"=>"text-align:center;"));
$array_work_fee["col2"] = array($str_selectbox_user,array("style"=>"text-align:center;"));
$array_work_fee["col3"] = array($str_input_solit,array("style"=>"text-align:center;"));
$array_work_fee["col4"] = array($str_input_dongia,array("style"=>"text-align:center;"));
$array_work_fee["col5"] = array($str_input_diemden,array("style"=>"text-align:center;"));
$array_work_fee["col6"] = array($str_input_ghichu,array("style"=>"text-align:center;"));
		
$str_work_fee_row .= $this->Template->load_table_row($array_work_fee);
//
//END: tạo dòng table

$str_work_fee =  $this->Template->load_table($str_work_fee.$str_work_fee_row);

$str_save_button =  $this->Template->load_button(array("type"=>"button","onclick"=>"luu()"),"Lưu");
$str_form_salary = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"/salary/add_fee" ," style"=>"margin-top:-40px;"),$str_work_fee.$str_save_button);


echo $str_form_salary;		
?>
<script language="javascript">
	$( function() {
		$( "#thang" ).datepicker({dateFormat: "mm-yy"});

	} );

</script>
<script>
	function luu()
	{
		if (document.getElementById("thang").value == "") 
		{
			alert("Xin vui lòng chọn ngày");
			document.getElementById("thang").focus();
			return;
		}
		document.getElementById("form_nhap").submit();
	}

</script>
