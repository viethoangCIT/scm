<?php
//echo "Hello";
//print_r ($array_accountantitem);
$fuction_title = "Quản lý nguyên liệu";
echo $this->Template->load_function_header($fuction_title);
//End function header

$str_accountant_item_bt = $this->Template->load_button(array("type" => "submit", "style" => "height:30px; width:60px;"), "Tìm");
$str_input_accountant_item_search = "Tìm kiếm : " . $this->Template->load_textbox(array("name" => "search")) . $str_accountant_item_bt;

$str_btn_add_material = $this->Template->load_button(array('type' => 'button', 'onclick' => "window.location='/material/add_material'"), 'Thêm');
$str_pull_right = "<div style='float:right'>" . $str_btn_add_material . "</div>";

$array_form = array("method" => "GET", "action" => "/material/index_material");
$str_form_material = $this->Template->load_form($array_form, $str_input_accountant_item_search);

echo $str_pull_right . $str_form_material;

//function content

//1. đặt array table header của tài khoản kế toán. tiêu đề cột
$array_header_table = array(
	"id" => array("STT"),
	"name" => array("Tên nguyên liệu"),
	"code" => array("Mã nguyên liệu"),
	"bar_code" => array("Mã vạch nguyên liệu"),
	"unit" => array("Đơn vị tính"),
	"quota" => array("Giá mua"),
	"edit" => array("Sửa"),
	"del" => array("Xóa"),
);

//2. lấy html table header.
$str_table_header = $this->Template->load_table_header($array_header_table);
//3. lấy html nội dung của accountant
$str_table_content_listmaterial = "";
$i = 1;
foreach ($array_material as $material) {
	//3.1 nội dung accountant
	$link_edit = $this->Template->load_link('edit', 'Sửa', '/material/add_material?id=' . $material["id"]);
	$link_del = $this->Template->load_link('del', 'Xóa', '/material/del?id=' . $material["id"]);
	$array_row_listmaterial = array([$i++],
		"name" => array($material["name"]),
		"code" => array($material["code"]),
		"bar_code" => array($material["bar_code"]),
		"unit" => array($material["unit"]),
		"quota" => array($material["quota"]),
		"edit" => ([$link_edit]),
		"del" => ([$link_del]),
	);

	//3.2 lấy html cho row
	$str_table_content_listmaterial .= $this->Template->load_table_row($array_row_listmaterial);
}
//4. lất html cho table accountant
$str_table_content_listmaterial = $this->Template->load_table($str_table_header . $str_table_content_listmaterial, array('style' => 'width:100%'));
echo $str_table_content_listmaterial;

if (isset($_GET["msg"])) {
	$msg = $_GET["msg"];
}

//end content
?>
	<script>
		<?php
if ($msg == "edit") {
	?>
			alert("Đã sửa thành công");
			<?php
}
if ($msg == "del") {
	?>
		 	alert("Đã Xóa thành công");
		 	<?php
}
if ($msg == "add_material") {
	?>
			alert("Đã Thêm thành công");
			<?php
}
?>

	</script>
