<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        /* List Group */
    body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
        Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji",
        "Segoe UI Symbol";
    }
    .font-weight-bold {
        font-weight: 700 !important;
    }

    .text-capitalize {
        text-transform: capitalize !important;
    }

    .list-group {
        display: flex;
        flex-direction: column;
        padding-left: 0;
        margin-bottom: 0;
        border-radius: 0.25rem;
    }

    .list-group-item-action {
        width: 100%;
        color: #495057;
        text-align: inherit;
    }

    .list-group-item-action:hover,
    .list-group-item-action:focus {
        z-index: 1;
        color: #495057;
        text-decoration: none;
        background-color: #f8f9fa;
    }

    .list-group-item-action:active {
        color: #212529;
        background-color: #e9ecef;
    }

    .list-group-item {
        position: relative;
        display: block;
        padding: 0.75rem 1.25rem;
        background-color: #fff;
        border-bottom: 1px solid rgba(0, 0, 0, 0.125);
    }

    .list-group-item:first-child {
        border-top-left-radius: inherit;
        border-top-right-radius: inherit;
    }

    .list-group-item:last-child {
        border-bottom-right-radius: inherit;
        border-bottom-left-radius: inherit;
        border-bottom: none;
    }

    .list-group-item.disabled,
    .list-group-item:disabled {
        color: #6c757d;
        pointer-events: none;
        background-color: #fff;
    }

    .list-group-item.active {
        z-index: 2;
        color: #fff;
        background-color: #3490dc;
        border-color: #3490dc;
    }

    .list-group-item + .list-group-item {
        border-top-width: 0;
    }

    .list-group-item + .list-group-item.active {
        margin-top: -1px;
        border-top-width: 1px;
    }

    .list-group-horizontal {
        flex-direction: row;
    }

    .list-group-horizontal > .list-group-item:first-child {
        border-bottom-left-radius: 0.25rem;
        border-top-right-radius: 0;
    }

    .list-group-horizontal > .list-group-item:last-child {
        border-top-right-radius: 0.25rem;
        border-bottom-left-radius: 0;
    }

    .list-group-horizontal > .list-group-item.active {
        margin-top: 0;
    }

    .list-group-horizontal > .list-group-item + .list-group-item {
        border-top-width: 1px;
        border-left-width: 0;
    }

    .list-group-horizontal > .list-group-item + .list-group-item.active {
        margin-left: -1px;
        border-left-width: 1px;
    }

    @media (min-width: 576px) {
        .list-group-horizontal-sm {
            flex-direction: row;
        }

        .list-group-horizontal-sm > .list-group-item:first-child {
            border-bottom-left-radius: 0.25rem;
            border-top-right-radius: 0;
        }

        .list-group-horizontal-sm > .list-group-item:last-child {
            border-top-right-radius: 0.25rem;
            border-bottom-left-radius: 0;
        }

        .list-group-horizontal-sm > .list-group-item.active {
            margin-top: 0;
        }

        .list-group-horizontal-sm > .list-group-item + .list-group-item {
            border-top-width: 1px;
            border-left-width: 0;
        }

        .list-group-horizontal-sm > .list-group-item + .list-group-item.active {
            margin-left: -1px;
            border-left-width: 1px;
        }
    }

    @media (min-width: 768px) {
        .list-group-horizontal-md {
            flex-direction: row;
        }

        .list-group-horizontal-md > .list-group-item:first-child {
            border-bottom-left-radius: 0.25rem;
            border-top-right-radius: 0;
        }

        .list-group-horizontal-md > .list-group-item:last-child {
            border-top-right-radius: 0.25rem;
            border-bottom-left-radius: 0;
        }

        .list-group-horizontal-md > .list-group-item.active {
            margin-top: 0;
        }

        .list-group-horizontal-md > .list-group-item + .list-group-item {
            border-top-width: 1px;
            border-left-width: 0;
        }

        .list-group-horizontal-md > .list-group-item + .list-group-item.active {
            margin-left: -1px;
            border-left-width: 1px;
        }
    }

    @media (min-width: 992px) {
        .list-group-horizontal-lg {
            flex-direction: row;
        }

        .list-group-horizontal-lg > .list-group-item:first-child {
            border-bottom-left-radius: 0.25rem;
            border-top-right-radius: 0;
        }

        .list-group-horizontal-lg > .list-group-item:last-child {
            border-top-right-radius: 0.25rem;
            border-bottom-left-radius: 0;
        }

        .list-group-horizontal-lg > .list-group-item.active {
            margin-top: 0;
        }

        .list-group-horizontal-lg > .list-group-item + .list-group-item {
            border-top-width: 1px;
            border-left-width: 0;
        }

        .list-group-horizontal-lg > .list-group-item + .list-group-item.active {
            margin-left: -1px;
            border-left-width: 1px;
        }
    }

    @media (min-width: 1200px) {
        .list-group-horizontal-xl {
            flex-direction: row;
        }

        .list-group-horizontal-xl > .list-group-item:first-child {
            border-bottom-left-radius: 0.25rem;
            border-top-right-radius: 0;
        }

        .list-group-horizontal-xl > .list-group-item:last-child {
            border-top-right-radius: 0.25rem;
            border-bottom-left-radius: 0;
        }

        .list-group-horizontal-xl > .list-group-item.active {
            margin-top: 0;
        }

        .list-group-horizontal-xl > .list-group-item + .list-group-item {
            border-top-width: 1px;
            border-left-width: 0;
        }

        .list-group-horizontal-xl > .list-group-item + .list-group-item.active {
            margin-left: -1px;
            border-left-width: 1px;
        }
    }

    .list-group-flush {
        border-radius: 0;
    }

    .list-group-flush > .list-group-item {
        border-width: 0 0 1px;
    }

    .list-group-flush > .list-group-item:last-child {
        border-bottom-width: 0;
    }

    .list-group-item-primary {
        color: #1b4b72;
        background-color: #c6e0f5;
    }

    .list-group-item-primary.list-group-item-action:hover,
    .list-group-item-primary.list-group-item-action:focus {
        color: #1b4b72;
        background-color: #b0d4f1;
    }

    .list-group-item-primary.list-group-item-action.active {
        color: #fff;
        background-color: #1b4b72;
        border-color: #1b4b72;
    }

    .list-group-item-secondary {
        color: #383d41;
        background-color: #d6d8db;
    }

    .list-group-item-secondary.list-group-item-action:hover,
    .list-group-item-secondary.list-group-item-action:focus {
        color: #383d41;
        background-color: #c8cbcf;
    }

    .list-group-item-secondary.list-group-item-action.active {
        color: #fff;
        background-color: #383d41;
        border-color: #383d41;
    }

    .list-group-item-success {
        color: #1d643b;
        background-color: #c7eed8;
    }

    .list-group-item-success.list-group-item-action:hover,
    .list-group-item-success.list-group-item-action:focus {
        color: #1d643b;
        background-color: #b3e8ca;
    }

    .list-group-item-success.list-group-item-action.active {
        color: #fff;
        background-color: #1d643b;
        border-color: #1d643b;
    }

    .list-group-item-info {
        color: #385d7a;
        background-color: #d6e9f9;
    }

    .list-group-item-info.list-group-item-action:hover,
    .list-group-item-info.list-group-item-action:focus {
        color: #385d7a;
        background-color: #c0ddf6;
    }

    .list-group-item-info.list-group-item-action.active {
        color: #fff;
        background-color: #385d7a;
        border-color: #385d7a;
    }

    .list-group-item-warning {
        color: #857b26;
        background-color: #fffacc;
    }

    .list-group-item-warning.list-group-item-action:hover,
    .list-group-item-warning.list-group-item-action:focus {
        color: #857b26;
        background-color: #fff8b3;
    }

    .list-group-item-warning.list-group-item-action.active {
        color: #fff;
        background-color: #857b26;
        border-color: #857b26;
    }

    .list-group-item-danger {
        color: #761b18;
        background-color: #f7c6c5;
    }

    .list-group-item-danger.list-group-item-action:hover,
    .list-group-item-danger.list-group-item-action:focus {
        color: #761b18;
        background-color: #f4b0af;
    }

    .list-group-item-danger.list-group-item-action.active {
        color: #fff;
        background-color: #761b18;
        border-color: #761b18;
    }

    .list-group-item-light {
        color: #818182;
        background-color: #fdfdfe;
    }

    .list-group-item-light.list-group-item-action:hover,
    .list-group-item-light.list-group-item-action:focus {
        color: #818182;
        background-color: #ececf6;
    }

    .list-group-item-light.list-group-item-action.active {
        color: #fff;
        background-color: #818182;
        border-color: #818182;
    }

    .list-group-item-dark {
        color: #1b1e21;
        background-color: #c6c8ca;
    }

    .list-group-item-dark.list-group-item-action:hover,
    .list-group-item-dark.list-group-item-action:focus {
        color: #1b1e21;
        background-color: #b9bbbe;
    }

    .list-group-item-dark.list-group-item-action.active {
        color: #fff;
        background-color: #1b1e21;
        border-color: #1b1e21;
    }

    .float-right {
        float: right;
    }

    .text-right {
        text-align: right;
    }

    .text-center {
        text-align: center;
    }

    .m-auto {
        margin: auto !important;
    }

    .d-flex {
        display: flex !important;
    }

    .bg-success {
        background-color: #38c172 !important;
    }

    .bg-danger {
        background-color: #e3342f !important;
    }

    .rounded-circle {
        border-radius: 50% !important;
    }

    .h1 {
        font-size: 2.25rem;
    }

    .p-4 {
        padding: 1.5rem !important;
    }

    .text-white {
        color: #fff !important;
    }
    
