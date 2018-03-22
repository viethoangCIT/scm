<style type="text/css">
	body {
		overflow-x: scroll !important;
	}
</style>
<?php
	
	$title_header = " Nhập kế hoạch sản xuất";
	echo $this->Template->load_function_header($title_header);

	//dùng hàm array_unshift để đưa dòng chữ chọn nhà máy vào đầu mảng
	array_unshift($array_factory,array("id" => "", "name" => "Chọn nhà máy"));

	//dùng hàm array_unshift để đưa dòng chữ chọn xưởng vào đầu mảng
	array_unshift($array_manufactory,array("id" => "", "name" => "Chọn xưởng"));

	//dùng hàm array_unshift để đưa dòng chữ chọn tổ vào đầu mảng
	array_unshift($array_group,array("id" => "", "name" => "Chọn tổ"));
	
	//dùng hàm array_unshift để đưa dòng chữ chọn ca vào đầu mảng
	array_unshift($array_shift,array("id" => "", "name" => "Chọn ca"));

	//dùng hàm array_unshift để đưa dòng chữ chọn máy vào đầu mảng
	array_unshift($array_machine,array("id" => "", "name" => "Chọn máy"));

	//tạo mảng $str_form_production có giá trị rỗng
	$str_form_production = "";
	
	//khởi tạo các biến có giá trị rỗng 
	$id = "";
	$id_factory = "";
	$id_manufactory = "";
	$id_group = "";
	$id_shift = "";
	$id_machine = "";
	$day = "";
	$day_finish = "";

	//kiểm tra mảng array_edit_production có khác NULL hay không 
	if($array_edit_production!=NULL)
	{
		//tạo các mảng có phần tử 0 và giá trị từng cột trong bảng để sửa
		$id = $array_edit_production[0]["id"];
		$id_factory = $array_edit_production[0]["id_factory"];
		$id_manufactory = $array_edit_production[0]["id_manufactory"];
		$id_group = $array_edit_production[0]["id_group"];
		$id_shift = $array_edit_production[0]["id_shift"];
		$id_machine = $array_edit_production[0]["id_machine"];
		$day = $array_edit_production[0]["day"];
		$day_finish = $array_edit_production[0]["day_finish"];
	}

	// dùng hàm load_hidden của đối tượng Template để tạo ô chứa id ẩn
	$str_hidden_id = $this->Template->load_hidden(array("name" => "production[id]", "value" => $id));

	//Dùng hàm load_selectbox của đối tượng Template để selectbox
	$str_selectbox_factory = $this->Template->load_selectbox(array("name" => "production[id_factory]" ,"style" => "width:100px"), $array_factory, $id_factory);

	//Dùng hàm load_selectbox của đối tượng Template để selectbox
	$str_selectbox_manufactory = $this->Template->load_selectbox(array("name" => "production[id_manufactory]" ,"style" => "width:100px"), $array_manufactory, $id_manufactory);

	//Dùng hàm load_selectbox của đối tượng Template để selectbox
	$str_selectbox_group = $this->Template->load_selectbox(array("name" => "production[id_group]" ,"style" => "width:100px"), $array_group, $id_group);

	//Dùng hàm load_selectbox của đối tượng Template để selectbox
	$str_selectbox_shift = $this->Template->load_selectbox(array("name" => "production[id_shift]","style" => "width:100px"), $array_shift, $id_shift);

	//Dùng hàm load_selectbox của đối tượng Template để selectbox
	$str_selectbox_machine = $this->Template->load_selectbox(array("name" => "production[id_machine]" ,"style" => "width:100px"), $array_machine, $id_machine);

	//Dùng hàm load_textbox của đối tượng Template để tạo textbox
	$str_input_day = $this->Template->load_textbox(array("name" => "production[day]", "autocomplete" => "off", "value"=>$day,"id" => "day"));

	//Dùng hàm load_textbox của đối tượng Template để tạo textbox
	$str_input_day_finish = $this->Template->load_textbox(array("name" => "production[day_finish]", "autocomplete" => "off", "value"=>$day_finish,"id" => "day_finish"));

	//Tạo biến str_input_row có giá trị chuỗi là chứa các id ẩn, selectbox và textbox
	$str_input_row = "$str_hidden_id $str_selectbox_factory $str_selectbox_manufactory $str_selectbox_group $str_selectbox_shift $str_selectbox_machine Từ ngày: $str_input_day Đến ngày: $str_input_day_finish</div>";


	//BEGIN: HEADER
	//TẠO MẢNG HEADER
	$array_header_production = NULL;		
	$array_header_production["col1"] = array("STT", array("align"=>"center","style"=>"width: 20px"));
	$array_header_production["col2"] = array("Tên sản phẩm" , array("align"=>"center", "style"=>"width: 50px"));
	$array_header_production["col3"] = array("Mã sản phẩm" , array("align"=>"center", "style"=>"width: 50px"));
	$array_header_production["col4"] = array("Số lượng gá" , array("align"=>"center", "style"=>"width: 50px"));
	$array_header_production["col5"] = array("Số người / gá" , array("align"=>"center", "style"=>"width: 50px"));
	$array_header_production["col6"] = array("Số lượng yêu cầu" , array("align"=>"center", "style"=>"width: 50px"));
	$array_header_production["col7"] = array("Năng xuất yêu cầu" , array("align"=>"center", "style"=>"width: 50px"));
	$array_header_production["col8"] = array("T.G bắt đầu" , array("align"=>"center", "style"=>"width: 100px"));
	$array_header_production["col9"] = array("T.G kết thúc" , array("align"=>"center", "style"=>"width: 100px"));
	$array_header_production["col10"] = array("Thời gian thực tế" , array("align"=>"center", "style"=>"width: 100px"));
	$array_header_production["col11"] = array("Leader" , array("align"=>"center", "style"=>"width: 100px"));
	$array_header_production["col12"] = array("Số người kiểm cuối chuyền" , array("align"=>"center", "style"=>"width: 50px"));
	$array_header_production["col13"] = array("Số lượng gá kiểm" , array("align"=>"center", "style"=>"width: 50px"));
	$array_header_production["col14"] = array("Năng xuất yêu cầu" , array("align"=>"center", "style"=>"width: 50px"));
	$array_header_production["col15"] = array("Kế hoạch" , array("align"=>"center", "style"=>"width: 50px"));
	$array_header_production["col16"] = array("T.G bắt đầu" , array("align"=>"center", "style"=>"width: 100px"));
	$array_header_production["col17"] = array("T.G kết thúc" , array("align"=>"center", "style"=>"width: 100px"));

	//LOAD HEADER
	$str_header_production = $this->Template->load_table_header($array_header_production);
	//END: HEADER

	//tạo mảng str_production_row có giá trị rỗng
	$str_production_row = "";

	//tạo các biến có giá trị rỗng
	$id = "";
	$soluong = "";
	$songuoi = "";
	$soluongyeucau = "";
	$nangxuatyeucau1 = "";
	$tgbatdau1 = "";
	$tgketthuc1 = "";
	$tgthucte = "";
	$leader = "";
	$nguoikiemcuoi = "";
	$soluonggakiem = "";
	$nangxuatyeucau2 = "";
	$kehoach ="";
	$tgbatdau2 = "";
	$tgketthuc2 = "";

	//kiểm tra mảng array_edit_production có khác NULL hay không
	if($array_edit_production!=NULL)
	{
		$index = 0;
		
		$id = $array_edit_production[0]["id"];
		$soluong = $array_edit_production[0]["soluong"];
		$songuoi = $array_edit_production[0]["songuoi"];
		$soluongyeucau = $array_edit_production[0]["soluongyeucau"];
		$nangxuatyeucau1 = $array_edit_production[0]["nangxuatyeucau1"];
		$tgbatdau1 = $array_edit_production[0]["tgbatdau1"];
		$tgketthuc1 = $array_edit_production[0]["tgketthuc1"];
		$tgthucte = $array_edit_production[0]["tgthucte"];
		$leader = $array_edit_production[0]["leader"];
		$nguoikiemcuoi = $array_edit_production[0]["nguoikiemcuoi"];
		$soluonggakiem = $array_edit_production[0]["soluonggakiem"];
		$nangxuatyeucau2 = $array_edit_production[0]["nangxuatyeucau2"];
		$kehoach = $array_edit_production[0]["kehoach"];
		$tgbatdau2 = $array_edit_production[0]["tgbatdau2"];
		$tgketthuc2 = $array_edit_production[0]["tgketthuc2"];

		$product =  $array_edit_production[0];


		// BEGIN: LẤY THÔNG TIN TỪ MẢNG: array_edit_production
		$id_product = $product["id"];
		$product_name = $product["product_name"];
		$product_code = $product["product_code"];
	
		//Dùng hàm load_hidden để chứa id_product
		$str_hidden_id_product = $this->Template->load_hidden(array("name" => "data[$index][id_product]", "value" => $id_product));

		//Dùng hàm load_hidden tạo ô input ẩn chứa id ẩn
		$str_hidden_id = $this->Template->load_hidden(array("name" => "data[$index][id]", "value" => $id));

		// Tạo input cho phần nhập
		$str_input_soluong = $this->Template->load_textbox(array("name"=>"data[$index][soluong]","value"=>$soluong,"style"=>"width: 100%"));
		$str_input_songuoi = $this->Template->load_textbox(array("name"=>"data[$index][songuoi]","value"=>$songuoi,"style"=>"width: 100%"));
		$str_input_soluongyeucau = $this->Template->load_textbox(array("name"=>"data[$index][soluongyeucau]", "value"=>$soluongyeucau,"style"=>"width: 100%"));
		$str_input_nangxuatyeucau1 = $this->Template->load_textbox(array("name"=>"data[$index][nangxuatyeucau1]", "value"=>$nangxuatyeucau1,"style"=> "width: 100%"));
		$str_input_tgbatdau1 = $this->Template->load_textbox(array("name"=>"data[$index][tgbatdau1]","value"=>$tgbatdau1,"style"=>"width: 100%"));
		$str_input_tgketthuc1 = $this->Template->load_textbox(array("name"=>"data[$index][tgketthuc1]","value"=>$tgketthuc1,"style"=>"width: 100%"));
		$str_input_tgthucte = $this->Template->load_textbox(array("name"=>"data[$index][tgthucte]","value"=>$tgthucte,"style"=>"width: 100%"));
		$str_input_leader = $this->Template->load_textbox(array("name"=>"data[$index][leader]","value"=>$leader,"style"=>"width: 100%"));
		$str_input_nguoikiemcuoi = $this->Template->load_textbox(array("name"=>"data[$index][nguoikiemcuoi]", "value"=>$nguoikiemcuoi,"style"=>"width: 100%"));
		$str_input_soluonggakiem = $this->Template->load_textbox(array("name"=>"data[$index][soluonggakiem]","value"=>$soluonggakiem,"style"=>"width: 100%"));
		$str_input_nangxuatyeucau2 = $this->Template->load_textbox(array("name"=>"data[$index][nangxuatyeucau2]", "value"=>$nangxuatyeucau2,"style"=>"width: 100%"));
		$str_input_kehoach = $this->Template->load_textbox(array("name"=>"data[$index][kehoach]", "style"=>"width: 100%"));
		$str_input_tgbatdau2 = $this->Template->load_textbox(array("name"=>"data[$index][tgbatdau2]","value"=>$tgbatdau2,"style"=>"width: 100%"));
		$str_input_tgketthuc2 = $this->Template->load_textbox(array("name"=>"data[$index][tgketthuc2]","value"=>$tgketthuc2,"style"=>"width: 100%"));

		$str_hidden = $str_hidden_id . $str_hidden_id_product;
		//$str_hidden .= $str_hidden_id;
	// Kết thúc phần tạo input

		//BEGIN:TẠO MẢNG CHỨA CÁC DÒNG MẢNG
		$array_row_production = NULL;
		$array_row_production["col1"] = array($id, array("style" => "text-align:center"));
		$array_row_production["col2"] = array($product_name . $str_hidden, array("style" => "text-align:center"));
		$array_row_production["col3"] = array($product_code, array("style" => "text-align:center"));
		$array_row_production["col4"] = array($str_input_soluong,array("style" => "text-align:center"));
		$array_row_production["col5"] = array($str_input_songuoi,array("style" => "text-align:center"));
		$array_row_production["col6"] = array($str_input_soluongyeucau,array("style" => "text-align:center"));
		$array_row_production["col7"] = array($str_input_nangxuatyeucau1,array("style" => "text-align:center"));
		$array_row_production["col8"] = array($str_input_tgbatdau1,array("style" => "text-align:center"));
		$array_row_production["col9"] = array($str_input_tgketthuc1,array("style" => "text-align:center"));
		$array_row_production["col10"] = array($str_input_tgthucte,array("style" => "text-align:center"));
		$array_row_production["col11"] = array($str_input_leader,array("style" => "text-align:center"));
		$array_row_production["col12"] = array($str_input_nguoikiemcuoi,array("style" => "text-align:center"));
		$array_row_production["col13"] = array($str_input_soluonggakiem,array("style" => "text-align:center"));
		$array_row_production["col14"] = array($str_input_nangxuatyeucau2,array("style" => "text-align:center"));
		$array_row_production["col15"] = array($str_input_kehoach,array("style" => "text-align:center"));
		$array_row_production["col16"] = array($str_input_tgbatdau2,array("style" => "text-align:center"));
		$array_row_production["col17"] = array($str_input_tgbatdau2,array("style" => "text-align:center"));
		// END: TẠO MẢNG CHỨA CÁC DÒNG CỦA BẢNG

		//dùng hàm load_table_row để tạo các có có giá trị theo từng cột tiêu đề
		$str_production_row .= $this->Template->load_table_row($array_row_production);
	}

	else
	{


		//kiểm tra mảng $array_product có tồn tại hay không
		if($array_product!=NULL)
		{
			$stt = 0;
			$index = 0;
			foreach ($array_product as $product) 
			{
				$stt++;

				// BEGIN: LẤY THÔNG TIN TỪ MẢNG: 
				$id_product = $product["id"];
				$product_name = $product["name"];
				$product_code = $product["code"];
			
				//Dùng hàm load_hidden để tạo ô input ẩn có chứa id_product ẩn
				$str_hidden_id_product = $this->Template->load_hidden(array("name" => "data[$index][id_product]", "value" => $id_product));

				//Dùng hàm load_hidden để tạo ô input ẩn có chứa product_name
				$str_hidden_product_name = $this->Template->load_hidden(array("name" => "data[$index][product_name]", "value" => $product_name));

				//Dùng hàm load_hidden để tạo ô input ẩn có chứa product_code
				$str_hidden_product_code = $this->Template->load_hidden(array("name" => "data[$index][product_code]", "value" => $product_code));

			

				// Tạo input cho phần nhập
				$str_input_soluong = $this->Template->load_textbox(array("name"=>"data[$index][soluong]","value"=>$soluong,"style"=>"width: 100%"));
				$str_input_songuoi = $this->Template->load_textbox(array("name"=>"data[$index][songuoi]","value"=>$songuoi,"style"=>"width: 100%"));
				$str_input_soluongyeucau = $this->Template->load_textbox(array("name"=>"data[$index][soluongyeucau]", "value"=>$soluongyeucau,"style"=>"width: 100%"));
				$str_input_nangxuatyeucau1 = $this->Template->load_textbox(array("name"=>"data[$index][nangxuatyeucau1]", "value"=>$nangxuatyeucau1,"style"=> "width: 100%"));
				$str_input_tgbatdau1 = $this->Template->load_textbox(array("name"=>"data[$index][tgbatdau1]","value"=>$tgbatdau1,"style"=>"width: 100%"));
				$str_input_tgketthuc1 = $this->Template->load_textbox(array("name"=>"data[$index][tgketthuc1]","value"=>$tgketthuc1,"style"=>"width: 100%"));
				$str_input_tgthucte = $this->Template->load_textbox(array("name"=>"data[$index][tgthucte]","value"=>$tgthucte,"style"=>"width: 100%"));
				$str_input_leader = $this->Template->load_textbox(array("name"=>"data[$index][leader]","value"=>$leader,"style"=>"width: 100%"));
				$str_input_nguoikiemcuoi = $this->Template->load_textbox(array("name"=>"data[$index][nguoikiemcuoi]", "value"=>$nguoikiemcuoi,"style"=>"width: 100%"));
				$str_input_soluonggakiem = $this->Template->load_textbox(array("name"=>"data[$index][soluonggakiem]","value"=>$soluonggakiem,"style"=>"width: 100%"));
				$str_input_nangxuatyeucau2 = $this->Template->load_textbox(array("name"=>"data[$index][nangxuatyeucau2]", "value"=>$nangxuatyeucau2,"style"=>"width: 100%"));
				$str_input_kehoach = $this->Template->load_textbox(array("name"=>"data[$index][kehoach]", "style"=>"width: 100%"));
				$str_input_tgbatdau2 = $this->Template->load_textbox(array("name"=>"data[$index][tgbatdau2]","value"=>$tgbatdau2,"style"=>"width: 100%"));
				$str_input_tgketthuc2 = $this->Template->load_textbox(array("name"=>"data[$index][tgketthuc2]","value"=>$tgketthuc2,"style"=>"width: 100%"));

				$str_hidden = $str_hidden_id_product . $str_hidden_product_name . $str_hidden_product_code;
				// $str_hidden .= $str_hidden_id_factory . $str_hidden_id_manufactory . $str_hidden_id_group . $str_hidden_id_shift . $str_hidden_id_machine;
			// Kết thúc phần tạo input

				//BEGIN:TẠO MẢNG CHỨA CÁC DÒNG MẢNG
				$array_row_production = NULL;
				$array_row_production["col1"] = array($stt, array("style" => "text-align:center"));
				$array_row_production["col2"] = array($product_name . $str_hidden, array("style" => "text-align:center"));
				$array_row_production["col3"] = array($product_code, array("style" => "text-align:center"));
				$array_row_production["col4"] = array($str_input_soluong,array("style" => "text-align:center"));
				$array_row_production["col5"] = array($str_input_songuoi,array("style" => "text-align:center"));
				$array_row_production["col6"] = array($str_input_soluongyeucau,array("style" => "text-align:center"));
				$array_row_production["col7"] = array($str_input_nangxuatyeucau1,array("style" => "text-align:center"));
				$array_row_production["col8"] = array($str_input_tgbatdau1,array("style" => "text-align:center"));
				$array_row_production["col9"] = array($str_input_tgketthuc1,array("style" => "text-align:center"));
				$array_row_production["col10"] = array($str_input_tgthucte,array("style" => "text-align:center"));
				$array_row_production["col11"] = array($str_input_leader,array("style" => "text-align:center"));
				$array_row_production["col12"] = array($str_input_nguoikiemcuoi,array("style" => "text-align:center"));
				$array_row_production["col13"] = array($str_input_soluonggakiem,array("style" => "text-align:center"));
				$array_row_production["col14"] = array($str_input_nangxuatyeucau2,array("style" => "text-align:center"));
				$array_row_production["col15"] = array($str_input_kehoach,array("style" => "text-align:center"));
				$array_row_production["col16"] = array($str_input_tgbatdau2,array("style" => "text-align:center"));
				$array_row_production["col17"] = array($str_input_tgbatdau2,array("style" => "text-align:center"));
				// END: TẠO MẢNG CHỨA CÁC DÒNG CỦA BẢNG

				$str_production_row .= $this->Template->load_table_row($array_row_production);

				$index++;
			}//foreach ($array_production as $production)
		}//if($array_production!=NULL)
	}

	//LOAD TABLE
	$str_table_production = $this->Template->load_table($str_header_production . $str_production_row);

	//tạo nút lưu
	$str_save_button = $this->Template->load_button(array("type" => "sutmit", "onclick" => "luu()"), "Lưu");

	// LOAD FORM
	$str_form_production = $this->Template->load_form(array("method" => "POST", "id" => "form_nhap", "action" => "/production/add_plan"),$str_input_row . $str_table_production . $str_save_button);
	echo $str_form_production;
?>

<script>
	$( "#day" ).datepicker({dateFormat: 'dd-mm-yy'});
	$( "#day_finish" ).datepicker({dateFormat: 'dd-mm-yy'});
</script>