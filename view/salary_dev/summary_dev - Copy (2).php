<style type="text/css">
.parent 
{
	min-height: 200px;
	max-height: 450px;
	height: 350px;
	position: absolute;
	width: 100%;
	left: 0;
	overflow:scroll;
}
</style>

<link href="<?php echo $this->webroot;?>layout/nguyenvanduoc/admin2/js/excel_table/css/fixed_table_rc.css" type="text/css" rel="stylesheet" media="all" />

<script src="<?php echo $this->webroot;?>layout/nguyenvanduoc/admin2/js/excel_table/js/sortable_table.js" type="text/javascript"></script>
<script src="<?php echo $this->webroot;?>layout/nguyenvanduoc/admin2/js/excel_table/js/fixed_table_rc.js" type="text/javascript"></script>
<style>
div.container_table {
	padding: 5px 15px;
	width: 1660px;
	margin:0px;
	
	position: absolute;
	height: 600px;
	left: 0;
	
}

.fixed_table
{
	position: absolute;
	width: 1860px;
	left: 0;
	height: 400px;
}
.fixed_table table tr th {
	background-color: #DBEAF9;

}
.fix_cell
{
	background-color:#2f83b7;	
	color: white;
}
.ui-datepicker {
	z-index: 10000 !important;
}
.form-group{
	margin-top: 0px;
}
.clearfix{
	height: 30px;
}
.ft_container{
	margin-top: -20px;
}
footer{
	margin-top: 100px;
}
</style>
<?php 


// TITLE
$function_title = "Bảng Tổng Hợp Lương";
echo $this->Template->load_function_header($function_title);


// BEGIN:BỘ LỌC
//lọc theo phòng ban
//array_unshift($array_department, array("id"=>"","name"=>"Phòng ban"));
//$str_select_department = $this->Template->load_selectbox(array("name"=>"id_department","autocomplete"=>"on","value"=>"","id"=>"id_department","style"=>"width:100px"),$array_department,$id_department);

// lọc theo nhà máy
$str_select_factory =  $this->Template->load_selectbox(array("name"=>"id_factory","autocomplete"=>"on","value"=>"","id"=>"id_factory","style"=>"width:100px"),$array_factory,$id_factory);

// lọc theo phân xưởng
$str_select_manufactory = $this->Template->load_selectbox(array("name"=>"id_manufactory","autocomplete"=>"on","value"=>"","id"=>"id_manufactory","style"=>"width:100px"),$array_manufactory,$id_manufactory);

// lọc theo tổ
$str_select_group = $this->Template->load_selectbox(array("name"=>"id_group","autocomplete"=>"on","value"=>"","id"=>"id_group","style"=>"width:100px"),$array_group,$id_group);

// lọc theo công việc
$str_select_job = $this->Template->load_selectbox(array("name"=>"id_job","autocomplete"=>"on","value"=>"","id"=>"id_job","style"=>"width:100px"),$array_job,$id_job);

// lọc theo chức vụ
$str_select_position = $this->Template->load_selectbox(array("name"=>"id_position","autocomplete"=>"on","value"=>"","id"=>"id_position","style"=>"width:100px"),$array_position,$id_position);


if ($date_from != "") $date_from = date("m-Y",strtotime($date_from));
if ($date_to != "")$date_to = date("m-Y",strtotime($date_to));
$str_input_from = $this->Template->load_textbox(array("name"=>"date_from","autocomplete"=>"off","value"=>$date_from,"id"=>"date_from", "class"=>"day","style"=>"width:90px; margin-bottom:10px;"));
$str_input_to = $this->Template->load_textbox(array("name"=>"date_to","autocomplete"=>"off","value"=>$date_to,"id"=>"date_to", "class"=>"day","style"=>"width:90px;"));
$str_btn_save = "<input type='submit' class='timkiem'value='Tìm kiếm' style='font-size: 13.4px; margin-top:10px'>";
$str_input_name_staff = $this->Template->load_textbox(array("name"=>"name","autocomplete"=>"off","value"=>$name,"id"=>"name", "placeholder"=>"Nhập tên nhân viên", "style"=>"border-radius: 7px;margin-top: 9px; height: 25px; border: 1px solid #aaaaaa;"));

