<div>
    <p><strong>Laporan Perjalanan</strong></p>
    <p>Total Data : @if (count($perjalanan) > 0) {{ count($perjalanan)." data" }} @else Tidak ada data @endif</p>
</div>
<br>
<table border="1">
    <thead style="font-weight: bold">
        <tr>
            <th style="font-weight: bold">No.</th>
            <th style="font-weight: bold">Petugas Input</th>
            <th style="font-weight: bold">Petugas Submit</th>
            <th style="font-weight: bold">Tanggal</th>
            <th style="font-weight: bold">Jenis Kendaraan</th>
            <th style="font-weight: bold">No Pol/Bod</th>
            <th style="font-weight: bold">Nama Driver</th>
            <th style="font-weight: bold">Jumlah Penumpang</th>
            <th style="font-weight: bold">Waktu Pos 1</th>
            <th style="font-weight: bold">Waktu Pos 9</th>
            <th style="font-weight: bold">Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @php
        $no = 1;
        @endphp
        @foreach ($perjalanan as $row)
        <tr style="vertical-align: middle">
            <td>{{ $no++ }}</td>
            <td>{{ $row->petugas_input }}</td>
            <td>{{ $row->petugas_submit }}</td>
            <td>{{ date('d-m-Y',strtotime($row->tanggal)) }}</td>
            <td>{{ $row->jenis }}</td>
            <td>{{ $row->nopol }}</td>
            <td>{{ $row->driver }}</td>
            <td>{{ $row->penumpang }}</td>
            <td>{{ $row->pos1 }}</td>
            <td>{{ $row->pos9 }}</td>
            <td>
                @if ($row->selisih > 22)
                <span class="text-success">Kecepatan normal dan baik</span>
                @elseif ($row->selisih == 22)
                <span class="text-success">Kecepatan normal </span>
                @else
                <span class="text-danger">Kecepatan diatas standar yang telah ditetapkan</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>