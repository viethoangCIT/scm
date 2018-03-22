<?php
	$title = "DANH SÁCH NHÓM";
	echo $this->Template->load_function_header($title);

	// tạo dòng dành cho talbe ; 
	$row_table = null;
	$row_table["col1"] = array("STT",array("align"=>"center","style"=>"width: 50px"));
	$row_table["col2"] = array("Tên nhóm",array("align"=>"center","style"=>"width: 100px"));
	$row_table["col3"] = array("Mã nhóm",array("align"=>"center","style"=>"width: 100px"));
	$row_table["col4"] = array("Mô tả",array("align"=>"center","style"=>"width: 100px"));
	$row_table["col7"] = array("Chỉnh sửa",array("align"=>"center","style"=>"width: 100px"));
	$row_table["col8"] = array("Xóa",array("align"=>"center","style"=>"width: 100px"));

	// dùng hàm load_table_header để thay thế cho chuỗi <tr><td></td><td></td>...</tr>
	$str_table_header = $this->Template->load_table_header($row_table);

	$stt = 0;
	$msg = $this->Session->get_flash("msg");
	if ($msg == "del_ok") {
		echo $this->Template->load_label("Xóa thành công ! " , "" , "success" );
	}
	if ($msg == "say_ok") {
		echo $this->Template->load_label("Thêm mới thành công ! " , "" , "success" );
	}
	if ($msg == "update_ok") {
		echo $this->Template->load_label("Cập nhật thành công !" ,"" , "success");
	}

	// Tạo input và button search 
	$input_search = "";
	$input_search .= $this->Template->load_textbox(array("name"=>"search"));
	$input_search .= $this->Template->load_button(array("type"=>"submit"),"Tìm Kiếm");

	// Đưa $input_search vào <form></form>
	$str_form_content = "";
	$str_form_content .= $this->Template->load_form_row(array("title"=>"Tìm Nhóm", "input"=>$input_search));
	$str_form = $this->Template->load_form(array("method"=>"POST","action"=>"/group/index"),$str_form_content);
	echo $str_form;

	// kiểm tra mảng $array_group có dữ liệu hay không 
	if ($array_group != null) 
	{
		// dùng foreach để lấy dữ liệu từ mảng
		foreach ($array_group as $key => $value) 
		{
			$stt ++;
			$id = $value["id"];
			$name = $value["name"];
			$code = $value["code"];
			$des = $value["des"];
			$link_edit	= $this->Template->load_link("edit","Sửa","/group/add?id=$id");
			$link_del	= $this->Template->load_link("del","Xóa","/group/del?id=$id");

			$row_table = null;
			$row_table["col1"] = array($stt,array("align"=>"center"));
			$row_table["col2"] = array($name,array("align"=>"center"));
			$row_table["col3"] = array($code,array("align"=>"center"));
			$row_table["col4"] = array($des,array("align"=>"center"));
			$row_table["col7"] = array($link_edit,array("align"=>"center"));
			$row_table["col8"] = array($link_del,array("align"=>"center"));
			$str_table_header .= $this->Template->load_table_row($row_table);
		}
	}
	else 
	{
		$row_table = null;
		$row_table["col"] = array("Không có dữ liệu",array("align"=>"center","colspan"=>"8"));
		$str_table_header .= $this->Template->load_table_row($row_table);
	}
	$str_table_group = $this->Template->load_table($str_table_header);
	echo $str_table_group;

	if ($current_page > 1 && $total_page>1) 
			{
		        echo "<a href='index?page=". ($current_page-1)."'>BACK</a>";
		    }
		for ($i=1; $i <= $total_page ; $i++) 
		    { 
		        if ($i==$current_page) 
		        {
		            echo "<span>".$i."</span>";
		        }
				else 
		        {
		            echo "<a href='index?page=".$i."'>" .$i. "</a>";
		        }
		    }

		    // nếu trang nhỏ hơn tổng số trang  và tổng số trang > 1 thì hiển thị nút NEXT
		    if ($current_page < $total_page && $total_page > 1) 
		    {
		         echo "<a href='index?page=". ($current_page+1)."'>NEXT</a>";
		    }

    
?>