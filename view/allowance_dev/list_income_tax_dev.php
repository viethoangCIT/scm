<style type="text/css">
	/*.input_search{
            border-radius: 7px;
            margin-top: 9px;
            height: 25px;
            border: 1px solid #aaaaaa;
        } */

        .title_page{
		color: black!important;
		text-shadow:none;
	}

		.table-responsive{
		overflow: scroll!important;
	}
	.tbl_r{
		height: 300px;
	}
/*	.xemchitiet{
		margin-left: 30px;
	}*/
</style>
<?php 																																																																																														
	//*****************************************
	//FUNCTION HEADER
	//*****************************************

$function_title = "Danh Sách Thuế Thu Nhập Cá Nhân Tạm Tính";
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

    $str_input_attendance_day =" Phòng ban: $str_select_department &nbsp &nbsp Chức vụ: $str_select_position  &nbsp &nbsp Công việc: $str_select_work &nbsp &nbsp &nbspNhà máy: $str_select_factory &nbsp &nbsp Phân xưởng: $str_select_part <br/>  Nhập tên nhân viên: $str_input_name_staff $str_btn_save";
   

   echo $str_input_attendance_day;
    //tạo nút tìm




////////////////////////
$str_salary_product = "";

	//1: tao mang table header 	



$array_header_salary_product_1=  array("Stt"=>array("",array("style"=>"text-align:left; width:3%","rowspan"=>"4")),
	"mnv"=>array("",array("style"=>"text-align:left; width:5%","rowspan"=>"4")),
	"hoten"=>array("",array("style"=>"text-align:center; width:15%;white-space: nowrap","rowspan"=>"4")),						
	"ktbanthan"=>array("",array("style"=>"text-align:left; width:8%","rowspan"=>"4")),
	"Số nguoi"=>array("Khấu Trừ Người Phụ Thuộc",array("style"=>"text-align:left; width:5%","colspan"=>"2")),

	// "onhap"=>array("Thành tiền",array("style"=>"text-align:center; width:8%")),						
	"tongluong"=>array("",array("style"=>"text-align:left; width:8%")),
	"phucap_ca3"=>array("",array("style"=>"text-align:left; width:8%")),
	
	"luongom"=>array("",array("style"=>"text-align:left; width:8%")),
	"tiensua"=>array("",array("style"=>"text-align:center; width:8%")),						
	"tienxang"=>array("",array("style"=>"text-align:left; width:8%")),
	"tongquy"=>array("" ,array("style"=>"text-align:center; width:8%")),						
	"baohiem"=>array("",array("style"=>"text-align:left; width:8%")),
	"dienthoai"=>array("",array("style"=>"text-align:left; width:8%")),
	
	"thunhap_tt"=>array("",array("style"=>"text-align:left; width:8%")),
	"noiquy"=>array("",array("style"=>"text-align:center; width:8%")),						
	
	"5"=>array("Thuế Suất" ,array("style"=>"text-align:left; width:8%","colspan"=>"4")),
	"10"=>array("" ,array("style"=>"text-align:left; width:8%")),
	"chucnang"=>array("" ,array("style"=>"text-align:left; width:8%")),
	
);


$array_header_salary_product_2=  
array(
	"Số nguoi"=>array("Số người",array("style"=>"text-align:left; width:5%","rowspan"=>"3")),

	"thanhtien"=>array("Thành tiền",array("style"=>"text-align:center; width:8%")),						
	"tongluong"=>array("",array("style"=>"text-align:left; width:8%")),
	"phucap_ca3"=>array("",array("style"=>"text-align:left; width:8%")),
	
	"luongom"=>array("",array("style"=>"text-align:left; width:8%")),
	"tiensua"=>array("",array("style"=>"text-align:center; width:8%")),						
	"tienxang"=>array("",array("style"=>"text-align:left; width:8%")),
	"tongquy"=>array("" ,array("style"=>"text-align:center; width:8%")),						
	"baohiem"=>array("",array("style"=>"text-align:left; width:8%")),
	"dienthoai"=>array("",array("style"=>"text-align:left; width:8%")),
	
	"noiquy"=>array("",array("style"=>"text-align:left; width:8%")),
	"thunhap_tt"=>array("",array("style"=>"text-align:center; width:8%")),						
	"5"=>array("" ,array("style"=>"text-align:left; width:8%")),
	"5"=>array("5%" ,array("style"=>"text-align:left; width:8%")),
	"10"=>array("10%" ,array("style"=>"text-align:left; width:8%")),
	
	"15"=>array("15%" ,array("style"=>"text-align:left; width:8%")),
	"20"=>array("20%",array("style"=>"text-align:center; width:8%")),						
	"tongtien"=>array(" ",array("style"=>"text-align:left; width:8%")),
	"chucnang"=>array("" ,array("style"=>"text-align:left; width:8%")),
);
	
