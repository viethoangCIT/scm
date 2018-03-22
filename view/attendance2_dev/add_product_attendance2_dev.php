
<style type="text/css">

.tbl_r{

}
.table-responsive{
	width: 100%;
	/*  margin-left: 150px;*/

}
.parent{

	height: auto;
	position: absolute;
	width: 100%;
	left: 0;
	overflow:hidden;
}

</style>



<?php

//tạo tiêu đề hàm
if ($array_edit_product) {
	$function_title = "Sửa chi tiết lương sản phẩm";
	echo $this->Template->load_function_header($function_title);
} else {
	$function_title = "Nhập chi tiết lương sản phẩm";
	echo $this->Template->load_function_header($function_title);

}

$str_form_product = "";

array_unshift($array_department, array("id" => "", "name" => "Phòng ban"));
array_unshift($array_factory, array("id" => "", "name" => "Nhà máy"));
array_unshift($array_work, array("id" => "", "name" => "Công việc"));
array_unshift($array_position, array("id" => "", "name" => "Chức vụ"));
array_unshift($array_manufactory, array("id" => "", "name" => "Phân xưởng"));

array_unshift($array_product, array("id" => "0", "name" => "Sản phẩm"));
$date_product = "";
if ($array_edit_product != null) {
	$date_product = $array_edit_product[0]['date'];
	$date_product = date("d-m-Y", strtotime($date_product));
}

$str_input_from = $this->Template->load_textbox(array("name" => "date", "autocomplete" => "off", "value" => $date_product, "id" => "date", "class" => "date", "style" => "width:130px;", "onchange" => "document.getElementById('date_hidden').value = document.getElementById('date').value "));
//--------------------------------------------------
//phong ban

$array_work_attendance = array("0" => "Chọn loại ngày công", "1" => "Ngày công hết hàng cho về", "2" => "Ngay công hết hàng không lương", "3" => "Ngày nghỉ bảo hiểm hoặc bệnh", "6" => "Ngày công chủ nhật", "7" => "Ngày nghỉ có phép", "8" => "Ngày nghỉ vô phép", "9" => "Ngày không bấm thẻ", "10" => "Ngày công tính tiền sữa", "11" => "Ngày công đi muộn(đủ 8h)");

$str_select_work_attendance = $this->Template->load_selectbox_basic(array("name" => "type_workday", "autocomplete" => "off", "id" => "type_workday", "onchange" => "document.getElementById('type_workday_hidden').value = document.getElementById('type_workday').value "), $array_work_attendance);

$str_select_department = $this->Template->load_selectbox(array("name" => "id_department", "autocomplete" => "off", "value" => "", "id" => "id_department", "style" => "width:100px"), $array_department, $id_department);
// chức vụ

$str_select_position = $this->Template->load_selectbox(array("name" => "id_position", "autocomplete" => "off", "value" => "", "id" => "id_position", "style" => "width:100px"), $array_position, $id_position);

// lọc theo công việc

$str_select_work = $this->Template->load_selectbox(array("name" => "id_work", "autocomplete" => "off", "value" => "", "id" => "id_work", "style" => "width:100px"), $array_work, $id_work);

// lọc theo nhà máy
$str_select_factory = $this->Template->load_selectbox(array("name" => "id_factory", "autocomplete" => "off", "value" => "", "id" => "id_factory", "style" => "width:100px"), $array_factory, $id_factory);

// lọc theo phân xưởng
$str_select_manufactory = $this->Template->load_selectbox(array("name" => "id_manufactory", "autocomplete" => "off", "value" => "", "id" => "part", "style" => "width:100px"), $array_manufactory, $id_manufactory);

$str_input_name_attendance = $this->Template->load_textbox(array("name" => "name", "autocomplete" => "off", "value" => $name, "id" => "name", "placeholder" => "Nhập tên nhân viên"));

$str_btn_save = "<input type='submit' class='timkiem'value='Tìm kiếm' style='font-size: 13.4px'>";
$str_btn_luu = "<input type='submit' class='btn-primary'value='Lưu' style='font-size: 13.4px'>";

$str_input_product_day = "<form action='' method='GET' ><div id = 'search_bar'>    Chọn ngày:$str_input_from $str_select_work_attendance $str_select_department  $str_select_position  $str_select_work  $str_select_factory  $str_select_manufactory $str_input_name_attendance $str_btn_save </div></form>";

//tạo nút tìm

//----------------------------------------------------

//tạo nút tìm

