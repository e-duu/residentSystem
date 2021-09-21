@extends('layouts.app')
@section('title', 'Comers')
@section('main_title', 'Comers Edit')
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
    <form action="{{ route('comer.update', $comers->id) }}" method="POST">
      @csrf
      @method('POST')
      <div class="form-group">
        <label for="helperText">NIK ( Nomor Induk Kependudukan )</label>
        <input name="id_number" value="{{ old('id_number') ? old('id_number') : $comers->id_number }}" class="form-control" />
      </div>
      <div class="form-group">
        <label for="helperText">Nama Lengkap</label>
        <input value="{{ old('name') ? old('name') : $comers->name }}" type="text" id="helperText" name="name" class="form-control" placeholder="Nama Lengkap">
      </div>
      <div class="form-group">
        <label for="gender" class="form-control-label">Jenis Kelamin</label>
        <br>
        <label>
          <input class="form-check-input" type="radio" name="gender" value="MAN" {{$comers->gender == 'MAN'? 'checked' : ''}} /> Laki - Laki
        </label>
        &nbsp;
        <label>
        <input class="form-check-input" type="radio" name="gender" value="WOMAN" {{$comers->gender == 'WOMAN'? 'checked' : ''}} /> Wanita
        </label>
        <label>
          <input class="form-check-input" type="radio" name="gender" value="OTHER" {{$comers->gender == 'OTHER'? 'checked' : ''}} /> Lainnya
        </label>
      </div>  
      <div class="form-group">
        <label for="helperText">Waktu Kedatangan</label>
        <input value="{{ old('arrival') ? old('arrival') : $comers->arrival }}" type="date" id="helperText" name="arrival" class="form-control" placeholder="Waktu Kedatangan">
      </div>
      <div class="form-group">
        <label for="helperText">Pelapor</label>
        <select name="resident_id" class="form-select" id="inputGroupSelect01">
            <option value="{{ old('resident_id') ? old('resident_id') : $comers->resident_id }}" selected>{{ $comers->residents->name }}</option>
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