$array_header_salary_product_3=  
array("Stt"=>array("STT",array("style"=>"text-align:left; width:3%")),
	"mnv"=>array("Mã nhân viên",array("style"=>"text-align:left; width:5%")),
	"hoten"=>array("Họ & tên",array("style"=>"text-align:center; width:15%;white-space: nowrap")),						
	"ktbanthan"=>array("KT Bản thân",array("style"=>"text-align:left; width:8%")),
	

	"onhap"=>array("5000" ,array("style"=>"text-align:center; width:8%")),						
	"tongluong"=>array("Tổng lương",array("style"=>"text-align:left; width:8%")),
	"phucap_ca3"=>array("Phụ cấp ca 3",array("style"=>"text-align:left; width:8%")),
	
	"luongom"=>array("Lương nghỉ ốm đâu  (BHXH)",array("style"=>"text-align:left; width:8%")),
	"tiensua"=>array("Tiền sữa",array("style"=>"text-align:center; width:8%")),						
	"tienxang"=>array("Tiền xăng đi công tác ",array("style"=>"text-align:left; width:8%")),
	"tongquy"=>array("Tổng quỹ " ,array("style"=>"text-align:center; width:8%")),						
	"baohiem"=>array("BHXH, BHYT",array("style"=>"text-align:left; width:8%")),
	"dienthoai"=>array("Trừ tiền điện thoại ",array("style"=>"text-align:left; width:8%")),
	"noiquy"=>array("Vi phạm nội quy ",array("style"=>"text-align:left; width:8%")),
	"thunhap_tt"=>array("Thu nhập tính thuế",array("style"=>"text-align:left; width:8%")),
	
	"5"=>array("5000" ,array("style"=>"text-align:left; width:3%")),
	"10"=>array("10000" ,array("style"=>"text-align:left; width:3%")),
	
	"15"=>array("15000",array("style"=>"text-align:left; width:3%")),
	"20"=>array("20000" ,array("style"=>"text-align:center; width:3%")),						
	"tongtien"=>array("Tổng Tiền Thuế TNCN Tạm Tính",array("style"=>"text-align:left; width:15%")),
	"chucnang"=>array("Chức năng" ,array("style"=>"text-align:left; width:8%")),
	
	
	
	);

	//2: lấy dòng tr header
$str_salary_product = $this->Template->load_table_header($array_header_salary_product_1);
$str_salary_product .= $this->Template->load_table_header($array_header_salary_product_2);
$str_salary_product .= $this->Template->load_table_header($array_header_salary_product_3);

	//lấy dòng nội dung table


$link_sua='';
     $link_xoa="";
     $link_sua  = $this->Template->load_link("edit","Sửa",$link_sua);
     $link_xoa  = $this->Template->load_link("del","Xóa",$link_xoa);
     $link_action = $link_xoa . $link_sua;

  
for ($i=1; $i <10 ; $i++) { 


$array_salary_product=  array("Stt"=>array($i,array("style"=>"text-align:left; width:3%")),
	"maso"=>array("maso".$i,array("style"=>"text-align:left; width:5%")),
	"hoten"=>array("Nguyen van ".$i,array("style"=>"text-align:center; width:15%;white-space: nowrap")),						
	"ktbanthan"=>array("15000",array("style"=>"text-align:left; width:8%")),
	"songuoi"=>array("4",array("style"=>"text-align:left; width:5%")),
	"thanhtien"=>array("4000000",array("style"=>"text-align:center; width:8%")),						
	"tongluong"=>array("500000",array("style"=>"text-align:left; width:8%")),
	"phucap_ca3"=>array("25000",array("style"=>"text-align:left; width:8%")),
	"luongom"=>array("30000",array("style"=>"text-align:left; width:8%")),
	"tiensua"=>array("25000",array("style"=>"text-align:left; width:8%")),
	"tienxang"=>array("45000",array("style"=>"text-align:left; width:8%")),
	"tongquy"=>array("7000000",array("style"=>"text-align:left; width:8%")),
	"baohiem"=>array("5000",array("style"=>"text-align:left; width:8%")),
	"dienthoai"=>array("25000",array("style"=>"text-align:left; width:8%")),
	"noiquy"=>array("15000",array("style"=>"text-align:left; width:8%")),
	"thunhap_tt"=>array("7000000",array("style"=>"text-align:left; width:8%")),
	"5"=>array("5000",array("style"=>"text-align:left; width:8%")),
	"10"=>array("10000",array("style"=>"text-align:left; width:8%")),
	"15"=>array("15000",array("style"=>"text-align:left; width:8%")),
	"20"=>array("20000",array("style"=>"text-align:left; width:8%")),
	"tongtien"=>array("50000",array("style"=>"text-align:left; width:8%")),
	"chucnang"=>array("$link_action",array("style"=>"text-align:left; width:8%")),
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
