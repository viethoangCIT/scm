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
	width: 1260;
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
array_unshift($array_department, array("id"=>"","name"=>"Phòng ban"));
$str_select_department = $this->Template->load_selectbox(array("name"=>"id_department","autocomplete"=>"off","value"=>"","id"=>"id_department","style"=>"width:100px"),$array_department,$id_department);

// lọc theo nhà máy
array_unshift($array_factory, array("id"=>"","name"=>"Nhà máy"));
$str_select_factory =  $this->Template->load_selectbox(array("name"=>"id_factory","autocomplete"=>"off","value"=>"","id"=>"id_factory","style"=>"width:100px"),$array_factory,$id_factory);

// lọc theo công việc
array_unshift($array_job, array("id"=>"","name"=>"Công việc"));
$str_select_job = $this->Template->load_selectbox(array("name"=>"id_job","autocomplete"=>"off","value"=>"","id"=>"id_job","style"=>"width:100px"),$array_job,$id_job);

// lọc theo chức vụ
array_unshift($array_position, array("id"=>"","name"=>"Chức vụ"));
$str_select_position = $this->Template->load_selectbox(array("name"=>"id_position","autocomplete"=>"off","value"=>"","id"=>"id_position","style"=>"width:100px"),$array_position,$id_position);

// lọc theo phân xưởng
array_unshift($array_manufactory, array("id"=>"","name"=>"Phân xưởng"));
$str_select_manufactory = $this->Template->load_selectbox(array("name"=>"id_manufactory","autocomplete"=>"off","value"=>"","id"=>"id_manufactory","style"=>"width:100px"),$array_manufactory,$id_manufactory);

if ($date_from != "") $date_from = date("m-Y",strtotime($date_from));
if ($date_to != "")$date_to = date("m-Y",strtotime($date_to));
$str_input_from = $this->Template->load_textbox(array("name"=>"date_from","autocomplete"=>"off","value"=>$date_from,"id"=>"date_from", "class"=>"day","style"=>"width:90px; margin-bottom:10px;"));
$str_input_to = $this->Template->load_textbox(array("name"=>"date_to","autocomplete"=>"off","value"=>$date_to,"id"=>"date_to", "class"=>"day","style"=>"width:90px;"));
$str_btn_save = "<input type='submit' class='timkiem'value='Tìm kiếm' style='font-size: 13.4px; margin-top:10px'>";
$str_input_name_staff = $this->Template->load_textbox(array("name"=>"name","autocomplete"=>"off","value"=>$name,"id"=>"name", "placeholder"=>"Nhập tên nhân viên", "style"=>"border-radius: 7px;margin-top: 9px; height: 25px; border: 1px solid #aaaaaa;"));

