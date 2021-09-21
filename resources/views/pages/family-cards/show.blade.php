@extends('layouts.app')
@section('title', 'Family Cards')
@section('sub-title', 'Displays the entire list of family cards')
@section('main_title', 'Family Card Details')
@section('content')
    <div class="page-heading">
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex justify-content-between flex-column">
                        <p><b>Nomor Kartu Keluarga :</b> {{ $item->family_card_number }}.</p>
                        <p><b>Alamat Rumah :</b> {{ $item->address }}.</p>
                        <p><b>Kecamatan / Desa :</b> {{ $item->village }}.</p>
                    </div>
                    <div class="d-flex justify-content-between flex-column">
                        @if ($item->members->count() === 0)
                            <p><b>Nama Kepala Kelusarga :</b> Belum Ada Kepala Keluarga</p>                            
                        @else
                            <p><b>Nama Kepala Keluarga :</b> {{ $item->members->first()->residents->name }}</p>
                        @endif
                        <p><b>RT ( Rukun Tetangga ) :</b> {{ $item->rt }}.</p>
                        <p><b>RW ( Rukun Warga ) :</b> {{ $item->rw }}.</p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p>List Data Anggota Kerluarga</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('member.create', $item->id) }}" class="btn btn-primary btn-md mx-2">
                            <i class="fa fa-plus"></i> &nbsp; Tambah Anggota Keluarga
                        </a>
                        <a href="{{ route('family-card.index') }}" class="btn btn-danger btn-md">
                            <i class="fa fa-arrow-circle-left"></i> &nbsp; Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>NAMA ANGGOTA KELUARGA</th>
                                <th>JENIS KELAMIN</th>
                                <th>UMUR</th>
                                <th>HUBUNGAN KELUARGA</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->members as $member)
                                <tr>
                                    <td>{{ $member->residents->name }}</td>
                                    <td>{{ $member->residents->gender }}</td>
                                    <td>{{ $member->residents->age }}</td>
                                    <td>{{ $member->connection }}</td>
                                    <td>
                                        <a href="{{ route('resident.show', $member->id) }}" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $member->id }}" class="btn btn-info btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <form action="{{ route('member.delete', $member->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        <div class="modal fade" id="exampleModal{{ $member->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Detail Penduduk - {{ $item->family_card_number }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>NIK ( Nomor Induk Penduduk )</th>
                                                            <td>{{ $member->residents->id_number }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Nama Lengkap</th>
                                                            <td>{{ $member->residents->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Hubungan Keluarga</th>
                                                            <td>{{ $member->connection }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Jenis Kelamin</th>
                                                            <td>{{ $member->residents->gender }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Umur</th>
                                                            <td>{{ $member->residents->age }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Tempat Lahir</th>
                                                            <td>{{ $member->residents->place_of_birth }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Tanggal Lahir</th>
                                                            <td>{{ $member->residents->born_date }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Agama</th>
                                                            <td>{{ $member->residents->religion }}</td>
                                                        </tr>
                                                        {{-- <tr>
                                                            <th>Umur</th>
                                                            <td>{{ $age }}</td>
                                                        </tr> --}}
                                                        <tr>
                                                            <th>Pendidikan Terakhir</th>
                                                            <td>{{ $member->residents->education }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Jenis Pekerjaan</th>
                                                            <td>{{ $member->residents->type_of_work }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Status Pernikahan</th>
                                                            <td>{{ $member->residents->marital_status }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Alamat</th>
                                                            <td>{{ $member->residents->address }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>RT ( Rukun Tetangga )</th>
                                                            <td>{{ $member->residents->rt }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>RW ( Rukun Warga )</th>
                                                            <td>{{ $member->residents->rw }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Kecamatan / Desa</th>
                                                            <td>{{ $member->residents->village }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Kontak</th>
                                                            <td>{{ $member->residents->contact }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Email</th>
                                                            <td>{{ $member->residents->email }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection