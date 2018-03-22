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

$function_title = "Nhập Các Khoản Ngoài";
echo $this->Template->load_function_header($function_title);

	//*****************************************
	//END FUNCTION HEADER
	//*****************************************

$str_ext = "";

	//1: tao mang table header 	
$array_header_ext_1 =  array(
	"stt"=>array("",array("style"=>"text-align:left; width:3%")),
	"maso"=>array("",array("style"=>"text-align:left; width:3%")),
	"ht"=>array("",array("style"=>"text-align:left; width:13%")),
	"khoancong"=>array("Các khoản cộng",array("style"=>"text-align:left; width:12%","colspan"=>"2")),
	"kp"=>array("",array("style"=>"text-align:left; width:4%;")),
	"khoantru"=>array("Các khoản trừ ",array("style"=>"text-align:left; width:30%;","colspan"=>"5")),
	"aogiay"=>array("Áo giày",array("style"=>"text-align:left; width:7%;","colspan"=>"2")),
	"non"=>array("Nón",array("style"=>"text-align:left; width:7%","colspan"=>"2")),
	"thekeo"=>array("Thẻ kéo",array("style"=>"text-align:left; width:7%","colspan"=>"2")),
	"aokt"=>array("Áo KT",array("style"=>"text-align:left; width:7%","colspan"=>"2")),
	"giaykt"=>array("Giày KT",array("style"=>"text-align:left; width:7%","colspan"=>"2")),
	);

$array_header_ext_2 =  array(

	"Stt"=>array("Stt",array("style"=>"text-align:left;width:3% ")),
	"maso"=>array("MNV ",array("style"=>"text-align:left; width:3%")),
	"hovaten"=>array("Họ & tên",array("style"=>"text-align:center;width:13%;white-space: nowrap")),						
	"luongomdau"=>array("Lương ốm đau",array("style"=>"text-align:left;width:6%")),
	"dieucchinh"=>array("Điều chỉnh tháng trước ",array("style"=>"text-align:left; width:6%;")),
	"kpcd"=>array("KPCD",array("style"=>"text-align:left; width:4%;")),
	"dienthoai"=>array("Trừ tiền điện thoại",array("style"=>"text-align:center; width:6%;")),						
	"noiquy"=>array("Trừ vi phạm nội quy",array("style"=>"text-align:left; width:6%;")),
	"tien_ng"=>array("Trừ tiền NG",array("style"=>"text-align:left; width:6%;")),
	"tien_dulich"=>array("Trừ tiền du lịch",array("style"=>"text-align:center; width:6%;")),						
	"dp"=>array("Trừ tiền đồng phục",array("style"=>"text-align:center; width:6%;")),
	"slag"=>array("SL",array("style"=>"text-align:left; width:3%")),
	"ttag"=>array("TT",array("style"=>"text-align:left; width:4%")),
	"sln"=>array("SL",array("style"=>"text-align:left; width:3%")),
	"ttn"=>array("TT",array("style"=>"text-align:left; width:4%;")),
	"sltk"=>array("SL",array("style"=>"text-align:left; width:3%")),
	"tttk"=>array("TT",array("style"=>"text-align:left; width:4%")),
	"slakt"=>array("SL",array("style"=>"text-align:left; width:3%;")),
	"ttakt"=>array("TT",array("style"=>"text-align:left; width:4%")),
	"slgkt"=>array("SL",array("style"=>"text-align:left; width:3%")),
	"ttgkt"=>array("TT",array("style"=>"text-align:left; width:4%")),


	);

	//2: lấy dòng tr header
$str_ext = $this->Template->load_table_header($array_header_ext_1);

$str_ext .= $this->Template->load_table_header($array_header_ext_2);


