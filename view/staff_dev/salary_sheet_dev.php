<style>
table{ width: 50%}

tr:hover td, tr.hover td { background-color: #F90 }
td.selected { background-color: green; } 
tr:hover td.selected { background-color: lime; }
.title_page{
    color: black!important;
    text-shadow:none;
  }
  .timkiem{
    
    border-radius:5px;
    background-color: #fcfcfc;
  }
  .in{
    width: 120px;
    margin-left: 10px;
    border-radius:5px;
    background-color: #fcfcfc;
    margin-top: 15px;
  }
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
</style>
<?php
 $function_title = "Phiếu Lương";
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
    // nhập mã nhân viên
    $array_staff = array("1"=>"Nguyễn Văn An","2"=>"Lê Thị Hà","3"=>"Trần Văn Hùng","4"=>"Lê Thị Hồng");

    $str_input_staffcode = $this->Template->load_selectbox_basic(array("name"=>"staffcode","autocomplete"=>"off","value"=>"","id"=>"staffcode", "style"=>"width:130px"),$array_staff);

    $str_input_from = $this->Template->load_textbox(array("name"=>"salary_from","autocomplete"=>"off","value"=>"","id"=>"salary_from", "class"=>"day","style"=>"width:90px; margin-bottom:10px"));
    $str_input_to = $this->Template->load_textbox(array("name"=>"salary_to","autocomplete"=>"off","value"=>"","id"=>"salary_to", "class"=>"day","style"=>"width:90px;"));
 $str_btn_save = "<input type='submit' class='timkiem'value='Tìm kiếm' style='font-size: 13.4px; margin-top:10px'>";
 $str_input_name_staff = $this->Template->load_textbox(array("name"=>"attendance_day","autocomplete"=>"off","value"=>"","id"=>"attendance_day", "placeholder"=>"Nhập tên nhân viên", "style"=>"border-radius: 7px;margin-top: 9px; height: 25px; border: 1px solid #aaaaaa;"));
  
 $str_btn_xuat_excel = "<input type='submit' class='in'value='Xuất excel' style='font-size: 15px; '>";
  $str_btn_in = "<input type='submit' class='in'value='In' style='font-size: 15px; '>";


 /* $str_label_from = $this->Template->load_label("Từ ngày: ","","search_list");
  $str_label_to = $this->Template->load_label("Đến ngày: ","","search_list");
  $str_label_department = $this->Template->load_label("Phòng ban: ","","search_list");
  $str_label_position = $this->Template->load_label("Chức vụ: ","","search_list");    
  $str_label_job = $this->Template->load_label("Công việc: ","","search_list");   
  $str_label_factory = $this->Template->load_label("Nhà máy: ","","search_list");   
  $str_label_manufactory = $this->Template->load_label("Phân xưởng: ","","search_list");  */  

    
   $str_input_attendance_day ="<div id = 'search_bar'>Từ ngày: $str_input_from Đến ngày: $str_input_to  $str_btn_xuat_excel $snp  $str_btn_in <br /> Phòng ban:   $str_select_department &nbsp &nbsp Chức vụ:  $str_select_position &nbsp &nbsp Công việc: $str_select_work &nbsp &nbsp Nhà máy: $str_select_factory &nbsp &nbsp Phân xưởng: $str_select_part &nbsp <br />Nhập tên nhân viên: $str_input_name_staff $str_btn_save</div>";
   
   

   echo $str_input_attendance_day;
   

     $str_table_row_salary = "";

     //tên
     $array_table_main_name =  array( "name"=>array("Họ & tên",array("style"=>"font-weight:bold ;width:25%; text-align:center;")),
                                   "name_value"=>array("Trần Thanh Bình  ",array("style"=>"font-weight:bold; width:25%; text-align:center")),
                                    "code"=>array("MÃ SỐ",array("style"=>"font-weight:bold; width:25%; text-align:center")),
                                    "code_value"=>array("031",array("style"=>"font-weight:bold; width:25%; text-align:center;"))
                            );
     $str_table_row_salary .= $this->Template->load_table_row($array_table_main_name);

     //lương hành chính
     $array_table_main_salary =  array( "main_salary"=>array("Lương hành chính",array("style"=>"width:25%; text-align:center;")),
                                   "main_salary_value"=>array("4,200,000",array("style"=>"width:25%; text-align:center")),
                                    "tienviet"=>array("Tiền viết:đ",array("style"=>"width:25%; text-align:center")),
                                    "tienviet_value"=>array("0",array("style"=>"width:25%; text-align:center;"))
                            );
	 $str_table_row_salary .= $this->Template->load_table_row($array_table_main_salary);

     // lương tăng ca
    $array_table_tangca150 =  array( "tangca150"=>array("Lương tăng ca 150%",array("style"=>"width:25%; text-align:center;")),
                                   "tangca150_value"=>array("0 đ",array("style"=>"width:25%; text-align:center")),
                                    "tienxang_congtac"=>array("Tiền xăng đi công tác",array("style"=>"width:25%; text-align:center")),
                                    "tienxang_congtac_value"=>array("200,000, đ",array("style"=>"width:25%; text-align:center;"))
                            );

     $str_table_row_salary .= $this->Template->load_table_row($array_table_tangca150);  

     // lương tăng ca 200- diều chỉnh tháng trước
    $array_table_tangca250 =  array( "tangca200"=>array("Lương tăng ca 200%",array("style"=>"width:25%; text-align:center;")),
                                   "tangca200_value"=>array("0 đ",array("style"=>"width:25%; text-align:center")),
                                    "dieuchinh_thangtruoc"=>array("Điều chỉnh tháng trước",array("style"=>"width:25%; text-align:center")),
                                    "dieuchinh_thangtruoc_value"=>array("0 đ",array("style"=>"width:25%; text-align:center;"))
                            );

     $str_table_row_salary .= $this->Template->load_table_row($array_table_tangca250);  

     // thưởng đạt chất lượng- đồng phục
      $array_table_chatluong =  array( "chatluong"=>array("Thưởng đạt chất lượng",array("style"=>"width:25%; text-align:center;")),
                                   "chatluong_value"=>array("0 đ",array("style"=>"width:25%; text-align:center")),
                                    "dongphuc_the"=>array("Đồng phục-thẻ",array("style"=>"width:25%; text-align:center")),
                                    "dongphuc_the_value"=>array("0 đ",array("style"=>"width:25%; text-align:center;"))
                            );

     $str_table_row_salary .= $this->Template->load_table_row($array_table_chatluong); 

     // chuyên cần-gối đầu
    $array_table_chatluong =  array( "chuyencan"=>array("Chuyên cần",array("style"=>"width:25%; text-align:center;")),
                                   "chuyencan_value"=>array("0 đ",array("style"=>"width:25%; text-align:center")),
                                    "goidau"=>array("Lương gối đầu",array("style"=>"width:25%; text-align:center")),
                                    "goidau_value"=>array("0 đ",array("style"=>"width:25%; text-align:center;"))
                            );

     $str_table_row_salary .= $this->Template->load_table_row($array_table_chatluong);

// trợ cấp- vi phạm
     $array_table_trocap =  array( "trocap"=>array("Trợ cấp đi lại",array("style"=>"width:25%; text-align:center;")),
                                   "trocap_value"=>array("200,000 đ",array("style"=>"width:25%; text-align:center")),
                                    "vipham"=>array("Vi phạm nội quy",array("style"=>"width:25%; text-align:center")),
                                    "vipham_value"=>array("0 đ",array("style"=>"width:25%; text-align:center;"))
                            );

     $str_table_row_salary .= $this->Template->load_table_row($array_table_trocap);

// tiền trách nhiệm -ng
     $array_table_trachnhiem =  array( "trachnhiem"=>array("Tiền trách nhiệm",array("style"=>"width:25%; text-align:center;")),
                                   "trachnhiem_value"=>array("500,000 đ",array("style"=>"width:25%; text-align:center")),
                                    "ng"=>array("Trừ tiền NG",array("style"=>"width:25%; text-align:center")),
                                    "ng_value"=>array("0 đ",array("style"=>"width:25%; text-align:center;"))
                            );

     $str_table_row_salary .= $this->Template->load_table_row($array_table_trachnhiem);
     // tiền phụ cập, kpdc
     $array_table_phucap =  array( "phucap"=>array("Phụ cấp",array("style"=>"width:25%; text-align:center;")),
                                   "phucap_value"=>array("500,000 đ",array("style"=>"width:25%; text-align:center")),
                                    "kpdc"=>array("Trừ KPCĐ:",array("style"=>"width:25%; text-align:center")),
                                    "kpdc_value"=>array("0 đ",array("style"=>"width:25%; text-align:center;"))
                            );

     $str_table_row_salary .= $this->Template->load_table_row($array_table_phucap);

       // tiền phụ nghỉ phép- bhxh
     $array_table_nghiphep =  array( "nghiphep"=>array("Lương nghỉ phép hàng năm, hàng tháng",array("style"=>"width:25%; text-align:center;")),
                                   "nghiphep_value"=>array("144,231 đ",array("style"=>"width:25%; text-align:center")),
                                    "bhxh"=>array("Trừ tiền đóng BHXH:",array("style"=>"width:25%; text-align:center")),
                                    "bhxh_value"=>array("0 đ",array("style"=>"width:25%; text-align:center;"))
                            );

     $str_table_row_salary .= $this->Template->load_table_row($array_table_nghiphep);

        // tiền phụ nghỉ lễ-bkt
     $array_table_nghile=  array( "nghile"=>array("Lương nghỉ lễ",array("style"=>"width:25%; text-align:center;")),
                                   "nghile_value"=>array("144,231 đ",array("style"=>"width:25%; text-align:center")),
                                    "bkt"=>array("Trừ tiền đóng BHXH:",array("style"=>"width:25%; text-align:center")),
                                    "bkt_value"=>array("0 đ",array("style"=>"width:25%; text-align:center;"))
                            );

     $str_table_row_salary .= $this->Template->load_table_row($array_table_nghile);

     //thực lãnh
      $array_table_thuclanh=  array( "thuclanh "=>array("Thực lãnh:5,478,500 Đ",
                                    array("colspan"=>"4","style"=>" width:25%; font-weight: bold; text-align:left;")),
                                   
                            );

     $str_table_row_salary .= $this->Template->load_table_row($array_table_thuclanh);


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