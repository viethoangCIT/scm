
<style type="text/css">

.tbl_r{

}
.table-responsive{ 
  width: 1700px;
  
}


.parent{
  height: auto;
  position: absolute;
  width: 100%;
  left: 0;
  overflow-y:hidden;
}

</style>



<?php




//tạo tiêu đề hàm
$function_title = "Nhập chấm công theo ca";
echo $this->Template->load_function_header($function_title);

$str_form_attendance = "";


// BEGIN: FORM SEARCH
if($array_edit_night_shitf) $date_from = date("d-m-Y",strtotime($array_edit_night_shitf[0]["date"]));
$str_input_from = $this->Template->load_textbox(array("name"=>"date","autocomplete"=>"off","value"=>$date_from,"id"=>"date", "class"=>"date","style"=>"width:100px;","onchange"=>"document.getElementById('date_hidden').value = document.getElementById('date').value"));
   //--------------------------------------------------
//phong ban
array_unshift($array_department, array("id"=>"","name"=>"Phòng ban"));
$str_select_department = $this->Template->load_selectbox(array("name"=>"id_department","autocomplete"=>"off","value"=>"","id"=>"id_department","style"=>"width:100px"),$array_department,$id_department);

// chức vụ
array_unshift($array_position, array("id"=>"","name"=>"Chức vụ"));
$str_select_position = $this->Template->load_selectbox(array("name"=>"id_position","autocomplete"=>"off","value"=>"","id"=>"id_position","style"=>"width:100px"),$array_position,$id_position);

// lọc theo công việc
array_unshift($array_work, array("id"=>"","name"=>"Công việc"));
$str_select_work = $this->Template->load_selectbox(array("name"=>"id_work","autocomplete"=>"off","value"=>"","id"=>"id_work","style"=>"width:100px"),$array_work,$id_work);

// lọc theo nhà máy
array_unshift($array_factory, array("id"=>"","name"=>"Nhà máy"));
$str_select_factory    =  $this->Template->load_selectbox(array("name"=>"id_factory","autocomplete"=>"off","value"=>"","id"=>"id_factory","style"=>"width:100px"),$array_factory,$id_factory);

// lọc theo phân xưởng
array_unshift($array_manufactory, array("id"=>"","name"=>"Phân xưởng"));
$str_select_manufactory = $this->Template->load_selectbox(array("name"=>"id_manufactory","autocomplete"=>"off","value"=>"","id"=>"part","style"=>"width:100px"),$array_manufactory,$id_manufactory);

// chon ca
$array_part =array( "0"=>"Chọn ca","1"=>"Ca 1", "2"=>"Ca 2", "3"=>"Ca 3");
$str_select_part = $this->Template->load_selectbox_basic(array("name"=>"shift","autocomplete"=>"off","id"=>"shift","style"=>"width:100px","onchange"=>"document.getElementById('shift_hidden').value = document.getElementById('shift').value"),$array_part);

$str_input_name_attendance = $this->Template->load_textbox(array("name"=>"name","autocomplete"=>"off","value"=>$name,"id"=>"name", "placeholder"=>"Nhập tên nhân viên"));

$str_btn_save = "<input type='submit' class='timkiem'value='Tìm kiếm' style='font-size: 13.4px'>";
$str_btn_luu = "<input type='submit' class='btn-primary'value='Lưu' style='font-size: 13.4px'>";

$str_input_add_night ="Chọn ngày: $str_input_from Chọn ca: $str_select_part $str_select_department  $str_select_position  $str_select_work  $str_select_factory  $str_select_manufactory $str_input_name_attendance $str_btn_save ";

$str_form_search = $this->Template->load_form(array("method"=>"GET","id"=>"form_search","action"=>"/attendance2/add_night_shift"),$str_input_add_night);
echo $str_form_search;

// BEGIN: FORM SEARCH



$array_header_attendance =  array("stt"=>array("STT",array("style"=>"text-align:center; width:3%")),
  "code"=>array("Mã nhân viên",array("style"=>"text-align:center; width:5%")),
  "name"=>array("Họ và tên",array("style"=>"text-align:center; width:12%")), 
  "gender"=>array("Giới tính",array("style"=>"text-align:center;width:2%")),
  "type"=>array("Hình thức",array("style"=>"text-align:center;width:5%")),
  "position"=>array("Phòng ban/</br>Chức vụ",array("style"=>"text-align:center;width:5%")),
  "work_type"=>array("Công việc",array("style"=>"text-align:center;width:4%")),
  "factory"=>array("Nhà máy</br>Phân xưởng/ Tổ",array("style"=>"text-align:center;width:5%")),
  "sogio"=>array("Số giờ",array("style"=>"text-align:center;width:2%")),
  "go_work"=>array("Đi làm",array("style"=>"text-align:center;width:7%")),



  "attendance_type"=>array("Loại",array("style"=>"text-align:center;width:10%")),


);

  //2: lấy dòng tr header
