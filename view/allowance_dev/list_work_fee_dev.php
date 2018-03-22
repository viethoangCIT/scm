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

$function_title = "Danh Sách Công Tác Phí";
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
	"solit"=>array("Số lít",array("style"=>"text-align:left; width:10%;")),
	"tong_solit"=>array("Tổng số lít ",array("style"=>"text-align:left; width:10%;")),
	"dongia"=>array("Đơn giá",array("style"=>"text-align:left; width:10%;")),
	"thanhtien"=>array("Thành Tiền",array("style"=>"text-align:left; width:10%")),
	"ghichu"=>array("Ghi chú/ Điểm đến",array("style"=>"text-align:left; width:10%")),
	"chucnang"=>array("Chức năng",array("style"=>"text-align:left; width:10%")),
	
	);



	//2: lấy dòng tr header
$str_work_fee = $this->Template->load_table_header($array_header_work_fee_1);


$link_sua='';
     $link_xoa="";
     $link_sua  = $this->Template->load_link("edit","Sửa",$link_sua);
     $link_xoa  = $this->Template->load_link("del","Xóa",$link_xoa);
     $link_action = $link_xoa . $link_sua;
for($i=1;$i<11;$i++)
{

	
	
//lấy dòng nội dung table
	$array_work_fee_1 =  array(
		"Stt"=>array("$i",array( "style"=>"text-align:left; width:3%")),
		"maso"=>array("maso".$i ,array("style"=>"text-align:left; width:3%;")),
		"ht"=>array("Nguyễn văn ".$i,array("style"=>"text-align:center; width:13%;white-space: nowrap")),						
		"landi"=>array("5",array("style"=>"text-align:left; width:6%")),
		"solit"=>array("2",array("style"=>"text-align:left; width:6%;")),
		"tong_solit"=>array("10",array("style"=>"text-align:left; width:6%;")),
		"dongia"=>array("5000",array("style"=>"text-align:center; width:6%;")),						
		"thanhtien"=>array("50000",array("style"=>"text-align:left; width:6%;")),
		"ghichu"=>array("đà nẵng",array("style"=>"text-align:left; width:6%;")),
		"chucnang"=>array($link_action,array("style"=>"text-align:left; width:6%;")),
		





		);
	$str_work_fee .= $this->Template->load_table_row($array_work_fee_1);

}

    

	//Đưa nội dung str_allowance vào thẻ table
$str_work_fee =  $this->Template->load_table($str_work_fee);


 
echo $str_work_fee;	


?>
