<?php 																																																																																														
	//*****************************************
	//FUNCTION HEADER
	//*****************************************

$function_title = "Danh Sách Tin Nhắn";
echo $this->Template->load_function_header($function_title);

	//*****************************************
	//END FUNCTION HEADER
	//*****************************************

$str_notifications = "";

	//1: tao mang table header 	
$array_header_notifications =  array("Stt"=>array("Stt",array("style"=>"text-align:left; width:3%")),
	" id_user_receive"=>array(" Id_user_receive ",array("style"=>"text-align:left; width:15%")),
	"username_receive"=>array("Username_receive",array("style"=>"text-align:center; width:8%;white-space: nowrap")),						
	"content"=>array("Content",array("style"=>"text-align:left; width:8%")),
	"date"=>array("Date",array("style"=>"text-align:left; width:8%")),						
	// "status"=>array("Status",array("style"=>"text-align:left; width:7%")),
	"tuychon"=>array("Tùy chọn",array("style"=>"text-align:left; width:7%")),

	);

$str_notifications = $this->Template->load_table_header($array_header_notifications);

$stt=0;

foreach ($array_notifications as $notifications) {
	$stt++;
$id_notifications=$notifications['id'];
   $link_sua="/notification/add/$id_notifications.html";

	$link_xoa="/notification/del/$id_notifications.html";
	$link_sua  = $this->Template->load_link("edit","Sửa",$link_sua);
	$link_xoa  = $this->Template->load_link("del","Xóa",$link_xoa);
	$link_action = $link_xoa . $link_sua;
	foreach ($user as $key => $tmp_user) {
		# code...
		if($tmp_user['id'] == $notifications['id_user_receive'])
			$show_ten = $tmp_user['username'];
	}

$array_notifications =  array("Stt"=>array($stt,array("style"=>"text-align:left; width:3%")),
	"id_user_receive"=>array($notifications['id_user_receive'],array("style"=>"text-align:left; width:15%")),



	"username_receive"=>array($show_ten,array("style"=>"text-align:center; width:8%;white-space: nowrap")),	

	"content"=>array($notifications['content'],array("style"=>"text-align:center; width:8%;white-space: nowrap")),			
	"date"=>array($notifications['date'],array("style"=>"text-align:left; width:8%")),
	// "status"=>array($notifications['status'],array("style"=>"text-align:left; width:8%")),						
	"tuychon"=>array($link_action,array("style"=>"text-align:left; width:7%")),

	);	
$str_notifications .= $this->Template->load_table_row($array_notifications);



}
	//Đưa nội dung str_notifications vào thẻ table
$str_notifications =  $this->Template->load_table($str_notifications);
echo $str_notifications;				

?>
