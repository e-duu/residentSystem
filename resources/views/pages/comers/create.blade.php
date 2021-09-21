@extends('layouts.app')
@section('title', 'Comers')
@section('main_title', 'Comers Create')
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
    <form action="{{ route('comer.store') }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="helperText">NIK ( Nomor Induk Kependudukan )</label>
        <input value="{{ old('id_number') }}" type="number" id="helperText" name="id_number" class="form-control" placeholder="NIK ( Nomor Induk Kependudukan )">
      </div>
      <div class="form-group">
        <label for="helperText">Nama Lengkap</label>
        <input value="{{ old('name') }}" type="text" id="helperText" name="name" class="form-control" placeholder="Nama Lengkap">
      </div>
      <div class="form-group">
        <label for="gender" class="form-control-label">Jenis Kelamin</label>
        <br>
        <label>
          <input class="form-check-input" type="radio" name="gender" value="MAN" /> Laki - Laki
        </label>
        &nbsp;
        <label>
          <input class="form-check-input" type="radio" name="gender" value="WOMAN" /> Wanita
        </label>
        <label>
          <input class="form-check-input" type="radio" name="gender" value="OTHER" /> Lainnya
        </label>
      </div>  
      <div class="form-group">
        <label for="helperText">Waktu Kedatangan</label>
        <input value="{{ old('arrival') }}" type="date" id="helperText" name="arrival" class="form-control" placeholder="Waktu Kedatangan">
      </div>
      <div class="form-group">
        <label for="helperText">Pelapor</label>
        <select name="resident_id" class="form-select" id="inputGroupSelect01">
            <option selected>Choose...</option>
            @foreach ($residents as $resident)
                <option value="{{ $resident->id }}">{{ $resident->name }}</option>
            @endforeach
        </select>
      </div>
      <button class="btn btn-primary">Sumbit</button>
    </div>
  </form>
</div>
@endsection