$str_form_attendance = $this->Template->load_table_header($array_header_attendance);

  //---------------------------------------------------------
$str_input_type = $this->Template->load_hidden(array("name"=>"type","id"=>"type","value"=>1,"style"=>"width:70px; margin-top:10px;"));
$str_table_row_night_shift = "";

if($array_edit_night_shitf != null){

  $stt=0;

  foreach ($array_edit_night_shitf as $night_shift) {


    $str_input_id = $this->Template->load_hidden(array("name"=>"data[$stt][id]","id"=>"id","value"=>$night_shift["id"],"style"=>"width:70px; margin-top:10px;")); 
     $str_input_num_hour = $this->Template->load_textbox(array("name"=>"data[$stt][id]","id"=>"id","value"=>$night_shift["num_hour"],"style"=>"width:70px; margin-top:10px;")); 

    $str_input_id_user = $this->Template->load_hidden(array("name"=>"data[$stt][id_user]","id"=>"id_user","value"=>$night_shift["id_user"],"style"=>"width:1070px; margin-top:10px;"));
    $str_input_attendance_code = $this->Template->load_hidden(array("name"=>"data[$stt][user_code]","id"=>"user_code","value"=>$night_shift["user_code"],"style"=>"width:70px; margin-top:10px;"));
    $str_input_attendance_fullname = $this->Template->load_hidden(array("name"=>"data[$stt][fullname]","id"=>"fullname","value"=>$night_shift["fullname"],"style"=>"width:70px;  margin-top:10px;"));
    $str_input_attendance_gender = $this->Template->load_hidden(array("name"=>"data[$stt][gender]","id"=>"gender","value"=>$night_shift["gender"],"style"=>"width:30px;  margin-top:10px;"));
    $str_input_attendance_labor_type = $this->Template->load_hidden(array("name"=>"data[$stt][labor_type]","id"=>"labor_type","value"=>$night_shift["labor_type"],"style"=>"width:70px; margin-top:10px;"));
    $str_input_attendance_department = $this->Template->load_hidden(array("name"=>"data[$stt][department]","id"=>"department","value"=>$night_shift["department"],"style"=>"width:70px; margin-top:10px;"));
    $str_input_attendance_position = $this->Template->load_hidden(array("name"=>"data[$stt][position]","id"=>"position","value"=>$night_shift["position"],"style"=>"width:70px"));
    $str_input_attendance_work_type = $this->Template->load_hidden(array("name"=>"data[$stt][work]","id"=>"position","value"=>$night_shift["work"],"style"=>"width:70px"));
    $str_input_attendance_factory = $this->Template->load_hidden(array("name"=>"data[$stt][factory]","id"=>"factory","value"=>$night_shift["factory"],"style"=>"width:70px"));
    $str_input_attendance_manufactory = $this->Template->load_hidden(array("name"=>"data[$stt][manufactory]","id"=>"manufactory","value"=>$night_shift["manufactory"],"style"=>"width:70px"));
    $str_input_attendance_team = $this->Template->load_hidden(array("name"=>"data[$stt][team]","id"=>"team","value"=>$night_shift["team"],"style"=>"width:30px"));

    


    $array_word_type = array("1"=>"Có","0"=>"Không");
    $str_select_attendance = $this->Template->load_selectbox_basic(array("name"=>"data[$stt][id_go_work]","autocomplete"=>"off","id"=>"id_go_work","style"=>"width:120px;"),$array_word_type);

     // bảng chọn loại ngày công
    $array_work_attendance = array("1"=>"Ngày công hết hàng cho về","2"=> "Ngay công hết hàng không lương", "3" =>"Ngày nghỉ bảo hiểm hoặc bệnh", "6" =>"Ngày công chủ nhật", "7" =>"Ngày nghỉ có phép", "8" =>"Ngày nghỉ vô phép", "9"=>"Ngày không bấm thẻ", "10"=>"Ngày công tính tiền sữa","11"=>"Ngày công đi muộn(đủ 8h)");
    $str_select_work_attendance = $this->Template->load_selectbox_basic(array("name"=>"data[$stt][id_date_allowance]","autocomplete"=>"off","id"=>"type_shift"),$array_work_attendance);
    $stt++;

    // dùng hàm load table row để lấy nội dung cho bảng
    $array_table_row_night_shift =  array(
      "stt"=>array($stt.$str_input_id_user.$str_input_id ,array("style"=>"text-align:center; width:3%")),
      "code"=>array($night_shift["user_code"].$str_input_attendance_code,array("style"=>"text-align:center")),
      "name"=>array($night_shift["fullname"].$str_input_attendance_fullname,array("style"=>"text-align:center")),
      "gender"=>array($night_shift["gender"].$str_input_attendance_gender,array("style"=>"text-align:center")),
      "type"=>array($night_shift["labor_type"].$str_input_attendance_labor_type,array("style"=>"text-align:center")),
      "department"=>array($night_shift["department"]."</br>".$night_shift["position"],array("style"=>"text-align:center")),
      "work_type"=>array($night_shift["work"],array("style"=>"text-align:center")),
      "factory"=>array($night_shift["factory"]."</br>".$night_shift["manufactory"]."</br>".$night_shift["team"],array("style"=>"text-align:center")),
     "num_hour"=>array($str_input_num_hour.$str_input_from_hidden,array("style"=>"text-align:center;width:5%")),
      "go_work"=>array($str_select_attendance.$str_input_type,array("style"=>"text-align:center;width:5%")),
      "attendance_type"=>array($str_select_work_attendance.$str_input_shift_hidden,array("style"=>"text-align:center;width:10%")),

    );

    $str_form_attendance .= $this->Template->load_table_row($array_table_row_night_shift);

  }
  
}
else{
  $stt=0;

  foreach ($array_user as $user) {

    $str_input_id_user = $this->Template->load_hidden(array("name"=>"data[$stt][id_user]","id"=>"id_user","value"=>$user["id"],"style"=>"width:70px; margin-top:10px;"));

    $str_input_attendance_code = $this->Template->load_hidden(array("name"=>"data[$stt][user_code]","id"=>"user_code","value"=>$user["user_code"],"style"=>"width:70px; margin-top:10px;"));
    $str_input_attendance_fullname = $this->Template->load_hidden(array("name"=>"data[$stt][fullname]","id"=>"fullname","value"=>$user["fullname"],"style"=>"width:70px;  margin-top:10px;"));
    $str_input_attendance_gender = $this->Template->load_hidden(array("name"=>"data[$stt][gender]","id"=>"gender","value"=>$user["gender"],"style"=>"width:70px;  margin-top:10px;"));
    $str_input_attendance_labor_type = $this->Template->load_hidden(array("name"=>"data[$stt][labor_type]","id"=>"labor_type","value"=>$user["labor_type"],"style"=>"width:70px; margin-top:10px;"));
    $str_input_attendance_department = $this->Template->load_hidden(array("name"=>"data[$stt][department]","id"=>"department","value"=>$user["department"],"style"=>"width:70px; margin-top:10px;"));
    $str_input_attendance_position = $this->Template->load_hidden(array("name"=>"data[$stt][position]","id"=>"position","value"=>$user["position"],"style"=>"width:70px; margin-top:10px;"));
    $str_input_attendance_work_type = $this->Template->load_hidden(array("name"=>"data[$stt][work]","id"=>"position","value"=>$user["work"],"style"=>"width:70px; margin-top:10px;"));
    $str_input_attendance_factory = $this->Template->load_hidden(array("name"=>"data[$stt][factory]","id"=>"factory","value"=>$user["factory"],"style"=>"width:70px; margin-top:10px;"));
    $str_input_attendance_manufactory = $this->Template->load_hidden(array("name"=>"data[$stt][manufactory]","id"=>"manufactory","value"=>$user["manufactory"],"style"=>"width:70px; margin-top:10px;"));
    $str_input_attendance_team = $this->Template->load_hidden(array("name"=>"data[$stt][team]","id"=>"team","value"=>$user["team"],"style"=>"width:30px; margin-top:10px;"));

    $str_input_attendance_hours_150 = $this->Template->load_textbox(array("name"=>"data[$stt][hours_150]","id"=>"hours_150","value"=>"","style"=>"width:70px"));
    $str_input_attendance_hours_200 = $this->Template->load_textbox(array("name"=>"data[$stt][hours_200]","id"=>"hours_200","value"=>"","style"=>"width:70px"));
    $str_input_attendance_hours_300 = $this->Template->load_textbox(array("name"=>"data[$stt][hours_300]","id"=>"hours_300","value"=>"","style"=>"width:70px"));
    
    $array_word_type = array("1"=>"Có","0"=>"Không");
    $str_select_attendance = $this->Template->load_selectbox_basic(array("name"=>"data[$stt][id_go_work]","autocomplete"=>"off","id"=>"id_go_work","style"=>"width:120px;"),$array_word_type);

    

     // bảng chọn loại ngày công
    $array_work_attendance = array("1"=>"Ngày công hết hàng cho về","2"=> "Ngay công hết hàng không lương", "3" =>"Ngày nghỉ bảo hiểm hoặc bệnh", "6" =>"Ngày công chủ nhật", "7" =>"Ngày nghỉ có phép", "8" =>"Ngày nghỉ vô phép", "9"=>"Ngày không bấm thẻ", "10"=>"Ngày công tính tiền sữa","11"=>"Ngày công đi muộn(đủ 8h)");
    $str_select_work_attendance = $this->Template->load_selectbox_basic(array("name"=>"data[$stt][id_date_allowance]","autocomplete"=>"off","id"=>"type_shift"),$array_work_attendance);
    $str_input_num_hour = $this->Template->load_textbox(array("name"=>"data[$stt][num_hour]","id"=>"num_hour_$stt","value"=>"","style"=>"width:70px"));
    $stt++;

        // dùng hàm load table row để lấy nội dung cho bảng
    $array_table_row_night_shift =  array(
      "stt"=>array($stt.$str_input_id_user ,array("style"=>"text-align:center; width:3%")),
      "code"=>array($user["user_code"].$str_input_attendance_code,array("style"=>"text-align:center")),
      "name"=>array($user["fullname"].$str_input_attendance_fullname,array("style"=>"text-align:center")),
      "gender"=>array($user["gender"].$str_input_attendance_gender,array("style"=>"text-align:center;width:10%")),
      "type"=>array($user["labor_type"].$str_input_attendance_labor_type,array("style"=>"text-align:center;width:13%")),

      "department"=>array($user["department"].$str_input_attendance_department."</br>".$user["position"].$str_input_attendance_work_type,array("style"=>"text-align:center;width:10%")),
      "work"=>array($user["work"].$str_input_attendance_position,array("style"=>"text-align:center;width:10%")),
      "factory"=>array($user["factory"].$str_input_attendance_factory."</br>".$user["manufactory"]."</br>".$user["team"],array("style"=>"text-align:center;width:10%")),
      "num_hour"=>array($str_input_num_hour.$str_input_type,array("style"=>"text-align:center;width:5%")),
      "go_work"=>array($str_select_attendance,array("style"=>"text-align:center;width:5%")),


      "attendance_type"=>array($str_select_work_attendance,array("style"=>"text-align:center;width:10%")),
      
    );

    $str_form_attendance .= $this->Template->load_table_row($array_table_row_night_shift);

  }
}
$str_input_from_hidden = $this->Template->load_hidden(array("name"=>"date","autocomplete"=>"off","value"=>"","id"=>"date_hidden", "class"=>"date","style"=>"width:100px;"));
$str_input_shift_hidden = $this->Template->load_hidden(array("name"=>"shift_hidden","autocomplete"=>"off","value"=>"","id"=>"shift_hidden", "class"=>"date","style"=>"width:100px;"));
$str_save_button =  $this->Template->load_button(array("type"=>"button","id"=>"button_luu","onclick"=>"luu()"),"Lưu");

