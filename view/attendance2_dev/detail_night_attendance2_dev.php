<style type="text/css">
  
  
.table-responsive{
  
 width: 2000px;
}
.tbl_r{
  
  height: 500px;
}
.parent{
  min-height: 130px;
  max-height: 280px;
  height: auto;
  position: absolute;
    width: 100%;
    left: 0;
  overflow:scroll;
}
 
</style>
<?php

  $function_title = "Chi Tiết Chấm Công";
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

    $str_input_from = $this->Template->load_textbox(array("name"=>"salary_from","autocomplete"=>"off","value"=>"","id"=>"salary_from", "class"=>"day","style"=>"width:90px; border:1px solid #ff631d!important;border-radius: 0px !important;"));
    $str_input_to = $this->Template->load_textbox(array("name"=>"salary_to","autocomplete"=>"off","value"=>"","id"=>"salary_to", "class"=>"day","style"=>"width:90px; border:1px solid #ff631d!important;border-radius: 0px !important;"));

      $str_btn_save = "<input type='submit' class='timkiem'value='Tìm kiếm' style='font-size: 13.4px; margin-top:10px'>";
  
 /* $str_label_from = $this->Template->load_label("Từ ngày: ","","search_list");
  $str_label_to = $this->Template->load_label("Đến ngày: ","","search_list");
  $str_label_department = $this->Template->load_label("Phòng ban: ","","search_list");
  $str_label_position = $this->Template->load_label("Chức vụ: ","","search_list");    
  $str_label_job = $this->Template->load_label("Công việc: ","","search_list");   
  $str_label_factory = $this->Template->load_label("Nhà máy: ","","search_list");   
  $str_label_manufactory = $this->Template->load_label("Phân xưởng: ","","search_list");  */  


    //nhập nhân viên
     $str_input_name_staff = $this->Template->load_textbox(array("name"=>"attendance_day","autocomplete"=>"off","value"=>"","id"=>"attendance_day", "placeholder"=>"Nhập tên nhân viên"));
    
    $str_input_attendance_day ="<div id = 'search_bar'>Từ ngày $str_input_from Đến ngày $str_input_to   <br/><br/>Phòng ban   $str_select_department Chức vụ  $str_select_position Công việc $str_select_work Nhà máy $str_select_factory  Phân xưởng $str_select_part <br/> Nhập tên nhân viên: $str_input_name_staff $str_btn_save <br/></div>";
   

   echo $str_input_attendance_day;




    //bước 1 tạo bảng heard
    //buoc 1: tao mang table header
    $array_table_header_staff =  array("stt"=>array("STT",array("style"=>"text-align:center; width:1%")),
                                   
                                        "code"=>array("Mã nhân viên",array("style"=>"text-align:center; width:2%")),
                                        "name"=>array("Họ và tên",array("style"=>"text-align:center; width:9%")),
                                    "type"=>array("Hình thức",array("style"=>"text-align:center;width:3%")),
                                    "gender"=>array("Giới tính",array("style"=>"text-align:center; width:2%")),
                                    "department"=>array("Phòng ban",array("style"=>"text-align:center; width:5%")),
                                    "position"=>array("Chức vụ",array("style"=>"text-align:center;width:5%")),
                                    "work_type"=>array("Công việc",array("style"=>"text-align:center;width:5%")),
                                     "factory"=>array("Nhà máy",array("style"=>"text-align:center;width:5%")),
                                    "part"=>array("Phân xưởng",array("style"=>"text-align:center;width:5%")),
                                    "group"=>array("Tổ",array("style"=>"text-align:center;width:2%")),
                                    
                                    "day_out"=>array("Ngày công hết hàng cho về",array("style"=>"text-align:center;width:5%")),
                                    "day_late"=>array("Ngày công đi muộn(đủ 8h)",array("style"=>"text-align:center;width:5%")),
                                    "day_empty"=>array("Ngày công hết hàng không lương",array("style"=>"text-align:center;width:5%")),
                                    "vacation_insurance"=>array("Ngày nghỉ phép bảo hiểm",array("style"=>"text-align:center;width:5%")),
                                    "day_recompense"=>array("Ngày công làm xét thưởng",array("style"=>"text-align:center;width:5%")),
                                    "day_sunday"=>array("Ngày công chủ nhật",array("style"=>"text-align:center;width:5%")),
                                    "day_not_card"=>array("Ngày công không bấm thẻ",array("style"=>"text-align:center;width:5%")),
                                    "day_over8"=>array("Ngày công lớn hơn 8h",array("style"=>"text-align:center;width:5%")),
                                    "day_money_milk"=>array("Ngày công tính tiền sữa",array("style"=>"text-align:center;width:5%")),
                                     "total_hours"=>array("Tổng giờ công tính tiền phụ cấp ca 3 30%",array("style"=>"text-align:center;width:6%")),
                                     "action"=>array("Chức năng",array("style"=>"text-align:center;width:4%;")),
                                    );
   
     //buoc 2: dung hàm load_table_header de lay template table header
    $str_table_header_staff = $this->Template->load_table_header($array_table_header_staff);
    //Tổng giờ công Tổng giờ chánh  Giờ tăng ca 150%  Tăng ca chủ nhật  Ngày công tính tiền trợ cấp, trách nhiệm  Đạt chuyên cần  Đạt trợ cấp đi lại  Thưởng  Lương gối đầ
     $array_staff = array("1"=>array("code"=>"Lê Văn Sơn", "name"=> "NV0001","work_type"=>"Lao động trực tiếp","birthday"=>"1995", "gender"=>"Nam", "department"=>"PRO-Sảnxuất","position"=>"Giám đốc", "work"=>"Giám sát","factory"=>"SCM1","part"=>"Molding 1", "group"=>"3","day_out"=>"1" ,"day_late"=>"1", "day_empty"=>"1","vacation_insurance"=>"1","day_recompense"=>"1","day_sunday"=>"1","day_not_card"=>"1","day_over8"=>"1","day_money_milk"=>"1","total_hours"=>"0"),
                        "2"=>array("code"=>"Lê Anh Đông", "name"=> "AH002","work_type"=>"Lao động trực tiếp","birthday"=>"1994", "gender"=>"Nam", "department"=>"PRO-Sản xuất","position"=>"Trưởng phòng", "work"=>"Giám sát","factory"=>"SCM2","part"=>"Molding 1","150","group"=>"2","day_out"=>"1" ,"day_late"=>"1", "day_empty"=>"1","vacation_insurance"=>"1","day_recompense"=>"1","day_sunday"=>"1","day_not_card"=>"1","day_over8"=>"1","day_money_milk"=>"1","total_hours"=>"0"),
                        "3"=>array("code"=>"Nguyễn Văn Hà", "name"=> "AH003","work_type"=>"Lao động gián tiếp","birthday"=>"1992", "gender"=>"Nam", "department"=>"PE-Kỹ thuật","position"=>"Nhân viên", "work"=>"Lắp ráp","factory"=>"SCM3","part"=>"Silicon","group"=>"5","day_out"=>"1" ,"day_late"=>"1", "day_empty"=>"1","vacation_insurance"=>"1","day_recompense"=>"1","day_sunday"=>"1","day_not_card"=>"1","day_over8"=>"1","day_money_milk"=>"1","total_hours"=>"0"),
                        "4"=>array("code"=>"Lê Thị Sương", "name"=> "AH004","work_type"=>"Lao động trực tiếp","birthday"=>"1994", "gender"=>"Nữ", "department"=>"HR-Nhân sự","position"=>"Trưởng phòng", "work"=>"Quản lý","factory"=>"SCM3","part"=>"Anten 2","group"=>"6","day_out"=>"1" ,"day_late"=>"1", "day_empty"=>"1","vacation_insurance"=>"1","day_recompense"=>"1","day_sunday"=>"1","day_not_card"=>"1","day_over8"=>"1","day_money_milk"=>"1","total_hours"=>"0"),
                      "5"=>array("code"=>"Đặng Lệ Thủy", "name"=> "AH005","work_type"=>"Lao động trực tiếp","birthday"=>"1990", "gender"=>"Nữ", "department"=>"HR-Nhân sự","position"=>"Nhân viên", "work"=>"Khai thuế","factory"=>"SCM3","part"=>"Anten 2","group"=>"4","day_out"=>"1" ,"day_late"=>"1", "day_empty"=>"1","vacation_insurance"=>"1","day_recompense"=>"1","day_sunday"=>"1","day_not_card"=>"1","day_over8"=>"1","day_money_milk"=>"1","total_hours"=>"0"),
                       
    );
     //

    
    
