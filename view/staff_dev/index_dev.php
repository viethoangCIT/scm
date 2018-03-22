<style type="text/css">
	
	.title_page{
		color: black!important;
		text-shadow:none;
	}
	.v_mid{
		}
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
	.btn, .btn-primary{
		background: white;
		color: black;
		height: 27px;
		border-radius:5px;

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
<!-- <script>
$(document).ready(function(){
    $("textbox").click(function(){
        $("input_search").addClass("intro");
    });
});
</script> -->
<?php
 $function_title = "Danh sách nhân viên";
    echo $this->Template->load_function_header($function_title);



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
    $str_input_attendance_day ="Phòng ban: $str_select_department &nbsp &nbsp Chức vụ: $str_select_position  &nbsp &nbsp Công việc: $str_select_work &nbsp &nbsp &nbspNhà máy: $str_select_factory &nbsp &nbsp Phân xưởng: $str_select_part <br/> Nhập tên nhân viên: $str_input_name_staff $str_btn_save";
   

   echo $str_input_attendance_day;
    //tạo nút tìm
  
   

$array_table_header_staff =  array("stt"=>array("STT",array("style"=>"text-align:center;width:1%;")),
                                        "code"=>array("Mã nhân viên",array("style"=>"text-align:center;width:5%;")),
                                        "name"=>array("Họ & tên",array("style"=>"text-align:center;width:9%;")),
                                         "account"=>array("Số TK",array("style"=>"text-align:center;width:5%;")),
                                    "gender"=>array("Giới tính",array("style"=>"text-align:center;width:1%;")),
                                    "birthday"=>array("Năm sinh",array("style"=>"text-align:center;width:3%;")),
                                    "department"=>array("Phòng ban",array("style"=>"text-align:center;width:6%;")),
                                    "position"=>array("Chức vụ",array("style"=>"text-align:center;width:5%;")),
                                    "work_type"=>array("Công việc",array("style"=>"text-align:center;width:5%;")),
                                     "factory"=>array("Nhà máy",array("style"=>"text-align:center;width:5%;")),
                                    "part"=>array("Phân xưởng",array("style"=>"text-align:center;width:5%;")),
                                    "group"=>array("Tổ",array("style"=>"text-align:center;width:1%;")),
                                    "datejoin"=>array("Ngày vào công ty",array("style"=>"text-align:center;width:5%;")),
                                    "seniority"=>array("Tháng thâm niên",array("style"=>"text-align:center;width:5%;")),
                                    "identification"=>array("Số CMND",array("style"=>"text-align:center;width:8%;")),
                                    "home_town"=>array("Quê quán",array("style"=>"text-align:center;width:13%;")),
                                    "live"=>array("Nơi ở",array("style"=>"text-align:center;width:15%;")),
                                    "note"=>array("Ghi chú",array("style"=>"text-align:center;width:5%;")),
                                    "action"=>array("Chức năng",array("style"=>"text-align:center;width:5%;")),
                                   
                                     );


   
     //buoc 2: dung hàm load_table_header de lay template table header
    $str_table_header_staff = $this->Template->load_table_header($array_table_header_staff);
    //Tổng giờ công	Tổng giờ chánh	Giờ tăng ca 150%	Tăng ca chủ nhật	Ngày công tính tiền trợ cấp, trách nhiệm	Đạt chuyên cần	Đạt trợ cấp đi lại	Thưởng	Lương gối đầ
     $array_staff = array("1"=>array("code"=>"MNV0001", "name"=> "Đào Văn Tùng", "account"=>"2645236251251", "gender"=>"Nam", "birthday"=>"1995","department"=>"PRO-Sảnxuất","position"=>"Giám đốc", "work"=>"Giám sát","factory"=>"SCM1","part"=>"Molding 1", "group"=>"1","datejoin"=>"20/11/2017","seniority"=>"60","identification"=>"205854558","home_town"=>"Bình Trị, Thăng Bình, QN","live"=>"190/19 Ông Ích Khiêm, TP Đà Nẵng","note"=>"" ),
                        "2"=>array("code"=>"MNV0002", "name"=> "Lê Văn Nam", "account"=>"2013526432125","work_type"=>"Lao động trực tiếp","birthday"=>"1994", "gender"=>"Nam", "department"=>"PRO-Sản xuất","position"=>"Trưởng phòng", "work"=>"Giám sát","factory"=>"SCM2","part"=>"Molding 1","group"=>"2","datejoin"=>"30/11/2012","seniority"=>"60","identification"=>"201325632","home_town"=>"Xuân Đông, Cẩm Mỹ, Đồng Nai","live"=>"190 Hoàng Hoa Thám, TP HCM","note"=>"" ),
                        "3"=>array("code"=>"MNV0003", "name"=> "Nguyễn Văn Hà", "account"=>"2013625642126","work_type"=>"Lao động gián tiếp","birthday"=>"1992", "gender"=>"Nam", "department"=>"PE-Kỹ thuật","position"=>"Nhân viên", "work"=>"Lắp ráp","factory"=>"SCM3","part"=>"Silicon","group"=>"3","datejoin"=>"01/11/2011","seniority"=>"72","identification"=>"200326325","home_town"=>"52 Trường Chinh, TP HCM","live"=>"190 Ngô Quyền, TP HCM","note"=>"" ),
                      	"4"=>array("code"=>"MNV0004", "name"=> "Nguyện Thị Thùy", "account"=>"9865362125423","work_type"=>"Lao động trực tiếp","birthday"=>"1994", "gender"=>"Nữ", "department"=>"HR-Nhân sự","position"=>"Trưởng phòng", "work"=>"Quản lý","factory"=>"SCM3","part"=>"Anten 2","group"=>"3","datejoin"=>"01/01/2011","seniority"=>"76","identification"=>"123021236","home_town"=>"5 Huỳnh Thúc Kháng, TP HCM","live"=>"5 Huỳnh Thúc Kháng","note"=>""),
                     	"5"=>array("code"=>"MNV0005", "name"=> "Tạ Khánh Thi", "account"=>"9311255632232","work_type"=>"Lao động trực tiếp","birthday"=>"1990", "gender"=>"Nữ", "department"=>"HR-Nhân sự","position"=>"Nhân viên", "work"=>"Khai thuế","factory"=>"SCM3","part"=>"Anten 2","total"=>"350","group"=>"6","datejoin"=>"21/11/2010","seniority"=>"78","identification"=>"203321362","home_town"=>"36 Lê Độ, TP HCM","live"=>"36 Lê Độ, TP HCM","note"=>""),
                       
    );
     //

    
    
//Tổng giờ công	Tổng giờ chánh	Giờ tăng ca 150%	Tăng ca chủ nhật	Ngày công tính tiền trợ cấp, trách nhiệm	Đạt chuyên cần	Đạt trợ cấp đi lại	Thưởng	Lương gối đầu
     //link sửa-xóa
     $link_sua='';
     $link_xoa="";
     $link_sua  = $this->Template->load_link("edit","Sửa",$link_sua);
     $link_xoa  = $this->Template->load_link("del","Xóa",$link_xoa);
     $link_action = $link_xoa . $link_sua;
    $str_table_row_staff = "";
  foreach ($array_staff as $key=> $staff) {
      # code...
  
        // dùng hàm load table row để lấy nội dung cho bảng
        $array_table_row_staff =  array("stt"=>array("$key",array("style"=>"text-align:center; ")),
                                            "code"=>array($staff["code"],array("style"=>"text-align:center;  ")),
                                            "name"=>array($staff["name"],array("style"=>"text-align:center;  ")),
                                            "account"=>array($staff["account"],array("style"=>"text-align:center;  ")),
                                        "gender"=>array($staff["gender"],array("style"=>"text-align:center; ")),
                                        "birthday"=>array($staff["birthday"],array("style"=>"text-align:center; ")),
                                        "department"=>array($staff["department"],array("style"=>"text-align:center; ")),
                                        "position"=>array($staff["position"],array("style"=>"text-align:center; ")),
                                        "work"=>array($staff["work"],array("style"=>"text-align:center; ")),
                                        "factory"=>array($staff["factory"],array("style"=>"text-align:center; ")),
                                        "part"=>array($staff["part"],array("style"=>"text-align:center; ")),
                                        "group"=>array($staff["group"],array("style"=>"text-align:center; ")),
                                        "datejoin"=>array($staff["datejoin"],array("style"=>"text-align:center; ")),
                                        "seniority"=>array($staff["seniority"],array("style"=>"text-align:center; ")),
                                        "identification"=>array($staff["identification"],array("style"=>"text-align:center; ")),
                                        "home_town"=>array($staff["home_town"],array("style"=>"text-align:center;")),
                                        "live"=>array($staff["live"],array("style"=>"text-align:center;")),
                                        "note"=>array($staff["note"],array("style"=>"text-align:center; ")),
                                        "action"=>array($link_action ,array("style"=>"text-align:center; ")),

                                                                               );// 

        $str_table_row_staff .= $this->Template->load_table_row($array_table_row_staff);
    }
    //buoc 5: dung ham load_table đưa dữ liệu vào table
     $str_table_staff =  $this->Template->load_table($str_table_header_staff. $str_table_row_staff );
   echo $str_table_staff;	


?>