if ($array_edit_product != null) {

	$str_input_from = $this->Template->load_textbox(array("name" => "date", "autocomplete" => "off", "value" => $array_edit_product[0]["date"], "id" => "date", "class" => "date", "style" => "width:130px;"));
//1: tao mang table header
	$array_header_product = array("Stt" => array("STT", array("style" => "text-align:center; width:3%")),
		"manv" => array("Mã nhân viên ", array("style" => "text-align:left; width:5%;white-space: nowrap")),
		"tennv" => array("Họ & Tên", array("style" => "text-align:center; width:12%;")),
		"chucvu" => array("Chức vụ", array("style" => "text-align:left; width:7%")),
		"masp" => array("Sản phẩm - đơn giá", array("style" => "text-align:left; width:15%;white-space: nowrap")),
		"ngay" => array("Ngày", array("style" => "text-align:left; width:6%")),
		"loại" => array("Loại", array("style" => "text-align:left; width:6%")),
		"soluonglamduoc" => array("Số lượng làm được", array("style" => "text-align:left; width:7%")),
		"nguoi_ga" => array("Người/Gá", array("style" => "text-align:left; width:7%")),
		// "thanhtien"=>array("Thành tiền",array("style"=>"text-align:left; width:9%")),
		"action" => array("Chức năng", array("style" => "text-align:center;width:5%;")),

	);

	//2: lấy dòng tr header
	$str_form_product = $this->Template->load_table_header($array_header_product);

	$stt = 0;
	foreach ($array_edit_product as $product) {

		$array_work_attendance = array("0" => "Chọn loại ngày công", "1" => "Ngày công hết hàng cho về", "2" => "Ngay công hết hàng không lương", "3" => "Ngày nghỉ bảo hiểm hoặc bệnh", "6" => "Ngày công chủ nhật", "7" => "Ngày nghỉ có phép", "8" => "Ngày nghỉ vô phép", "9" => "Ngày không bấm thẻ", "10" => "Ngày công tính tiền sữa", "11" => "Ngày công đi muộn(đủ 8h)");
		$str_select_work_attendance = $this->Template->load_selectbox_basic(array("name" => "data[0][type_workday]", "autocomplete" => "off", "id" => "type_shift"), $array_work_attendance, $product["type_workday"]);

		$str_input_id = $this->Template->load_hidden(array("name" => "data[0][id]", "id" => "id", "value" => $product["id"], "style" => "width:100px; margin-top:10px;"));
		$str_input_id_user = $this->Template->load_hidden(array("name" => "data[0][id_user]", "id" => "id_user", "value" => $product["id_user"], "style" => "width:100px; margin-top:10px;"));
		$str_input_user_code = $this->Template->load_hidden(array("name" => "data[0][user_code]", "id" => "user_code", "value" => $product["user_code"], "style" => "width:100px; margin-top:10px;"));
		$str_input_product_fullname = $this->Template->load_hidden(array("name" => "data[0][fullname]", "id" => "fullname", "value" => $product["fullname"], "style" => "width:100px;  margin-top:10px;"));
		$str_input_product_position = $this->Template->load_hidden(array("name" => "data[0][position]", "id" => "position", "value" => $product["position"], "style" => "width:100px; margin-top:10px;"));

		//  mã sản phẩm

		$str_input_product_code = $this->Template->load_selectbox(array("name" => "data[0][id_product]", "id" => "id_product", "style" => "width:200px"), $array_product, $product["id_product"]);

		//số người lam được
		$str_input_number_people = $this->Template->load_textbox(array("name" => "data[$stt][number_work]", "id" => "number_work", "value" => $product["number_work"], "style" => "width:100px"));

		// số người trên gá
		$str_input_people_stick = $this->Template->load_textbox(array("name" => "data[$stt][nguoi_ga]", "id" => "nguoi_ga", "value" => $product["nguoi_ga"], "style" => "width:100px"));

		// thanh tiền
		$str_input_thanhtien = $this->Template->load_textbox(array("name" => "data[$stt][thanhtien]", "id" => "thanhtien", "value" => $product["thanhtien"], "style" => "width:100px"));

		//link thêm _ lưu
		$str_insert_button = $this->Template->load_button(array("type" => "submit", "onclick" => "them()"), "Thêm");

		//lấy dòng nội dung table
		$array_product1 = array(
			"Stt" => array(1, array("style" => "text-align:left; width:3%;")),
			"manv" => array($product["user_code"] . $str_input_id, array("style" => "text-align:left; width:5%;white-space: nowrap")),
			"tennv" => array($product["fullname"], array("style" => "text-align:center; width:15%;")),
			"chucvu" => array($product["position"], array("style" => "text-align:left; width:8%; ")),
			"masp" => array($str_input_product_code, array("style" => "text-align:left; width:8%")),
			"ngay" => array($str_input_from, array("style" => "text-align:left; width:8%")),
			"loại" => array($str_select_work_attendance, array("style" => "text-align:left; width:8%")),
			"soluonglamduoc" => array($str_input_number_people, array("style" => "text-align:left; width:8%")),
			"nguoi_ga" => array($str_input_people_stick, array("style" => "text-align:left; width:7%")),

			"action" => array($str_insert_button, array("style" => "text-align:center; ")),
		);
		$str_form_product .= $this->Template->load_table_row($array_product1);

	}
} else {
	//1: tao mang table header
	$array_header_product = array("Stt" => array("STT", array("style" => "text-align:center; width:3%")),
		"manv" => array("Mã nhân viên ", array("style" => "text-align:left; width:5%;white-space: nowrap")),
		"tennv" => array("Họ & Tên", array("style" => "text-align:center; width:15%;")),
		"chucvu" => array("Chức vụ", array("style" => "text-align:left; width:7%")),
		"masp" => array("Sản phẩm - đơn giá", array("style" => "text-align:left; width:70%;white-space: nowrap")),

	);

	//2: lấy dòng tr header
	$str_form_product = $this->Template->load_table_header($array_header_product);

	//---------------------------------------------------------

	$stt = 0;

	$num_user = 1;
	foreach ($array_product_assign as $user) {
		# code...

		// bảng chọn loại ngày công

		// thanh tiền
		//$str_input_thanhtien = $this->Template->load_textbox(array("name"=>"data[$stt][thanhtien]","id"=>"thanhtien","value"=>"","style"=>"width:100px"));

		// danh sách sản phẩm
		$str_table_product = "<tr  class='v_mid'><td>Tên Sản Phẩm</td><td>Số lượng</td><td>Người/Gá</td></tr>";

		$tmp_product_name = $user["product_name"];
		$tmp_id_product = $user["id_product"];

		$str_input_id_user = $this->Template->load_hidden(array("name" => "data[$stt][id_user]", "id" => "id_user", "value" => $user["id"], "style" => "width:100px; margin-top:10px;"));
		$str_input_user_code = $this->Template->load_hidden(array("name" => "data[$stt][user_code]", "id" => "user_code", "value" => $user["user_code"], "style" => "width:100px; margin-top:10px;"));
		$str_input_product_fullname = $this->Template->load_hidden(array("name" => "data[$stt][fullname]", "id" => "fullname", "value" => $user["fullname"], "style" => "width:100px;  margin-top:10px;"));
		$str_input_product_position = $this->Template->load_hidden(array("name" => "data[$stt][position]", "id" => "position", "value" => $user["position"], "style" => "width:100px; margin-top:10px;"));

		$str_input_id_department = $this->Template->load_hidden(array("name" => "data[$stt][id_department]", "id" => "id_department", "value" => $user["id_department"], "style" => "width:100px; margin-top:10px;"));

		$str_input_id_position = $this->Template->load_hidden(array("name" => "data[$stt][id_position]", "id" => "id_position", "value" => $user["id_position"], "style" => "width:100px; margin-top:10px;"));

		$str_input_id_product = $this->Template->load_hidden(array("name" => "data[$stt][id_product]", "id" => "id_product", "value" => $tmp_id_product, "style" => "width:100px; margin-top:10px;"));

		$str_input_id_factory = $this->Template->load_hidden(array("name" => "data[$stt][id_factory]", "id" => "id_factory", "value" => $user["id_factory"], "style" => "width:100px; margin-top:10px;"));

		$str_input_id_manufactory = $this->Template->load_hidden(array("name" => "data[$stt][id_manufactory]", "id" => "id_manufactory", "value" => $user["id_manufactory"], "style" => "width:100px; margin-top:10px;"));

		$str_input_id_work = $this->Template->load_hidden(array("name" => "data[$stt][id_work]", "id" => "id_work", "value" => $user["id_work"], "style" => "width:100px; margin-top:10px;"));

		//  mã sản phẩm
		$str_input_product_code = $this->Template->load_selectbox(array("name" => "data[$stt][id_product]", "id" => "id_product", "style" => "width:200px"), $array_product);

		//textbox số lượng làm được
		$str_input_number = $this->Template->load_textbox(array("name" => "data[$stt][number_work]", "id" => "number_work", "value" => "", "style" => "width:100px"));

		// số người trên gá
		$str_input_people_stick = $this->Template->load_textbox(array("name" => "data[$stt][nguoi_ga]", "id" => "nguoi_ga", "value" => "", "style" => "width:100px"));

		$str_hidden = $str_input_user_code . $str_input_id_position . $str_input_id_user . $str_input_id_department . $str_input_product_fullname . $str_input_id_factory . $str_input_product_position . $str_input_id_manufactory . $str_input_id_work;
		$str_table_product .= "<tr><td>$tmp_product_name $str_input_id_product $str_hidden</td><td>$str_input_number</td><td>$str_input_people_stick</td></tr>";

		$stt++;
		$str_table_product = "<table class='ui-responsive table table-bordered table-striped' border='1' width='100%'>$str_table_product</table>";

		//link thêm _ lưu
		$str_insert_button = $this->Template->load_button(array("type" => "submit", "onclick" => "them()"), "Thêm");

		//lấy dòng nội dung table
		$array_product1 = array(

			"Stt" => array($num_user, array("style" => "text-align:left; width:3%;")),
			"manv" => array($user["user_code"], array("style" => "text-align:left; width:5%;white-space: nowrap", "id" => "code_$num_user")),
			"tennv" => array($user["fullname"], array("style" => "text-align:center; width:15%;")),
			"chucvu" => array($user["position"], array("style" => "text-align:left; width:8%; ")),
			"masp" => array($str_table_product, array("style" => "text-align:left; width:8%")),

		);
		$num_user++;
		$str_form_product .= $this->Template->load_table_row($array_product1);
	}
}

