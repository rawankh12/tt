@extends('layouts.app')

@section('title', 'تعديل مشرف')

@section('content')
<div class="container mt-5 main">
    <div class="row justify-content-center">
        <div class="col-12 text-center">
            <img src="{{ asset('images/إضافة مشرف.png') }}" class="addsupervisor-image">
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
        <form method="POST" action="{{ route('supervisors.update', $supervisor->id) }}">
            @csrf
            @method('PUT') <!-- تأكد من استخدام طريقة التوجيه الصحيحة -->
            <div class="table-body">
                <h5 for="name">الاسم</h5>
                <input type="text" id="name" name="name" value="{{ $supervisor->name }}" required autocomplete="name">
            </div>
            <div class="table-body">
                <h5 for="email">البريد الإلكتروني</h5>
                <input type="email" id="email" name="email" value="{{ $supervisor->email }}" required autocomplete="email">
            </div>
            <div class="table-body">
                <h5 for="password">كلمة المرور (اتركها فارغة إذا كنت لا تريد تغييرها)</h5>
                <input type="password" id="password" name="password" autocomplete="new-password">
            </div>
            <div class="table-body">
                <h5 for="phone"> رقم الهاتف</h5>
                <input type="text" id="phone" name="phone" value="{{ $supervisor->phone }}" required autocomplete="tel">
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
    margin-top: 150px; 
}
</style>
@endsection
