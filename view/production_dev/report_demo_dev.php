<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#tabs" ).tabs();
  } );
</script>
<?php	
	//tạo tiêu đề hàm
	$function_title = "Báo Cáo Sản Xuất";
	echo $this->Template->load_function_header($function_title);
	
	$id_manufactory = "";
	if(isset($_GET["id_manufactory"]) && $_GET["id_manufactory"] != "") 
	{
		$id_manufactory =  $_GET["id_manufactory"];
		
	}
	$id_group = "";
	if(isset($_GET["id_group"]) && $_GET["id_group"] != "") 
	{
		$id_group =  $_GET["id_group"];
		
	}
	
	//Dùng hàm load_selectbox của đối tượng Template để selectbox
	$str_selectbox_manufactory = $this->Template->load_selectbox(array("name" => "id_manufactory", "id"=>"id_manufactory_search" ,"style" => "width:150px"), $array_manufactory);
	
	//Dùng hàm load_selectbox của đối tượng Template để selectbox
	$str_selectbox_group = $this->Template->load_selectbox(array("name" => "id_group", "id"=>"id_group_search" ,"style" => "width:150px"), $array_group);
	
	//Dùng hàm load_selectbox của đối tượng Template để selectbox
	$str_selectbox_shift = $this->Template->load_selectbox(array("name" => "id_shift", "id"=>"id_shift_search" ,"style" => "width:150px"), $array_shift);
	
	$array_report = array("user_production"=>"Nhân sự","productivity"=>"Năng suất","quality"=>"Chất lượng");
	$str_selectbox_report = $this->Template->load_selectbox_basic(array("name" => "report", "id"=>"report" ,"style" => "width:150px"), $array_report);
	
	$str_save_button = $this->Template->load_button(array("type" => "button", "onclick"=>"xem_baocao()"), "Xem");
	
	$str_input_row = "Chọn xưởng $str_selectbox_manufactory Chọn tổ $str_selectbox_group Chọn ca $str_selectbox_shift $str_selectbox_report $str_save_button";
	
	// LOAD FORM
	$str_form_production = $this->Template->load_form(array("method" => "GET", "id" => "form_seach", "action" => "/production/report"),$str_input_row);
	echo $str_form_production;
	

	//1: tao mang table header 	
	$array_header_production["col1"] = array("Báo cáo nhân sự",array("style"=>"text-align:center; width:3%"));
	$array_header_production["col2"] = array("Báo cáo năng suất",array("style"=>"text-align:center; width:3%"));
	$array_header_production["col3"] = array("Báo cáo chất lượng",array("style"=>"text-align:center; width:3%"));
	
	//2: lấy dòng tr header
	$str_header_production = $this->Template->load_table_header($array_header_production);

	

	//lấy dòng nội dung table
	$str_row_production = "";
	$link_nhansu = "/production/user_production/$id_manufactory/$id_group";
	$link_nangsuat = "/production/productivity.html";
	$link_chatluong = "/production/quality.html";
	
	$link_nhansu = $this->Template->load_link("edit", "Nhân sự", $link_nhansu);
	$link_nangsuat = $this->Template->load_link("edit", "Năng suất", $link_nangsuat);
	$link_chatluong = $this->Template->load_link("edit", "Chất lượng", $link_chatluong);
		
	$array_row_production["col1"] = array($link_nhansu,array("style"=>"text-align:center; width:3%"));
	$array_row_production["col2"] = array($link_nangsuat,array("style"=>"text-align:center; width:3%"));
	$array_row_production["col3"] = array($link_chatluong,array("style"=>"text-align:center; width:3%"));
	
	$str_row_production .= $this->Template->load_table_row($array_row_production);
	
	//Đưa nội dung str_product_cat vào thẻ table
	$str_table_production =  $this->Template->load_table($str_header_production . $str_row_production);
	

?>
<div id="tabs">
  <ul>
    <li><a href="#tabs-1" onclick="user()">Báo cáo nhân sự</a></li>
    <li><a href="#tabs-2" onclick="machine()">Báo cáo năng suất</a></li>
    <li><a href="#tabs-3" onclick="quality()">Báo cáo chất lượng</a></li>
  </ul>
</div>
<script>
	$( "#month_search" ).datepicker({dateFormat: 'mm-yy'});
	function user()
	{
		window.location = "/production/user_production";
	}
	function machine()
	{
	}
	function quality()
	{
	}
	function xem_baocao()
	{
		//lấy loại giá trị của báo cáo
		var loai_baocao = document.getElementById("report").value;	
		//alert(loai_baocao);
		
		//đổi thuộc tính acction của đối tượng form_search
		document.getElementById("form_seach").action = "/production/"+loai_baocao;
		//gọi ham submit của đối tượng form_seach
		document.getElementById("form_seach").submit();
	}
</script>
