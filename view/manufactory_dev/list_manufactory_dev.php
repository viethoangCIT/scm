<?php 																																																																																														
//1: tao mang table header manufactory	
	$array_header_manufactory =  array("Stt"=>array("Stt",array("style"=>"text-align:left; width:3%")),
						"ten"=>array("Tên phân xưởng",array("style"=>"text-align:left; width:15%")),
						"ma"=>array("Mã",array("style"=>"text-align:center; width:8%;white-space: nowrap")),
						"factory"=>array("Nhà máy",array("style"=>"text-align:center; width:8%;")),						
						"mota"=>array("Mô tả",array("style"=>"text-align:left; width:8%")),
						"order_number"=>array("Thứ tự sắp xếp",array("style"=>"text-align:left; width:8%")),						
						"tuychon"=>array("Tuỳ Chọn",array("style"=>"text-align:left; width:7%")),
						
					);
					
	//2: lay html table header manufactory(dong tren cung cua table)
	$str_header_manufactory = $this->Template->load_table_header($array_header_manufactory);

	//*****************************************************
	//3: lay du lieu quan huyen tu Controler dua qua de xu ly
	$stt = 1;
	$str_row_manufactory = "";
	foreach($array_manufactory as $manufactory)
	{
		
		//tao 1 mang du lieu quan huyen
		$row_manufactory = NULL;
			
		$row_manufactory["stt"]			= array($stt++);
		$row_manufactory["ten"] 			= array($manufactory["name"]);
		$row_manufactory["ma"] 			= array($manufactory["code"],array("style"=>"text-align:center;"));			
		$row_manufactory["factory"] 			= array($manufactory["factory"]);
		$row_manufactory["mota"] 			= array($manufactory["desc"]);
		$row_manufactory["order_number"] 			= array($manufactory["order_number"]);		
		
		
		//lay link sua manufactory
		$code 		= $manufactory["code"];
		$name 		= $manufactory["name"];
		$id_factory 		= $manufactory["id_factory"];
		$desc		 = $manufactory["desc"];
		$order_number = $manufactory["order_number"];		
		$id = $manufactory["id"];
		
		
        $link_sua	= "javascript:void(0)\" onclick=\"xem_form('$name','$code','$desc','$order_number','$id','$id_factory')";		
        $link_sua	= $this->Template->load_link("edit","Sửa",$link_sua);
        
		
		//lay link xoa & tao the href & dua vao cell
        //$link_xoa	= $this->Html->link(array("controller"=>"manufactory","action"=>"xoa","params"=>array($manufactory["id"],"index"),"ext"=>"html"));		
        $link_xoa	= $this->Template->load_link("del","Xóa","javascript:void(0)' onclick='xoa(\"$id\")");
        $row_manufactory["tuychon"] = array($link_sua.$link_xoa ,array("style"=>"text-align:center;"));
		
		//tao 1 dong html dua vao mang row_manufactory
		$str_row_manufactory .= $this->Template->load_table_row($row_manufactory);
	//ket thuc tao 1 dong du lieu
	}
	//4: lay html cua table
	$str_manufactory =  $this->Template->load_table($str_header_manufactory.$str_row_manufactory);
	echo $str_manufactory;

				
	
?>