//Tổng giờ công Tổng giờ chánh  Giờ tăng ca 150%  Tăng ca chủ nhật  Ngày công tính tiền trợ cấp, trách nhiệm  Đạt chuyên cần  Đạt trợ cấp đi lại  Thưởng  Lương gối đầu

    $str_table_row_staff = "";
     
//link thêm _ lưu
     //lấy dòng nội dung table
  $str_btn_chitiet = "<input type='submit' class='xemchitiet'value='Xem chi tiết' style='font-size: 13.4px'>";
  foreach ($array_staff as $key=> $staff) {
      # code...
  
        // dùng hàm load table row để lấy nội dung cho bảng
        $array_table_row_staff =  array("stt"=>array("$key",array("style"=>"text-align:center; width:1%")),
                                            
                                            "code"=>array($staff["name"],array("style"=>"text-align:center; width:2%")),
                                            "name"=>array($staff["code"],array("style"=>"text-align:center; width:9%")),
                                        "type"=>array($staff["work_type"],array("style"=>"text-align:center;width:7%")),
                                        "gender"=>array($staff["gender"],array("style"=>"text-align:center;width:3%")),
                                        "department"=>array($staff["department"],array("style"=>"text-align:center;width:3%")),
                                        "position"=>array($staff["position"],array("style"=>"text-align:center;width:5%")),
                                        "work"=>array($staff["work"],array("style"=>"text-align:center;width:5%")),
                                        "factory"=>array($staff["factory"],array("style"=>"text-align:center;width:5%")),
                                        "part"=>array($staff["part"],array("style"=>"text-align:center;width:5%")),
                                        "group"=>array($staff["group"],array("style"=>"text-align:center;width:2%")),
                                        "day_out"=>array($staff["day_out"],array("style"=>"text-align:center;width:5%")),
                                         "day_late"=>array($staff[ "day_late"],array("style"=>"text-align:center;width:5%")),
                                         "day_empty"=>array($staff[ "day_empty"],array("style"=>"text-align:center;width:5%")),
                                        "vacation_insurance"=>array($staff["vacation_insurance"],array("style"=>"text-align:center;width:5%")),
                                        "day_recompense"=>array($staff["day_recompense"],array("style"=>"text-align:center;width:5%")),
                                         "day_sunday"=>array($staff[ "day_sunday"],array("style"=>"text-align:center;width:5%")),
                                        "day_not_card"=>array($staff["day_not_card"],array("style"=>"text-align:center;width:5%")),
                                        "day_over8"=>array($staff["day_over8"],array("style"=>"text-align:center;width:5%")),
                                       "day_money_milk"=>array($staff["day_over8"],array("style"=>"text-align:center;width:5%")),
                                         "total_hours"=>array($staff["day_over8"],array("style"=>"text-align:center;width:5%")),
                                         "action"=>array( $str_btn_chitiet ,array("style"=>"text-align:center;width:4% ")),
                                        );

        $str_table_row_staff .= $this->Template->load_table_row($array_table_row_staff);
    }
 
    //buoc 5: dung ham load_table đưa dữ liệu vào table
     $str_table_staff =  $this->Template->load_table($str_table_header_staff. $str_table_row_staff );

        ?>
    <div class="parent">
  <?php 
   echo $str_table_staff;

?>
</div>


 <script type="text/javascript">
       $( function() {
        $( "#from_day" ).datepicker({dateFormat: "dd-mm-yy"});
    } );
       $( function() {
        $( "#to_day" ).datepicker({dateFormat: "dd-mm-yy"});
    } );
    </script>