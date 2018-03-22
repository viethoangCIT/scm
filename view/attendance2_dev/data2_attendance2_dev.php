<?php
//*****************************************
//FUNCTION HEADER

//tieu de cua ham
$function_title = "Dữ liệu chấm công";
echo $this->Template->load_function_header($function_title);

//print_r($array_shift);

$str_form_attendance_content = "";
$str_form_attendance_find = "";

$date_dd = "";
if(isset($_GET["date"]) && $_GET["date"] != "")
{
	$date_dd = $_GET["date"];
}

//BEGIN: TÌM KIẾM

$str_input_day = $this->Template->load_textbox(array("name" => "date", "autocomplete" => "off", "value" => $str_date, "id" => "attendance_day", "style" => "width:100px; border:1px solid #ff631d!imoprtant;border-radius: 0px !important;"));

//load selecbox chọn chức vụ
$str_selectbox_position = $this->Template->load_selectbox(array("name" => "id_position", "style" => "width:140px"), $array_position, $id_position);

//load selecbox chọn bộ phận
$str_selectbox_job = $this->Template->load_selectbox(array("name" => "id_job", "style" => "width:140px"), $array_job, $id_job);

//load selecbox chọn nhà máy
$str_selectbox_factory = $this->Template->load_selectbox(array("name" => "id_factory", "style" => "width:140px"), $array_factory, $id_factory);

//load selecbox chọn xưởng
$str_selectbox_manufactory = $this->Template->load_selectbox(array("name" => "id_manufactory", "style" => "width:140px"), $array_manufactory, $id_manufactory);

//load selecbox chọn tổ
$str_selectbox_group = $this->Template->load_selectbox(array("name" => "id_group", "style" => "width:140px"), $array_group, $id_group);

$str_search_input_group = $this->Template->load_textbox(array("name" => "group", "style" => "width:140px","value"=>$group, "placeholder" => "Nhập tổ"));

$str_search_input_user = $this->Template->load_textbox(array("name" => "name", "style" => "width:140px","value"=>$name, "placeholder" => "Nhập nhân viên"));

$str_search_button = $this->Template->load_button(array("value" => "Tìm kiếm", "type" => "submit"), "Tìm kiếm");

$str_search_input_row = "Ngày: $str_input_day $str_selectbox_factory $str_selectbox_manufactory $str_selectbox_position $str_selectbox_job $str_selectbox_group $str_search_input_user $str_search_button </div>";

$str_form_attendance_find = $this->Template->load_form(array("method" => "GET", "action" => "/attendance2/data"), $str_search_input_row);
echo $str_form_attendance_find;

//END: TÌM KIẾM

//buoc 1: tao mang table header
$array_table_header_chamcong = null;

$array_table_header_chamcong["col1"] = array("STT", array("style" => "text-align:center; width:30px"));
$array_table_header_chamcong["col2"] = array("Mã nhân viên", array("style" => "text-align:center"));
$array_table_header_chamcong["col3"] = array("Họ và tên", array("style" => "text-align:center"));
$array_table_header_chamcong["col4"] = array("Nhà máy", array("style" => "text-align:center"));
$array_table_header_chamcong["col5"] = array("Công việc", array("style" => "text-align:center"));
$array_table_header_chamcong["col6"] = array("Giờ điểm danh", array("style" => "text-align:center;width:170px"));
$array_table_header_chamcong["col7"] = array("Giờ bắt đầu", array("style" => "text-align:center;width:80px"));
$array_table_header_chamcong["col8"] = array("Giờ kết thúc", array("style" => "text-align:center;width:80px"));
$array_table_header_chamcong["col9"] = array("Số giờ", array("style" => "text-align:center;width:50px"));
$array_table_header_chamcong["col10"] = array("Lịch làm việc", array("style" => "text-align:center;width:150px"), "nowrap" => "nowrap");
$array_table_header_chamcong["col11"] = array("Loại ngày", array("style" => "text-align:center;width:200px"), "nowrap" => "nowrap");
$array_table_header_chamcong["col12"] = array("Dự kiến đi làm", array("style" => "text-align:center;width:80px"), "nowrap" => "nowrap");
//buoc 2: dung hàm load_table_header de lay template table header
$str_table_header_chamcong = $this->Template->load_table_header($array_table_header_chamcong);

