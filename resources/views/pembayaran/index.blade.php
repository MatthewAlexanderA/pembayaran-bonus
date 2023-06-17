@extends('layout')

@section('content')

<div class="container-sm pt-3 p-5">

    <div class="mb-3">
        <a href="{{ route('pembayaran.create') }}" class="btn btn-success">Create</a>
    </div>

    <div class="row card p-5">
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Nominal</th>
                    <th>Tanggal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pembayarans as $pembayaran)
                <tr>
                    <td></td>
                    <td>Rp {{ number_format($pembayaran->nominal, 0, ',', '.') }}</td>
                    <td>{{ $pembayaran->created_at->format('d M Y') }}</td>

                    <td>
                        <form action="{{ route('pembayaran.destroy',$pembayaran->id) }}" method="POST">

                            <a class="btn btn-warning" href="{{ route('pembayaran.show',$pembayaran->id) }}">Detail</a>
                            <a class="btn btn-primary" href="{{ route('pembayaran.edit',$pembayaran->id) }}">Edit</a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Delete?')">Delete</button>
                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Nominal</th>
                    <th>Tanggal</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>

</div>

<!-- Datatables JS -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });

</script>

<!-- Page specific script -->
<script>
$(function () {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
});

</script>

@endsection