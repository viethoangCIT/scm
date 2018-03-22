<?php

$function_title = "Danh sách chấm công hành chính";
echo $this->Template->load_function_header($function_title);

    // form lọc ngày
$str_form_attendance_content = "";


array_unshift($array_department, array("id"=>"","name"=>"Phòng ban"));
array_unshift($array_factory, array("id"=>"","name"=>"Nhà máy"));
array_unshift($array_work, array("id"=>"","name"=>"Công việc"));
array_unshift($array_position, array("id"=>"","name"=>"Chức vụ"));
array_unshift($array_manufactory, array("id"=>"","name"=>"Phân xưởng"));


    //phong ban

$str_select_department = $this->Template->load_selectbox(array("name"=>"id_department","autocomplete"=>"off","value"=>"","id"=>"id_department","style"=>"width:100px"),$array_department,$id_department);
    // chức vụ

$str_select_position = $this->Template->load_selectbox(array("name"=>"id_position","autocomplete"=>"off","value"=>"","id"=>"id_position","style"=>"width:100px"),$array_position,$id_position);

    // lọc theo công việc

$str_select_work = $this->Template->load_selectbox(array("name"=>"id_work","autocomplete"=>"off","value"=>"","id"=>"id_work","style"=>"width:100px"),$array_work,$id_work);

                // lọc theo nhà máy

$str_select_factory    =  $this->Template->load_selectbox(array("name"=>"id_factory","autocomplete"=>"off","value"=>"","id"=>"id_factory","style"=>"width:100px"),$array_factory,$id_factory);

            // lọc theo phân xưởng

$str_select_part = $this->Template->load_selectbox(array("name"=>"id_manufactory","autocomplete"=>"off","value"=>"","id"=>"part","style"=>"width:100px"),$array_manufactory,$id_manufactory);

if($date_from !="") $date_from = date("d-m-Y",strtotime($date_from));
if($date_to !="") $date_to = date("d-m-Y",strtotime($date_to));
$str_input_from = $this->Template->load_textbox(array("name"=>"date_from","autocomplete"=>"off","value"=>$date_from,"id"=>"date_from", "class"=>"day","style"=>"width:90px; border:1px solid #ff631d!important;border-radius: 0px !important;"));

$str_input_to = $this->Template->load_textbox(array("name"=>"date_to","autocomplete"=>"off","value"=>$date_to,"id"=>"date_to", "class"=>"day","style"=>"width:90px; border:1px solid #ff631d!important;border-radius: 0px !important;"));

$str_btn_save = "<input type='submit' class='timkiem'value='Tìm kiếm' style='font-size: 13.4px; margin-top:10px'>";

 
          //nhập nhân viên
  $str_input_name_attendance = $this->Template->load_textbox(array("name"=>"name","autocomplete"=>"off","value"=>$name,"id"=>"name", "placeholder"=>"Nhập tên nhân viên"));

  $str_input_attendance_day ="<form action='' method='GET'><div id = 'search_bar'>Từ ngày $str_input_from Đến ngày $str_input_to $str_select_department $str_select_position $str_select_work $str_select_factory  $str_select_part  $str_input_name_attendance $str_btn_save </div></form>";






    //bước 1 tạo bảng heard
    //buoc 1: tao mang table header
  $array_table_header_attendance =  array(
    "stt"=>array("STT",array("style"=>"text-align:center; width:1%")),
    "code"=>array("Mã nhân viên",array("style"=>"text-align:center; width:3%")),
    "name"=>array("Họ và tên",array("style"=>"text-align:center; width:10%")),
    "gender"=>array("Giới tính",array("style"=>"text-align:center; width:5%")),
    "type"=>array("Hình thức",array("style"=>"text-align:center; width:7%")),
    "department"=>array("Phòng ban",array("style"=>"text-align:center; width:6%")),
    "position"=>array("Chức vụ",array("style"=>"text-align:center; width:7%")),
    "day"=>array("Ngày",array("style"=>"text-align:center; width:3%")),
    "work_type"=>array("Đi làm",array("style"=>"text-align:center; width:3%")),
    "num_hour"=>array("Số giờ",array("style"=>"text-align:center; width:3%")),
     "loai"=>array("Loại",array("style"=>"text-align:center; width:3%")),
    "action"=>array("Chức năng",array("style"=>"text-align:center; width:5%")),
  );
     //buoc 2: dung hàm load_table_header de lay template table header
  $str_table_header_attendance = $this->Template->load_table_header($array_table_header_attendance);
    //Tổng giờ công Tổng giờ chánh  Giờ tăng ca 150%  Tăng ca chủ nhật  Ngày công tính tiền trợ cấp, trách nhiệm  Đạt chuyên cần  Đạt trợ cấp đi lại  Thưởng  Lương gối đầ

