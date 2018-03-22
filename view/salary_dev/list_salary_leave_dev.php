<style type="text/css">

.parent {
	min-height: 200px;
	max-height: 450px;
	height: 350px;
	position: absolute;
	width: 100%;
	left: 0;
	overflow:scroll;

}


</style>
<?php 																																																																																														
	//*****************************************
	//FUNCTION HEADER
	//*****************************************

$function_title = "Danh Sách Lương Thôi Việc";
echo $this->Template->load_function_header($function_title);

	//*****************************************
	//END FUNCTION HEADER
	//*****************************************


array_unshift($array_department, array("id"=>"","name"=>"Chọn phòng ban"));
array_unshift($array_factory, array("id"=>"","name"=>"Chọn nhà máy"));
array_unshift($array_job, array("id"=>"","name"=>"Chọn công việc"));
array_unshift($array_position, array("id"=>"","name"=>"Chọn chức vụ"));
array_unshift($array_manufactory, array("id"=>"","name"=>"Chọn phân xưởng")); 

$str_select_department = $this->Template->load_selectbox(array("name"=>"id_department","autocomplete"=>"off","value"=>"","id"=>"id_department","style"=>"width:130px"),$array_department,$id_department);

                // lọc theo nhà máy

$str_select_factory    =  $this->Template->load_selectbox(array("name"=>"id_factory","autocomplete"=>"off","value"=>"","id"=>"id_factory","style"=>"width:130px"),$array_factory,$id_factory);

                // lọc theo công việc

$str_select_work = $this->Template->load_selectbox(array("name"=>"id_job","autocomplete"=>"off","value"=>"","id"=>"id_job","style"=>"width:130px"),$array_job,$id_job);

                // lọc theo chức vụ

$str_select_position = $this->Template->load_selectbox(array("name"=>"id_position","autocomplete"=>"off","value"=>"","id"=>"id_position","style"=>"width:130px"),$array_position,$id_position);

            // lọc theo phân xưởng

$str_select_part = $this->Template->load_selectbox(array("name"=>"id_manufactory","autocomplete"=>"off","value"=>"","id"=>"id_manufactory","style"=>"width:130px"),$array_manufactory,$id_manufactory);

$date_from1= "";
$date_to1 = "";
if($date_to != "") $date_to1 = date("m-Y",strtotime($date_to));
if($date_from != "") $date_from1= date("m-Y",strtotime($date_from));

$str_input_from = $this->Template->load_textbox(array("name"=>"date_from","autocomplete"=>"off","value"=>$date_from,"id"=>"date_from", "class"=>"day","style"=>"width:90px;"));
$str_input_to = $this->Template->load_textbox(array("name"=>"date_to","autocomplete"=>"off","value"=>$date_to1,"id"=>"date_to", "class"=>"day","style"=>"width:90px;"));






$str_input_name_staff = $this->Template->load_textbox(array("name"=>"name","autocomplete"=>"off","value"=>$name,"id"=>"name", "placeholder"=>"Nhập tên nhân viên"));



$str_btn_save = "<input type='submit' class='timkiem'value='Tìm kiếm' style='font-size: 13.4px'>";

$str_input_attendance_day ="Từ ngày:$str_input_from&nbsp &nbsp Đến ngày: $str_input_to  $str_select_department  $str_select_position  $str_select_work  $str_select_factory $str_select_part Tên: $str_input_name_staff $str_btn_save";






//***************************************************
$str_salary_maternity = "";

	//1: tao mang table header 	
$array_header_salary_maternity =  array(
	"Stt"=>array("STT",array("style"=>"text-align:center; width:3%")),
	"ms"=>array("Mã nhân viên",array("style"=>"text-align:center; width:3%")),
	"ht"=>array("Họ & tên",array("style"=>"text-align:center; width:7%")),
	"cmnn"=>array("Số CMNN",array("style"=>"text-align:center; width:5%")),
	"tk"=>array("Số TK",array("style"=>"text-align:center; width:4%;")),
	"thamnien"=>array("Thâm niên",array("style"=>"text-align:center; width:2%;")),
	"bophan"=>array("Bộ phận",array("style"=>"text-align:center; width:3%;")),
	"luong_thoigian"=>array("Lương thời gian",array("style"=>"text-align:center; width:3%")),
	"luong_sanpham"=>array("Lương sản phẩm",array("style"=>"text-align:center; width:3%")),
	"phucap_ca3"=>array("Phụ cấp ca 3",array("style"=>"text-align:center; width:3%")),
	"luong_tangca150"=>array("Lương tăng ca 150%",array("style"=>"text-align:center; width:3%")),
	"luong_tangca200"=>array("Lương tăng ca 200%",array("style"=>"text-align:center; width:3%")),
	"tiensua"=>array("Tiền Sữa",array("style"=>"text-align:center; width:3%")),
	"luong_nghi"=>array("Lương nghỉ BHXH hàng tháng ",array("style"=>"text-align:center; width:4%;")),
	"xang"=>array("Xăng công tác",array("style"=>"text-align:center; width:3%;")),
	"tongluong"=>array("Tổng lương ",array("style"=>"text-align:center; width:3%;")),
	"luong_dieuchinh"=>array("Điều chỉnh lương tháng trước ",array("style"=>"text-align:center; width:3%")),
	"tru_bhxh"=>array("Trừ BHXH",array("style"=>"text-align:center; width:3%")),
	"tien_daotao"=>array("Trừ tiền đào tạo",array("style"=>"text-align:center; width:4%;")),
	"tien_noiquy"=>array("Trừ vi phạm nội quy ",array("style"=>"text-align:center; width:3%;")),
	"tien_ng"=>array("Trừ tiền NG  ",array("style"=>"text-align:center; width:3%;")),
	"tien_dongphuc"=>array("Trừ tiền đồng phục ",array("style"=>"text-align:center; width:3%")),
	"thuclanh"=>array("Thực lãnh ",array("style"=>"text-align:center; width:3%")),
	
	
);



	//2: lấy dòng tr header
