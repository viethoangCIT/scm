<style>
	table{ width: 50%}

	tr:hover td, tr.hover td { background-color: #F90 }
	td.selected { background-color: green; } 
	tr:hover td.selected { background-color: lime; }

	#search_bar
	{


	}
	.input_search{
		margin-bottom: 10px;
	}
#parent {
		min-height: 200px;
		max-height: 450px;
		height: 350px;
		position: absolute;
		width: 100%;
		left: 0;
		overflow:scroll;

	}

	.department{
		margin-top: 10px;
	}
	.timkiem{
		border-radius:5px;
		background-color: #fcfcfc;
	}
	.title_page{
		color: black!important;
		text-shadow:none;
	}
	/*.table-responsive{
		margin-top: 10px;
		overflow: scroll!important
	}*/
	


	#table_salary td.selected { border: 1px solid #F00; }
</style>
<?php
$function_title = "Nhập lương";
echo $this->Template->load_function_header($function_title);



$arrray_deparment =array(""=>"...","0"=>"BGĐ-Ban giám đốc", "1"=>"ISO-Quy trình", "3"=>"PRO-Sản xuất","4"=>"HR-Nhân sự", "5"=>"QC-Chất lượng", "6"=>"PE-Kỹ thuật", "7"=>"PUR-Mua hàng","8" =>"SALE-Kinh doanh", "9"=>"WH-Kho");    
$str_select_department = $this->Template->load_selectbox_basic(array("name"=>"department","autocomplete"=>"off","value"=>"","id"=>"department"),$arrray_deparment);

                // lọc theo nhà máy
$arrray_factory=  array(""=>"...","0"=>"SCM1", "1"=>"SCM2", "2"=>"SCM3");
$str_select_factory    =  $this->Template->load_selectbox_basic(array("name"=>"factory","autocomplete"=>"off","value"=>"","id"=>"factory","style"=>"width:100px"),$arrray_factory);

                // lọc theo công việc
$array_work =array(""=>"...","0"=>"Giám sát", "1"=>"Quản lý", "3"=>"Phụ trách","4"=>"Tính lương", "5"=>"Báo giá", "6"=>"Khai thuế", "7"=>"Lắp ráp","8" =>"Toàn kiểm", "9"=>"Kiểm hàng","10"=>"Đứng máy");
$str_select_work = $this->Template->load_selectbox_basic(array("name"=>"work","autocomplete"=>"off","value"=>"","id"=>"work"),$array_work);

                // lọc theo chức vụ
$array_position =array(""=>"...","0"=>"Giám đốc", "1"=>"P.Giám đốc", "3"=>"Trưởng phòng","4"=>"Phó phòng", "5"=>"Trưởng bộ phận", "6"=>"NV phụ trách", "7"=>"Tổ trưởng","8" =>"Tổ phó", "9"=>"Trưởng ca","10"=>"Phó ca","11"=>"Nhân viên","12"=>"Công dân"); 
$str_select_position = $this->Template->load_selectbox_basic(array("name"=>"position","autocomplete"=>"off","value"=>"","id"=>"position"),$array_position);

            // lọc theo phân xưởng
$arrray_part =array(""=>"...","0"=>"Anten 1", "1"=>"Molding 1", "3"=>"Solar","4"=>"Silicon", "5"=>"Electronic", "6"=>"Anten 2", "7"=>"Molding 2");
$str_select_part = $this->Template->load_selectbox_basic(array("name"=>"part","autocomplete"=>"off","value"=>"","id"=>"part"),$arrray_part);

$str_input_from = $this->Template->load_textbox(array("name"=>"salary_from","autocomplete"=>"off","value"=>"","id"=>"salary_from", "class"=>"day","style"=>"width:90px;"));
$str_input_to = $this->Template->load_textbox(array("name"=>"salary_to","autocomplete"=>"off","value"=>"","id"=>"salary_to", "class"=>"day","style"=>"width:90px;"));

   // $str_btn_save = $this->Template->load_button(array("type"=>"submit"),"Tìm kiếm");
$str_btn_save = "<input type='submit' class='timkiem'value='Tìm kiếm' style='font-size: 13.4px'>";

$str_label_from = $this->Template->load_label("Từ ngày: ","","search_list");
$str_label_to = $this->Template->load_label("Đến ngày: ","","search_list");
$str_label_department = $this->Template->load_label("Phòng ban: ","","search_list");
$str_label_position = $this->Template->load_label("Chức vụ: ","","search_list");		
$str_label_job = $this->Template->load_label("Công việc: ","","search_list");		
$str_label_factory = $this->Template->load_label("Nhà máy: ","","search_list");		
$str_label_manufactory = $this->Template->load_label("Phân xưởng: ","","search_list");		

