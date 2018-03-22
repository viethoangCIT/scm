<?php 																			
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
		//tạo tiêu đề hàm
		$function_title = "Nhập sản phẩm ".$id_edit_product;
		echo $this->Template->load_function_header($function_title);

		$str_form_product = "";
		//tạo textbox nhập tên tài sản

		$code = "";
		$name = "";
		$barcode = "";
		$id_customer = "";
		$id_line ="";
		$shop = "";
		$price = "";
		$outsourcing = "";
		$cycletime = "";
		$num = "";
		$amount = "";
		$id = "";
		$id_factory = "";
		$id_manufactory = "";
		if($array_edit_product != null)
		{
			$code = $array_edit_product["0"]["code"];
			$name = $array_edit_product["0"]["name"];
			$barcode = $array_edit_product["0"]["barcode"];
			$id_customer = $array_edit_product["0"]["id_customer"];
			$id_line = $array_edit_product["0"]["id_cat"];
			$shop = $array_edit_product["0"]["shop"];
			$price = $array_edit_product["0"]["price"];
			$outsourcing = $array_edit_product["0"]["outsourcing"];
			$cycletime = $array_edit_product["0"]["cycletime"];
			$num = $array_edit_product["0"]["num"];
			$amount = $array_edit_product["0"]["amount"];
			$id = $array_edit_product["0"]["id"];
			$id_factory = $array_edit_product[0]["id_factory"];
			$id_manufactory = $array_edit_product[0]["id_manufactory"];
		}
		
		if(isset($_GET["id_line"]) && $_GET["id_line"] != "") $id_line = $_GET["id_line"];
		if(isset($_GET["id_factory"]) && $_GET["id_factory"] != "") $id_factory = $_GET["id_factory"];
		if(isset($_GET["id_manufactory"]) && $_GET["id_manufactory"] != "") $id_manufactory = $_GET["id_manufactory"];

		//BEGIN: Tạo input chọn nhập
		$str_input_product_id = $this->Template->load_hidden(array("name"=>"data[id]","id"=>"id_product","value"=>"$id","style"=>"width:300px"));
		$str_input_product_line = $this->Template->load_selectbox(array("name"=>"id_line","style"=>"width:300px","id"=>"id_line", "onchange"=>"show()"),$array_line,$id_line);
		$str_input_factory = $this->Template->load_selectbox(array("name"=>"id_factory","style"=>"width:300px","id"=>"factory"),$array_factory,$id_factory);
		$str_input_manufactory = $this->Template->load_selectbox(array("name"=>"id_manufactory","style"=>"width:300px","id"=>"manufactory"),$array_manufactory,$id_manufactory);
		$str_input_product_customer = $this->Template->load_selectbox(array("name"=>"data[id_customer]","id"=>"customer","style"=>"width:300px"),$array_customer,$id_customer)."<span id='mate_customer1'></span>";
		$str_input_product_code = $this->Template->load_textbox(array("name"=>"data[code]","id"=>"code","value"=>"$code","style"=>"width:300px"))."<span id='mate_code1'></span>";
		$str_input_product_name = $this->Template->load_textbox(array("name"=>"data[name]","id"=>"name","value"=>"$name","style"=>"width:300px"))."<span id='mate_name1'></span>";
		$str_input_product_barcode = $this->Template->load_textbox(array("name"=>"data[barcode]","id"=>"barcode","value"=>"$code","style"=>"width:300px"))."<span id='mate_barcode1'></span>";
		$str_hidden_status = $this->Template->load_hidden(array("name"=>"data[status]","id"=>"status","value"=>"0","style"=>"width:300px"))."<span id='mate_price1'></span>";
		$str_save_button =  $this->Template->load_button(array("type"=>"button","onclick"=>"luu()"),"Lưu");
		//BEGIN: Tạo input chọn nhập
		
		
		//BEGIN: Tạo dòng nhập 
		$str_form_product .= $this->Template->load_form_row(array("title"=>"Nhà máy(<span style='color:red'>*</span>)","input"=>$str_input_factory));
		$str_form_product .= $this->Template->load_form_row(array("title"=>"Xưởng(<span style='color:red'>*</span>)","input"=>$str_input_manufactory));
		$str_form_product .= $this->Template->load_form_row(array("title"=>"Dòng sản phẩm(<span style='color:red'>*</span>)","input"=>$str_input_product_line));
		$str_form_product .= $this->Template->load_form_row(array("title"=>"Mã vạch(<span style='color:red'>*</span>)","input"=>$str_input_product_barcode.$str_input_product_id));
		$str_form_product .= $this->Template->load_form_row(array("title"=>"Mã sản phẩm(<span style='color:red'>*</span>)","input"=>$str_input_product_code.$str_input_product_id));
		$str_form_product .= $this->Template->load_form_row(array("title"=>"Tên sản phẩm(<span style='color:red'>*</span>)","input"=>$str_input_product_name));
		$str_form_product .= $this->Template->load_form_row(array("title"=>"Khách hàng(<span style='color:red'>*</span>)","input"=>$str_input_product_customer));
		//END: Tạo dòng nhập
		
		//BEGIN: LOAD thuộc tính của dòng sản phẩm khi chọn sản phẩm
		$str_table_tr = "";
		$stt = 0;
		if($array_product_cat_detail)
		{
			foreach($array_product_cat_detail as $detail)
			{
				
				$name = $detail["name"];
				$code = $detail["code"];
				
				$edit_detail = "";
				$str_hidden_id_detail="";
				if($id_edit_product !="")
				{
					$id = $detail["id"];
					$edit_detail = $detail["value"];
					
					$str_hidden_id_detail = $this->Template->load_hidden(array("name"=>"data_detail[$stt][id]","value"=>$id,"style"=>"width:300px"));
				}
				
				$str_input_product_detail = $this->Template->load_textbox(array("name"=>"data_detail[$code]","value"=>$edit_detail,"style"=>"width:300px"));
				$str_form_product .= $this->Template->load_form_row(array("title"=>"$name","input"=>$str_input_product_detail.$str_hidden_id_detail, "class"=>"detail"));
				$stt++;
			}
		}
		
		$str_form_product .= $this->Template->load_form_row(array("title"=>"","input"=>$str_save_button));
		//BEGIN: LOAD thuộc tính của dòng sản phẩm khi chọn sản phẩm 
		
		//LOAD FORM
		$str_form_product = $this->Template->load_form(array("method"=>"GET","id"=>"form_nhap","action"=>"/product2/add"),$str_form_product.$str_hidden_status);
		echo $str_form_product; 																											
