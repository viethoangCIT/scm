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
	$function_title = "Danh Mục Vị Trí Công Việc";
	echo $this->Template->load_function_header($function_title);
	
	//*****************************************
	//END FUNCTION HEADER
	//*****************************************
	
	
	//*****************************************
	//FUNCTION BODY
	//*****************************************
	// form nhập
	$str_form_job ="";
	$id="";
	$id = "";
	$name = "";
	$code = "";
	$type = "";
	$desc = "";
	
	if($array_job_detail)
	{
		$id=$array_job_detail[0]['id'];
		$name=$array_job_detail[0]['name'];
		$code=$array_job_detail[0]['code'];
		$type=$array_job_detail[0]['type'];
		$desc=$array_job_detail[0]['desc'];
		
	}
	
	
	
	$str_form_job .= $this->Template->load_hidden(array("name"=>"data[id]","id"=>"id","value"=>$id));
	$str_form_job .= $this->Template->load_hidden(array("name"=>"data[type]","value"=>0));
	$str_form_job .= $this->Template->load_form_row(array("title"=>"Tên vị trí công việc","input"=>$this->Template->load_textbox(array("name"=>"data[name]","id"=>"name","value"=>$name,"style"=>"width:300px"))));
	$str_form_job .= $this->Template->load_form_row(array("title"=>"Mã vị trí công việc","input"=>$this->Template->load_textbox(array("name"=>"data[code]","id"=>"code","value"=>$code,"style"=>"width:300px"))));
	$str_form_job .= $this->Template->load_form_row(array("title"=>"Mô tả","input"=>$this->Template->load_textarea(array("name"=>"data[desc]","id"=>"desc","style"=>"width:300px"),$desc)));
	$str_form_job .= $this->Template->load_form_row(array("title"=>"Thứ tự sắp xếp","input"=>$this->Template->load_textbox(array("name"=>"data[order_number]","id"=>"order_number","value"=>$name,"style"=>"width:300px"))));
	
	$button =  $this->Template->load_button(array("type"=>"button","onclick"=>"luu()"),"Lưu");
	$str_form_job .= $this->Template->load_form_row(array("title"=>"","input"=>$button.$str_hidden));
	
	$str_form_nhap = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"?debug=code"),$str_form_job);
	
	echo $str_form_nhap;
	
	
	
	
	
	//1: tao mang table header job	
	$array_header_job =  array("Stt"=>array("Stt",array("style"=>"text-align:left; width:3%")),
						"ten"=>array("Tên vị trí công việc",array("style"=>"text-align:left; width:15%")),
						"ma"=>array("Mã",array("style"=>"text-align:left; width:8%;white-space: nowrap")),						
						"mota"=>array("Mô tả",array("style"=>"text-align:left; width:8%")),
						"order"=>array("Thứ tự sắp xếp",array("style"=>"text-align:left; width:8%")),						
						"tuychon"=>array("Tuỳ Chọn",array("style"=>"text-align:left; width:7%")),
						
					);
					
	//2: lay html table header job(dong tren cung cua table)
	$str_header_job = $this->Template->load_table_header($array_header_job);

	//*****************************************************
	//3: lay du lieu quan huyen tu Controler dua qua de xu ly
	$stt = 1;
	$str_row_job = "";
	foreach($array_job as $job)
	{
		
		//tao 1 mang du lieu quan huyen
		$row_job = NULL;
			
		$row_job["stt"]			= array($stt++);
		$row_job["name"] 			= array($job["name"]);
		$row_job["code"] 			= array($job["code"]);			
		$row_job["desc"] 			= array($job["desc"]);
		$row_job["order_number"] 			= array($job["order_number"]);
		
		
		//lay link sua job
        $link_sua	= $this->Html->link(array("controller"=>"job","action"=>"index","params"=>array($job["id"]),"ext"=>"html"));		
        $link_sua	= $this->Template->load_link("edit","Sửa",$link_sua);
        
		
		//lay link xoa & tao the href & dua vao cell
        $link_xoa	= $this->Html->link(array("controller"=>"job","action"=>"del","params"=>array($job["id"],"index"),"ext"=>"html"));		
        $link_xoa	= $this->Template->load_link("del","Xóa",$link_xoa);
        $row_job["tuychon"] = array($link_sua." &nbsp;&nbsp;&nbsp;".$link_xoa ,array("style"=>"text-align:center;"));
		
		//tao 1 dong html dua vao mang row_job
		$str_row_job .= $this->Template->load_table_row($row_job);
	//ket thuc tao 1 dong du lieu
	}
	//4: lay html cua table
	$str_job =  $this->Template->load_table($str_header_job.$str_row_job);
	$str_job = "<div id='list_job'>$str_job</div>";

	//5: hien thi html ra man hinh	
	echo $this->Template->load_function_body($str_job);
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
		$.ajax({  method: "GET",  url: "<?php echo $this->webroot;?>job/index?"+str_value,
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
		$.ajax({  method: "GET",  url: "<?php echo $this->webroot;?>job/index?",
		  	data: { act: "list" }
		}).done(function( data ) {
			 document.getElementById("list_job").innerHTML = data;
		  });
	}
	
	xem();
	
	function xoa(id_job)
	{
		//request tới hàm del vs act = del, id = id_job
	   $.ajax({  method: "GET",  url: "<?php echo $this->webroot;?>job/index?",
		  	data: { act: "del",id : id_job }
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