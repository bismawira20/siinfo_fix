@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Pengajuan TTE</h1>
    </div>
    <div class="container">
        <div class="row my-3">
            <div class="col-md-8">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th width="30%">Nama</th>
                                <td>{{ $pengajuan->nama }}</td>
                            </tr>
                            <tr>
                                <th width="30%">NIP</th>
                                <td>{{ $pengajuan->nip }}</td>
                            </tr>
                            <tr>
                                <th width="30%">NIK</th>
                                <td>{{ $pengajuan->nik }}</td>
                            </tr>
                            <tr>
                                <th width="30%">Nama OPD</th>
                                <td>{{ $pengajuan->nama_opd }}</td>
                            </tr>
                            <tr>
                                <th width="30%">No Telepon</th>
                                <td>{{ $pengajuan->no_telp }}</td>
                            </tr>
                            <tr>
                                <th width="30%">Email Domain</th>
                                <td>{{ $pengajuan->email_domain }}</td>
                            </tr>
                            <tr>
                                <th width="30%">Jabatan</th>
                                <td>{{ $pengajuan->jabatan }}</td>
                            </tr>
                        </tbody>
                    </table>    
                </div>
            </div>
        </div>
    </div>
@endsection