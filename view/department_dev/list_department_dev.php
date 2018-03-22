<?php 																																																																																														
//1: tao mang table header department	
	$array_header_department =  array("Stt"=>array("Stt",array("style"=>"text-align:left; width:3%")),
						"ten"=>array("Tên phòng ban",array("style"=>"text-align:left; width:15%")),
						"ma"=>array("Mã",array("style"=>"text-align:center; width:8%;white-space: nowrap")),						
						"mota"=>array("Mô tả",array("style"=>"text-align:left; width:8%")),
						"order_number"=>array("Thứ tự sắp xếp",array("style"=>"text-align:left; width:8%")),						
						"tuychon"=>array("Tuỳ Chọn",array("style"=>"text-align:left; width:7%")),
						
					);
					
	//2: lay html table header department(dong tren cung cua table)
	$str_header_department = $this->Template->load_table_header($array_header_department);

	//*****************************************************
	//3: lay du lieu quan huyen tu Controler dua qua de xu ly
	$stt = 1;
	$str_row_department = "";
	foreach($array_department as $department)
	{
		
		//tao 1 mang du lieu quan huyen
		$row_department = NULL;
			
		$row_department["stt"]			= array($stt++);
		$row_department["ten"] 			= array($department["name"]);
		$row_department["ma"] 			= array($department["code"],array("style"=>"text-align:center;"));			
		$row_department["mota"] 			= array($department["desc"]);
		$row_department["order_number"] 			= array($department["order_number"]);		
		
		
		//lay link sua department
		$code 		= $department["code"];
		$name 		= $department["name"];
		$desc		 = $department["desc"];
		$order_number = $department["order_number"];		
		$id = $department["id"];
		
		
        $link_sua	= "javascript:void(0)\" onclick=\"xem_form('$name','$code','$desc','$order_number','$id')";		
        $link_sua	= $this->Template->load_link("edit","Sửa",$link_sua);
        
		
		//lay link xoa & tao the href & dua vao cell
        //$link_xoa	= $this->Html->link(array("controller"=>"department","action"=>"xoa","params"=>array($department["id"],"index"),"ext"=>"html"));		
        $link_xoa	= $this->Template->load_link("del","Xóa","javascript:void(0)' onclick='xoa(\"$id\")");
        $row_department["tuychon"] = array($link_sua.$link_xoa ,array("style"=>"text-align:center;"));
		
		//tao 1 dong html dua vao mang row_department
		$str_row_department .= $this->Template->load_table_row($row_department);
	//ket thuc tao 1 dong du lieu
	}
	//4: lay html cua table
	$str_department =  $this->Template->load_table($str_header_department.$str_row_department);
	echo $str_department;

				
	
?>