.table {
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;
}

.table th,
.table td {
    padding: 0.75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}

.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
}

.table tbody + tbody {
    border-top: 2px solid #dee2e6;
}

.table-sm th,
.table-sm td {
    padding: 0.3rem;
}

.table-bordered {
    border: 1px solid #dee2e6;
}

.table-bordered th,
.table-bordered td {
    border: 1px solid #dee2e6;
}

.table-bordered thead th,
.table-bordered thead td {
    border-bottom-width: 2px;
}

.table-borderless th,
.table-borderless td,
.table-borderless thead th,
.table-borderless tbody + tbody {
    border: 0;
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0, 0, 0, 0.05);
}

.table-hover tbody tr:hover {
    color: #212529;
    background-color: rgba(0, 0, 0, 0.075);
}

.table-primary,
.table-primary > th,
.table-primary > td {
    background-color: #c6e0f5;
}

.table-primary th,
.table-primary td,
.table-primary thead th,
.table-primary tbody + tbody {
    border-color: #95c5ed;
}

.table-hover .table-primary:hover {
    background-color: #b0d4f1;
}

.table-hover .table-primary:hover > td,
.table-hover .table-primary:hover > th {
    background-color: #b0d4f1;
}

.table-secondary,
.table-secondary > th,
.table-secondary > td {
    background-color: #d6d8db;
}

