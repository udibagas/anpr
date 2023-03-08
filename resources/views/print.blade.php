@extends('app')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>Tanggal / Hari</th>
                <th>Masuk</th>
                <th>Keluar</th>
                <th>Plat Nomor / Nomor Kartu</th>
                <th>Dari</th>
                <th>Tujuan</th>
                <th>Bongkar / Muat</th>
                <th>Keterangan</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @foreach($data as $d)
            <tr>
                <td>
                    {{$d['Tanggal']}} <br>
                    {{$d['Hari']}}
                </td>
                <td>
                    {{$d['Waktu Masuk']}} <br>
                    {{$d['Pos Masuk']}}
                </td>
                <td>
                    {{$d['Waktu Keluar']}} <br>
                    {{$d['Pos Keluar']}}
                </td>
                <td>
                    {{$d['Plat Nomor']}} <br>
                    {{$d['Nomor Kartu']}}
                </td>
                <td>{{$d['Dari']}}</td>
                <td>{{$d['Tujuan']}}</td>
                <td>{{$d['Bongkar/Muat']}}</td>
                <td>{{$d['Keterangan']}}</td>
                <td>{{$d['Status']}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection('content')
