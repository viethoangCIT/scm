<?php
class staff extends Main
{
	function index()
	{
		$html_result = $this->View->render("index.php");
		echo $html_result;
	}
	
	//nhập nhân viên
	function add()
	{
		$html_result = $this->View->render("add_staff.php");
		echo $html_result;
		
	}

	//nhập chấm công
	function add_attendance()
	{
		$html_result = $this->View->render("add_attendance.php");
		echo $html_result;
		
	}
 	// hàm danh sách chấm lương
	function attendance()
	{
		$html_result = $this->View->render("attendance.php");
		echo $html_result;
		
	}
	function add_salary()
	{
		$html_result = $this->View->render("add_salary.php");
		echo $html_result;
		
	}
	function salary()
	{
		$html_result = $this->View->render("salary.php");
		echo $html_result;
		
	}
	
	function salary_report()
	{
		$html_result = $this->View->render("salary_report.php");
		echo $html_result;
		
	}
	
	function salary_sheet()
	{
		$html_result = $this->View->render("salary_sheet.php");
		echo $html_result;
		
	}
	//xoa
	function del($id = "")
	{	
	
	}
}
?>