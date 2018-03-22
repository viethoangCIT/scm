<?php
class message extends Main
{
	

	function add($id="")
	{

		$this->loadModel('Message');
		$this->loadModel('User2',"users");


		//kiểm tra có dữ liệu post để lưu không ?
		if (isset($_POST['data'])) 
		{
			$data=$_POST['data'];

			$data['date'] = date("Y-m-d ",strtotime($data["date"]));

			$data=$_POST['data'];
			//đua ten vao bang csdl

			$data1=$data['id_user_sent'];
			$data2=$data['id_user_receive'];

			 $array_edit_user1 =$this->User2->find("all",array("conditions"=>"id='$data1'"));
			 $array_edit_user2 =$this->User2->find("all",array("conditions"=>"id='$data2'"));

			// print_r($array_edit_users1) ;
			//  echo $array_edit_user1["0"]["username"];
			 $data['username_sent'] = $array_edit_user1["0"]["username"];
			  $data['username_receive'] = $array_edit_user2["0"]["username"];
			$this->Message->save($data);
			$this->redirect("/message.html");
		}
		
		
		//truy vấn dữ liệu sản phẩm hiện tại theo id để đưa vào form nhập sản phẩm
		$array_edit_message = null;

		if($id !="")

		{
			$array_edit_message=$this->Message->find("all",array("conditions"=>"id='$id'"));
			
		}
		//$array_users = null;
		// if($id_user_sent !="")
		// {
		// 	$data1=$data['$id_user_sent'];
		// $array_users =$this->User2->find("all",array("conditions"=>"id='$id'"));
			
		// 	$data['username'] = $array_edit_message["0"]["username_sent"];

		// }
		$array_users =$this->User2->find("all");
		// truy vấn tất cả  dữ liệu từ bảng  để đưa vào danh sách sản phẩm 
		$html_result = $this->View->render("add_message.php",array("user"=>$array_users,"array_edit_message"=>$array_edit_message));
		echo $html_result;



	}

	function index()
	{

		$this->loadModel('Message');
		$this->loadModel('User2',"users");
		$array_message =$this->Message->find("all");

		$array_users =$this->User2->find("all");
		$html_result = $this->View->render("index_message.php",array("array_message"=>$array_message,"user"=>$array_users));
		echo $html_result;

	}

	function del($id="")
	{
		if ($id != "")
		{
			// xóa sản phẩm theo id
    		$this->loadModel("Message");
    		$this->Message->delete($id);

    		// chuyển về trang index

    		$this->redirect("/message.html");
		}
	}



}
?>