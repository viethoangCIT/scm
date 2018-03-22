
<style type="text/css">

.tbl_r{

}
.table-responsive{ 
  width: 1350px;
  
}


.parent{

  position: absolute;
  width: 100%;
  left: 0;

  overflow-y:hidden;
}

</style>



<?php




  //tạo tiêu đề hàm
$function_title = "Nhập chấm công ngày lễ";
echo $this->Template->load_function_header($function_title);

$str_form_attendance = "";

array_unshift($array_department, array("id"=>"","name"=>"Chọn phòng ban"));
array_unshift($array_factory, array("id"=>"","name"=>"Chọn nhà máy"));
array_unshift($array_work, array("id"=>"","name"=>"Chọn công việc"));
array_unshift($array_position, array("id"=>"","name"=>"Chọn chức vụ"));
array_unshift($array_manufactory, array("id"=>"","name"=>"Chọn phân xưởng"));


$str_input_from = $this->Template->load_textbox(array("name"=>"date","autocomplete"=>"off","value"=>"","id"=>"date", "class"=>"date","style"=>"width:100px;"));
   //--------------------------------------------------
   //phong ban

$str_select_department = $this->Template->load_selectbox(array("name"=>"id_department","autocomplete"=>"off","value"=>"","id"=>"id_department","style"=>"width:150px"),$array_department,$id_department);
    // chức vụ

$str_select_position = $this->Template->load_selectbox(array("name"=>"id_position","autocomplete"=>"off","value"=>"","id"=>"id_position","style"=>"width:150px"),$array_position,$id_position);

    // lọc theo công việc

$str_select_work = $this->Template->load_selectbox(array("name"=>"id_work","autocomplete"=>"off","value"=>"","id"=>"id_work","style"=>"width:150px"),$array_work,$id_work);

                // lọc theo nhà máy

$str_select_factory =  $this->Template->load_selectbox(array("name"=>"id_factory","autocomplete"=>"off","value"=>"","id"=>"id_factory","style"=>"width:150px"),$array_factory,$id_factory);

            // lọc theo phân xưởng

$str_select_part = $this->Template->load_selectbox(array("name"=>"id_manufactory","autocomplete"=>"off","value"=>"","id"=>"part","style"=>"width:150px"),$array_manufactory,$id_manufactory);

   // // $str_btn_save = $this->Template->load_button(array("type"=>"submit",),"<p class = 'text_tk'>Tìm kiếm</p>");

$str_btn_save = "<input type='submit' class='timkiem'value='Tìm kiếm' style='font-size: 13.4px'>";

$str_input_name_attendance = $this->Template->load_textbox(array("name"=>"name","autocomplete"=>"off","value"=>$name,"id"=>"name", "placeholder"=>"Nhập tên nhân viên"));

$str_input_hoiday ="<form action='' method='GET' ><div id = 'search_bar' style='margin-left:260px; margin-bottom:-30px;'>    $str_select_department  $str_select_position  $str_select_work  $str_select_factory  $str_select_part $str_input_name_attendance $str_btn_save </div></form>";
$str_input_hoiday1 ="<div id = 'search_bar' style='margin-left:30px;' > Chọn ngày: $str_input_from   </div>";





   //----------------------------------------------------



$array_header_attendance =  array("stt"=>array("STT",array("style"=>"text-align:center; width:3%")),
  "code"=>array("Mã nhân viên",array("style"=>"text-align:center; width:8%")),
  "name"=>array("Họ và tên",array("style"=>"text-align:center; width:13%")), 
  "gender"=>array("Giới tính",array("style"=>"text-align:center;width:8%")),
  "type"=>array("Hình thức",array("style"=>"text-align:center;width:8%")),
  "position"=>array("Chức vụ",array("style"=>"text-align:center;width:8%")),
  "department"=>array("Phòng ban",array("style"=>"text-align:center;width:10%")),
  "holiday"=>array("Đi làm",array("style"=>"text-align:center;width:10%")),
  "sogio"=>array("Số giờ",array("style"=>"text-align:center;width:10%"))
);

  //2: lấy dòng tr header
$str_form_attendance = $this->Template->load_table_header($array_header_attendance);

  //---------------------------------------------------------

