<?php 																																																			
	//tạo tiêu đề hàm
	$function_title = "Quản lí chức vụ nhân viên ";
	echo $this->Template->load_function_header($function_title);
	$str_form_position = "";

	$str_input_username = $this->Template->load_textbox(array("name"=>"data['fullname']","id"=>"username","value"=>"","style"=>"width:300px"));	
	$str_input_user_code = $this->Template->load_textbox(array("name"=>"data['user_code']","id"=>"user_code","value"=>"","style"=>"width:300px"));
	$str_input_id_user = $this->Template->load_textbox(array("name"=>"data['id_user']","id"=>"id_user","value"=>"","style"=>"width:300px"));
	$str_form_position .= $this->Template->load_form_row(array("title"=>"Họ và tên nhân vên","input"=>$str_input_username.$str_input_user_code.$str_input_id_user));

	
																																																			
	//tạo tiêu đề hàm
	$function_title = "Nhập chức vụ";
	?>
	<div class="tieude">
	<?php
	echo $this->Template->load_function_header($function_title);
	
	?>
	</div>
	
	<?php
	//tạo textbox nhập tên tài sản
	
	
	//tạo dòng nhập tên đồng phục
	
	$str_input_position_name = $this->Template->load_selectbox(array("name"=>"data[name]","id"=>"name","value"=>"","style"=>"width:300px"),$array_position);	
	$str_form_position .= $this->Template->load_form_row(array("title"=>"Tên chức vụ ","input"=>$str_input_position_name));
	
		
	//tạo textbox số lượng
	$str_input_position_factor = $this->Template->load_textbox(array("name"=>"data[position_factor]","id"=>"quantity","value"=>"","style"=>"width:300px"));	
	$str_form_position .= $this->Template->load_form_row(array("title"=>"Hệ số chức vụ ","input"=>$str_input_position_factor));

	//tạo textbox nhập giá tiền
	$str_input_date = $this->Template->load_textbox(array("name"=>"data[date]","id"=>"date","value"=>"","style"=>"width:300px"));	
	$str_form_position .= $this->Template->load_form_row(array("title"=>"Ngày chức vụ ","input"=>$str_input_date));
	
	
	//tạo nút lưu	
	$str_save_button =  $this->Template->load_button(array("type"=>"button","onclick"=>"luu()"),"Lưu");
	$str_form_position .= $this->Template->load_form_row(array("title"=>"","input"=>$str_save_button));
	
	//đưa vào form
	$str_form_position = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"?debug=code"),$str_form_position);
	echo $str_form_position; 																																											
	//*****************************************
	//FUNCTION HEADER
	//*****************************************

$function_title = "Danh Sách chức vụ";
echo $this->Template->load_function_header($function_title);

	//*****************************************
	//END FUNCTION HEADER
	//*****************************************

$str_position = "";

	//1: tao mang table header 	
$array_header_position =  array("Stt"=>array("Stt",array("style"=>"text-align:left; width:3%")),
	"ten"=>array("Tên chức cụ ",array("style"=>"text-align:left; width:8%")),
	"factor"=>array("Hệ số chứ vụ",array("style"=>"text-align:center; width:8%;white-space: nowrap")),						
	"date"=>array("Ngày chức vụ",array("style"=>"text-align:left; width:8%")),
	"chucnang"=>array("Chức năng",array("style"=>"text-align:left; width:8%")),
	
	
	
	);

	//2: lấy dòng tr header
$str_position = $this->Template->load_table_header($array_header_position);

	//lấy dòng nội dung table
foreach ($array_edit as $user_position) 
{
  $stt++;

  $id_product = $product['id'];
  $link_sua="/attendance2/add_product/$id_product.html";
  $link_xoa="/attendance2/del3/$id_product.html";
  $link_sua  = $this->Template->load_link("edit","Sửa",$link_sua);
  $link_xoa  = $this->Template->load_link("del","Xóa",$link_xoa);
  $link_action = $link_xoa . $link_sua ;
 


$array_position_1 =  array("Stt"=>array($stt,array("style"=>"text-align:left; width:3%")),
	"ten"=>array($user_position['position'],array("style"=>"text-align:left; width:10%")),
	"factor"=>array($user_position['position'],array("style"=>"text-align:center; width:8%;white-space: nowrap")),						
	"date"=>array($user_position['date'],array("style"=>"text-align:left; width:8%")),
	"chucnang"=>array($link_action,array("style"=>"text-align:center; width:8%")),
	
	);
$str_position .= $this->Template->load_table_row($array_position_1);

}

	//Đưa nội dung str_position vào thẻ table
$str_position =  $this->Template->load_table($str_position);
echo $str_position;				

?>

	<script type="text/javascript">
       $( function() {
        $( "#date" ).datepicker({dateFormat: "dd-mm-yy"});
    } );
    </script>