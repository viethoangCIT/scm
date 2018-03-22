<style type="text/css">

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

$function_title = "Nhập Các Khoản Ngoài";
$function_title1 = "Sửa Các Khoản Ngoài";

if($array_edit )echo $this->Template->load_function_header($function_title1);
else echo $this->Template->load_function_header($function_title);

	//*****************************************
	//END FUNCTION HEADER
	//*****************************************
array_unshift($array_department, array("id"=>"","name"=>"Chọn phòng ban"));
array_unshift($array_factory, array("id"=>"","name"=>"Chọn nhà máy"));
array_unshift($array_job, array("id"=>"","name"=>"Chọn công việc"));
array_unshift($array_position, array("id"=>"","name"=>"Chọn chức vụ"));
array_unshift($array_manufactory, array("id"=>"","name"=>"Chọn phân xưởng"));


if ($array_edit )
{
	$thang = date("m-Y",strtotime($array_edit[0]["thang"]));
}
$str_input_from = $this->Template->load_textbox(array("name"=>"thang","autocomplete"=>"off","id"=>"thang", "class"=>"day","style"=>"width:90px;","value"=>$thang));


$str_select_department = $this->Template->load_selectbox(array("name"=>"id_department","autocomplete"=>"off","value"=>"","id"=>"id_department","style"=>"width:130px;"),$array_department,$id_department);

                // lọc theo nhà máy

$str_select_factory  =  $this->Template->load_selectbox(array("name"=>"id_factory","autocomplete"=>"off","value"=>"","id"=>"id_factory","style"=>"width:130px"),$array_factory,$id_factory);

                // lọc theo công việc

$str_select_work = $this->Template->load_selectbox(array("name"=>"id_job","autocomplete"=>"off","value"=>"","id"=>"id_job","style"=>"width:130px;"),$array_job,$id_job);

                // lọc theo chức vụ
$str_select_position = $this->Template->load_selectbox(array("name"=>"id_position","autocomplete"=>"off","value"=>"","id"=>"id_position","style"=>"width:130px;"),$array_position,$id_position);

            // lọc theo phân xưởng

$str_select_part = $this->Template->load_selectbox(array("name"=>"id_manufactory","autocomplete"=>"off","value"=>"","id"=>"id_manufactory","style"=>"width:130px;"),$array_manufactory,$id_manufactory);

$str_input_name_staff = $this->Template->load_textbox(array("name"=>"name","autocomplete"=>"off","value"=>$name,"id"=>"name", "placeholder"=>"Nhập tên nhân viên"));

$str_btn_save = "<input type='submit' class='timkiem'value='Tìm kiếm' style='font-size: 13.4px'>";

$str_input_attendance_day =" <div id = 'search_bar' style='margin-left:200px ;margin-bottom:-40px; '>$str_select_department  $str_select_position  $str_select_work  $str_select_factory  $str_select_part $str_input_name_staff $str_btn_save</div>";

$str_form_salary1 = $this->Template->load_form(array("method"=>"GET","id"=>"form_search","action"=>""),$str_input_attendance_day);


    //tạo nút tìm
$str_ext = "";
	//1: tao mang table header 	
