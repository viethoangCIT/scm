<?php

	//tạo tiêu đề hàm
	$function_title = "Nhập tin nhắn ";
	echo $this->Template->load_function_header($function_title);

	$str_form_message = "";

		$id = "";
		$id_user_sent = $user['id'] ="";
		$id_user_receive = $user['id'] ="";
		$username_sent = $user['username'] = "";
		$username_receive = $user['username'] = "";
		$content = "";
		$date = "";
 
		if($array_edit_message != null)

		{
			$id = $array_edit_message["0"]["id"];
			$id_user_sent = $array_edit_message["0"]["id_name_sent"];
			$id_user_receive = $array_edit_message["0"]["id_name_receive"];
			$username_sent = $array_edit_message["0"]["username_sent"];
			$username_receive = $array_edit_message["0"]["username_receive"];
			$content = $array_edit_message["0"]["content"];

			$date = $array_edit_message["0"]["date"];

		}




	 $str_input_message_id = $this->Template->load_hidden(array("name"=>"data[id]","id"=>"id","value"=>"$id","style"=>"width:100px"));

	//  $str_input_message_id_user_sent = $this->Template->load_textbox(array("name"=>"data[id_user_sent]","id"=>"id_user_sent","value"=>"$id_user_sent","style"=>"width:100px"));
	// $str_input_message_id_user_receive = $this->Template->load_textbox(array("name"=>"data[id_user_receive]","id"=>"id_user_receive","value"=>"$id_user_receive","style"=>"width:100px"));

	$str_input_message_username_sent = $this->Template->load_selectbox(array("name"=>"data[id_user_sent]","id"=>"id_user_sent","style"=>"width:300px"),$user);	

	$str_form_message .= $this->Template->load_form_row(array("title"=>"Tên người gởi","input"=>$str_input_message_username_sent  .$str_input_message_id));
	 
	$str_input_message_username_receive = $this->Template->load_selectbox(array("name"=>"data[id_user_receive]","id"=>"id_user_receive","style"=>"width:300px"),$user);

	$str_form_message .= $this->Template->load_form_row(array("title"=>"Tên người nhận","input"=>$str_input_message_username_receive ));

	// $str_input_message_content = $this->Template->load_textbox(array("name"=>"data[content]","id"=>"content","value"=>"$content","style"=>"width:300px"));	
	$str_input_message_content = $this->Template->load_textarea(array("name"=>"data[content]","id"=>"content","style"=>"width:300px"),$content);	
	$str_form_message .= $this->Template->load_form_row(array("title"=>"Nội dung","input"=>
		$str_input_message_content));
	
	$str_input_message_date = $this->Template->load_textbox(array("name"=>"data[date]","autocomplete","id"=>"date","value"=>"$date","style"=>"width:300px"));	
	$str_form_message .= $this->Template->load_form_row(array("title"=>"Ngày gởi","input"=>$str_input_message_date));

	//tạo nút lưu	
	$str_save_button =  $this->Template->load_button(array("type"=>"submit","onclick"=>"luu()"),"Giử");
	$str_form_message .= $this->Template->load_form_row(array("title"=>"","input"=>$str_save_button));
	
	//đưa vào form
	$str_form_message = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"/message/add?debug=code"),$str_form_message);
	echo $str_form_message; 
?>
<script language="javascript">
    $( function() {
        $( "#date" ).datepicker({dateFormat: "dd-mm-yy"});
		
    } );
   
</script>
