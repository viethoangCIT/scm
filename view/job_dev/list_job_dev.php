<?php 																																																																																														
//1: tao mang table header job	
	$array_header_job =  array("Stt"=>array("Stt",array("style"=>"text-align:left; width:3%")),
						"ten"=>array("Tên vị trí công việc",array("style"=>"text-align:left; width:15%")),
						"ma"=>array("Mã",array("style"=>"text-align:center; width:8%;white-space: nowrap")),						
						"mota"=>array("Mô tả",array("style"=>"text-align:left; width:8%")),
						"order_number"=>array("Thứ tự sắp xếp",array("style"=>"text-align:left; width:8%")),						
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
		$row_job["ten"] 			= array($job["name"]);
		$row_job["ma"] 			= array($job["code"],array("style"=>"text-align:center;"));			
		$row_job["mota"] 			= array($job["desc"]);
		$row_job["order_number"] 			= array($job["order_number"]);		
		
		
		//lay link sua job
		$code 		= $job["code"];
		$name 		= $job["name"];
		$desc		 = $job["desc"];
		$order_number = $job["order_number"];		
		$id = $job["id"];
		
		
        $link_sua	= "javascript:void(0)\" onclick=\"xem_form('$name','$code','$desc','$order_number','$id')";		
        $link_sua	= $this->Template->load_link("edit","Sửa",$link_sua);
        
		
		//lay link xoa & tao the href & dua vao cell
        //$link_xoa	= $this->Html->link(array("controller"=>"job","action"=>"xoa","params"=>array($job["id"],"index"),"ext"=>"html"));		
        $link_xoa	= $this->Template->load_link("del","Xóa","javascript:void(0)' onclick='xoa(\"$id\")");
        $row_job["tuychon"] = array($link_sua.$link_xoa ,array("style"=>"text-align:center;"));
		
		//tao 1 dong html dua vao mang row_job
		$str_row_job .= $this->Template->load_table_row($row_job);
	//ket thuc tao 1 dong du lieu
	}
	//4: lay html cua table
	$str_job =  $this->Template->load_table($str_header_job.$str_row_job);
	echo $str_job;

				
	
?>