$array_header_ext_1 = array(
	"stt"=>array("STT",array("style"=>"vertical-align:middle;text-align:center; width:3%","rowspan"=>"2")),
	"maso"=>array("Mã nhân viên",array("style"=>"vertical-align:middle;text-align:center; width:4%","rowspan"=>"2")),
	"ht"=>array("Họ & tên",array("style"=>"vertical-align:middle;text-align:center; width:7%","rowspan"=>"2")),
	"khoancong"=>array("Các khoản cộng",array("style"=>"text-align:center; width:12%","colspan"=>"2")),
	
	"khoantru"=>array("Các khoản trừ ",array("style"=>"text-align:center; width:22%;","colspan"=>"5")),
	"aogiay"=>array("Áo giày",array("style"=>"text-align:center; width:7%;","colspan"=>"1")),
	"non"=>array("Nón",array("style"=>"text-align:center; width:7%","colspan"=>"1")),
	"thekeo"=>array("Thẻ kéo",array("style"=>"text-align:center; width:7%","colspan"=>"1")),
	"aokt"=>array("Áo KT",array("style"=>"text-align:center; width:7%","colspan"=>"1")),
	"giaykt"=>array("Giày KT",array("style"=>"text-align:center; width:7%","colspan"=>"1")),
);
$array_header_ext_2 =  array(				
	"luongomdau"=>array("Lương ốm đau",array("style"=>"text-align:center;width:6%")),
	"dieucchinh"=>array("Điều chỉnh tháng trước ",array("style"=>"text-align:center; width:6%;")),
	"tru_luongung"=>array("Trừ lương ứng",array("style"=>"text-align:center; width:3%;")),	
	"dienthoai"=>array("Trừ tiền điện thoại",array("style"=>"text-align:center; width:3%;")),						
	"noiquy"=>array("Trừ vi phạm nội quy",array("style"=>"text-align:center; width:3%;")),
	"tien_ng"=>array("Trừ tiền NG",array("style"=>"text-align:center; width:3%;")),
	"tien_dulich"=>array("Trừ tiền du lịch",array("style"=>"text-align:center; width:3%;")),						
	

	"slag"=>array("SL",array("style"=>"text-align:center; width:3%")),
	
	"sln"=>array("SL",array("style"=>"text-align:center; width:3%")),
	
	"sltk"=>array("SL",array("style"=>"text-align:center; width:3%")),
	
	"slakt"=>array("SL",array("style"=>"text-align:center; width:3%;")),
	
	"slgkt"=>array("SL",array("style"=>"text-align:center; width:3%")),
	


);

	//2: lấy dòng tr header
$str_ext = $this->Template->load_table_header($array_header_ext_1);

$str_ext .= $this->Template->load_table_header($array_header_ext_2);

