<style>
#parent {
	min-height: 200px;
	max-height: 450px;
	height: auto;
	position: absolute;
  width: 100%;
  left: 0;
  margin-left:5px;
  overflow:scroll;
  margin-top: 70px;


}


#table_salary {
  width: 1800px !important;
}

#table_salary td.selected { border: 1px solid #F00; }
#form_nhap{
  margin-left: -70px;
  margin-top: -30px;
}
</style>
<?php
echo "<h2 style='text-align:center;'>Phiếu Lương</h2>";

//BEGIN: TABLE PHIEU LUONG
$str_salary = "";
$str_salary_sheet_row = "";
if($array_salary)
{
	foreach($array_salary as $salary)
	{
		//BEGIN: lấy thông tin lương
		$hoten = $salary["full_name"];
		$ma_nv = $salary["user_code"];
		$luong_hanhchinh = $salary["luong_coban"];
		$luong_tangca_150 = 0;
		$luong_tangca_200 = 0;
		$thuong_datchuan = 0;
		$luong_chuyencan = $salary["chuyencan"];
		$phucap_dilai = $salary["phucap_dilai"];
		$luong_trachnhiem = $salary["trachnhiem"];
		$luong_phucap = $salary["phucap_luong"];
		$luong_nghiphep = 0;
		$luong_nghile = 0;
		$tienviet =0;
		$luong_xangxe = $salary["phucap_dilai"];
		$dieuchinh = 0;
		$dongphu_the = 0;
		$luong_goidau = 0;
		$vipham_noiquy = 0;
		$trutien_NG = 0;
		$tru_KPCD = 0;
		$tru_BHXH_1 = 0;
		$tru_BHXH_2 = 0;
		
		//END: Lấy thông tin lương
		
		//BEGIN: HEADER
		$array_header_salary_1 = null;
		$array_header_salary_1["col1"] = array("Họ và tên", array("style" => "text-align:center;width:25%;" ));
		$array_header_salary_1["col2"] = array($hoten, array("style" => "vertical-align:middle;text-align:center;width:25%;" ));
		$array_header_salary_1["col3"] = array("Mã nhân viên", array("style" => "vertical-align:middle;text-align:center;width:25%" ));
		$array_header_salary_1["col4"] = array($ma_nv, array("style" => "vertical-align:middle;text-align:center;width:25%;" ));
		$str_salary = $this->Template->load_table_header($array_header_salary_1);
		//END: HEADER
		
		//BEGIN:BODY
		
		//luong hanh chinh
		$array_salary_row1 = null;
		$array_salary_row1["col1"] = array("Lương hành chính", array("style" => "text-align:center;width:25%;"));
		$array_salary_row1["col2"] = array($luong_hanhchinh." VND", array("style" => "text-align:center;width:25%;"));
		$array_salary_row1["col3"] = array("Tiền viết", array("style" => "text-align:center;width:25%; "));
		$array_salary_row1["col4"] = array($tienviet." VND", array("style" => "text-align:center;width:25%;"));
		$str_salary_sheet_row1 = $this->Template->load_table_row($array_salary_row1);
		
		//luong tang ca 150%
		$array_salary_row2 = null;
		$array_salary_row2["col1"] = array("Lương tăng ca 150%", array("style" => "text-align:center;width:25%;"));
		$array_salary_row2["col2"] = array($luong_tangca_150." VND", array("style" => "text-align:center;width:25%;"));
		$array_salary_row2["col3"] = array("Tiền xăng đi công tác", array("style" => "text-align:center;width:25%; "));
		$array_salary_row2["col4"] = array($phucap_dilai." VND", array("style" => "text-align:center;width:25%;"));
		$str_salary_sheet_row2 = $this->Template->load_table_row($array_salary_row2);
		
		//Lương tăng ca 200%
		$array_salary_row3 = null;
		$array_salary_row3["col1"] = array("Lương tang ca 200%", array("style" => "text-align:center;width:25%;"));
		$array_salary_row3["col2"] = array($luong_tangca_200." VND", array("style" => "text-align:center;width:25%;"));
		$array_salary_row3["col3"] = array("Điều chỉnh tháng trước", array("style" => "text-align:center; width:25%;"));
		$array_salary_row3["col4"] = array($dieuchinh." VND", array("style" => "text-align:center;width:25%;"));
		$str_salary_sheet_row3 = $this->Template->load_table_row($array_salary_row3);
		
		//Thưởng đạt chuẩn chất lượng
		$array_salary_row4 = null;
		$array_salary_row4["col1"] = array("Thưởng đạt chất lượng", array("style" => "text-align:center;width:25%;"));
		$array_salary_row4["col2"] = array($thuong_datchuan." VND", array("style" => "text-align:center;width:25%;"));
		$array_salary_row4["col3"] = array("Đồng phục-thẻ", array("style" => "text-align:center;width:25%; "));
		$array_salary_row4["col4"] = array($dongphu_the." VND", array("style" => "text-align:center;width:25%;"));
		$str_salary_sheet_row4 = $this->Template->load_table_row($array_salary_row4);
		
		//Chuyên cần
		$array_salary_row5 = null;
		$array_salary_row5["col1"] = array("Chuyên cần", array("style" => "text-align:center;width:25%;"));
		$array_salary_row5["col2"] = array($luong_chuyencan." VND", array("style" => "text-align:center;width:25%;"));
		$array_salary_row5["col3"] = array("Lương gối đầu", array("style" => "text-align:center;width:25%;"));
		$array_salary_row5["col4"] = array($luong_goidau." VND", array("style" => "text-align:center;width:25%;"));
		$str_salary_sheet_row5 = $this->Template->load_table_row($array_salary_row5);
		
		//Trợ cấp đi lại
		$array_salary_row6 = null;
		$array_salary_row6["col1"] = array("Trợ cấp đi lại", array("style" => "text-align:center;width:25%;"));
		$array_salary_row6["col2"] = array($phucap_dilai." VND", array("style" => "text-align:center;width:25%;"));
		$array_salary_row6["col3"] = array("Vi phạm nội quy", array("style" => "text-align:center;width:25%; "));
		$array_salary_row6["col4"] = array($vipham_noiquy." VND", array("style" => "text-align:center;width:25%;"));
		$str_salary_sheet_row6 = $this->Template->load_table_row($array_salary_row6);
		
		//Trach nhiệm
		$array_salary_row7 = null;
		$array_salary_row7["col1"] = array("Tiền trách nhiệm", array("style" => "text-align:center;width:25%;"));
		$array_salary_row7["col2"] = array($luong_trachnhiem." VND", array("style" => "text-align:center;width:25%;"));
		$array_salary_row7["col3"] = array("Trừ tiền NG", array("style" => "text-align:center;width:25%; "));
		$array_salary_row7["col4"] = array($trutien_NG." VND", array("style" => "text-align:center;width:25%;"));
		$str_salary_sheet_row7 = $this->Template->load_table_row($array_salary_row7);
		
		//Phụ cấp
		$array_salary_row8 = null;
		$array_salary_row8["col1"] = array("Phụ cấp", array("style" => "text-align:center;width:25%;"));
		$array_salary_row8["col2"] = array($luong_phucap." VND", array("style" => "text-align:center;width:25%;"));
		$array_salary_row8["col3"] = array("Trừ KPCĐ", array("style" => "text-align:center;width:25%; "));
		$array_salary_row8["col4"] = array($tru_KPCD." VND", array("style" => "text-align:center;width:25%;"));
		$str_salary_sheet_row8 = $this->Template->load_table_row($array_salary_row8);
		
		//Lương nghỉ phép
		$array_salary_row9 = null;
		$array_salary_row9["col1"] = array("Lương nghỉ phép hàng tháng, hàng năm", array("style" => "text-align:center;width:25%;"));
		$array_salary_row9["col2"] = array($luong_nghiphep." VND", array("style" => "text-align:center;width:25%;"));
		$array_salary_row9["col3"] = array("Trừ tiền đóng BHXH", array("style" => "text-align:center;width:25%;"));
		$array_salary_row9["col4"] = array($tru_BHXH_1." VND", array("style" => "text-align:center;width:25%;"));
		$str_salary_sheet_row9 = $this->Template->load_table_row($array_salary_row9);
		
		//Lương nghỉ lễ
		$array_salary_row10 = null;
		$array_salary_row10["col1"] = array("Lương nghĩ lễ", array("style" => "text-align:center;width:25%;"));
		$array_salary_row10["col2"] = array($luong_nghile." VND", array("style" => "text-align:center;width:25%;"));
		$array_salary_row10["col3"] = array("Trừ tiền đóng BHXH", array("style" => "text-align:center; width:25%;"));
		$array_salary_row10["col4"] = array($tru_BHXH_2." VND", array("style" => "text-align:center;width:25%;"));
		$str_salary_sheet_row10 = $this->Template->load_table_row($array_salary_row10);
		
		//Thực lãnh
		$array_salary_row11 = null;
		$array_salary_row11["col1"] = array("Thực lãnh:", array("style" => "text-align:left;font-weight: bold","colspan"=>"4"));
		$str_salary_sheet_row11 = $this->Template->load_table_row($array_salary_row11);
		
		$str_row = $str_salary_sheet_row1.$str_salary_sheet_row2.$str_salary_sheet_row3;
		$str_row .= $str_salary_sheet_row4.$str_salary_sheet_row5.$str_salary_sheet_row6;
		$str_row .= $str_salary_sheet_row7.$str_salary_sheet_row8.$str_salary_sheet_row9;
		$str_row .= $str_salary_sheet_row10.$str_salary_sheet_row11;
		//END: BODY
		$str_table_salary = $this->Template->load_table($str_salary.$str_row,array("border"=>"1","style"=>"border-collapse: collapse;"));
		echo $str_table_salary."<br/>";
	}//END: foreach($array_salary as $salary)
}//END: if($array_salary)

//END: TABLE PHIEU LUONG

?>
