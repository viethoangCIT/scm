<style type="text/css">

.tbl_r{


}
.parent{
 height: auto;
 position: absolute;
 width: 100%;
 left: 0;

}

</style>
<?php

$function_title = "Tổng hợp  chấm công ";
echo $this->Template->load_function_header($function_title);

    // form lọc ngày
$str_form_attendance_content = "";



// BEGIN: FORM SEARCH

// chức vụ
$str_select_position = $this->Template->load_selectbox(array("name"=>"id_position","autocomplete"=>"on","value"=>"","id"=>"id_position","style"=>"width:140px"),$array_position, $id_position);

// lọc theo công việc-bo phận
$str_select_job = $this->Template->load_selectbox(array("name"=>"id_job","autocomplete"=>"on","value"=>"","id"=>"id_job","style"=>"width:140px"),$array_job, $id_job);

$str_select_group = $this->Template->load_selectbox(array("name"=>"id_group","autocomplete"=>"on","value"=>"","id"=>"id_group","style"=>"width:140px"),$array_group, $id_group);
// lọc theo nhà máy
$str_select_factory    =  $this->Template->load_selectbox(array("name"=>"id_factory","autocomplete"=>"on","value"=>"","id"=>"id_factory","style"=>"width:140px"),$array_factory,$id_factory);

// lọc theo phân xưởng
$str_select_part = $this->Template->load_selectbox(array("name"=>"id_manufactory","autocomplete"=>"on","value"=>"","id"=>"part","style"=>"width:140px"),$array_manufactory, $id_manufactory);

if($date_from) $date_from = date("m-Y",strtotime($date_from));
if($date_to) $date_to = date("m-Y",strtotime($date_to));

$str_input_from = $this->Template->load_textbox(array("name"=>"date_from","autocomplete"=>"on","value"=>$date_from,"id"=>"date_from", "class"=>"day","style"=>"width:90px; border:1px solid #ff631d!important;border-radius: 0px !important;"));
$str_input_to = $this->Template->load_textbox(array("name"=>"date_to","autocomplete"=>"on","value"=>$date_to,"id"=>"date_to", "class"=>"day","style"=>"width:90px; border:1px solid #ff631d!important;border-radius: 0px !important;"));
$str_input_name = $this->Template->load_textbox(array("name"=>"name","value"=>$name,"style"=>"width:100px;"));

$str_btn_save = "<input type='submit' class='timkiem'value='Tìm kiếm' style='font-size: 13.4px; margin-top:10px'>";

//nhập nhân viên
$str_input_name_attendance = $this->Template->load_textbox(array("name"=>"name","autocomplete"=>"off","value"=>$name,"id"=>"name", "placeholder"=>"Nhập tên nhân viên"));

$str_input_attendance_day ="<form action='' method='GET' ><div id = 'search_bar' style=''>Từ tháng $str_input_from Đến tháng $str_input_to $str_select_factory $str_select_part $str_select_group $str_select_job $str_select_position $str_input_name $str_btn_save </div></form>";

// END: FORM SEARCH

//bước 1 tạo bảng heard
//buoc 1: tao mang table header
$str_table_header_summary = "";
$array_table_header_summary =  null;
$array_table_header_summary["col1"] = array("Stt",array("style"=>"text-align:center; width:10px"));
$array_table_header_summary["col2"] = array("Họ tên",array("style"=>"text-align:center; width:150px"));
$array_table_header_summary["col3"] = array("Mã nhân viên",array("style"=>"text-align:center; width:10px"));
$array_table_header_summary["col4"] = array("Nhà máy",array("style"=>"text-align:center; width:10px"));
$array_table_header_summary["col5"] = array("Phân xưởng",array("style"=>"text-align:center; width:10px; border-right: solid 3px !important;"));
$array_table_header_summary["col6"] = array("Tổ",array("style"=>"text-align:center; width:10px"));

//Lấy số ngày của tháng đang xem
$songay_trongthang = date("t",strtotime("01-".$date_from));
for($i =1 ; $i <= $songay_trongthang; $i++)
{
	$array_table_header_summary["day$i"] = array("$i-$date_from",array("style"=>"text-align:center; width:10px"));

}

