<?php
class notification extends Main
{
	function index()
	{
       $this->loadModel('User2',"users");
		$this->loadModel('Notification');

		//lấy tất cả dữ liệu từ bảng notification để hiện thị ra trang index_notifications.php
		$array_notifications =$this->Notification->find("all");
		$array_users =$this->User2->find("all");
		$html_result = $this->View->render("index_notifications.php",array("user"=>$array_users,"array_notifications"=>$array_notifications));
		echo $html_result;
	}
	function add($id="")
	{

		$this->loadModel('Notification');
		$this->loadModel('User2',"users");

		if (isset($_POST['data'])) 
		{

			$data=$_POST['data'];
		      $dt=$data["id_user_receive"];
          $array_edit_user=$this->User2->find("all",array("conditions"=>"id='$dt'"));
          $data['username_receive']=  $array_edit_user["0"]["username"];

			$data['date'] = date("Y-m-d ",strtotime($data["date"]));
			$this->Notification->save($data);
			 $this->redirect("/notification.html");
		}

		//lấy dữ liệu từ bảng Notification với cột id  = tham số $id để hiển thị thông tin ra form nhập sự kiện
		$array_edit_notifications=null;
		if($id != "")
		{
			$array_edit_notifications=$this->Notification->find("all",array("conditions"=>"id='$id'"));
		}
		
		//lấy tất cả dữ liệu từ bảng user để hiện thị thông tin user ra form nhập sự kiện 
		$array_users =$this->User2->find("all");


		$html_result = $this->View->render("add_notifications.php",array("user"=>$array_users,"array_edit_notifications"=>$array_edit_notifications));
		echo $html_result;
	}
	function del($id="")
	{
		if ($id !="")
		{
			// xóa sản phẩm theo id
			$this->loadModel("Notification");
			$this->Notification->delete($id);

    		// chuyển về trang index
			$this->redirect("/notification.html");
		}
	}

}
?>