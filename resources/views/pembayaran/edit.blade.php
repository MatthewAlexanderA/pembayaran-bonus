@extends('layout')

@section('content')

<div class="container-sm pt-3 p-5">

    <form action="{{ route('pembayaran.update', $pembayaran->id) }}" method="POST">
        @csrf
        @METHOD('PUT')

        <div class="mb-3">
            <a href="{{ route('pembayaran.index') }}" class="btn btn-danger">Back</a>
        </div>

        <div class="row mb-5">
            <div class="col-md-5 col-sm-12">
                <label for="pembayaran" class="form-label">Nominal</label>
            </div>
            <div class="col-md-7 col-sm-12">
                <input type="number" class="form-control" id="pembayaran" name="pembayaran" placeholder="Dalam rupiah" value="{{ $pembayaran->nominal }}" required>
            </div>
        </div>
        @foreach ($buruhs as $buruh)
            <div id="inputs">
                <input type="hidden" name="buruh_id[]" value="{{ $buruh->id }}">
                <div class="row mb-3">
                    <div class="col-md-5 col-sm-12">
                        <input type="text" class="form-control" name="nama_buruh[]" required placeholder="Nama Buruh" value="{{ $buruh->nama_buruh }}">
                    </div>
                    <div class="col-md-5 col-sm-12">
                        <div class="input-group">
                            <input type="number" step="0.01" class="form-control" name="percentage[]" id="percentage" value="{{ $buruh->percentage }}" required>
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        
        <button type="submit" class="btn btn-primary ms-3" style="float: right;">Update</button>

    </form>

</div>

    
@endsection