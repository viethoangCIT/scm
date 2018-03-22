<?php 																																																																																														
//1: tao mang table header factory	
	$array_header_factory =  array("Stt"=>array("Stt",array("style"=>"text-align:left; width:3%")),
						"ten"=>array("Tên nhà máy",array("style"=>"text-align:left; width:15%")),
						"ma"=>array("Mã",array("style"=>"text-align:center; width:8%;white-space: nowrap")),						
						"mota"=>array("Mô tả",array("style"=>"text-align:left; width:8%")),
						"order_number"=>array("Thứ tự sắp xếp",array("style"=>"text-align:left; width:8%")),						
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
		$row_factory["ten"] 			= array($factory["name"]);
		$row_factory["ma"] 			= array($factory["code"],array("style"=>"text-align:center;"));			
		$row_factory["mota"] 			= array($factory["desc"]);
		$row_factory["order_number"] 			= array($factory["order_number"]);		
		
		
		//lay link sua factory
		$code 		= $factory["code"];
		$name 		= $factory["name"];
		$desc		 = $factory["desc"];
		$order_number = $factory["order_number"];		
		$id = $factory["id"];
		
		
        $link_sua	= "javascript:void(0)\" onclick=\"xem_form('$name','$code','$desc','$order_number','$id')";		
        $link_sua	= $this->Template->load_link("edit","Sửa",$link_sua);
        
		
		//lay link xoa & tao the href & dua vao cell
        //$link_xoa	= $this->Html->link(array("controller"=>"factory","action"=>"xoa","params"=>array($factory["id"],"index"),"ext"=>"html"));		
        $link_xoa	= $this->Template->load_link("del","Xóa","javascript:void(0)' onclick='xoa(\"$id\")");
        $row_factory["tuychon"] = array($link_sua.$link_xoa ,array("style"=>"text-align:center;"));
		
		//tao 1 dong html dua vao mang row_factory
		$str_row_factory .= $this->Template->load_table_row($row_factory);
	//ket thuc tao 1 dong du lieu
	}
	//4: lay html cua table
	$str_factory =  $this->Template->load_table($str_header_factory.$str_row_factory);
	echo $str_factory;

				
	
?>