$str_salary_maternity = $this->Template->load_table_header($array_header_salary_maternity);

$stt=0;
foreach ($array_user as $key => $value) {

	$stt++;
	$ngayvaocongty = $value["date_join"];
	$thang_hientai = $value['thang'];

	//chuyển ngày vào công ty và ngày hiện tại thành kiểu datetime 
	$ts1 = strtotime($ngayvaocongty);
	$ts2 = strtotime($thang_hientai);

	// lấy năm của ngày vào công ty và năm hiện tại 
	$year1 = date('Y', $ts1);
	$year2 = date('Y', $ts2);

					// lấy tháng vào công ty và tháng hiện tại
	$month1 = date('m', $ts1);
	$month2 = date('m', $ts2);

					// tính số tháng thâm niên
	$thang_thamnien = (($year2 - $year1) * 12) + ($month2 - $month1);

	
	
	
//lấy dòng nội dung table
	$array_salary_maternity_1 =  array(
		"Stt"=>array($stt,array( "style"=>"text-align:center; width:3%")),
		"maso"=>array($value["user_code"] ,array("style"=>"text-align:center; width:3%;")),
		"ht"=>array($value["full_name"],array("style"=>"text-align:center; width:7%;")),						
		"cmnn"=>array($value["id_number"],array("style"=>"text-align:center; width:5%")),
		"tk"=>array($value["bank_account"],array("style"=>"text-align:center; width:6%;")),
		"thamnien"=>array($thang_thamnien,array("style"=>"text-align:center; width:2%;")),
		"bophan"=>array("PRO-Sảnxuất",array("style"=>"text-align:center; width:3%;")),
		"luong_thoigian"=>array("2000000",array("style"=>"text-align:center; width:3%")),
		"luong_sanpham"=>array("1000000",array("style"=>"text-align:center; width:3%")),
		"phucap_ca3"=>array("500000",array("style"=>"text-align:center; width:3%")),
		"luong_tangca150"=>array("150000",array("style"=>"text-align:center; width:3%")),
		"luong_tangca200"=>array("200000",array("style"=>"text-align:center; width:3%")),
		"tiensua"=>array("50000",array("style"=>"text-align:center; width:3%")),
		"luong_nghi"=>array("50000 ",array("style"=>"text-align:center; width:4%;")),
		"xang"=>array("50000",array("style"=>"text-align:center; width:3%;")),
		"tongluong"=>array("7000000 ",array("style"=>"text-align:center; width:3%;")),
		"luong_dieuchinh"=>array("1000000",array("style"=>"text-align:center; width:3%")),
		"tru_bhxh"=>array("500000",array("style"=>"text-align:center; width:3%")),
		"tien_daotao"=>array("100000",array("style"=>"text-align:center; width:4%;")),
		"tien_noiquy"=>array("50000 ",array("style"=>"text-align:center; width:3%;")),
		"tien_ng"=>array("50000  ",array("style"=>"text-align:center; width:3%;")),
		"tien_dongphuc"=>array("100000 ",array("style"=>"text-align:center; width:3%")),
		"thuclanh"=>array("5200000 ",array("style"=>"text-align:center; width:3%")),


	);
	$str_salary_maternity .= $this->Template->load_table_row($array_salary_maternity_1);

}

	//Đưa nội dung str_allowance vào thẻ table
$str_salary_maternity =  $this->Template->load_table($str_salary_maternity);

$str_form_salary = $this->Template->load_form(array("method"=>"GET","id"=>"form_nhap","action"=>""),$str_input_attendance_day.$str_salary_maternity);

?>
<div class="parent">

	<?php
	echo $str_form_salary;	
	?>
</div>

<div style="height: 400px;"></div>

<script language="javascript">
	$( function() {
		$( "#date_from" ).datepicker({dateFormat: "mm-yy"});
		$( "#date_to" ).datepicker({dateFormat: "mm-yy"});
	} );

</script>
