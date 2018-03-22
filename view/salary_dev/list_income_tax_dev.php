<style type="text/css">
#parent {
	min-height: 200px;
	max-height: 450px;
	height: 350px;
	position: absolute;
	width: 100%;
	left: 0;

	

}



</style>
<?php 																						
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
$function_title = "Danh Sách Thuế Thu Nhập Cá Nhân Tạm Tính";
echo $this->Template->load_function_header($function_title);

	//*****************************************
	//END FUNCTION HEADER
	//*****************************************





array_unshift($array_department, array("id"=>"","name"=>"Chọn phòng ban"));
$str_select_department = $this->Template->load_selectbox(array("name"=>"id_department","autocomplete"=>"off","value"=>"","id"=>"id_department","style"=>"width:130px"),$array_department,$id_department);

// lọc theo nhà máy
array_unshift($array_factory, array("id"=>"","name"=>"Chọn nhà máy"));
$str_select_factory    =  $this->Template->load_selectbox(array("name"=>"id_factory","autocomplete"=>"off","value"=>"","id"=>"id_factory","style"=>"width:130px"),$array_factory,$id_factory);

// lọc theo công việc
array_unshift($array_job, array("id"=>"","name"=>"Chọn công việc"));
$str_select_work = $this->Template->load_selectbox(array("name"=>"id_job","autocomplete"=>"off","value"=>"","id"=>"id_job","style"=>"width:130px"),$array_job,$id_job);

// lọc theo chức vụ
array_unshift($array_position, array("id"=>"","name"=>"Chọn chức vụ"));
$str_select_position = $this->Template->load_selectbox(array("name"=>"id_position","autocomplete"=>"off","value"=>"","id"=>"id_position","style"=>"width:130px"),$array_position,$id_position);

// lọc theo phân xưởng
array_unshift($array_manufactory, array("id"=>"","name"=>"Chọn phân xưởng"));
$str_select_part = $this->Template->load_selectbox(array("name"=>"id_manufactory","autocomplete"=>"off","value"=>"","id"=>"id_manufactory","style"=>"width:130px"),$array_manufactory,$id_manufactory);

if ($date_from != "") $date_from = date("m-Y",strtotime($date_from));
if ($date_to != "") $date_to = date("m-Y",strtotime($date_to));

$str_input_from = $this->Template->load_textbox(array("name"=>"date_from","autocomplete"=>"off","value"=>$date_from,"id"=>"date_from", "class"=>"day","style"=>"width:90px;"));
$str_input_to = $this->Template->load_textbox(array("name"=>"date_to","autocomplete"=>"off","value"=>$date_to,"id"=>"date_to", "class"=>"day","style"=>"width:90px;"));

$str_input_name_staff = $this->Template->load_textbox(array("name"=>"name","autocomplete"=>"off","value"=>$name,"id"=>"name", "placeholder"=>"Nhập tên nhân viên"));

$str_btn_save = "<input type='submit' class='timkiem'value='Tìm kiếm' style='font-size: 13.4px'>";

$str_input_attendance_day ="Từ tháng:$str_input_from&nbsp&nbsp Đến tháng:$str_input_to $str_select_department $str_select_position  $str_select_work  $str_select_factory  $str_select_part  Tên: $str_input_name_staff $str_btn_save";
$str_form_salary1 = $this->Template->load_form(array("method"=>"GET","id"=>"form_nhap","action"=>""),$str_input_attendance_day);







////////////////////////
$str_salary_product = "";

	//1: tao mang table header 	



$array_header_salary_product_1=  array("Stt"=>array("STT",array("style"=>"vertical-align:middle;text-align:center; width:3%","rowspan"=>"3")),
	"mnv"=>array("Mã nhân viên",array("style"=>"vertical-align:middle;text-align:center; width:5%","rowspan"=>"3")),
	"hoten"=>array("Họ & tên",array("style"=>"vertical-align:middle;text-align:center; width:10%;white-space: nowrap","rowspan"=>"3")),						
	"ktbanthan"=>array("KT Bản thân",array("style"=>"vertical-align:middle;text-align:center; width:5%","rowspan"=>"3")),
	"khautru"=>array("Khấu Trừ Người Phụ Thuộc",array("style"=>"vertical-align:middle;text-align:center; width:10%","colspan"=>"2")),

	
	"thunhap_tt"=>array("Thu nhập tính thuế",array("style"=>"vertical-align:middle;text-align:center; width:5%","rowspan"=>"3")),

	
	"thuesuat"=>array("Thuế Suất" ,array("style"=>"vertical-align:middle;text-align:center; width:12%","colspan"=>"4")),
	"tongtien"=>array("Tổng tiền" ,array("style"=>"vertical-align:middle;text-align:center; width:5%","rowspan"=>"3")),
	"chucnang"=>array("Chức năng" ,array("style"=>"vertical-align:middle;text-align:center; width:5%; white-space:nowrap;","rowspan"=>"3","colspan"=>"2")),
);


