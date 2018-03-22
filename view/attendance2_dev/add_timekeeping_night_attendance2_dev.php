
<style type="text/css">
    .title_page{
        color: black!important;
        text-shadow:none;
    }
    .v_mid{}
        
        
    .input_search{
            border-radius: 7px;
            margin-top: 9px;
            height: 25px;
            border: 1px solid #aaaaaa;
        } 
   
    .click{
        border-radius: 7px;
        margin-top: 9px;
        height: 25px;
        border: 1px solid #aaaaaa;
    }
    
    

    }
    .timkiem{
        border-radius:5px;
        background-color: #fcfcfc;
    }
    .btn-primary{
        border-color: black;
    }
    
    .input {
    line-height: 15px!important;
}
.table-responsive{
    margin-top: 6px;
    overflow: scroll!important;
   
  }

.tbl_r{
    width: 140%;
    height: 500px;
}
</style>
<?php
    //*****************************************
    //FUNCTION HEADER

    //tieu de cua ham
    $function_title = "Nhập chấm công ca đêm";
    echo $this->Template->load_function_header($function_title);


    $str_form_attendance_content = "";

    //sử dụng hàm load textbox trong đối tượng templates để lấy về một chuỗi textbox;
    //ngày chấm công
    $str_input_attendance_day = $this->Template->load_textbox(array("name"=>"attendance_day","autocomplete"=>"off","value"=>"","id"=>"attendance_day","style"=>"width:180px; border:1px solid #ff631d!important;border-radius: 0px !important;"));
    $str_form_attendance_content .= $this->Template->load_form_row(array("title"=>"Ngày chấm công",
                                                                 "input"=>$str_input_attendance_day));

    
    //nhãn danh sách nhân viên
    // lọc theo
            // phòng ban
    $arrray_deparment =array("0"=>"BGĐ-Ban giám đốc", "1"=>"ISO-Quy trình", "3"=>"PRO-Sản xuất","4"=>"HR-Nhân sự", "5"=>"QC-Chất lượng", "6"=>"PE-Kỹ thuật", "7"=>"PUR-Mua hàng","8" =>"SALE-Kinh doanh", "9"=>"WH-Kho");    
      $str_select_department = $this->Template->load_selectbox_basic(array("name"=>"department","autocomplete"=>"off","value"=>"","id"=>"department"),$arrray_deparment);

                // lọc theo nhà máy
    $arrray_factory=  array("0"=>"SCM1", "1"=>"SCM2", "2"=>"SCM3");
    $str_select_factory    =  $this->Template->load_selectbox_basic(array("name"=>"factory","autocomplete"=>"off","value"=>"","id"=>"factory"),$arrray_factory);

                // lọc theo công việc
    $array_work =array("0"=>"Giám sát", "1"=>"Quản lý", "3"=>"Phụ trách","4"=>"Tính lương", "5"=>"Báo giá", "6"=>"Khai thuế", "7"=>"Lắp ráp","8" =>"Toàn kiểm", "9"=>"Kiểm hàng","10"=>"Đứng máy");
    $str_select_work = $this->Template->load_selectbox_basic(array("name"=>"work","autocomplete"=>"off","value"=>"","id"=>"work"),$array_work);

                // lọc theo chức vụ
    $array_position =array("0"=>"Giám đốc", "1"=>"P.Giám đốc", "3"=>"Trưởng phòng","4"=>"Phó phòng", "5"=>"Trưởng bộ phận", "6"=>"NV phụ trách", "7"=>"Tổ trưởng","8" =>"Tổ phó", "9"=>"Trưởng ca","10"=>"Phó ca","11"=>"Nhân viên","12"=>"Công dân"); 
    $str_select_position = $this->Template->load_selectbox_basic(array("name"=>"position","autocomplete"=>"off","value"=>"","id"=>"position"),$array_position);

            // lọc theo phân xưởng
    $arrray_part =array("0"=>"Anten 1", "1"=>"Molding 1", "3"=>"Solar","4"=>"Silicon", "5"=>"Electronic", "6"=>"Anten 2", "7"=>"Molding 2");
     $str_select_part = $this->Template->load_selectbox_basic(array("name"=>"part","autocomplete"=>"off","value"=>"","id"=>"part"),$arrray_part);


    $str_input_attendance_day ="Phòng ban $str_select_department Chức vụ: $str_select_position Công việc: $str_select_work Nhà máy: $str_select_factory Phân xưởng: $str_select_part ";
    $str_form_attendance_content .= $this->Template->load_form_row(array("title"=>"Danh sách nhân viên",
                                                                 "input"=>$str_input_attendance_day));

   

    //buoc 1: tao mang table header
    $array_table_header_staff =  array("stt"=>array("STT",array("style"=>"text-align:center; width:3%")),
                                        "code"=>array("Mã nhân viên",array("style"=>"text-align:center")),
                                        "name"=>array("Họ và tên",array("style"=>"text-align:center")),
                                    "type"=>array("Hình thức",array("style"=>"text-align:center;width:13%")),
                                    "gender"=>array("Giới tính",array("style"=>"text-align:center;width:10%")),
                                    "department"=>array("Phòng ban",array("style"=>"text-align:center;width:10%")),
                                    "attendance"=>array("Đi làm",array("style"=>"text-align:center;width:10%")),
                                    "attendance_type"=>array("Loại",array("style"=>"text-align:center;width:10%"))
                                    );

    //buoc 2: dung hàm load_table_header de lay template table header
    $str_table_header_staff = $this->Template->load_table_header($array_table_header_staff);

    // điểm danh
    $array_word_type = array("1"=>"Có","0"=>"Không");
    

   
    $str_select_attendance = $this->Template->load_selectbox_basic(array("name"=>"attendance","autocomplete"=>"off","value"=>"","id"=>"attendance"),$array_word_type);

 // bảng chọn loại ngày công
