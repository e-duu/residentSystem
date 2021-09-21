@extends('layouts.app')
@section('title', 'Data Dies')
@section('sub-title', 'Displays the entire list of Data Dies')
@section('main_title', 'Data Dies Page')
@section('content')
    <div class="page-heading">
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                   <p>List Data Kematian</p>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('file-export-die') }}" class="btn btn-success font-bold">Export&nbsp;<i class="fas fa-cloud-upload-alt"></i></a>
                        <div class="modal fade" id="import" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Import Data Penduduk</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('file-import-die') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                                            <div class="custom-file text-left">
                                                <input type="file" name="file" class="custom-file-input" id="customFile">
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="{{ route('template-die') }}" class="btn btn-info font-bold">Download Template&nbsp;<i class="fas fa-cloud-download-alt"></i></a>
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
                                            <label for="helperText">Penyebab Kematian</label>
                                                <input type="text" class="form-control" name="reason" placeholder="Penyebab Kematian" value="{{ request()->get('reason') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="helperText">Waktu Kematian</label>
                                                <input type="date" class="form-control" name="date_of_death" placeholder="Waktu Kematian" value="{{ request()->get('date_of_death') }}">
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" formaction="{{ route('die.reset') }}" class="btn btn-danger">Reset</button>
                                    <button type="submit" formaction="{{ route('die.index') }}" class="btn btn-primary">Terapkan</button>
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
                                <th>NAMA PENDUDUK</th>
                                <th>WAKTU KEMATIAN</th>
                                <th>PENYEBAB KEMATIAN</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->date_of_death }}</td>
                                    <td>{{ $item->reason }}</td>
                                    <td>
                                        <a href="{{ route('die.edit', $item->id) }}" class="btn btn-primary btn-sm">
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
                                                    <form action="{{ route('die.delete', $item->id) }}" method="POST" class="d-inline">
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