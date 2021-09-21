@extends('layouts.app')
@section('title', 'Residents')
@section('main_title', 'Residents Edit')
@section('sub-title', 'Please fill out the form below')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="card">
  <div class="card-header">
    <h4>Input Data</h4>
  </div>
  <div class="card-body">
    <form action="{{ route('resident.update', $residents->id) }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="helperText">Nama Lengkap</label>
        <input value="{{ old('name') ? old('name') : $residents->name }}" type="text" id="helperText" name="name" class="form-control" placeholder="Nama Lengkap">
      </div>
      <div class="form-group">
        <label for="helperText">NIK ( Nomor Induk Kependudukan )</label>
        <input value="{{ old('id_number') ? old('id_number') : $residents->id_number }}" type="text" id="helperText" name="id_number" class="form-control" placeholder="NIK ( Nomor Induk Kependudukan )">
      </div>
      <div class="form-group">
        <label for="helperText">Email</label>
        <input value="{{ old('email') ? old('email') : $residents->email }}" type="email" id="helperText" name="email" class="form-control" placeholder="Email">
      </div>
      <div class="form-group">
        <label for="gender" class="form-control-label">Jenis Kelamin</label>
        <br>
        <label>
          <input class="form-check-input" type="radio" name="gender" value="MAN" {{$residents->gender == 'MAN'? 'checked' : ''}} /> Laki - Laki
        </label>
        &nbsp;
        <label>
        <input class="form-check-input" type="radio" name="gender" value="WOMAN" {{$residents->gender == 'WOMAN'? 'checked' : ''}} /> Wanita
        </label>
        <label>
          <input class="form-check-input" type="radio" name="gender" value="OTHER" {{$residents->gender == 'OTHER'? 'checked' : ''}} /> Lainnya
        </label>
      </div>
      <div class="row">
        <div class="col-md-6 col-12 mr-2">
          <div class="form-group">
            <label for="first-name-column">Tempat Lahir</label>
            <input value="{{ old('place_of_birth') ? old('place_of_birth') : $residents->place_of_birth }}" type="text" id="first-name-column" class="form-control"
                placeholder="Tempat Lahir" name="place_of_birth">
          </div>
        </div>
        <div class="col-md-6 col-12">
          <div class="form-group">
            <label for="last-name-column">Tanggal Lahir</label>
            <input value="{{ old('born_date') ? old('born_date') : $residents->born_date }}" type="date" id="last-name-column" class="form-control"
                placeholder="Tanggal Lahir" name="born_date">
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="helperText">Agama</label>
        <select name="religion" class="form-select" id="inputGroupSelect01">
            <option selected>{{ old('religion') ? old('religion') : $residents->religion }}</option>
            <option value="ISLAM">ISLAM</option>
            <option value="KATOLIK">KATOLIK</option>
            <option value="HINDU">HINDU</option>
            <option value="BUDDHA">BUDDHA</option>
            <option value="KRISTEN">KRISTEN</option>
            <option value="KHONGHUCU">KHONGHUCU</option>
            <option value="ATHEIS">ATHEIS</option>
        </select>
      </div>
      <div class="form-group">
        <label for="helperText">Pendidikan Terakhir</label>
        <input value="{{ old('education') ? old('education') : $residents->education }}" type="text" id="helperText" class="form-control" name="education" placeholder="Pendidikan Terakhir">
      </div>
      <div class="form-group">
        <label for="helperText">Jenis Pekerjaan</label>
        <input value="{{ old('type_of_work') ? old('type_of_work') : $residents->type_of_work }}" type="text" id="helperText" class="form-control" name="type_of_work" placeholder="Jenis Pekerjaan">
      </div>
      <div class="form-group">
        <label for="helperText">Status Pernikahan</label>
        <select name="marital_status" class="form-select" id="inputGroupSelect01">
            <option selected>{{ old('marital_status') ? old('marital_status') : $residents->marital_status }}</option>
            <option value="MARRIED">MARRIED</option>
            <option value="WIDOWED">WIDOWED</option>
            <option value="SEPARATED">SEPARATED</option>
            <option value="DIVORCED">DIVORCED</option>
            <option value="SINGLE">SINGLE</option>
          </div>
        </select>
      </div>
      <div class="form-group mb-3">
          <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
          <textarea class="form-control" name="address" id="exampleFormControlTextarea1"
              rows="3">{{ old('address') ? old('address') : $residents->address }}</textarea>
      </div>
      <div class="form-group">
        <label for="helperText">RT ( Rukun Tetangga )</label>
        <input value="{{ old('rt') ? old('rt') : $residents->rt }}" type="number" id="helperText" class="form-control" name="rt" placeholder="RT ( Rukun Tetangga )">
      </div>
      <div class="form-group">
        <label for="helperText">RW ( Rukun Warga )</label>
        <input value="{{ old('rw') ? old('rw') : $residents->rw }}" type="number" id="helperText" class="form-control" name="rw" placeholder="RW ( Rukun Warga )">
      </div>
      <div class="form-group">
        <label for="helperText">Kontak</label>
        <input value="{{ old('contact') ? old('contact') : $residents->contact }}" type="number" id="helperText" class="form-control" name="contact" placeholder="Kontak">
      </div>
      <div class="form-group">
        <label for="helperText">Kecamatan / Desa</label>
        <input value="{{ old('village') ? old('village') : $residents->village }}" type="text" id="helperText" class="form-control" name="village" placeholder="Kecamtan / Desa">
      </div>
      <button class="btn btn-primary">Sumbit</button>
    </div>
  </form>
</div>
@endsection