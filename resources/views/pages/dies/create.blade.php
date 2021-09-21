@extends('layouts.app')
@section('title', 'Dies')
@section('main_title', 'Dies Create')
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
    <form action="{{ route('die.store') }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="helperText">Nama Penduduk</label>
        <select name="resident_id" class="form-select" id="inputGroupSelect01">
            <option selected>Choose...</option>
            @foreach ($residents as $resident)
                <option value="{{ $resident->id }}">{{ $resident->name }}</option>
            @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="helperText">Waktu Kematian</label>
        <input value="{{ old('date_of_death') }}" type="date" id="helperText" name="date_of_death" class="form-control" placeholder="Waktu Kematian">
      </div>
      <div class="form-group">
        <input type="hidden" name="name" class="form-control">
      </div>
      <div class="form-group mb-3">
          <label for="exampleFormControlTextarea1" class="form-label">Penyebab Kematian</label>
          <textarea class="form-control" name="reason" id="exampleFormControlTextarea1"
              rows="3">{{ old('reason') }}</textarea>
      </div>
      <button class="btn btn-primary">Sumbit</button>
    </div>
  </form>
</div>
@endsection