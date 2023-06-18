@extends('layout')

@section('content')

<div class="container-sm pt-3 p-5">

    <form action="{{ route('logout') }}" method="post" class="mb-3">
        @csrf
        <button class="btn btn-danger" style="float: right;" type="submit">Logout</button>
    </form>

    <form action="{{ route('update-pembayaran', $pembayaran->id) }}" method="POST">
        @csrf
        @METHOD('PUT')

        <div class="mb-3">
            @if (Auth::user()->role == 'admin')
                <a href="{{ route('admin-dashboard') }}" class="btn btn-danger">Back</a>
            @else
                <a href="{{ route('user-dashboard') }}" class="btn btn-danger">Back</a>
            @endif
        </div>

        <div class="row mb-5">
            <div class="col-md-5 col-sm-12">
                <label for="pembayaran" class="form-label">Nominal</label>
            </div>
            <div class="col-md-7 col-sm-12">
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="text" class="form-control" id="pembayaran" name="pembayaran" placeholder="Dalam rupiah" value="{{ $pembayaran->nominal }}" required>
                </div>
            </div>
        </div>
        @php
            $number = 1;
        @endphp
        @foreach ($buruhs as $buruh)
            <div id="inputs">
                <input type="hidden" name="buruh_id[]" value="{{ $buruh->id }}">
                <div class="row mb-3">
                    <div class="col-md-4 col-sm-12">
                        <input type="text" class="form-control" name="nama_buruh[]" required placeholder="Nama Buruh" value="{{ $buruh->nama_buruh }}">
                    </div>
                    <div class="col-md-5 col-sm-12">
                        <div class="input-group">
                            <input type="number" step="0.01" class="form-control" name="percentage[]" id="percentage{{ $number }}" value="{{ $buruh->percentage }}" required onfocus="count({{ $number }})">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                    <div class="col-3" id="output{{ $number }}"></div>
                </div>
            </div>
            @php
                $number ++;
            @endphp
        @endforeach

        
        <button type="submit" class="btn btn-primary ms-3" style="float: right;">Update</button>

    </form>

</div>

<script>
    function count(id) {
        const pembayaran = document.getElementById('pembayaran');
        const percentage = document.getElementById('percentage' + id);
        const output = document.getElementById('output' + id);

        pembayaran.addEventListener('input', calculateResult);
        percentage.addEventListener('input', calculateResult);

        function calculateResult() {
        const raw = pembayaran.value;
        const change = raw.replace(/,/g, '');
        const value1 = parseInt(change);
        const value2 = Number(percentage.value);

        const result = value1 * value2 / 100;
        
        output.innerText = 'Rp ' + result.toLocaleString();
        }
    }
</script>

<script>
    const inputElement = document.getElementById('pembayaran');

    inputElement.addEventListener('input', function(e) {
    const rawValue = e.target.value;
    const formattedValue = formatNumber(rawValue);
    
    e.target.value = formattedValue;
    });

    function formatNumber(value) {
    // Remove non-numeric characters
    const numericValue = value.replace(/\D/g, '');
    
    // Apply number formatting logic (e.g., adding commas)
    const formattedValue = new Intl.NumberFormat().format(numericValue);
    
    return formattedValue;
    }
</script>
    
@endsection