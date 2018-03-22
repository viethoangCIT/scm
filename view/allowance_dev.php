<?php
class allowance extends Main
{
	function index()
	{
		$html_result = $this->View->render("list_allowance.php");
		echo $html_result;
	}
	
	
	function add()
	{
		$html_result = $this->View->render("add_allowance.php");
		echo $html_result;
	}

	function list_ext()
	{
		$html_result = $this->View->render("list_ext.php");
		echo $html_result;
	}
	
	
	function add_ext()
	{
		$html_result = $this->View->render("add_ext.php");
		echo $html_result;
	}
	function list_salary_product()
	{
		$html_result = $this->View->render("list_salary_product.php");
		echo $html_result;
	}

function add_income_tax()
	{
		$html_result = $this->View->render("add_income_tax.php");
		echo $html_result;
	}
	function list_income_tax()
	{
		$html_result = $this->View->render("list_income_tax.php");
		echo $html_result;
	}

	function add_work_fee()
	{
		$html_result = $this->View->render("add_work_fee.php");
		echo $html_result;
	}
	function list_work_fee()
	{
		$html_result = $this->View->render("list_work_fee.php");
		echo $html_result;
	}

		function add_salary_maternity()
	{
		$html_result = $this->View->render("add_salary_maternity.php");
		echo $html_result;
	}
	function list_salary_maternity()
	{
		$html_result = $this->View->render("list_salary_maternity.php");
		echo $html_result;
	}

	function list_salary_maternity()
	{
		$html_result = $this->View->render("list_salary_leave.php");
		echo $html_result;
	}


}
?>