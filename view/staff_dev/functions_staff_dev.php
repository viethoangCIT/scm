<?php 	
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tieu de cua ham
	$function_title = "Phân Quyền Sử Dụng";
	//print_r($array_module_congty);

	echo $this->Template->load_function_header($function_title);
	//*****************************************
	//END FUNCTION HEADER
	//*****************************************
	
	
	$str_form_chucnang = $this->Template->load_form_row(array("title"=>"Chọn User","input"=>$this->Template->load_selectbox(array("name"=>"data[UserModule][id_user]","onchange"=>"thaydoi()","id"=>"id_user","style"=>"width: 330px;"),$array_user,$id_nguoidung,"","Lựa chọn User")));
	$str_form_chucnang .= "<input type='hidden' id='username' name='data[UserModule][username]' />";
	//print_r($array_module);
	$option = "<select onchange='xem_loai_baiviet()' id='ten_module' style='width: 330px;' name='data[UserModule][module_name]'>";
	$tmp_module_name = "";
	foreach($array_module_congty as $module)
	{

			if($module["module_alias_title"]) $module['module_title'] = $module["module_alias_title"];
			if($tmp_module_name != $module['module_name']) $option .="<option value='".$module['module_name']."' >".$module['module_title']."</option>";
			$tmp_module_name = $module['module_name'];
		
	}
	$option .= "</select>";
	
					
					
	$str_form_module = $this->Template->load_form_row(array("title"=>"Chọn Module","input"=>$option));

	//print_r($array_function);
	$i = 0;
	$module_name_sosanh = "";
	$function_name_sosanh = "";
	//print_r($array_module_congty);
	foreach($array_module_congty as $value)
	{
		//if($value['module_display'] == 1)
		//{
			if($value['module_name'] != $module_name_sosanh)
			{
				if($i>0) $str_form_module .= "</tbody></table></div>";
				$str_form_module .= "<div id='".$value['module_name']."' class='datagrid'><table>";
				$str_form_module .="<thead><tr><th>Tên chức năng</th><th>Phân quyền</th></tr></thead>";
				$str_form_module .= "<tbody>";
			}
			
			$str_check = "";
			if($array_function_daco)
			{
				foreach($array_function_daco as $function_daco)
				{
					if($value['function_name'] == $function_daco['function_name']) $str_check = "checked";
				}
			}
			
			$str_form_module .= "<tr>
									<td>".$value['function_title']."</td>
									<td>
										<input type='hidden' name='data[UserFunction][$i][module_name]' value='".$value['module_name']."'/>
										<input type='hidden' name='data[UserFunction][$i][module_alias]' value='".$value['module_alias']."'/>
										<input type='hidden' name='data[UserFunction][$i][module_alias_title]' value='".$value['module_alias_title']."'/>
										<input type='hidden' name='data[UserFunction][$i][module_display]' value='".$value['module_display']."'/>
										<input type='hidden' name='data[UserFunction][$i][function_name]' value='".$value['function_name']."'/>
										<input type='hidden' name='data[UserFunction][$i][function_title]' value='".$value['function_title']."'/>
										<input type='hidden' name='data[UserFunction][$i][display]' value='".$value['display']."'/>
										<input type='hidden' name='data[UserFunction][$i][alias]' value='".$value['alias']."'/>
										<input type='hidden' name='data[UserFunction][$i][alias_title]' value='".$value['alias_title']."'/>
										<input type='checkbox' name='data[UserFunction][$i][select]' $str_check/>
									</td>
								</tr>";
			$i++;
			$function_name_sosanh = $value['function_name'];
			$module_name_sosanh = $value['module_name'];
			
		//}
	}
	$str_form_module .= "</tbody></table></div>";
	$str_form_module .= $this->Template->load_form_row(array("title"=>"","input"=>$this->Template->load_button(array("type"=>"submit","onclick"=>"kiemtra()","id"=>"nut_submit"),"Lưu")));
	
	$str_form = $this->Template->load_form(array("method"=>"POST","action"=>"/chucnang_user/add.html"),$str_form_chucnang.$str_form_module);
	
	
	//*****************************************
	//FUNCTION BODY
	//*****************************************
	echo $this->Template->load_function_body($str_form);
	$form_user = "<form action='".$this->webrooot."add.html' method='post' id='form_thaydoi'>
					<input type='hidden' id='id_nguoidung' name='id_nguoidung' />
				</form>";
	echo $form_user;
	//print_r($array_module_congty);
?>
<script type="text/javascript">
function xem_loai_baiviet()
	{
		//che het tat ca cac loai
		<?php 
			foreach($array_module_congty as $module)
			{
				echo "$('#".$module['module_name']."').hide();";
			}
		?>
			
		
		//hien thi loai vua chon
		loai = document.getElementById("ten_module").value;
		//alert(loai);
		if(loai != "...")
		{
			$( "#"+loai ).show();
		}
		

	}
	xem_loai_baiviet();
function kiemtra()
{
	document.getElementById("nut_submit").disabled = false;
	if($("#id_user :selected").text() != 'Lựa chọn User')
	{
		document.getElementById("username").value=$("#id_user :selected").text();
	}else
	{
		alert('Vui Lòng lựa chọn user');
		document.getElementById("nut_submit").disabled = true;
	}
}
function thaydoi()
{
	document.getElementById("id_nguoidung").value = document.getElementById("id_user").value;
	if(document.getElementById("id_nguoidung").value != "")
	{
		$('#form_thaydoi').submit();
		
	}
}
//thaydoi();
</script>
<style type="text/css">
.datagrid table { border-collapse: collapse; text-align: left; width: 100%; } .datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; border: 1px solid #006699; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }.datagrid table td, .datagrid table th { padding: 3px 10px; }.datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; color:#FFFFFF; font-size: 15px; font-weight: bold; border-left: 1px solid #0070A8; } .datagrid table thead th:first-child { border: none; }.datagrid table tbody td { color: #00496B; border-left: 1px solid #E1EEF4;font-size: 12px;font-weight: normal; }.datagrid table tbody .alt td { background: #E1EEF4; color: #00496B; }.datagrid table tbody td:first-child { border-left: none; }.datagrid table tbody tr:last-child td { border-bottom: none; }
tr:hover {
  background-color: #ffa ;
}
</style>
