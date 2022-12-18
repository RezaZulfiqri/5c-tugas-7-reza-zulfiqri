@extends('layouts.master')
@section('title','Data UKM Unsika')
@section('active3','active')
@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        
        @error(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Data gagal diubah/diinput, silahkan input kembali data UKM.</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @enderror

        <div class="card p-4">
            <h3 class="fw-bold">Data UKM Unsika</h3>
            <div class="card-body">
                <div class="tambahdata mb-3 d-flex justify-content-end">
                    <a href="{{ route('ukm.create') }}" class="btn btn-success">Tambah Data</a>
                </div>
                <div class="row g-3 align-items-center mb-3">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr  class="align-middle" style="text-align: center">
                                <th>No</th>
                                <th>Nama UKM</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ukms as $ukm)
                            <tr class="align-middle" @if($loop->odd)  style="background-color: #f1f3f5; text-align: center"  @endif>
                                <td class="align-middle" style="text-align: center">{{ $loop->iteration + $ukms->firstItem() - 1 }}</td>
                                <td class="align-middle" style="text-align: center">{{ $ukm->nama_ukm }}</td>
                                <td class="align-middle" style="text-align: center">
                            <a href="{{ route('ukm.edit',['ukm' => $ukm->id]) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('ukm.destroy',['ukm'=>$ukm->id]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger mt-2">Hapus</button>
                            </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-start sm">
                        Showing
                        {{ $ukms->firstItem() }}
                        to
                        {{ $ukms->lastItem() }}
                        of
                        {{ $ukms->total() }}
                        entries
                    </div>
                    <div class="paginate d-flex justify-content-center sm">
                    {{ $ukms->links() }}
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection