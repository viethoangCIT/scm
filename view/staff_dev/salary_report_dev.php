<style>
table{ width: 50%}

tr:hover td, tr.hover td { background-color: #F90 }
td.selected { background-color: green; } 
tr:hover td.selected { background-color: lime; }

#search_bar{
  margin-bottom: -30px;
}
#parent {
	min-height: 200px;
	max-height: 450px;
	height: auto;
	position: absolute;
    width: 100%;
    left: 0;
	margin-left:5px;
	overflow:scroll;
	margin-top: 70px;
	
}
			
#table_salary {
				width: 1800px !important;
}

#table_salary td.selected { border: 1px solid #F00; }
  .title_page{
    color: black!important;
    text-shadow:none;
  }
  .timkiem{
    border-radius:5px;
    background-color: #fcfcfc;
  }
</style>
<?php
 $function_title = "Bảng tổng hợp lương";
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

     $str_btn_save = "<input type='submit' class='timkiem'value='Tìm kiếm' style='font-size: 13.4px; margin-top:10px'>";
	$str_label_from = $this->Template->load_label("Từ ngày: ","","search_list");
	$str_label_to = $this->Template->load_label("Đến ngày: ","","search_list");
	$str_label_department = $this->Template->load_label("Phòng ban: ","","search_list");
	$str_label_position = $this->Template->load_label("Chức vụ: ","","search_list");		
	$str_label_job = $this->Template->load_label("Công việc: ","","search_list");		
	$str_label_factory = $this->Template->load_label("Nhà máy: ","","search_list");		
	$str_label_manufactory = $this->Template->load_label("Phân xưởng: ","","search_list");		

   	
    $str_input_attendance_day ="<div id = 'search_bar'>Từ ngày: $str_input_from Đến ngày: $str_input_to <br /> Phòng ban:   $str_select_department &nbsp &nbsp Chức vụ:  $str_select_position &nbsp &nbsp Công việc: $str_select_work &nbsp &nbsp Nhà máy: $str_select_factory &nbsp &nbsp Phân xưởng: $str_select_part &nbsp $str_btn_save</div>";
   

   echo $str_input_attendance_day;
    //tạo nút tìm
  
   