.table-secondary th,
.table-secondary td,
.table-secondary thead th,
.table-secondary tbody + tbody {
    border-color: #b3b7bb;
}

.table-hover .table-secondary:hover {
    background-color: #c8cbcf;
}

.table-hover .table-secondary:hover > td,
.table-hover .table-secondary:hover > th {
    background-color: #c8cbcf;
}

.table-success,
.table-success > th,
.table-success > td {
    background-color: #c7eed8;
}

.table-success th,
.table-success td,
.table-success thead th,
.table-success tbody + tbody {
    border-color: #98dfb6;
}

.table-hover .table-success:hover {
    background-color: #b3e8ca;
}

.table-hover .table-success:hover > td,
.table-hover .table-success:hover > th {
    background-color: #b3e8ca;
}

.table-info,
.table-info > th,
.table-info > td {
    background-color: #d6e9f9;
}

.table-info th,
.table-info td,
.table-info thead th,
.table-info tbody + tbody {
    border-color: #b3d7f5;
}

.table-hover .table-info:hover {
    background-color: #c0ddf6;
}

.table-hover .table-info:hover > td,
.table-hover .table-info:hover > th {
    background-color: #c0ddf6;
}

.table-warning,
.table-warning > th,
.table-warning > td {
    background-color: #fffacc;
}

