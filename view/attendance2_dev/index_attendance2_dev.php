<?php
//*****************************************
//FUNCTION HEADER
//*****************************************

$function_title = "Danh Sách Chấm Công";
echo $this->Template->load_function_header($function_title);

//*****************************************
//END FUNCTION HEADER
//*****************************************

//tạo phần tử đầu mảng rỗng
// array_unshift($array_department, array("id" => "", "name" => "Chọn bộ phận"));
array_unshift($array_position, array("id" => "", "name" => "Chọn chức vụ"));
array_unshift($array_job, array("id" => "", "name" => "Chọn bộ phận"));
array_unshift($array_factory, array("id" => "", "name" => "Chọn nhà máy"));
array_unshift($array_manufactory, array("id" => "", "name" => "Chọn xưởng"));
array_unshift($array_group, array("id" => "", "name" => "Chọn tổ"));

// BEGIN FORM TÌM KIẾM
$str_form_search_row = "";

$day = date("d-m-Y",strtotime($day));
$day_to = date("d-m-Y",strtotime($day_to)); 

$str_search_input_day_from = $this->Template->load_textbox(array("name" => "day_from","value"=>$day, "style" => "width:90px", "id" => "date_input"));
$str_search_input_day_to = $this->Template->load_textbox(array("name" => "day_to","value"=>$day_to, "style" => "width:90px", "id" => "date_input_to"));
//load selecbox chọn chức vụ
$str_selectbox_position = $this->Template->load_selectbox(array("name" => "id_position", "style" => "width:120px"), $array_position, $id_position);

//load selecbox chọn bộ phận
$str_selectbox_job = $this->Template->load_selectbox(array("name" => "id_job", "style" => "width:120px"), $array_job, $id_job);

//load selecbox chọn nhà máy
$str_selectbox_factory = $this->Template->load_selectbox(array("name" => "id_factory", "style" => "width:120px"), $array_factory, $id_factory);

//load selecbox chọn xưởng
$str_selectbox_manufactory = $this->Template->load_selectbox(array("name" => "id_manufactory", "style" => "width:120px"), $array_manufactory, $id_manufactory);

//load selecbox chọn tổ
$str_selectbox_group = $this->Template->load_selectbox(array("name" => "id_group", "style" => "width:120px"), $array_group, $id_group);

$str_search_input_user = $this->Template->load_textbox(array("name" => "name","value"=>$name, "style" => "width:120px", "placeholder" => "Nhập nhân viên"));

$str_search_button = $this->Template->load_button(array("value" => "Tìm kiếm", "type" => "submit"), "Tìm kiếm");

$str_search_input_row = "Từ ngày: $str_search_input_day_from Đến ngày: $str_search_input_day_to $str_selectbox_factory $str_selectbox_manufactory $str_selectbox_position $str_selectbox_job $str_selectbox_group $str_search_input_user $str_search_button </div>";

$str_form_search_user_salary = $this->Template->load_form(array("method" => "GET", "action" => "/attendance2/index","style"=>"width:1200px;"), $str_search_input_row);
echo $str_form_search_user_salary;

// END: FORM TÌM KIẾM
//tao mang array chua du lieu table

$array_table_chamcong_header = array(
	"num" => array("Stt", array("style" => "text-align:center")),
	"id_user" => array("Mã nhân viên", array("style" => "text-align:center")),
	"user_fullname" => array("Họ và tên", array("style" => "text-align:center")),
	"day" => array("Ngày", array("style" => "text-align:center")),
	"start_time" => array("Thời gian bắt đầu", array("style" => "text-align:center")),
	"end_time" => array("Thời gian kết thúc", array("style" => "text-align:center")),
	"hour" => array("Số giờ làm việc", array("style" => "text-align:center")),
	"edit" => array("Sửa", array("style" => "width:10%;text-align:center")),
	"delete" => array("Xóa", array("style" => "width:10%;text-align:center")),

);

//goi ham $this->Temlate->load_table_header de tao cap the <tr><td></td></tr>

$str_table_chamcong_header = $this->Template->load_table_header($array_table_chamcong_header);

//lay du lieu array_chamcong dua vao table
$sum_num_hour = 0;
$str_table_chamcong_row = "";
if ($array_chamcong != null) {
	$stt = 0;
	foreach ($array_chamcong as $chamcong) {
		$stt++;
		$array_table_chamcong_row = null;
		$date = date("d-m-Y", strtotime($chamcong["day"]));
		$num_hour = $chamcong["hour"];
		$sum_num_hour +=$num_hour; 

		$array_table_chamcong_row["num"] = array($stt, array("text-align:center"));
		$array_table_chamcong_row["id_user"] = array($chamcong["user_code"], array("text-align:center"));
		$array_table_chamcong_row["user_fullname"] = array($chamcong["user_fullname"], array("text-align:center"));
		$array_table_chamcong_row["day"] = array($date, array("text-align:center"));
		$array_table_chamcong_row["start_time"] = array($chamcong["start_time"], array("text-align:center"));
		$array_table_chamcong_row["end_time"] = array($chamcong["end_time"], array("text-align:center"));
		$array_table_chamcong_row["hour"] = array($chamcong["hour"], array("text-align:center"));
		//tạo linh sửa
		$str_link_edit = $this->Template->load_link("edit", "Sửa", "/attendance2/edit/" . $chamcong["id"].".html?day=$day&day_to=$day_to");
		$array_table_chamcong_row["edit"] = array($str_link_edit, array("text-align:center"));

		//tạo link xóa
		$str_link_delete = $this->Template->load_link("del", "Xóa", "/attendance2/del_chamcong/" . $chamcong["id"]);
		$array_table_chamcong_row["option"] = array($str_link_delete, array("text-align:center"));

		//su dung ham $this->Teamlate->load_table_row()
		//de tao cap the <tr><td></td></tr> tu mang

		$str_table_chamcong_row .= $this->Template->load_table_row($array_table_chamcong_row, array("align" => "center", "id" => "table_posts"));
		
	}//END: for
	
} else {
	echo "Không có dữ liệu";
}

/* gọi hàm $this->Template->load_table() tạo <table>nội dung là giá trị của biến str_table_chamcong_header</table>
và gán vào chuỗi str_table_chamcong
 */

$str_tong = "<tr><td colspan='6' style='text-align:right'><span style='margin-left:50px;'>Tổng</span></td><td>$sum_num_hour</td><td></td><td></td></tr>";
$str_table_chamcong = $this->Template->load_table($str_table_chamcong_header . $str_table_chamcong_row.$str_tong, array("align" => "left", "id" => "table_posts"));
echo $str_table_chamcong;
?>

<script type="text/javascript">
    $( function() {
        $( "#date_input" ).datepicker({dateFormat: "dd-mm-yy"});
		$( "#date_input_to" ).datepicker({dateFormat: "dd-mm-yy"});
    });
 </script>
