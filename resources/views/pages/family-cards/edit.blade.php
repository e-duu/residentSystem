@extends('layouts.app')
@section('title', 'Family Cards')
@section('main_title', 'Family Cards Create')
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
    <form action="{{ route('family-card.update', $families->id ) }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="helperText">No Kartu Keluarga</label>
        <input value="{{ old('family_card_number') ? old('family_card_number') : $families->family_card_number }}" type="number" id="helperText" name="family_card_number" class="form-control" placeholder="No Kartu Keluarga">
      </div>
      <div class="form-group mb-3">
          <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
          <textarea class="form-control" name="address" id="exampleFormControlTextarea1"
              rows="3">{{ old('address') ? old('address') : $families->address }}</textarea>
      </div>
      <div class="form-group">
        <label for="helperText">RT ( Rukun Tetangga )</label>
        <input value="{{ old('rt') ? old('rt') : $families->rt }}" type="number" id="helperText" class="form-control" name="rt" placeholder="RT ( Rukun Tetangga )">
      </div>
      <div class="form-group">
        <label for="helperText">RW ( Rukun Warga )</label>
        <input value="{{ old('rw') ? old('rw') : $families->rw }}" type="number" id="helperText" class="form-control" name="rw" placeholder="RW ( Rukun Warga )">
      </div>
      <div class="form-group">
        <label for="helperText">Kecamatan / Desa</label>
        <input value="{{ old('village') ? old('village') : $families->village }}" type="text" id="helperText" class="form-control" name="village" placeholder="Kecamtan / Desa">
      </div>
      <button class="btn btn-primary">Sumbit</button>
    </div>
  </form>
</div>
@endsection