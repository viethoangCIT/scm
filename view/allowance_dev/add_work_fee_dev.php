<style type="text/css">
	.table-responsive{
		overflow: scroll!important;

	}
	.tbl_r{
		height: 300px;
	}
	.title_page{
		color: black;
	}
	.title_page{
		color: black!important;
		text-shadow:none;
	}
</style>
<?php 																																																																																														
	//*****************************************
	//FUNCTION HEADER
	//*****************************************

$function_title = "Nhập Công Tác Phí";
echo $this->Template->load_function_header($function_title);

	//*****************************************
	//END FUNCTION HEADER
	//*****************************************

$str_work_fee = "";

	//1: tao mang table header 	
$array_header_work_fee_1 =  array(
	"Stt"=>array("STT",array("style"=>"text-align:left; width:3%")),
	"ms"=>array("Mã nhân viên",array("style"=>"text-align:left; width:3%")),
	"ht"=>array("Họ & tên",array("style"=>"text-align:left; width:20%")),
	"landi"=>array("Lần đi",array("style"=>"text-align:left; width:10%")),
	"solit"=>array("Số lít",array("style"=>"text-align:left; width:4%;")),
	"tong_solit"=>array("Tổng số lít ",array("style"=>"text-align:left; width:10%;")),
	"dongia"=>array("Đơn giá",array("style"=>"text-align:left; width:10%;")),
	"thanhtien"=>array("Thành Tiền",array("style"=>"text-align:left; width:10%")),
	"ghichu"=>array("Ghi chú/ Điểm đến",array("style"=>"text-align:left; width:10%")),
	
	);



	//2: lấy dòng tr header
$str_work_fee = $this->Template->load_table_header($array_header_work_fee_1);



for($i=1;$i<11;$i++)
{
	
	$str_input_landi = $this->Template->load_textbox(array("name"=>"data[landi]","id"=>"landi","value"=>"","style"=>"width:100px"));
	$str_input_solit = $this->Template->load_textbox(array("name"=>"data[solit]","id"=>"solit","value"=>"","style"=>"width:100px"));
	$str_input_dongia = $this->Template->load_textbox(array("name"=>"data[dongia]","id"=>"dongia","value"=>"","style"=>"width:100px"));
	$str_input_ghichu = $this->Template->load_textbox(array("name"=>"data[ghichu]","id"=>"ghichu","value"=>"","style"=>"width:100px"));
	
	
	
	
//lấy dòng nội dung table
	$array_work_fee_1 =  array(
		"Stt"=>array("$i",array( "style"=>"text-align:left; width:3%")),
		"maso"=>array("maso".$i ,array("style"=>"text-align:left; width:3%;")),
		"ht"=>array("Nguyễn văn ".$i,array("style"=>"text-align:center; width:13%;white-space: nowrap")),						
		"landi"=>array($str_input_landi,array("style"=>"text-align:left; width:6%")),
		"solit"=>array($str_input_solit,array("style"=>"text-align:left; width:6%;")),
		"tong_solit"=>array("10",array("style"=>"text-align:left; width:4%;")),
		"dongia"=>array($str_input_dongia,array("style"=>"text-align:center; width:6%;")),						
		"thanhtien"=>array("50000",array("style"=>"text-align:left; width:6%;")),
		"ghichu"=>array($str_input_ghichu,array("style"=>"text-align:left; width:6%;")),
		





		);
	$str_work_fee .= $this->Template->load_table_row($array_work_fee_1);

}

    

	//Đưa nội dung str_allowance vào thẻ table
$str_work_fee =  $this->Template->load_table($str_work_fee);


 
echo $str_work_fee;	

$str_save_button =  $this->Template->load_button(array("type"=>"button","onclick"=>"luu()"),"Lưu");
	$str_work_fee = $this->Template->load_form_row(array("title"=>"","input"=>$str_save_button));		

echo $str_work_fee;		
?>
