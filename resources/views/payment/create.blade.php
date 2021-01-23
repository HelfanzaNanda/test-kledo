@extends('layouts.app')

@section('content')

<div class="container">
    <div>
        <label for="">Payment Name</label>
        <div class="form-group">
            <input type="text" class="form-control" name="payment_name" id="payment_name">
            <span id="text-error" class="text-danger"></span>
        </div>
        <button class="btn btn-primary" onclick="store()">save</button>
    </div>
</div>
@endsection

@section('script')
    <script>
        const BASE_URL = "{{ env("APP_URL") }}"
        const payment = document.querySelector('#payment_name')
        const textErr = document.querySelector('#text-error')

         async function store(){
            textErr.innerText = ''
             try{
                let response = await axios.post(`${BASE_URL}/api/payment`, {
                    payment_name: payment.value
                })
                if (response.status == 201) {
                    Swal.fire(
                        'Good job!',
                        'berhasil menambahkan data',
                        'success'
                    )
                    window.location.replace(BASE_URL);
                }
             }catch(e){
                 if (e.response.status == 422) {
                     textErr.innerText = e.response.data.errors.payment_name[0]
                     //console.log(e.response.data.errors);
                 }
             }


        }
    </script>
@endsection
