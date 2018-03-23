<style type="text/css">


.tbl_r{


}
.table-responsive{
  width: 100% !important;
  height: 400px;
  overflow-y: scroll !important;
}

.parent{
  height: auto;
  position: absolute;
  width: 100%;
  left: 0;
  overflow-y:hidden;
}

#form_search
{
	margin-left:-110px;
}
.btn-table{
	float:none !important;	
}
</style>
<?php 																																							
	//*****************************************
	//FUNCTION HEADER
	//*****************************************

	$function_title = "Danh Sách Sản Phẩm";
	echo $this->Template->load_function_header($function_title);

		//*****************************************
		//END FUNCTION HEADER
		//*****************************************

	// $str_product = "";
	$str_selectbox_factory = $this->Template->load_selectbox(array("name"=>"id_factory","id"=>"factory","style"=>"width:200px"), $array_factory,$id_factory);
	$str_selectbox_manufactory = $this->Template->load_selectbox(array("name"=>"id_manufactory","id_manufactory"=>"","style"=>"width:200px"), $array_manufactory,$id_manufactory);
  	$str_selectbox_product_cat = $this->Template->load_selectbox(array("name"=>"id_product_cat","id"=>"id_product_cat","style"=>"width:200px"), $array_product_cat, $id_product_cat);
	$str_selectbox_name = $this->Template->load_selectbox(array("name"=>"name","id"=>"name","style"=>"width:200px"), $array_product_name, $id);
	$str_input_name = $this->Template->load_textbox(array("name"=>"product_name","id"=>"product_name","value"=>$product_name,"style"=>"width:200px","placeholder"=>"Nhập mã hoặc tên sản phẩm"));
	
	//$str_selectbox_code = $this->Template->load_selectbox(array("name"=>"code","id"=>"code", "style"=>"width:200px"), $array_product_code, $code);
	// mã sản phẩm
    
 	$str_btn_timkiem = "<input type='submit' class='timkiem' value='Tìm kiếm' style='font-size: 13.4px'>";
    $str_input_attendance_day ="<div id = 'search_bar'> $str_selectbox_factory $str_selectbox_manufactory $str_selectbox_product_cat $str_selectbox_name $str_input_name &nbsp;&nbsp; $str_btn_timkiem </br/> </div>";

    //tạo nút thêm
    $str_btn_add = $this->Template->load_button(array('type'=>'button','onclick'=>"window.location='/product2/add'"),'Thêm');
	$str_pull_right = "<div style='float:right'>".$str_btn_add."</div>";

	$array_form = array("method"=>"GET","action"=>"/product2/index","id"=>"form_search");
	$str_form_product = $this->Template->load_form($array_form, $str_input_attendance_day);


	echo $str_pull_right.$str_form_product;

		//1: tao mang table header 	
	$array_header_product["col1"] =  array("STT",array("style"=>"text-align:right; width:3%"));
	$array_header_product["col2"] =  array("Mã vạch",array("style"=>"text-align:center; width:5%"));
	$array_header_product["col3"] =  array("Mã sản phẩm",array("style"=>"text-align:center; width:5%"));
	$array_header_product["col4"] =  array("Tên sản phẩm",array("style"=>"text-align:center;width:10%"));
	$array_header_product["col5"] =  array("Khách hàng",array("style"=>"text-align:center; width:5%"));
	$array_header_product["col6"] =  array("Dòng sản phẩm",array("style"=>"text-align:center; width:5%"));
	$array_header_product["col7"] =  array("Nhà máy",array("style"=>"text-align:center; width:5%"));
	$array_header_product["col8"] =  array("Xưởng",array("style"=>"text-align:left; width:5%"));
	
	/*
	$array_header_product["col8"] =  array("Giá bán",array("style"=>"text-align:left; width:8%"));
	$array_header_product["col9"] =  array("Giá gia công",array("style"=>"text-align:left; width:8%"));
	$array_header_product["col10"] =  array("Thời gian tạo sản phẩm",array("style"=>"text-align:left; width:8%"));
	$array_header_product["col11"] =  array("Đơn vị Cycletime",array("style"=>"text-align:left; width:8%"));
	$array_header_product["col12"] =  array("Số người làm",array("style"=>"text-align:left; width:8%"));
	$array_header_product["col13"] =  array("Số lượng",array("style"=>"text-align:left; width:8%"));
	$array_header_product["col14"] =  array("Chi phí",array("style"=>"text-align:left; width:8%"));
	$array_header_product["col15"] =  array("Tổng chi phí",array("style"=>"text-align:left; width:8%"));
	*/
	$array_header_product["col9"] =  array("Chi tiết",array("style"=>"text-align:center; width:4%"));
	//$array_header_product["col10"] =  array("Định mức nguyên liệu",array("style"=>"text-align:center; width:9%"));
	//$array_header_product["col11"] =  array("Nhân sự sản xuất",array("style"=>"text-align:center; width:9%"));
	//$array_header_product["col12"] =  array("Máy sản xuất",array("style"=>"text-align:center; width:9%"));
	$array_header_product["col13"] =  array("Chức năng",array("style"=>"text-align:center; width:8%"));
	//$array_header_product["col14"] =  array("Danh mục khác",array("style"=>"text-align:center; width:8%"));

		//2: lấy dòng tr header
	$str_header_product = $this->Template->load_table_header($array_header_product);

		//lấy dòng nội dung table
	$str_row_product = "";
	$stt=0;
	if($array_product)
	{
		foreach ($array_product as $product ) {
			$stt++;
			$id_product = $product['id'];
			$id_cat = $product["id_cat"];
			$link_sua="/product2/add/$id_product.html?id_line=$id_cat";
			$link_xoa="/product2/del/$id_product.html";
			$link_chiphi="/product2/list_fee/$id_product.html";
			$link_dinhmuc="/product2/list_rate/$id_product.html";
			$link_nhansu="/product2/product_user/$id_product.html";
			$link_may="/product2/product_machine/$id_product.html";
			$link_info = "/product2/product_detail/$id_product.html";
			
			$link_sua  = $this->Template->load_link("edit","Sửa",$link_sua);
			$link_xoa  = $this->Template->load_link("del","Xóa",$link_xoa);
			$link_chiphi  = $this->Template->load_link("edit","Chi phí",$link_chiphi);
			$link_dinhmuc  = $this->Template->load_link("edit","Định mức",$link_dinhmuc);
			$link_nhansu  = $this->Template->load_link("edit","Nhân sự",$link_nhansu);
			$link_may  = $this->Template->load_link("edit","Máy",$link_may);
			$link_info = $this->Template->load_link("edit","Chi tiết",$link_info);
			$link_dinhmuc 	= $this->Html->link(array("controller"=>"product2","action"=>"product_rate","params"=>array($id_product)));
			// $link_action = $link_xoa . $link_sua;
			
			$array_product = NULL;
			//load dòng sản phẩm
			$array_product["col1"] =  array($stt,array("style"=>"text-align:right; width:3%"));
			$array_product["col2"] =  array($product["barcode"],array("style"=>"text-align:left;"));
			$array_product["col3"] =  array($product["code"],array("style"=>"text-align:left;"));
			$array_product["col4"] =  array($product["name"],array("style"=>"text-align:left;"));
			$array_product["col5"] =  array($product["customer"],array("style"=>"text-align:left;"));
			$array_product["col6"] =  array($product["cat_name"],array("style"=>"text-align:left;"));
			$array_product["col7"] =  array($product["factory"],array("style"=>"text-align:left;"));
			$array_product["col8"] =  array($product["manufactory"],array("style"=>"text-align:left;"));
			
			/*
			$array_product["col8"] =  array($product["price"],array("style"=>"text-align:left; width:8%"));
			$array_product["col9"] =  array($product["outsourcing"],array("style"=>"text-align:left; width:8%"));
			$array_product["col10"] =  array($product["time_created"],array("style"=>"text-align:left; width:8%"));
			$array_product["col11"] =  array($product["cycletime"],array("style"=>"text-align:left; width:8%"));
			$array_product["col12"] =  array($product["num"],array("style"=>"text-align:left; width:8%"));
			$array_product["col13"] =  array($product["amount"],array("style"=>"text-align:left; width:8%"));
			$array_product["col14"] =  array($product["str_fee_detail"],array("style"=>"text-align:left; width:8%"));
			$array_product["col15"] =  array($product["sum_fee"],array("style"=>"text-align:left; width:8%"));
			*/
			$array_product["col9"] =  array($link_info,array("style"=>"text-align:center;"));
			//$array_product["col10"] =  array($link_dinhmuc,array("style"=>"text-align:left; width:8%"));
			//$array_product["col19"] =  array($link_chiphi,array("style"=>"text-align:left; width:8%"));
			//$array_product["col11"] =  array($link_nhansu,array("style"=>"text-align:left; width:8%"));
			//$array_product["col12"] =  array($link_may,array("style"=>"text-align:left; width:8%"));
			$array_product["col13"] =  array($link_sua.$link_xoa,array("style"=>"text-align:center;"));
			//$array_product["col14"] =  array($link_xoa,array("style"=>"text-align:center; width:8%"));
			
			
			$str_row_product .= $this->Template->load_table_row($array_product);
	
		}
	}
		
	//Đưa nội dung str_product vào thẻ table
	$str_product =  $this->Template->load_table($str_header_product . $str_row_product);
					

?>
<div class="parent">

   <?php
	echo $str_product;

?>
 </div>
