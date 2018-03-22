<?php
	class production extends Main
	{
		function plan()
		{
			$this->loadModel("ProductionPlan", "production_plans");
			$this->loadModel("Factory", "factorys");
			$this->loadModel("Manufatory", "manufactorys");
			$this->loadModel("Group", "groups");
			$this->loadModel("Shift", "shift");
			$this->loadModel("User2", "users");
			
			$dk = "";
			$id_factory = "";
			if(isset($_GET["id_factory"]) && $_GET["id_factory"]!="") $id_factory = $_GET["id_factory"];
			if($id_factory!="")
				 $dk = "`id_factory` = '$id_factory'";
			
			$id_manufactory = "";
			if(isset($_GET["id_manufactory"]) && $_GET["id_manufactory"]!="") $id_manufactory = $_GET["id_manufactory"];
			if($id_manufactory!="") 
				{
					if($dk!="") $dk .= " AND ";
					 $dk .= "`id_manufactory` = '$id_manufactory'";	
				}
			
			$id_group = "";
			if(isset($_GET["id_group"]) && $_GET["id_group"]!="") $id_group = $_GET["id_group"];
			if($id_group!="") 
				{
					if($dk!="") $dk .= " AND ";
					 $dk .= "`id_group` = '$id_group'";	
				}
			
			$id_shift = "";
			if(isset($_GET["id_shift"]) && $_GET["id_shift"]!="") $id_shift = $_GET["id_shift"];
			if($id_shift!="") 
				{
					if($dk!="") $dk .= " AND ";
					 $dk .= "`id_shift` = '$id_shift'";	
				}
			
			$id_user_leader = "";
			if(isset($_GET["id_user_leader"]) && $_GET["id_user_leader"]!="") $id_user_leader = $_GET["id_user_leader"];
			if($id_user_leader!="") 
				{
					if($dk!="") $dk .= " AND ";
					 $dk .= "`id_user_leader` = '$id_user_leader'";	
				}
			
			$id_user_manager = "";
			if(isset($_GET["id_user_manager"]) && $_GET["id_user_manager"]!="") $id_user_manager = $_GET["id_user_manager"];
			if($id_user_manager!="") 
				{
					if($dk!="") $dk .= " AND ";
					 $dk .= "`id_user_manager` = '$id_user_manager'";	
				}
			
			$day = "";
			if(isset($_GET["day"]) && $_GET["day"]!="") $day = date("Y-m-d",strtotime($_GET["day"]));
			if($day!="") 
				{
					if($dk!="") $dk .= " AND ";
					 $dk .= "`day` = '$day'";	
				}
							
			$array_factory = $this->Factory->find("all", array("fields"=>"id, name"));
			$array_factory = array(""=>array("id"=>"", "name"=>"...")) + $array_factory;
			
			$array_manufactory = $this->Manufatory->find("all", array("fields"=>"id, name"));
			$array_manufactory = array(""=>array("id"=>"", "name"=>"...")) + $array_manufactory;
			
			$array_group = $this->Group->find("all", array("fields"=>"id, name"));
			$array_group = array(""=>array("id"=>"", "name"=>"...")) + $array_group;
			
			$array_shift = $this->Shift->find("all", array("fields"=>"id, name"));
			$array_shift = array(""=>array("id"=>"", "name"=>"...")) + $array_shift;
			
			$array_user = $this->User2->find("all", array("fields"=>"id, fullname"));
			$array_user = array(""=>array("id"=>"", "name"=>"...")) + $array_user;

			
			
			$array_production_plan = $this->ProductionPlan->find("all", array("conditions"=>$dk));
			
			$array_param = array("array_factory"=>$array_factory,
								"array_manufactory"=>$array_manufactory,
								"array_group"=>$array_group,
								"array_shift"=>$array_shift,
								"array_user"=>$array_user,
								"array_production_plan"=>$array_production_plan,
								"id_factory"=>$id_factory,
								"id_manufactory"=>$id_manufactory,
								"id_manufactory"=>$id_manufactory,
								"id_group"=>$id_group,
								"id_shift"=>$id_shift,
								"id_user_leader"=>$id_user_leader,
								"id_user_manager"=>$id_user_manager,
								"day"=>$day
			);
			
			$html_result = $this->View->render("plan_production.php", $array_param);	
			echo $html_result;
		}
		function add_plan($id_production_plan="")
		{
			$this->loadModel("Factory", "factorys");
			$this->loadModel("Manufactory", "manufactorys");
			$this->loadModel("Group", "groups");
			$this->loadModel("Shift", "shift");
			$this->loadModel("User2", "users");
			$this->loadModel("Machine", "machines");
			$this->loadModel("Product", "products");
			$this->loadModel("ProductionPlan", "production_plans");
			
			
			
			//Begin: kiểm tra nếu có status thì lưu vào bảng production_plans
			if(isset($_GET["data"]))
			{				
				$id_group = "";
				$array_data = $_GET["data"];
				$status = $array_data["status"];
				$id_factory = $array_data["id_factory"];
				$id_manufactory = $array_data["id_manufactory"];
				if(isset($array_data["id_group"]))
					$id_group = $array_data["id_group"];
				$id_shift = $array_data["id_shift"];
				$id_user_leader = $array_data["id_user_leader"];
				$id_user_manager = $array_data["id_user_manager"];
				$day = $array_data["day"];
				$array_data["day"] = date("Y-m-d",strtotime($day));
				
				$array_data["factory"] 		= $this->Factory->get_value(array("conditions"=>"id = '$id_factory'", "fields"=>"name"));
				$array_data["manufactory"]	= $this->Manufactory->get_value(array("conditions"=>"id = '$id_manufactory'", "fields"=>"name"));
				$array_data["group"]	 	= $this->Group->get_value(array("conditions"=>"id = '$id_group'", "fields"=>"name"));
				$array_data["shift"] 		= $this->Shift->get_value(array("conditions"=>"id = '$id_shift'", "fields"=>"name"));
				$array_data["user_leader"] 	= $this->User2->get_value(array("conditions"=>"id = '$id_user_leader'", "fields"=>"fullname"));
				$array_data["user_manager"] = $this->User2->get_value(array("conditions"=>"id = '$id_user_manager'", "fields"=>"fullname"));
				
				//print_r($array_data);
				if($status =="1") 
				{
					$this->ProductionPlan->save($array_data);
					$this->redirect("/production/plan");
				}
			}
			//End: kiểm tra nếu có status thì lưu vào bảng production_plans
			
			
			$array_edit_production_plan =NULL;
			if($id_production_plan!="")
			{
				$array_edit_production_plan = $this->ProductionPlan->find("all", array("conditions"=>"id = '$id_production_plan'"));
			}
			
			$dk_group = "";
			$id_manufactory = "";
			
			$dk_user = "";
			$id_group_search = "";
			if(isset($_GET["data"]) )
			{
				$array_search = $_GET["data"];
				if(isset($array_search["id_manufactory"]) && $array_search["id_manufactory"] != "")
				{
					$id_manufactory = $_GET["data"]["id_manufactory"];
					$dk_group = "id_manufactory = '$id_manufactory'";
				}
				if(isset($array_search["id_group"]) && $array_search["id_group"] != "")
				{
					$id_group_search = $_GET["data"]["id_group"];
					$dk_user = "id_group = '$id_group_search'";
				}
			}
			//lấy thông tin
			$array_factory = $this->Factory->find("all", array("fields"=>"id, name"));
			$array_manufactory = $this->Manufactory->find("all", array("fields"=>"id, name"));
			if($array_manufactory) $array_manufactory = array(""=>array("id"=>"","name"=>"Xưởng")) + $array_manufactory;
			
			$array_group = $this->Group->find("all", array("fields"=>"id, name","conditions"=>$dk_group));
			if($array_group) $array_group = array(""=>array("id"=>"","name"=>"Tổ")) + $array_group;
			
			$array_shift = $this->Shift->find("all", array("fields"=>"id, name"));
			$array_machine = $this->Machine->find("all", array("fields"=>"id, name"));
			
			$array_user = $this->User2->find("all", array("fields"=>"id, fullname","conditions"=>$dk_user));
			if($array_user) $array_user = array(""=>array("id"=>"","name"=>"User")) + $array_user;
			
			$array_product = $this->Product->find("all",array("fields"=>"id, concat(code,' - ',name) as name"));
			
			$array_param = array("array_factory"=>$array_factory,
								"array_manufactory"=>$array_manufactory,
								"array_group"=>$array_group,
								"array_shift"=>$array_shift,
								"array_machine"=>$array_machine,
								"array_user"=>$array_user,
								"array_edit_production_plan"=>$array_edit_production_plan,
								"id_manufactory"=>$id_manufactory,
								"id_group_search"=>$id_group_search
			);
			
			
			//dùng hàm render của đối tượng view để gọi tới file add_production.php và đưa mảng array_param qua view
			$html_result = $this->View->render("add_plan_production.php", $array_param);

			//dùng câu lệnh xuất ra màn hình echo để đưa $html_resulft những gì nhìn thấy ra màn hình là những thẻ html 
			echo $html_result;
		}
		
		function production_plan_detail($id_production_plan = "",$id_plan_detail="")
		{
			$this->loadModel("ProductionPlanDetail", "production_plan_detail");
			$this->loadModel("ProductionPlan", "production_plans");
			$this->loadModel("Product", "products");
			$this->loadModel("Machine", "machines");
			$this->loadModel("ProductMachine","product_machines");
			
			
			$act = "";
			if(isset($_GET["act"]) && $_GET["act"]) $act = $_GET["act"];
			
			//Xóa
			if($act =="del")
			{
				if($id_plan_detail != "") $this->ProductionPlanDetail->delete($id_plan_detail);
			}
			
			//Sửa
			$array_edit = null;
			if($act=="edit")
			{
				if($id_plan_detail != "") 
				{
					$array_edit = $this->ProductionPlanDetail->find("all",array("conditions"=>"id='$id_plan_detail'"));
				}
			}
			
			if(isset($_POST["data"]))
			{
				$array_data = $_POST["data"];
				$array_data["id_production_plan"] = $id_production_plan;
				$id_product = $array_data["id_product"];
				
				//lấy thông tin máy
				$array_data["id_machine"] = $this->ProductMachine->get_value(array("fields"=>"id_machine","conditions"=>"id_product='$id_product'"));
				$id_machine = $array_data["id_machine"];
				$array_data["machine"] = $this->ProductMachine->get_value(array("fields"=>"machine_name","conditions"=>"id_product='$id_product'"));
				$array_data["machine_control"] = $this->ProductMachine->get_value(array("fields"=>"machine_control","conditions"=>"id_product='$id_product'"));
				$array_plan = $this->ProductionPlan->find("all",array("conditions"=>"id='$id_production_plan'"));
				$array_data["product"] = $this->Product->get_value(array("fields"=>"name","conditions"=>"id='$id_product'"));
				$array_data["product_code"] = $this->Product->get_value(array("fields"=>"code","conditions"=>"id='$id_product'"));
				
				$array_data["id_factory"] = $array_plan[0]["id_factory"];
				$array_data["id_manufactory"] = $array_plan[0]["id_manufactory"];
				$array_data["id_group"] = $array_plan[0]["id_group"];
				$array_data["group"] = $array_plan[0]["group"];
				$array_data["id_shift"] = $array_plan[0]["id_shift"];
				$array_data["shift"] = $array_plan[0]["shift"];
				$array_data["id_user_leader"] = $array_plan[0]["id_user_leader"];
				$array_data["user_leader"] = $array_plan[0]["user_leader"];
				$array_data["id_user_manager"] = $array_plan[0]["id_user_manager"];
				$array_data["user_manager"] = $array_plan[0]["user_manager"];
				$array_data["day"] = $array_plan[0]["day"];
				
				//print_r($array_data);
				$this->ProductionPlanDetail->save($array_data);
				$this->redirect("/production/production_plan_detail/$id_production_plan");
			}
			
			$array_production_plan_detail = $this->ProductionPlanDetail->find("all",array("conditions"=>"id_production_plan='$id_production_plan'"));
			
			//$array_machine = array(""=>array("id"=>"","name"=>"Chọn máy"));
			//$array_machine += $this->Machine->find("all",array("fields"=>"id,name"));
			
			$array_product = array(""=>array("id"=>"","name"=>"Chọn sản phẩm"));
			$array_product += $this->Product->find("all",array("fields"=>"id,name"));
			
			$array_param = array(
				"array_production_plan_detail"=>$array_production_plan_detail,
				//"array_machine"=>$array_machine,
				"array_product"=>$array_product,
				"array_edit"=>$array_edit,
				"id_production_plan"=>$id_production_plan
			);
			
			$html_result = $this->View->render("add_plan_detail_production.php",$array_param);
			echo $html_result;	
		}

		function del_plan($id_production_plan="")
		{
			$this->loadModel("ProductionPlan", "production_plans");
			if($id_production_plan!="")
			{
				$this->ProductionPlan->delete($id_production_plan);
				
				$this->redirect("/production/plan.html");
			}
		}

		function plan_detail($id_production_plan="")
		{
			$this->loadModel("ProductionPlanDetail", "production_plan_detail");
			$this->loadModel("Product", "products");
			
			//join 2 bảng product với bảng product_plan_detail
			$str_col_product = "id, id_customer, customer, str_user_work, str_product_rate";
			$sql_product = "SELECT $str_col_product FROM scm_products";
			
			$str_col_detail = "id AS id_production_detail, id_production_plan, id_product, product, product_code, time";
			$sql_detail = "SELECT $str_col_detail FROM scm_production_plan_detail WHERE id_production_plan='$id_production_plan'";
			
			$sql_product_detail = "SELECT A.*, B.* FROM ($sql_product) AS A LEFT JOIN ($sql_detail) AS B ON A.id = B.id_product WHERE B.id_product IS NOT NULL";
			
			$str_col_machine = "id_product AS id_product_machine,id_machine, machine_name, machine_control, cavity, cycletime";
			$sql_machine = "SELECT $str_col_machine FROM scm_product_machines";
			
			$sql_production_plan_detail = "SELECT C.*, D.* FROM ($sql_product_detail) AS C LEFT JOIN ($sql_machine) AS D ON C.id = D.id_product_machine";
			
			$str_col_data = "id_production_detail AS id_production_detail2, time_data, num_ok, num_ng";
			$sql_production_data = "SELECT $str_col_data FROM scm_production_plan_datas";
			
			$sql_production_plan_data = "SELECT E.*, F.* FROM ($sql_production_plan_detail) AS E LEFT JOIN ($sql_production_data) AS F ON E.id_production_detail = F.id_production_detail2";
			
			$sql_product_user = "SELECT id_product AS id_product_user, user_code, user_fullname, work_name, shift FROM `scm_product_users`";
			$sql_production_plan_data_user = "SELECT G.*, H.* FROM ($sql_production_plan_data) AS G LEFT JOIN ($sql_product_user) AS H ON G.id = H.id_product_user";
			
			//echo $sql_production_plan_data_user;
			$array_production_detail = $this->Product->query($sql_production_plan_data);
			
			$stt = 0;
			
			//$array_production_plan_detail = $this->ProductionPlanDetail->find("all", array("conditions"=>"id_production_plan = '$id_production_plan'"));
			
			$array_param = array("array_production_detail"=>$array_production_detail,
								"stt"=>$stt
							);
			
			$html = $this->View->render("plan_detail_production.php", $array_param,false);
			echo $html;
		}


		function add_delivery($id_delivery="")
		{
			$this->loadModel("Factory", "factorys");
			$this->loadModel("Manufactory", "manufactorys");
			$this->loadModel("Product_cats", "product_cats");
			$this->loadModel("Product", "products");
			$this->loadModel("Customer", "customers");
			$this->loadModel("Delivery_plan", "delivery_plans");
			
			if(isset($_POST["production"]))
			{
				$array_production = $_POST["production"];
				
				$id_product = $array_production["id_product"];
				
				//$id_customer = $array_production["id_customer"];
				
				$id_factory = $array_production["id_factory"];

				$id_manufactory = $array_production["id_manufactory"];
				
				$id_cat = $array_production["id_cat"];
									
				$array_production["product_name"] = $this->Product->get_value(array("conditions"=>"id = '$id_product'","fields"=>"name"));
				
				$array_production["customer_name"] = $this->Product->get_value(array("conditions"=>"id = '$id_product'","fields"=>"customer"));
				
				$array_production["factory_name"] = $this->Factory->get_value(array("conditions"=>"id = '$id_factory'","fields"=>"name"));
				//$array_factory_name = $this->Factory->find("all", array("conditions"=>"id = '$id_factory'"));
				
				$array_production["manufactory_name"] = $this->Manufactory->get_value(array("conditions"=>"id = '$id_manufactory'","fields"=>"name"));
				//$array_manufactory_name = $this->Manufactory->find("all", array("conditions"=>"id = '$id_manufactory'"));
				
				$array_production["cat_name"] = $this->Product_cats->get_value(array("conditions"=>"id = '$id_cat'","fields"=>"name"));
				//$array_cat_name = $this->Product_cats->find("all", array("conditions"=>"id = '$id_cat'"));
				
				//$songay = $array
				$month = $array_production["month"];
				//chuyển chuỗi ngày định dạng d-m-y thành Y-m-d
				$array_production["month"] = date("Y-m-d",strtotime("01-".$array_production["month"]));
								
				$songay = $array_production["songay"];
				
				$total = 0;
				
				
				//$total = $array_production["day_1"] + $array_production["day_2"];
				for($i=1; $i<=$songay; $i++)
				{
					if(isset($array_production["day_$i"])) 
					{
						$array_production["day_$i"] = str_replace(",", "", $array_production["day_$i"]);
						$total += $array_production["day_$i"]; 
					}
				}
				
				$array_production["total"] = $total;
				
				
				$this->Delivery_plan->save($array_production);
				
				$this->redirect("/production/add_delivery.html?id_factory=$id_factory&id_manufactory=$id_manufactory&id_cat=$id_cat&id_product=$id_product&month=$month");
			}
			
			//sửa
			$array_edit_delivery = NULL;
			if($id_delivery!="")
			{
				$array_edit_delivery = $this->Delivery_plan->find("all", array("conditions"=>"id = '$id_delivery'"));
			}		
			
			//lấy danh mục
		
			$array_factory = $this->Factory->find("all", array("fields"=>"id, name"));
			
			$array_factory = array(""=>array("id"=>"", "name"=>"Chọn nhà máy")) + $array_factory;
			
			$array_product_cat = $this->Product_cats->find("all", array("fields"=>"id, name"));
			
			$array_product_cat = array(""=>array("id"=>"", "name"=>"Chọn dòng sản phẩm")) + $array_product_cat;
			
			$array_customer = $this->Customer->find("all", array("fields"=>"id, concat(code,' - ', fullname) as fullname"));
			
			
			$dk = "";
			$id_cat = "";
			
			//lấy id đầu tiên của dòng sản phẩm cho giá trị mặc định id_cat
			//if($array_product_cat) $id_cat = $array_product_cat[0]["id"];
			
			//nếu có id_cat từ form submit lên thì lấy
			if (isset($_GET["id_cat"]) && $_GET["id_cat"] != "")  $id_cat = $_GET["id_cat"];
		
			$dk = " `id_cat` = '$id_cat'";
			//echo $dk;
			//echo "hello";
			$id_factory = "";
			
			//kiểm tra trên trình duyệt có id_factory truyền lên và khác rỗng không
			if (isset($_GET["id_factory"]) && $_GET["id_factory"] != "") 	$id_factory = $_GET["id_factory"];
				//echo "id_factory".$id_factory;
			if($dk!="")	$dk .= " AND ";
				
			$dk .= "`id_factory` = '$id_factory'";
				//echo $dk;
				
			
			
			$id_manufactory = "";
	
			if (isset($_GET["id_manufactory"]) && $_GET["id_manufactory"] != "") $id_manufactory = $_GET["id_manufactory"];

			if($dk!="")	$dk .= " AND ";
			$dk .= "`id_manufactory` = '$id_manufactory'";
				//echo $dk;
			

			
			//lấy tháng hiện tại
			$month = date("m-Y");
			
			if(isset($_GET["month"]))
			{
				$month = $_GET["month"];
			}
			
				//nối thêm ngày 01 đầu tiên để trở thành 01-m-Y
			$thang_hientai = "01-".$month;
			
			//lấy ngày cuối cùng trong tháng
			$songay = date("t",strtotime($thang_hientai));
			
			$array_product = $this->Product->find("all", array("conditions"=>"id_cat = '$id_cat'", "fields"=>"id, concat(code,' - ', name) as name"));
			//$array_product = array(""=>array("id"=>"", "name"=>"Chọn sản phẩm")) + $array_product;
			
			//$dk_id_factory để đưa vào truy vấn bảng Manufactory theo id_factory = $id_factory
			$dk_id_factory = "id_factory = '$id_factory'";
			
			$array_manufactory = $this->Manufactory->find("all", array("conditions"=>$dk_id_factory ,"fields"=>"id, name"));
			
			//$array_manufactory = array(""=>array("id"=>"", "name"=>"Chọn xưởng")) + $array_manufactory ;
			
				
			//sửa
			$array_delivery = $this->Delivery_plan->find("all", array("conditions"=>$dk, "order"=>"product_name ASC"));
			
			//$array_product_code = $this->Product->find("all", array("conditions"=>$dk));
			
			$array_param = array("array_factory"=>$array_factory,
								 "array_manufactory"=>$array_manufactory,
								 "array_product_cat"=>$array_product_cat,
								 "array_product"=>$array_product,
								 "array_customer"=>$array_customer,
								 "array_delivery"=>$array_delivery,
								 "id_cat"=>$id_cat,
								 "id_factory"=>$id_factory,
								 "id_manufactory"=>$id_manufactory,
								 "month"=>$month,
								 "songay"=>$songay,
								 "array_edit_delivery"=>$array_edit_delivery
							);
			
			$html = $this->View->render("add_delivery_production.php", $array_param);
			echo $html;
		}
		
		function del_delivery($id="")
		{
			
			if($id!="")
			{
				$this->loadModel("Delivery_plan", "delivery_plans");
				
				//lấy thông tin delivery trước khi xóa
				$array_delivery = $this->Delivery_plan->find("all", array("conditions"=>"id = '$id'"));
				
				if($array_delivery)
				{
					$id_factory = $array_delivery[0]["id_factory"];
					
					$id_manufactory = $array_delivery[0]["id_manufactory"];
					
					$id_cat = $array_delivery[0]["id_cat"];
					
					$id_product = $array_delivery[0]["id_product"];
					
					//chuyển chuỗi ngày tháng về kiểu datetime
					$month = strtotime($array_delivery[0]["month"]);
					
					//lấy chuỗi ngày tháng định dạng m-Y
					$month = date("m-Y", $month);
					
					$this->Delivery_plan->delete($id);
				
					$this->redirect("/production/add_delivery.html?id_factory=$id_factory&id_manufactory=$id_manufactory&id_cat=$id_cat&id_product=$id_product&month=$month");
				}
				
				
			}
			
		}
		
		function delivery()
		{
			$this->loadModel("Factory", "factorys");
			$this->loadModel("Manufactory", "manufactorys");
			$this->loadModel("Product_cats", "product_cats");
			$this->loadModel("Product", "products");
			$this->loadModel("Customer", "customers");
			$this->loadModel("Delivery_plan", "delivery_plans");
			
			//lấy danh mục
		
			$array_factory = $this->Factory->find("all", array("fields"=>"id, name"));
			
			//Thêm phần tử của mảng đầu tiên array_factory
			$array_factory  = array(""=>array("id"=>"","name"=>"..."))+ $array_factory;
			
			
			$array_manufactory = $this->Manufactory->find("all", array("fields"=>"id, name"));
			
			//Thêm phần tử của mảng đầu tiên array_factory
			$array_manufactory  = array(""=>array("id"=>"","name"=>"..."))+ $array_manufactory;
			
			$array_product_cat = $this->Product_cats->find("all", array("fields"=>"id, name"));
			
			//Thêm phần tử của mảng đầu tiên array_factory
			$array_product_cat  = array(""=>array("id"=>"","name"=>"..."))+ $array_product_cat;
			
			//$array_customer = $this->Customer->find("all", array("fields"=>"id, concat(code,' - ', name) as name"));
			
			
			$dk = "";
			$id_cat = "";
			
			//lấy id đầu tiên của dòng sản phẩm cho giá trị mặc định id_cat
			//if($array_product_cat) $id_cat = $array_product_cat[0]["id"];
			
			//nếu có id_cat từ form submit lên thì lấy
			if (isset($_GET["id_cat"]) && $_GET["id_cat"] != "")  $id_cat = $_GET["id_cat"];
			
			if($id_cat!="")$dk = " `id_cat` = '$id_cat'";
			

			//Begin: điều kiện theo nhà máy
			$id_factory = "";
			
			//kiểm tra trên trình duyệt có id_factory truyền lên và khác rỗng không
			if (isset($_GET["id_factory"]) && $_GET["id_factory"] != "")$id_factory = $_GET["id_factory"];
				
			//nếu id_factory rỗng thì tìm theo id_factory
			if($id_factory!="")
			{
				if($dk!="")	$dk .= " AND ";
				$dk .= "`id_factory` = '$id_factory'";
				//echo $dk;
			}
			//End: điều kiện theo nhà máy
			
			//Begin: điều kiện theo xưởng
			$id_manufactory = "";
			
			if (isset($_GET["id_manufactory"]) && $_GET["id_manufactory"] != "") $id_manufactory = $_GET["id_manufactory"];
			
			if($id_manufactory!="")
			{
				if($dk!="")$dk .= " AND ";

				$dk .= "`id_manufactory` = '$id_manufactory'";
				//echo $dk;
			}
			//End: điều kiện theo xưởng
			
			//Begin: điều kiện theo sản phẩm
			$id_product = "";
	
			if (isset($_GET["id_product"]) && $_GET["id_product"] != "") $id_product = $_GET["id_product"];
			
			if($id_product!="")
			{
				if($dk!="")$dk .= " AND ";

				$dk .= "`id_product` = '$id_product'";

			}
			//End: điều kiện theo sản phẩm
						

			
			//lấy tháng hiện tại
			$month = date("m-Y");
			
			if(isset($_GET["month"]))
			{
				
				$month = $_GET["month"];
			}
			
			//nối thêm ngày 01 đầu tiên để trở thành 01-m-Y
			$thang_hientai = "01-".$month;
			$thang_hientai = date("Y-m-d",strtotime($thang_hientai));
			if($thang_hientai != "")
			{
				if($dk != "") $dk .= " AND ";
				$dk .= " `month` = '$thang_hientai'";
			}
			
			//lấy ngày cuối cùng trong tháng
			$songay = date("t",strtotime($thang_hientai));
			
			//$array_product = $this->Product->find("all", array("conditions"=>"id_cat = '$id_cat'", "fields"=>"id, concat(code,' - ', name) as name"));

			$array_delivery = $this->Delivery_plan->find("all", array("conditions"=>$dk,"order"=>"id DESC"));
			
			//$array_product_code = $this->Product->find("all", array("conditions"=>$dk));
			
			$array_param = array("array_factory"=>$array_factory,
								 "array_manufactory"=>$array_manufactory,
								 "array_product_cat"=>$array_product_cat,
								 "array_delivery"=>$array_delivery,
								 "id_cat"=>$id_cat,
								 "id_factory"=>$id_factory,
								 "id_manufactory"=>$id_manufactory,
								 "id_product"=>$id_product,
								 "month"=>$month,
								 "songay"=>$songay
							);
			
			
			
			$html = $this->View->render("delivery_production.php", $array_param);
			echo $html;
		}
		
		function add_plan_month($id_plan_month="")
		{
			$this->loadModel("Factory", "factorys");
			$this->loadModel("Manufactory", "manufactorys");
			$this->loadModel("Product_cats", "product_cats");
			$this->loadModel("Product", "products");
			$this->loadModel("Customer", "customers");
			$this->loadModel("Plan_month", "plan_months");
			
			if(isset($_POST["production"]))
			{
				$array_production = $_POST["production"];
				
				$id_product = $array_production["id_product"];
				
				$id_customer = $array_production["id_customer"];
				
				$id_factory = $array_production["id_factory"];

				$id_manufactory = $array_production["id_manufactory"];
				
				$id_cat = $array_production["id_cat"];
									
				$array_production["product_name"] = $this->Product->get_value(array("conditions"=>"id = '$id_product'","fields"=>"name"));
				
				$array_production["customer_name"] = $this->Customer->get_value(array("conditions"=>"id = '$id_customer'","fields"=>"fullname"));
				
				$array_production["factory_name"] = $this->Factory->get_value(array("conditions"=>"id = '$id_factory'","fields"=>"name"));
				//$array_factory_name = $this->Factory->find("all", array("conditions"=>"id = '$id_factory'"));
				
				$array_production["manufactory_name"] = $this->Manufactory->get_value(array("conditions"=>"id = '$id_manufactory'","fields"=>"name"));
				//$array_manufactory_name = $this->Manufactory->find("all", array("conditions"=>"id = '$id_manufactory'"));
				
				$array_production["cat_name"] = $this->Product_cats->get_value(array("conditions"=>"id = '$id_cat'","fields"=>"name"));
				//$array_cat_name = $this->Product_cats->find("all", array("conditions"=>"id = '$id_cat'"));
				
				//$songay = $array
				$month = $array_production["month"];
				//chuyển chuỗi ngày định dạng d-m-y thành Y-m-d
				$array_production["month"] = date("Y-m-d",strtotime("01-".$array_production["month"]));
								
				$songay = $array_production["songay"];
				
				$total = 0;
				
				
				//$total = $array_production["day_1"] + $array_production["day_2"];
				for($i=1; $i<=$songay; $i++)
				{
					if(isset($array_production["day_$i"])) 
					{
						$array_production["day_$i"] = str_replace(",", "", $array_production["day_$i"]);
						$total += $array_production["day_$i"]; 
					}
				}
				
				$array_production["total"] = $total;
				
				$this->Plan_month->save($array_production);
				
				$this->redirect("/production/add_plan_month.html?id_factory=$id_factory&id_manufactory=$id_manufactory&id_cat=$id_cat&id_product=$id_product&month=$month");
			}
			
			//sửa
			$array_edit_plan_month = NULL;
			if($id_plan_month!="")
			{
				$array_edit_plan_month = $this->Plan_month->find("all", array("conditions"=>"id = '$id_plan_month'"));
			}		
			
			
			//lấy danh mục
		
			$array_factory = $this->Factory->find("all", array("fields"=>"id, name"));
			$array_factory = array(""=>array("id"=>"", "name"=>"Chọn nhà máy")) + $array_factory;
			
			$array_product_cat = $this->Product_cats->find("all", array("fields"=>"id, name"));
			$array_product_cat = array(""=>array("id"=>"", "name"=>"Chọn dòng sản phẩm")) + $array_product_cat;
			
			$array_customer = $this->Customer->find("all", array("fields"=>"id, concat(code,' - ', fullname) as fullname"));
			
			
			$dk = "";
			$id_cat = "";
			
			//lấy id đầu tiên của dòng sản phẩm cho giá trị mặc định id_cat
			//if($array_product_cat) $id_cat = $array_product_cat[0]["id"];
			
			//nếu có id_cat từ form submit lên thì lấy
			if (isset($_GET["id_cat"]) && $_GET["id_cat"] != "")  $id_cat = $_GET["id_cat"];
		
			$dk = " `id_cat` = '$id_cat'";
			//echo $dk;
			//echo "hello";
			$id_factory = "";
			
			//kiểm tra trên trình duyệt có id_factory truyền lên và khác rỗng không
			if (isset($_GET["id_factory"]) && $_GET["id_factory"] != "") {
				$id_factory = $_GET["id_factory"];
				//echo "id_factory".$id_factory;
				if($dk!="")	
				{
					$dk .= " AND ";
				}
				$dk .= "`id_factory` = '$id_factory'";
				//echo $dk;
				
			}
			
			$id_manufactory = "";
	
			if (isset($_GET["id_manufactory"]) && $_GET["id_manufactory"] != "") {
				$id_manufactory = $_GET["id_manufactory"];
				if($dk!="")
				{
					$dk .= " AND ";
					
				}
				$dk .= "`id_manufactory` = '$id_manufactory'";
				//echo $dk;

			}
			
			$id_product = "";
	
			if (isset($_GET["id_product"]) && $_GET["id_product"] != "") {
				$id_product = $_GET["id_product"];
				if($dk!="")
				{
					$dk .= " AND ";
					
				}
				$dk .= "`id_product` = '$id_product'";
				//echo $dk;

			}
			

			
			//lấy tháng hiện tại
			$month = date("m-Y");
			
			if(isset($_GET["month"]))
			{
				$month = $_GET["month"];
			}
			
				//nối thêm ngày 01 đầu tiên để trở thành 01-m-Y
			$thang_hientai = "01-".$month;
			
			//lấy ngày cuối cùng trong tháng
			$songay = date("t",strtotime($thang_hientai));
			
			$array_product = $this->Product->find("all", array("conditions"=>"id_cat = '$id_cat'", "fields"=>"id, concat(code,' - ', name) as name"));
			
			//$dk_id_factory để đưa vào truy vấn bảng Manufactory theo id_factory = $id_factory
			$dk_id_factory = "id_factory = '$id_factory'";
			
			$array_manufactory = $this->Manufactory->find("all", array("conditions"=>$dk_id_factory ,"fields"=>"id, name"));
			
			//sửa
			$array_delivery = $this->Plan_month->find("all", array("conditions"=>$dk, "order"=>"product_name ASC"));
			
			//$array_product_code = $this->Product->find("all", array("conditions"=>$dk));
			
			$array_param = array("array_factory"=>$array_factory,
								 "array_manufactory"=>$array_manufactory,
								 "array_product_cat"=>$array_product_cat,
								 "array_product"=>$array_product,
								 "array_customer"=>$array_customer,
								 "array_delivery"=>$array_delivery,
								 "id_cat"=>$id_cat,
								 "id_factory"=>$id_factory,
								 "id_manufactory"=>$id_manufactory,
								 "id_product"=>$id_product,
								 "month"=>$month,
								 "songay"=>$songay,
								 "array_edit_plan_month"=>$array_edit_plan_month
							);
			
			$html = $this->View->render("add_plan_month_production.php", $array_param);
			echo $html;
		}
		
		function plan_month()
		{
			$this->loadModel("Factory", "factorys");
			$this->loadModel("Manufactory", "manufactorys");
			$this->loadModel("Product_cats", "product_cats");
			$this->loadModel("Product", "products");
			$this->loadModel("Customer", "customers");
			$this->loadModel("Plan_month", "plan_months");
			
			//lấy danh mục
		
			$array_factory = $this->Factory->find("all", array("fields"=>"id, name"));
			
			//Thêm phần tử của mảng đầu tiên array_factory
			$array_factory  = array(""=>array("id"=>"","name"=>"..."))+ $array_factory;
			
			$array_manufactory = $this->Manufactory->find("all", array("fields"=>"id, name"));
			
			//Thêm phần tử của mảng đầu tiên array_manufactory
			$array_manufactory  = array(""=>array("id"=>"","name"=>"..."))+ $array_manufactory;
			
			$array_product_cat = $this->Product_cats->find("all", array("fields"=>"id, name"));
			
			//Thêm phần tử của mảng đầu tiên array_manufactory
			$array_product_cat  = array(""=>array("id"=>"","name"=>"..."))+ $array_product_cat;
			
			//$array_customer = $this->Customer->find("all", array("fields"=>"id, concat(code,' - ', name) as name"));
			
			
			$dk = "";
			$id_cat = "";
			
			//lấy id đầu tiên của dòng sản phẩm cho giá trị mặc định id_cat
			//if($array_product_cat) $id_cat = $array_product_cat[0]["id"];
			
			//nếu có id_cat từ form submit lên thì lấy
			if (isset($_GET["id_cat"]) && $_GET["id_cat"] != "")  $id_cat = $_GET["id_cat"];
			
			if($id_cat!="")$dk = " `id_cat` = '$id_cat'";
			

			//Begin: điều kiện theo nhà máy
			$id_factory = "";
			
			//kiểm tra trên trình duyệt có id_factory truyền lên và khác rỗng không
			if (isset($_GET["id_factory"]) && $_GET["id_factory"] != "")$id_factory = $_GET["id_factory"];
				
			//nếu id_factory rỗng thì tìm theo id_factory
			if($id_factory!="")
			{
				if($dk!="")	$dk .= " AND ";
				$dk .= "`id_factory` = '$id_factory'";
				//echo $dk;
			}
			//End: điều kiện theo nhà máy
			
			//Begin: điều kiện theo xưởng
			$id_manufactory = "";
			
			if (isset($_GET["id_manufactory"]) && $_GET["id_manufactory"] != "") $id_manufactory = $_GET["id_manufactory"];
			
			if($id_manufactory!="")
			{
				if($dk!="")$dk .= " AND ";

				$dk .= "`id_manufactory` = '$id_manufactory'";
				//echo $dk;
			}
			//End: điều kiện theo xưởng
			
			//Begin: điều kiện theo sản phẩm
			$id_product = "";
	
			if (isset($_GET["id_product"]) && $_GET["id_product"] != "") $id_product = $_GET["id_product"];
			
			if($id_product!="")
			{
				if($dk!="")$dk .= " AND ";

				$dk .= "`id_product` = '$id_product'";

			}
			//End: điều kiện theo sản phẩm
			
			
			//lấy tháng hiện tại
			$month = date("m-Y");
			
			if(isset($_GET["month"]))
			{
				$month = $_GET["month"];
			}
			
				//nối thêm ngày 01 đầu tiên để trở thành 01-m-Y
			$thang_hientai = "01-".$month;
			
			//lấy ngày cuối cùng trong tháng
			$songay = date("t",strtotime($thang_hientai));
			
			//$array_product = $this->Product->find("all", array("conditions"=>"id_cat = '$id_cat'", "fields"=>"id, concat(code,' - ', name) as name"));

			$array_delivery = $this->Plan_month->find("all", array("conditions"=>$dk, "order"=>"cat_name, product_name ASC"));
			
			$array_param = array("array_factory"=>$array_factory,
								 "array_manufactory"=>$array_manufactory,
								 "array_product_cat"=>$array_product_cat,
								 "array_delivery"=>$array_delivery,
								 "id_cat"=>$id_cat,
								 "id_factory"=>$id_factory,
								 "id_manufactory"=>$id_manufactory,
								 "id_product"=>$id_product,
								 "month"=>$month,
								 "songay"=>$songay
							);
			
			
			
			$html = $this->View->render("plan_month_production.php", $array_param);
			echo $html;
		}
		
		function del_plan_month($id="")
		{
			
			if($id!="")
			{
				$this->loadModel("Plan_month", "plan_months");
				
				//lấy thông tin delivery trước khi xóa
				$array_delivery = $this->Plan_month->find("all", array("conditions"=>"id = '$id'"));
				
				if($array_delivery)
				{
					$id_factory = $array_delivery[0]["id_factory"];
					
					$id_manufactory = $array_delivery[0]["id_manufactory"];
					
					$id_cat = $array_delivery[0]["id_cat"];
					
					$id_product = $array_delivery[0]["id_product"];
					
					//chuyển chuỗi ngày tháng về kiểu datetime
					$month = strtotime($array_delivery[0]["month"]);
					
					//lấy chuỗi ngày tháng định dạng m-Y
					$month = date("m-Y", $month);
					
					$this->Plan_month->delete($id);
				
					$this->redirect("/production/add_plan_month.html?id_factory=$id_factory&id_manufactory=$id_manufactory&id_cat=$id_cat&id_product=$id_product&month=$month");
				}
			}
		}
		
		function add_data($id_production_plan="", $id="")
		{
			$this->loadModel("ProductionPlanDetail", "production_plan_detail");
			$this->loadModel("ProductionPlanData", "production_plan_datas");
			
			if(isset($_POST["data"]))
			{
				$array_data = $_POST["data"];
				
				foreach($array_data as $data)
				{
					$data["id_production_plan"] = $id_production_plan;
					
					//print_r($data);
					
					$this->ProductionPlanData->save($data);
				}
				
				$this->redirect("/production/data/$id_production_plan.html");
			}
			
			//sửa
			//kiểm tra có id thì sửa
			if($id!="")
			{
				$array_edit_production_plan_data = $this->ProductionPlanData->find("all", array("conditions"=>"id = '$id'"));
				$html_result = $this->View->render("edit_production_plan_data.php", array("array_edit_production_plan_data"=>$array_edit_production_plan_data,"id_production_plan"=>$id_production_plan));
				echo $html_result;
			
			}
			
			//truy vấn sql
			$str_col_detail = "id, id_product, product, id_machine, machine, product_code";
			$sql_production_detail = "SELECT $str_col_detail FROM `scm_production_plan_detail` WHERE `id_production_plan`='$id_production_plan'";
			
			$str_col_data = "id_production_detail, product AS product_machine";
			$sql_production_data = "SELECT $str_col_data FROM scm_production_plan_datas";
			
			$sql_production_plan_data = "SELECT A.*, B.* FROM ($sql_production_detail) AS A LEFT JOIN ($sql_production_data) AS B ON A.id = B.id_production_detail WHERE B.id_production_detail IS NULL";
			
			$array_production_plan_detail = $this->ProductionPlanDetail->query($sql_production_plan_data);
			
			//$array_production_plan_detail = $this->ProductionPlanDetail->find("all", array("conditions"=>"id_production_plan = '$id_production_plan'"));
			
			$array_param = array("array_production_plan_detail"=>$array_production_plan_detail,
									"id_production_plan"=>$id_production_plan,
								);
			
			$html = $this->View->render("add_data_production.php", $array_param);
			echo $html;
		}
		
		function data($id_production_plan="")
		{
			$this->loadModel("ProductionPlanData", "production_plan_datas");
			
			$array_production_data = $this->ProductionPlanData->find("all", array("conditions"=>"id_production_plan = '$id_production_plan'"));
			
			$array_param = array("array_production_data"=>$array_production_data);
			
			$html = $this->View->render("data_production.php", $array_param);
			
			echo $html;
		}
		
		function del_data($id="")
		{
			$this->loadModel("ProductionPlanData", "production_plan_datas");
			
			$array_production_data = $this->ProductionPlanData->find("all", array("conditions"=>"id = '$id'"));
			
			if($id!="")
			{
				$id_production_plan = $array_production_data[0]["id_production_plan"];
				
				$this->ProductionPlanData->delete($id);
				
				$this->redirect("/production/data/$id_production_plan.html");
			}
			
		}
		
		function report()
		{
			$this->loadModel("Manufactory", "manufactorys");
			$this->loadModel("Group", "groups");
			$this->loadModel("Shift", "shift");
			
			
			//BEGIN: BÁO CÁO THEO ĐIỀU KIỆN
			
			
			//END: BÁO CÁO THEO ĐIỀU KIỆN
			
			
			//lấy thông tin
			$array_manufactory = $this->Manufactory->find("all", array("fields"=>"id, name"));
			$array_manufactory = array(""=>array("id"=>"", "name"=>"Chọn xưởng")) + $array_manufactory;
			
			$array_group = $this->Group->find("all", array("fields"=>"id, name"));
			$array_group = array(""=>array("id"=>"", "name"=>"Chọn tổ")) + $array_group;
			
			$array_shift = $this->Shift->find("all", array("fields"=>"id, name"));
			$array_shift = array(""=>array("id"=>"", "name"=>"Chọn ca")) + $array_shift;
			
			$array_parram = array("array_manufactory"=>$array_manufactory,
									"array_group"=>$array_group,
									"array_shift"=>$array_shift
								);
			
			$html = $this->View->render("report_production.php", $array_parram);
			echo $html;
		}
		
		function report2()
		{
			$this->loadModel("Manufactory", "manufactorys");
			$this->loadModel("Group", "groups");
			$this->loadModel("Shift", "shift");
			
			
			//BEGIN: BÁO CÁO THEO ĐIỀU KIỆN
			
			
			//END: BÁO CÁO THEO ĐIỀU KIỆN
			
			
			//lấy thông tin
			$array_manufactory = $this->Manufactory->find("all", array("fields"=>"id, name"));
			$array_manufactory = array(""=>array("id"=>"", "name"=>"Chọn xưởng")) + $array_manufactory;
			
			$array_group = $this->Group->find("all", array("fields"=>"id, name"));
			$array_group = array(""=>array("id"=>"", "name"=>"Chọn tổ")) + $array_group;
			
			$array_shift = $this->Shift->find("all", array("fields"=>"id, name"));
			$array_shift = array(""=>array("id"=>"", "name"=>"Chọn ca")) + $array_shift;
			
			$array_parram = array("array_manufactory"=>$array_manufactory,
									"array_group"=>$array_group,
									"array_shift"=>$array_shift
								);
			
			$html = $this->View->render("report_demo.php", $array_parram);
			echo $html;
		}
			
		function user_production()
		{
			$this->loadModel("User2","users");
			$this->loadModel("Group","groups");
			$this->loadModel("Shift","shift");
			$this->loadModel("Manufactory","manufactorys");
			
			//lấy tháng hiện tại
			$month = date("m-Y");
			if(isset($_GET["month"]) && $_GET["month"] != "") $month = $_GET["month"];
			
			//nối thêm ngày 01 đầu tiên để trở thành 01-m-Y
			$start_month = "01-".$month;
			$start_month = date("Y-m-d",strtotime($start_month));
			
			$id_manufactory = "";
			if(isset($_GET["id_manufactory"]) && $_GET["id_manufactory"] != "")
			{
				$id_manufactory = $_GET["id_manufactory"];
			}
			
			$id_group = "";
			if(isset($_GET["id_group"]) && $_GET["id_group"] != "")
			{
				$id_group = $_GET["id_group"];
			}
			
			$id_shift = "";
			if(isset($_GET["id_shift"]) && $_GET["id_shift"] != "")
			{
				$id_shift = $_GET["id_shift"];
			}
			
			//lấy ngày cuối cùng trong tháng
			$songay = date("t",strtotime($month));
			$last_month = date("Y-m-t",strtotime($start_month));
			
			$dieukien_chamcong = "";
			if($month != "")
			{
				$dieukien_chamcong = "`day` >= '$start_month' AND `day` <= '$last_month'";
			}
			if($id_shift != "")
			{
				if($dieukien_chamcong != "") $dieukien_chamcong .= " AND ";
				$dieukien_chamcong .= "shift = '$id_shift'";
			}
			
			//BEGIN: Lấy tham số act khi ajax request lên server, để trả về nhân viên vắng trong ngày
			$act = "";
			if(isset($_GET["act"])) $act = $_GET["act"];
			
			if($act == "show_vang")
			{
				$this->loadModel("Chamcong","chamcong");
				$str_user = "";
				$id_user_group = $_GET['id_group'];
				$day = $_GET['day'];
				
				//begin: kiem tra ngay chu nhat
				$timestamp = strtotime($day);
				$weekday= date("l", $timestamp );
				$normalized_weekday = strtolower($weekday);
				//echo $normalized_weekday ;
				$check = false;
				if ($normalized_weekday == "sunday") {
				$check = true;
				} else {
				$check = false;
				}
				//end: kiem tra ngay chu nhat
				$dk_user_vang = "";
				if($id_user_group != "" && $day != "") 
				{
					//if($check) $dk_user_vang = "id_group = '$id_user_group' AND day='$day' AND hour = '0' AND status='1'";
					//else 
						$dk_user_vang = "id_group = '$id_user_group' AND day='$day' AND hour = '0' AND status='1' ";
				}
				$array_chamcong_vang = $this->Chamcong->find("all",array("fields"=>"user_fullname, user_code","conditions"=>$dk_user_vang));
				if($array_chamcong_vang)
				{
					foreach($array_chamcong_vang as $user)
					{
						$str_user .= $user["user_fullname"]."(".$user["user_code"]."); \n";
					}
				}
				$day = date("d-m-Y",strtotime($day));
				$group_name = $this->Group->get_value(array("fields"=>"name","conditions"=>"id='$id_user_group'"));
				$str_user = "Danh sách vắng ngày: $day - Tổ: $group_name \n".$str_user;
				echo $str_user;
				return;
			}
			//END: lấy tham số act khi ajax request lên server, để trả về nhân viên vắng trong ngày
			
				/*
				$sql_group = "SELECT id AS id_groups, name FROM scm_groups";	
				$sql_col_chamcong = "id_group, day";
				$sql_col_chamcong .= ", SUM(case when `hour` > 0  AND status = '1' then 1 else 0 end) AS hiendien";
				$sql_col_chamcong .= ", SUM(case when `hour` = 0 AND status = '1' then 1 else 0 end) AS vang";
				$sql_col_chamcong .= ", SUM(case when  status = '1' then 1 else 0 end) AS siso";
				//$sql_col_chamcong .= ", SUM(case when `hour`>0 AND status = '1' OR `day_type` = 'CN' then 1 else 0 end) AS hiendien_CN";
				//$sql_col_chamcong .= ", SUM(case when `hour`= 0 OR status = '1' then 1 else 0 end) AS vang_CN";
				$sql_chamcong = "SELECT $sql_col_chamcong FROM scm_chamcong GROUP BY id_group, day";	
				//$sql_chamcong = "SELECT * FROM scm_chamcong $dieukien_chamcong ";
				// , (ifnull(vang, 0) + ifnull(hiendien, 0)) AS siso, (ifnull(vang_CN, 0) + ifnull(hiendien_CN, 0)) AS siso_CN
				$sql_tonghop = "SELECT A.*,B.*, concat(A.id_groups,'_',B.day) as id_day FROM ($sql_group) AS A LEFT JOIN ($sql_chamcong) AS B ON A.id_groups = B.id_group ";
				//echo $sql_tonghop;
				*/
				
				$dk_tong_ns = "";
				if($id_group != "") $dk_tong_ns = " WHERE id_group = '$id_group'";
				
				//lấy tổng sĩ số nhân sự
				if(isset($_GET["request"]) && $_GET["request"] =="nhansu" )
				{
					//$sql_tong_nhansu = "SELECT day, SUM(case when status='1' then 1 else 0 end) AS nhansu FROM `scm_chamcong` $dk_tong_ns GROUP BY day";
					$sql_tong_nhansu = "SELECT day, SUM(case when status='1' then 1 else 0 end) AS nhansu, SUM(case when status='1' AND (hour=0 OR hour IS NULL) then 1 else 0 end) AS tong_vang, SUM(case when status='1' AND hour>0 then 1 else 0 end) AS tong_hiendien FROM `scm_chamcong` $dk_tong_ns GROUP BY day";
					
					$array_nhansu = $this->DB->query($sql_tong_nhansu);
					
					$str_json = json_encode($array_nhansu);
					if($array_nhansu)
					echo $str_json;
					return;	
				}
				
				//lấy dữ liệu hiện diện và vắng của các tổ
				if(isset($_GET["request"]) && $_GET["request"] =="ajax" )
				{
					$sql_group = "SELECT id AS id_groups, name FROM scm_groups";
					
					$sql_col_chamcong = "id_group, day";
					$sql_col_chamcong = "id_group, day";
					$sql_col_chamcong .= ", SUM(case when `hour` > 0  AND status = '1' then 1 else 0 end) AS hiendien";
					$sql_col_chamcong .= ", SUM(case when `hour` = 0 AND status = '1' then 1 else 0 end) AS vang";
					$sql_col_chamcong .= ", SUM(case when  status = '1' then 1 else 0 end) AS siso";
					
					$sql_chamcong = "SELECT $sql_col_chamcong FROM scm_chamcong GROUP BY id_group, day";
					
					//$sql_chamcong = "SELECT * FROM scm_chamcong $dieukien_chamcong ";
					// , (ifnull(vang, 0) + ifnull(hiendien, 0)) AS siso, (ifnull(vang_CN, 0) + ifnull(hiendien_CN, 0)) AS siso_CN
					$sql_tonghop = "SELECT A.*,B.*, concat(A.id_groups,'_',B.day) as id_day FROM ($sql_group) AS A LEFT JOIN ($sql_chamcong) AS B ON A.id_groups = B.id_group ";
					
					//echo $sql_tonghop;
					$array_chamcong = $this->DB->query($sql_tonghop);
					//$array_chamcong = $this->User2->query($sql_tonghop_chamcong);
					$str_json = json_encode($array_chamcong);
				
					echo $str_json;
					return;	
				}
				
				/********************************************************************************************************************************/
				/*                                                 BEGIN: BÁO CÁO NĂNG SUẤT SẢN XUẤT*/
				/********************************************************************************************************************************/
				//Lấy thời gian làm việc cho tab báo cáo năng suất sản xuất
				if(isset($_GET["request"]) && $_GET["request"] =="thoigian_lamviec" )
				{
					$sql_thoigian_lamviec = "SELECT A.*, B.*, concat(A.id_groups,'_',B.day) as id_day FROM (SELECT id AS id_groups, name FROM scm_groups) AS A LEFT JOIN (SELECT id_group,day, SUM(hour) AS thoigian_lamviec FROM `scm_chamcong` GROUP BY id_group,day) AS B ON A.id_groups = B.id_group";
					
					$array_thoigian_lamviec = $this->DB->query($sql_thoigian_lamviec);
					
					$str_json = json_encode($array_thoigian_lamviec);
					if($array_thoigian_lamviec)
					echo $str_json;
					return;	
				}
				
				//lấy kế hoạch sản xuất theo 
					/*
					$sql_group = "SELECT id AS id_groups, name FROM scm_groups";
					$sql_chitiet_conglenh = "SELECT id, id_product, time, day, id_group FROM scm_production_plan_detail";
					$sql_group_chitiet_cl = "SELECT A.*, B.*, CONCAT( A.id_groups,  '_', B.day ) AS id_day FROM ($sql_group) AS A LEFT JOIN ($sql_chitiet_conglenh) AS B ON A.id_groups = B.id_group";
					$sql_product_machine = "SELECT id_product AS id_product_mc, cavity, cycletime FROM scm_product_machines";
					$sql_tong_khsx = "SELECT C.*, D.*,((3600/cycletime) * cavity * time) AS soluong_sx FROM ($sql_group_chitiet_cl) AS C LEFT JOIN ($sql_product_machine) AS D ON C.id_product = D.id_product_mc";
					
					$sql_product_data_detail = "SELECT id_production_detail, num_ok, num_ng FROM scm_production_plan_datas";
					
					$sql_tong_khsx_thucte = "SELECT E.*, F.*, SUM(soluong_sx), SUM(num_ok), SUM(num_ng) FROM ($sql_tong_khsx) AS E LEFT JOIN ($sql_product_data_detail) AS F ON E.id = F.id_production_detail GROUP BY id_group, day";
					//echo $sql_tong_khsx_thucte;
				*/
				
				if(isset($_GET["request"]) && $_GET["request"] =="khsx" )
				{
					$sql_group = "SELECT id AS id_groups, name FROM scm_groups";
					$sql_chitiet_conglenh = "SELECT id, id_product, time, day, id_group FROM scm_production_plan_detail";
					$sql_group_chitiet_cl = "SELECT A.*, B.*, CONCAT( A.id_groups,  '_', B.day ) AS id_day FROM ($sql_group) AS A LEFT JOIN ($sql_chitiet_conglenh) AS B ON A.id_groups = B.id_group";
					$sql_product_machine = "SELECT id_product AS id_product_mc, cavity, cycletime FROM scm_product_machines";
					$sql_tong_khsx = "SELECT C.*, D.*,((3600/cycletime) * cavity * time) AS soluong_sx FROM ($sql_group_chitiet_cl) AS C LEFT JOIN ($sql_product_machine) AS D ON C.id_product = D.id_product_mc";
					
					$sql_product_data_detail = "SELECT id_production_detail, num_ok, num_ng FROM scm_production_plan_datas";
					
					$sql_tong_khsx_thucte = "SELECT E.*, F.*, SUM(soluong_sx) AS tong_soluong, SUM(num_ok) AS tong_numok, SUM(num_ng) AS tong_numng FROM ($sql_tong_khsx) AS E LEFT JOIN ($sql_product_data_detail) AS F ON E.id = F.id_production_detail GROUP BY id_group, day";
					$array_khsx = $this->DB->query($sql_tong_khsx_thucte);
					$str_json = json_encode($array_khsx);
					if($array_khsx)
					echo $str_json;
					return;	
				}
				
				/********************************************************************************************************************************/
				/*                                                    END: BÁO CÁO NĂNG SUẤT SẢN XUẤT*/
				/********************************************************************************************************************************/
				
				//truy vấn dữ liệu tổ từ bảng groups
				$dk_ns = "";
				if($id_group != "") $dk_ns = "id = '$id_group'";
				
				$dk_group_search = "";
				if($id_manufactory != "") $dk_group_search = "id_manufactory = '$id_manufactory'";
				
				
				$array_group_search = $this->Group->find("all",array("fields"=>"id, name","conditions"=>$dk_group_search));
				if($array_group_search) $array_group_search = array(""=>array("id"=>"","name"=>"Tổ")) + $array_group_search;
				
				$array_group = $this->Group->find("all",array("fields"=>"id, name","conditions"=>$dk_ns));
				
				$array_shift = array(""=>array("id"=>"","name"=>"Ca"));
				$array_shift += $this->Shift->find("all",array("fields"=>"id, name"));
				
				$array_manufactory = array(""=>array("id"=>"","name"=>"Xưởng"));
				$array_manufactory += $this->Manufactory->find("all",array("fields"=>"id, name"));
				//echo "Tổ:";
				//print_r($array_group);
				
				
				/********************************************************************************************************************************/
				/*                                                    BEGIN: BÁO CÁO NĂNG SUẤT TỪNG MÁY											*/
				/********************************************************************************************************************************/
				
				$this->loadModel("Machine","machines");
				
				$array_machine = $this->Machine->find("all",array("fields"=>"id, control"));
				if(isset($_GET["request"]) && $_GET["request"] =="nangsuat_may" )
				{	
					$sql_machine = "SELECT id, control, name FROM scm_machines";
					$sql_product_machine = "SELECT id_product, id_machine, machine_control, cavity, cycletime FROM scm_product_machines";
					$sql_product_join_machine = "SELECT A.*, B.* FROM ($sql_machine) AS A LEFT JOIN ($sql_product_machine) AS B ON A.id = B.id_machine";
					
					$sql_production_plan_detail = "SELECT id_machine AS id_machine_detail, id_product AS id_product_detail, product, product_code, time, day, id AS id_production_detail FROM scm_production_plan_detail";
					$sql_tonghop_product_tion_detail = "SELECT C.*, D.*, concat(C.id,'_',D.day) AS id_day, ((3600/cycletime) * cavity * time) AS soluong_sx FROM ($sql_product_join_machine) AS C LEFT JOIN ($sql_production_plan_detail) AS D ON C.id_product = D.id_product_detail AND C.id_machine = D.id_machine_detail WHERE id_product_detail IS NOT NULL";
					
					$sql_production_plan_data = "SELECT id_production_detail, id_machine AS id_machine_data, id_product AS id_product_data, time_data, num_ok, num_ng FROM scm_production_plan_datas";
					
					$sql_tonghop_product_tion_detail_data = "SELECT E.*, F.* FROM ($sql_tonghop_product_tion_detail) AS E LEFT JOIN ($sql_production_plan_data) AS F ON E.id_production_detail = F.id_production_detail";
					$array_nangsua_may = null;
					$array_nangsua_may = $this->DB->query($sql_tonghop_product_tion_detail_data);
					$str_json = json_encode($array_nangsua_may);
					if($array_nangsua_may)
					echo $str_json;
					return;
				}
				
				/********************************************************************************************************************************/
				/*                                                    END: BÁO CÁO NĂNG SUẤT TỪNG MÁY											*/
				/********************************************************************************************************************************/
				$array_param = array(
					"array_group"=>$array_group,
					"array_group_search"=>$array_group_search,
					"array_shift"=>$array_shift,
					"array_manufactory"=>$array_manufactory,
					"songay"=>$songay,
					"month"=>$month,
					"id_group"=>$id_group,
					"id_manufactory"=>$id_manufactory,
					"array_machine"=>$array_machine
				);
				$html = $this->View->render("report_user_group.php",$array_param);
				echo $html;
			//}//END: else
			
			
		}
		
		function productivity()
		{
			$this->loadModel("Manufactory","manufactorys");
			$this->loadModel("Group","groups");
			
			//lấy tháng hiện tại
			$month = date("m-Y");
			
			if(isset($_GET["month"]))
			{
				$month = $_GET["month"];
			}
			
			//nối thêm ngày 01 đầu tiên để trở thành 01-m-Y
			$thang_hientai = "01-".$month;
			
			//lấy ngày cuối cùng trong tháng
			$songay = date("t",strtotime($thang_hientai));
			
			//BEGIN: truy vấn đưa ra selectbox tìm kiếm
			$array_manufactory = array(""=>array("id"=>"","name"=>"Chọn xưởng"));
			$array_manufactory += $this->Manufactory->find("all",array("fields"=>"id, name"));
			
			$array_group = array(""=>array("id"=>"","name"=>"Chọn tổ"));
			$array_group += $this->Group->find("all",array("fields"=>"id, name"));
			
			//END: truy vấn đưa ra selectbox tìm kiếm
			
			$array_parram = array(
				"month"=>$month,
				"songay"=>$songay,
				"array_manufactory"=>$array_manufactory,
				"array_group"=>$array_group
				);
			
			$html = $this->View->render("productivity.php", $array_parram);
			echo $html;
		}
		
		function quality()
		{
			//lấy tháng hiện tại
			$month = date("m-Y");
			
			if(isset($_GET["month"]))
			{
				$month = $_GET["month"];
			}
			
				//nối thêm ngày 01 đầu tiên để trở thành 01-m-Y
			$thang_hientai = "01-".$month;
			
			//lấy ngày cuối cùng trong tháng
			$songay = date("t",strtotime($thang_hientai));
			
			$array_parram = array("month"=>$month,
									"songay"=>$songay
								);
			
			$html = $this->View->render("quality.php", $array_parram);
			echo $html;
		}
	}
?>