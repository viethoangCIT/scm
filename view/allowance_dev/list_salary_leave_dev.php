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

$function_title = "Danh Sách Lương Thôi Việc";
echo $this->Template->load_function_header($function_title);

	//*****************************************
	//END FUNCTION HEADER
	//*****************************************



$arrray_deparment =array("0"=>"BGĐ-Ban giám đốc", "1"=>"ISO-Quy trình", "3"=>"PRO-Sản xuất","4"=>"HR-Nhân sự", "5"=>"QC-Chất lượng", "6"=>"PE-Kỹ thuật", "7"=>"PUR-Mua hàng","8" =>"SALE-Kinh doanh", "9"=>"WH-Kho");    
      $str_select_department = $this->Template->load_selectbox_basic(array("name"=>"department","autocomplete"=>"off","value"=>"","id"=>"department"),$arrray_deparment);

                // lọc theo nhà máy
    $arrray_factory=  array("0"=>"SCM1", "1"=>"SCM2", "2"=>"SCM3");
    $str_select_factory    =  $this->Template->load_selectbox_basic(array("name"=>"factory","autocomplete"=>"off","value"=>"","id"=>"factory","style"=>"width:100px"),$arrray_factory);

                // lọc theo công việc
    $array_work =array("0"=>"Giám sát", "1"=>"Quản lý", "3"=>"Phụ trách","4"=>"Tính lương", "5"=>"Báo giá", "6"=>"Khai thuế", "7"=>"Lắp ráp","8" =>"Toàn kiểm", "9"=>"Kiểm hàng","10"=>"Đứng máy");
    $str_select_work = $this->Template->load_selectbox_basic(array("name"=>"work","autocomplete"=>"off","value"=>"","id"=>"work"),$array_work);

                // lọc theo chức vụ
    $array_position =array("0"=>"Giám đốc", "1"=>"P.Giám đốc", "3"=>"Trưởng phòng","4"=>"Phó phòng", "5"=>"Trưởng bộ phận", "6"=>"NV phụ trách", "7"=>"Tổ trưởng","8" =>"Tổ phó", "9"=>"Trưởng ca","10"=>"Phó ca","11"=>"Nhân viên","12"=>"Công dân"); 
    $str_select_position = $this->Template->load_selectbox_basic(array("name"=>"position","autocomplete"=>"off","value"=>"","id"=>"position"),$array_position);

            // lọc theo phân xưởng
    $arrray_part =array("0"=>"Anten 1", "1"=>"Molding 1", "3"=>"Solar","4"=>"Silicon", "5"=>"Electronic", "6"=>"Anten 2", "7"=>"Molding 2");
     $str_select_part = $this->Template->load_selectbox_basic(array("name"=>"part","autocomplete"=>"off","value"=>"","id"=>"part"),$arrray_part);



    





     $str_input_name_staff = $this->Template->load_textbox(array("name"=>"attendance_day","autocomplete"=>"off","value"=>"","id"=>"attendance_day", "placeholder"=>"Nhập tên nhân viên"));
   

   // $str_btn_save = $this->Template->load_button(array("type"=>"submit",),"<p class = 'text_tk'>Tìm kiếm</p>");
    $str_btn_save = "<input type='submit' class='timkiem'value='Tìm kiếm' style='font-size: 13.4px'>";

    $str_input_attendance_day ="Phòng ban: $str_select_department &nbsp &nbsp Chức vụ: $str_select_position  &nbsp &nbsp Công việc: $str_select_work &nbsp &nbsp &nbspNhà máy: $str_select_factory &nbsp &nbsp Phân xưởng: $str_select_part <br/>  Nhập tên nhân viên: $str_input_name_staff $str_btn_save";
   

   echo $str_input_attendance_day;
    //tạo nút tìm



//***************************************************
$str_salary_maternity = "";

	//1: tao mang table header 	
