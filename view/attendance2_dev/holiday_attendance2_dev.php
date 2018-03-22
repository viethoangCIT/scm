
<style type="text/css">

.tbl_r{
}
.table-responsive{ 
  width: 100%;
  
}


.parent{
  height: auto;
  position: absolute;
  width: 100%;
  float:left;
  overflow-y:hidden; 
  margin-left: -120px;

}

</style>



<?php




  //tạo tiêu đề hàm
$function_title = "Danh sách chấm công ngày lễ";
echo $this->Template->load_function_header($function_title);

$str_form_attendance = "";

array_unshift($array_department, array("id"=>"","name"=>"Chọn phòng ban"));
array_unshift($array_factory, array("id"=>"","name"=>"Chọn nhà máy"));
array_unshift($array_work, array("id"=>"","name"=>"Chọn công việc"));
array_unshift($array_position, array("id"=>"","name"=>"Chọn chức vụ"));
array_unshift($array_manufactory, array("id"=>"","name"=>"Chọn phân xưởng"));

$date_from = "";
$date_to = "";
if($dk_date_from != "") $date_from = date("d-m-Y",strtotime($dk_date_from));
if($dk_date_to != "") $date_to = date("d-m-Y",strtotime($dk_date_to));
$str_input_from = $this->Template->load_textbox(array("name"=>"date_from","autocomplete"=>"off","value"=>$date_from,"id"=>"date_from", "class"=>"date_from","style"=>"width:100px;"));
$str_input_to = $this->Template->load_textbox(array("name"=>"date_to","autocomplete"=>"off","value"=>$date_to,"id"=>"date_to", "class"=>"date_to","style"=>"width:100px;"));
   //--------------------------------------------------
   //phong ban

$str_select_department = $this->Template->load_selectbox(array("name"=>"id_department","autocomplete"=>"off","value"=>"","id"=>"id_department","style"=>"width:150px"),$array_department,$id_department);
    // chức vụ

$str_select_position = $this->Template->load_selectbox(array("name"=>"id_position","autocomplete"=>"off","value"=>"","id"=>"id_position","style"=>"width:150px"),$array_position,$id_position);

    // lọc theo công việc

$str_select_work = $this->Template->load_selectbox(array("name"=>"id_work","autocomplete"=>"off","value"=>"","id"=>"id_work","style"=>"width:150px"),$array_work,$id_work);

    // lọc theo nhà máy

$str_select_factory    =  $this->Template->load_selectbox(array("name"=>"id_factory","autocomplete"=>"off","value"=>"","id"=>"id_factory","style"=>"width:150px"),$array_factory,$id_factory);

    // lọc theo phân xưởng

$str_select_part = $this->Template->load_selectbox(array("name"=>"id_manufactory","autocomplete"=>"off","value"=>"","id"=>"part","style"=>"width:150px"),$array_manufactory,$id_manufactory);



$str_input_name_attendance = $this->Template->load_textbox(array("name"=>"name","autocomplete"=>"off","value"=>$name,"id"=>"name", "placeholder"=>"Nhập tên nhân viên"));

$str_btn_save = "<input type='submit' class='timkiem'value='Tìm kiếm' style='font-size: 13.4px'>";

$str_input_attendance_day ="<form action='' method='GET'><div id = 'search_bar'> Từ ngày: $str_input_from Đến ngày:$str_input_to $str_select_department  $str_select_position  $str_select_work  $str_select_factory  $str_select_manufactory $str_input_name_attendance $str_btn_save</div></form>";



   //----------------------------------------------------



$array_header_attendance =  array(
  "stt"=>array("STT",array("style"=>"text-align:center; width:3%")),
  "date"=>array("Ngày",array("style"=>"text-align:center; width:4%")),
  "code"=>array("Mã nhân viên",array("style"=>"text-align:center; width:5%")),
  "name"=>array("Họ và tên",array("style"=>"text-align:center; width:10%")), 
  "gender"=>array("Giới tính",array("style"=>"text-align:center;width:3%")),
  "type"=>array("Hình thức",array("style"=>"text-align:center;width:5%")),
  "position"=>array("Chức vụ",array("style"=>"text-align:center;width:5%")),
  "department"=>array("Phòng ban",array("style"=>"text-align:center;width:5%")),
  "go_work"=>array("Đi làm",array("style"=>"text-align:center;width:5%")),
   "sogio"=>array("Số giờ",array("style"=>"text-align:center;width:5%")),
  "action"=>array("Chức năng",array("style"=>"text-align:center; width:6%")),
);

  //2: lấy dòng tr header
$str_form_attendance = $this->Template->load_table_header($array_header_attendance);

  //---------------------------------------------------------

$str_table_row_day_shift = "";



$stt=0;
  

foreach ($array_salary_holiday as $holiday) {

  $stt++;

  $id_holiday = $holiday['id'];
  $link_sua="/attendance2/add_holiday/$id_holiday.html";
  $link_xoa="/attendance2/del1/$id_holiday.html";
  $link_sua  = $this->Template->load_link("edit","Sửa",$link_sua);
  $link_xoa  = $this->Template->load_link("del","Xóa",$link_xoa);
  $link_action = $link_xoa . $link_sua;

  $str_input_id_user = $this->Template->load_hidden(array("name"=>"id","id"=>"id","value"=>$holiday["id"],"style"=>"width:100px; margin-top:10px;"));


    // dùng hàm load table row để lấy nội dung cho bảng
  $date = date("d-m-Y",strtotime($holiday['date']));
  $array_table_row_day_shift =  array("stt"=>array($stt ,array("style"=>"text-align:center; width:3%")),
    "date"=>array($date,array("style"=>"text-align:center")),
    "code"=>array($holiday["user_code"],array("style"=>"text-align:center")),
    "name"=>array($holiday["user_name"],array("style"=>"text-align:center")),
    "gender"=>array($holiday["gender"],array("style"=>"text-align:center;width:10%")),
    "type"=>array($holiday["labor_type"],array("style"=>"text-align:center;width:13%")),
    "position"=>array($holiday["position"],array("style"=>"text-align:center;width:10%")),
    "department"=>array($holiday["department"],array("style"=>"text-align:center;width:10%")),
    
    "go_work"=>array($holiday["status"],array("style"=>"text-align:center;width:10%")),
    "sogio"=>array($holiday["num_hour"],array("style"=>"text-align:center;width:10%")),
    "action"=>array( $link_action  ,array("style"=>"text-align:center;width:3%")),
  );

  $str_form_attendance .= $this->Template->load_table_row($array_table_row_day_shift);

}
$str_form_attendance =$this->Template->load_table($str_form_attendance);




?>
<div class="parent">

 <?php
    //buoc 5: dung ham load_table đưa dữ liệu vào table
 echo $str_input_attendance_day;
 echo $str_form_attendance; 


 ?>
</div>


<script type="text/javascript">
 $( function() {
  $( "#date_from" ).datepicker({dateFormat: "dd-mm-yy"});
  $( "#date_to" ).datepicker({dateFormat: "dd-mm-yy"});
} );
</script>






