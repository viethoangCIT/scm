<?php

	//tạo tiêu đề hàm
if($array_edit_day_shift)
{
  $function_title = "Sửa chấm công hành chính";
  echo $this->Template->load_function_header($function_title);
}
else
{
  $function_title = "Nhập chấm công hành chính";
  echo $this->Template->load_function_header($function_title);
}

// BEGIN: FORM SEARCH----------------------------------------------------
array_unshift($array_department, array("id"=>"","name"=>"Chọn phòng ban"));
array_unshift($array_factory, array("id"=>"","name"=>"Chọn nhà máy"));
array_unshift($array_work, array("id"=>"","name"=>"Chọn công việc"));
array_unshift($array_position, array("id"=>"","name"=>"Chọn chức vụ"));
array_unshift($array_manufactory, array("id"=>"","name"=>"Chọn phân xưởng"));

//phong ban
$str_select_department = $this->Template->load_selectbox(array("name"=>"id_department","autocomplete"=>"off","value"=>"","id"=>"id_department","style"=>"width:130px"),$array_department,$id_department);
// chức vụ
$str_select_position = $this->Template->load_selectbox(array("name"=>"id_position","autocomplete"=>"off","value"=>"","id"=>"id_position","style"=>"width:130px"),$array_position,$id_position);

// lọc theo công việc
$str_select_work = $this->Template->load_selectbox(array("name"=>"id_work","autocomplete"=>"off","value"=>"","id"=>"id_work","style"=>"width:130px"),$array_work,$id_work);

// lọc theo nhà máy
$str_select_factory    =  $this->Template->load_selectbox(array("name"=>"id_factory","autocomplete"=>"off","value"=>"","id"=>"id_factory","style"=>"width:130px"),$array_factory,$id_factory);

// lọc theo phân xưởng
$str_select_manufactory = $this->Template->load_selectbox(array("name"=>"id_manufactory","autocomplete"=>"off","value"=>"","id"=>"part","style"=>"width:130px"),$array_manufactory,$id_manufactory);
$date = "";
if($array_edit_day_shift) $date = date("d-m-Y",strtotime($array_edit_day_shift[0]["date"]));

$str_input_from = $this->Template->load_textbox(array("name"=>"date","autocomplete"=>"off","value"=>$date,"id"=>"date", "class"=>"day","style"=>"width:130px; border:1px solid #ff631d!important;border-radius: 0px !important;", "onchange"=>"document.getElementById('hidden_date').value = document.getElementById('date').value"));

$str_btn_save = "<input type='submit' class='timkiem'value='Tìm kiếm' style='font-size: 13.4px; margin-top:10px'>";
//nhập nhân viên
$str_input_name_attendance = $this->Template->load_textbox(array("name"=>"name","autocomplete"=>"off","value"=>$name,"id"=>"name", "placeholder"=>"Nhập tên nhân viên"));
$str_input_attendance_day ="Chọn ngày:$str_input_from $str_select_department  $str_select_position  $str_select_work  $str_select_factory  $str_select_manufactory $str_input_name_attendance $str_btn_save ";

$str_form_attendance_day = $this->Template->load_form(array("method"=>"GET","id"=>"form_search","action"=>"/attendance2/add_day_shift?debug=code"),$str_input_attendance_day);
// END: FORM SEARCH----------------------------------------------------