$array_table_header_salary =  array("stt"=>array("STT",array("style"=>"text-align:center; width:3%")),
                                        "type"=>array("HẠNG MỤC",array("style"=>"text-align:center")),
                                        "live"=>array("TRỰC TIẾP",array("style"=>"text-align:center")),
                                    "atm"=>array("ATM",array("style"=>"text-align:center;width:10%")),
                                    "total"=>array("TỔNG CHI",array("style"=>"text-align:center;width:10%"))
                                     );
	$array_table_report_salary=  array("1"=>array("name"=>"TỔNG LƯƠNG", "tructiep"=>"300", "atm"=>"500", "tongchi"=>"800"),
		"2"=>array("name"=>"ĐIỀU CHỈNH THÁNG TRƯỚC", "tructiep"=>"400", "atm"=>"800", "tongchi"=>"1200"),
		"3"=>array("name"=>"ỨNG (NẾU CÓ)", "tructiep"=>"500", "atm"=>"500", "tongchi"=>"1000"),
		"4"=>array("name"=>"TRỪ CHI PHÍ ĐÀO TẠO", "tructiep"=>"500", "atm"=>"500", "tongchi"=>"1000"),
		"5"=>array("name"=>"BHXH", "tructiep"=>"500", "atm"=>"400", "tongchi"=>"1000"),
		"6"=>array("name"=>"THUẾ TNCN TẠM TÍNH", "tructiep"=>"500", "atm"=>"500", "tongchi"=>"1000"),
		"7"=>array("name"=>"LƯƠNG GIỮ LẠI GỐI ĐẦU", "tructiep"=>"550", "atm"=>"500", "tongchi"=>"1050"),
		"8"=>array("name"=>"TRỪ TIỀN MƯỢN", "tructiep"=>"500", "atm"=>"600", "tongchi"=>"1100"),
		"9"=>array("name"=>"ĐỒNG PHỤC", "tructiep"=>"508", "atm"=>"400", "tongchi"=>"908"),
		"10"=>array("name"=>"TRỪ TIỀN ĐIỆN THOẠI", "tructiep"=>"540", "atm"=>"100", "tongchi"=>"640"),
		"11"=>array("name"=>"VI PHẠM NỘI QUY", "tructiep"=>"400", "atm"=>"500", "tongchi"=>"900"),
		"12"=>array("name"=>"NG + KBT + KPCĐ (ATN2)", "tructiep"=>"500", "atm"=>"500", "tongchi"=>"1000"),
		"13"=>array("name"=>"NG +KBT +KPCĐ(XƯỞNG NHỰA)", "tructiep"=>"200", "atm"=>"100", "tongchi"=>"300"),
		
		);
	 $str_table_row_salary = "";
  foreach ($array_table_report_salary as $key=> $salary) {
      # code...
  
        // dùng hàm load table row để lấy nội dung cho bảng
        $array_table_salary =  array("stt"=>array("$key",array("style"=>"text-align:center; width:3%")),
                                            "type"=>array($salary["name"],array("style"=>"text-align:center")),
                                            "live"=>array($salary["tructiep"],array("style"=>"text-align:center")),
                                             "atm"=>array($salary["atm"],array("style"=>"text-align:center")),
                                              "total"=>array($salary["tongchi"],array("style"=>"text-align:center")),
                                        );
                                  
	$str_table_row_salary .= $this->Template->load_table_row($array_table_salary);
   }
 
  	  // thực lãnh
    $array_table_thuclanh =  array( "thuclanh"=>array("THỰC LÃNH",array("style"=>"width:25%; text-align:center;", "colspan"=>"2")),
                                   "live"=>array("0 đ",array("style"=>"width:25%; text-align:center")),
                                    "atm"=>array("0 đ",array("style"=>"width:25%; text-align:center")),
                                    "total"=>array("0 đ",array("style"=>"width:25%; text-align:center;"))
                            );
     $str_table_row_salary .= $this->Template->load_table_row($array_table_thuclanh); 
       // nhập quỹ
    $array_table_nhapquy =  array( "nhapquy"=>array("TỔNG TIỀN NG NHẬP QUỸ",array("style"=>"width:25%; text-align:center;", "colspan"=>"2")),
                                   "live"=>array("0 đ",array("style"=>"width:25%; text-align:center")),
                                    "atm"=>array("0 đ",array("style"=>"width:25%; text-align:center")),
                                    "total"=>array("0 đ",array("style"=>"width:25%; text-align:center;"))
                            );
     $str_table_row_salary .= $this->Template->load_table_row($array_table_nhapquy); 
       // thực CHI
    $array_table_thucchi =  array( "thucchi"=>array("THỰC CHI",array("style"=>"width:25%; text-align:center;", "colspan"=>"2")),
                                   "live"=>array("0 đ",array("style"=>"width:25%; text-align:center")),
                                    "atm"=>array("0 đ",array("style"=>"width:25%; text-align:center")),
                                    "total"=>array("0 đ",array("style"=>"width:25%; text-align:center;"))
                            );
     $str_table_row_salary .= $this->Template->load_table_row($array_table_thucchi); 	 

	  $str_table_row_salary .= $this->Template->load_table_header($array_table_header_salary,array("class"=>"hover-row","title"=>$key,"on"));
     $str_table_salary =  $this->Template->load_table($str_table_row_salary );
 	

	echo "<br><br>";
   echo $str_table_salary; 
  ?>
    
<script language="javascript">
    $( function() {
        $( "#salary_from" ).datepicker({dateFormat: "dd-mm-yy"});
		$( "#salary_to" ).datepicker({dateFormat: "dd-mm-yy"});
    } );
   
</script>