<style >
	.table-responsive{
		overflow: scroll!important;
	}
		.tbl_r{
		height: 300px;
	}
	.title_page{
		color: black;
	}
	
</style>
<?php 																																																																																														
	//*****************************************
	//FUNCTION HEADER
	//*****************************************

$function_title = "Danh Sách Các Khoản Ngoài";
echo $this->Template->load_function_header($function_title);

	//*****************************************
	//END FUNCTION HEADER
	//*****************************************

$str_allowance = "";

	//1: tao mang table header 	
$array_header_allowance_1 =  array(
	"Stt"=>array("",array("style"=>"text-align:left; width:3%")),
	"Sr"=>array("",array("style"=>"text-align:left; width:3%")),
	"St"=>array("",array("style"=>"text-align:left; width:3%")),
	"khoancong"=>array("Các khoản cộng",array("style"=>"text-align:left; width:3%","colspan"=>"2")),
	"S"=>array("",array("style"=>"text-align:left; width:3%")),
	"khoantru"=>array("Các khoản trừ ",array("style"=>"text-align:left; width:15%","colspan"=>"5")),
	"aogiay"=>array("Áo giày",array("style"=>"text-align:left; width:3%","colspan"=>"2")),
	"non"=>array("Nón",array("style"=>"text-align:left; width:3%","colspan"=>"2")),
	"thekeo"=>array("Thẻ kéo",array("style"=>"text-align:left; width:3%","colspan"=>"2")),
	"aokt"=>array("Áo KT",array("style"=>"text-align:left; width:3%","colspan"=>"2")),
	"giaykt"=>array("Giày KT",array("style"=>"text-align:left; width:3%","colspan"=>"2")),
	"sua"=>array("",array("style"=>"text-align:left; width:3%")),
	
	
	);

$array_header_allowance_2 =  array(

	"Stt"=>array("Stt",array("style"=>"text-align:left; width:3%;white-space: nowrap")),
	"maso"=>array("Mã nhân viên",array("style"=>"text-align:left; width:15%;white-space: nowrap")),
	"hovaten"=>array("Họ & tên",array("style"=>"text-align:center; width:8%;white-space: nowrap")),						
	"luongomdau"=>array("Lương ốm đau",array("style"=>"text-align:left; width:8%;white-space: nowrap")),
	"dc"=>array("Điều chỉnh tháng trước ",array("style"=>"text-align:left; width:15%;white-space: nowrap")),
	"kpcd"=>array("KPCD",array("style"=>"text-align:left; width:3%;white-space: nowrap")),
	"dt"=>array("Trừ tiền điện thoại",array("style"=>"text-align:center; width:8%;white-space: nowrap")),						
	"nq"=>array("Trừ vi phạm nội quy",array("style"=>"text-align:left; width:8% ;white-space: nowrap")),
	"tn"=>array("Trừ tiền nghĩ",array("style"=>"text-align:left; width:15%;white-space: nowrap")),
	"dl"=>array("Trừ tiền du lịch",array("style"=>"text-align:center; width:8%;white-space: nowrap")),						
	"dp"=>array("Trừ đồng phục",array("style"=>"text-align:left; width:8%;white-space: nowrap")),
	"slag"=>array("SL",array("style"=>"text-align:left; width:3%")),
	"ttag"=>array("TT",array("style"=>"text-align:left; width:3%")),
	"sln"=>array("SL",array("style"=>"text-align:left; width:3%")),
	"ttn"=>array("TT",array("style"=>"text-align:left; width:3%")),
	"sltk"=>array("SL",array("style"=>"text-align:left; width:3%")),
	"tttk"=>array("TT",array("style"=>"text-align:left; width:3%")),
	"slakt"=>array("SL",array("style"=>"text-align:left; width:3%")),
	"ttakt"=>array("TT",array("style"=>"text-align:left; width:3%")),
	"slgkt"=>array("SL",array("style"=>"text-align:left; width:3%")),
	"ttgkt"=>array("TT",array("style"=>"text-align:left; width:3%")),

	"chucnang"=>array("Chức năng",array("style"=>"text-align:left; width:8%")),
	
	

	);

	//2: lấy dòng tr header
$str_allowance = $this->Template->load_table_header($array_header_allowance_1);

$str_allowance .= $this->Template->load_table_header($array_header_allowance_2);


$link_sua='';
     $link_xoa="";
     $link_sua  = $this->Template->load_link("edit","Sửa",$link_sua);
     $link_xoa  = $this->Template->load_link("del","Xóa",$link_xoa);
     $link_action = $link_xoa . $link_sua;

	//lấy dòng nội dung table
for ($i=1; $i <7 ; $i++) { 

	 


	$array_allowance_1 =  array(
		"Stt"=>array("$i",array( "style"=>"text-align:left; width:3%")),
		"maso"=>array("maso ".$i,array("style"=>"text-align:left; width:15%")),
		"hovaten"=>array("Nguyễn văn ".$i,array("style"=>"text-align:center; width:8%;white-space: nowrap")),						
		"luongomdau"=>array("600000",array("style"=>"text-align:left; width:8%")),
		"dc"=>array("500000 ",array("style"=>"text-align:left; width:15%")),
		"kpcd"=>array("20000 ",array("style"=>"text-align:left; width:15%")),
		"dt"=>array("3000",array("style"=>"text-align:center; width:8%;white-space: nowrap")),						
		"nq"=>array("1000",array("style"=>"text-align:left; width:8%")),
		"tn"=>array("100000 ",array("style"=>"text-align:left; width:15%")),
		"dl"=>array("500000",array("style"=>"text-align:center; width:8%;white-space: nowrap")),						
		"dp"=>array("295000",array("style"=>"text-align:left; width:8%")),
		"slag"=>array("1",array("style"=>"text-align:center; width:8%;white-space: nowrap")),						
		"ttag"=>array("45000",array("style"=>"text-align:left; width:8%")),
		"sln"=>array("1",array("style"=>"text-align:center; width:8%;white-space: nowrap")),						
		"ttn"=>array("20000",array("style"=>"text-align:left; width:8%")),
		"sltk"=>array("1",array("style"=>"text-align:center; width:8%;white-space: nowrap")),						
		"tttk"=>array("5000",array("style"=>"text-align:left; width:8%")),
		"slakt"=>array("1",array("style"=>"text-align:center; width:8%;white-space: nowrap")),						
		"ttakt"=>array("75000",array("style"=>"text-align:left; width:8%")),
		"slgkt"=>array("1",array("style"=>"text-align:center; width:8%;white-space: nowrap")),						
		"ttgkt"=>array("150000",array("style"=>"text-align:left; width:8%")),

		"chucnang"=>array($link_action,array("style"=>"text-align:left; width:8%")),
		


		);
	$str_allowance .= $this->Template->load_table_row($array_allowance_1);

}

	//Đưa nội dung str_allowance vào thẻ table
$str_allowance =  $this->Template->load_table($str_allowance);
echo $str_allowance;				

?>