$array_header_salary_maternity =  array(
	"Stt"=>array("STT",array("style"=>"text-align:left; width:3%")),
	"ms"=>array("Mã nhân viên",array("style"=>"text-align:left; width:3%")),
	"ht"=>array("Họ & tên",array("style"=>"text-align:left; width:20%")),
	"cmnn"=>array("Số CMNN",array("style"=>"text-align:left; width:10%")),
	"tk"=>array("Số TK",array("style"=>"text-align:left; width:4%;")),
	"thamnien"=>array("Thâm niên",array("style"=>"text-align:left; width:10%;")),
	"bophan"=>array("Bộ phận",array("style"=>"text-align:left; width:10%;")),
	"luong_thoigian"=>array("Lương thời gian",array("style"=>"text-align:left; width:10%")),
	"luong_sanpham"=>array("Lương sản phẩm",array("style"=>"text-align:left; width:10%")),
	"phucap_ca3"=>array("Phụ cấp ca 3",array("style"=>"text-align:left; width:3%")),
	"luong_tangca150"=>array("Lương tăng ca 150%",array("style"=>"text-align:left; width:3%")),
	"luong_tangca200"=>array("Lương tăng ca 200%",array("style"=>"text-align:left; width:20%")),
	"tiensua"=>array("Tiền Sữa",array("style"=>"text-align:left; width:10%")),
	"luong_nghi"=>array("Lương nghỉ BHXH hàng tháng ",array("style"=>"text-align:left; width:4%;")),
	"xang"=>array("Xăng công tác",array("style"=>"text-align:left; width:10%;")),
	"tongluong"=>array("Tổng lương ",array("style"=>"text-align:left; width:10%;")),
"luong_dieuchinh"=>array("Điều chỉnh lương tháng trước ",array("style"=>"text-align:left; width:10%")),
	"tru_bhxh"=>array("Trừ BHXH",array("style"=>"text-align:left; width:10%")),
	"tien_daotao"=>array("Trừ tiền đào tạo",array("style"=>"text-align:left; width:4%;")),
	"tien_noiquy"=>array("Trừ vi phạm nội quy ",array("style"=>"text-align:left; width:10%;")),
	"tien_ng"=>array("Trừ tiền NG  ",array("style"=>"text-align:left; width:10%;")),
"tien_dongphuc"=>array("Trừ tiền đồng phục ",array("style"=>"text-align:left; width:10%")),
	"thuclanh"=>array("Thực lãnh ",array("style"=>"text-align:left; width:10%")),
	
	
	);



	//2: lấy dòng tr header
$str_salary_maternity = $this->Template->load_table_header($array_header_salary_maternity);


for($i=1;$i<11;$i++)
{
	
	
	
	
	
//lấy dòng nội dung table
	$array_salary_maternity_1 =  array(
		"Stt"=>array("$i",array( "style"=>"text-align:left; width:3%")),
		"maso"=>array("maso".$i ,array("style"=>"text-align:left; width:3%;")),
		"ht"=>array("Nguyễn văn ".$i,array("style"=>"text-align:center; width:13%;white-space: nowrap")),						
		"cmnn"=>array("205661379",array("style"=>"text-align:left; width:6%")),
		"tk"=>array("101866761765",array("style"=>"text-align:left; width:6%;")),
		"thamnien"=>array("60",array("style"=>"text-align:left; width:10%;")),
	"bophan"=>array("PRO-Sảnxuất",array("style"=>"text-align:left; width:10%;")),
	"luong_thoigian"=>array("2000000",array("style"=>"text-align:left; width:10%")),
	"luong_sanpham"=>array("1000000",array("style"=>"text-align:left; width:10%")),
	"phucap_ca3"=>array("500000",array("style"=>"text-align:left; width:3%")),
	"luong_tangca150"=>array("150000",array("style"=>"text-align:left; width:3%")),
	"luong_tangca200"=>array("200000",array("style"=>"text-align:left; width:20%")),
	"tiensua"=>array("50000",array("style"=>"text-align:left; width:10%")),
	"luong_nghi"=>array("50000 ",array("style"=>"text-align:left; width:4%;")),
	"xang"=>array("50000",array("style"=>"text-align:left; width:10%;")),
	"tongluong"=>array("7000000 ",array("style"=>"text-align:left; width:10%;")),
"luong_dieuchinh"=>array("1000000",array("style"=>"text-align:left; width:10%")),
	"tru_bhxh"=>array("500000",array("style"=>"text-align:left; width:10%")),
	"tien_daotao"=>array("100000",array("style"=>"text-align:left; width:4%;")),
	"tien_noiquy"=>array("50000 ",array("style"=>"text-align:left; width:10%;")),
	"tien_ng"=>array("50000  ",array("style"=>"text-align:left; width:10%;")),
"tien_dongphuc"=>array("100000 ",array("style"=>"text-align:left; width:10%")),
	"thuclanh"=>array("5200000 ",array("style"=>"text-align:left; width:10%")),
	

		);
	$str_salary_maternity .= $this->Template->load_table_row($array_salary_maternity_1);

}

    

	//Đưa nội dung str_allowance vào thẻ table
$str_salary_maternity =  $this->Template->load_table($str_salary_maternity);


 
echo $str_salary_maternity;	


?>
