<script type="text/javascript">
	function kiemtra()
	{
		var code = document.getElementById("code");
		var name = document.getElementById("name");
		if(code.value=="")
		{
			document.getElementById("mate_code1").innerHTML = "Xin nhập mã dòng sản phẩm!";
			document.getElementById("mate_code1").style.color = "red"; 
		}
		if(name.value=="")
		{
			document.getElementById("mate_name1").innerHTML = "Xin nhập tên dòng sản phẩm!";
			document.getElementById("mate_name1").style.color = "red"; 
			return;
		}
		document.getElementById("form_nhap").submit();
	}
</script>

<?php 																			
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tạo tiêu đề hàm
	$function_title = "Nhập dòng sản phẩm";
	echo $this->Template->load_function_header($function_title);

	$str_form_product_cat = "";
	//tạo textbox nhập tên tài sản
	$name = "";
	$code = "";
	$id = "";
	if($array_edit_product_cat != null)
	{
		$name = $array_edit_product_cat["0"]["name"];
		$code = $array_edit_product_cat["0"]["code"];
		$id = $array_edit_product_cat["0"]["id"];

	}



	//BEGIN: Tạo input hidden đựng giá trị id
	$str_input_product_cat_id = $this->Template->load_hidden(array("name"=>"data[id]","id"=>"id_product_cat","value"=>"$id","style"=>"width:300px"));
	//END: Tạo input hidden đựng giá trị id


	//BEGIN: 2.dòng tên sản phẩm
	//2.1 dùng hàm $this->Template->load_textbox để tạo textbox
	$str_input_product_cat_name = $this->Template->load_textbox(array("name"=>"data[name]","id"=>"name","value"=>"$name","style"=>"width:300px"))."<span id='mate_name1'></span>";

	//2.2. tạo dòng nhập tiêu đề có textbox tên sản phẩm
	$str_form_product_cat .= $this->Template->load_form_row(array("title"=>"Tên dòng sản phẩm ","input"=>$str_input_product_cat_name));
	//END: dòng tên sản phẩm

	//BEGIN: 1.dòng mã sản phẩm
	//1.1 dùng hàm $this->Template->load_textbox để tạo textbox
	$str_input_product_cat_code = $this->Template->load_textbox(array("name"=>"data[code]","id"=>"code","value"=>"$code","style"=>"width:300px"))."<span id='mate_code1'></span>";

	//1.2. tạo dòng nhập tiêu đề có textbox mã sản phẩm
	$str_form_product_cat .= $this->Template->load_form_row(array("title"=>"Mã dòng sản phẩm ","input"=>$str_input_product_cat_code.$str_input_product_cat_id));
	//END: dòng mã sản phẩm


		//tạo nút lưu	
	$str_save_button =  $this->Template->load_button(array("type"=>"button","onclick"=>"kiemtra()"),"Lưu");
	$str_form_product_cat .= $this->Template->load_form_row(array("title"=>"","input"=>$str_save_button));

		//đưa vào form
	$str_form_product_cat = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"
		/product_cat/add"),$str_form_product_cat);
	echo $str_form_product_cat; 																											
?>
