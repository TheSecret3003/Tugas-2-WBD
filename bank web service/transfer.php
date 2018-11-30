<!DOCTYPE html>
<html>
	<head>
		<title>Bank ABC</title>
		<link rel="stylesheet" type="text/css" href="./css/transfer.css">
	</head>
	<body>
		<div class="main">
			<?php
				$name = $_GET["name"];
				$amount = $_GET["amount"];
			?>
			<div>
				<p>Welcome,</p>
				<div id=name><?php echo $name;?></div>
			</div>
			<form action="./validate.php" method="post">
				<div class="table">
					<table>
						<tr>
							<td id="idx_1">
								Nomor kartu
							</td>
							<td>
								<input type="text" name="no_kartu" id="card_num">
							</td>
							<td>
								<img id="pic_res" src=""/>
							</td>
						</tr>
						<tr>
							<td></td>
							<td id="error_res"></td>
						</tr>
						<tr>
							<td id="idx_1">
								Nomor kartu penerima
							</td>
							<td>
								<input type="text" name="no_kartu_penerima" id="card_num2">
							</td>
						</tr>
						<tr>
							<td id="idx_1">
								Jumlah
							</td>
							<td>
								<input type="text" name="amount">
							</td>
						</tr>
					</table>
				</div>
				<button type="submit">Submit</button>
			</form>
		</div>
	</body>
</html>