$str_input_name_staff = $this->Template->load_textbox(array("name"=>"attendance_day","autocomplete"=>"off","value"=>"","id"=>"attendance_day", "placeholder"=>"Nhập tên nhân viên"));


   // $str_btn_save = $this->Template->load_button(array("type"=>"submit",),"<p class = 'text_tk'>Tìm kiếm</p>");
$str_btn_save = "<input type='submit' class='timkiem'value='Tìm kiếm' style='font-size: 13.4px'>";

$str_input_attendance_day ="<div id = 'search_bar'>Từ ngày $str_input_from Đến ngày $str_input_to <br /> Phòng ban   $str_select_department Chức vụ  $str_select_position Công việc $str_select_work Nhà máy $str_select_factory Phân xưởng $str_select_part <br/>Nhập tên nhân viên $str_input_name_staff$str_btn_save</div>";


echo $str_input_attendance_day;
    //tạo nút tìm



$str_salary_maternity = "";

	//1: tao mang table header 	
$array_header_salary_maternity_1 =  array(

	"Stt"=>array("STT",array("style"=>"vertical-align:middle;text-align:center; width:3%","rowspan"=>"3")),
	"ms"=>array("Mã nhân viên",array("style"=>"vertical-align:middle;text-align:center; width:8%","rowspan"=>"3")),
	"ht"=>array("Họ & tên",array("style"=>"vertical-align:middle;text-align:center; width:15%","rowspan"=>"3")),
	"cmnn"=>array("Số CMNN",array("style"=>"vertical-align:middle;text-align:center; width:9%","rowspan"=>"3")),
	"tk"=>array("Số TK",array("style"=>"vertical-align:middle;text-align:center; width:9%","rowspan"=>"3")),
	"thamnien"=>array("Thâm niên",array("style"=>"vertical-align:middle;text-align:center; width:9%","rowspan"=>"3")),

	"luong_tg"=>array("Lương thời gian",array("style"=>"text-align:center; width:8%","colspan"=>"6")),
	"phucap"=>array("Các khoản phụ cấp",array("style"=>"text-align:center; width:8%","colspan"=>"5")),

	"luong_cb"=>array("Lương cơ bản",array("style"=>"vertical-align:middle;text-align:center; width:8%","rowspan"=>"3")),
	"luong_dong_bh"=>array("Lương đóng bảo hiểm",array("style"=>"vertical-align:middle;text-align:center; width:15%","rowspan"=>"3")),
	"luong_ngoai"=>array("Ngoài lương chính",array("style"=>"text-align:center; width:15%","colspan"=>"6")),

	"tongluong"=>array("Tổng lương",array("style"=>"vertical-align:middle;text-align:center; width:9%","rowspan"=>"3")),
	"dieuchinh"=>array("Điều chỉnh tháng trước",array("style"=>"vertical-align:middle;text-align:center; width:9%","rowspan"=>"3")),


	"khoangtru"=>array("Các khoản phải trừ",array("style"=>"text-align:center; width:9%","colspan"=>"13")),
	
	
	
	);

