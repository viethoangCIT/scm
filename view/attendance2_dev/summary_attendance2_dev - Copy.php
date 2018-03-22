<style type="text/css">


.table-responsive{

 width: 3000px;

}
.tbl_r{


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

$function_title = "Tổng hợp  chấm công ";
echo $this->Template->load_function_header($function_title);

    // form lọc ngày
$str_form_attendance_content = "";




array_unshift($array_department, array("id"=>"","name"=>"Chọn phòng ban"));
array_unshift($array_factory, array("id"=>"","name"=>"Chọn nhà máy"));
array_unshift($array_work, array("id"=>"","name"=>"Chọn công việc"));
array_unshift($array_position, array("id"=>"","name"=>"Chọn chức vụ"));
array_unshift($array_manufactory, array("id"=>"","name"=>"Chọn phân xưởng"));


    //phong ban

$str_select_department = $this->Template->load_selectbox(array("name"=>"id_department","autocomplete"=>"off","value"=>"","id"=>"id_department","style"=>"width:150px"),$array_department, $id_department);
    // chức vụ

$str_select_position = $this->Template->load_selectbox(array("name"=>"id_position","autocomplete"=>"off","value"=>"","id"=>"id_position","style"=>"width:150px"),$array_position, $id_position);

    // lọc theo công việc

$str_select_work = $this->Template->load_selectbox(array("name"=>"id_work","autocomplete"=>"off","value"=>"","id"=>"id_work","style"=>"width:150px"),$array_work, $id_work);

                // lọc theo nhà máy

$str_select_factory    =  $this->Template->load_selectbox(array("name"=>"id_factory","autocomplete"=>"off","value"=>"","id"=>"id_factory","style"=>"width:150px"),$array_factory,$id_factory);

            // lọc theo phân xưởng

$str_select_part = $this->Template->load_selectbox(array("name"=>"id_manufactory","autocomplete"=>"off","value"=>"","id"=>"part","style"=>"width:150px"),$array_manufactory, $id_manufactory);
if($date_from) $date_from = date("m-Y",strtotime($date_from));
if($date_to) $date_to = date("m-Y",strtotime($date_to));

$str_input_from = $this->Template->load_textbox(array("name"=>"date_from","autocomplete"=>"off","value"=>$date_from,"id"=>"date_from", "class"=>"day","style"=>"width:90px; border:1px solid #ff631d!important;border-radius: 0px !important;"));

$str_input_to = $this->Template->load_textbox(array("name"=>"date_to","autocomplete"=>"off","value"=>$date_to,"id"=>"date_to", "class"=>"day","style"=>"width:90px; border:1px solid #ff631d!important;border-radius: 0px !important;"));

$str_btn_save = "<input type='submit' class='timkiem'value='Tìm kiếm' style='font-size: 13.4px; margin-top:10px'>";

 /* $str_label_from = $this->Template->load_label("Từ ngày: ","","search_list");
  $str_label_to = $this->Template->load_label("Đến ngày: ","","search_list");
  $str_label_department = $this->Template->load_label("Phòng ban: ","","search_list");
  $str_label_position = $this->Template->load_label("Chức vụ: ","","search_list");    
  $str_label_job = $this->Template->load_label("Công việc: ","","search_list");   
  $str_label_factory = $this->Template->load_label("Nhà máy: ","","search_list");   
  $str_label_manufactory = $this->Template->load_label("Phân xưởng: ","","search_list");  */  

          //nhập nhân viên
  $str_input_name_attendance = $this->Template->load_textbox(array("name"=>"name","autocomplete"=>"off","value"=>$name,"id"=>"name", "placeholder"=>"Nhập tên nhân viên"));

  $str_input_attendance_day ="<form action='' method='GET' ><div id = 'search_bar' style='margin-left:10px;'>Từ tháng $str_input_from Đến tháng $str_input_to $str_select_department $str_select_position $str_select_work $str_select_factory  $str_select_part  $str_input_name_attendance $str_btn_save </div></form>";



  




    //bước 1 tạo bảng heard
    //buoc 1: tao mang table header
  $str_table_header_summary = "";
  $array_table_header_summary1 =  array("stt"=>array("STT",array("style"=>"text-align:center; width:1%")),

    "code"=>array("Mã nhân viên",array("style"=>"text-align:center; width:2%")),
    "name"=>array("Họ và tên",array("style"=>"text-align:center; width:2%")),
    "bank_account"=>array("Số TK",array("style"=>"text-align:center;width:2%")),
    "department"=>array("Phòng ban",array("style"=>"text-align:center; width:2%")),
    "position"=>array("Chức vụ",array("style"=>"text-align:center;width:2%")),
    "job"=>array("Công việc",array("style"=>"text-align:center;width:2%")),
    "date_join"=>array("Ngày vào công ty",array("style"=>"text-align:center;width:2%")),
    "payroll"=>array("Kỳ tính lương",array("style"=>"text-align:center; width:2%")),
    "thang"=>array("Tháng thâm niên",array("style"=>"text-align:center; width:2%")),
    "ngay"=>array("Ngày lên chức vụ",array("style"=>"text-align:center; width:2%")),
    "seniority"=>array("Tháng thâm nên chức vụ mới",array("style"=>"text-align:center; width:2%")),
    // "date"=>array("Ngày",array("style"=>"text-align:center; width:2%","rowspan"=>"2")),    
    "day_out"=>array("Ngày công hết hàng cho về",array("style"=>"text-align:center;width:2%")),
    "day_late"=>array("Ngày công đi muộn(đủ 8h)",array("style"=>"text-align:center;width:2%")),
    "day_empty"=>array("Ngày công hết hàng không lương",array("style"=>"text-align:center;width:2%")),
    "vacation_insurance"=>array("Ngày nghỉ phép bảo hiểm",array("style"=>"text-align:center;width:2%")),
    "nghi_phep"=>array("Ngày nghỉ có phép",array("style"=>"text-align:center;width:2%")),
    "nghi_vo_phep"=>array("Ngày nghỉ vô phép",array("style"=>"text-align:center;width:2%")),
    "day_recompense"=>array("Ngày công làm xét thưởng",array("style"=>"text-align:center;width:2%")),
    "day_sunday"=>array("Ngày công chủ nhật",array("style"=>"text-align:center;width:2%")),
    "day_not_card"=>array("Ngày công không bấm thẻ",array("style"=>"text-align:center;width:2%")),
    "day_over8"=>array("Ngày công lớn hơn 8h",array("style"=>"text-align:center;width:2%")),
    "day_money_milk"=>array("Ngày công tính tiền sữa",array("style"=>"text-align:center;width:2%")),
    "sum_hours"=>array("Tổng giờ công",array("style"=>"text-align:center;width:2%")),
    "sum_main_time"=>array("Tổng giờ hành chính",array("style"=>"text-align:center;width:2%")),
    "hours_150"=>array("Giờ tăng 150%",array("style"=>"text-align:center;width:2%")),
    "hours_200"=>array("Giờ tăng 200%",array("style"=>"text-align:center;width:2%")),
    "hours_300"=>array("Giờ tăng 300%",array("style"=>"text-align:center;width:2%")),
    "date_subsidy"=>array("Ngày công tính tiền trợ cấp, trách nhiệm",array("style"=>"text-align:center;width:2%")),

    // "basic_salary"=>array("Lương cơ bản",array("style"=>"text-align:center;width:6%","rowspan"=>"2")),
    // "Responsibility"=>array("Trách nhiệm",array("style"=>"text-align:center;width:5%","rowspan"=>"2")),
    // "wage_allowance"=>array("Phụ cấp lương",array("style"=>"text-align:center;width:5%","rowspan"=>"2")),
    // "concurrently"=>array("Kiêm nhiệm",array("style"=>"text-align:center;width:5%","rowspan"=>"2")),
    // "telephone_allowance"=>array("Phụ cấp tiền điện thoại",array("style"=>"text-align:center;width:5%","rowspan"=>"2")),
    // "money_assurance"=>array("Lương đóng bảo hiểm",array("style"=>"text-align:center;width:6%","rowspan"=>"2")),
    // "diligence"=>array("Đạt chuyên cần",array("style"=>"text-align:center;width:6%","rowspan"=>"2")),
    // "travel_allowance"=>array("Đạt trợ cấp đi lại",array("style"=>"text-align:center;width:5%","rowspan"=>"2")),
    // "monthly_prizes"=>array("Đạt thưởng tháng",array("style"=>"text-align:center;width:5%","rowspan"=>"2")),
    // "level_bonus"=>array("Mức thưởng",array("style"=>"text-align:center;width:5%","rowspan"=>"2")),
    // "bonuses"=>array("Thưởng thành tiền",array("style"=>"text-align:center;width:5%","rowspan"=>"2")),
    // "salary_bonus"=>array("Lương phép năm",array("style"=>"text-align:center;width:5%","rowspan"=>"2")),
    // "salary_holiday"=>array("Lương lễ - tết",array("style"=>"text-align:center;width:6%","colspan"=>"2")),
    // "action"=>array("Chức năng",array("style"=>"text-align:center;width:4%;","rowspan"=>"2")),
);



// $array_table_header_summary2 =  array("day"=>array("Ngày",array("style"=>"text-align:center; width:1%")),
//   "money"=>array("Thành tiền",array("style"=>"text-align:center; width:2%")),
// );

$str_table_header_summary.= $this->Template->load_table_header($array_table_header_summary1);
// $str_table_header_summary.= $this->Template->load_table_header($array_table_header_summary2);






$str_table_row_summary = "";

//link thêm _ lưu
     //lấy dòng nội dung table
$str_btn_chitiet = "<input type='submit' class='xemchitiet'value='Xem chi tiết' style='font-size: 13.4px'>";


$stt=0;

foreach ($array_attendance as  $summary)
{
    $stt++;
    $thang_thamnien = 0;
    // lấy ngày vào công ty
    $date_join = $summary["date_join"];

    // lấy tháng hiện tại
    $current_month = $summary["month"];

    //chuyển ngày vào công ty và ngày hiện tại thành kiểu datetime 
    $ts1 = strtotime($date_join);
    $ts2 = strtotime($current_month);

    // lấy năm của ngày vào công ty và năm hiện tại 
    $year1 = date('Y', $ts1);
    $year2 = date('Y', $ts2);

    // lấy tháng vào công ty và tháng hiện tại
    $month1 = date('m', $ts1);
    $month2 = date('m', $ts2);

    // tính số tháng thâm niên
    $thang_thamnien = (($year2 - $year1) * 12) + ($month2 - $month1);

    // tháng thâm niên chức vụ mới
    $thang_thamnien_chucvu_moi = 0;

    // lấy ngày lên chức
    $date_position = $summary["date_position"];

    //chuyển ngày lên chức và ngày hiện tại thành kiểu datetime 
    $ts1 = strtotime($date_position);
    $ts2 = strtotime($current_month);

    // lấy năm của ngày lên chức và năm hiện tại 
    $year1 = date('Y', $ts1);
    $year2 = date('Y', $ts2);

    // lấy tháng của và tháng hiện tại
    $month1 = date('m', $ts1);
    $month2 = date('m', $ts2);

    // tính số tháng thâm niên chức vụ mới
    $thang_thamnien_chucvu_moi = (($year2 - $year1) * 12) + ($month2 - $month1);

    // lấy ngày công hết hàng không lương
    $ngaycong_hethang = $summary["so_ngaycong_hethang"];
    $ngaynghi_baohiem = $summary["ngaynghi_baohiem"];
    $ngaynghi_cophep = $summary["ngaynghi_cophep"];
    $ngaynghi_khongphep = $summary["ngaynghi_khongphep"];
    $so_ngaycong_hethang_khongluong = $summary["so_ngaycong_hethang_khongluong"];
    $ngaycong_dimuon_du8h = $summary["ngaycong_dimuon_du8h"];
    $ngaycong_chunhat = $summary["ngaycong_chunhat"];
    $ngaycong_khong_bamthe = $summary["ngaycong_khong_bamthe"];
    $ngaycong_lamhon_8h = $summary["ngaycong_lamhon_8h"];
    $ngaycong_tinh_tiensua = $summary["ngaycong_tinh_tiensua"];
    $tong_gio_cong = $summary["tong_gio_cong"];
    $tong_gio_cong_hanhchinh = $summary["tong_gio_cong_hanhchinh"];
    $gio_tangca_150 = $tong_gio_cong -  $tong_gio_cong_hanhchinh;
    $tong_gio_cong_chunhat = $summary["tong_gio_cong_chunhat"];
    $ngaylam_xetthuong = $ngaycong_lamhon_8h +  $ngaycong_hethang + $so_ngaycong_hethang_khongluong +  $ngaynghi_baohiem + $ngaycong_khong_bamthe +  $ngaycong_dimuon_du8h;
    $ngaycong_trocap_trachnhiem = $ngaylam_xetthuong -  $ngaynghi_baohiem -  $ngaycong_hethang_khongluong;
    $dat_chuyencan  = "Không";

 
    $array_table_row_summary =  array("stt"=>array("$stt",array("style"=>"text-align:center; ")),

        "code"=>array($summary["user_code"],array("style"=>"text-align:center; ")),
        "name"=>array($summary["fullname"],array("style"=>"text-align:center; ")),
        "bank_account"=>array("",array("style"=>"text-align:center;")),
        "department"=>array($summary["department"] ,array("style"=>"text-align:center;")),
        "position"=>array($summary["position"] ,array("style"=>"text-align:center;")),
        "job"=>array($summary["work"],array("style"=>"text-align:center;")),
        "date_join"=>array($summary["date_join"],array("style"=>"text-align:center;")),


        "ky_tinhluong"=>array(date("m-Y",strtotime($summary["month"])),array("style"=>"text-align:center;")),
        "thang"=>array($thang_thamnien,array("style"=>"text-align:center;")),
        "ngay_chucvu"=>array(date("d-m-Y",strtotime($summary["date_position"])),array("style"=>"text-align:center;")),
        "thang_thamnien"=>array($thang_thamnien_chucvu_moi,array("style"=>"text-align:center;")),


        
        
        // "date"=>array("".$str_input_ngay_len_chuc,array("style"=>"text-align:center;width:2%")),
        "ngaycong_hethang"=>array($ngaycong_hethang,array("style"=>"text-align:center;")),
        "ngaycong_dimuon"=>array($ngaycong_dimuon_du8h,array("style"=>"text-align:center;")),
        "ngaycong_hethang_khongluong"=>array($so_ngaycong_hethang_khongluong,array("style"=>"text-align:center;")),
        "vacation_insurance"=>array($ngaynghi_baohiem,array("style"=>"text-align:center;")),

        "nghi_phep"=>array($ngaynghi_cophep,array("style"=>"text-align:center;")),
        "nghi_vo_phep"=>array($ngaynghi_khongphep,array("style"=>"text-align:center;")),

        "day_recompense"=>array($ngaylam_xetthuong,array("style"=>"text-align:center;")),
        "day_sunday"=>array($ngaycong_chunhat,array("style"=>"text-align:center;")),
        "day_not_card"=>array($ngaycong_khong_bamthe,array("style"=>"text-align:center;")),
        "day_over8"=>array($ngaycong_lamhon_8h,array("style"=>"text-align:center;")),
        "day_money_milk"=>array($ngaycong_tinh_tiensua,array("style"=>"text-align:center;")),
        "sum_hours"=>array($tong_gio_cong,array("style"=>"text-align:center;")),

        "sum_main_time"=>array($tong_gio_cong_hanhchinh,array("style"=>"text-align:center;")),
        "hours_150"=>array($gio_tangca_150,array("style"=>"text-align:center;")),
        "hours_200"=>array($tong_gio_cong_chunhat,array("style"=>"text-align:center;")),
        "hours_300"=>array("",array("style"=>"text-align:center;")),


        "date_subsidy"=>array( $ngaycong_trocap_trachnhiem,array("style"=>"text-align:center;")),
        // "basic_salary"=>array("",array("style"=>"text-align:center;width:5%")),
        // "responsibility"=>array("",array("style"=>"text-align:center;width:5%")),
        // "wage_allowance"=>array("",array("style"=>"text-align:center;width:5%")),
        // "concurrently"=>array("",array("style"=>"text-align:center;width:5%")),
        // "telephone_allowance"=>array("",array("style"=>"text-align:center;width:5%")),
        // "money_assurance"=>array("",array("style"=>"text-align:center;width:5%")),
        // "diligence"=>array("",array("style"=>"text-align:center;width:5%")),
        // "travel_allowance"=>array("",array("style"=>"text-align:center;width:5%")),

        // "monthly_prizes"=>array("",array("style"=>"text-align:center;width:5%")),
        // "level_bonus"=>array("",array("style"=>"text-align:center;width:5%")),
        // "bonuses"=>array("",array("style"=>"text-align:center;width:5%")),
        // "salary_bonus"=>array("",array("style"=>"text-align:center;width:5%")),
        // "day_holiday"=>array("",array("style"=>"text-align:center;width:5%")),
        // "salary_holiday"=>array("",array("style"=>"text-align:center;width:5%")),
        // "action"=>array("" ,array("style"=>"text-align:center;width:4% ")),

    );

    $str_table_row_summary .= $this->Template->load_table_row($array_table_row_summary);
}


    //buoc 5: dung ham load_table đưa dữ liệu vào table



$str_table_row_summary .= $this->Template->load_table_row($array_table_row_summary);

$str_table_summary =  $this->Template->load_table($str_table_header_summary. $str_table_row_summary );

$str_form_summary = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"/attendance2/summary?debug=code"),$str_table_summary);
?>


<div class="parent">

 <?php
 echo $str_input_attendance_day;

 echo $str_form_summary;

 ?>

</div>





<script type="text/javascript">
   $( function() {
    $( "#date_from" ).datepicker({dateFormat: "mm-yy"});
} );
   $( function() {
    $( "#date_to" ).datepicker({dateFormat: "mm-yy"});
} );
</script>