if ($array_edit) {

	$stt=0;
	foreach ($array_edit as $key => $value) {
		
		$str_input_id = $this->Template->load_hidden(array("name"=>"data[$stt][id]","id"=>"id","value"=>$value["id"],"style"=>"width:100px ; color:black;font-weight:normal;"));	

		$str_input_luong_omdau = $this->Template->load_textbox(array("name"=>"data[$stt][luong_om]","id"=>"luong_om","value"=>number_format($value["luong_om"]),"style"=>"width:100px"));
		$str_input_dc = $this->Template->load_textbox(array("name"=>"data[$stt][luong_dieuchinh]","id"=>"luong_dieuchinh","value"=>number_format($value["luong_dieuchinh"]),"style"=>"width:100px"));		
		$str_input_dt = $this->Template->load_textbox(array("name"=>"data[$stt][tien_dienthoai]","id"=>"tien_dienthoai","value"=>number_format($value["tien_dienthoai"]),"style"=>"width:100px"));
		$str_input_nq = $this->Template->load_textbox(array("name"=>"data[$stt][tien_noiquy]","id"=>"tien_noiquy","value"=>number_format($value["tien_noiquy"]),"style"=>"width:100px"));
		$str_input_tn = $this->Template->load_textbox(array("name"=>"data[$stt][tien_ng]","id"=>"tien_ng","value"=>number_format($value["tien_ng"]),"style"=>"width:100px"));
		$str_input_dl = $this->Template->load_textbox(array("name"=>"data[$stt][tien_dulich]","id"=>"tien_dulich","value"=>number_format($value["tien_dulich"]),"style"=>"width:100px"));
		$str_input_slag = $this->Template->load_textbox(array("name"=>"data[$stt][soluong_ao]","slag"=>"soluong_ao","value"=>$value["soluong_ao"],"style"=>"width:40px"));
		$str_input_sln = $this->Template->load_textbox(array("name"=>"data[$stt][soluong_non]","id"=>"soluong_non","value"=>$value["soluong_non"],"style"=>"width:40px"));
		$str_input_slakt = $this->Template->load_textbox(array("name"=>"data[$stt][soluong_aokt]","id"=>"soluong_aokt","value"=>$value["soluong_aokt"],"style"=>"width:40px"));
		$str_input_slgkt = $this->Template->load_textbox(array("name"=>"data[$stt][soluong_giaykt]","id"=>"soluong_giaykt","value"=>$value["soluong_giaykt"],"style"=>"width:40px"));
		$str_input_sltk = $this->Template->load_textbox(array("name"=>"data[$stt][soluong_thekeo]","id"=>"soluong_thekeo","value"=>$value["soluong_thekeo"],"style"=>"width:40px"));


		
//lấy dòng nội dung table
		$array_ext_1 =  array(
			"stt"=>array(1,array( "style"=>"text-align:center; width:3%")),
			"maso"=>array($value["user_code"],array("style"=>"text-align:center; width:3%;")),
			"hovaten"=>array($value["full_name"],array("style"=>"text-align:center; width:7%;")),			
			"luongomdau"=>array($str_input_luong_omdau,array("style"=>"text-align:center; width:6%")),
			"dieuchinh"=>array($str_input_dc ,array("style"=>"text-align:center; width:6%;")),
			"dienthoai"=>array($str_input_dt,array("style"=>"text-align:center; width:6%;")),				
			"nq"=>array($str_input_nq,array("style"=>"text-align:center; width:6%;")),
			"tn"=>array($str_input_tn,array("style"=>"text-align:center; width:6%;")),
			"dulich"=>array($str_input_dl,array("style"=>"text-align:center; width:6%;")),				
			"slag"=>array($str_input_slag,array("style"=>"text-align:center; width:3%;")),				
			"sln"=>array($str_input_sln.$str_input_id,array("style"=>"text-align:center; width:3%;")),		
			"sltk"=>array($str_input_sltk,array("style"=>"text-align:center; width:3%;")),					
			"slakt"=>array($str_input_slakt,array("style"=>"text-align:center; width:3%;")),				
			"slgkt"=>array($str_input_slgkt,array("style"=>"text-align:center; width:3%;")),				
		);
		$str_ext .= $this->Template->load_table_row($array_ext_1);
	}
}
else{

	$stt=0;
	foreach ($array_user as $key => $value) {

		$str_input_code = $this->Template->load_hidden(array("name"=>"data[$stt][user_code]","id"=>"user_code","value"=>$value['user_code'],"style"=>"width:100px; color:black;font-weight:normal;"));	
		$str_input_fullname = $this->Template->load_hidden(array("name"=>"data[$stt][full_name]","id"=>"full_name","value"=>$value["fullname"],"style"=>"width:100px ; color:black;font-weight:normal;"));

		$str_input_id_user = $this->Template->load_hidden(array("name"=>"data[$stt][id_user]","id"=>"id_user","value"=>$value["id"],"style"=>"width:100px ; color:black;font-weight:normal;"));	
		


		$str_input_id_department = $this->Template->load_hidden(array("name"=>"data[$stt][id_department]","id"=>"id_department","value"=>$value['id_department'],"style"=>"width:100px; color:black;font-weight:normal;"));	
		$str_input_id_factory = $this->Template->load_hidden(array("name"=>"data[$stt][id_factory]","id"=>"id_factory","value"=>$value["id_factory"],"style"=>"width:100px ; color:black;font-weight:normal;"));
		$str_input_id_job= $this->Template->load_hidden(array("name"=>"data[$stt][id_job]","id"=>"id_job","value"=>$value["id_work"],"style"=>"width:100px ; color:black;font-weight:normal;"));
		$str_input_id_manufactory = $this->Template->load_hidden(array("name"=>"data[$stt][id_manufactory]","id"=>"id_manufactory","value"=>$value["id_manufactory"],"style"=>"width:100px ; color:black;font-weight:normal;"));	
		$str_input_id_position = $this->Template->load_hidden(array("name"=>"data[$stt][id_position]","id"=>"id_position","value"=>$value["id_position"],"style"=>"width:100px ; color:black;font-weight:normal;"));	

		$str_input_luong_omdau = $this->Template->load_textbox(array("name"=>"data[$stt][luong_om]","id"=>"luong_om","value"=>"","style"=>"width:100px","onkeyup" =>"format_number_textbox(this)"));
		$str_input_dc = $this->Template->load_textbox(array("name"=>"data[$stt][luong_dieuchinh]","id"=>"luong_dieuchinh","value"=>"","style"=>"width:100px","onkeyup" =>"format_number_textbox(this)"));		
		$str_input_dt = $this->Template->load_textbox(array("name"=>"data[$stt][tien_dienthoai]","id"=>"tien_dienthoai","value"=>"","style"=>"width:100px","onkeyup" =>"format_number_textbox(this)"));
		$str_input_nq = $this->Template->load_textbox(array("name"=>"data[$stt][tien_noiquy]","id"=>"tien_noiquy","value"=>"","style"=>"width:100px","onkeyup" =>"format_number_textbox(this)"));
		$str_input_tn = $this->Template->load_textbox(array("name"=>"data[$stt][tien_ng]","id"=>"tien_ng","value"=>"","style"=>"width:100px","onkeyup" =>"format_number_textbox(this)"));
		$str_input_dl = $this->Template->load_textbox(array("name"=>"data[$stt][tien_dulich]","id"=>"tien_dulich","value"=>"","style"=>"width:100px","onkeyup" =>"format_number_textbox(this)"));
		$str_input_slag = $this->Template->load_textbox(array("name"=>"data[$stt][soluong_ao]","slag"=>"soluong_ao","value"=>"","style"=>"width:40px"));
		$str_input_sln = $this->Template->load_textbox(array("name"=>"data[$stt][soluong_non]","id"=>"soluong_non","value"=>"","style"=>"width:40px"));
		$str_input_slakt = $this->Template->load_textbox(array("name"=>"data[$stt][soluong_aokt]","id"=>"soluong_aokt","value"=>"","style"=>"width:40px"));
		$str_input_slgkt = $this->Template->load_textbox(array("name"=>"data[$stt][soluong_giaykt]","id"=>"soluong_giaykt","value"=>"","style"=>"width:40px"));
		$str_input_sltk = $this->Template->load_textbox(array("name"=>"data[$stt][soluong_thekeo]","id"=>"soluong_thekeo","value"=>"","style"=>"width:40px"));
		$str_input_tru_luongung = $this->Template->load_textbox(array("name"=>"data[$stt][tru_luongung]","id"=>"tru_luongung","value"=>"","style"=>"width:100px","onkeyup" =>"format_number_textbox(this)"));



		$stt++;

//lấy dòng nội dung table
		$array_ext_1 =  array(
			"stt"=>array($stt.$str_input_code.$str_input_fullname.$str_input_id_user,array( "style"=>"text-align:center; width:3%")),
			"maso"=>array($value["user_code"].$str_input_id_position,array("style"=>"text-align:center; width:3%;")),
			"hovaten"=>array($value["fullname"].$str_input_id_manufactory,array("style"=>"text-align:center; width:7%;")),						
			"luongomdau"=>array($str_input_luong_omdau.$str_input_id_job,array("style"=>"text-align:center; width:6%")),
			"dieuchinh"=>array($str_input_dc.$str_input_id_department ,array("style"=>"text-align:center; width:6%;")),

			"tru_luongung"=>array($str_input_tru_luongung,array("style"=>"text-align:center; width:6%;")),
			"dienthoai"=>array($str_input_dt,array("style"=>"text-align:center; width:6%;")),						
			"nq"=>array($str_input_nq,array("style"=>"text-align:center; width:6%;")),
			"tn"=>array($str_input_tn,array("style"=>"text-align:center; width:6%;")),
			"dulich"=>array($str_input_dl,array("style"=>"text-align:center; width:6%;")),						

			"slag"=>array($str_input_slag.$str_input_id_factory,array("style"=>"text-align:center; width:3%;")),						

			"sln"=>array($str_input_sln,array("style"=>"text-align:center; width:3%;")),						

			"sltk"=>array($str_input_sltk,array("style"=>"text-align:center; width:3%;")),						

			"slakt"=>array($str_input_slakt,array("style"=>"text-align:center; width:3%;")),						

			"slgkt"=>array($str_input_slgkt,array("style"=>"text-align:center; width:3%;")),						






		);
		$str_ext .= $this->Template->load_table_row($array_ext_1);

	}
}
$str_save_button =  $this->Template->load_button(array("type"=>"button","onclick"=>"luu()"),"Lưu");
$array_ext_2 =  array(
	"stt"=>array("",array( "style"=>"text-align:center; width:3%","colspan"=>"13")),
	"maso"=>array($str_save_button,array("style"=>"text-align:center; width:3%;")),
);

$str_ext .= $this->Template->load_table_row($array_ext_2);
	//Đưa nội dung str_allowance vào thẻ table
$str_ext =  $this->Template->load_table($str_ext);





$str_form_salary = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"/salary/add_ext"),"Chọn tháng:".$str_input_from.$str_ext);
?>
<div id="parent">

	<?php 
	if ($array_edit == NULL) 	echo $str_form_salary1;
	
	echo $str_form_salary;	 ?>

</div>
<script language="javascript">
	$( function() {
		$( "#thang" ).datepicker({dateFormat: "mm-yy"});
		
	} );

</script>
<script type="text/javascript">
	function luu()
	{
		if (document.getElementById("thang").value == "")
		{
			alert("Xin vui lòng chọn ngày");
			document.getElementById("thang").focus();
			return
		}
		document.getElementById("form_nhap").submit();
	}
	function keyup()
	{

	}
</script>