$str_save_button = $this->Template->load_button(array("type" => "button", "onclick" => "luu()"), "Lưu");

//lấy dòng nội dung table
if ($array_edit_product == NULL) {
	$array_product1 = array(

		"nguoi_ga" => array($str_save_button, array("style" => "text-align:right; width:7%", "colspan" => "5")),
	);
} else {
	$array_product1 = array("nguoi_ga" => array($str_save_button, array("style" => "text-align:right; width:7%", "colspan" => "5")));
}
$str_form_product .= $this->Template->load_table_row($array_product1);

//đưa vào table
$str_form_product = $this->Template->load_table($str_form_product);

$str_input_from_hidden = $this->Template->load_hidden(array("name" => "date", "id" => "date_hidden", "value" => ""));

$str_input_type_workday_hidden = $this->Template->load_hidden(array("name" => "type_workday", "id" => "type_workday_hidden", "value" => ""));

//đưa vào table
$str_form_product = $this->Template->load_form(array("method" => "POST", "id" => "form_nhap", "action" => "/attendance2/add_product?debug=code"), $str_input_from_hidden . $str_form_product . $str_input_type_workday_hidden);

if ($array_edit_product == NULL) {
	echo $str_input_product_day;
}

echo $str_form_product;
?>
<div class="parent">

	<?php