$array_table_header_summary["col7"] = array("Ngày công bình thường",array("style"=>"text-align:center; width:10px"));
$array_table_header_summary["col8"] = array("Ngày công hết hàng cho về",array("style"=>"text-align:center;width:10px"));
$array_table_header_summary["col9"] = array("Ngày đi muộn đủ 8h",array("style"=>"text-align:center;width:10px"));
$array_table_header_summary["col10"] = array("Ngày công hết hàng không lương",array("style"=>"text-align:center;width:10px"));
$array_table_header_summary["col11"] = array("Ngày nghỉ phép bảo hiểm",array("style"=>"text-align:center;width:10px"));
$array_table_header_summary["col12"] = array("Ngày nghỉ có phép",array("style"=>"text-align:center;width:10px"));
$array_table_header_summary["col13"] = array("Ngày nghỉ vô phép",array("style"=>"text-align:center;width:10px"));
$array_table_header_summary["col14"] = array("Ngày công xét thưởng",array("style"=>"text-align:center;width:10px"));
$array_table_header_summary["col15"] = array("Ngày công chủ nhật",array("style"=>"text-align:center;width:10px"));
$array_table_header_summary["col16"] = array("Ngày không bấm thẻ",array("style"=>"text-align:center;width:10px"));
$array_table_header_summary["col17"] = array("Ngày công hơn 8h",array("style"=>"text-align:center;width:10px"));
$array_table_header_summary["col18"] = array("Ngày công tính tiền sữa",array("style"=>"text-align:center;width:10px"));
$array_table_header_summary["col19"] = array("Tổng giờ công",array("style"=>"text-align:center;width:10px"));
$array_table_header_summary["col20"] = array("Tổng giờ công hành chính",array("style"=>"text-align:center;width:10px"));
$array_table_header_summary["col21"] = array("Giờ tăng ca 150%",array("style"=>"text-align:center;width:10px"));
$array_table_header_summary["col22"] = array("Giờ tăng ca 200%",array("style"=>"text-align:center;width:10px"));
$array_table_header_summary["col23"] = array("Giờ tăng ca 300%",array("style"=>"text-align:center;width:10px"));
$array_table_header_summary["col24"] = array("Ngày công tính tiền trợ cấp",array("style"=>"text-align:center;width:10px"));



$str_table_header_summary.= $this->Template->load_table_header($array_table_header_summary);
$str_table_row_summary = "";

//link thêm _ lưu
//lấy dòng nội dung table
$str_btn_chitiet = "<input type='submit' class='xemchitiet'value='Xem chi tiết' style='font-size: 13.4px'>";

$str_date_from = date("Y-m",strtotime("01-".$date_from));