$array_header_salary_maternity_2 =  array(

	"Stt"=>array("Lương hành chính",array("style"=>"text-align:center; width:3%","rowspan"=>"2")),
	"ms"=>array("Phụ cấp ca 3",array("style"=>"text-align:center; width:8%","rowspan"=>"2")),
	"ht"=>array("Lương tăng ca 150%",array("style"=>"text-align:center; width:15%","rowspan"=>"2")),
	"cmnn"=>array("Lương tăng ca 200%",array("style"=>"text-align:center; width:9%","rowspan"=>"2")),
	"tk"=>array("Lương tăng ca 300%",array("style"=>"text-align:center; width:9%","rowspan"=>"2")),
	"thamnien"=>array("Tổng lương thời gian",array("style"=>"text-align:center; width:9%","rowspan"=>"2")),

	"chuyencan"=>array("Chuyên cần",array("style"=>"text-align:center; width:3%","rowspan"=>"2")),
	"trocap"=>array("Trợ cấp xe đi lại, nhà ở",array("style"=>"text-align:center; width:8%","rowspan"=>"2")),
	"trachnhiem"=>array("Trách nhiệm ",array("style"=>"text-align:center; width:15%","rowspan"=>"2")),
	"phucap"=>array("Phụ cấp lương ",array("style"=>"text-align:center; width:9%","rowspan"=>"2")),
	"kiemnhiem"=>array("Kiêm nhiệm ",array("style"=>"text-align:center; width:9%","rowspan"=>"2")),


	"thuong_nangxuat"=>array("Thưởng đạt năng xuất",array("style"=>"text-align:center; width:3%","rowspan"=>"2")),
	"luong_phepnam"=>array("Lương phép năm hàng tháng ",array("style"=>"text-align:center; width:8%","rowspan"=>"2")),
	"luong_om"=>array("Lương nghĩ ốm đau (BHXH)",array("style"=>"text-align:center; width:15%","rowspan"=>"2")),
	"dienthoai"=>array("Tiền điện thoại ",array("style"=>"text-align:center; width:9%","rowspan"=>"2")),
	"sua"=>array("Tiền sữa",array("style"=>"text-align:center; width:9%","rowspan"=>"2")),
	"tienxang"=>array("Tiền xăng đi công tác",array("style"=>"text-align:center; width:9%","rowspan"=>"2")),



	"dongphuc"=>array("Trừ tiền đồng phục",array("style"=>"text-align:center; width:3%","rowspan"=>"2")),
	"luong_goidau"=>array("Lương gối đầu",array("style"=>"text-align:center; width:3%","colspan"=>"2")),

	"luongung"=>array("Trừ lương ứng",array("style"=>"text-align:center; width:3%","rowspan"=>"2")),
	"dulich"=>array("Trừ tiền đi du lịch",array("style"=>"text-align:center; width:8%","rowspan"=>"2")),
	"tru_dienthoai"=>array("Trừ tiền điện thoại",array("style"=>"text-align:center; width:15%","rowspan"=>"2")),
	"thue_tncn"=>array("Thuế TNCN tạm tính",array("style"=>"text-align:center; width:9%","rowspan"=>"2")),
	"noiquy"=>array("Vi phạm nội quy",array("style"=>"text-align:center; width:9%","rowspan"=>"2")),
	"tien_ng"=>array("Trừ tiền NG",array("style"=>"text-align:center; width:9%","rowspan"=>"2")),

	"tien_ktb"=>array("Trừ tiền KTB",array("style"=>"text-align:center; width:3%","rowspan"=>"2")),
	"congdoan"=>array("KPCĐ",array("style"=>"text-align:center; width:3%","rowspan"=>"2")),
	"baohiem"=>array("BHXH, BHYT",array("style"=>"text-align:center; width:3%","rowspan"=>"2")),
	"tongquy"=>array("Tổng quỹ ",array("style"=>"text-align:center; width:15%","rowspan"=>"2")),
	
	);

$array_header_salary_maternity_3 =  array(

	"songay"=>array("Số ngày",array("style"=>"text-align:center; width:3%")),
	"thanhtien"=>array("Thành tiền",array("style"=>"text-align:center; width:3%")),
	);
	//2: lấy dòng tr header
