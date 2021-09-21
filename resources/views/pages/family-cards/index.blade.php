@extends('layouts.app')
@section('title', 'Family Cards')
@section('sub-title', 'Displays the entire list of family cards')
@section('main_title', 'Family Cards Page')
@section('content')
    <div class="page-heading">
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                   <p>List Data Kartu Kerluarga</p>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('file-export-family') }}" class="btn btn-success font-bold">Export&nbsp;<i class="fas fa-cloud-upload-alt"></i></a>
                        <div class="modal fade" id="import" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Import Data Penduduk</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('file-import-family') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                                            <div class="custom-file text-left">
                                                <input type="file" name="file" class="custom-file-input" id="customFile">
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="{{ route('template-family') }}" class="btn btn-info font-bold">Download Template&nbsp;<i class="fas fa-cloud-download-alt"></i></a>
                                    <button type="submit" class="btn btn-primary">Import&nbsp;<i class="fas fa-cloud-download-alt"></i></button>
                                    </form>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="filter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Filter Berdasarkan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                   <form action="" method="GET">
                                        <div class="form-group">
                                            <label for="helperText">RT ( Rukun Tetangga )</label>
                                                <input type="number" class="form-control" name="rt" placeholder="RT ( Rukun Tetangga )" value="{{ request()->get('rt') }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="helperText">RW ( Rukun Warga )</label>
                                                <input type="number" class="form-control" name="rw" placeholder="RW ( Rukun Warga )" value="{{ request()->get('rw') }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="helperText">Kecamatan / Desa</label>
                                                <input type="text" class="form-control" name="village" placeholder="Kecamatan / Desa" value="{{ request()->get('village') }}">
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" formaction="{{ route('family-card.reset') }}" class="btn btn-danger">Reset</button>
                                    <button type="submit" formaction="{{ route('family-card.index') }}" class="btn btn-primary">Terapkan</button>
                                    </form>
                                </div>
                                </div>
                            </div>
                        </div>
                        <button data-bs-toggle="modal" data-bs-target="#import" class="btn btn-info font-bold mx-3">
                            Import&nbsp;<i class="fas fa-cloud-download-alt"></i>
                        </button>
                        <button data-bs-toggle="modal" data-bs-target="#filter" class="btn btn-primary font-bold">
                            Filter&nbsp;<i class="fas fa-filter"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>NOMOR KARTU KELUARGA</th>
                                <th>RT</th>
                                <th>RW</th>
                                <th>KECAMATAN / DESA</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->family_card_number }}</td>
                                    <td>{{ $item->rt }}</td>
                                    <td>{{ $item->rw }}</td>
                                    <td>{{ $item->village }}</td>
                                    <td>
                                        <a href="{{ route('family-card.show', $item->id) }}" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id }}" class="btn btn-info btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Preview Detail Kartu Keluarga</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>Nomor Katru Keluarga</th>
                                                            <td>{{ $item->family_card_number }}</td>
                                                        </tr>
                                                        {{-- <tr>
                                                            <th>Nama Kartu Keluarga</th>
                                                            <td>{{ $item->members->where('connection', 'KEPALA_KELUARGA') }}</td>
                                                        </tr> --}}
                                                        <tr>
                                                            <th>RT ( Rukun Tetangga )</th>
                                                            <td>{{ $item->rt }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>RW ( Rukun Warga )</th>
                                                            <td>{{ $item->rw }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Anggota Keluarga</th>
                                                            <td>
                                                            <table class="tabble table-bordered w-100">
                                                                <tr>
                                                                    <th>Nama</th>
                                                                    <th>Hubungan</th>
                                                                </tr>
                                                                @foreach ($item->members as $member)
                                                                    <tr>
                                                                        <td>{{ $member->residents->name }}</td>
                                                                        <td>{{ $member->connection }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    @if ($item->id === $item->members->count())
                                                        <a href="{{ route('family-card.show', $item->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i>&nbsp; Lihat Detail</a>
                                                    @else
                                                        <a href="{{ route('member.create', $item->id) }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Tambah Anggota Keluarga</a>
                                                    @endif
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="{{ route('family-card.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <button data-bs-toggle="modal" data-bs-target="#delete" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin menghapus data ini?</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <form action="{{ route('family-card.delete', $item->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger">
                                                        <i class="fas fa-trash"></i>&nbsp; Hapus Data
                                                        </button>
                                                    </form>
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

    @push('before-script')
        <script src="/dist/assets/vendors/simple-datatables/simple-datatables.js"></script>
        <script>
            // Simple Datatable
            let table1 = document.querySelector('#table1');
            let dataTable = new simpleDatatables.DataTable(table1);
        </script>
    @endpush
@endsection