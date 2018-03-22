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
	$function_title = "Danh Mục Nhà Máy";
	echo $this->Template->load_function_header($function_title);
	
	//*****************************************
	//END FUNCTION HEADER
	//*****************************************
	
	
	//*****************************************
	//FUNCTION BODY
	//*****************************************
	// form nhập
	$str_form_factory ="";
	$id="";
	$array_type=array("0"=>"Thành Phố");
	$id = "";
	$name = "";
	$code = "";
	$type = "";
	$desc = "";
	
	if($array_factory_detail)
	{
		$id=$array_factory_detail[0]['id'];
		$name=$array_factory_detail[0]['name'];
		$code=$array_factory_detail[0]['code'];
		$type=$array_factory_detail[0]['type'];
		$desc=$array_factory_detail[0]['desc'];
		
	}
	
	
	
	$str_form_factory .= $this->Template->load_hidden(array("name"=>"data[id]","id"=>"id","value"=>$id));
	$str_form_factory .= $this->Template->load_hidden(array("name"=>"data[type]","value"=>0));
	$str_form_factory .= $this->Template->load_form_row(array("title"=>"Tên nhà máy","input"=>$this->Template->load_textbox(array("name"=>"data[name]","id"=>"name","value"=>$name,"style"=>"width:300px"))));
	$str_form_factory .= $this->Template->load_form_row(array("title"=>"Mã nhà máy","input"=>$this->Template->load_textbox(array("name"=>"data[code]","id"=>"code","value"=>$code,"style"=>"width:300px"))));
	$str_form_factory .= $this->Template->load_form_row(array("title"=>"Mô tả","input"=>$this->Template->load_textarea(array("name"=>"data[desc]","id"=>"desc","style"=>"width:300px"),$desc)));
	$str_form_factory .= $this->Template->load_form_row(array("title"=>"Thứ tự sắp xếp","input"=>$this->Template->load_textbox(array("name"=>"data[order_number]","id"=>"order_number","value"=>$name,"style"=>"width:300px"))));
	
	$button =  $this->Template->load_button(array("type"=>"button","onclick"=>"luu()"),"Lưu");
	$str_form_factory .= $this->Template->load_form_row(array("title"=>"","input"=>$button.$str_hidden));
	
	$str_form_nhap = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"?debug=code"),$str_form_factory);
	
	echo $str_form_nhap;
	
	
	
	
	
	//1: tao mang table header factory	
	$array_header_factory =  array("Stt"=>array("Stt",array("style"=>"text-align:left; width:3%")),
						"ten"=>array("Tên nhà máy",array("style"=>"text-align:left; width:15%")),
						"ma"=>array("Mã",array("style"=>"text-align:left; width:8%;white-space: nowrap")),						
						"mota"=>array("Mô tả",array("style"=>"text-align:left; width:8%")),
						"order"=>array("Thứ tự sắp xếp",array("style"=>"text-align:left; width:8%")),						
						"tuychon"=>array("Tuỳ Chọn",array("style"=>"text-align:left; width:7%")),
						
					);
					
	//2: lay html table header factory(dong tren cung cua table)
	$str_header_factory = $this->Template->load_table_header($array_header_factory);

	//*****************************************************
	//3: lay du lieu quan huyen tu Controler dua qua de xu ly
	$stt = 1;
	$str_row_factory = "";
	foreach($array_factory as $factory)
	{
		
		//tao 1 mang du lieu quan huyen
		$row_factory = NULL;
			
		$row_factory["stt"]			= array($stt++);
		$row_factory["name"] 			= array($factory["name"]);
		$row_factory["code"] 			= array($factory["code"]);			
		$row_factory["desc"] 			= array($factory["desc"]);
		$row_factory["order_number"] 			= array($factory["order_number"]);
		
		
		//lay link sua factory
        $link_sua	= $this->Html->link(array("controller"=>"factory","action"=>"index","params"=>array($factory["id"]),"ext"=>"html"));		
        $link_sua	= $this->Template->load_link("edit","Sửa",$link_sua);
        
		
		//lay link xoa & tao the href & dua vao cell
        $link_xoa	= $this->Html->link(array("controller"=>"factory","action"=>"del","params"=>array($factory["id"],"index"),"ext"=>"html"));		
        $link_xoa	= $this->Template->load_link("del","Xóa",$link_xoa);
        $row_factory["tuychon"] = array($link_sua." &nbsp;&nbsp;&nbsp;".$link_xoa ,array("style"=>"text-align:center;"));
		
		//tao 1 dong html dua vao mang row_factory
		$str_row_factory .= $this->Template->load_table_row($row_factory);
	//ket thuc tao 1 dong du lieu
	}
	//4: lay html cua table
	$str_factory =  $this->Template->load_table($str_header_factory.$str_row_factory);
	$str_factory = "<div id='list_factory'>$str_factory</div>";

	//5: hien thi html ra man hinh	
	echo $this->Template->load_function_body($str_factory);
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
		$.ajax({  method: "GET",  url: "<?php echo $this->webroot;?>factory/index?"+str_value,
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
		$.ajax({  method: "GET",  url: "<?php echo $this->webroot;?>factory/index?",
		  	data: { act: "list" }
		}).done(function( data ) {
			 document.getElementById("list_factory").innerHTML = data;
		  });
	}
	
	xem();
	
	function xoa(id_factory)
	{
		//request tới hàm del vs act = del, id = id_factory
	   $.ajax({  method: "GET",  url: "<?php echo $this->webroot;?>factory/index?",
		  	data: { act: "del",id : id_factory }
		}).done(function( data ) {
			 xem();
			 alert("Đã xóa thành công");
		  });
	}
	function xem_form(name,code,desc,order_number,id)
	{
		
		$("#name").val(name);
		$("#code").val(code);
		$("#desc").val(desc);
		$("#order_number").val(order_number);
		$("#id").val(id);
	}
</script>