$str_table_row_day_shift = "";


  $stt=0;

  foreach ($array_user as $user) {

 $str_input_num_hour = $this->Template->load_textbox(array("name"=>"data[$stt][num_hour]","id"=>"num_hour","style"=>"width:100px; margin-top:10px;"));
    $str_input_id_user = $this->Template->load_hidden(array("name"=>"data[$stt][id_user]","id"=>"id_user","value"=>$user["id"],"style"=>"width:100px; margin-top:10px;"));
    $str_input_attendance_code = $this->Template->load_hidden(array("name"=>"data[$stt][user_code]","id"=>"user_code","value"=>$user["user_code"],"style"=>"width:100px; margin-top:10px;"));
    $str_input_attendance_fullname = $this->Template->load_hidden(array("name"=>"data[$stt][user_name]","id"=>"user_name","value"=>$user["fullname"],"style"=>"width:100px;  margin-top:10px;"));
    $str_input_attendance_gender = $this->Template->load_hidden(array("name"=>"data[$stt][gender]","id"=>"gender","value"=>$user["gender"],"style"=>"width:100px;  margin-top:10px;"));
    $str_input_attendance_labor_type = $this->Template->load_hidden(array("name"=>"data[$stt][labor_type]","id"=>"labor_type","value"=>$user["labor_type"],"style"=>"width:100px; margin-top:10px;"));
    $str_input_attendance_department = $this->Template->load_hidden(array("name"=>"data[$stt][department]","id"=>"department","value"=>$user["department"],"style"=>"width:100px; margin-top:10px;"));
    $str_input_attendance_position = $this->Template->load_hidden(array("name"=>"data[$stt][position]","id"=>"position","value"=>$user["position"],"style"=>"width:100px; margin-top:10px;"));

    $str_input_id_department = $this->Template->load_hidden(array("name"=>"data[$stt][id_department]","id"=>"id_department","value"=>$user["id_department"],"style"=>"width:100px; margin-top:10px;"));
    $str_input_id_position = $this->Template->load_hidden(array("name"=>"data[$stt][id_position]","id"=>"id_position","value"=>$user["id_position"],"style"=>"width:100px; margin-top:10px;"));

    $str_input_id_factory = $this->Template->load_hidden(array("name"=>"data[$stt][id_factory]","id"=>"id_factory","value"=>$user["id_factory"],"style"=>"width:100px; margin-top:10px;"));
    $str_input_id_manufactory = $this->Template->load_hidden(array("name"=>"data[$stt][id_manufactory]","id"=>"id_manufactory","value"=>$user["id_manufactory"],"style"=>"width:100px; margin-top:10px;"));
    $str_input_id_work = $this->Template->load_hidden(array("name"=>"data[$stt][id_work]","id"=>"id_work","value"=>$user["id_work"],"style"=>"width:100px; margin-top:10px;"));

    $array_part =array( "1"=>"Có","2"=>"Không");
    $str_select_part = $this->Template->load_selectbox_basic(array("name"=>"dilam","autocomplete"=>"off","id"=>"dilam","style"=>"width:100px"),$array_part);
     // bảng chọn loại ngày công
    $stt++;

        // dùng hàm load table row để lấy nội dung cho bảng
    $array_table_row_day_shift =  array("stt"=>array($stt.$str_input_id_user ,array("style"=>"text-align:center; width:3%")),
      "code"=>array($user["user_code"].$str_input_attendance_code,array("style"=>"text-align:center")),
      "name"=>array($user["fullname"].$str_input_attendance_fullname. $str_input_id_work,array("style"=>"text-align:center")),
      "gender"=>array($user["gender"].$str_input_attendance_gender.$str_input_id_manufactory,array("style"=>"text-align:center;width:10%")),
      "type"=>array($user["labor_type"].$str_input_attendance_labor_type.$str_input_id_factory,array("style"=>"text-align:center;width:13%")),
      "position"=>array($user["position"].$str_input_attendance_position.$str_input_id_position,array("style"=>"text-align:center;width:10%")),
      "department"=>array($user["department"].$str_input_attendance_department. $str_input_id_department,array("style"=>"text-align:center;width:10%")),

      "holiday"=>array($str_select_part,array("style"=>"text-align:center;width:10%")),
       "sogio"=>array($str_input_num_hour,array("style"=>"text-align:center;width:10%")),
    );

    $str_form_attendance .= $this->Template->load_table_row($array_table_row_day_shift);

  }

$str_save_button =  $this->Template->load_button(array("type"=>"submit","onclick"=>"luu()"),"Lưu");
$array_table_row_day_shift =  array("stt"=>array("" ,array("style"=>"text-align:center; width:3%")),
  "code"=>array("",array("style"=>"text-align:center")),
  "name"=>array("",array("style"=>"text-align:center")),
  "gender"=>array("",array("style"=>"text-align:center;width:10%")),
  "type"=>array("",array("style"=>"text-align:center;width:13%")),
  "position"=>array("",array("style"=>"text-align:center;width:10%")),
  "department"=>array($str_save_button,array("style"=>"text-align:center;width:10%")),

  "holiday"=>array("",array("style"=>"text-align:center;width:10%")),
);

$str_form_attendance .= $this->Template->load_table_row($array_table_row_day_shift);


$str_form_attendance =$this->Template->load_table($str_form_attendance);


    //đưa vào table
$str_form_attendance = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"/attendance2/add_holiday?debug=code"),$str_input_hoiday1.$str_form_attendance);



?>
<div class="parent">

 <?php
 echo $str_input_hoiday;
 echo $str_form_attendance; 
 ?>

</div>



<script type="text/javascript">
 $( function() {
  $( "#date" ).datepicker({dateFormat: "dd-mm-yy"});
} );
</script>






