@extends('layouts.app')

@section('title', 'تعديل وسيلة نقل')

@section('content')
<div class="container mt-5 main">
    <div class="row justify-content-center">
        <div class="col-12 text-center">
            <img src="{{ asset('images/B.png') }}" class="addsupervisor-image">
        </div>
    </div>
    @if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
    @endif

    @if(Session::has('error'))
    <div class="alert alert-danger">
        {{ Session::get('error') }}
    </div>
    @endif
    <div class="table justify-center" style="border-color: black">
        <h1>يرجى تعديل المعلومات</h1>
        <form method="POST" action="{{ route('transport.update', $transport->id) }}">
            @csrf
            @method('PUT') <!-- تأكد من استخدام طريقة التوجيه الصحيحة -->
            <div class="table-body">
                <h5 for="section_id"> الفرع :</h5>
                <select class="form-control" id="section_id" name="section_id">
                    @foreach ($addreses as $address)
                        <option value="{{ $address->id }}" {{ $transport->section_id == $address->id ? 'selected' : '' }}>
                            {{ $address->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="table-body">
                <h5 for="type_tra_id">نوع وسيلة النقل :</h5>
                <select class="form-control custom-select" id="type_tra_id" name="type_tra_id">
                    @foreach ($type_tra as $type)
                        <option value="{{ $type->id }}" {{ $transport->type_tra_id == $type->id ? 'selected' : '' }}>
                            {{ $type->name_t }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="table-body">
                <h5 for="capacity">عدد الركاب :</h5>
                <input type="number" class="form-control" id="capacity" name="capacity" value="{{ $transport->capacity }}">
            </div>
            <div class="table-body">
                <h5 for="number">الكمية المراد فرزها :</h5>
                <input type="number" class="form-control" id="number" name="number" value="{{ $transport->number }}">
            </div>
            <button type="submit" class="btn add-button me-2">تحديث</button>
        </form>
    </div>
</div>
<style>
.main {
    display: flex;
    height: 100vh;
    justify-content: center;
    align-items: center;
}
.addsupervisor-title {
    color: #02568C;
}
.container {
    width: 100%;
}
.table {
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 10px;
    padding: 60px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 500px;
    width: 100%;
    text-align: center;
    margin-top: 100px;
    min-height: 300px;
    margin-bottom: 100px;
}
h1 {
    font-size: 24px;
    color: #02568C;
}
.table-body {
    margin-bottom: 10px;
}
input {
    width: 100%;
    padding: 10px 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    font-size: 16px;
    width: 350px;
}
button.add-button {
    background-color: #007bff;
    color: #fff;
    padding: 10px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 18px;
    width: 100%;
}
button.add-button:hover {
    background-color: #0056b3;
}
.addsupervisor-image {
    float: left; 
    margin-right: 20px; 
    margin-top: 300px; 
}

.custom-select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background: url('data:image/svg+xml;charset=US-ASCII,<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><polygon points="0,0 20,0 10,10" fill="%23000000"/></svg>') no-repeat right 10px center;
    background-size: 10px;
    padding-right: 30px;
}

</style>
@endsection
