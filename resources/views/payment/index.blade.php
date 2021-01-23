@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('payment.add') }}" class="btn btn-primary">add</a>
    <table id="main-table" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Payment</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <div class="d-flex justify-content-end">
        <input type="hidden" id="input-delete" name="payment_id[]">
        <button type="submit" class="btn btn-danger" id="btn-delete" onclick="deleteItem()">delete</button>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    const table = document.querySelector('#main-table');
    const tbody =  table.querySelector('tbody');
    const inputDelete = document.querySelector('#input-delete');
    const btnDelete = document.querySelector('#btn-delete');
    const BASE_URL = "{{ env("APP_URL") }}"

    let tr = ``;
    document.addEventListener("DOMContentLoaded", async function() {
        let response = await fetchPayments()
        if (response.status == 200) {
            const data = response.data
            data.map((d, i) => tr += showTable(d, i))
            tbody.innerHTML = tr
            checkbox()
        }else{
            alert('ada yang salah');
        }


    });

    function fetchPayments(){
        return axios.get(`${BASE_URL}/api/payment`)
    }

    function showTable(data , index){
        return `<tr>
            <td>${index+1}</td>
            <td>${data.payment_name}</td>
            <td> <input class="form-check-input ml-4" type="checkbox" data-id="${data.id}" value="" id="c"></td>
        </tr>`
    }

    function checkbox(){
        const checkboxs = document.querySelectorAll('#c')
        let items = [];
        checkboxs.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    items.push(this.dataset.id)
                }else{
                    var getItem = items.find(function (item) {
                        return item === checkbox.dataset.id;
                    });
                    const index = items.indexOf(getItem)
                    items.splice(index, 1);
                }
                inputDelete.value = items
            });
        })
    }

    function deleteItem(){
        var array = inputDelete.value.split(',').map(function(n) {
            return Number(n);
        });
        array.forEach(async (val) => {
            console.log(val);
            let response = await axios.delete(`${BASE_URL}/api/payment`, val.value)
            if (response.status === 200) {
                alert('berhasil hapus 1 data')
            }
        })
    }

    function alertSuccess(){
        Swal.fire(
            'Good job!',
            'Berhasil delete data',
            'success'
        )
    }

    const session = "{{ Session::get('success') }}"
    if (session) {
        Swal.fire(
            'Good job!',
            session,
            'success'
        )
    }
</script>
@endsection
