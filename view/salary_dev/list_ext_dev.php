<style >
	.table-responsive{
		overflow: scroll!important;
	}
		.tbl_r{
		height: 300px;
		width: 2000px;
	}

	#parent {

		min-height: 200px;
		max-height: 450px;
		position: absolute;
		width: 100%;
		left: 0;
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
array_unshift($array_department, array("id"=>"","name"=>"Phòng ban"));
array_unshift($array_factory, array("id"=>"","name"=>"Nhà máy"));
array_unshift($array_job, array("id"=>"","name"=>"Công việc"));
array_unshift($array_position, array("id"=>"","name"=>"Chức vụ"));
array_unshift($array_manufactory, array("id"=>"","name"=>"Phân xưởng")); 

      $str_select_department = $this->Template->load_selectbox(array("name"=>"id_department","autocomplete"=>"off","value"=>"","id"=>"department","style"=>"width:100px;"),$array_department,$id_department);

    // lọc theo nhà máy
   
    $str_select_factory    =  $this->Template->load_selectbox(array("name"=>"id_factory","autocomplete"=>"off","value"=>"","id"=>"id_factory","style"=>"width:100px"),$array_factory,$id_factory);

    // lọc theo công việc
   
    $str_select_work = $this->Template->load_selectbox(array("name"=>"id_job","autocomplete"=>"off","value"=>"","id"=>"id_job","style"=>"width:100px;"),$array_job,$id_job);

                // lọc theo chức vụ
   
    $str_select_position = $this->Template->load_selectbox(array("name"=>"id_position","autocomplete"=>"off","value"=>"","id"=>"id_position","style"=>"width:100px;"),$array_position,$id_position);

            // lọc theo phân xưởng
   
     $str_select_part = $this->Template->load_selectbox(array("name"=>"id_manufactory","autocomplete"=>"off","value"=>"","id"=>"id_manufactory","style"=>"width:100px;"),$array_manufactory,$id_manufactory);


if($date_to != "") $date_to1 = date("m-Y",strtotime($date_to));
if($date_from != "") $date_from1 = date("m-Y",strtotime($date_from));
 $str_input_from = $this->Template->load_textbox(array("name"=>"date_from","autocomplete"=>"off","value"=>$date_from1,"id"=>"date_from", "class"=>"day","style"=>"width:90px;"));
    $str_input_to = $this->Template->load_textbox(array("name"=>"date_to","autocomplete"=>"off","value"=>$date_to1,"id"=>"date_to", "class"=>"day","style"=>"width:90px;"));
     $str_input_name_staff = $this->Template->load_textbox(array("name"=>"name","autocomplete"=>"off","value"=>$name,"id"=>"name", "placeholder"=>"Nhập tên nhân viên"));
   
    $str_btn_save = "<input type='submit' class='timkiem'value='Tìm kiếm' style='font-size: 13.4px'>";

    $str_input_attendance_day ="Từ tháng:$str_input_from&nbsp&nbsp Đến tháng:$str_input_to  $str_select_department  $str_select_position  $str_select_work $str_select_factory  $str_select_part Tên:$str_input_name_staff $str_btn_save";
   
$str_form_search = $this->Template->load_form(array("method"=>"GET","id"=>"form_search","action"=>"","style"=>"margin-left: -112px;"),$str_input_attendance_day);
echo $str_form_search;
 
//tạo nút tìm


$str_allowance = "";

//1: tao mang table header 	
$array_header_allowance_1 =  array(
	"Stt"=>array("STT",array("style"=>"vertical-align:middle;text-align:center; width:4%","rowspan"=>"2")),
"maso"=>array("Mã nhân viên",array("style"=>"vertical-align:middle;text-align:center; width:4%","rowspan"=>"2")),
	"hovaten"=>array("Họ & tên",array("style"=>"vertical-align:middle;text-align:center; width:10%","rowspan"=>"2")),
	"khoancong"=>array("Các khoản cộng",array("style"=>"text-align:center; width:10%","colspan"=>"2")),
	"kpcd"=>array("KPCĐ",array("style"=>"vertical-align:middle;text-align:center; width:5%","rowspan"=>"2")),
	"khoantru"=>array("Các khoản trừ ",array("style"=>"text-align:center; width:25%","colspan"=>"5")),
	"aogiay"=>array("Áo giày",array("style"=>"text-align:center; width:6%","colspan"=>"2")),
	"non"=>array("Nón",array("style"=>"text-align:center; width:6%","colspan"=>"2")),
	"thekeo"=>array("Thẻ kéo",array("style"=>"text-align:center; width:6%","colspan"=>"2")),
	"aokt"=>array("Áo KT",array("style"=>"text-align:center; width:6%","colspan"=>"2")),
	"giaykt"=>array("Giày KT",array("style"=>"text-align:center; width:6%","colspan"=>"2")),
	"chucnang"=>array("Chức năng",array("style"=>"vertical-align:middle;text-align:center; width:3%","rowspan"=>"2")),
	
	
	);

