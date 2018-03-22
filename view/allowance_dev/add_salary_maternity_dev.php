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

$function_title = "Nhập Lương Thai Sản";
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









//*********************************************

$str_salary_maternity = "";

	//1: tao mang table header 	
$array_header_salary_maternity =  array(
	"Stt"=>array("STT",array("style"=>"text-align:left; width:3%")),
	"ms"=>array("Mã nhân viên",array("style"=>"text-align:left; width:3%")),
	"ht"=>array("Họ & tên",array("style"=>"text-align:left; width:20%")),
	"cmnn"=>array("Số CMNN",array("style"=>"text-align:left; width:10%")),
	"tk"=>array("Số TK",array("style"=>"text-align:left; width:4%;")),
	"tien_thaisan"=>array("Tiền thai sản(BHXH  chi trả)",array("style"=>"text-align:left; width:10%;")),
	"phucap_thaisan"=>array("Phụ Cấp Thai Sản (công ty chi trả)",array("style"=>"text-align:left; width:10%;")),
	"tongluong"=>array("Tổng Lương",array("style"=>"text-align:left; width:10%")),
	
	);



	//2: lấy dòng tr header
$str_salary_maternity = $this->Template->load_table_header($array_header_salary_maternity);



for($i=1;$i<11;$i++)
{
	
	$str_input_tien_thaisan = $this->Template->load_textbox(array("name"=>"data[tien_thaisan]","id"=>"tien_thaisan","value"=>"","style"=>"width:100px"));
	$str_input_phucap_thaisan = $this->Template->load_textbox(array("name"=>"data[phucap_thaisan]","id"=>"phucap_thaisan","value"=>"","style"=>"width:100px"));
	
	
	
	
	
//lấy dòng nội dung table
	$array_salary_maternity_1 =  array(
		"Stt"=>array("$i",array( "style"=>"text-align:left; width:3%")),
		"maso"=>array("maso".$i ,array("style"=>"text-align:left; width:3%;")),
		"ht"=>array("Nguyễn văn ".$i,array("style"=>"text-align:center; width:13%;white-space: nowrap")),						
		"cmnn"=>array("205661379",array("style"=>"text-align:left; width:6%")),
		"tk"=>array("101866761765",array("style"=>"text-align:left; width:6%;")),
		"tien_thaisan"=>array($str_input_tien_thaisan,array("style"=>"text-align:left; width:4%;")),
		"phucap_thaisan"=>array($str_input_phucap_thaisan,array("style"=>"text-align:center; width:6%;")),						
		"tongluong"=>array("50000",array("style"=>"text-align:left; width:6%;")),
		
		





		);
	$str_salary_maternity .= $this->Template->load_table_row($array_salary_maternity_1);

}

    

	//Đưa nội dung str_allowance vào thẻ table
$str_salary_maternity =  $this->Template->load_table($str_salary_maternity);


 
echo $str_salary_maternity;	

$str_save_button =  $this->Template->load_button(array("type"=>"button","onclick"=>"luu()"),"Lưu");
	$str_salary_maternity = $this->Template->load_form_row(array("title"=>"","input"=>$str_save_button));		

echo $str_salary_maternity;		
?>
