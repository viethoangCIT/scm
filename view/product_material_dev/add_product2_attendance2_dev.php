<style type="text/css">
    .title_page{
        color: black!important;
        text-shadow:none;
    }

    #attendance_day{
    	border-radius: 7px;
         margin-top: 9px;
         height: 25px;
         border: 1px solid #aaaaaa;
    }
    .timkiem{
		border-radius:5px;
		background-color: #fcfcfc;
	}
</style>


<?php

	//tạo tiêu đề hàm
	$function_title = "Nhập Sản phẩm";
	echo $this->Template->load_function_header($function_title);
	
	$str_form_product2 = "";
	//tạo textbox nhập mã tên sản phẩm
	$str_input_product2_name = $this->Template->load_textbox(array("name"=>"data[name]","id"=>"name","value"=>$name,"style"=>"width:300px"));	
	
	//tạo dòng nhập mã sản phẩm
	
	$str_form_product2 .= $this->Template->load_form_row(array("title"=>"Mã sản phẩm","input"=>$str_input_product2_name ,"style"=>"width:100px"));
	
		
	//tạo textbox nhập tên sảm phẩm
	$str_input_product2_code = $this->Template->load_textbox(array("name"=>"data[code]","id"=>"code","value"=>"","style"=>"width:300px"));	
	$str_form_product2 .= $this->Template->load_form_row(array("title"=>"Tên sản phẩm","input"=>$str_input_product2_code));
	
	//tạo textbox nhập đơn giá
	$str_input_product2_rate = $this->Template->load_textbox(array("name"=>"data[code]","id"=>"code","value"=>"","style"=>"width:300px"));	
	$str_form_product2 .= $this->Template->load_form_row(array("title"=>"Đơn giá","input"=>$str_input_product2_rate));
	
	//tạo nút lưu	
	$str_save_button =  $this->Template->load_button(array("type"=>"button","onclick"=>"luu()"),"Lưu");
	$str_form_product2 .= $this->Template->load_form_row(array("title"=>"","input"=>$str_save_button));
	
	//đưa vào form
	$str_form_product2 = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"?debug=code"),$str_form_product2);
	echo $str_form_product2; 





//tạo tiêu đề hàm
	$function_title = "Danh sách sản phẩm";
	echo $this->Template->load_function_header($function_title);
	


	$str_form_product = "";

    
  
   
  
       // lọc theo mã sản phẩm
     $array_product_code =array("0"=>"S1", "1"=>"S2", "2"=>"S3","3"=>"S4", "4"=>"S5", "5"=>"S6", "6"=>"S7","7" =>"S8"); 
   	 $str_select_product_code = $this->Template->load_selectbox_basic(array("name"=>"product_code","autocomplete"=>"off","value"=>"","id"=>"product_code"),$array_product_code);
                
     	//nhập sản phẩm
     $str_input_name_staff = $this->Template->load_textbox(array("name"=>"attendance_day","autocomplete"=>"off","value"=>"","id"=>"attendance_day", "placeholder"=>"Nhập tên sản phẩm"));

   // $str_btn_save = $this->Template->load_button(array("type"=>"submit",),"<p class = 'text_tk'>Tìm kiếm</p>");
    $str_btn_save = "<input type='submit' class='timkiem'value='Tìm kiếm' style='font-size: 13.4px'>";
    $str_input_attendance_day ="<div id = 'search_bar'> Mã sản phẩm   $str_select_product_code Nhập tên sản phẩm: $str_input_name_staff  $str_btn_save</div>";
   

   echo $str_input_attendance_day;
    //tạo nút tìm

   //----------------------------------------------------

	

  
    //tạo nút tìm

	//1: tao mang table header 	
	$array_header_product =  array("STT"=>array("Stt",array("style"=>"text-align:left; width:3%")),
						
						"masp"=>array("Mã sản phẩm",array("style"=>"text-align:left; width:8%;white-space: nowrap")),
						"tensp"=>array("Tên sản phẩm",array("style"=>"text-align:left; width:15%")),
						"dongia"=>array("Đơn giá",array("style"=>"text-align:left; width:10%")),
						
						"action"=>array("Chức năng",array("style"=>"text-align:center;width:5%;")),

					);

	//2: lấy dòng tr header
	$str_form_product = $this->Template->load_table_header($array_header_product);

	//---------------------------------------------------------



	
    

  $array_staff = array("1"=>array( "masp"=> "S1","tensp"=> "Sản phẩm 1" ,"dongia"=> "20000"),"2"=>array( "masp"=> "S2","tensp"=> "Sản phẩm 2"  ,"dongia"=> "20000"),"3"=>array(  "masp"=> "S3","tensp"=> "Sản phẩm 3" ,"dongia"=> "20000"),"4"=>array(  "masp"=> "S4","tensp"=> "Sản phẩm 4" ,"dongia"=> "20000"),"5"=>array(  "masp"=> "S5","tensp"=> "Sản phẩm 5" ,"dongia"=> "20000"));


//link sửa-xóa
     $link_sua="";
     $link_xoa="";
     $link_sua  = $this->Template->load_link("edit","Sửa",$link_sua);
     $link_xoa  = $this->Template->load_link("del","Xóa",$link_xoa);
     $link_action = $link_xoa . $link_sua;




	foreach ($array_staff as $key=> $staff) {

	//lấy dòng nội dung table
	$array_product1 =  array("Stt"=>array($key,array("style"=>"text-align:left; width:3%;")),
						
						"masp"=>array($staff["masp"],array("style"=>"text-align:left; width:8%")),					
						"tensp"=>array($staff["tensp"],array("style"=>"text-align:left; width:10%")),
						"dongia"=>array($staff["dongia"],array("style"=>"text-align:left; width:8%")),
					
						"action"=>array($link_action,array("style"=>"text-align:center; ")),
					);	
	$str_form_product .= $this->Template->load_table_row($array_product1);
	

}

	//đưa vào table
	$str_form_product =$this->Template->load_table($str_form_product);

	echo $str_form_product; 

	









	
?>