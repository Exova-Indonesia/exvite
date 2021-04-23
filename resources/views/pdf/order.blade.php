<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.harnishdesign.net/html/koice/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Apr 2021 08:50:01 GMT -->
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="http://demo.harnishdesign.net/html/koice/images/favicon.png" rel="icon" />
<title>Order Invoice - Exova Indonesia</title>
<meta name="author" content="Exova Indonesia">

<!-- Web Fonts
======================= -->
<style>
    /* devanagari */
@font-face {
  font-family: 'Poppins';
  font-style: normal;
  font-weight: 400;
  src: url(https://fonts.gstatic.com/s/poppins/v15/pxiEyp8kv8JHgFVrJJbecmNE.woff2) format('woff2');
  unicode-range: U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;
}
/* latin-ext */
@font-face {
  font-family: 'Poppins';
  font-style: normal;
  font-weight: 400;
  src: url(https://fonts.gstatic.com/s/poppins/v15/pxiEyp8kv8JHgFVrJJnecmNE.woff2) format('woff2');
  unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
  font-family: 'Poppins';
  font-style: normal;
  font-weight: 400;
  src: url(https://fonts.gstatic.com/s/poppins/v15/pxiEyp8kv8JHgFVrJJfecg.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}
</style>

<!-- Stylesheet
======================= -->
<link rel="stylesheet" type="text/css" href="http://demo.harnishdesign.net/html/koice/vendor/bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="http://demo.harnishdesign.net/html/koice/css/stylesheet.css"/>
</head>
<body>
<!-- Container -->
<div class="container-fluid invoice-container">
  <!-- Header -->
  <header>
  <div class="row align-items-center">
    <div class="col-sm-7 text-center text-sm-left mb-3 mb-sm-0">
      <img id="logo" src="https://assets.exova.id/img/logo.png" title="Exova" alt="Exova" />
    </div>
    <div class="col-sm-5 text-center text-sm-right">
      <h4 class="text-7 mb-0">Invoice</h4>
    </div>
  </div>
  <hr>
  </header>
  
  <!-- Main Content -->
  <main>
  <div class="row">
    <div class="col-sm-6"><strong>Date:</strong> {{ dates($data->created_at) }}</div>
    <div class="col-sm-6 text-sm-right"> EX-{{ date_inv($data->created_at) }}-XX-{{ $data->payment_id }}</div>
	  
  </div>
  <hr>
  <div class="row">
    <div class="col-sm-6 order-sm-0"> <strong>Pembeli</strong>
      <address>
      {{ $data->details[0]['products']['customer']['name'] }}<br />
      {{ $data->details[0]['products']['customer']['address']['address_name'] }}<br />
      {{ $data->details[0]['products']['customer']['address']['city'] }}<br />
      {{ $data->details[0]['products']['customer']['address']['state'] }}
      </address>
    </div>
  </div>
	
  <div class="card">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table mb-0">
		<thead class="card-header">
          <tr>
            <td class="col-3 border-0"><strong>Layanan</strong></td>
			<td class="col-4 border-0"><strong>Penjual</strong></td>
            <td class="col-2 text-center border-0"><strong>Unit Price</strong></td>
			<td class="col-1 text-center border-0"><strong>QTY</strong></td>
            <td class="col-2 text-right border-0"><strong>Amount</strong></td>
          </tr>
        </thead>
          <tbody>
        @foreach($data->details as $d)
            <tr>
              <td class="col-3 border-0">{{ $d->products['products']['jasa_name'] }}</td>
              <td class="col-4 text-1 border-0">{{ $d->products['products']['seller']['name'] }}</td>
              <td class="col-2 text-center border-0">{{ rupiah($d->unit_price) }}</td>
			  <td class="col-1 text-center border-0">{{ $d->quantity }}</td>
			  <td class="col-2 text-right border-0">{{ rupiah($d->unit_price*$d->quantity) }}</td>
            </tr>
            @foreach($d->additionals as $a)
                <tr>
                  <td class="col-3 border-0">{{ $a->additional['title'] }}</td>
                  <td class="col-4 text-1 border-0"></td>
                  <td class="col-2 text-center border-0">{{ rupiah($a->additional['price']) }}</td>
                  <td class="col-1 text-center border-0">{{ $a->quantity }}</td>
                  <td class="col-2 text-right border-0">{{ rupiah($a->price*$a->quantity) }}</td>
                </tr>
            @endforeach
        @endforeach
          </tbody>
		  <tfoot class="card-footer">
			<tr>
              <td colspan="4" class="text-right"><strong>Sub Total:</strong></td>
              <td class="text-right">{{ rupiah($data->amount) }}</td>
            </tr>
            <tr>
              <td colspan="4" class="text-right"><strong>Diskon:</strong></td>
              <td class="text-right">-{{ rupiah($data->discount) }}</td>
            </tr>
            <tr>
              <td colspan="4" class="text-right"><strong>Biaya Layanan:</strong></td>
              <td class="text-right">{{ rupiah($data->admin_fee) }}</td>
            </tr>
			<tr>
              <td colspan="4" class="text-right"><strong>Total:</strong></td>
              <td class="text-right">{{ rupiah($data->total) }}</td>
            </tr>
		  </tfoot>
        </table>
      </div>
    </div>
  </div>
  </main>
  <!-- Footer -->
  <footer class="text-center mt-4">
  <p class="text-1">Copyright {{ date('Y') }} | {{ config('app.induk') }}</p>
  <div class="btn-group btn-group-sm d-print-none">
    <a href="javascript:window.print()" class="btn btn-light border text-black-50 shadow-none"><i class="fa fa-print"></i> Print</a>
    <a href="{{ url('/exports/order/') }}" class="btn btn-light border text-black-50 shadow-none"><i class="fa fa-download"></i> Download</a>
  </div>
  </footer>
</div>
</body>

<!-- Mirrored from demo.harnishdesign.net/html/koice/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Apr 2021 08:50:01 GMT -->
</html>