$str_btn_xuat_excel = "<input type='submit' class='in'value='Xuất excel' style='font-size: 15px; '>";
$str_btn_in = "<input type='submit' class='in'value='In' style='font-size: 15px; '>";
$str_input_attendance_day ="Từ tháng: $str_input_from Đến tháng: $str_input_to  $str_select_department  $str_select_position $str_select_job  $str_select_factory  $str_select_manufactory Tên: $str_input_name_staff $str_btn_save  $str_btn_xuat_excel  $str_btn_in";
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
				<th >Stt</th>
				<th >Mã nhân viên</th>
				<th>Họ & tên</th>
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
					$id=$salary["id"];
					$link_sua="/salary/add/$id.html";
					$link_xoa="/salary/del_salary/$id.html";
					$link_sua  = $this->Template->load_link("edit","Sửa",$link_sua);
					$link_xoa  = $this->Template->load_link("del","Xóa",$link_xoa);
					$link_action = $link_xoa . $link_sua;


					//tinh số tháng từ khi đi làm tới ngày hiện tại
					
					// lấy ngày vào công ty
					$date_join = $salary["date_join"];

					// lấy tháng hiện tại
					$current_month = $salary["thang"];

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

					// lấy tháng hiện tại theo định dạng "m-Y"
					$thang_hientai = date("m-Y",$ts2);

					// lấy lương cơ bản
					$luong_coban = $salary["luong_coban"];


					// BEGIN: LƯƠNG HÀNH CHÍNH
					// lây số giờ hành chính = tổng số h ngày đi làm dưới 8h + Số ngày đi làm trên 8,5h*8
					$tongso_gio_ngaylam_duoi_8h = $salary["tongso_gio_ngaylam_duoi_8h"];
					

					// nếu $tongso_gio_ngaylam_duoi_8h không phải số thì gán giá trị bằng 0
					if(is_numeric($tongso_gio_ngaylam_duoi_8h) == false) $tongso_gio_ngaylam_duoi_8h = 0;


					$songay_hanhchinh_lamhon_8h = $salary["songay_hanhchinh_lamhon_8h"];
					// nếu $tongso_ngaylam_hon_8h không phải số thì gán giá trị bằng 0
					if(is_numeric($songay_hanhchinh_lamhon_8h) == false) $songay_hanhchinh_lamhon_8h = 0;

					$sogio_hanhchinh = $tongso_gio_ngaylam_duoi_8h + ($songay_hanhchinh_lamhon_8h*8);
					$luong_hanhchinh = round($luong_coban/208*$sogio_hanhchinh);
					// END: LƯƠNG HÀNH CHÍNH

					// tính tổng h phụ cấp ca3 30%
					$tongso_gio_ngaylam_duoi_8h_ca3 = $salary["tongso_gio_ngaylam_duoi_8h_ca3"];
					$songay_lamhon_8h_ca3 = $salary["songay_lamhon_8h_ca3"];
					$tongso_giocong_phucap_ca3_30 = $tongso_gio_ngaylam_duoi_8h_ca3 + ($songay_lamhon_8h_ca3*8);
					
					// tính phụ cấp ca 3 = lương cơ bản/208*tongso_giocong_phucap_ca3_30
					$phucap_ca3 = round($luong_coban/208*$tongso_giocong_phucap_ca3_30);

					// tính h tăng ca 150 = tổng h công - Tổng h làm hành chính
					$gio_tangca_150 = $salary["tongso_gio"] - $sogio_hanhchinh;

					// tính lương tăng ca 150% = lương cơ bản/208*$gio_tangca_150
					$luong_tangca_150 = round($luong_coban/208*$gio_tangca_150);

					// tính h tăng ca 200% = tổng h công các ngày chủ nhật
					$gio_tangca_200 = $salary["ngaycong_chunhat"];

					// tính lương tăng ca 200% = lương cơ bản/208*$gio_tangca_200
					$luong_tangca_200 = round($luong_coban/208*$gio_tangca_200);

					// lương tăng ca 300% = lương cơ bản/208*...
					$luong_tangca_300 = round($luong_coban/208*30);

					// Tổng lương thời gian = lương hành chính + phụ cấp ca 3 + lương tăng ca 150% + lương tăng ca 200% + lương tăng ca 300%
					$tong_luong_thoigian =round($luong_hanhchinh + $phucap_ca3 + $luong_tangca_150 + $luong_tangca_200 + $luong_tangca_300);

					// tính tiền xăng đi công tác 
					$tienxang_congtac = $salary["tienxang_congtac"];

					// tình có đạt chuyên cần hay không
					$ngaynghi_vophep = $salary["ngaynghi_vophep"];
					$luong_trachnhiem = $salary["trachnhiem"];
					
					$ngaycong_lamhon_8h = $salary["ngaycong_lamhon_8h"];
					$so_ngaycong_hethang = $salary["so_ngaycong_hethang"];
					$so_ngaycong_hethang_khongluong = $salary["so_ngaycong_hethang_khongluong"];
					$ngaynghi_baohiem = $salary["ngaynghi_baohiem"];
					$ngaycong_khong_bamthe = $salary["ngaycong_khong_bamthe"];
					$ngaycong_dimuon_du8h = $salary["ngaycong_dimuon_du8h"];

					$ngaylam_xetthuong = $ngaycong_lamhon_8h +  $so_ngaycong_hethang + $so_ngaycong_hethang_khongluong +  $ngaynghi_baohiem + $ngaycong_khong_bamthe +  $ngaycong_dimuon_du8h;

					$dat_chuyencan = "";
					if($luong_trachnhiem ==0 && $ngaynghi_vophep <1 && $ngaylam_xetthuong>25 && $thang_thamnien > 2.5) $dat_chuyencan = "dat";


					$songay_trocap_dilai = $ngaylam_xetthuong - $ngaynghi_baohiem - $so_ngaycong_hethang_khongluong ;
					

					//tính lương chuyên cần
					$luong_chuyencan = 0;
					if($dat_chuyencan == "dat")
					{
						if ($songay_trocap_dilai<25) $luong_chuyencan = round(300000/26*$songay_trocap_dilai);
						else $luong_chuyencan = 300000;
					}

					// tính đạt đi lại
					$dat_dilai = "";
					if($thang_thamnien > 2.5 && $ngaylam_xetthuong>=25 && $ngaynghi_vophep <1) $dat_dilai = "dat";

					// tính trợ cấp đi lại nhà ở
					$trocap_dilai = 0;
					if($dat_dilai = "dat")
					{
						if($songay_trocap_dilai<25) $trocap_dilai = 200000/26*$songay_trocap_dilai;
						else $trocap_dilai = 200000;
					}

					// tính tiền sữa
					$ngaycong_tinh_tiensua = $salary["ngaycong_tinh_tiensua"];
					$tiensua = $ngaycong_tinh_tiensua*6000;

					$luong_baohiem = $salary["luong_baohiem"];


					// tính thưởng đạt năng xuất
					$thuong_dat_nangxuat = 0;
					$dat_thuongthang = "khong";
					if($thang_thamnien >=2.5 && $ngaylam_xetthuong >23 && $ngaynghi_vophep < 1) 
						$dat_thuongthang = "dat";

					if($dat_thuongthang == "dat" )
					{
						if($songay_trocap_dilai < 23)
						{
							$thuong_dat_nangxuat  = $luong_coban*$salary["mucthuong"]/100/26*$songay_trocap_dilai;
						}
						else $thuong_dat_nangxuat  = $luong_coban*$salary["mucthuong"]/100;
					}
					


					// tính lương phép năm
						$luong_phepnam_hangthang = 0;
					if($luong_baohiem == 0) $luong_phepnam_hangthang = 3750000/26;
					else $luong_phepnam_hangthang = $luong_baohiem/26;
					$luong_om = $salary["luong_om"];
					$tien_dienthoai = $salary["phucap_dienthoai"];
					
					


					$dieuchinh_thangtruoc = $salary["luong_dieuchinh"];

					// 
					$tien_dongphuc = $salary["soluong_ao"]*$array_uniform[0]["price"] + $salary["soluong_non"]*$array_uniform[1]["price"] + $salary["soluong_thekeo"]*$array_uniform[2]["price"] + $salary["soluong_aokt"]*$array_uniform[3]["price"] + $salary["soluong_giaykt"]*$array_uniform[4]["price"];
					$songay_goidau = $salary["songay"];

					// tính thành tiền
					$thanhtien = $luong_coban/26*$songay_goidau;
					$tru_luongung = $salary["tru_luongung"];
					$trutien_dulich = $salary["tien_dulich"];
					$trutien_dienthoai =$salary["tien_dienthoai"];
					
					$vipham_noiquy = $salary["tien_noiquy"];
					$trutien_ng = $salary["tien_ng"];

					// tính tiền ktp
					$trutien_ktp = $luong_trachnhiem/26*$ngaycong_khong_bamthe;


					// tính kpcd
					$kpcd = 0;
					if($thang_thamnien>2.5) $kpcd = 20000;

					// tính $bhxh_bhyt
					$bhxh_bhyt = $luong_baohiem*10.5/100;

					// tính tổng quỹ 
					$tongquy = $trutien_ktp + $kpcd + $trutien_ng;


					// tính lương lễ tết
					$songay_letet = $salary["songay_letet"];
					$luong_letet = 0;
					if($thang_thamnien >2.5)
					{
						if($luong_baohiem == 0) $luong_letet = 3750000/26*$songay_letet;
						else  					$luong_letet = $luong_baohiem/26*$songay_letet;
					}

					// tính tổng luong
					$tongluong = $tong_luong_thoigian + $luong_chuyencan + $trocap_dilai + $luong_trachnhiem + $phucap_luong
					+ $salary["kiemnhiem"] + $thuong_dat_nangxuat + $luong_phepnam_hangthang + $luong_letet + $trutien_ktp + $luong_om + $phucap_dienthoai + $tiensua + $tienxang_congtac;

					// BEGIN: tính thuế tncn 
					$kt_banthan = $salary["kt_banthan"];
					$thanhtien_kt = $salary["songuoi"]*$salary["tien"];

					
					$thunhap_tinhthue = $tongluong - ($phucap_ca3 + $luong_om + $tiensua + $tienxang_congtac + $tongquy +$bhxh_bhyt + 
						$kt_banthan + $thanhtien_kt + $trutien_dienthoai + $vipham_noiquy);
					
					// tính thuế 5%
					$thue_5 = 0;
					$thuexuat_5 = $salary["thue_5"];
					
					if($thunhap_tinhthue <0)$thue_5 = 0;
					else
					{
						if($thunhap_tinhthue <= $thuexuat_5) $thue_5 = $thunhap_tinhthue*5/100;
						else $thue_5 = $thuexuat_5*5/100;

					}

					// tính thuế 10%
					$thue_10 = 0;
					$thuexuat_10 = $salary["thue_10"];
					if($thunhap_tinhthue < $thuexuat_5) $thue_10 = 0;
					else
					{
						if($thunhap_tinhthue <= $thuexuat_10 ) $thue_10 = ($thunhap_tinhthue - $thuexuat_5)*10/100;
						else  $thue_10 = ($thuexuat_10 - $thuexuat_5)*10/100;
					}

					// tính thuế 15%
					$thue_15 = 0;
					$thuexuat_15 = $salary["thue_15"];
					if($thunhap_tinhthue < $thuexuat_10) $thue_15 = 0;
					else
					{
						if($thunhap_tinhthue <= $thuexuat_15)  $thue_15 = ($thunhap_tinhthue - $thuexuat_10)*15/100;
						else $thue_15 = ($thuexuat_15 - $thuexuat_10)*15/100;
					}

					// tính thuế 20%
					$thue_20 = 0;
					$thuexuat_20 = $salary["thue_20"];

					if($thunhap_tinhthue <= $thuexuat_15) $thue_20 = 0;
					else $thue_20 = ($thunhap_tinhthue - $thuexuat_15)*20/100;

					$thue_tncn = $thue_5 + $thue_10 + $thue_15 + $thue_20;
					
					// END: tính thuế tncn


					// tính thực lãnh tháng
					$thuclanh_thang = ($tongluong + $luong_dieuchinh) - ($tien_dongphuc + $thanhtien + $tru_luongung + $trutien_dulich + $trutien_dienthoai + $thue_tncn + $vipham_noiquy + $trutien_ng + $trutien_ktp + $kpcd + $bhxh_bhyt);
					?>
					<tr>
						<td class="fix_cell"><?php echo $stt; ?></td>
						<td class="fix_cell"><?php echo$salary["user_code"]; ?></td>
						<td class="fix_cell"><?php echo$salary["fullname"] ?></td>
						<td style="width: 140px;"><?php echo $salary["id_number"] ?></td>
						<td ><?php echo $salary["bank_account"] ?></td>
						<td><?php echo $thang_thamnien; ?></td>
						<td> <?php echo $thang_hientai; ?></td>
						<td><?php echo $salary["tongso_gio"]; ?></td>
						<td> <?php echo $sogio_hanhchinh; ?></td>
						<td><?php echo $tongso_gio_ngaylam_duoi_8h; ?></td>
						<td><?php echo $songay_hanhchinh_lamhon_8h; ?></td>
						<td><?php echo $salary["tongso_gio_ca3"]; ?></td>
						<td> <?php echo number_format($luong_hanhchinh); ?> </td>
						<td> <?php echo number_format($phucap_ca3); ?></td>
						<td><?php echo number_format($luong_tangca_150) ?></td>
						<td><?php echo number_format($luong_tangca_200) ?></td>
						<td><?php echo number_format($luong_tangca_300) ?></td>
						<td> <?php echo number_format($tong_luong_thoigian) ?></td>
						<td style="width: 102px;"> <?php echo number_format($luong_chuyencan) ?></td>
						<td style="width: 102px;"><?php echo number_format($trocap_dilai) ?></td>
						<td style="width: 102px;"><?php echo number_format($luong_trachnhiem); ?></td>
						<td style="width: 102px;"><?php echo number_format($salary["phucap_luong"]) ?></td>
						<td><?php echo number_format($salary["kiemnhiem"]) ?></td>
						<td><?php echo number_format($salary["luong_coban"]) ?></td>
						<td><?php echo number_format($luong_baohiem); ?></td>
						
						<td style="width: 102px;"><?php echo $thuong_dat_nangxuat; ?> </td>
						<td style="width: 102px;"><?php echo number_format($luong_phepnam_hangthang); ?></td>
						<td><?php echo number_format($luong_letet) ?></td>
						<td><?php echo number_format($luong_om); ?></td>
						
						<td> <?php echo number_format($tien_dienthoai); ?></td>
						
						<td><?php echo number_format($tiensua); ?></td>
						<td> <?php echo number_format($tienxang_congtac); ?></td>
						<td><?php echo number_format($tongluong);?></td>
						<td><?php echo $dieuchinh_thangtruoc; ?></td>
						<td style="width: 100px;"><?php echo number_format($tien_dongphuc); ?></td>
						<td style="width: 100px;"><?php echo $songay_goidau; ?></td>
						<td><?php echo number_format($thanhtien); ?></td>
						<td><?php echo number_format($tru_luongung); ?></td>
						<td> <?php echo number_format($trutien_dulich); ?></td>
						<td><?php echo number_format($trutien_dienthoai); ?></td>
						<td><?php echo number_format($thue_tncn); ?></td>
						<td><?php echo number_format($vipham_noiquy); ?></td>
						<td><?php echo number_format($trutien_ng); ?></td>
						<td><?php echo number_format($trutien_ktp); ?></td>
						<td><?php echo number_format($kpcd); ?></td>
						<td><?php echo number_format($bhxh_bhyt); ?></td>
						<td><?php echo number_format($tongquy); ?></td>
						<td><?php echo number_format($thuclanh_thang) ?></td>
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



		container_table = $(window).width()-20;
		$('#fixed_table').fxdHdrCol({
			fixedCols: 3,
			width:container_table,
			height:400,
			colModal: [
			{ width: 70, align: 'center' }, 
			{ width: 70, align: 'center' }, 
			{ width: 200, align: 'center' }, 
			{ width: 150, align: 'center' }, 
			{ width: 100, align: 'center' }, 
			{ width: 100, align: 'center' }, 
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
			{ width: 150, align: 'center' }, 
			],
			sort: false
		})
	});



</script>