//buoc 5: dung ham load_table đưa dữ liệu vào table

?>
</div>
<?php

?>



<script type="text/javascript">
	$( function() {
		$( "#date" ).datepicker({dateFormat: "dd-mm-yy"});
	} );
</script>
<script type="text/javascript">


	function luu()
	{
		if(document.getElementById("date").value == "")
		{
			alert("Xin vui lòng chon ngày");
			document.getElementById("date").focus();
			return;
		}
		document.getElementById("form_nhap").submit();
	}
</script>

<!-- <script>
	$(document).ready(function(){
		var num = <?php echo $num_user; ?>;
	    var user_code = $('#code_2').text();
	    alert("user_code:"+num);
	    for(i = 1; i <= num; i++)
	    {
	    	var code_i = "#code_"+i;
	    	var code_i1 = "#code_"+(i-1);
	    	var user_code = $(code_i).text();
	    	alert("user_code:"+user_code);
	    }

	});
</script> -->

<!-- <script type="text/javascript">
		var num = <?php echo $num_user; ?>;
	    var user_code = $('#code_2').text();
	    alert("user_code:"+num);
	    for(i = 2; i<num ; i++)
	    {
	    	var code_i = "code_"+i;
	    	var it = i-1;
	    	var code_itruoc = "code_"+it;
	    	var code = document.getElementById(code_i).innerHTML;
	    	var code_truoc = document.getElementById(code_itruoc).innerHTML;

	    	if(code_truoc == code)
	    	{

	    		document.getElementById(code_i).style.display = "none";
	    		document.getElementById(code_itruoc).rowSpan = "2";
	    	}
	    	// document.getElementById("myTd").rowSpan = "1";
	    }

</script> -->