$array_header_salary_product_2=  
array(
	"Số nguoi"=>array("Số người",array("style"=>"vertical-align:middle;text-align:center; width:5%","rowspan"=>"2")),
	"tt"=>array("Thành tiền" ,array("style"=>"text-align:center; width:3%")),
	"5"=>array("5%" ,array("style"=>"text-align:center; width:3%")),
	"10"=>array("10%" ,array("style"=>"text-align:center; width:3%")),
	
	"15"=>array("15%" ,array("style"=>"text-align:center; width:3%")),
	"20"=>array("20%",array("style"=>"text-align:center; width:3%")),						
);

$array_header_salary_product_3=  
array(
	"onhap"=>array($array_income_tax[0]["tien"],array("style"=>"text-align:center; width:5%")),		
	"5"=>array($array_income_tax[0]["thue_5"],array("style"=>"text-align:center; width:3%")),
	"10"=>array($array_income_tax[0]["thue_10"] ,array("style"=>"text-align:center; width:3%")),
	
	"15"=>array($array_income_tax[0]["thue_15"],array("style"=>"text-align:center; width:3%")),
	"20"=>array($array_income_tax[0]["thue_20"],array("style"=>"text-align:center; width:3%")),						
);

	//2: lấy dòng tr header
$str_salary_product = $this->Template->load_table_header($array_header_salary_product_1);
$str_salary_product .= $this->Template->load_table_header($array_header_salary_product_2);
$str_salary_product .= $this->Template->load_table_header($array_header_salary_product_3);

	//lấy dòng nội dung table



$stt=0;
foreach ($array_income_tax as $value) {
	$thanhtien = $value["songuoi"] * $value["tien"];   

	$id  =$value["id"];
	$link_sua="/salary/add_temp_income_tax/$id.html";
	$link_xoa="/salary/del_income/$id.html";
	$link_sua  = $this->Template->load_link("edit","Sửa",$link_sua);
	$link_xoa  = $this->Template->load_link("del","Xóa",$link_xoa);
	$link_action = $link_xoa . $link_sua;

	$stt++;
	$array_salary_product=  array(
		"Stt"=>array($stt,array("style"=>"text-align:center; width:3%")),
		"maso"=>array($value["user_code"],array("style"=>"text-align:center; width:5%")),
		"hoten"=>array($value["full_name"],array("style"=>"text-align:center;width:10%")),				
		"ktbanthan"=>array(number_format($value["kt_banthan"]),array("style"=>"text-align:center; width:5%")),
		"songuoi"=>array($value["songuoi"],array("style"=>"text-align:center; width:5%")),
		"thanhtien"=>array(number_format($thanhtien),array("style"=>"text-align:center; width:5%")),						
		
		"thunhap_tt"=>array("",array("style"=>"text-align:center; width:5%")),
		"5"=>array("",array("style"=>"text-align:center; width:3%")),
		"10"=>array("",array("style"=>"text-align:center; width:3%")),
		"15"=>array("",array("style"=>"text-align:center; width:3%")),
		"20"=>array("",array("style"=>"text-align:center; width:3%")),
		"tongtien"=>array("",array("style"=>"text-align:center; width:5%")),
		"chucnang"=>array("$link_sua",array("style"=>"text-align:center; width:5%; white-space:nowrap;")),
		"phu"=>array("$link_xoa",array("style"=>"text-align:center; width:5%; white-space:nowrap;")),
	);
	$str_salary_product .= $this->Template->load_table_row($array_salary_product);

}

	//Đưa nội dung str_allowance vào thẻ table
$str_salary_product =  $this->Template->load_table($str_salary_product);

$str_form_salary = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"/salary/add_temp_income_tax"),$str_salary_product);



?>
<div id="parent" >
	<?php 
	echo $str_form_salary1;
	echo $str_form_salary;		
	?>
</div>

<script language="javascript">
	$( function() {
		$( "#date_from" ).datepicker({dateFormat: "mm-yy"});
		$( "#date_to" ).datepicker({dateFormat: "mm-yy"});
	} );

</script>
