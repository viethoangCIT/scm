<style>
	.table-responsive{
		height:500px;
		overflow-y: scroll !important;
	}
	.chu-nhat{
		background-color: #f1c906;
	}
</style>
<?php
	//tạo tiêu đề hàm
	$function_title = "Theo Dõi Nhân Sự";
	echo $this->Template->load_function_header($function_title);
	
	//Dùng hàm load_textbox của đối tượng Template để textbox
	$str_textbox_day = $this->Template->load_textbox(array("name" => "month" ,"id"=>"month","style" => "width:150px", "value"=>$month));
	$str_selectbox_group = $this->Template->load_selectbox(array("name" => "id_group", "id"=>"id_group_search" ,"style" => "width:150px"), $array_group,$id_group);
	$str_selectbox_shift = $this->Template->load_selectbox(array("name" => "id_shift", "id"=>"id_shift_search" ,"style" => "width:150px"), $array_shift,$id_shift);
	$str_save_button = $this->Template->load_button(array("type" => "sutmit"), "Xem");
	
	$str_input_row = "Chọn tháng $str_textbox_day $str_selectbox_group $str_selectbox_shift $str_save_button";
	
	// LOAD FORM
	$str_form_production = $this->Template->load_form(array("method" => "GET", "id" => "form_seach", "action" => "/production/user_production"),$str_input_row);
	echo $str_form_production;
	
	/*
	//1: tao mang table header 	
	$array_header_production["col1"] = array("Nhân sự");
	$array_header_production["col2"] = array("Vị trí công việc");
	$array_header_production["col3"] = array("Thời gian");
	for($i=1; $i<=$songay; $i++)
	{
		$array_header_production["col_ngay$i"] = array("$month");
	}
	
	//2: lấy dòng tr header
	$str_header_production = $this->Template->load_table_header($array_header_production);
	
	//1: tao mang table load dòng 	
	$str_row_production = "";
	$tmp = "";
	if($array_user2)
	{
		$tmp = "";
		foreach($array_user2 as $user)
		{
			$fullname = $user["fullname"];
			
			$array_row_production["col1"] = array($fullname);
			$array_row_production["col2"] = array("");
			$array_row_production["col3"] = array("");
			
			for($i=1; $i<=$songay; $i++)
			{
				//$array_row_production["col_ngay$i"] = array("",array("id"=>$id_user."_$i"));
			}
			//2: lấy dòng tr header
			$str_row_production .= $this->Template->load_table_row($array_row_production);
		}//END: foreach($array_user2 as $user)
	}//END: if($array_user2)
	
	
	
	/*
	$array_row_production = NULL;
	$array_row_production["col4"] = array("Tổng", array("align"=>"center","colspan"=>"2"));
	$array_row_production["col5"] = array("", array("align"=>"center"));
	$str_row_production .= $this->Template->load_table_row($array_row_production);
	*/
	/*
	$str_table_production =  $this->Template->load_table($str_header_production . $str_row_production,array("id"=>""));
	*/
?>


<div class="table-responsive">
	<table class="table table-bordered table-fixed" id="example">
   		<thead>
        	<tr class="v_mid">
                <th>Nhân sự</th>
                <th>Vị trí CV</th>
                <th>Thời gian</th>
                <?php
                for($i=1; $i<=$songay; $i++)
                {
                ?>
                    
                    <th><?php echo $i;?></th>
                <?php
                }
                ?>
            </tr>
        </thead>
        <tbody>
                	<?php
			if($array_user2)
			{
				$tmp = "";
				foreach($array_user2 as $user)
				{
					$fullname = $user["fullname"];
					$job = $user["job"];
					if($tmp == $fullname) $fullname = "";
					$id_user = $user["id"];
			?>
        	<tr>
            	<td><?php echo $fullname;?></td>
                <td><?php echo $job;?></td>
                <td><?php echo "";?></td>
                <?php 
                	for($i=1; $i<=$songay; $i++)
                    {
						$str_month = "$i-".$month;
						$str_month = date("Y-m-d",strtotime($str_month));
						//begin: kiem tra ngay chu nhat
						$timestamp = strtotime($str_month);
						$weekday= date("l", $timestamp );
						$normalized_weekday = strtolower($weekday);
						//echo $normalized_weekday ;
						$check = false;
						$class = "";
						if ($normalized_weekday == "sunday") {
						$check = true;
						} else {
						$check = false;
						}
						if($check) $class="chu-nhat";
				?>
                    	<td id="<?php echo $id_user.'_'.$str_month;?>" class="<?php echo $class;?>"></td>
                <?php
                    }//End:for($i=1; $i<=$songay; $i++) 
				?>
            </tr>
            <?php
				}//END: foreach($array_user2 as $user)
			}//END: if($array_user2)
			?>
        </tbody> 
    </table>
</div>
<script type="text/javascript">
 $( function() {
	 $( "#month" ).datepicker({dateFormat: "mm-yy"});
	 capnhat_solieu();
});


	function capnhat_solieu()
	{
		month 			= "<?php echo $month; ?>";	
		id_group 		= "<?php echo $id_group; ?>";	
		id_shift		= "<?php echo $id_shift; ?>";
		$.ajax({ method: "GET", url: "/production/user_production?debug=sql", data: {request: "ajax", month: month, id_group: id_group, id_shift: id_shift}})
		.done(function( str_data ) {
			alert(str_data);
			//chuyển dữ liệu từ string về kiểu json
			var array_data = $.parseJSON(str_data);
			for (var key in array_data) {
				//test: document.getElementById("79_2018-03-01").innerHTML  = "abc";
				//đưa dữ liệu giờ vào các ô ngày trong tháng	
				//alert(array_data[key]["id_day"]);
				if(document.getElementById(array_data[key]["id_day"])) 
				{	
					document.getElementById(array_data[key]["id_day"]).innerHTML = array_data[key]["hour"]+" <span style='font-size:10px;'><sup>"+array_data[key]["day_type"]+"</sup></span>";
				}
			}		
				
		});
	}
</script>