// BEGIN: HIỂN THỊ USER CẦN SỬA
if($array_edit_day_shift !=null)
{
  // BEGIN: TẠO TABLE HEADER
  $str_form_attendance = "";
  $array_header_attendance =  array("stt"=>array("STT",array("style"=>"text-align:center; width:3%")),
    "code"=>array("Mã nhân viên",array("style"=>"text-align:center; width:8%")),
    "name"=>array("Họ và tên",array("style"=>"text-align:center; width:13%")), 
    "gender"=>array("Giới tính",array("style"=>"text-align:center;width:5%")),
    "type"=>array("Hình thức",array("style"=>"text-align:center;width:5%")),
    "position"=>array("Chức vụ",array("style"=>"text-align:center;width:8%")),
    "department"=>array("Phòng ban",array("style"=>"text-align:center;width:5%")),
    "ngay"=>array("Ngày",array("style"=>"text-align:center;width:5%")),
    "go_work"=>array("Đi làm",array("style"=>"text-align:center;width:5%")),
    "attendance_type"=>array("Loại",array("style"=>"text-align:center;width:10%")),

    "num_hour"=>array("Số giờ",array("style"=>"text-align:center;width:10%"))
  );

//2: lấy dòng tr header
  $str_form_attendance = $this->Template->load_table_header($array_header_attendance);
// END: TẠO TABLE HEADER

  $stt=0;

  foreach ($array_edit_day_shift as $day_shift) 
  {


   $array_work_attendance = array("1"=>"Ngày công hết hàng cho về","2"=> "Ngay công hết hàng không lương", "3" =>"Ngày nghỉ bảo hiểm hoặc bệnh", "6" =>"Ngày công chủ nhật", "7" =>"Ngày nghỉ có phép", "8" =>"Ngày nghỉ vô phép", "9"=>"Ngày không bấm thẻ", "10"=>"Ngày công tính tiền sữa","11"=>"Ngày công đi muộn(đủ 8h)");
   $str_select_work_attendance = $this->Template->load_selectbox_basic(array("name"=>"data[$stt][id_date_allowance]","autocomplete"=>"off","id"=>"type_shift"),$array_work_attendance,$day_shift["id_date_allowance"]);

   $str_input_id = $this->Template->load_hidden(array("name"=>"data[$stt][id]","id"=>"id","value"=>$day_shift["id"],"style"=>"width:100px; margin-top:10px;"));
   $str_input_date = $this->Template->load_textbox(array("name"=>"date","id"=>"date","value"=>$day_shift["date"],"style"=>"width:100px; margin-top:10px;"));

   $str_input_id_user = $this->Template->load_hidden(array("name"=>"data[$stt][id_user]","id"=>"id_user","value"=>$day_shift["id_user"],"style"=>"width:100px; margin-top:10px;"));
   $str_input_attendance_code = $this->Template->load_hidden(array("name"=>"data[$stt][user_code]","id"=>"user_code","value"=>$day_shift["user_code"],"style"=>"width:100px; margin-top:10px;"));
   $str_input_attendance_fullname = $this->Template->load_hidden(array("name"=>"data[$stt][fullname]","id"=>"fullname","value"=>$day_shift["fullname"],"style"=>"width:100px;  margin-top:10px;"));
   $str_input_attendance_gender = $this->Template->load_hidden(array("name"=>"data[$stt][gender]","id"=>"gender","value"=>$day_shift["gender"],"style"=>"width:100px;  margin-top:10px;"));
   $str_input_attendance_labor_type = $this->Template->load_hidden(array("name"=>"data[$stt][labor_type]","id"=>"labor_type","value"=>$day_shift["labor_type"],"style"=>"width:100px; margin-top:10px;"));
   $str_input_attendance_department = $this->Template->load_hidden(array("name"=>"data[$stt][department]","id"=>"department","value"=>$day_shift["department"],"style"=>"width:100px; margin-top:10px;"));
   $str_input_attendance_position = $this->Template->load_hidden(array("name"=>"data[$stt][position]","id"=>"position","value"=>$day_shift["position"],"style"=>"width:100px; margin-top:10px;"));

   $str_input_id_department = $this->Template->load_hidden(array("name"=>"data[$stt][id_department]","id"=>"id_department","value"=>$day_shift["id_department"],"style"=>"width:100px; margin-top:10px;"));
   $str_input_id_position = $this->Template->load_hidden(array("name"=>"data[$stt][id_position]","id"=>"id_position","value"=>$day_shift["id_position"],"style"=>"width:100px; margin-top:10px;"));

   $str_input_id_factory = $this->Template->load_hidden(array("name"=>"data[$stt][id_factory]","id"=>"id_factory","value"=>$day_shift["id_factory"],"style"=>"width:100px; margin-top:10px;"));
   $str_input_id_manufactory = $this->Template->load_hidden(array("name"=>"data[$stt][id_manufactory]","id"=>"id_manufactory","value"=>$day_shift["id_manufactory"],"style"=>"width:100px; margin-top:10px;"));
   $str_input_id_work = $this->Template->load_hidden(array("name"=>"data[$stt][id_work]","id"=>"id_work","value"=>$day_shift["id_work"],"style"=>"width:100px; margin-top:10px;"));

   $str_input_num_hour = $this->Template->load_textbox(array("name"=>"data[$stt][num_hour]","id"=>"num_hour_$stt","style"=>"width:100px; margin-top:10px;","value"=>$day_shift["num_hour"]));

   $array_word_type = array("1"=>"Có","0"=>"Không");
   $str_select_attendance = $this->Template->load_selectbox_basic(array("name"=>"data[$stt][id_go_work]","autocomplete"=>"off","id"=>"id_go_work","style"=>"width:90px;"),$array_word_type,$day_shift["id_go_work"]);

   $stt++;
    // dùng hàm load table row để lấy nội dung cho bảng
   $array_table_row_day_shift =  array("stt"=>array(1,array("style"=>"text-align:center; width:3%")),
    "code"=>array($day_shift["user_code"],array("style"=>"text-align:center")),
    "name"=>array($day_shift["fullname"],array("style"=>"text-align:center")),
    "gender"=>array($day_shift["gender"],array("style"=>"text-align:center;width:10%")),
    "type"=>array($day_shift["labor_type"],array("style"=>"text-align:center;width:13%")),
    "department"=>array($day_shift["department"],array("style"=>"text-align:center;width:10%")),
    "position"=>array($day_shift["position"],array("style"=>"text-align:center;width:10%")),
    "date"=>array($str_input_date,array("style"=>"text-align:center;width:10%")),
    "go_work"=>array($str_select_attendance,array("style"=>"text-align:center;width:10%")),
    "loai"=>array($str_select_work_attendance,array("style"=>"text-align:center;width:10%")),
    "num_hour"=>array($str_input_num_hour.$str_input_id,array("style"=>"text-align:center;width:10%")),
  );

   $str_form_attendance .= $this->Template->load_table_row($array_table_row_day_shift);

} //END foreach ($array_edit_day_shift as $day_shift) {
} //end if($array_edit_day_shift !=null)
// END: HIỂN THỊ USER CẦN SỬA