for($i=1;$i<6;$i++)
{
	$str_input_luong_omdau = $this->Template->load_textbox(array("name"=>"data[luong_omdau]","id"=>"luong_omdau","value"=>"","style"=>"width:100px"));
	$str_input_dc = $this->Template->load_textbox(array("name"=>"data[dc]","id"=>"dc","value"=>"","style"=>"width:100px"));		
	$str_input_dt = $this->Template->load_textbox(array("name"=>"data[dt]","id"=>"dt","value"=>"","style"=>"width:100px"));
	$str_input_nq = $this->Template->load_textbox(array("name"=>"data[nq]","id"=>"nq","value"=>"","style"=>"width:100px"));
	$str_input_tn = $this->Template->load_textbox(array("name"=>"data[tn]","id"=>"tn","value"=>"","style"=>"width:100px"));
	$str_input_dl = $this->Template->load_textbox(array("name"=>"data[dl]","id"=>"dl","value"=>"","style"=>"width:100px"));
	$str_input_slag = $this->Template->load_textbox(array("name"=>"data[slag]","slag"=>"dt","value"=>"","style"=>"width:40px"));
	$str_input_sln = $this->Template->load_textbox(array("name"=>"data[sln]","id"=>"sln","value"=>"","style"=>"width:40px"));
	$str_input_slakt = $this->Template->load_textbox(array("name"=>"data[slakt]","id"=>"slakt","value"=>"","style"=>"width:40px"));
	$str_input_slgkt = $this->Template->load_textbox(array("name"=>"data[slgkt]","id"=>"slgkt","value"=>"","style"=>"width:40px"));
	$str_input_sltk = $this->Template->load_textbox(array("name"=>"data[sltk]","id"=>"sltk","value"=>"","style"=>"width:40px"));
	
	
	
	
//lấy dòng nội dung table
	$array_ext_1 =  array(
		"stt"=>array("$i",array( "style"=>"text-align:left; width:3%")),
		"maso"=>array("maso".$i ,array("style"=>"text-align:left; width:3%;")),
		"hovaten"=>array("Nguyễn văn ".$i,array("style"=>"text-align:center; width:13%;white-space: nowrap")),						
		"luongomdau"=>array($str_input_luong_omdau,array("style"=>"text-align:left; width:6%")),
		"dieuchinh"=>array($str_input_dc,array("style"=>"text-align:left; width:6%;")),
		"kpcd"=>array("20000",array("style"=>"text-align:left; width:4%;")),
		"dienthoai"=>array($str_input_dt,array("style"=>"text-align:center; width:6%;")),						
		"nq"=>array($str_input_nq,array("style"=>"text-align:left; width:6%;")),
		"tn"=>array($str_input_tn,array("style"=>"text-align:left; width:6%;")),
		"dulich"=>array($str_input_dl,array("style"=>"text-align:center; width:6%;")),						
		"dp"=>array("295000",array("style"=>"text-align:left; width:200px;")),
		"slag"=>array($str_input_slag,array("style"=>"text-align:center; width:3%;")),						
		"ttag"=>array("45000",array("style"=>"text-align:left; width:4%;")),
		"sln"=>array($str_input_sln,array("style"=>"text-align:center; width:3%;")),						
		"ttn"=>array("20000",array("style"=>"text-align:left; width:4%;")),
		"sltk"=>array($str_input_sltk,array("style"=>"text-align:center; width:3%;")),						
		"tttk"=>array("5000",array("style"=>"text-align:left; width:4%:")),
		"slakt"=>array($str_input_slakt,array("style"=>"text-align:center; width:3%;")),						
		"ttakt"=>array("45000",array("style"=>"text-align:left; width:4%;")),
		"slgkt"=>array($str_input_slgkt,array("style"=>"text-align:center; width:3%;")),						
		"ttgkt"=>array("150000",array("style"=>"text-align:left; width:4%;")),





		);
	$str_ext .= $this->Template->load_table_row($array_ext_1);

}
	//Đưa nội dung str_allowance vào thẻ table
$str_ext =  $this->Template->load_table($str_ext);
echo $str_ext;	

$str_save_button =  $this->Template->load_button(array("type"=>"button","onclick"=>"luu()"),"Lưu");
	$str_ext = $this->Template->load_form_row(array("title"=>"","input"=>$str_save_button));		
echo $str_ext;			

?>
