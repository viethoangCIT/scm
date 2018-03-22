<?php 																																																																																														
	//*****************************************
	//FUNCTION HEADER
	//*****************************************

$function_title = "Danh sách tin nhắn";
echo $this->Template->load_function_header($function_title);

	//*****************************************
	//END FUNCTION HEADER
	//*****************************************

$str_message = "";

	//1: tao mang table header 	
$array_header_message =  array("Stt"=>array("Stt",array("style"=>"text-align:left; width:3%")),
	"username_sent"=>array(" Họ & tên người gửi ",array("style"=>"text-align:left; width:15%")),
	"username_receive"=>array("Họ & tên người nhận",array("style"=>"text-align:center; width:8%;white-space: nowrap")),						
	"content"=>array("Nội dung",array("style"=>"text-align:left; width:8%")),
	"date"=>array("Ngày",array("style"=>"text-align:left; width:8%")),						
	"status"=>array("Trạng thái",array("style"=>"text-align:left; width:7%")),
	"action"=>array("Chức năng",array("style"=>"text-align:left; width:7%")),

	);

	//2: lấy dòng tr header
$str_message = $this->Template->load_table_header($array_header_message);

	//lấy dòng nội dung table
$stt=0;
foreach ($array_message as $message ) 
{
	$stt++;

	$id_message = $message['id'];
	$link_sua="/message/add/$id_message.html";
	$link_xoa="/message/del/$id_message.html";
	$link_sua  = $this->Template->load_link("edit","Sửa",$link_sua);
	$link_xoa  = $this->Template->load_link("del","Xóa",$link_xoa);
	$link_action = $link_xoa . $link_sua;

    foreach ($user as $key => $value) {
	if ($value["id"]==$message['id_user_sent']) {
	$name_sent=$value['username'];

		}
	if ($value["id"]==$message['id_user_receive']) {
	$name_receive=$value['username'];

		}

	}


	$array_message =  array("Stt"=>array($stt,array("style"=>"text-align:left; width:3%")),
		"username_sent"=>array($name_sent,array("style"=>"text-align:left; width:15%")),
		"username_receive"=>array($name_receive,array("style"=>"text-align:center; width:8%;white-space: nowrap")),		
		"content"=>array($message["content"],array("style"=>"text-align:center; width:8%;white-space: nowrap")),			
		"date"=>array($message["date"],array("style"=>"text-align:left; width:8%")),
		"status"=>array($message["status"],array("style"=>"text-align:left; width:8%")),						
		"action"=>array($link_action,array("style"=>"text-align:left; width:7%")),

		);	
	$str_message .= $this->Template->load_table_row($array_message);

}
	//Đưa nội dung str_message vào thẻ table
$str_message =  $this->Template->load_table($str_message);
echo $str_message;				

?>
