<style type="text/css">
	
	.title_page{
		color: black!important;
		text-shadow:none;
	}
	.timkiem{
		border-radius:5px;
		background-color: #fcfcfc;
	}
  .tbl_r{
    width: 140%;
    height: 500px
  }
  .table-responsive{
    overflow: scroll!important;
    margin-top: 10px;
  }
  .search_bar{
    margin-bottom: 10px;
  }
</style>
<?php

  $function_title = "Danh sách chấm công";
    echo $this->Template->load_function_header($function_title);

    // form lọc ngày
    $str_form_attendance_content = "";



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
  
 /* $str_label_from = $this->Template->load_label("Từ ngày: ","","search_list");
  $str_label_to = $this->Template->load_label("Đến ngày: ","","search_list");
  $str_label_department = $this->Template->load_label("Phòng ban: ","","search_list");
  $str_label_position = $this->Template->load_label("Chức vụ: ","","search_list");    
  $str_label_job = $this->Template->load_label("Công việc: ","","search_list");   
  $str_label_factory = $this->Template->load_label("Nhà máy: ","","search_list");   
  $str_label_manufactory = $this->Template->load_label("Phân xưởng: ","","search_list");  */  

    
    $str_input_attendance_day ="<div id = 'search_bar'>Từ ngày $str_input_from Đến ngày $str_input_to <br />Phòng ban   $str_select_department &nbsp &nbsp Chức vụ  $str_select_position &nbsp &nbsp Công việc $str_select_work &nbsp &nbsp Nhà máy $str_select_factory  &nbsp &nbsp Phân xưởng $str_select_part $str_btn_save</div>";
   

   echo $str_input_attendance_day;




    //bước 1 tạo bảng heard
    //buoc 1: tao mang table header
    $array_table_header_staff =  array("stt"=>array("STT",array("style"=>"text-align:center; width:1%")),
                                        "code"=>array("Mã nhân viên",array("style"=>"text-align:center; width:5%")),
                                        "name"=>array("Họ & tên",array("style"=>"text-align:center; width:9%")),
                                    "type"=>array("Hình thức",array("style"=>"text-align:center;width:5%")),
                                    "gender"=>array("Giới tính",array("style"=>"text-align:center; width:5%")),
                                    "department"=>array("Phòng ban",array("style"=>"text-align:center; width:5%")),
                                    "position"=>array("Chức vụ",array("style"=>"text-align:center;width:5%")),
                                    "work_type"=>array("Công việc",array("style"=>"text-align:center;width:5%")),
                                     "factory"=>array("Nhà máy",array("style"=>"text-align:center;width:5%")),
                                    "part"=>array("Phân xưởng",array("style"=>"text-align:center;width:5%")),
                                    "total_time"=>array("Tổng giờ công",array("style"=>"text-align:center;width:5%")),
                                    "total_main"=>array("Tổng giờ chánh",array("style"=>"text-align:center;width:5%")),
                                    "overtime150"=>array("Giờ tăng ca 150%",array("style"=>"text-align:center;width:5%")),
                                    "overtimesunday"=>array("Tăng ca chủ nhật",array("style"=>"text-align:center;width:5%")),
                                    "count_day"=>array("Ngày công tính tiền trợ cấp, trách nhiệm",array("style"=>"text-align:center;width:5%")),
                                    "diligence"=>array("Đạt chuyên cần",array("style"=>"text-align:center;width:5%")),
                                    "subsidize"=>array("Đạt trợ cấp đi lại",array("style"=>"text-align:center;width:5%")),
                                    "reward"=>array("Thưởng",array("style"=>"text-align:center;width:5%")),
                                    "salary"=>array("Lương gối đầu",array("style"=>"text-align:center;width:5%")),
                                    "action"=>array("Chức năng",array("style"=>"text-align:center;width:5%")),


                                    );
   
     //buoc 2: dung hàm load_table_header de lay template table header
    $str_table_header_staff = $this->Template->load_table_header($array_table_header_staff);
    //Tổng giờ công	Tổng giờ chánh	Giờ tăng ca 150%	Tăng ca chủ nhật	Ngày công tính tiền trợ cấp, trách nhiệm	Đạt chuyên cần	Đạt trợ cấp đi lại	Thưởng	Lương gối đầ
     $array_staff = array("1"=>array("code"=>"Lê Văn Sơn", "name"=> "MNV0001","work_type"=>"Lao động trực tiếp","birthday"=>"1995", "gender"=>"Nam", "department"=>"PRO-Sảnxuất","position"=>"Giám đốc", "work"=>"Giám sát","factory"=>"SCM1","part"=>"Molding 1", "total"=>"350","total_main"=>"300","overtime150"=>"50","otsunday"=>"16","count_day"=>"28","diligence"=>"Đạt","subsidize"=>"300.000", "reward"=>"150.000","salary"=>"3.000.000" ),
                        "2"=>array("code"=>"Lê Anh Đông", "name"=> "MNV002","work_type"=>"Lao động trực tiếp","birthday"=>"1994", "gender"=>"Nam", "department"=>"PRO-Sản xuất","position"=>"Trưởng phòng", "work"=>"Giám sát","factory"=>"SCM2","part"=>"Molding 1","150","total"=>"450","total_main"=>"300","overtime150"=>"150","otsunday"=>"12","count_day"=>"25","diligence"=>"Không","subsidize"=>"150.000", "reward"=>"100.000","salary"=>"3.000.000"),
                        "3"=>array("code"=>"Nguyễn Văn Hà", "name"=> "MNV003","work_type"=>"Lao động gián tiếp","birthday"=>"1992", "gender"=>"Nam", "department"=>"PE-Kỹ thuật","position"=>"Nhân viên", "work"=>"Lắp ráp","factory"=>"SCM3","part"=>"Silicon","total"=>"390","total_main"=>"300","overtime150"=>"90","otsunday"=>"24","count_day"=>"29","diligence"=>"Đạt","subsidize"=>"300.000", "reward"=>"250.000","salary"=>"3.500.000"),
                      	"4"=>array("code"=>"Lê Thị Sương", "name"=> "MNV004","work_type"=>"Lao động trực tiếp","birthday"=>"1994", "gender"=>"Nữ", "department"=>"HR-Nhân sự","position"=>"Trưởng phòng", "work"=>"Quản lý","factory"=>"SCM3","part"=>"Anten 2","total"=>"450","total_main"=>"100","overtime150"=>"50","otsunday"=>"12","count_day"=>"27","diligence"=>"Đạt","subsidize"=>"300.000", "reward"=>"100.000","salary"=>"3.350.000"),
                     	"5"=>array("code"=>"Đặng Lệ Thủy", "name"=> "MNV005","work_type"=>"Lao động trực tiếp","birthday"=>"1990", "gender"=>"Nữ", "department"=>"HR-Nhân sự","position"=>"Nhân viên", "work"=>"Khai thuế","factory"=>"SCM3","part"=>"Anten 2","total"=>"350","total_main"=>"350","overtime150"=>"0","otsunday"=>"0","count_day"=>"26","diligence"=>"Không","subsidize"=>"300.000", "reward"=>"100.000","salary"=>"3.000.000"),
                       
    );
     //

    
    