// BEGIN: HIỂN THỊ DANH SÁCH USER CẦN THÊM
else{	
  // BEGIN: TẠO TABLE HEADER
  $str_form_attendance = "";
  $str_input_date_hidden = $this->Template->load_hidden(array("name"=>"date","id"=>"hidden_date","style"=>"width:70px; margin-top:10px;" ));

  $array_header_attendance =  array("stt"=>array("STT",array("style"=>"text-align:center; width:3%")),
    "code"=>array("Mã nhân viên",array("style"=>"text-align:center; width:8%")),
    "name"=>array("Họ và tên",array("style"=>"text-align:center; width:13%")), 
    "gender"=>array("Giới tính",array("style"=>"text-align:center;width:5%")),
    "type"=>array("Hình thức",array("style"=>"text-align:center;width:5%")),
    "position"=>array("Chức vụ",array("style"=>"text-align:center;width:8%")),
    "department"=>array("Phòng ban",array("style"=>"text-align:center;width:5%")),
    "go_work"=>array("Đi làm",array("style"=>"text-align:center;width:5%")),
    "attendance_type"=>array("Loại",array("style"=>"text-align:center;width:10%")),
    "num_hour"=>array("Số giờ",array("style"=>"text-align:center;width:10%"))
  );

//2: lấy dòng tr header
  $str_form_attendance = $this->Template->load_table_header($array_header_attendance);
// END: TẠO TABLE HEADER
  $stt=0;
  foreach ($array_user as $user)
  {


   $array_work_attendance = array("1"=>"Ngày công hết hàng cho về","2"=> "Ngay công hết hàng không lương", "3" =>"Ngày nghỉ bảo hiểm hoặc bệnh", "6" =>"Ngày công chủ nhật", "7" =>"Ngày nghỉ có phép", "8" =>"Ngày nghỉ vô phép", "9"=>"Ngày không bấm thẻ", "10"=>"Ngày công tính tiền sữa","11"=>"Ngày công đi muộn(đủ 8h)");
   $str_select_work_attendance = $this->Template->load_selectbox_basic(array("name"=>"data[$stt][id_date_allowance]","autocomplete"=>"off","id"=>"type_shift"),$array_work_attendance);

   $str_input_type = $this->Template->load_hidden(array("name"=>"data[$stt][type]","id"=>"type","value"=>0,"style"=>"width:70px; margin-top:10px;"));
   $str_input_id_user = $this->Template->load_hidden(array("name"=>"data[$stt][id_user]","id"=>"id_user","value"=>$user["id"],"style"=>"width:100px; margin-top:10px;"));
   $str_input_attendance_code = $this->Template->load_hidden(array("name"=>"data[$stt][user_code]","id"=>"user_code","value"=>$user["user_code"],"style"=>"width:100px; margin-top:10px;"));
   $str_input_attendance_fullname = $this->Template->load_hidden(array("name"=>"data[$stt][fullname]","id"=>"fullname","value"=>$user["fullname"],"style"=>"width:100px;  margin-top:10px;"));
   $str_input_attendance_gender = $this->Template->load_hidden(array("name"=>"data[$stt][gender]","id"=>"gender","value"=>$user["gender"],"style"=>"width:100px;  margin-top:10px;"));
   $str_input_attendance_labor_type = $this->Template->load_hidden(array("name"=>"data[$stt][labor_type]","id"=>"labor_type","value"=>$user["labor_type"],"style"=>"width:100px; margin-top:10px;"));
   $str_input_attendance_department = $this->Template->load_hidden(array("name"=>"data[$stt][department]","id"=>"department","value"=>$user["department"],"style"=>"width:100px; margin-top:10px;"));
   $str_input_attendance_position = $this->Template->load_hidden(array("name"=>"data[$stt][position]","id"=>"position","value"=>$user["position"],"style"=>"width:100px; margin-top:10px;"));
   $str_input_id_department = $this->Template->load_hidden(array("name"=>"data[$stt][id_department]","id"=>"id_department","value"=>$user["id_department"],"style"=>"width:100px; margin-top:10px;"));
   $str_input_id_position = $this->Template->load_hidden(array("name"=>"data[$stt][id_position]","id"=>"id_position","value"=>$user["id_position"],"style"=>"width:100px; margin-top:10px;"));
   $str_input_id_factory = $this->Template->load_hidden(array("name"=>"data[$stt][id_factory]","id"=>"id_factory","value"=>$user["id_factory"],"style"=>"width:100px; margin-top:10px;"));
   $str_input_id_manufactory = $this->Template->load_hidden(array("name"=>"data[$stt][id_manufactory]","id"=>"id_manufactory","value"=>$user["id_manufactory"],"style"=>"width:100px; margin-top:10px;"));
   $str_input_id_work = $this->Template->load_hidden(array("name"=>"data[$stt][id_work]","id"=>"id_work","value"=>$user["id_work"],"style"=>"width:100px; margin-top:10px;"));



   $array_word_type = array("1"=>"Có","0"=>"Không");
   $str_select_attendance = $this->Template->load_selectbox_basic(array("name"=>"data[$stt][id_go_work]","autocomplete"=>"off","id"=>"id_go_work","style"=>"width:90px;"),$array_word_type);

    // textbox số giờ làm việc
   $str_input_num_hour = $this->Template->load_textbox(array("name"=>"data[$stt][num_hour]","id"=>"num_hour_$stt","style"=>"width:100px; margin-top:10px;"));
   $stt++;
    // dùng hàm load table row để lấy nội dung cho bảng
   $array_table_row_day_shift =  array("stt"=>array($stt.$str_input_id_user ,array("style"=>"text-align:center; width:3%")),
    "code"=>array($user["user_code"].$str_input_attendance_code,array("style"=>"text-align:center")),
    "name"=>array($user["fullname"].$str_input_attendance_fullname,array("style"=>"text-align:center")),
    "gender"=>array($user["gender"].$str_input_attendance_gender,array("style"=>"text-align:center;")),
    "type"=>array($user["labor_type"].$str_input_attendance_labor_type,array("style"=>"text-align:center;")),
    "department"=>array($user["department"].$str_input_attendance_department.$str_input_id_department.$str_input_id_factory,array("style"=>"text-align:center;")),
    "position"=>array($user["position"].$str_input_attendance_position.$str_input_id_position.$str_input_id_manufactory,array("style"=>"text-align:center;")),
    "go_work"=>array($str_select_attendance.$str_input_id_work,array("style"=>"text-align:center;")),
     "loai"=>array($str_select_work_attendance,array("style"=>"text-align:center;")),
    "num_hour"=>array($str_input_num_hour.$str_input_type,array("style"=>"text-align:center;width:10%")),
  );

   $str_form_attendance .= $this->Template->load_table_row($array_table_row_day_shift);

  }// end  foreach ($array_user as $user)
} // end else if($array_edit_day_shift !=null)
// END: HIỂN THỊ DANH SÁCH USER CẦN THÊM

