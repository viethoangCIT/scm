<style type="text/css">


.tbl_r{


}
.table-responsive{
  width: 1600px;
}

.parent{


  position: absolute;
  width: 100%;
  left: 0;
  overflow-y:hidden;
}
</style>
<?php

// tạo title
$function_title = "Danh sách chấm công theo ca";
echo $this->Template->load_function_header($function_title);


// BEGIN: TẠO FORM SEARCH
if($date_to != "") $date_to = date("d-m-Y",strtotime($date_to));
if($date_from != "") $date_from = date("d-m-Y",strtotime($date_from));
$str_input_from = $this->Template->load_textbox(array("name"=>"date_from","autocomplete"=>"off","value"=>$date_from,"id"=>"date_from", "class"=>"date_from","style"=>"width:100px;"));
$str_input_to = $this->Template->load_textbox(array("name"=>"date_to","autocomplete"=>"off","value"=>$date_to,"id"=>"date_to", "class"=>"date_from","style"=>"width:100px;"));

//phong ban
array_unshift($array_department, array("id"=>"","name"=>"Phòng ban"));
$str_select_department = $this->Template->load_selectbox(array("name"=>"id_department","autocomplete"=>"off","value"=>"","id"=>"id_department","style"=>"width:150px"),$array_department,$id_attendance);

// chức vụ
array_unshift($array_position, array("id"=>"","name"=>"Chức vụ"));
$str_select_position = $this->Template->load_selectbox(array("name"=>"id_position","autocomplete"=>"off","value"=>"","id"=>"id_position","style"=>"width:150px"),$array_position,$id_position);

// lọc theo công việc
array_unshift($array_work, array("id"=>"","name"=>"Công việc"));
$str_select_work = $this->Template->load_selectbox(array("name"=>"id_work","autocomplete"=>"off","value"=>"","id"=>"id_work","style"=>"width:150px"),$array_work,$id_work);

// lọc theo nhà máy
array_unshift($array_factory, array("id"=>"","name"=>"Nhà máy"));
$str_select_factory    =  $this->Template->load_selectbox(array("name"=>"id_factory","autocomplete"=>"off","value"=>"","id"=>"id_factory","style"=>"width:150px"),$array_factory,$id_factory);

// lọc theo phân xưởng
array_unshift($array_manufactory, array("id"=>"","name"=>"Phân xưởng"));
$str_select_part = $this->Template->load_selectbox(array("name"=>"id_manufactory","autocomplete"=>"off","value"=>"","id"=>"part","style"=>"width:150px"),$array_manufactory,$id_manufactory);

// chon ca
$array_part =array( "0"=>"Chọn ca","1"=>"Ca 1", "2"=>"Ca 2", "3"=>"Ca 3");
$str_select_part1 = $this->Template->load_selectbox_basic(array("name"=>"shift","autocomplete"=>"off","id"=>"shift","style"=>"width:100px"),$array_part);

$str_input_name_attendance = $this->Template->load_textbox(array("name"=>"name","autocomplete"=>"off","value"=>$name,"id"=>"name", "placeholder"=>"Nhập tên nhân viên"));


$str_btn_save = "<input type='submit' class='timkiem'value='Tìm kiếm' style='font-size: 13.4px'>";

$str_input_attendance_day ="<form action='' method='GET'><div id = 'search_bar' style = 'width:110%;margin-left:10px;'> Từ ngày $str_input_from Đến ngày $str_input_to    $str_select_department  $str_select_position  $str_select_work  $str_select_factory  $str_select_part $str_input_name_attendance $str_btn_save</div></form>";
// END: TẠO FORM SEARCH

