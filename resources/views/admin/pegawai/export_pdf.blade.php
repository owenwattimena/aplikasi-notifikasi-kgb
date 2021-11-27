<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DATA BEZETTING PEGAWAI NEGERI SIPIL</title>
    <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    
    <style>
        table, td, th{
            border : 1px solid black;
            border-collapse: collapse;
        }
        table td, table th{
            padding: 5px;
        }
        .center {
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
    <h1 class="text-center">DATA BEZETTING PEGAWAI NEGERI SIPIL</h1>
    <h1 class="text-center">DI LINGKUNGAN PEMERINTAH KOTA AMBON</h1>
    <h1 class="text-center">MENURUT KEADAAN : {{ $keadaan }}</h1>
    @if (isset($data_pegawai['gol_ruang']))
    <p>
        <strong>
            GOL. RUANG : {{ $data_pegawai['gol_ruang'] }}
        </strong>
    </p>
    @endif
    @if (isset($data_pegawai['jabatan']))
    <p>
        <strong>
            JABATAN : {{ $data_pegawai['jabatan'] }}
        </strong>
    </p>
    @endif
    @if (isset($data_pegawai['unit_kerja']))
    <p>
        <strong>
            UNIT KERJA : {{ $data_pegawai['unit_kerja'] }}
        </strong>
    </p>
    @endif
    <table style="width: 100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>NAMA</th>
                <th>NIP</th>
                @if (!isset($data_pegawai['gol_ruang']))
                <th>GOL. RUANG</th>
                @endif
                <th>SK TERAKHIR</th>
                <th>TMT</th>
                @if (!isset($data_pegawai['jabatan']))
                <th>JABATAN SEKARANG</th>
                @endif
                <th>TMT BERKALA AKAN DATANG</th>
                @if (!isset($data_pegawai['unit_kerja']))
                <th>UNIT KERJA</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($data_pegawai['pegawai'] as $key => $item)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->nip }}</td>
                @if (!isset($data_pegawai['gol_ruang']))
                <td>{{ $item->gol_ruang->gol_ruang }}</td>
                @endif
                <td>{{ $item->sk_terakhir }}</td>
                <td>{{ $item->tmt }}</td>
                @if (!isset($data_pegawai['jabatan']))
                <td>{{ $item->jabatan->jabatan }}</td>
                @endif
                <td>
                    @php
                    $masaTmt = masaBerakhirTMT($item->tmt_berkala_akan_datang);
                    @endphp
                    <span class="text-{{ $masaTmt <= 0 ? 'danger' : ($masaTmt <= 100 && $masaTmt > 0 ? 'warning' : '') }}">
                        {{ $item->tmt_berkala_akan_datang }}
                    </span>
                </td>
                @if (!isset($data_pegawai['unit_kerja']))
                <td>{{ $item->unit_kerja->unit_kerja }}</td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
    
</body>
</html>