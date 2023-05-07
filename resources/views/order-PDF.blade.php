<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        
        body {
            font-family: DejaVu Sans;
        }
		table {
			font-family: Arial, sans-serif;
			border-collapse: collapse;
			width: 100%;
			margin-top: 20px;
		}

		td, th {
			border: 1px solid #ddd;
			padding: 8px;
		}

		th {
			background-color: #f2f2f2;
			text-align: left;
			color: #555;
		}

		tr:nth-child(even) {
			background-color: #f2f2f2;
		}

		.total {
			font-weight: bold;
		}
	</style>
</head>
<body>
    <!DOCTYPE html>
<html>
<head>

	<title>Hoá đơn bán hàng</title>
	
</head>
<body>
	<table>
		<thead>
			<tr>
				<th>Sản phẩm</th>
				<th>Giá</th>
				<th>Số lượng</th>
				<th>Tổng cộng</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Bút</td>
				<td>10.000đ</td>
				<td>2</td>
				<td>20.000đ</td>
			</tr>
			<tr>
				<td>Giấy</td>
				<td>20.000đ</td>
				<td>1</td>
				<td>20.000đ</td>
			</tr>
			<tr class="total">
				<td colspan="3">Tổng cộng</td>
				<td>40.000đ</td>
			</tr>
		</tbody>
	</table>
</body>
</html>

</body>
</html>