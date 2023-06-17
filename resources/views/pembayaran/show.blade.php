@extends('layout')

@section('content')

<div class="container-sm pt-3 p-5">

    <div class="mb-3">
        <a href="{{ route('pembayaran.index') }}" class="btn btn-danger">Back</a>
        <a href="{{ route('pembayaran.edit', $pembayaran->id) }}" class="btn btn-primary ms-1">Edit</a>
    </div>

    <div class="card p-5">
        <h4 class="text-center bg-secondary p-3" style="color: #fff;">Nominal Bonus: Rp {{ number_format($pembayaran->nominal, 0, ',', '.') }}</h4>

        <table class="table table-bordered">
            <thead>
                <tr>
                  <th scope="col">Nama Buruh</th>
                  <th scope="col">Percentage</th>
                  <th scope="col">Nonimal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($buruhs as $buruh)
                    <tr>
                        <td class="text-warp">{{ $buruh->nama_buruh }}</td>
                        <td class="text-warp">{{ $buruh->percentage }}%</td>
                        @php
                            $total = ($buruh->percentage * $pembayaran->nominal) / 100;
                        @endphp
                        <td class="text-warp">Rp {{ number_format($total, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>

</div>

@endsection