<style type="text/css">
	.input_search{
           
        } 

        .title_page{
		color: black!important;
		text-shadow:none;
	}
	.xemchitiet{
		margin-left: 30px;
	}
	.ngay{
		 border-radius: 0px;
	}
	#attendance_day{
		 border-radius: 7px;
            margin-top: 9px;
            height: 25px;
            border: 1px solid #aaaaaa;
	}
	.timkiem{
		 border-radius: 7px;
            margin-top: 9px;
            height: 25px;
            border: 1px solid #aaaaaa;
	}
</style>
<?php 																																																																																														
	//*****************************************
	//FUNCTION HEADER
	//*****************************************

$function_title = "Danh Sách Lương Sản Phẩm";
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


 $str_input_from = $this->Template->load_textbox(array("name"=>"salary_from","autocomplete"=>"off","value"=>"","id"=>"salary_from", "class"=>"day","style"=>"width:90px;"));
    $str_input_to = $this->Template->load_textbox(array("name"=>"salary_to","autocomplete"=>"off","value"=>"","id"=>"salary_to", "class"=>"day","style"=>"width:90px;"));
    





     $str_input_name_staff = $this->Template->load_textbox(array("name"=>"attendance_day","autocomplete"=>"off","value"=>"","id"=>"attendance_day", "placeholder"=>"Nhập tên nhân viên"));
   

   // $str_btn_save = $this->Template->load_button(array("type"=>"submit",),"<p class = 'text_tk'>Tìm kiếm</p>");
    $str_btn_save = "<input type='submit' class='timkiem'value='Tìm kiếm' style='font-size: 13.4px'>";

    $str_input_attendance_day =" Từ ngày:  $str_input_from &nbsp &nbsp Đến ngày: $str_input_to <br/>&nbsp<br/>Phòng ban: $str_select_department &nbsp &nbsp Chức vụ: $str_select_position  &nbsp &nbsp Công việc: $str_select_work &nbsp &nbsp &nbspNhà máy: $str_select_factory &nbsp &nbsp Phân xưởng: $str_select_part <br/>  Nhập tên nhân viên: $str_input_name_staff $str_btn_save <br/>&nbsp";
   

   echo $str_input_attendance_day;
    //tạo nút tìm




////////////////////////
$str_salary_product = "";

	//1: tao mang table header 	
$array_header_salary_product=  array("Stt"=>array("STT",array("style"=>"text-align:left; width:3%")),
	"mnv"=>array("Mã nhân viên ",array("style"=>"text-align:left; width:8%")),
	"hoten"=>array("Họ & tên",array("style"=>"text-align:center; width:12%;white-space: nowrap")),						
	"phongban"=>array("Phòng ban",array("style"=>"text-align:left; width:8%")),
	

	"tong_lnt"=>array("Tổng lương ngày thường",array("style"=>"text-align:center; width:8%")),						
	"tong_lcn"=>array("Tổng lương ngày chủ nhật",array("style"=>"text-align:left; width:8%")),
	"tongluong"=>array("Tổng lương",array("style"=>"text-align:left; width:8%")),
	
	"chucnang"=>array("Chức năng",array("style"=>"text-align:left; width:5%")),
	
	
	
	);

	//2: lấy dòng tr header
$str_salary_product = $this->Template->load_table_header($array_header_salary_product);

	//lấy dòng nội dung table
  $str_btn_chitiet = "<input type='submit' class='xemchitiet'value='Xem chi tiết' style='font-size: 13.4px'>";
for ($i=1; $i <10 ; $i++) { 
	


$array_salary_product=  array("Stt"=>array($i,array("style"=>"text-align:left; width:3%")),
	"maso"=>array("maso".$i,array("style"=>"text-align:left; width:5%")),
	"hoten"=>array("Nguyen van ".$i,array("style"=>"text-align:center; width:15%;white-space: nowrap")),						
	"phongban"=>array("PRO-Sảnxuất",array("style"=>"text-align:left; width:8%")),
	
	"tong_lnt"=>array("20000000 ".$i,array("style"=>"text-align:center; width:8%")),						
	"tong_lcn"=>array("5000000",array("style"=>"text-align:left; width:8%")),
	"tongluong"=>array("25000000",array("style"=>"text-align:left; width:8%")),
	"chucnang"=>array($str_btn_chitiet,array("style"=>"text-align:left; width:5%")),
	);
$str_salary_product .= $this->Template->load_table_row($array_salary_product);

}

	//Đưa nội dung str_allowance vào thẻ table
$str_salary_product =  $this->Template->load_table($str_salary_product);
echo $str_salary_product;	

				

?>
<script language="javascript">
    $( function() {
        $( "#salary_from" ).datepicker({dateFormat: "dd-mm-yy"});
		$( "#salary_to" ).datepicker({dateFormat: "dd-mm-yy"});
    } );
   
</script>