.table-warning th,
.table-warning td,
.table-warning thead th,
.table-warning tbody + tbody {
    border-color: #fff6a1;
}

.table-hover .table-warning:hover {
    background-color: #fff8b3;
}

.table-hover .table-warning:hover > td,
.table-hover .table-warning:hover > th {
    background-color: #fff8b3;
}

.table-danger,
.table-danger > th,
.table-danger > td {
    background-color: #f7c6c5;
}

.table-danger th,
.table-danger td,
.table-danger thead th,
.table-danger tbody + tbody {
    border-color: #f09593;
}

.table-hover .table-danger:hover {
    background-color: #f4b0af;
}

.table-hover .table-danger:hover > td,
.table-hover .table-danger:hover > th {
    background-color: #f4b0af;
}

.table-light,
.table-light > th,
.table-light > td {
    background-color: #fdfdfe;
}

.table-light th,
.table-light td,
.table-light thead th,
.table-light tbody + tbody {
    border-color: #fbfcfc;
}

.table-hover .table-light:hover {
    background-color: #ececf6;
}

.table-hover .table-light:hover > td,
.table-hover .table-light:hover > th {
    background-color: #ececf6;
}

.table-dark,
.table-dark > th,
.table-dark > td {
    background-color: #c6c8ca;
}

.table-dark th,
.table-dark td,
.table-dark thead th,
.table-dark tbody + tbody {
    border-color: #95999c;
}

.table-hover .table-dark:hover {
    background-color: #b9bbbe;
}

.table-hover .table-dark:hover > td,
.table-hover .table-dark:hover > th {
    background-color: #b9bbbe;
}

.table-active,
.table-active > th,
.table-active > td {
    background-color: rgba(0, 0, 0, 0.075);
}

.table-hover .table-active:hover {
    background-color: rgba(0, 0, 0, 0.075);
}

.table-hover .table-active:hover > td,
.table-hover .table-active:hover > th {
    background-color: rgba(0, 0, 0, 0.075);
}

.table .thead-dark th {
    color: #fff;
    background-color: #343a40;
    border-color: #454d55;
}

.table .thead-light th {
    color: #495057;
    background-color: #e9ecef;
    border-color: #dee2e6;
}

.table-dark {
    color: #fff;
    background-color: #343a40;
}

.table-dark th,
.table-dark td,
.table-dark thead th {
    border-color: #454d55;
}

.table-dark.table-bordered {
    border: 0;
}

.table-dark.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(255, 255, 255, 0.05);
}

.table-dark.table-hover tbody tr:hover {
    color: #fff;
    background-color: rgba(255, 255, 255, 0.075);
}