//Tổng giờ công Tổng giờ chánh  Giờ tăng ca 150%  Tăng ca chủ nhật  Ngày công tính tiền trợ cấp, trách nhiệm  Đạt chuyên cần  Đạt trợ cấp đi lại  Thưởng  Lương gối đầu

  $str_table_row_attendance = "";
  $stt=0;
  $array_work_attendance = array("1"=>"Ngày công hết hàng cho về","2"=> "Ngay công hết hàng không lương", "3" =>"Ngày nghỉ bảo hiểm hoặc bệnh", "6" =>"Ngày công chủ nhật", "7" =>"Ngày nghỉ có phép", "8" =>"Ngày nghỉ vô phép", "9"=>"Ngày không bấm thẻ", "10"=>"Ngày công tính tiền sữa","11"=>"Ngày công đi muộn(đủ 8h)");
  foreach ($array_attendance as $attendance ) 
  {
    $stt++;

    $id_day_shift = $attendance['id'];
    $link_sua="/attendance2/add_day_shift/$id_day_shift.html";
    $link_xoa="/attendance2/del2/$id_day_shift.html";
    $link_sua  = $this->Template->load_link("edit","Sửa",$link_sua);
    $link_xoa  = $this->Template->load_link("del","Xóa",$link_xoa);
    $link_action = $link_xoa . $link_sua;

// print_r($array_attendance);
    $str_input_id_user = $this->Template->load_hidden(array("name"=>"data[$stt][id_user]","id"=>"id_user","value"=>$day_shift["id"],"style"=>"width:100px; margin-top:10px;"));
    $str_input_attendance_code = $this->Template->load_hidden(array("name"=>"data[$stt][user_code]","id"=>"user_code","value"=>$day_shift["user_code"],"style"=>"width:100px; margin-top:10px;"));
    $str_input_attendance_fullname = $this->Template->load_hidden(array("name"=>"data[$stt][fullname]","id"=>"fullname","value"=>$day_shift["fullname"],"style"=>"width:100px;  margin-top:10px;"));
    $str_input_attendance_gender = $this->Template->load_hidden(array("name"=>"data[$stt][gender]","id"=>"gender","value"=>$day_shift["gender"],"style"=>"width:100px;  margin-top:10px;"));
    $str_input_attendance_labor_type = $this->Template->load_hidden(array("name"=>"data[$stt][labor_type]","id"=>"labor_type","value"=>$day_shift["labor_type"],"style"=>"width:100px; margin-top:10px;"));
    $str_input_attendance_department = $this->Template->load_hidden(array("name"=>"data[$stt][department]","id"=>"department","value"=>$day_shift["department"],"style"=>"width:100px; margin-top:10px;"));
    $str_input_attendance_position = $this->Template->load_hidden(array("name"=>"data[$stt][position]","id"=>"position","value"=>$day_shift["position"],"style"=>"width:100px; margin-top:10px;"));

   

        // dùng hàm load table row để lấy nội dung cho bảng

    $date = date("d-m-Y",strtotime($attendance["date"])) ;
    if($date == "01-01-1970") $date = "";
    $array_table_row_attendance =  array(
      "stt"=>array($stt,array("style"=>"text-align:center")),
      "code"=>array($attendance["user_code"],array("style"=>"text-align:center;")),
      "name"=>array($attendance["fullname"],array("style"=>"text-align:center;")),
      "gender"=>array($attendance["gender"],array("style"=>"text-align:center;")),
      "type"=>array($attendance["labor_type"],array("style"=>"text-align:center;")),
      "department"=>array($attendance["department"],array("style"=>"text-align:center;")),
      "position"=>array($attendance["position"],array("style"=>"text-align:center;")),
       "ngay"=>array($date,array("style"=>"text-align:center;")),
      "work_type"=>array($attendance["go_work"],array("style"=>"text-align:center;")),
      "num_hour"=>array($attendance["num_hour"],array("style"=>"text-align:center;")),
       "loai"=>array( $array_work_attendance[$attendance["id_date_allowance"]],array("style"=>"text-align:center;")),
      "action"=>array( $link_action  ,array("style"=>"text-align:center;")),
    );

    $str_table_row_attendance .= $this->Template->load_table_row($array_table_row_attendance);
  }
  $str_table_attendance =  $this->Template->load_table($str_table_header_attendance. $str_table_row_attendance );
  


  ?>
  


  <?php
  echo $str_input_attendance_day;
  echo $str_table_attendance;
  ?>

  <script type="text/javascript">
   $( function() {
    $( "#date_from" ).datepicker({dateFormat: "dd-mm-yy"});
  } );
   $( function() {
    $( "#date_to" ).datepicker({dateFormat: "dd-mm-yy"});
  } );
</script>