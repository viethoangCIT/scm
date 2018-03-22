<style type="text/css">
	

	
	
</style>
<?php 																																																																																														
	//*****************************************
	//FUNCTION HEADER
	//*****************************************

$function_title = "Danh Sách Công Tác Phí";
echo $this->Template->load_function_header($function_title);

	//*****************************************
	//END FUNCTION HEADER
	//*****************************************
array_unshift($array_department, array("id"=>"","name"=>"Phòng ban"));
array_unshift($array_factory, array("id"=>"","name"=>"Nhà máy"));
array_unshift($array_job, array("id"=>"","name"=>"Công việc"));
array_unshift($array_position, array("id"=>"","name"=>"Chức vụ"));
array_unshift($array_manufactory, array("id"=>"","name"=>"Phân xưởng"));

$str_select_department = $this->Template->load_selectbox(array("name"=>"id_department","autocomplete"=>"off","value"=>"","id"=>"id_department","style"=>"width:100px"),$array_department,$id_department);

// lọc theo nhà máy

$str_select_factory    =  $this->Template->load_selectbox(array("name"=>"id_factory","autocomplete"=>"off","value"=>"","id"=>"id_factory","style"=>"width:100px"),$array_factory,$id_factory);

                // lọc theo công việc

$str_select_work = $this->Template->load_selectbox(array("name"=>"id_job","autocomplete"=>"off","value"=>"","id"=>"id_job","style"=>"width:100px"),$array_job,$id_job);

                // lọc theo chức vụ

$str_select_position = $this->Template->load_selectbox(array("name"=>"id_position","autocomplete"=>"off","value"=>"","id"=>"id_position","style"=>"width:100px"),$array_position,$id_position);

            // lọc theo phân xưởng

$str_select_part = $this->Template->load_selectbox(array("name"=>"id_manufactory","autocomplete"=>"off","value"=>"","id"=>"id_manufactory","style"=>"width:100px"),$array_manufactory,$id_manufactory);

if($date_to != "") $date_to = date("m-Y",strtotime($date_to));
if($date_from != "") $date_from = date("m-Y",strtotime($date_from));
$str_input_from = $this->Template->load_textbox(array("name"=>"date_from","autocomplete"=>"off","value"=>$date_from,"id"=>"date_from", "class"=>"day","style"=>"width:90px;"));
$str_input_to = $this->Template->load_textbox(array("name"=>"date_to","autocomplete"=>"off","value"=>$date_to,"id"=>"date_to", "class"=>"day","style"=>"width:90px;"));


$str_input_name_staff = $this->Template->load_textbox(array("name"=>"name","autocomplete"=>"off","value"=>$name,"id"=>"name", "placeholder"=>"Nhập tên nhân viên"));


   // $str_btn_save = $this->Template->load_button(array("type"=>"submit",),"<p class = 'text_tk'>Tìm kiếm</p>");
$str_btn_save = "<input type='submit' class='timkiem'value='Tìm kiếm' style='font-size: 13.4px'>";

$str_input_attendance_day =" Từ tháng:$str_input_from Đến tháng:$str_input_to $str_select_department $str_select_position $str_select_work $str_select_factory $str_select_part $str_input_name_staff $str_btn_save";

$str_form_salary1 = $this->Template->load_form(array("method"=>"GET","id"=>"form_nhap","action"=>"","style"=>"margin-left:-30px;"),$str_input_attendance_day);

    //tạo nút tìm
$str_work_fee = "";

	//1: tao mang table header 	
$array_header_work_fee_1 =  array(
	"Stt"=>array("STT",array("style"=>"text-align:center; width:3%")),
	"ms"=>array("Mã nhân viên",array("style"=>"text-align:center; width:8%")),
	"ht"=>array("Họ & tên",array("style"=>"text-align:center; width:15%")),
	"landi"=>array("Lần đi",array("style"=>"text-align:center; width:7%")),
	"solit"=>array("Số lít",array("style"=>"text-align:center; width:7%;")),
	"tong_solit"=>array("Tổng số lít ",array("style"=>"text-align:center; width:7%;")),
	"dongia"=>array("Đơn giá",array("style"=>"text-align:center; width:7%;")),
	"thanhtien"=>array("Thành Tiền",array("style"=>"text-align:center; width:7%")),
	"ghichu"=>array("Ghi chú/ Điểm đến",array("style"=>"text-align:center; width:15%")),
	"chucnang"=>array("Chức năng",array("style"=>"text-align:center; width:6%")),
	
	);



	//2: lấy dòng tr header
$str_work_fee = $this->Template->load_table_header($array_header_work_fee_1);




$stt=0;

foreach ($array_fee as $key => $value) {

$id=$value["id"];
$link_sua="/salary/add_fee/$id.html";
$link_xoa="/salary/del_fee/$id.html";
$link_sua  = $this->Template->load_link("edit","Sửa",$link_sua);
$link_xoa  = $this->Template->load_link("del","Xóa",$link_xoa);
$link_action = $link_xoa . $link_sua;
$stt++;
//lấy dòng nội dung table

	$array_work_fee_1 = array(
		"Stt"=>array($stt,array( "style"=>"text-align:center; width:3%")),
		"maso"=>array($value["user_code"] ,array("style"=>"text-align:center; width:8%;")),
		"ht"=>array($value["full_name"],array("style"=>"text-align:center; width:13%;")),
		"landi"=>array($value["landi"],array("style"=>"text-align:center; width:4%")),
		"solit"=>array($value["solit"],array("style"=>"text-align:center; width:4%;")),
		"tong_solit"=>array($value["landi"]*$value["solit"],array("style"=>"text-align:center; width:4%;")),
		"dongia"=>array(number_format($value["dongia"]),array("style"=>"text-align:center; width:6%;")),						
		"thanhtien"=>array(number_format($value["dongia"]*$value["landi"]*$value["solit"]),array("style"=>"text-align:center; width:6%;")),
		"ghichu"=>array($value["ghichu"],array("style"=>"text-align:center; width:6%;")),
		"chucnang"=>array($link_action,array("style"=>"text-align:center; width:6%;")),
		);
	$str_work_fee .= $this->Template->load_table_row($array_work_fee_1);

}

	//Đưa nội dung str_allowance vào thẻ table
$str_work_fee =  $this->Template->load_table($str_work_fee);
$str_form_salary = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"/salary/add_fee"),$str_work_fee);
echo $str_form_salary1.$str_form_salary;	
?>
<script language="javascript">
	$( function() {
		$("#date_from").datepicker({dateFormat: "mm-yy"});
		$("#date_to").datepicker({dateFormat: "mm-yy"});
	} );

</script>
