<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Invoice - {{ $invoiceCode }}</title>

		<style>
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				/* border: 1px solid #eee; */
				/* box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); */
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 0px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
        padding-left: 8px;
        padding-right: 8px;
        padding-top: 5px;
        padding-bottom: 5px;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

      .invoice-box table tr td h1 {
        padding-bottom: 0.5rem;
      }
      .invoice-box table tr td p {
        margin-bottom: 0;
      }

			.invoice-box table tr.item td {
                padding: 10px;
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td>
									<h1>{{ $invoiceCode }}</h1>
									<p>Tagihan: <strong>{{ $weekName }}, {{ $monthName }} {{ $yearBill }}</strong></p>
                                    <div style="border-bottom: 1px solid #eee; margin-top: 20px; margin-bottom: 20px;"></div>
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
									Bill From:<br>
									<strong>SanCash</strong><br />
									12345 Sunny Road<br />
									Sunnyville, CA 12345
								</td>

								<td>
									Bill To:<br>
									<strong>{{ $studentName }}</strong><br />
									{{ $studentEmail }}<br />
									{{ $className }}
								</td>
							</tr>
						</table>
					</td>
				</tr>


				<tr class="heading">
					<td>Key</td>

					<td>Value</td>
				</tr>

				<tr class="item">
					<td>Nama</td>

					<td>{{ $studentName }}</td>
				</tr>

				<tr class="item">
					<td>Kelas</td>

					<td>{{ $className }}</td>
				</tr>

				<tr class="item">
					<td>Status</td>
					<td>{{ $status }}</td>
				</tr>

				<tr class="item">
					<td>Status</td>
					<td>{{ $date }}</td>
				</tr>

        <tr class="item last">
					<td>Tagihan</td>
					<td>IDR {{ number_format($bill) }}</td>
				</tr>
			</table>

      {{-- Footer --}}
      <div style="border-bottom: 1px solid #eee; margin-top: 20px; margin-bottom: 20px;"></div>
      <p style="text-align: center;">Terima kasih atas partisipasinya terhadap kelas dan lingkungan sekolah.</p>

		</div>
	</body>
</html>