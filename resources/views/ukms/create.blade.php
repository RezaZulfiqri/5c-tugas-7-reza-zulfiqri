@extends('layouts.master')
@section('title','Input Data UKM')
@section('active3','active')
@section('content')
<div class="container pt-4 bg-white">
    <div class="row">
        <div class="col-md-8">
            <h2>Input Data UKM</h2>
            @if (session()->has('message'))
            <div class="my-3">
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        </div> 
            @endif 
            <form action="{{ route('ukm.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" name="nama_ukm" placeholder="Example : UKM Wayang (Fakyuyang)" id="nama_ukm" 
                    class="form-control" value="{{ old('nama_ukm') }}">
                    <label for="nama_ukm">Nama UKM</label>
                    @error('nama_ukm')
                    <div class="text-danger">
                    {{ $message }}    
                    </div> 
                    @enderror
                </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
        </div>
    </div>
</div>
@endsection