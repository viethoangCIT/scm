<?php	
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	$function_title = "Danh Sách Tài Sản";
	echo $this->Template->load_function_header($function_title);
	
	//*****************************************
	//END FUNCTION HEADER
	//*****************************************

	//tao mang array chua du lieu table

	$array_table_asset_header = array(
								"num" 					=> array("Stt",array("style"=>"width:1%;text-align:center")),
								"name" 					=> array("Tên tài khoản",array("style"=>"text-align:left")),
								"code"					=> array("Mã code",array("style"=>"text-align:left")),
								"date_input"			=> array("Ngày nhập",array("style"=>"text-align:left")),
								"des"					=> array("Mô tả",array("style"=>"text-align:left")),
								"status"				=> array("Trạng thái",array("style"=>"text-align:left")),
								"edit"					=>array("Sửa",array("style"=>"text-align:center")),
								"delete"				=>array("Xóa",array("style"=>"text-align:center"))

								);

	//goi ham $this->Temlate->load_table_header de tao cap the <tr><td></td></tr>

	$str_table_asset_header = $this->Template->load_table_header($array_table_asset_header);

	//lay du lieu array_asset dua vao table

	$str_table_asset_row = "";
	if($array_asset != null)
	{
		$stt = 0;
		foreach ($array_asset as $asset) 
		{
			$stt++;
			$array_table_asset_row = null;


			//chuyen date_input ve dinh dang ngay thang nam
			$date_input = date("d-m-Y",strtotime($asset["date_input"]));

			$array_table_asset_row["num"] = array($stt,array("text-align:center"));
			$array_table_asset_row["name"] = array($asset["name"],array("text-align:left"));
			$array_table_asset_row["code"] = array($asset["code"],array("text-align:left"));
			$array_table_asset_row["date_input"] = array($date_input,array("text-align:center"));
			$array_table_asset_row["des"] = array($asset["des"],array("text-align:center"));
			$array_table_asset_row["status"] = array($asset["status"],array("text-align:center"));
			//tạo linh sửa
			$str_link_edit = $this->Template->load_link("edit","Sửa","/asset/add/".$asset["id"].".html");
			$array_table_asset_row["edit"] = array($str_link_edit,array("text-align:center"));
			
			//tạo link xóa
			$str_link_delete = $this->Template->load_link("del","Xóa","/asset/del/".$asset["id"].".html");
			$array_table_asset_row["option"] = array($str_link_delete,array("text-align:center"));

			//su dung ham $this->Teamlate->load_table_row()
			//de tao cap the <tr><td></td></tr> tu mang

			$str_table_asset_row .= $this->Template->load_table_row($array_table_asset_row,array("align"=>"center","id"=>"table_posts"));
		}
	}

	/* gọi hàm $this->Template->load_table() tạo <table>nội dung là giá trị của biến str_table_asset_header</table> 
		và gán vào chuỗi str_table_asset
	*/

	$str_table_asset = $this->Template->load_table($str_table_asset_header.$str_table_asset_row,array("align"=>"left","id"=>"table_posts"));
	echo $str_table_asset;

?>
