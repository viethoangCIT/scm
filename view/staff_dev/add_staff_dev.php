
<style type="text/css">
    .title_page{
        color: black!important;
        text-shadow:none;
    }
</style>
<?php
    //*****************************************
    //FUNCTION HEADER

    //tieu de cua ham
    $function_title = "Nhập nhân viên";
    echo $this->Template->load_function_header($function_title);


	$str_form_staff_content = "";

	//sử dụng hàm load textbox trong đối tượng templates để lấy về một chuỗi textbox;
	//mã nhân viên
	$str_input_staff_code = $this->Template->load_textbox(array("name"=>"staff_code","autocomplete"=>"off","value"=>"","id"=>"staff_code"));
 	$str_form_staff_content .= $this->Template->load_form_row(array("title"=>"Mã nhân viên",
                                                                 "input"=>$str_input_staff_code));

 	// họ và tên nhân viên
 	$str_input_staff_fullname = $this->Template->load_textbox(array("name"=>"staff_fullname","autocomplete"=>"off","value"=>"","id"=>"staff_fullname", "style"=>"width:300px"));
 	$str_form_staff_content .= $this->Template->load_form_row(array("title"=>"Họ và tên",
                                                                 "input"=>$str_input_staff_fullname));
    // họ và tên nhân viên
    $str_input_staff_STK = $this->Template->load_textbox(array("name"=>"staff_number_account","autocomplete"=>"off","value"=>"","id"=>"staff_number_account", "style"=>"width:300px"));
    $str_form_staff_content .= $this->Template->load_form_row(array("title"=>"Số TK",
                                                                 "input"=>$str_input_staff_STK));

 	// hình thức lao động
 	$array_staff_type=  array("0"=>"Lao động trực tiếp", "1"=>"Lao động gián tiếp","2" =>"Quản lý");
 	$str_select_staff_type = $this->Template->load_selectbox_basic(array("name"=>"staff_type","autocomplete"=>"off","value"=>"","id"=>"staff_type"),$array_staff_type);
 	$str_form_staff_content .= $this->Template->load_form_row(array("title"=>"Hình thức lao động",
                                                                 "input"=>$str_select_staff_type));
 	// ngày sinh
 	$str_input_staff_birthday = $this->Template->load_textbox(array("name"=>"staff_birthday","autocomplete"=>"off","value"=>"","id"=>"staff_birthday", "style"=>"width:150px"));
 	$str_form_staff_content .= $this->Template->load_form_row(array("title"=>"Ngày sinh",
                                                                 "input"=>$str_input_staff_birthday));
    // chọn giới tính
    $arrray_staff_gioitinh =  array("0"=>"Nam", "1"=>"Nữ");
    $str_select_staff_type = $this->Template->load_selectbox_basic(array("name"=>"staff_gioitinh","autocomplete"=>"off","value"=>"","id"=>"staff_gioitinh", "style"=>"width:10%"),$arrray_staff_gioitinh);
    $str_form_staff_content .= $this->Template->load_form_row(array("title"=>"Giới tính",
                                                                 "input"=>$str_select_staff_type));


    // chọn phòng ban
    $arrray_deparment =array("0"=>"BGĐ-Ban giám đốc", "1"=>"ISO-Quy trình", "3"=>"PRO-Sản xuất","4"=>"HR-Nhân sự", "5"=>"QC-Chất lượng", "6"=>"PE-Kỹ thuật", "7"=>"PUR-Mua hàng","8" =>"SALE-Kinh doanh", "9"=>"WH-Kho");
    $str_select_department_type = $this->Template->load_selectbox_basic(array("name"=>"department_type","autocomplete"=>"off","value"=>"","id"=>"department_type"),$arrray_deparment);
     $str_form_staff_content .= $this->Template->load_form_row(array("title"=>"Phòng ban",
                                                                 "input"=>$str_select_department_type));

     // chọn chức vụ
     $array_position =array("0"=>"Giám đốc", "1"=>"P.Giám đốc", "3"=>"Trưởng phòng","4"=>"Phó phòng", "5"=>"Trưởng bộ phận", "6"=>"NV phụ trách", "7"=>"Tổ trưởng","8" =>"Tổ phó", "9"=>"Trưởng ca","10"=>"Phó ca","11"=>"Nhân viên","12"=>"Công dân"); 
    $array_select_position = $this->Template->load_selectbox_basic(array("name"=>"position","autocomplete"=>"off","value"=>"","id"=>"position"),$array_position);
     $str_form_staff_content .= $this->Template->load_form_row(array("title"=>"Chức vụ",
                                                                 "input"=>$array_select_position));

    // công việc
    $array_work =array("0"=>"Giám sát", "1"=>"Quản lý", "3"=>"Phụ trách","4"=>"Tính lương", "5"=>"Báo giá", "6"=>"Khai thuế", "7"=>"Lắp ráp","8" =>"Toàn kiểm", "9"=>"Kiểm hàng","10"=>"Đứng máy");
    $array_select_work = $this->Template->load_selectbox_basic(array("name"=>"work","autocomplete"=>"off","value"=>"","id"=>"work"),$array_work);
     $str_form_staff_content .= $this->Template->load_form_row(array("title"=>"Công việc",
                                                                 "input"=>$array_select_work));

    // chọn nhà máy
    $arrray_factory=  array("0"=>"SCM1", "1"=>"SCM2", "2"=>"SCM3");
    $str_select_factory = $this->Template->load_selectbox_basic(array("name"=>"factory","autocomplete"=>"off","value"=>"","id"=>"factory"),$arrray_factory);
    $str_form_staff_content .= $this->Template->load_form_row(array("title"=>"Nhà máy",
                                                                 "input"=>$str_select_factory));

    //phân xưởng
    $arrray_part =array("0"=>"Anten 1", "1"=>"Molding 1", "3"=>"Solar","4"=>"Silicon", "5"=>"Electronic", "6"=>"Anten 2", "7"=>"Molding 2");
     $str_select_part = $this->Template->load_selectbox_basic(array("name"=>"part","autocomplete"=>"off","value"=>"","id"=>"part"),$arrray_part);
    $str_form_staff_content .= $this->Template->load_form_row(array("title"=>"Phân xưởng",
                                                                 "input"=>$str_select_part));

    // tổ
    $str_input_group = $this->Template->load_textbox(array("name"=>"group","autocomplete"=>"off","value"=>"","id"=>"group"));
    $str_form_staff_content .= $this->Template->load_form_row(array("title"=>"Tổ",
                                                                 "input"=>$str_input_group));

    // ngày vào công ty
    $str_input_date_join = $this->Template->load_textbox(array("name"=>"date_join","autocomplete"=>"off","value"=>"","id"=>"date_join"));
     $str_form_staff_content .= $this->Template->load_form_row(array("title"=>"Ngày vào công ty",
                                                                 "input"=>$str_input_date_join));

    

     // tháng thâm niên (seniority)
    $str_input_seniority = $this->Template->load_textbox(array("name"=>"seniority","autocomplete"=>"off","value"=>"","id"=>"seniority"));
    $str_form_staff_content .= $this->Template->load_form_row(array("title"=>"Tháng thâm niên",
                                                                 "input"=>$str_input_seniority));

    //  số cmnd identification
    $str_input_identification = $this->Template->load_textbox(array("name"=>"identification","autocomplete"=>"off","value"=>"","id"=>"identification"));
    $str_form_staff_content .= $this->Template->load_form_row(array("title"=>"Số CMND",
                                                                 "input"=>$str_input_identification));

    // quê quán home town
    $str_input_hometown= $this->Template->load_textbox(array("name"=>"hometown","autocomplete"=>"off","value"=>"","id"=>"hometown"));
    $str_form_staff_content .= $this->Template->load_form_row(array("title"=>"Quê quán",
                                                                 "input"=>$str_input_hometown));

    // ghi chú note
    $str_input_note= $this->Template->load_textarea(array("name"=>"note","autocomplete"=>"off","value"=>"","id"=>"note"));
    $str_form_staff_content .= $this->Template->load_form_row(array("title"=>"Ghi chú",
                                                                 "input"=>$str_input_note));



 	//tạo nút lưu
 	$str_btn_save = $this->Template->load_button(array("type"=>"submit"),"Lưu");
 	$str_form_staff_content .= $this->Template->load_form_row(array("title"=>"",
                                                                 "input"=>$str_btn_save));

   



     // dùng hàm load_form để lấy html cho form
    $str_form_staff = $this->Template->load_form(array("action"=>"","method"=>"post","id"=>"form_staff"),$str_form_staff_content);

    // Hiển thị ra trình duyệt
    echo $str_form_staff;
    ?>
    <script type="text/javascript">
        $( "#staff_birthday" ).datepicker({dateFormat: "dd-mm-yy"})
    </script>