$array_table_row_night_shift =  array("stt"=>array("",array("style"=>"text-align:center; width:3%")),
  "code"=>array("",array("style"=>"text-align:center","colspan"=>"6")),

  "go_work"=>array($str_save_button,array("style"=>"text-align:center;width:5%")),
  "part"=>array("",array("style"=>"text-align:center")),
  "team"=>array("" ,array("style"=>"text-align:center")),
  
  "attendance_type"=>array("",array("style"=>"text-align:center;width:10%")),

);

$str_form_attendance .= $this->Template->load_table_row($array_table_row_night_shift);

$str_form_attendance =$this->Template->load_table($str_form_attendance);

    //đưa vào table
$str_form_attendance = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"/attendance2/add_night_shift?debug=code"), $str_input_from_hidden.$str_input_shift_hidden.$str_form_attendance);

  //echo $str_input_attendance_day;

?>
<div class="parent">

 <?php
 
 echo $str_form_attendance; 
 ?>

</div>



<script type="text/javascript">
  $( function() 
  {
    $( "#date" ).datepicker({dateFormat: "dd-mm-yy"});
  });
</script>
<script>
  function luu()
  {
    // kiểm tra có ngày chấm công không nếu không có thì báo
    if(document.getElementById('date').value == "")
    {
      alert('Xin vui lòng chọn ngày');

      // đưa con trỏ chuột vô vị trí chọn ngày
      document.getElementById('date').focus();
      return;
    } 

    // kiểm tra có chọn ca hay không, nếu không có thì báo
    if(document.getElementById('shift').value == 0)
    {
      alert('Xin vui lòng chọn ca');
      return;
    } 

    // submit form
    document.getElementById('form_nhap').submit();
  }
</script>