// BEGIN: TẠO TABLE HEADER 
$array_table_header_attendance =  array("stt"=>array("STT",array("style"=>"text-align:center;width:1%")),
  "day"=>array("Ngày",array("style"=>"text-align:center;width:3%")),
  "code"=>array("Mã nhân viên",array("style"=>"text-align:center;width:5%")),
  "name"=>array("Họ và tên",array("style"=>"text-align:center;width:10%")),
  "gender"=>array("Giới tính",array("style"=>"text-align:center;width:2%")),
  "type"=>array("Hình thức",array("style"=>"text-align:center;width:5%")),

  "department"=>array("Phòng ban",array("style"=>"text-align:center;width:4%")),
  "position"=>array("Chức vụ",array("style"=>"text-align:center;width:4%")),
  "work_type"=>array("Công việc",array("style"=>"text-align:center;width:4%")),
  "factory"=>array("Nhà máy",array("style"=>"text-align:center;width:4%")),
  "part"=>array("Phân xưởng",array("style"=>"text-align:center;width:5%")),
  "group"=>array("Tổ",array("style"=>"text-align:center;width:2%")),
  "go_word"=>array("Đi làm",array("style"=>"text-align:center;width:4%")),
  "ca"=>array("Ca",array("style"=>"text-align:center;width:4%")),
  "num_hour"=>array("Số giờ",array("style"=>"text-align:center;width:4%")),
  "attendance_type"=>array("Loại",array("style"=>"text-align:center;width:10%")),
  
  "action"=>array("Chức năng",array("style"=>"text-align:center;width:5%")),
);
//buoc 2: dung hàm load_table_header de lay template table header
$str_table_header_attendance = $this->Template->load_table_header($array_table_header_attendance);
// END: TẠO TABLE HEADER

$str_table_row_attendance = "";
$stt=0;

 $array_work_attendance = array("1"=>"Ngày công hết hàng cho về","2"=> "Ngay công hết hàng không lương", "3" =>"Ngày nghỉ bảo hiểm hoặc bệnh", "6" =>"Ngày công chủ nhật", "7" =>"Ngày nghỉ có phép", "8" =>"Ngày nghỉ vô phép", "9"=>"Ngày không bấm thẻ", "10"=>"Ngày công tính tiền sữa","11"=>"Ngày công đi muộn(đủ 8h)");
// BEGIN: TẠO TABLE ROW
foreach ($array_attendance as $attendance ) 
{
  $stt++;
  $date = date("d-m-Y",strtotime($attendance["date"]));
  $id = $attendance['id'];
  $link_sua="/attendance2/add_night_shift/$id.html";
  $link_xoa="/attendance2/del/$id.html";
  $link_sua  = $this->Template->load_link("edit","Sửa",$link_sua);
  $link_xoa  = $this->Template->load_link("del","Xóa",$link_xoa);
  $link_action = $link_xoa . $link_sua;

 
  
  $loai = $array_work_attendance[$attendance["id_date_allowance"]];
   // dùng hàm load table row để lấy nội dung cho bảng
  $array_table_row_attendance =  array("stt"=>array($stt,array("style"=>"text-align:center")),
    "day"=>array($date,array("style"=>"text-align:center")),
    "code"=>array($attendance["user_code"],array("style"=>"text-align:center")),
    "name"=>array($attendance["fullname"],array("style"=>"text-align:center")),
    "gender"=>array($attendance["gender"],array("style"=>"text-align:center")),
    "type"=>array($attendance["labor_type"],array("style"=>"text-align:center")),

    "department"=>array($attendance["department"],array("style"=>"text-align:center")),
    "position"=>array($attendance["position"],array("style"=>"text-align:center")),
    "work"=>array($attendance["work"],array("style"=>"text-align:center")),
    "factory"=>array($attendance["factory"],array("style"=>"text-align:center")),
    "part"=>array($attendance["part"],array("style"=>"text-align:center")),
    "group"=>array($attendance["team"],array("style"=>"text-align:center")),
    "go_word"=>array($attendance["go_work"],array("style"=>"text-align:center")),
    "ca"=>array($attendance["shift"],array("style"=>"text-align:center")),
    "num_hour"=>array($attendance["num_hour"],array("style"=>"text-align:center")),
    "attendance_type"=>array($loai,array("style"=>"text-align:center")),
    
    "action"=>array( $link_action  ,array("style"=>"text-align:center")),
  );

  $str_table_row_attendance .= $this->Template->load_table_row($array_table_row_attendance);
}
$str_table_attendance =  $this->Template->load_table($str_table_header_attendance. $str_table_row_attendance );
// END: TẠO TABLE ROW

?>
<div class="parent">

 <?php
    //buoc 5: dung ham load_table đưa dữ liệu vào table
 echo $str_input_attendance_day;

 echo $str_table_attendance;


 ?>
</div>
<script>
  $( function() 
  {
    $( "#date_from" ).datepicker({dateFormat: "dd-mm-yy"});
    $( "#date_to" ).datepicker({dateFormat: "dd-mm-yy"});
  } );
</script>