// TẠO INPUT HIDDEN LẤY NGÀY CỦA INPUT NGÀY TRÊN FORM SEARCH

// nut luu
$str_save_button =  $this->Template->load_button(array("type"=>"button","onclick"=>"luu()"),"Lưu");

// BEGIN: TẠO TABLE ROW CHỨA NÚT LƯU
if ($array_edit_day_shift == NULL) 
{
  

$array_table_row_day_shift_1=  array("stt"=>array("",array("style"=>"text-align:center; width:3%")),
  "code"=>array("",array("style"=>"text-align:center","colspan"=>"7")),
  "position"=>array($str_save_button ,array("style"=>"text-align:center;width:10%")),
  "go_work"=>array("",array("style"=>"text-align:center;width:10%")),
);
}
else 
{
  $array_table_row_day_shift_1=  array("stt"=>array("",array("style"=>"text-align:center; width:3%")),
  "code"=>array("",array("style"=>"text-align:center","colspan"=>"8")),
  "position"=>array($str_save_button ,array("style"=>"text-align:center;width:10%")),
  "go_work"=>array("",array("style"=>"text-align:center;width:10%")),
);
}
$str_form_attendance .= $this->Template->load_table_row($array_table_row_day_shift_1);
// END: TẠO TABLE ROW CHỨA NÚT LƯU

//đưa vào table
$str_table_attendance = $this->Template->load_table($str_form_attendance);

//ĐƯA VÀO FORM 
$str_form_table_attendance = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"/attendance2/add_day_shift"),$str_table_attendance. $str_input_date_hidden);


if($array_edit_day_shift == NULL) echo $str_form_attendance_day;
echo $str_form_table_attendance; 
?>
<script type="text/javascript">
 $( function() {
  $( "#date" ).datepicker({dateFormat: "dd-mm-yy"});
} );
</script>
<script type="text/javascript">
  function luu()
  {
    if(document.getElementById('date').value == "")
    {
      alert("Xin vui lòng chọn ngày");
      document.getElementById('date').focus();
      return;
    }
    document.getElementById('form_nhap').submit();
  }
</script>