//Tổng giờ công	Tổng giờ chánh	Giờ tăng ca 150%	Tăng ca chủ nhật	Ngày công tính tiền trợ cấp, trách nhiệm	Đạt chuyên cần	Đạt trợ cấp đi lại	Thưởng	Lương gối đầu

    $str_table_row_staff = "";
      $link_sua='';
     $link_xoa="";
     $link_sua  = $this->Template->load_link("edit","Sửa",$link_sua);
     $link_xoa  = $this->Template->load_link("del","Xóa",$link_xoa);
     $link_action = $link_xoa . $link_sua;
  foreach ($array_staff as $key=> $staff) {
      # code...
  
        // dùng hàm load table row để lấy nội dung cho bảng
        $array_table_row_staff =  array("stt"=>array("$key",array("style"=>"text-align:center; width:5%")),
                                            "code"=>array($staff["name"],array("style"=>"text-align:center; width:5%")),
                                            "name"=>array($staff["code"],array("style"=>"text-align:center; width:5%")),
                                        "type"=>array($staff["work_type"],array("style"=>"text-align:center;width:5%")),
                                        "gender"=>array($staff["gender"],array("style"=>"text-align:center;width:5%")),
                                        "department"=>array($staff["department"],array("style"=>"text-align:center;width:5%")),
                                        "position"=>array($staff["position"],array("style"=>"text-align:center;width:5%")),
                                        "work"=>array($staff["work"],array("style"=>"text-align:center;width:5%")),
                                        "factory"=>array($staff["factory"],array("style"=>"text-align:center;width:5%")),
                                        "part"=>array($staff["part"],array("style"=>"text-align:center;width:5%")),
                                        "total"=>array($staff["total"],array("style"=>"text-align:center;width:5%")),
                                        "total_main"=>array($staff["total_main"],array("style"=>"text-align:center;width:5%")),
                                        "overtime150"=>array($staff["overtime150"],array("style"=>"text-align:center;width:5%")),
                                        "otsunday"=>array($staff["otsunday"],array("style"=>"text-align:center;width:5%")),
                                        "count_day"=>array($staff["count_day"],array("style"=>"text-align:center;width:5%")),
                                        "diligence"=>array($staff["diligence"],array("style"=>"text-align:center;width:5%")),
                                        "subsidize"=>array($staff["subsidize"],array("style"=>"text-align:center;width:5%")),
                                        "reward"=>array($staff["reward"],array("style"=>"text-align:center;width:5%")),
                                        "salary"=>array($staff["salary"],array("style"=>"text-align:center;width:5%")),
                                        "action"=>array($link_action,array("style"=>"text-align:center;width:5%")),

                                        );// 

        $str_table_row_staff .= $this->Template->load_table_row($array_table_row_staff);
    }
    //buoc 5: dung ham load_table đưa dữ liệu vào table
     $str_table_staff =  $this->Template->load_table($str_table_header_staff. $str_table_row_staff );
   echo $str_table_staff;

?>

 <script type="text/javascript">
       $( function() {
        $( "#from_day" ).datepicker({dateFormat: "dd-mm-yy"});
    } );
       $( function() {
        $( "#to_day" ).datepicker({dateFormat: "dd-mm-yy"});
    } );
    </script>