@media (max-width: 575.98px) {
    .table-responsive-sm {
        display: block;
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .table-responsive-sm > .table-bordered {
        border: 0;
    }
}

@media (max-width: 767.98px) {
    .table-responsive-md {
        display: block;
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .table-responsive-md > .table-bordered {
        border: 0;
    }
}

.footer {
    bottom: 0;
    width: 100%;
    line-height: 24px;
    padding: 40px 0px 20px 0px;
}
.footer-header {
    margin: 20px 0px;
    font-weight: 700;
    font-size: 1rem;
    text-transform: uppercase;
}
.footer-body {
    margin-bottom: 40px;
}
.footer-cp {
    border-top: 1px solid #dee2e6;
    padding-top: 20px;
}
.footer-cp-2 {
    text-align: right;
}
.text-muted {
    color: #6c757d !important;
}
.container,
.container-fluid,
.container-xl,
.container-lg,
.container-md,
.container-sm {
    width: 100%;
    padding-right: 12px;
    padding-left: 12px;
    margin-right: auto;
    margin-left: auto;
}

@media (min-width: 576px) {
    .container-sm,
    .container {
        max-width: 540px;
    }
}

@media (min-width: 768px) {
    .container-md,
    .container-sm,
    .container {
        max-width: 720px;
    }
}

@media (min-width: 992px) {
    .container-lg,
    .container-md,
    .container-sm,
    .container {
        max-width: 960px;
    }
}

@media (min-width: 1200px) {
    .container-xl,
    .container-lg,
    .container-md,
    .container-sm,
    .container {
        max-width: 1240px;
    }
}
a {
    color: #3490dc;
    text-decoration: none;
    background-color: transparent;
}
.navbar {
    position: relative;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    padding: 0.5rem 1rem;
    transition: all 0.5s;
}

.navbar .container,
.navbar .container-fluid,
.navbar .container-sm,
.navbar .container-md,
.navbar .container-lg,
.navbar .container-xl {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
}

.navbar-brand {
    display: inline-block;
    padding-top: 0.32rem;
    padding-bottom: 0.32rem;
    margin-right: 1rem;
    font-size: 1.125rem;
    line-height: inherit;
    white-space: nowrap;
}

.amount {
    padding: 24px 12px;
    background-color: #479cf721;
}

.navbar-light .navbar-brand {
    color: rgba(0, 0, 0, 0.9);
}
.d-inline-block {
    display: inline-block !important;
}
.align-top {
    vertical-align: top !important;
}
.d-flex {
    display: flex !important;
}
.m-auto {
    margin: auto !important;
}
.text-exova {
    color: #479cf7 !important;
}
.p-3 {
    padding: 1rem !important;
}
    </style>
    <title>Document</title>
</head>
<nav class="p-3 bg-light">
    <div class="text-center">
        <img src="https://assets.exova.id/img/logo.png" alt="">
    </div>
</nav>
<body class="container">
    <div class="text-center text-white">
        <img width="250px" height="150px" src="https://assets.exova.id/payments.png">
    </div>
    <div><h2 class="text-center text-capitalize">Payment {{ $details->wal_status }}</h2></div>
    <div>
        <h1 class="text-center text-exova amount">IDR {{ number_format($details->wal_amount, 0) }}</h1>
    </div>
<table class="table table-bordered">
    <tbody>
        <tr>
            <td>Dari  <span class="float-right text-capitalize font-weight-bold">{{ $details->debitedwallet['walletusers']['name'] }}</span></td>
        </tr>
        <tr>
            <td>Kepada  <span class="float-right text-capitalize font-weight-bold">{{ $details->creditedwallet['walletusers']['name'] }}</span></td>
        </tr>
        <tr>
            <td>No. Akun  <span class="float-right text-capitalize font-weight-bold">****{{ substr($details->wal_debited_wallet, -4) }}</span></td>
        </tr>
        <tr>
            <td>Tipe Transaksi  <span class="float-right text-capitalize font-weight-bold">{{ $details->wal_transaction_type }}</span></td>
        </tr>
        <tr>
            <td>Catatan <span class="float-right text-capitalize font-weight-bold">{{ $details->wal_description }}</span></td>
        </tr>
        <tr>
            <td>Tanggal <span class="float-right text-capitalize font-weight-bold">{{ date('j M Y h:i:s', strtotime($details->updated_at)) }}</span></td>
        </tr>
    </tbody>
</table>
<footer class="footer">
  <div class="container text-center">
    <span class="text-muted">{{ date('Y') }} {{ ('Copyright | ') }}<a href="{{ config('app.url') }}">{{ ('Exova Indonesia') }}</span>
  </div>
</footer>
</body>
</html>
