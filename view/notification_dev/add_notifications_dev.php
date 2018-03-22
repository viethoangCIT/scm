<?php

	//tạo tiêu đề hàm
$function_title = "Nhập Tin Nhắn  ";
echo $this->Template->load_function_header($function_title);

$id_user_receive = "";
$username_receive = "";
$content = "";
$date = "";
$status = "";
$id = "";
// print_r($array_edit_notifications);

if($array_edit_notifications != null)
{
	$id_user_receive = $array_edit_notifications["0"]["id_user_receive"];
	$username_receive = $array_edit_notifications["0"]["username_receive"];
	$content = $array_edit_notifications["0"]["content"];
	// $data['date'] = date("Y-m-d ",strtotime($data["date"]));
	$date = $array_edit_notifications["0"]["date"];
                   
	$status = $array_edit_notifications["0"]["status"];
	
	$id = $array_edit_notifications["0"]["id"];
}

	//tạo textbox nhập tên tài sản
// $str_input_notifications_id_user_receive = $this->Template->load_textbox(array("name"=>"data[id_user_receive]","id"=>"id_user_receive","value"=>"$id_user_receive","style"=>"width:300px"));	

// 	//tạo dòng nhập tên đồng phục
$str_form_notifications = "";
// $str_form_notifications .= $this->Template->load_form_row(array("title"=>"Id_user_receive ","input"=>$str_input_notifications_id_user_receive));
$str_input_notifications_id = $this->Template->load_hidden(array("name"=>"data[id]","id"=>"id","value"=>"$id","style"=>"width:300px"));

$str_input_notifications_username_receive = $this->Template->load_selectbox(array("name"=>"data[id_user_receive]","id"=>"id_user_receive","style"=>"width:300px"),$user);

$str_form_notifications .= $this->Template->load_form_row(array("title"=>"username_receive ","input"=>
	$str_input_notifications_username_receive.$str_input_notifications_id));


	//tạo textbox content
$str_input_notifications_content = $this->Template->load_textbox(array("name"=>"data[content]","id"=>"content","value"=>"$content","style"=>"width:300px"));	
$str_form_notifications .= $this->Template->load_form_row(array("title"=>"Content ","input"=>$str_input_notifications_content));

	//tạo textbox nhập date
$str_input_notifications_date= $this->Template->load_textbox(array("name"=>"data[date]","autocomplete"=>"off","value"=>"$date","id"=>"date", "class"=>"day","style"=>"width:90px;"));
$str_form_notifications .= $this->Template->load_form_row(array("title"=>"Date ","input"=>$str_input_notifications_date));





// $str_input_notifications_status = $this->Template->load_textbox(array("name"=>"data[status]","id"=>"status","value"=>"$status","style"=>"width:300px"));	
// $str_form_notifications .= $this->Template->load_form_row(array("title"=>"Status ","input"=>$str_input_notifications_status));


	//tạo nút lưu	
$str_save_button =  $this->Template->load_button(array("type"=>"submit","onclick"=>"luu()"),"Gởi");
$str_form_notifications .= $this->Template->load_form_row(array("title"=>"","input"=>$str_save_button));

	//đưa vào form
$str_form_notifications = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"/notification/add?debug=code"),$str_form_notifications);
echo $str_form_notifications; 
?>
<script language="javascript">
    $( function() {
        $( "#date" ).datepicker({dateFormat: "dd-mm-yy"});
		
    } );
   
</script>