$str_salary_maternity = $this->Template->load_table_header($array_header_salary_maternity_1);
$str_salary_maternity .= $this->Template->load_table_header($array_header_salary_maternity_2);
$str_salary_maternity .= $this->Template->load_table_header($array_header_salary_maternity_3);
$link_sua='';
$link_xoa="";
$link_sua  = $this->Template->load_link("edit","Sửa",$link_sua);
$link_xoa  = $this->Template->load_link("del","Xóa",$link_xoa);
$link_action = $link_xoa . $link_sua;
for($i=1;$i<11;$i++)
{
	
	
	
	
	
//lấy dòng nội dung table

	$str_input_luong_cb = $this->Template->load_textbox(array("name"=>"data[luong_cb]","id"=>"luong_cb","value"=>"","style"=>"width:100px; color:black;font-weight:normal;"));	
	$str_input_trachnhiem = $this->Template->load_textbox(array("name"=>"data[trachnhiem]","id"=>"trachnhiem","value"=>"","style"=>"width:100px ; color:black;font-weight:normal;"));
	$str_input_phucap_luong = $this->Template->load_textbox(array("name"=>"data[phucap_luong]","id"=>"phucap_luong","value"=>"","style"=>"width:100px ; color:black;font-weight:normal;"));
	$str_input_kiemnhiem = $this->Template->load_textbox(array("name"=>"data[kiemnhiem]","id"=>"kiemnhiem","value"=>"","style"=>"width:100px ; color:black;font-weight:normal;"));	
	$str_input_long_dong_bh = $this->Template->load_textbox(array("name"=>"data[dong_bh]","id"=>"dong_bh","value"=>"","style"=>"width:100px ; color:black;font-weight:normal;"));	

	$array_salary_maternity_1 =  array(
		"Stt"=>array("$i",array( "style"=>"text-align:center; width:3%")),
		"maso"=>array("maso".$i ,array("style"=>"text-align:center; width:8%;")),
		"ht"=>array("Nguyễn văn ".$i,array("style"=>"text-align:center; width:13%;white-space: nowrap")),						
		"cmnn"=>array("205661379",array("style"=>"text-align:center; width:6%")),
		"tk"=>array("101866761765",array("style"=>"text-align:center; width:6%;")),
		"thamnien"=>array("4",array("style"=>"text-align:center; width:10%;")),
		"luong_tg"=>array("30000",array("style"=>"text-align:center; width:10%;")),						
		"luong_hanhchinh"=>array("50000",array("style"=>"text-align:center; width:6%;")),
		

		
		"luong_150"=>array("150000",array("style"=>"text-align:center; width:6%;")),
		"luong_200"=>array("200000",array("style"=>"text-align:center; width:10%;")),
		"luong_300"=>array("300000",array("style"=>"text-align:center; width:10%;")),						
		"tongluong_thoigian"=>array("630000",array("style"=>"text-align:center; width:6%;")),
		
		"chuyencan"=>array("300000",array("style"=>"text-align:center; width:6%;")),
		"trocap"=>array("200000",array("style"=>"text-align:center; width:10%;")),
		"trachnhiem"=>array($str_input_trachnhiem,array("style"=>"text-align:center; width:10%;")),						
		"phucap_luong"=>array($str_input_phucap_luong,array("style"=>"text-align:center; width:6%;")),

		"kiemnhiem"=>array($str_input_kiemnhiem,array("style"=>"text-align:center; width:6%;")),
		"luong_cb"=>array($str_input_luong_cb,array("style"=>"text-align:center; width:10%;")),
		"luong_dong_bh"=>array($str_input_long_dong_bh,array("style"=>"text-align:center; width:10%;")),	

		"thuong_nangxuat"=>array("200000",array("style"=>"text-align:center; width:10%;")),
		"luong_phepnam"=>array("300000",array("style"=>"text-align:center; width:10%;")),						
		"luong_om"=>array("30000",array("style"=>"text-align:center; width:6%;")),
		
		"dienthoai"=>array("300000",array("style"=>"text-align:center; width:6%;")),
		"tiensua"=>array("200000",array("style"=>"text-align:center; width:10%;")),
		"xang_congtac"=>array("300000",array("style"=>"text-align:center; width:10%;")),						
		"tongluong"=>array("7500000",array("style"=>"text-align:center; width:6%;")),


		"dieuchinh"=>array("150000",array("style"=>"text-align:center; width:6%;")),
		"dongphuc"=>array("200000",array("style"=>"text-align:center; width:10%;")),
		"songay"=>array("15",array("style"=>"text-align:center; width:10%;")),						
		"thanhtien"=>array("1150000",array("style"=>"text-align:center; width:6%;")),
		
		"luongung"=>array("300000",array("style"=>"text-align:center; width:6%;")),
		"dulich"=>array("200000",array("style"=>"text-align:center; width:10%;")),
		"tru_dienthoai"=>array("300000",array("style"=>"text-align:center; width:10%;")),						
		"thue_tncn"=>array("500000",array("style"=>"text-align:center; width:6%;")),

		"noiquy"=>array("150000",array("style"=>"text-align:center; width:6%;")),
		"tien_ng"=>array("200000",array("style"=>"text-align:center; width:10%;")),
		"tien_ktb"=>array("300000",array("style"=>"text-align:center; width:10%;")),						
		"kpcd"=>array("20000",array("style"=>"text-align:center; width:6%;")),
		
		"baohiem"=>array("300000",array("style"=>"text-align:center; width:3%;")),
		"tongquy"=>array("2000000",array("style"=>"text-align:center; width:10%;")),
		

		);
	$str_salary_maternity .= $this->Template->load_table_row($array_salary_maternity_1);

}



	//Đưa nội dung str_allowance vào thẻ table
$str_salary_maternity =  $this->Template->load_table($str_salary_maternity);

?>

<div id="parent">

	<?php 
	echo $str_salary_maternity;

	?>
</div>

<div class="trong" style="height: 400px;">
	
</div>


<?php 

$str_save_button =  $this->Template->load_button(array("type"=>"button","onclick"=>"luu()"),"Lưu");

?>
<div style="padding-top: : 3000px;">
	<?php  
	echo $str_save_button;	
	?>	
</div>




<script language="javascript">
	$( function() {
		$( "#salary_from" ).datepicker({dateFormat: "dd-mm-yy"});
		$( "#salary_to" ).datepicker({dateFormat: "dd-mm-yy"});
	} );

</script>