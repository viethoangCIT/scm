<style type="text/css">
	}
	.title_page{
		color: black;
	}
	.btn_icon_xoa{
   margin-left: 30px;
	}
	.btn_icon_edit{
		 margin-left: 60px;
	}

	.title_page{
		color: black;
	}
	.title_page{
		color: black!important;
		text-shadow:none;
	}
	.tbl_r{
	width: 1000px;
	margin:auto;
	}
</style>
<?php 																																																			
	//tạo tiêu đề hàm
	$function_title = "Nhập danh mục cấp đồng phục";
	echo $this->Template->load_function_header($function_title);
	
	
	//tạo textbox nhập tên tài sản
	$str_input_allowance_name = $this->Template->load_textbox(array("name"=>"data[name]","id"=>"name","value"=>$name,"style"=>"width:300px"));	
	
	//tạo dòng nhập tên đồng phục
	$str_form_allowance = "";
	$str_form_allowance .= $this->Template->load_form_row(array("title"=>"Tên phụ cấp ","input"=>$str_input_allowance_name));
	
		
	//tạo textbox số lượng
	$str_input_allowance_quantity = $this->Template->load_textbox(array("name"=>"data[quantity]","id"=>"quantity","value"=>"","style"=>"width:300px"));	
	$str_form_allowance .= $this->Template->load_form_row(array("title"=>"Số lượng ","input"=>$str_input_allowance_quantity));

	//tạo textbox nhập giá tiền
	$str_input_allowance_money = $this->Template->load_textbox(array("name"=>"data[money]","id"=>"money","value"=>"","style"=>"width:300px"));	
	$str_form_allowance .= $this->Template->load_form_row(array("title"=>"Giá tiền ","input"=>$str_input_allowance_money));
	
	
	//tạo nút lưu	
	$str_save_button =  $this->Template->load_button(array("type"=>"button","onclick"=>"luu()"),"Lưu");
	$str_form_allowance .= $this->Template->load_form_row(array("title"=>"","input"=>$str_save_button));
	
	//đưa vào form
	$str_form_allowance = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"?debug=code"),$str_form_allowance);
	echo $str_form_allowance; 																																											
	//*****************************************
	//FUNCTION HEADER
	//*****************************************

$function_title = "Danh Sách Đồng Phục";
echo $this->Template->load_function_header($function_title);

	//*****************************************
	//END FUNCTION HEADER
	//*****************************************

$str_allowance = "";

	//1: tao mang table header 	
$array_header_allowance =  array("Stt"=>array("Stt",array("style"=>"text-align:left; width:3%")),
	"ten"=>array("Tên đồng phục ",array("style"=>"text-align:left; width:8%")),
	"soluong"=>array("Số lượng",array("style"=>"text-align:center; width:8%;white-space: nowrap")),						
	"gia"=>array("Giá tiền",array("style"=>"text-align:left; width:8%")),
	"chucnang"=>array("Chức năng",array("style"=>"text-align:left; width:8%")),
	
	
	
	);

	//2: lấy dòng tr header
$str_allowance = $this->Template->load_table_header($array_header_allowance);

	//lấy dòng nội dung table

$link_sua='';
     $link_xoa="";
     $link_sua  = $this->Template->load_link("edit","Sửa",$link_sua);
     $link_xoa  = $this->Template->load_link("del","Xóa",$link_xoa);
     $link_action = $link_xoa . $link_sua;
for ($i=0; $i <5 ; $i++) { 
	


$array_allowance_1 =  array("Stt"=>array($i,array("style"=>"text-align:left; width:3%")),
	"ten"=>array("Áo ",array("style"=>"text-align:left; width:10%")),
	"soluong"=>array($i,array("style"=>"text-align:center; width:8%;white-space: nowrap")),						
	"gia"=>array("1000",array("style"=>"text-align:left; width:8%")),
	"chucnang"=>array($link_action,array("style"=>"text-align:center; width:8%")),
	
	);
$str_allowance .= $this->Template->load_table_row($array_allowance_1);

}

	//Đưa nội dung str_allowance vào thẻ table
$str_allowance =  $this->Template->load_table($str_allowance);
echo $str_allowance;				

?>
