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
    <form action="{{ route('member.store') }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="helperText">Nomor Kartu Keluarga</label>
        <select name="family_card_id" class="form-select" id="inputGroupSelect01">
          <option value="{{ $families->id }}">{{ $families->family_card_number }}</option>
        </select>
      </div>
      <div class="form-group">
        <label for="helperText">Nama Anggota Keluarga</label>
        <select name="resident_id" class="form-select" id="inputGroupSelect01">
            <option selected>Choose...</option>
            @foreach ($residents as $resident)
                <option value="{{ $resident->id }}">{{ $resident->name }} - {{ $resident->id_number }}</option>
            @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="helperText">Hubungan Keluarga</label>
        <select name="connection" class="form-select" id="inputGroupSelect01">
            <option selected>Choose...</option>
            <option value="KEPALA_KELUARGA">KEPALA KELUARGA</option>
            <option value="ISTRI">ISTRI</option>
            <option value="ANAK">ANAK</option>
            <option value="KELUARGA_LAIN">KELUARGA LAIN</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Sumbit</button>
    </div>
  </form>
</div>
@endsection