$stt=0;
$array_table_row_summary = "";
if($array_attendance != NULL)
{
    foreach ($array_attendance as  $summary)
    {
        $stt++;
        $thang_thamnien = 0;
		
		//BEGIN: LẤY THÔNG TIN TỪ MẢNG array_attendance
		
		$id_user = $summary["id"];
		$summary_code = $summary["user_code"];
		$summary_fullname = $summary["fullname"];
		$summary_factory = $summary["factory"];
		$summary_manufactory = $summary["manufactory"];
		$summary_group_name = $summary["group_name"];
		$summary_ngaycong_binhthuong = $summary["ngaycong_binhthuong"];
		$summary_hethang = $summary["so_ngaycong_hethang"];
		$summary_muon_8h = $summary["so_ngaycong_muon_8h"];
		$summary_hethang_khongluong = $summary["hethang_khongluong"];
		$summary_nghiphep_baohiem = $summary["nghiphep_baohiem"];
		$summary_ngaynghi_cophep = $summary["ngaynghi_cophep"];
		$summary_ngaynghi_vophep = $summary["ngaynghi_vophep"];
		$summary_ngaycong_xetthuong = $summary["ngaycong_xetthuong"];
		$summary_ngaycong_chunhat = $summary["ngaycong_chunhat"];
		$summary_ngay_khong_bamthe = $summary["ngay_khong_bamthe"];
		$summary_ngaycong_hon8h = $summary["ngaycong_hon8h"];
		$summary_ngaycong_tinh_tiensua = $summary["ngaycong_tinh_tiensua"];
		$summary_ngaycong_trocap = $summary["ngaycong_tinh_trocap"];
		
		//giờ tăng ca 200% = tổng giờ tất cả các ngày chủ nhật
		$summary_gio_tangca200 = $summary["tonggio_chunhat"];
		
		$summary_tong_giocong = $summary["tong_gio_cong"] -$summary_gio_tangca200;
		
		//tính giờ hành chính = tổng giờ <8h + (số ngày > 8h)x8
		$summary_ngaycong_hon8h = $summary["ngaycong_lamhon_8h"];
		$summary_tonggio_duoi8h = $summary["tongsogio_ngaylamduoi_8h"];
		
		//BEGIN: lấy giờ công hành chính
		//=> Công thức: tổng giờ hành chính = tổng giờ công <7h(khác ngày CN) + (tổng ngày công hon 8h(khác CN) X 8)
		$summary_tonggio_duoi7_khac_cn = $summary["tonggio_duoi7_khac_cn"];
		$summary_ngaycong_hon8_khac_cn = $summary["ngaycong_hon8_khac_cn"];
		$summary_tonggio_hanhchinh = $summary_tonggio_duoi7_khac_cn + ($summary_ngaycong_hon8_khac_cn*8);
		//END: lấy giờ công hành chính 
		
		//giờ tăng ca 150%  = tổng giờ công trù tổng giờ hành chính
		$summary_gio_tangca150 = $summary_tong_giocong - $summary_tonggio_hanhchinh;

		//giờ tăng ca 300% tổng giờ các ngày lễ
		$summary_gio_tangca300 = $summary["tonggio_ngayle"];
		
		//END: LẤY THÔNG TIN TỪ MẢNG array_attendance
		
		$array_table_row_summary = null;
		$array_table_row_summary["col1"] = array($stt,array("style"=>"text-align:center;","class"=>"v_mid"));
		$array_table_row_summary["col2"] = array($summary_fullname,array("style"=>"text-align:center;","class"=>"v_mid","nowrap"=>"nowrap"));
		$array_table_row_summary["col3"] = array($summary_code,array("style"=>"text-align:center;","class"=>"v_mid"));
		$array_table_row_summary["col4"] = array($summary_factory,array("style"=>"text-align:center;","class"=>"v_mid"));
		$array_table_row_summary["col5"] = array($summary_manufactory,array("style"=>"text-align:center;","class"=>"v_mid"));
		$array_table_row_summary["col6"] = array($summary_group_name,array("style"=>"text-align:center;","nowrap"=>"nowrap"));
		for($i =1 ; $i <= $songay_trongthang; $i++)
		{
			$tmp_i = "";
			if($i<10) $tmp_i = "0";
			$str_id_day = $id_user."-".$str_date_from."-".$tmp_i.$i;
			$array_table_row_summary["day$i"] = array("",array("style"=>"text-align:center; width:15px","id"=>$str_id_day));
		
		}
		$array_table_row_summary["col7"] = array($summary_ngaycong_binhthuong,array("style"=>"text-align:center;"));
		$array_table_row_summary["col8"] = array($summary_hethang,array("style"=>"text-align:center;"));
		$array_table_row_summary["col9"] = array($summary_muon_8h,array("style"=>"text-align:center;"));
		$array_table_row_summary["col10"] = array($summary_hethang_khongluong,array("style"=>"text-align:center;"));
		$array_table_row_summary["col11"] = array($summary_nghiphep_baohiem,array("style"=>"text-align:center;"));
		$array_table_row_summary["col12"] = array($summary_ngaynghi_cophep,array("style"=>"text-align:center;"));
		$array_table_row_summary["col13"] = array($summary_ngaynghi_vophep,array("style"=>"text-align:center;"));
		$array_table_row_summary["col14"] = array($summary_ngaycong_xetthuong,array("style"=>"text-align:center;"));
		$array_table_row_summary["col15"] = array($summary_ngaycong_chunhat,array("style"=>"text-align:center;"));
		$array_table_row_summary["col16"] = array($summary_ngay_khong_bamthe,array("style"=>"text-align:center;"));
		$array_table_row_summary["col17"] = array($summary_ngaycong_hon8h,array("style"=>"text-align:center;"));
		$array_table_row_summary["col18"] = array($summary_ngaycong_tinh_tiensua,array("style"=>"text-align:center;"));
		$array_table_row_summary["col19"] = array($summary_tong_giocong,array("style"=>"text-align:center;"));
		$array_table_row_summary["col20"] = array($summary_tonggio_hanhchinh,array("style"=>"text-align:center;"));
		$array_table_row_summary["col21"] = array($summary_gio_tangca150,array("style"=>"text-align:center;"));
		$array_table_row_summary["col22"] = array($summary_gio_tangca200,array("style"=>"text-align:center;"));
		$array_table_row_summary["col23"] = array($summary_gio_tangca300,array("style"=>"text-align:center;"));
		$array_table_row_summary["col24"] = array($summary_ngaycong_trocap,array("style"=>"text-align:center;"));
		
		
        $str_table_row_summary .= $this->Template->load_table_row($array_table_row_summary);
    } // end  foreach ($array_attendance as  $summary)
} // end if($array_attendance != NULL)
?>