$str_btn_xuat_excel = "<input type='submit' class='in'value='Xuất excel' style='font-size: 15px; '>";
$str_btn_in = "<input type='submit' class='in'value='In' style='font-size: 15px; '>";
$str_input_attendance_day ="Từ tháng: $str_input_from Đến tháng: $str_input_to $str_select_factory $str_select_manufactory $str_select_position $str_select_job     Tên: $str_input_name_staff $str_btn_save  $str_btn_xuat_excel  $str_btn_in";
$str_form_salary1 = $this->Template->load_form(array("method"=>"GET","id"=>"form_nhap","action"=>""),$str_input_attendance_day);
// END: BỘ LỌC

?>
<div class="container_table">
	<?php 
	
	echo $str_form_salary1 ;
	?>
	<table id="fixed_table">
		<thead>
			<tr class='v_mid'>
				<th>Stt</th>
                <th>Họ & tên</th>
				<th >Mã nhân viên</th>
				<th >Số CMND</th>
				<th >Số TK</th>
				<th >Thâm niên</th>
				<th >Tháng</th>
				<th >Tổng số giờ làm việc</th>
				<th>Tổng số giờ hành chính</th>
				<th >Tổng số giờ hành chính ngày làm dưới 8h</th>
				<th >Tổng số ngày hành chính làm hơn 8 giờ</th>
				<th >Tổng số giờ ca 3</th>

				<th >Lương hành chính</th>
				<th >Phụ cấp ca 3</th>
				<th >Lương tăng ca 150%</th>
				<th >Lương tăng ca 200%</th>
				<th >Lương tăng ca 300%</th>
				<th  >Tổng lương thời gian</th>
				<th >Chuyên cần</th>
				<th  >Trợ cấp xe đi lại, nhà ở</th>
				<th >Trách nhiệm</th>
				<th >Phụ cấp lương</th>
				<th >Kiêm nhiệm</th>
				<th >Lương cơ bản</th>
				<th >Lương đóng bảo hiểm</th>
				<th >Thưởng đạt năng xuất</th>
				<th>Lương phép năm hàng tháng</th>
				<th>Lương Lễ, Tết</th>
				<th>Lương nghĩ ốm đau (BHXH)</th>
				<th>Tiền điện thoại</th>
				<th>Tiền sữa</th>
				<th>Tiền xăng đi công tác</th>
				<th>Tổng lương</th>
				<th>Điều chỉnh tháng trước</th>
				<th>Trừ tiền đồng phục</th>
				<th>Số ngày gối đầu</th>
				<th>Thành tiền</th>
				<th>Trừ lương ứng</th>
				<th>Trừ tiền đi du lịch</th>
				<th>Trừ tiền điện thoại</th>
				<th>Thuế TNCN tạm tính</th>
				<th>Vi phạm nội quy</th>
				<th>Trừ tiền NG</th>
				<th>Trừ tiền KTB</th>
				<th>KPCĐ</th>
				<th>BHXH, BHYT</th>
				<th>Tổng quỹ</th>
				<th>Thực lãnh tháng</th>
				<th>NLĐ Ký tên</th>
			</tr>




		</thead>
		<tbody>
			<?php 
			if ($array_salary != null )
			{
				$stt=0;

				foreach ($array_salary as $salary) 
				{
					$stt++;
					
					//tính số tháng thâm niên
					$thamnien = strtotime(date("Y-m-d")) - strtotime($salary["date_join"]);
					$thamnien = $thamnien/3600/24/30;
					$thang = date("m-Y",strtotime($salary["thang"]));
					if($thang =="01-1970") 
					{
						$thang = "01-".$date_from;
						$thang = date("m-Y",strtotime($thang));
					}
					$luongdong_baohiem = $salary["luong_baohiem"];
					$chuyencan = $salary["chuyencan"];
					$trach_nhiem = $salary["trachnhiem"];
					$phucap_luong = $salary["phucap_luong"];
					$kiemnhiem = $salary["kiemnhiem"];
					$luong_coban = $salary["luong_coban"];
					$phucap_ca3 = $salary["phucap_ca3"];
					
					$tien_dienthoai = $salary["phucap_dienthoai"];
					$xangxe_congtac = $salary["thanhtien"];
										
					
			?>
					<tr>
						<td class="fix_cell" style="width:54px"><?php echo $stt; ?></td>
                        <td class="fix_cell" style="width:217px"><?php echo$salary["fullname"] ?></td>
						<td class="fix_cell" style="width:108px"><?php echo$salary["user_code"]; ?></td>
						<td ><?php echo $salary["id_number"] ?></td>
						<td style="width:108px"><?php echo $salary["bank_account"] ?></td>
						<td><?php echo $thamnien;?></td>
                        <td><?php echo $thang;?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><?php echo $chuyencan;?></td>
                        <td></td>
                        <td><?php echo $trach_nhiem;?></td>
                        <td><?php echo $phucap_luong;?></td>
                        <td><?php echo $kiemnhiem;?></td>
                        <td><?php echo $luong_coban;?></td>
                        <td><?php echo $luongdong_baohiem;?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><?php echo $tien_dienthoai;?></td>
                        <td></td>
                        <td><?php echo $xangxe_congtac;?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        
					</tr>

					<?php 
				} // foreach ($array_salary as $salary)
			}	// end if ($array_salary != null )
			?>

		</tbody>		
	</table>
