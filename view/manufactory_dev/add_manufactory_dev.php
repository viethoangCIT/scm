<style type="text/css">
	.title_page{
		color: black!important;
		text-shadow:none;
	}
</style>
<?php 																																																																																														
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tieu de cua ham
	$function_title = "Danh Mục Phân Xưởng";
	echo $this->Template->load_function_header($function_title);
	
	//*****************************************
	//END FUNCTION HEADER
	//*****************************************
	
	
	//*****************************************
	//FUNCTION BODY
	//*****************************************
	// form nhập
	$str_form_manufactory ="";
	$id="";
	$name = "";
	$code = "";
	$type = "";
	$desc = "";
	$id_factory="";
	
	/*
	if($array_manufactory_detail)
	{
		$id=$array_manufactory_detail[0]['id'];
		$name=$array_manufactory_detail[0]['name'];
		$code=$array_manufactory_detail[0]['code'];
		$type=$array_manufactory_detail[0]['type'];
		$desc=$array_manufactory_detail[0]['desc'];
		
	}
	*/
	
	$str_hidden_id = $this->Template->load_hidden(array("name"=>"data[id]","id"=>"id","value"=>$id));
	$str_select_factory = $this->Template->load_selectbox(array("name"=>"data[id_factory]","autocomplete"=>"off","id"=>"id_factory","style"=>"width:200px"),$array_factory);
	$str_input_name = $this->Template->load_textbox(array("name"=>"data[name]","id"=>"name","value"=>$name,"style"=>"width:300px"));
	$str_input_code = $this->Template->load_textbox(array("name"=>"data[code]","id"=>"code","value"=>$code,"style"=>"width:300px"));
	$str_input_desc = $this->Template->load_textbox(array("name"=>"data[desc]","id"=>"desc","value"=>$desc,"style"=>"width:300px"));
	$str_save_button =  $this->Template->load_button(array("type"=>"button","onclick"=>"luu()"),"Lưu");
	
	$str_form_manufactory .= $this->Template->load_form_row(array("title"=>"Chọn nhà máy","input"=>$str_select_factory));
	$str_form_manufactory .= $this->Template->load_form_row(array("title"=>"Tên phân xưởng","input"=>$str_input_name));
	$str_form_manufactory .= $this->Template->load_form_row(array("title"=>"Mã phân xưởng","input"=>$str_input_code));
	$str_form_manufactory .= $this->Template->load_form_row(array("title"=>"Mô tả","input"=>$str_input_desc));
	
	
	$str_form_manufactory .= $this->Template->load_form_row(array("title"=>"","input"=>$str_save_button.$str_hidden_id));
	
	$str_form_nhap = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"?debug=code"),$str_form_manufactory);
	
	echo $str_form_nhap;
	
	
	
	
	
	//1: tao mang table header manufactory	
	$array_header_manufactory =  array("Stt"=>array("Stt",array("style"=>"text-align:left; width:3%")),
						"ten"=>array("Tên nhà máy",array("style"=>"text-align:left; width:10%")),
						"ma"=>array("Mã",array("style"=>"text-align:left; width:8%;")),
						"factory"=>array("Nhà máy",array("style"=>"text-align:left; width:8%;")),						
						"mota"=>array("Mô tả",array("style"=>"text-align:left; width:8%")),
						"order"=>array("Thứ tự sắp xếp",array("style"=>"text-align:left; width:8%")),						
						"tuychon"=>array("Tuỳ Chọn",array("style"=>"text-align:left; width:7%")),
						
					);
					
	//2: lay html table header manufactory(dong tren cung cua table)
	$str_header_manufactory = $this->Template->load_table_header($array_header_manufactory);

	//*****************************************************
	//3: lay du lieu quan huyen tu Controler dua qua de xu ly
	$stt = 1;
	$str_row_manufactory = "";
if($array_manufactory)
{
	foreach($array_manufactory as $manufactory)
	{
		
		//tao 1 mang du lieu quan huyen
		$row_manufactory = NULL;
			
		$row_manufactory["stt"]	= array($stt++);
		$row_manufactory["name"] = array($manufactory["name"]);
		$row_manufactory["code"] = array($manufactory["code"]);	
		$row_manufactory["factory"] = array($manufactory["factory"]);			
		$row_manufactory["desc"] = array($manufactory["desc"]);
		$row_manufactory["order_number"] = array($manufactory["order_number"]);
		
		//lay link sua manufactory
        $link_sua	= $this->Html->link(array("controller"=>"manufactory","action"=>"index","params"=>array($manufactory["id"]),"ext"=>"html"));		
        $link_sua	= $this->Template->load_link("edit","Sửa",$link_sua);
        
		
		//lay link xoa & tao the href & dua vao cell
        $link_xoa	= $this->Html->link(array("controller"=>"manufactory","action"=>"del","params"=>array($manufactory["id"],"index"),"ext"=>"html"));		
        $link_xoa	= $this->Template->load_link("del","Xóa",$link_xoa);
        $row_manufactory["tuychon"] = array($link_sua." &nbsp;&nbsp;&nbsp;".$link_xoa ,array("style"=>"text-align:center;"));
		
		//tao 1 dong html dua vao mang row_manufactory
		$str_row_manufactory .= $this->Template->load_table_row($row_manufactory);
	//ket thuc tao 1 dong du lieu
	}//END: FOR
}//END: IF
	//4: lay html cua table
	$str_manufactory =  $this->Template->load_table($str_header_manufactory.$str_row_manufactory);
	//echo $str_manufactory;
	$str_manufactory = "<div id='list_manufactory'>$str_manufactory</div>";

	//5: hien thi html ra man hinh	
	echo $this->Template->load_function_body($str_manufactory);
	//*****************************************
	//END FUNCTION BODY
	//*****************************************					
	
?>
<script>
	function luu()
	{
		//lấy tất cả giá trị của của form vào chuỗi
		str_value = $("#form_nhap").serialize();
		
		//alert(str_value);
		//request tới hàm index vs act bằng save
		$.ajax({  method: "GET",  url: "<?php echo $this->webroot;?>manufactory/index?"+str_value,
		  	data: { act: "save",debug:"code" }
		}).done(function( data ) {
			 //alert(data);
			 xem();
			 alert("Lưu thành công");
			 
		    $("#form_nhap").find("input[type=text], textarea").val("");

		  });
	}
	function xem()
	{
		//alert("xem");
		//request tới hàm index vs act =  view
		$.ajax({  method: "GET",  url: "<?php echo $this->webroot;?>manufactory/index?",
		  	data: { act: "list" }
		}).done(function( data ) {
			 document.getElementById("list_manufactory").innerHTML = data;
		  });
	}
	
	xem();
	
	function xoa(id_manufactory)
	{
		//request tới hàm del vs act = del, id = id_manufactory
	   $.ajax({  method: "GET",  url: "<?php echo $this->webroot;?>manufactory/index?",
		  	data: { act: "del",id : id_manufactory }
		}).done(function( data ) {
			 xem();
			 alert("Đã xóa thành công");
		  });
	}
	function xem_form(name,code,desc,order_number,id,id_factory)
	{
		
		$("#name").val(name);
		$("#code").val(code);
		$("#desc").val(desc);
		$("#id_factory").val(id_factory);
		$("#order_number").val(order_number);
		$("#id").val(id);
	}
</script>