<style>
table{ width: 50%}

tr:hover td, tr.hover td { background-color: #F90 }
td.selected { background-color: green; } 
tr:hover td.selected { background-color: lime; }



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
.title_page{
        color: black!important;
        text-shadow:none;
    }
.timkiem{
        border-radius:5px;
        background-color: #fcfcfc;
    }		
#table_salary 
{
				width: 1800px !important;
}  .
tbl_r{
    width: 140%;
    height: 500px
  }  
  .table-responsive{
    overflow: scroll!important;
    margin-top: 10px;
  }
  .search_bar{
    margin-bottom: 10px;
    margin-left: 9%!important;
  }

#table_salary td.selected { border: 1px solid #F00; }
</style>

<?php
 $function_title = "Danh sách lương";
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
	
	/*$str_label_from = $this->Template->load_label("Từ ngày: ","","search_list");
	$str_label_to = $this->Template->load_label("Đến ngày: ","","search_list");
	$str_label_department = $this->Template->load_label("Phòng ban: ","","search_list");
	$str_label_position = $this->Template->load_label("Chức vụ: ","","search_list");		
	$str_label_job = $this->Template->load_label("Công việc: ","","search_list");		
	$str_label_factory = $this->Template->load_label("Nhà máy: ","","search_list");		
	$str_label_manufactory = $this->Template->load_label("Phân xưởng: ","","search_list");	*/	

   	
    $str_input_attendance_day ="<div id = 'search_bar'>Từ ngày: $str_input_from &nbsp Đến ngày: $str_input_to <br /> Phòng ban:   $str_select_department &nbsp &nbsp Chức vụ:  $str_select_position &nbsp &nbsp Công việc: $str_select_work &nbsp &nbsp Nhà máy: $str_select_factory &nbsp &nbsp Phân xưởng: $str_select_part &nbsp $str_btn_save</div>";
   

   echo $str_input_attendance_day;
    //tạo nút tìm
  
   // link xóa sửa
$link_sua='';
     $link_xoa="";
     $link_sua  = $this->Template->load_link("edit","Sửa",$link_sua);
     $link_xoa  = $this->Template->load_link("del","Xóa",$link_xoa);
     $link_action = $link_xoa . $link_sua;
$array_table_header_staff =  array("stt"=>array(
                                    "STT",array("style"=>"text-align:center; width:3%")),
                                    "code"=>array("Mã nhân viên",array("style"=>"text-align:center")),
                                    "name"=>array("Họ & tên",array("style"=>"text-align:center")),
                                    "gender"=>array("Giới tính",array("style"=>"text-align:center;width:10%")),
                                    "birthday"=>array("Năm sinh",array("style"=>"text-align:center;width:10%")),
                                    "department"=>array("Phòng ban",array("style"=>"text-align:center;width:10%")),
                                    "position"=>array("Chức vụ",array("style"=>"text-align:center;width:10%")),
                                    "work_type"=>array("Công việc",array("style"=>"text-align:center;width:10%")),
                                     "factory"=>array("Nhà máy",array("style"=>"text-align:center;width:10%")),
                                    "part"=>array("Phân xưởng",array("style"=>"text-align:center;width:10%")),
                                    "group"=>array("Tổ",array("style"=>"text-align:center;width:10%")),
                                    "datejoin"=>array("Ngày vào công ty",array("style"=>"text-align:center;width:10%")),
                                    "salaty_month"=>array("Kì tính lương",array("style"=>"text-align:center;width:10%")),
                                    "year"=>array("Thâm niên",array("style"=>"text-align:center;width:10%")),
                                    "main_salary"=>array("Lương hành chính",array("style"=>"text-align:center;width:10%")),
                                    "sub_salary3"=>array("Phụ cấp ca 3",array("style"=>"text-align:center;width:10%")),
                                    "sub_salary_150"=>array("Lương tăng ca 150%",array("style"=>"text-align:center;width:10%")),
                                    "sub_salary_200"=>array("Lương tăng ca200%",array("style"=>"text-align:center;width:10%")),
                                    "sub_salary_300"=>array("Lương tăng ca 300%",array("style"=>"text-align:center;width:10%")),
                                    "total_time_salary"=>array("Tổng lương thời gian",array("style"=>"text-align:center;width:10%")),
                                    "kbt_salary"=>array("Tiền KBT",array("style"=>"text-align:center;width:10%")),
                                    "productivity_salary"=>array("Thưởng đạt năng suất",array("style"=>"text-align:center;width:10%")),
									"salary_1"=>array("Chuyên cần",array("style"=>"text-align:center")),
									"salary_2"=>array("Trợ cấp xe đi lại",array("style"=>"text-align:center")),
									"salary_3"=>array("Lương phép năm hàng tháng",array("style"=>"text-align:center")),
									"salary_4"=>array("Trách nhiệm",array("style"=>"text-align:center")),
									"salary_5"=>array("Phụ cấp lương",array("style"=>"text-align:center")),
									"salary_6"=>array("Kiêm nhiệm",array("style"=>"text-align:center")),
									"salary_7"=>array("Lương ốm đau (BHXH)",array("style"=>"text-align:center")),
									"salary_8"=>array("Tiền điện thoại",array("style"=>"text-align:center")),
									"salary_9"=>array("Tiền sữa",array("style"=>"text-align:center")),
									"salary_10"=>array("Tiền xăng đi công tác",array("style"=>"text-align:center")),
			
									"salary_13"=>array("Trừ tiền đồng phục",array("style"=>"text-align:center")),
									"salary_14"=>array("Lương gối đầu",array("style"=>"text-align:center")),
									"salary_16"=>array("Trừ tiền điện thoại",array("style"=>"text-align:center")),
									"salary_17"=>array("Thuế TNCN tạm tính",array("style"=>"text-align:center")),
									"salary_18"=>array("Vi phạm nội quy",array("style"=>"text-align:center")),
									"salary_19"=>array("Trừ tiền NG",array("style"=>"text-align:center")),
									"salary_20"=>array("Trừ tiền KBT",array("style"=>"text-align:center")),
									"salary_21"=>array("KPCĐ",array("style"=>"text-align:center")),
									"salary_22"=>array("BHXH , BHYT",array("style"=>"text-align:center")),
									"salary_23"=>array("Tổng quỹ",array("style"=>"text-align:center")),
									"salary_25"=>array("Lương đóng bảo hiểm",array("style"=>"text-align:center")),
									"salary_26"=>array("Lương tính nghỉ phép hàng tháng",array("style"=>"text-align:center")),
									"salary_27"=>array("Mã số",array("style"=>"text-align:center")),
                                    "action"   =>array("Chức năng",array("style"=>"text-align:center;width:10%"))
                                     );


   
     //buoc 2: dung hàm load_table_header de lay template table header
    $str_table_header_staff = $this->Template->load_table_header($array_table_header_staff);
    //Tổng giờ công	Tổng giờ chánh	Giờ tăng ca 150%	Tăng ca chủ nhật	Ngày công tính tiền trợ cấp, trách nhiệm	Đạt chuyên cần	Đạt trợ cấp đi lại	Thưởng	Lương gối đầ
     $array_staff = array("1"=>array("STT"=>"1","code"=>array("MNV0001"), "name"=> array("Đào Văn Tùng"), "gender"=>array("Nam"), "birthday"=>array("1995"),"department"=>array("PRO-Sảnxuất"),"position"=>array("Giám đốc"), "work"=>array("Giám sát"),"factory"=>array("SCM1"),"part"=>array("Molding 1"), "group"=>array("1"),"datejoin"=>array("20/11/2017"),"seniority"=>array("60"),"identification"=>array("205854558"),"home_town"=>array("Bình Trị, Thăng Bình, QN"),"live"=>array("4500000"),"note"=>array(""),"1"=>array("1"),"2"=>array("2"),"3"=>array("3"),"4"=>array("4"),"5"=>array("5"),"6"=>array("6"),"7"=>array("7"),"8"=>array("8"),"9"=>array("9"),"10"=>array("10"),"11"=>array("11"),"12"=>array("12"),"13"=>array("13"),"14"=>array("14"),"15"=>array("15"),"16"=>array("16"),"17"=>array("17"),"18"=>array("18"),"19"=>array("19"),"20"=>array("20"),"21"=>array("21"),"22"=>array("22"),"23"=>array("23"),"24"=>array("24"),"25"=>array("25"),"26"=>array("26"),"27"=>array("27"),"28"=>array("28"),"29"=>array("29"),"30"=>array("$link_action")),
	 							   
	 				"3"=>array("STT"=>"2","code"=>array("MNV0001"), "name"=> array("Nguyễn Văn Hà"), "gender"=>array("Nam"), "birthday"=>array("1995"),"department"=>array("PRO-Sảnxuất"),"position"=>array("Giám đốc"), "work"=>array("Giám sát"),"factory"=>array("SCM1"),"part"=>array("Molding 1"), "group"=>array("1"),"datejoin"=>array("20/11/2017"),"seniority"=>array("60"),"identification"=>array("205854558"),"home_town"=>array("Bình Trị, Thăng Bình, QN"),"live"=>array("4500000"),"note"=>array(""),"1"=>array("1"),"2"=>array("2"),"3"=>array("3"),"4"=>array("4"),"5"=>array("5"),"6"=>array("6"),"7"=>array("7"),"8"=>array("8"),"9"=>array("9"),"10"=>array("10"),"11"=>array("11"),"12"=>array("12"),"13"=>array("13"),"14"=>array("14"),"15"=>array("15"),"16"=>array("16"),"17"=>array("17"),"18"=>array("18"),"19"=>array("19"),"20"=>array("20"),"21"=>array("21"),"22"=>array("22"),"23"=>array("23"),"24"=>array("24"),"25"=>array("25"),"26"=>array("26"),"27"=>array("27"),"28"=>array("28"),"29"=>array("29"),"30"=>array("$link_action")),	 				
                    "4"=>array("STT"=>"3","code"=>array("MNV0001"), "name"=> array("Trần Văn Đức"), "gender"=>array("Nam"), "birthday"=>array("1995"),"department"=>array("PRO-Sảnxuất"),"position"=>array("Giám đốc"), "work"=>array("Giám sát"),"factory"=>array("SCM1"),"part"=>array("Molding 1"), "group"=>array("1"),"datejoin"=>array("20/11/2017"),"seniority"=>array("60"),"identification"=>array("205854558"),"home_town"=>array("Bình Trị, Thăng Bình, QN"),"live"=>array("4500000"),"note"=>array(""),"1"=>array("1"),"2"=>array("2"),"3"=>array("3"),"4"=>array("4"),"5"=>array("5"),"6"=>array("6"),"7"=>array("7"),"8"=>array("8"),"9"=>array("9"),"10"=>array("10"),"11"=>array("11"),"12"=>array("12"),"13"=>array("13"),"14"=>array("14"),"15"=>array("15"),"16"=>array("16"),"17"=>array("17"),"18"=>array("18"),"19"=>array("19"),"20"=>array("20"),"21"=>array("21"),"22"=>array("22"),"23"=>array("23"),"24"=>array("24"),"25"=>array("25"),"26"=>array("26"),"27"=>array("27"),"28"=>array("28"),"29"=>array("29"),"30"=>array("$link_action")),

                       
    );
     //

    
    
//Tổng giờ công	Tổng giờ chánh	Giờ tăng ca 150%	Tăng ca chủ nhật	Ngày công tính tiền trợ cấp, trách nhiệm	Đạt chuyên cần	Đạt trợ cấp đi lại	Thưởng	Lương gối đầu
     $str_btn_del = $this->Template->load_button(array("type"=>"submit"),"Xóa");
    $str_table_row_staff = "";
 	foreach ($array_staff as $key=> $staff) {
 

        $str_table_row_staff .= $this->Template->load_table_row($staff,array("class"=>"hover-row","title"=>$key,"on"));

    }
    //buoc 5: dung ham load_table đưa dữ liệu vào table
     $str_table_staff =  $this->Template->load_table($str_table_header_staff. $str_table_row_staff );
 	


?>

    	<?php   echo $str_table_staff; ?>
     
<script language="javascript">
    $( function() {
        $( "#salary_from" ).datepicker({dateFormat: "dd-mm-yy"});
		$( "#salary_to" ).datepicker({dateFormat: "dd-mm-yy"});
    } );
   
</script>