$array_work_attendance = array("1"=>"Ngày công hết hàng cho về","2"=> "Ngay công hết hàng không lương", "3" =>"Ngày nghỉ bảo hiểm hoặc bệnh", "4" =>"Ngày công lớn hơn 8 tiếng", "5" =>"Ngày công thường tính xét thưởng", "6" =>"Ngày công chủ nhật", "7" =>"Ngày nghỉ có phép", "8" =>"Ngày nghỉ vô phép", "9"=>"Ngày không bấm thẻ", "10"=>"Ngày công tính tiền sữa");
 $str_select_work_attendance = $this->Template->load_selectbox_basic(array("name"=>"work_attendance","autocomplete"=>"off","value"=>"","id"=>"work_attendance"),$array_work_attendance);


  $array_staff = array("1"=>array("code"=>"AH0001", "name"=> "Đào Văn Tùng", "phongban"=>"BGĐ-Ban giám đốc" , "type"=>"Lao động gián tiếp"),
                       "2"=>array("code"=>"AH0002", "name"=> "Lê Văn Nam", "phongban"=>"ISO-Quy trình", "type"=>"Lao động gián tiếp"),
                       "3"=>array("code"=>"AH0003", "name"=> "Nguyễn Văn Hà", "phongban"=>"BGĐ-Ban giám đốc", "type"=>"Lao động trực tiếp"),
                       "4"=>array("code"=>"AH0004", "name"=> "Đào Văn Sơn", "phongban"=>"HR-Nhân sự", "type"=>"Lao động trực tiếp"),
                       "5"=>array("code"=>"AH0005", "name"=> "Tạ Khánh Thi", "phongban"=>"BGĐ-Ban giám đốc", "type"=>"Lao động gián tiếp"),
                       "6"=>array("code"=>"AH0006", "name"=> "Trần Thị Sương", "phongban"=>"PRO-Sản xuất", "type"=>"Lao động trực tiếp"),
                       "7"=>array("code"=>"AH0007", "name"=> "Vũ Văn Hà", "phongban"=>"QC-Chất lượng", "type"=>"Lao động gián tiếp"),
                       "8"=>array("code"=>"AH0008", "name"=> "Lê Bá Anh", "phongban"=>"BGĐ-Ban giám đốc", "type"=>"Lao động trực tiếp"),
                       "9"=>array("code"=>"AH0009", "name"=> "Hà Văn Kì", "phongban"=>"HR-Nhân sự", "type"=>"Lao động trực tiếp"),
                       "10"=>array("code"=>"AH0010", "name"=> "Lê Thị Bích Trâm", "phongban"=>"ISO-Quy trình", "type"=>"Lao động gián tiếp"),
    );
//"0"=>"BGĐ-Ban giám đốc", "1"=>"ISO-Quy trình", "3"=>"PRO-Sản xuất","4"=>"HR-Nhân sự", "5"=>"QC-Chất lượng"
    $str_table_row_staff = "";
  foreach ($array_staff as $key=> $staff) {
      # code...
  
        // dùng hàm load table row để lấy nội dung cho bảng
        $array_table_row_staff =  array("stt"=>array("$key",array("style"=>"text-align:center; width:3%")),
                                            "code"=>array($staff["code"],array("style"=>"text-align:center")),
                                            "name"=>array($staff["name"],array("style"=>"text-align:center")),
                                        "type"=>array($staff["type"],array("style"=>"text-align:center;width:13%")),
                                        "gender"=>array("Nam",array("style"=>"text-align:center;width:10%")),
                                        "department"=>array($staff["phongban"],array("style"=>"text-align:center;width:10%")),
                                        "attendance"=>array($str_select_attendance,array("style"=>"text-align:center;width:10%")),
                                        "attendance_type"=>array($str_select_work_attendance,array("style"=>"text-align:center;width:10%")),
                                        );// 

        $str_table_row_staff .= $this->Template->load_table_row($array_table_row_staff);
    }
    //buoc 5: dung ham load_table đưa dữ liệu vào table
     $str_table_staff =  $this->Template->load_table($str_table_header_staff. $str_table_row_staff );


    $str_form_attendance_content .= $this->Template->load_form_row(array("title"=>"",
                                                                 "input"=>$str_table_staff));

    //tạo nút lưu
    $str_btn_save = $this->Template->load_button(array("type"=>"submit"),"Lưu");
    $str_form_attendance_content .= $this->Template->load_form_row(array("title"=>"",
                                                                 "input"=>$str_btn_save));

   



     // dùng hàm load_form để lấy html cho form
    $str_form = $this->Template->load_form(array("action"=>"","method"=>"post","id"=>"form_staff"),$str_form_attendance_content);
    $str_div= $this->Template->load_form(array("action"=>"","method"=>"post","id"=>"form_staff"),$str_form);

    // Hiển thị ra trình duyệt
    echo $str_form;
    ?>
    <script type="text/javascript">
       $( function() {
        $( "#attendance_day" ).datepicker({dateFormat: "dd-mm-yy"});
    } );
    </script>