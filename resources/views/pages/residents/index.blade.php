@extends('layouts.app')
@section('title', 'Resident')
@section('sub-title', 'Displays the entire population list')
@section('main_title', 'Resident Page')
@section('content')
    <div class="page-heading">
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                   <p>List Data Penduduk</p>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('file-export-resident') }}" class="btn btn-success font-bold">Export&nbsp;<i class="fas fa-cloud-upload-alt"></i></a>
                        <div class="modal fade" id="import" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Import Data Penduduk</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('file-import-resident') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                                            <div class="custom-file text-left">
                                                <input type="file" name="file" class="custom-file-input" id="customFile">
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="{{ route('template-resident') }}" class="btn btn-info font-bold">Download Template&nbsp;<i class="fas fa-cloud-download-alt"></i></a>
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
                                            <label for="helperText">Jenis Kelamin</label>
                                            <select class="form-select" name="gender" value="{{ request()->get('gender') }}">
                                                <option value="0" selected>Choose....</option>
                                                <option value="MAN" value="{{ request()->get('gender') == 'MAN' ? 'selected' : '' }}">Man</option>
                                                <option value="WOMAN" value="{{ request()->get('gender') == 'WOMAN' ? 'selected' : '' }}">Woman</option>
                                                <option value="OTHER" value="{{ request()->get('gender') == 'OTHER' ? 'selected' : '' }}">Other</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="helperText">Agama</label>
                                            <select class="form-select" name="religion" value="{{ request()->get('religion') }}">
                                                <option value="0" selected>Choose....</option>
                                                <option value="ISLAM" value="{{ request()->get('religion') == 'ISLAM' ? 'selected' : '' }}">Islam</option>
                                                <option value="KRISTEN" value="{{ request()->get('religion') == 'KRISTEN' ? 'selected' : '' }}">Kristen</option>
                                                <option value="KATHOLIK" value="{{ request()->get('religion') == 'KATHOLIK' ? 'selected' : '' }}">Katholik</option>
                                                <option value="BUDDHA" value="{{ request()->get('religion') == 'BUDDHA' ? 'selected' : '' }}">Buddha</option>
                                                <option value="KHONGHUCU" value="{{ request()->get('religion') == 'KHONGHUCU' ? 'selected' : '' }}">Khonghucu</option>
                                                <option value="HINDU" value="{{ request()->get('religion') == 'HINDU' ? 'selected' : '' }}">Hindu</option>
                                                <option value="ATHEIS" value="{{ request()->get('religion') == 'ATHEIS' ? 'selected' : '' }}">Atheis</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="helperText">Status Pernikahan</label>
                                            <select class="form-select" name="marital_status" value="{{ request()->get('marital_status') }}">
                                                <option value="0" selected>Choose....</option>
                                                <option value="MARRIED" value="{{ request()->get('marital_status') == 'MARRIED' ? 'selected' : '' }}">Married</option>
                                                <option value="DIVORCED" value="{{ request()->get('marital_status') == 'DIVORCED' ? 'selected' : '' }}">Divorced</option>
                                                <option value="SEPARATED" value="{{ request()->get('marital_status') == 'SEPARATED' ? 'selected' : '' }}">Separated</option>
                                                <option value="WIDOWED" value="{{ request()->get('marital_status') == 'WIDOWED' ? 'selected' : '' }}">Widowed</option>
                                                <option value="SINGLE" value="{{ request()->get('marital_status') == 'SINGLE' ? 'selected' : '' }}">Single</option>
                                            </select>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" formaction="{{ route('resident.reset') }}" class="btn btn-danger">Reset</button>
                                    <button type="submit" formaction="{{ route('resident.index') }}" class="btn btn-primary">Terapkan</button>
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
                                <th>NAMA</th>
                                <th>JENIS KELAMIN</th>
                                <th>AGAMA</th>
                                <th>STATUS PERNIKAHAN</th>
                                <th>PEKERJAAN</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->gender }}</td>
                                    <td>{{ $item->religion }}</td>
                                    <td>{{ $item->marital_status }}</td>
                                    <td>{{ $item->type_of_work }}</td>
                                    <td>
                                        <a href="{{ route('resident.show', $item->id) }}" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id }}" class="btn btn-info btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Detail Penduduk</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>Nomor Kartu Keluarga</th>
                                                            <td>
                                                                @if ($family->resident_id == $item->id)
                                                                    {{ $family->family_cards->family_card_number }}
                                                                @else
                                                                    <p class="text-mute">Belum memiliki kartu keluarga</p>
                                                                @endif    
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Hubungan Keluarga</th>
                                                                @if ($family->resident_id == $item->id)
                                                                    <td>{{ $family->connection }}</td>
                                                                @else
                                                                    <td>Belum terdaftar di kartu keluarga</td>
                                                                @endif    
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>NIK ( Nomor Induk Penduduk )</th>
                                                            <td>{{ $item->id_number }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Nama Lengkap</th>
                                                            <td>{{ $item->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Jenis Kelamin</th>
                                                            <td>{{ $item->gender }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Umur</th>
                                                            <td>{{ $item->age }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Tempat Lahir</th>
                                                            <td>{{ $item->place_of_birth }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Tanggal Lahir</th>
                                                            <td>{{ $item->born_date }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Agama</th>
                                                            <td>{{ $item->religion }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Pendidikan Terakhir</th>
                                                            <td>{{ $item->education }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Jenis Pekerjaan</th>
                                                            <td>{{ $item->type_of_work }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Status Pernikahan</th>
                                                            <td>{{ $item->marital_status }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Alamat</th>
                                                            <td>{{ $item->address }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>RT ( Rukun Tetangga )</th>
                                                            <td>{{ $item->rt }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>RW ( Rukun Warga )</th>
                                                            <td>{{ $item->rw }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Kecamatan / Desa</th>
                                                            <td>{{ $item->village }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Kontak</th>
                                                            <td>{{ $item->contact }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Email</th>
                                                            <td>{{ $item->email }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                                                    <a href="{{ route('family-card.show', $item->id) }}" type="button" class="btn btn-primary"><i class="fa fa-eye"></i>&nbsp; Lihat Kartu Keluarga</a>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="{{ route('resident.edit', $item->id) }}" class="btn btn-primary btn-sm">
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
                                                        <form action="{{ route('resident.delete', $item->id) }}" method="POST" class="d-inline">
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
            var myModal = document.getElementById('myModal')
            var myInput = document.getElementById('myInput')

            myModal.addEventListener('shown.bs.modal', function () {
            myInput.focus()
            })
        </script>
    @endpush
@endsection