<div style="width:3000px;margin-left:-100px;">
<?php echo $str_input_attendance_day;?>
</div>
<form action="/attendance2/summary?debug=code" method="POST" id="form_nhap">
	<div class="parent">
    
        <table id="summary" class="stripe row-border order-column" width="100%" cellspacing="0" border="1" style="border-collapse:collapse">
            <thead>
                <?php echo $str_table_header_summary;?>
            </thead>
            <tbody>
                <?php echo $str_table_row_summary;?>
            </tbody>
        </table>
    </div>
</form>

	<!--BEGIN: DATA TABLE -->
    <style>
	/* Block out what is behind the fixed column's header and footer */
	.DTFC_LeftBodyLiner{
		overflow-x:hidden;
		}
table.DTFC_Cloned thead,
table.DTFC_Cloned tfoot {
	background-color: white;
}

/* Block out the gap above the scrollbar on the right, when there is a fixed
 * right column
 */
div.DTFC_Blocker {
	background-color: blue;
}

div.DTFC_LeftWrapper table.dataTable,
div.DTFC_RightWrapper table.dataTable {
	margin-bottom: 0;
}

div.DTFC_LeftWrapper table.dataTable.no-footer,
div.DTFC_RightWrapper table.dataTable.no-footer {
	border-bottom: none;
}	
	</style>
	<link rel="stylesheet" type="text/css" href="/layout/phuocnguyen/datel/js/data_table/fixedColumns.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="/layout/phuocnguyen/datel/js/data_table/jquery.dataTables.min.css">
	<script type="text/javascript" src="/layout/phuocnguyen/datel/js/data_table/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="/layout/phuocnguyen/datel/js/data_table/dataTables.fixedColumns.min.js"></script>
	<!--END: DATA TABLE -->
<script type="text/javascript">
 $( function() {
    $( "#date_from" ).datepicker({dateFormat: "mm-yy"});
    $( "#date_to" ).datepicker({dateFormat: "mm-yy"});
	
	//BEGIN: Gọi hàm DataTable để biến class info_table thành Data-table
	var table = $('#summary').DataTable(
	{
		scrollY: "500px",
		scrollX: true,
		scrollCollapse: false,
		searching: false,
		paging: false,
		bInfo: false,
		fixedColumns: 
		{
			leftColumns: 5,
			rightColumns: 0
		}
	});
	//END: Gọi hàm DataTable để biến class info_table thành Data-table
	
	capnhat_solieu_ngay();
} );

function capnhat_solieu_ngay()
{
	
	month 			= "<?php echo $date_from; ?>";
	id_factory 	   = "<?php echo $id_factory; ?>";	
	id_manufactory   = "<?php echo $id_manufactory; ?>";
	id_group 		 = "<?php echo $id_group; ?>";
	id_position 	  = "<?php echo $id_position; ?>";
	id_job 		   = "<?php echo $id_job; ?>";
	name 			 = "<?php echo $name; ?>";
	$.ajax({ method: "GET", url: "/attendance2/summary.html?debug=sql", data: {request: "ajax", month: month, id_factory: id_factory,id_manufactory: id_manufactory,id_group: id_group,id_position:id_position,id_job:id_job,name:name }})
	.done(function( str_data ) {
		alert(str_data);
		//chuyển dữ liệu từ string về kiểu json
		var array_data = $.parseJSON(str_data);
		for (var key in array_data) {
			
			//đưa dữ liệu giờ vào các ô ngày trong tháng
			if(document.getElementById(array_data[key]["id_day"]))document.getElementById(array_data[key]["id_day"]).innerHTML = array_data[key]["hour"]+" <span style='font-size:10px;'><sup>"+array_data[key]["day_type"]+"</sup></span>";
		}		
		
	});
}
</script>