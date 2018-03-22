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
	height: auto;
	position: absolute;
    width: 100%;
    left: 0;
	margin-left:5px;
	
	margin-top: 50px;
	
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
	.table-responsive{
		margin-top: 10px;
		overflow: scroll!important;
	}
	.tbl_r{
		height: 500px;
	}
			

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

   	
    $str_input_attendance_day ="<div id = 'search_bar'>Từ ngày $str_input_from Đến ngày $str_input_to <br /> Phòng ban   $str_select_department Chức vụ  $str_select_position Công việc $str_select_work Nhà máy $str_select_factory Phân xưởng $str_select_part $str_btn_save</div>";
   

   echo $str_input_attendance_day;
    //tạo nút tìm
  
   

	$array_table_header_staff =  array("stt"=>array("STT",array("style"=>"text-align:center; width:3%")),
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
                                    "salaty_month"=>array("KỲ TÍNH LƯƠNG",array("style"=>"text-align:center;width:10%")),
                                    "year"=>array("Thâm niên",array("style"=>"text-align:center;width:10%")),
                                    "main_salary"=>array("LƯƠNG HÀNH CHÁNH",array("style"=>"text-align:center;width:10%")),
                                    "sub_salary3"=>array("PHỤ CẤP CA 3",array("style"=>"text-align:center;width:10%")),
                                    "sub_salary_150"=>array("LƯƠNG TĂNG CA 150%",array("style"=>"text-align:center;width:10%")),
                                    "sub_salary_200"=>array("LƯƠNG TĂNG CA 200%",array("style"=>"text-align:center;width:10%")),
                                    "sub_salary_300"=>array("LƯƠNG TĂNG CA 300%",array("style"=>"text-align:center;width:10%")),
                                    "total_time_salary"=>array("TỔNG LƯƠNG THỜI GIAN",array("style"=>"text-align:center;width:10%")),
                                    "kbt_salary"=>array("TIỀN KBT",array("style"=>"text-align:center;width:10%")),
                                    "productivity_salary"=>array("THƯỞNG ĐẠT NĂNG SUẤT",array("style"=>"text-align:center;width:10%")),
									"salary_1"=>array("CHUYÊN CÂN",array("style"=>"text-align:center")),
									"salary_2"=>array("TRỢ CẤP XE ĐI LẠI NHÀ Ở",array("style"=>"text-align:center")),
									"salary_3"=>array("LƯƠNG PHÉP NĂM HÀNG THÁNG",array("style"=>"text-align:center")),
									"salary_4"=>array("TRÁCH NHIỆM",array("style"=>"text-align:center")),
									"salary_5"=>array("PHỤ CẤP LƯƠNG",array("style"=>"text-align:center")),
									"salary_6"=>array("KIÊM NHIỆM",array("style"=>"text-align:center")),
									"salary_7"=>array("LƯƠNG NGHỈ ỐM ĐAU (BHXH)",array("style"=>"text-align:center")),
									"salary_8"=>array("TIỀN ĐIIỆN THOẠI",array("style"=>"text-align:center")),
									"salary_9"=>array("TIỀN SỮA",array("style"=>"text-align:center")),
									"salary_10"=>array("TIỀN XĂNG ĐI CÔNG TÁC",array("style"=>"text-align:center")),
			
									"salary_13"=>array("TRỪ TIỀN ĐỒNG PHỤC",array("style"=>"text-align:center")),
									"salary_14"=>array("LƯƠNG GỐI ĐẦU",array("style"=>"text-align:center")),
									"salary_16"=>array("TRỪ TIỀN ĐIỆN THOẠI",array("style"=>"text-align:center")),
									"salary_17"=>array("THUẾ TNCN TẠM TÍNH",array("style"=>"text-align:center")),
									"salary_18"=>array("VI PHẠM NỘI QUY",array("style"=>"text-align:center")),
									"salary_19"=>array("TRỪ TIỀN NG",array("style"=>"text-align:center")),
									"salary_20"=>array("TRỪ TiỀN KBT",array("style"=>"text-align:center")),
									"salary_21"=>array("KPCĐ",array("style"=>"text-align:center")),
									"salary_22"=>array("BHXH , BHYT",array("style"=>"text-align:center")),
									"salary_23"=>array("TỔNG QUỸ ",array("style"=>"text-align:center")),
									"salary_25"=>array("LƯƠNG ĐÓNG BẢO HIỂM",array("style"=>"text-align:center")),
									"salary_26"=>array("LƯƠNG TÍNH NGHỈ PHÉP HÀNG THÁNG",array("style"=>"text-align:center")),
									"salary_27"=>array("MÃ SỐ",array("style"=>"text-align:center"))
                                     );


   
     //buoc 2: dung hàm load_table_header de lay template table header
    $str_table_header_staff = $this->Template->load_table_header($array_table_header_staff);
    
	  $str_input_salary = $this->Template->load_textbox(array("name"=>"salary_to","autocomplete"=>"off","value"=>"","class"=>"salary_input","style"=>"width:90px;"));

	//Tổng giờ công	Tổng giờ chánh	Giờ tăng ca 150%	Tăng ca chủ nhật	Ngày công tính tiền trợ cấp, trách nhiệm	Đạt chuyên cần	Đạt trợ cấp đi lại	Thưởng	Lương gối đầ
     $array_staff = array("1"=>array("stt"=>"1", "code"=>array("MNV0001"), "name"=> array("Đào Văn Tùng"), "gender"=>array("Nam"), "birthday"=>array("1995"),
				 "department"=>array("PRO-Sảnxuất"),"position"=>array("Giám đốc"), "work"=>array("Giám sát"),"factory"=>array("SCM1"),
				 "part"=>array("Molding 1"), "group"=>array("1"),"datejoin"=>array("60"),"seniority"=>array("20/11/2017"),
				 "identification"=>array("7/2017"),"home_town"=>array("3 năm"),"live"=>array($str_input_salary),
				 "note"=>array($str_input_salary),"1"=>array($str_input_salary),"2"=>array($str_input_salary),"3"=>array($str_input_salary),
				 "4"=>array($str_input_salary),"5"=>array($str_input_salary),"6"=>array($str_input_salary),"7"=>array($str_input_salary),
				 "8"=>array($str_input_salary),"9"=>array($str_input_salary),"10"=>array($str_input_salary),"11"=>array($str_input_salary),
				 "12"=>array($str_input_salary),"13"=>array($str_input_salary),"14"=>array($str_input_salary),"15"=>array($str_input_salary),
				 "16"=>array($str_input_salary),"17"=>array($str_input_salary),"8"=>array($str_input_salary),"19"=>array($str_input_salary),
				 "20"=>array($str_input_salary),"21"=>array($str_input_salary),"22"=>array($str_input_salary),
				 "23"=>array($str_input_salary),"24"=>array($str_input_salary),"25"=>array($str_input_salary),
				 "26"=>array($str_input_salary),"27"=>array($str_input_salary),"28"=>array($str_input_salary),
				 "29"=>array($str_input_salary),"30"=>array($str_input_salary)),


				"2"=>array("stt"=>"2","code"=>array("MNV0001"), "name"=> array("Trần Xuân Toàn"), "gender"=>array("Nam"), "birthday"=>array("1995"),
				 "department"=>array("PRO-Sảnxuất"),"position"=>array("Nhân viên"), "work"=>array("Giám sát"),"factory"=>array("SCM1"),
				 "part"=>array("Molding 1"), "group"=>array("1"),"datejoin"=>array("60"),"seniority"=>array("20/11/2017"),
				 "identification"=>array("7/2017"),"home_town"=>array("3 năm"),"live"=>array($str_input_salary),
				 "note"=>array($str_input_salary),"1"=>array($str_input_salary),"2"=>array($str_input_salary),"3"=>array($str_input_salary),
				 "4"=>array($str_input_salary),"5"=>array($str_input_salary),"6"=>array($str_input_salary),"7"=>array($str_input_salary),
				 "8"=>array($str_input_salary),"9"=>array($str_input_salary),"10"=>array($str_input_salary),"11"=>array($str_input_salary),
				 "12"=>array($str_input_salary),"13"=>array($str_input_salary),"14"=>array($str_input_salary),"15"=>array($str_input_salary),
				 "16"=>array($str_input_salary),"17"=>array($str_input_salary),"8"=>array($str_input_salary),"19"=>array($str_input_salary),
				 "20"=>array($str_input_salary),"21"=>array($str_input_salary),"22"=>array($str_input_salary),
				 "23"=>array($str_input_salary),"24"=>array($str_input_salary),"25"=>array($str_input_salary),
				 "26"=>array($str_input_salary),"27"=>array($str_input_salary),"28"=>array($str_input_salary),
				 "29"=>array($str_input_salary),"30"=>array($str_input_salary)),
				 
				 "3"=>array("stt"=>"3","code"=>array("MNV0001"), "name"=> array("Nguyễn Văn Quảng"), "gender"=>array("Nam"), "birthday"=>array("1995"),
				 "department"=>array("PRO-Sảnxuất"),"position"=>array("Nhân viên"), "work"=>array("Giám sát"),"factory"=>array("SCM1"),
				 "part"=>array("Molding 1"), "group"=>array("1"),"datejoin"=>array("60"),"seniority"=>array("20/11/2017"),
				 "identification"=>array("7/2017"),"home_town"=>array("3 năm"),"live"=>array($str_input_salary),
				 "note"=>array($str_input_salary),"1"=>array($str_input_salary),"2"=>array($str_input_salary),"3"=>array($str_input_salary),
				 "4"=>array($str_input_salary),"5"=>array($str_input_salary),"6"=>array($str_input_salary),"7"=>array($str_input_salary),
				 "8"=>array($str_input_salary),"9"=>array($str_input_salary),"10"=>array($str_input_salary),"11"=>array($str_input_salary),
				 "12"=>array($str_input_salary),"13"=>array($str_input_salary),"14"=>array($str_input_salary),"15"=>array($str_input_salary),
				 "16"=>array($str_input_salary),"17"=>array($str_input_salary),"8"=>array($str_input_salary),"19"=>array($str_input_salary),
				 "20"=>array($str_input_salary),"21"=>array($str_input_salary),"22"=>array($str_input_salary),
				 "23"=>array($str_input_salary),"24"=>array($str_input_salary),"25"=>array($str_input_salary),
				 "26"=>array($str_input_salary),"27"=>array($str_input_salary),"28"=>array($str_input_salary),
				 "29"=>array($str_input_salary),"30"=>array($str_input_salary)),

                       
				"4"=>array("stt"=>"4","code"=>array("MNV0001"), "name"=> array("Đào Văn Tùng"), "gender"=>array("Nam"), "birthday"=>array("1995"),
				 "department"=>array("PRO-Sảnxuất"),"position"=>array("Giám đốc"), "work"=>array("Giám sát"),"factory"=>array("SCM1"),
				 "part"=>array("Molding 1"), "group"=>array("1"),"datejoin"=>array("60"),"seniority"=>array("20/11/2017"),
				 "identification"=>array("7/2017"),"home_town"=>array("3 năm"),"live"=>array($str_input_salary),
				 "note"=>array($str_input_salary),"1"=>array($str_input_salary),"2"=>array($str_input_salary),"3"=>array($str_input_salary),
				 "4"=>array($str_input_salary),"5"=>array($str_input_salary),"6"=>array($str_input_salary),"7"=>array($str_input_salary),
				 "8"=>array($str_input_salary),"9"=>array($str_input_salary),"10"=>array($str_input_salary),"11"=>array($str_input_salary),
				 "12"=>array($str_input_salary),"13"=>array($str_input_salary),"14"=>array($str_input_salary),"15"=>array($str_input_salary),
				 "16"=>array($str_input_salary),"17"=>array($str_input_salary),"8"=>array($str_input_salary),"19"=>array($str_input_salary),
				 "20"=>array($str_input_salary),"21"=>array($str_input_salary),"22"=>array($str_input_salary),
				 "23"=>array($str_input_salary),"24"=>array($str_input_salary),"25"=>array($str_input_salary),
				 "26"=>array($str_input_salary),"27"=>array($str_input_salary),"28"=>array($str_input_salary),
				 "29"=>array($str_input_salary),"30"=>array($str_input_salary)),


				"5"=>array("stt"=>"5","code"=>array("MNV0001"), "name"=> array("Trần Xuân Toàn"), "gender"=>array("Nam"), "birthday"=>array("1995"),
				 "department"=>array("PRO-Sảnxuất"),"position"=>array("Nhân viên"), "work"=>array("Giám sát"),"factory"=>array("SCM1"),
				 "part"=>array("Molding 1"), "group"=>array("1"),"datejoin"=>array("60"),"seniority"=>array("20/11/2017"),
				 "identification"=>array("7/2017"),"home_town"=>array("3 năm"),"live"=>array($str_input_salary),
				 "note"=>array($str_input_salary),"1"=>array($str_input_salary),"2"=>array($str_input_salary),"3"=>array($str_input_salary),
				 "4"=>array($str_input_salary),"5"=>array($str_input_salary),"6"=>array($str_input_salary),"7"=>array($str_input_salary),
				 "8"=>array($str_input_salary),"9"=>array($str_input_salary),"10"=>array($str_input_salary),"11"=>array($str_input_salary),
				 "12"=>array($str_input_salary),"13"=>array($str_input_salary),"14"=>array($str_input_salary),"15"=>array($str_input_salary),
				 "16"=>array($str_input_salary),"17"=>array($str_input_salary),"8"=>array($str_input_salary),"19"=>array($str_input_salary),
				 "20"=>array($str_input_salary),"21"=>array($str_input_salary),"22"=>array($str_input_salary),
				 "23"=>array($str_input_salary),"24"=>array($str_input_salary),"25"=>array($str_input_salary),
				 "26"=>array($str_input_salary),"27"=>array($str_input_salary),"28"=>array($str_input_salary),
				 "29"=>array($str_input_salary),"30"=>array($str_input_salary)),
				 
				 "6"=>array("stt"=>"6","code"=>array("MNV0001"), "name"=> array("Nguyễn Văn Quảng"), "gender"=>array("Nam"), "birthday"=>array("1995"),
				 "department"=>array("PRO-Sảnxuất"),"position"=>array("Nhân viên"), "work"=>array("Giám sát"),"factory"=>array("SCM1"),
				 "part"=>array("Molding 1"), "group"=>array("1"),"datejoin"=>array("60"),"seniority"=>array("20/11/2017"),
				 "identification"=>array("7/2017"),"home_town"=>array("3 năm"),"live"=>array($str_input_salary),
				 "note"=>array($str_input_salary),"1"=>array($str_input_salary),"2"=>array($str_input_salary),"3"=>array($str_input_salary),
				 "4"=>array($str_input_salary),"5"=>array($str_input_salary),"6"=>array($str_input_salary),"7"=>array($str_input_salary),
				 "8"=>array($str_input_salary),"9"=>array($str_input_salary),"10"=>array($str_input_salary),"11"=>array($str_input_salary),
				 "12"=>array($str_input_salary),"13"=>array($str_input_salary),"14"=>array($str_input_salary),"15"=>array($str_input_salary),
				 "16"=>array($str_input_salary),"17"=>array($str_input_salary),"8"=>array($str_input_salary),"19"=>array($str_input_salary),
				 "20"=>array($str_input_salary),"21"=>array($str_input_salary),"22"=>array($str_input_salary),
				 "23"=>array($str_input_salary),"24"=>array($str_input_salary),"25"=>array($str_input_salary),
				 "26"=>array($str_input_salary),"27"=>array($str_input_salary),"28"=>array($str_input_salary),
				 "29"=>array($str_input_salary),"30"=>array($str_input_salary)),
					   
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

<?php 
			//echo   $this->Template->load_button(array("type"=>"submit"),"Lưu");

?>

    	<?php   echo $str_table_staff; ?>
       
 

   
<script language="javascript">
    $( function() {
        $( "#salary_from" ).datepicker({dateFormat: "dd-mm-yy"});
		$( "#salary_to" ).datepicker({dateFormat: "dd-mm-yy"});
    } );
   
</script>