</div>









<script language="javascript">
	$( function() {
		$( "#date_from" ).datepicker({dateFormat: "mm-yy"});
		$( "#date_to" ).datepicker({dateFormat: "mm-yy"});
	} );

</script>

<script>
	$(function () {



		container_table = $(window).width()-10;
		$('#fixed_table').fxdHdrCol({
			fixedCols: 3,
			width:container_table,
			height:400,
			colModal: [
			{ width: 54, align: 'center' }, 
			{ width: 217, align: 'center' }, 
			{ width: 108, align: 'center' }, 
			{ width: 100, align: 'center' }, 
			{ width: 117, align: 'center' }, 
			{ width: 110, align: 'center' }, 
			{ width: 100, align: 'center' }, 
			{ width: 100, align: 'center' }, 
			{ width: 150, align: 'center' }, 
			{ width: 100, align: 'center' }, 
			{ width: 100, align: 'center' }, 
			{ width: 100, align: 'center' }, 
			{ width: 100, align: 'center' }, 
			{ width: 100, align: 'center' }, 
			{ width: 100, align: 'center' }, 
			{ width: 100, align: 'center' }, 
			{ width: 100, align: 'center' },
			{ width: 100, align: 'center' },
			{ width: 100, align: 'center' }, 
			{ width: 100, align: 'center' }, 
			{ width: 100, align: 'center' }, 
			{ width: 100, align: 'center' },
			{ width: 100, align: 'center' },
			{ width: 100, align: 'center' }, 
			{ width: 100, align: 'center' }, 
			{ width: 100, align: 'center' }, 
			{ width: 100, align: 'center' }, 
			{ width: 100, align: 'center' },
			{ width: 100, align: 'center' },
			{ width: 100, align: 'center' }, 
			{ width: 100, align: 'center' }, 
			{ width: 100, align: 'center' }, 
			{ width: 100, align: 'center' }, 
			{ width: 100, align: 'center' }, 
			{ width: 100, align: 'center' }, 
			{ width: 100, align: 'center' }, 
			{ width: 100, align: 'center' },
			{ width: 100, align: 'center' },
			{ width: 100, align: 'center' }, 
			{ width: 100, align: 'center' }, 
			{ width: 100, align: 'center' },
			{ width: 100, align: 'center' },
			{ width: 100, align: 'center' }, 
			{ width: 100, align: 'center' }, 
			{ width: 100, align: 'center' }, 
			{ width: 100, align: 'center' }, 
			{ width: 100, align: 'center' },
			{ width: 100, align: 'center' },
			{ width: 100, align: 'center' }, 
			],
			sort: true
		})
	});



</script>