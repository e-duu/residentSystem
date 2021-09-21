@extends('layouts.app')
@section('title', 'Moves')
@section('main_title', 'Moves Edit')
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
    <form action="{{ route('move.update', $moves->id) }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="helperText">Pelapor</label>
        <select name="resident_id" class="form-select" id="inputGroupSelect01">
            <option value="{{ old('resident_id') ? old('resident_id') : $moves->resident_id }}" selected>{{ $moves->residents->name }}</option>
            @foreach ($residents as $resident)
                <option value="{{ $resident->id }}">{{ $resident->name }}</option>
            @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="helperText">Waktu Migrasi</label>
        <input value="{{ old('migration_date') ? old('migration_date') : $moves->migration_date }}" type="date" id="helperText" name="migration_date" class="form-control" placeholder="Waktu Kematian">
      </div>
      <div class="form-group mb-3">
          <label for="exampleFormControlTextarea1" class="form-label">Alasan Pindah</label>
          <textarea class="form-control" name="reason" id="exampleFormControlTextarea1"
              rows="3">{{ old('reason') ? old('reason') : $moves->reason }}</textarea>
      </div>
      <button class="btn btn-primary">Sumbit</button>
    </div>
  </form>
</div>
@endsection