<table>
    <tr><th style="text-align:center" colspan="4"><b>Detail Pendapatan</b></th></tr>
    <tr><th></th></tr>
  <thead>
  <tr>
    <th><b>Name</b></th>
    <th><b>Pendapatan Kotor</b></th>
    <th><b>Pendapatan Bersih</b></th>
    <th><b>Tanggal</b></th>
  </tr>
  </thead>
  <tbody>
  @foreach($revenue as $o)
  <tr>
    <td>{{ $o->orders['products']['jasa_name'] }}</td>
    <td>{{ rupiah($o->paid) }}</td>
    <td>{{ rupiah($o->amount) }}</td>
    <td>{{ parse_date($o->created_at) }}</td>
  </tr>
  @endforeach
  </tbody>
</table>