?>

<script>
	function show()
	{
		document.getElementById("status").value = "0";
		document.getElementById("form_nhap").submit();
	}
	function luu()
	{
		var dong_sp = document.getElementById("id_line").value;
		var customer = document.getElementById("customer").value;
		var factory = document.getElementById("factory").value;
		var manufactory = document.getElementById("manufactory").value;
		var ma_sp = document.getElementById("code").value;
		var ten_sp = document.getElementById("name").value;
		
		if(factory =="") 
		{
			alert("Vui lòng chọn nhà máy");
			return;
		}
		if(manufactory =="") 
		{
			alert("Vui lòng chọn xưởng");
			return;
		}
		if(dong_sp =="") 
		{
			alert("Vui lòng chọn dòng sản phẩm");
			return;
		}
		if(ma_sp =="")
		{
			alert("Vui lòng nhập mã sản phẩm");
			document.getElementById("code").focus();
			return;
		}
		
		if(ten_sp =="")
		{
			alert("Vui lòng nhập tên sản phẩm");
			document.getElementById("name").focus();
			return;
		}
		
		if(customer =="") 
		{
			alert("Vui lòng chọn khách hàng");
			return;
		}
		else 
		{
			document.getElementById("status").value = "1";
			document.getElementById("form_nhap").submit();
		}
	}
</script>