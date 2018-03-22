<?php 
$function_title = "Sửa Công Tác Phí";
echo $this->Template->load_function_header($function_title);

$array_header_work_fee_1 =  array(
	"Stt"=>array("STT",array("style"=>"text-align:center; width:3%")),
	"ms"=>array("Mã nhân viên",array("style"=>"text-align:center; width:8%")),
	"ht"=>array("Họ & tên",array("style"=>"text-align:center; width:15%")),
	"landi"=>array("Lần đi",array("style"=>"text-align:center; width:10%")),
	"ngay"=>array("Tháng",array("style"=>"text-align:center; width:10%")),
	"solit"=>array("Số lít",array("style"=>"text-align:center; width:4%;")),
	"dongia"=>array("Đơn giá",array("style"=>"text-align:center; width:10%;")),
	"ghichu"=>array("Ghi chú/ Điểm đến",array("style"=>"text-align:center; width:10%")),
	
);
$str_work_fee = $this->Template->load_table_header($array_header_work_fee_1);


foreach ($array_edit as $key => $value) {
	$str_input_landi = $this->Template->load_textbox(array("name"=>"data[0][landi]","id"=>"landi","value"=>$value["landi"],"style"=>"width:100px"));
	$str_input_solit = $this->Template->load_textbox(array("name"=>"data[0][solit]","id"=>"solit","value"=>$value["solit"],"style"=>"width:100px"));
	$str_input_dongia = $this->Template->load_textbox(array("name"=>"data[0][dongia]","id"=>"dongia","value"=>$value["dongia"],"style"=>"width:100px"));
	$str_input_ghichu = $this->Template->load_textbox(array("name"=>"data[0][ghichu]","id"=>"ghichu","value"=>$value["ghichu"],"style"=>"width:100px"));
	$thang = date("m-Y",strtotime($value["thang"]));
	$str_input_thang = $this->Template->load_textbox(array("name"=>"thang","id"=>"thang","value"=>$thang,"style"=>"width:100px"));

	$str_input_id = $this->Template->load_hidden(array("name"=>"data[0][id]","id"=>"id","value"=>$value["id"],"style"=>"width:100px ; color:black;font-weight:normal;"));	

	$array_work_fee_1 =  array(
		"Stt"=>array(1,array( "style"=>"text-align:center; width:3%")),
		"maso"=>array($value["user_code"],array("style"=>"text-align:center; width:3%;")),

		"ht"=>array($value["full_name"],array("style"=>"text-align:center; width:13%;white-space: nowrap")),						
		"landi"=>array($str_input_landi.$str_input_id,array("style"=>"text-align:center; width:6%")),
		"ngay"=>array($str_input_thang,array("style"=>"text-align:center; width:6%;")),
		"solit"=>array($str_input_solit,array("style"=>"text-align:center; width:6%;")),

		"dongia"=>array($str_input_dongia,array("style"=>"text-align:center; width:6%;")),						
		"ghichu"=>array($str_input_ghichu,array("style"=>"text-align:center; width:6%;")),






	);
	$str_work_fee .= $this->Template->load_table_row($array_work_fee_1);

}

$str_save_button =  $this->Template->load_button(array("type"=>"submit","onclick"=>"luu()"),"Lưu");

	//Đưa nội dung str_allowance vào thẻ table
$str_work_fee =  $this->Template->load_table($str_work_fee);

$str_form_salary = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"/salary/add_fee"),$str_work_fee.$str_save_button);
echo $str_form_salary;

?>
<script language="javascript">
	$( function() {
		$( "#thang" ).datepicker({dateFormat: "mm-yy"});
		
	} );

</script>