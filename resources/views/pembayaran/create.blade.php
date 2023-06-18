@extends('layout')

@section('content')

<div class="container-sm pt-3 p-5">

    <form action="{{ route('logout') }}" method="post" class="mb-3">
        @csrf
        <button class="btn btn-danger" style="float: right;" type="submit">Logout</button>
    </form>

    <form action="{{ route('store-pembayaran') }}" method="POST">
        @csrf
        @METHOD('POST')

        <div class="mb-3">
            @if (Auth::user()->role == 'admin')
                <a href="{{ route('admin-dashboard') }}" class="btn btn-danger">Back</a>
            @else
                <a href="{{ route('user-dashboard') }}" class="btn btn-danger">Back</a>
            @endif
        </div>

        <div class="row mb-5">
            <div class="col-md-4 col-sm-12">
                <label for="pembayaran" class="form-label">Nominal</label>
            </div>
            <div class="col-md-8 col-sm-12">
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="text" class="form-control" id="pembayaran" name="pembayaran" placeholder="Dalam rupiah" required>
                </div>
            </div>
        </div>
        <div id="inputs">
            <div class="row mb-3">
                <div class="col-md-4 col-sm-12">
                    <input type="text" class="form-control" name="nama_buruh[]" required placeholder="Nama Buruh">
                </div>
                <div class="col-md-5 col-sm-12">
                    <div class="input-group">
                        <input type="number" step="0.01" class="form-control" name="percentage[]" id="percentage1" required onfocus="count(1)" value="0">
                        <span class="input-group-text">%</span>
                        <span class="input-group-text">
                            <button class="remove-btn btn btn-danger">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </span>
                    </div>
                </div>
                <div class="col-3" id="output1"></div>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary ms-3" style="float: right;">Submit</button>
        <button id="add-btn" class="btn btn-success ms-3" style="float: right;">Add</button>

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

<script>
    const addButton = document.querySelector('#add-btn');
    const inputsContainer = document.querySelector('#inputs');
    let buruh = 1;

    addButton.addEventListener('click', function (event) {
        buruh ++;

        event.preventDefault();
        const inputRow = document.createElement('div');
        inputRow.className = 'row mb-3';

        const inputDiv1 = document.createElement('div');
        inputDiv1.className = 'col-md-4 col-sm-12';

        const nameLabel = document.createElement('input');
        nameLabel.setAttribute('type', 'text');
        nameLabel.setAttribute('placeholder', 'Nama Buruh');
        nameLabel.setAttribute('name', 'nama_buruh[]');
        nameLabel.className = 'form-control';
        nameLabel.required = true;

        const inputDiv2 = document.createElement('div');
        inputDiv2.className = 'col-md-5 col-sm-12';

        const inputGroup = document.createElement('div');
        inputGroup.className = 'input-group';

        const nameInput = document.createElement('input');
        nameInput.setAttribute('type', 'number');
        nameInput.setAttribute('name', 'percentage[]');
        nameInput.setAttribute('id', 'percentage' + buruh);
        nameInput.setAttribute('step', '0.01');
        nameInput.setAttribute('onfocus', 'count(' + buruh + ')');
        nameInput.setAttribute('value', '0');
        nameInput.className = 'form-control';
        nameInput.required = true;

        const spanText = document.createElement('span');
        spanText.className = 'input-group-text';
        spanText.textContent = ' %';

        const spanBtn = document.createElement('span');
        spanBtn.className = 'input-group-text';

        const removeButton = document.createElement('button');
        removeButton.className = 'remove-btn btn btn-danger';
        removeButton.addEventListener('click', function () {
            inputRow.remove();
        });

        const btnIcon = document.createElement('i');
        btnIcon.className = 'fa-solid fa-trash-can';

        const inputDiv3 = document.createElement('div');
        inputDiv3.className = 'col-3';
        inputDiv3.setAttribute('id', 'output' + buruh);

        inputRow.appendChild(inputDiv1);
        inputRow.appendChild(inputDiv2);
        inputRow.appendChild(inputDiv3);
        inputDiv1.appendChild(nameLabel);
        inputDiv2.appendChild(inputGroup);
        inputGroup.appendChild(nameInput);
        inputGroup.appendChild(spanText);
        inputGroup.appendChild(spanBtn);
        spanBtn.appendChild(removeButton);
        removeButton.appendChild(btnIcon);
        inputsContainer.appendChild(inputRow);
    });

    document.addEventListener('click', function (event) {
        if (event.target && event.target.className === 'remove-btn') {
            event.preventDefault();
            event.target.parentElement.remove();
        }
    });
</script>
    
@endsection