$str_table_row_staff = "";
$saved_element = null;
$firt_usercode = "";
$saved_number = 0;
$str_table_row_chamcong = "";

$num = 0;
$stt = 0;
if($array_user)
{
	foreach($array_user as $user)
	{
		
		$stt++; 	
		//BEGIN: Lấy thông tin user
		$user_fullname = $user["fullname"];
		$user_code = $user["user_code"];
		$user_day = "";
		$user_factory = $user["factory"];
		$user_manufactory = $user["manufactory"];
		$user_shift = $user["shift"];
		$user_shift_type = $user["shift_type"];
		$user_job = $user["job"];
		$id_user = $user["id"];
		$user_group = $user["group_name"];
		$str_group = "";
		if($user_group != "") $str_group = "-".$user_group;
		
		//nếu bộ phận văn phòng thì lịch làm việc là hành chính văn phòng
		
		
		/*if($user_shift_type == "HCVP") $user_shift = "Hành chính văn phòng";
		if($user_shift_type == "HCSX") $user_shift = "Hành chính sản xuất";
		if($user_shift_type == "HC") $user_shift = "Hành chính";*/
		
		
		
		//Lấy giờ điểm danh 
		$array_gio_diemdanh = explode("s",$user["gio_diemdanh"]);
		$sodong_diemdanh = count($array_gio_diemdanh);
		
		$str_gio_batdau_diemdanh = "";
		$str_gio_ketthuc_diemdanh = "";
		
		//giờ bắt đầu của ca làm việc
		$str_gio_batdau_ca = "";
		$gio_batdau_ca = 0;
		if(isset($array_shift[$user_shift]["start_time"]))
		{
			 $str_gio_batdau_ca = trim($str_date." ".$array_shift[$user_shift]["start_time"]);
			$gio_batdau_ca = strtotime($str_gio_batdau_ca);
		}
		
		//lấy giờ kết thúc của ca làm việc
		$str_gio_ketthuc_ca = "";
		$gio_ketthuc_ca = 0;
		if(isset($array_shift[$user_shift]["end_time"]))
		{
			$str_gio_ketthuc_ca = trim($str_date." ".$array_shift[$user_shift]["end_time"]);
			$gio_ketthuc_ca = strtotime($str_gio_ketthuc_ca);
		}
		
		//nếu giờ kết thúc ca nhỏ hơn giờ bắt đầu thì tăng lên 1 ngày
		if($gio_ketthuc_ca < $gio_batdau_ca) $gio_ketthuc_ca = strtotime("+1 day", strtotime($str_gio_ketthuc_ca));
		
		//lấy số giờ nghỉ của ca
		$sogio_nghi = 0;
		if(isset($array_shift[$user_shift]["end_time"]))
		{
			
			$sogio_nghi = $array_shift[$user_shift]["num_hour"];
		}
		
		$str_khunggio_ketthuc_ca = "";
		$khunggio_ketthuc_ca = 0;
		if(isset($array_shift[$user_shift]["end_time"]))
		{
			$str_khunggio_ketthuc_ca = trim($str_date." ".$array_shift[$user_shift]["end_time_allowed"]);
			$khunggio_ketthuc_ca = strtotime($str_khunggio_ketthuc_ca);
		}
		
		$str_khunggio_batdau_ca = "";
		$khunggio_batdau_ca = 0;
		if(isset($array_shift[$user_shift]["end_time"]))
		{
			$str_khunggio_batdau_ca = trim($str_date." ".$array_shift[$user_shift]["start_time_allowed"]);
			$khunggio_batdau_ca = strtotime($str_khunggio_batdau_ca);
		}
		
		
		$gio_batdau_chamcong = 0;
		$str_gio_batdau_chamcong = "";
		$gio_ketthuc_chamcong = 0;
		$str_gio_ketthuc_chamcong = "";
		
		$gio_batdau_diemdanh = 0;
		$gio_ketthuc_diemdanh = 0;
		
		$sogio = 0;
		//Lấy giờ điểm danh
		$str_gio_diemdanh = "";
		if($array_gio_diemdanh)
		{
			
			//Lấy giờ điểm danh đầu tiền
			if(isset($array_gio_diemdanh[0]) && $array_gio_diemdanh[0] != "") 
			{
				$gio_batdau_diemdanh = strtotime($array_gio_diemdanh[0]);				
				
				$str_gio_batdau_diemdanh = date("H:i:s",$gio_batdau_diemdanh);
				
				//Lấy giờ bắt đầu chấm công
				
				if($gio_batdau_diemdanh <=$gio_batdau_ca) $gio_batdau_chamcong = $gio_batdau_ca;
				else $gio_batdau_chamcong = $gio_batdau_diemdanh;
				$str_gio_batdau_chamcong = date("H:i:s",$gio_batdau_chamcong);
			}

			$i = 0;
			foreach($array_gio_diemdanh as $gio_diemdanh)
			{
				if($gio_diemdanh != "")
				{
					$i++;
					//lấy dòng ngày giờ điểm danh hiện tại và chuyển sang kiểu giờ
					$ngay_gio = strtotime($gio_diemdanh);
					$str_gio = date("H:i:s",$ngay_gio);
					$str_ngay = date("d-m-Y",$ngay_gio);
					
					$str_gio_diemdanh .="<span id ='time_" . $user_code . "_$i'>" .date("Y-m-d",$ngay_gio)." ".$str_gio."</span><br>";
					
					//lay giờ kết thúc chấm công
					if($khunggio_batdau_ca > 0 && $khunggio_ketthuc_ca > 0) 
					{
						//Nếu người hiện tại có ca làm việc và số giờ điểm danh nằm trong khung giờ ca thì lấy giờ kết thúc  chấm công
						if($ngay_gio > $khunggio_batdau_ca && $ngay_gio < $khunggio_ketthuc_ca)
						{
							$gio_ketthuc_chamcong = $ngay_gio;
							$str_gio_ketthuc_chamcong = $str_gio;
						}
					}//END: if($khunggio_batdau_ca > 0 && $khunggio_ketthuc_ca > 0
					else
					{
						//tinh so gio hien tai so voi dong dau tien
						$sogio_sovoi_dautien = round((abs($ngay_gio - $gio_batdau_chamcong))/ 3600, 2);
						if($sogio_sovoi_dautien < 18)
						{
							$gio_ketthuc_chamcong = $ngay_gio;
							$str_gio_ketthuc_chamcong = $str_gio;
						}
					}
					
				}//END: if($gio_diemdanh != "")
			}//END: foreach($array_gio_diemdanh as $gio)
			
			
		
			
			
			//Lấy giờ điểm danh cuối cùng
			if($sodong_diemdanh > 0)
			{ 
				if(isset($array_gio_diemdanh[$sodong_diemdanh - 1]) && $array_gio_diemdanh[$sodong_diemdanh - 1] != "" ) 
				{
					$gio_ketthuc_diemdanh = strtotime($array_gio_diemdanh[$sodong_diemdanh - 1]);
					$str_gio_ketthuc_diemdanh = date("H:i:s",$gio_ketthuc_diemdanh);
				}
			}
			
			
			
			
			//Nếu giờ kết thúc điểm danh nằm ngoài khung giờ kết thúc ca thì không tính
			
			//Tính số giờ đi làm
			if(($gio_batdau_chamcong > 0) && ($gio_ketthuc_chamcong > 0)) $sogio = round(abs($gio_ketthuc_chamcong - $gio_batdau_chamcong) / 3600, 2);
			
			
			//Làm tròn số giờ
			//Số giờ làm tròn
			$sogio_lamtron = floor($sogio);
	
			$sogio_le = $sogio - $sogio_lamtron;
			if ($sogio_le < 0.5) $sogio_le = 0;
			else	$sogio_le = 0.5;
	
			$sogio_lamtron += $sogio_le;
			$sogio_dilam = $sogio_lamtron - $sogio_nghi;
			if($sogio_dilam < 0) $sogio_dilam = 0;

		}//END: if($array_gio_diemdanh)
				
		
		//END: lấy thông tin user
		//BEGIN: Tạo input
		$array_work_type = array("1"=>"Có", "2"=>"Không");
		$str_hidden_id_user = $this->Template->load_hidden(array("name" => "data[$num][id_user]", "value" => $id_user));
		$str_hidden_fullname = $this->Template->load_hidden(array("name" => "data[$num][user_fullname]", "value" => $user_fullname));
		$str_hidden_user_code = $this->Template->load_hidden(array("name" => "data[$num][user_code]", "value" => $user_code));
		$str_input_day = $this->Template->load_textbox(array("name" => "data[$num][day]", "value" => "","id"=>"day", "style" => "width:80px"));
		$str_input_start_time = $this->Template->load_textbox(array("name" => "data[$num][start_time]", "value" =>$str_gio_batdau_chamcong,"id"=>"start_time_$user_code", "style" => "width:80px"));
		$str_input_end_time = $this->Template->load_textbox(array("name" => "data[$num][end_time]", "value" => $str_gio_ketthuc_chamcong,"id"=>"end_time_$user_code","onchange"=>"tinh_gio('$user_code')", "style" => "width:80px"));
		$str_input_hour = $this->Template->load_textbox(array("name" => "data[$num][hour]", "value" => $sogio_dilam,"id"=>"hour_$user_code", "style" => "width:50px"));
		$str_selectbox_shift = $this->Template->load_selectbox(array("name" => "data[$num][shift]","onchange"=>"capnhat_gio(this.value,'$user_code','$sodong_diemdanh')", "style" => "width:140px"), $array_work_shift);
		$str_selectbox_typeday = $this->Template->load_selectbox(array("name" => "data[$num][day_type]", "style" => "width:200px"), $array_type_workday);
		$str_selectbox_work_day= $this->Template->load_selectbox_basic(array("name" => "data[$num][status]", "style" => "width:80px"), $array_work_type);
		
		
		
		//END: Tạo input
		$str_user_shift = "";
		if(isset($array_shift[$user_shift]["name"]))
		{ 
			$str_hidden_shift = $this->Template->load_hidden(array("name" => "data[$num][id_shift]", "value" => $array_shift[$user_shift]["id"]));
			
			$str_user_shift = $array_shift[$user_shift]["name"];
			$str_user_shift .= "<br>(<span style='font-size:10px;' >".$array_shift[$user_shift]["start_time"].": ".$array_shift[$user_shift]["end_time"]."<br>".$array_shift[$user_shift]["desc"]."</span>)".$str_hidden_shift;
		}
		$str_hidden_shift = "";
		if($user_shift == "" || $user_shift_type == "lich_dong")
		{
			$str_user_shift = $str_selectbox_shift."<span style='font-size:10px;' id='lich_dong_$user_code'><span>";
		}
			
		$str_sogio_lamtron = "";
		if($sogio_lamtron != 0)	$str_sogio_lamtron = "<span id='gio_tron_$user_code' style='font-size:10px'>$sogio_lamtron</span>";
		$str_gio_batdau_diemdanh = "<span style='font-size:10px'>$str_gio_batdau_diemdanh</span>";
		$str_gio_ketthuc_diemdanh = "<span style='font-size:10px'>$str_gio_ketthuc_diemdanh</span>";
		
		//BEGIN: tạo dòng table
		$array_table_row_chamcong = null;
		$array_table_row_chamcong["col1"] = array($num, array("style" => "text-align:center;"));
		$array_table_row_chamcong["col2"] = array($user_code.$str_hidden_user_code.$str_hidden_id_user, array("style" => "text-align:center"));
		$array_table_row_chamcong["col3"] = array($user_fullname.$str_hidden_fullname, array("style" => "text-align:center"));
		$array_table_row_chamcong["col4"] = array($user_factory."-".$user_manufactory, array("style" => "text-align:center"));
		$array_table_row_chamcong["col5"] = array($user_job.$str_group, array("style" => "text-align:center"));
		$array_table_row_chamcong["col6"] = array($str_gio_diemdanh, array("style" => "text-align:center"));
		$array_table_row_chamcong["col7"] = array($str_input_start_time.$str_gio_batdau_diemdanh, array("style" => "text-align:center;"));
		$array_table_row_chamcong["col8"] = array($str_input_end_time.$str_gio_ketthuc_diemdanh, array("style" => "text-align:center;"));
		$array_table_row_chamcong["col9"] = array($str_input_hour.$str_sogio_lamtron, array("style" => "text-align:center"));
		$array_table_row_chamcong["col10"] = array($str_user_shift.$str_hidden_shift, array("style" => "text-align:center;"), "nowrap" => "nowrap");
		$array_table_row_chamcong["col11"] = array($str_selectbox_typeday, array("style" => "text-align:center;"), "nowrap" => "nowrap");
		$array_table_row_chamcong["col12"] = array($str_selectbox_work_day, array("style" => "text-align:center;"));
		//END: tạo dòng table
		$str_table_row_chamcong .= $this->Template->load_table_row($array_table_row_chamcong, array("align" => "center"));
		$num++;
	}
}
else {
	$array_table_row_chamcong = array("col1" => array("Không có dữ liệu", array("style" => "text-align:center;", "colspan" => "9")));
	$str_table_row_chamcong = $this->Template->load_table_row($array_table_row_chamcong);
}
//buoc 5: dung ham load_table đưa dữ liệu vào table