$array_header_allowance_2 =  array(                                                                                                                                                                                   

						
	"luongomdau"=>array("Lương ốm đau",array("style"=>"text-align:center; width:5%;")),
	"dc"=>array("Điều chỉnh tháng trước ",array("style"=>"text-align:center; width:5%;")),
	
	"dt"=>array("Trừ tiền điện thoại",array("style"=>"text-align:center; width:5%")),						
	"nq"=>array("Trừ vi phạm nội quy",array("style"=>"text-align:center; width:5% ;")),
	"tn"=>array("Trừ tiền nghĩ",array("style"=>"text-align:center; width:5%;")),
	"dl"=>array("Trừ tiền du lịch",array("style"=>"text-align:center; width:5%;")),						
	"dp"=>array("Trừ đồng phục",array("style"=>"text-align:center;width:5%; ")),
	"slag"=>array("SL",array("style"=>"text-align:center; width:3%")),
	"ttag"=>array("TT",array("style"=>"text-align:center; width:3%")),
	"sln"=>array("SL",array("style"=>"text-align:center; width:3%")),
	"ttn"=>array("TT",array("style"=>"text-align:center; width:3%")),
	"sltk"=>array("SL",array("style"=>"text-align:center; width:3%")),
	"tttk"=>array("TT",array("style"=>"text-align:center; width:3%")),
	"slakt"=>array("SL",array("style"=>"text-align:center; width:3%")),
	"ttakt"=>array("TT",array("style"=>"text-align:center; width:3%")),
	"slgkt"=>array("SL",array("style"=>"text-align:center; width:3%")),
	"ttgkt"=>array("TT",array("style"=>"text-align:center; width:3%")),

	
	
	

	);

	//2: lấy dòng tr header
$str_allowance = $this->Template->load_table_header($array_header_allowance_1);

$str_allowance .= $this->Template->load_table_header($array_header_allowance_2);



	//lấy dòng nội dung table
     $stt=0;
foreach ($array_ext as $key => $value) {
$id=$value["id"];

	$link_sua="/salary/add_ext/$id";
     $link_xoa="/salary/del_ext/$id.html";
     $link_sua  = $this->Template->load_link("edit","Sửa",$link_sua);
     $link_xoa  = $this->Template->load_link("del","Xóa",$link_xoa);
     $link_action = $link_xoa . $link_sua;
 	$stt++;
	$array_allowance_1 =  array(
		"Stt"=>array($stt,array( "style"=>"text-align:center; width:3%")),
		"maso"=>array($value["user_code"],array("style"=>"text-align:center; width:4%")),
		"hovaten"=>array($value["full_name"],array("style"=>"text-align:center; width:10%;")),						
		"luongomdau"=>array(number_format($value["luong_om"]),array("style"=>"text-align:center; width:5%")),
		"dc"=>array(number_format($value["luong_dieuchinh"]),array("style"=>"text-align:center; width:5%")),
		"kpcd"=>array(" ",array("style"=>"text-align:center; width:5%")),
		"dt"=>array(number_format($value["tien_dienthoai"]),array("style"=>"text-align:center; width:5%;")),						
		"nq"=>array(number_format($value["tien_noiquy"]),array("style"=>"text-align:center; width:5%")),
		"tn"=>array(number_format($value["tien_ng"]),array("style"=>"text-align:center; width:5%")),
		"dl"=>array(number_format($value["tien_dulich"]),array("style"=>"text-align:center; width:5%;")),						
		"dp"=>array("",array("style"=>"text-align:center; width:5%")),
		"slag"=>array($value["soluong_ao"],array("style"=>"text-align:center; width:3%;")),						
		"ttag"=>array("",array("style"=>"text-align:center; width:3%")),
		"sln"=>array($value["soluong_non"],array("style"=>"text-align:center; width:3%;")),						
		"ttn"=>array("",array("style"=>"text-align:center; width:3%")),
		"sltk"=>array($value["soluong_thekeo"],array("style"=>"text-align:center; width:3%;")),						
		"tttk"=>array("",array("style"=>"text-align:center; width:3%")),
		"slakt"=>array($value["soluong_aokt"],array("style"=>"text-align:center; width:3%;")),						
		"ttakt"=>array("",array("style"=>"text-align:center; width:3%")),
		"slgkt"=>array($value["soluong_giaykt"],array("style"=>"text-align:center; width:3%;")),						
		"ttgkt"=>array("",array("style"=>"text-align:center; width:3%")),

		"chucnang"=>array($link_action,array("style"=>"text-align:center; width:3%")),

		);
	$str_allowance .= $this->Template->load_table_row($array_allowance_1);

}

//Đưa nội dung str_allowance vào thẻ table
$str_allowance =  $this->Template->load_table($str_allowance);

$str_form_salary = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>""),$str_allowance);
?>
<div id="parent">
<?php 
echo $str_form_salary;	
 ?>
 </div>
<script language="javascript">
    $( function() {
        $( "#date_from" ).datepicker({dateFormat: "mm-yy"});
		$( "#date_to" ).datepicker({dateFormat: "mm-yy"});
    } );
   
</script>