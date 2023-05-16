<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
	<style>
        /* Định dạng CSS cho bảng */
		*{
			font-family: 'DejaVu Sans';
		}

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>THỐNG KÊ THÁNG {{$month}} CỦA {{$username}}</h2>

    <table>
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Phiên giao dịch</th>
                <th>Tổng tiền trong phiên giao dịch</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($printStatistics as $printStatistic)
                <tr>
					<td>{{ $printStatistic['product_name'] }}</td>
                    <td>{{ $printStatistic['price']}}đ</td>
                    <td>{{ $printStatistic['quantity'] }}</td>
                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $printStatistic['session_endtime'])->format('d/m/Y H:i') }}</td>
                    <td>{{ $printStatistic['totalPrice'] }}đ</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p>Tổng cộng: {{ $totalRevenue }}đ</p>
</body>

</html>