$str_table_chamcong = $this->Template->load_table($str_table_header_chamcong . $str_table_row_chamcong);

//tạo nút lưu
$str_btn_save = $this->Template->load_button(array("type" => "submit"), "Lưu");
$str_hidden_day = $this->Template->load_hidden(array("name" => "day", "value" => "","id"=>"day", "style" => "width:90px"));

// dùng hàm load_form để lấy html cho form
$str_form = $this->Template->load_form(array("action" => "/attendance2/data", "method" => "post", "id" => "form_staff"), $str_table_chamcong . $str_btn_save.$str_hidden_day);

// Hiển thị ra trình duyệt
echo $str_form;
$str_ngay_chamcong = date("Y-m-d");
if(isset($_GET['date'])) $str_ngay_chamcong = date("Y-m-d", strtotime($_GET['date']));
?>
<script type="text/javascript">
	$( function() {
		$( "#attendance_day" ).datepicker({dateFormat: "dd-mm-yy"});
	} );
	if("<?php echo $date_dd;?>" != "")
		{
			document.getElementById("day").value = "<?php echo $date_dd;?>";
		}
		
	//Mảng thông tin ca
	var ngay_chamcong = "<?php echo $str_ngay_chamcong; ?>";
	var array_ca =[];
	<?php
	if ($array_shift) {
		foreach ($array_shift as $work_shift) {
			$id_work_shift = $work_shift["id"];
			$work_shift_type = $work_shift["type"];
			$str_gio_batdau = $work_shift["start_time"];
			$str_gio_ketthuc = $work_shift["end_time"];
			$str_gio_nghi = $work_shift["num_hour"];
			$str_ghichu = $work_shift["desc"];
			$str_khunggio_batdau = $work_shift["start_time_allowed"];
			$str_khunggio_ketthuc = $work_shift["end_time_allowed"];
			if($str_gio_nghi =='') $str_gio_nghi = 0;
	
			?>
				array_ca['<?php echo $id_work_shift; ?>'] =
				{
					gio_batdau:"<?php echo $str_gio_batdau; ?>",
					gio_ketthuc:"<?php echo $str_gio_ketthuc; ?>",
					khung_gio_batdau:"<?php echo $str_khunggio_batdau; ?>",
					khung_gio_ketthuc:"<?php echo $str_khunggio_ketthuc; ?>",
					sogio_nghi:"<?php echo $str_gio_nghi; ?>",
					ghichu:"<?php echo $str_ghichu; ?>"
				};
		<?php
	} //END: foreach ($array_work_shift2 as $work_shift) {
	} //END: if ($$array_work_shift2) {
	?>
	
	function tinh_gio(user_code,gio_batdau,gio_ketthuc,ca)
	{
		//lấy giờ bắt đầu khi gõ vào ô textbox giờ bắt đầu
		var start_time = document.getElementById('start_time_'+user_code).value;
		var str_ngaygio_batdau = "<?php echo $str_ngay_chamcong;?>" +" "+ start_time;
		
		//chuyển sang kiểu giờ
	    var bits = str_ngaygio_batdau.split(/\D/);
	    gio_batdau = new Date(bits[0], --bits[1], bits[2], bits[3], bits[4]);
		
		//Lấy giờ kết thúc khi gõ vào ô textbox giờ kết thúc
		var end_time = document.getElementById("end_time_"+user_code).value;
		
		var str_ngaygio_ketthuc = "<?php echo $str_ngay_chamcong;?>" +" "+ end_time;

		var bits = str_ngaygio_ketthuc.split(/\D/);
	    gio_ketthuc = new Date(bits[0], --bits[1], bits[2], bits[3], bits[4]);
		
		if(gio_ketthuc<gio_batdau)	gio_ketthuc.setDate(gio_ketthuc.getDate() + 1);
		
		//tính số giờ làm việc
		var so_milligiay_lamviec = gio_ketthuc - gio_batdau;

        var sophut_lamviec = so_milligiay_lamviec/1000/60;
		
		//tính số giờ giữa giờ bắt đầu và giờ kết thúc
        var sogio = Math.floor(sophut_lamviec/60);
        var so_phut =sophut_lamviec%60;
		
		//nếu số phút lớn hơn 30 thì tăng 0.5 giờ làm việc
        if(so_phut>=30) sogio += 0.5;
		document.getElementById('gio_tron_'+user_code).innerHTML= ""+sogio;
				
		sogio =  sogio - array_ca[ca]["sogio_nghi"];
        document.getElementById('hour_'+user_code).value= sogio;
		
		
	}
	
	function capnhat_gio(ca, user_code,sodong_diemdanh)
	{
		
		var str_gio_batdau_ca = array_ca[ca]["gio_batdau"];
		var str_gio_ketthuc_ca = array_ca[ca]["gio_ketthuc"];
		
		//lấy khung giờ bắt đầu và khung giờ kết thúc
		var str_khunggio_batdau_ca = ngay_chamcong +" "+ array_ca[ca]["khung_gio_batdau"];
		var str_khunggio_ketthuc_ca = ngay_chamcong +" "+ array_ca[ca]["khung_gio_ketthuc"];
	
		//Tính giờ băt đầu chấm công và giờ kết thúc chấm công
		var bits = str_khunggio_batdau_ca.split(/\D/);
		var khunggio_batdau_ca = new Date(bits[0], --bits[1], bits[2], bits[3], bits[4]);
		
		var bits = str_khunggio_ketthuc_ca.split(/\D/);
		var khunggio_ketthuc_ca = new Date(bits[0], --bits[1], bits[2], bits[3], bits[4]);
		
		//
		//nếu giờ đi về < giờ bắt đầu thì tăng lên một ngày
		if(khunggio_ketthuc_ca<khunggio_batdau_ca)	khunggio_ketthuc_ca.setDate(khunggio_ketthuc_ca.getDate() + 1);
		//So sanh từng giờ điểm danh với khung giờ ca
		
		//Đưa giờ bắt đầu ca vào dưới selecbox ca
		document.getElementById('lich_dong_'+user_code).innerHTML = str_gio_batdau_ca+"-"+str_gio_ketthuc_ca;
		
		//duyệt tất cả các giờ điểm danh mà người dùng đã nhấn
		var vitri_batdau = 0;
        var daco_vitri_batdau = false;
		var gio_batdau_chamcong = 0;
        for(i = 1; i <= sodong_diemdanh; i++)
        {

			//lấy dòng hiện tại giờ của người chấm công
         	var str_dong_ngaygio_chamcong = document.getElementById('time_'+user_code+"_"+i).innerHTML;
			
			
			//chuyển sang kiểu giờ
            var bits = str_dong_ngaygio_chamcong.split(/\D/);
            gio_chamcong = new Date(bits[0], --bits[1], bits[2], bits[3], bits[4]);
			//alert("khunggio_batdau_ca: "+khunggio_batdau_ca);
			//alert("khunggio_ketthuc_ca: "+khunggio_ketthuc_ca);
			//alert("Gio cham cong: "+gio_chamcong);
			
			//nếu giờ làm việc trong khung giờ thì đúng
              	if(gio_chamcong > khunggio_batdau_ca && gio_chamcong <= khunggio_ketthuc_ca)
              	{
              		document.getElementById('time_'+user_code+"_"+i).style = "text-decoration: ''";
					
              		if(daco_vitri_batdau == false)
              		{
						gio_batdau_chamcong = gio_chamcong;
              			vitri_batdau = i;
              			daco_vitri_batdau = true;
              		}
              	}
              	else
              	{
              		//nếu giờ điểm danh ngoài khung giờ làm việc thì gạch ngang
              		document.getElementById('time_'+user_code+"_"+i).style = "text-decoration: line-through";


            	}
			
   		}//end for
		document.getElementById('start_time_'+user_code).value=  gio_batdau_chamcong.getHours()+":"+gio_batdau_chamcong.getMinutes()+":"+gio_batdau_chamcong.getSeconds();
		
		//Tìm giờ kết thúc
		//nếu gio_ketthuc nằm trong phạm vi khung  giờ bắt đâu và giờ kết thúc thì lấy
            var str_gio_ketthuc = "";
            var gio_ketthuc;
            var vitri_ketthuc = sodong_diemdanh;
            for(i = sodong_diemdanh; i >= 1; i--)
            {
				//lấy giờ điểm danh hiện tại
            	str_gio_ketthuc = document.getElementById('time_'+user_code+'_'+i).innerHTML ;
	            //chuyển sang kiểu giờ
	            var bits = str_gio_ketthuc.split(/\D/);
	            gio_ketthuc = new Date(bits[0], --bits[1], bits[2], bits[3], bits[4]);

            	//kiểm tra nếu giờ kết trong khung giờ làm việc thì thoát
            	if(gio_ketthuc >= khunggio_batdau_ca && gio_ketthuc <= khunggio_ketthuc_ca)
            	{
            		vitri_ketthuc = i;
            		break;

            	}
            }
			
            //lấy giờ kết thúc đưa vào textbox giờ kết thúc
			
            document.getElementById('end_time_'+user_code).value=  gio_ketthuc.getHours()+":"+gio_ketthuc.getMinutes()+":"+gio_ketthuc.getSeconds();
		tinh_gio(user_code,gio_chamcong,gio_ketthuc,ca);
	}//END: function capnhat_gio(ca, user_code)
</script>