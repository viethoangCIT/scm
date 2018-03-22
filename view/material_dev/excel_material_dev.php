<style type="text/css" media="screen">
th, td{
	text-align: center;
}
</style>
<table border = "1" style="border-collapse: collapse;">
	<thead>
		<tr>
			<th style="width: 50px;">STT</th>
			<th style="width: 150px;">Tên nguyên liệu</th>
			<th style="width: 150px;">Mã nguyên liệu</th>
			<th style="width: 150px;">Số lượng nhập</th>
			<th style="width: 150px;">Số lượng xuất</th>
			<th style="width: 150px;">Số lượng còn</th>
			<th style="width: 100px;">Đơn giá</th>
			<th style="width: 100px;">Thành tiền</th>
		</tr>
	</thead>
	<tbody>
		<?php
$stt = 0;
if ($array_data) {
	foreach ($array_data as $data) {
		$stt++;
		?>
				<tr>
					<td><?php echo $stt; ?></td>
					<td><?php echo $data["material_name"]; ?></td>
					<td><?php echo $data["code"]; ?></td>
					<td><?php echo $data["num_import"]; ?></td>
					<td><?php echo $data["num_export"]; ?></td>
					<td><?php echo $data["rest"]; ?></td>
					<td><?php echo $data["unit_price"]; ?></td>
					<td><?php echo $data["into_price"]; ?></td>

				</tr>
				<?php
}
} else {?>
		<tr>
			<td colspan="8">Không có dữ liệu</td>
		</tr>
		<?php
}
?>
</tbody>
</table>