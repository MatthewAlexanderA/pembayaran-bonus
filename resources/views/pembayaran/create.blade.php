@extends('layout')

@section('content')

<div class="container-sm pt-3 p-5">

    <form action="{{ route('pembayaran.store') }}" method="POST">
        @csrf
        @METHOD('POST')

        <div class="mb-3">
            <a href="{{ route('pembayaran.index') }}" class="btn btn-danger">Back</a>
        </div>

        <div class="row mb-5">
            <div class="col-md-5 col-sm-12">
                <label for="pembayaran" class="form-label">Nominal</label>
            </div>
            <div class="col-md-7 col-sm-12">
                <input type="number" class="form-control" id="pembayaran" name="pembayaran" placeholder="Dalam rupiah" required>
            </div>
        </div>
        <div id="inputs">
            <div class="row mb-3">
                <div class="col-md-5 col-sm-12">
                    <input type="text" class="form-control" name="nama_buruh[]" required placeholder="Nama Buruh">
                </div>
                <div class="col-md-5 col-sm-12">
                    <div class="input-group">
                        <input type="number" step="0.01" class="form-control" name="percentage[]" id="percentage" required>
                        <span class="input-group-text">%</span>
                        <span class="input-group-text">
                            <button class="remove-btn btn btn-danger">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary ms-3" style="float: right;">Submit</button>
        <button id="add-btn" class="btn btn-success ms-3" style="float: right;">Add</button>

    </form>

</div>

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
        inputDiv1.className = 'col-md-5 col-sm-12';

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

        inputRow.appendChild(inputDiv1);
        inputRow.appendChild(inputDiv2);
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