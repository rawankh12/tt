@extends('layouts.app')

@section('title', 'إضافة مشرف جديد')

@section('content')
<div class="container mt-5 main">
    <div class="row justify-content-center justify-content-center">
        <div class="col-12 text-center">
            {{-- <h1 class="addsupervisor-title">إضافة مشرف</h1> --}}
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
        <h1>يرجى اضافة المعلومات</h1>
        <form method="POST" action="{{ route('supervisors.store') }}">
            @csrf
            <div class="table-body">
                <h5 for="name">الاسم</h5>
                <input type="text" id="name" name="name">
            </div>
            <div class="table-body">
                <h5 for="email">البريد الإلكتروني</h5>
                <input type="email" id="email" name="email">
            </div>
            <div class="table-body">
                <h5 for="password">كلمة المرور</h5>
                <input type="password" id="password" name="password">
            </div>
            <div class="table-body">
                <h5 for="phone"> رقم الهاتف</h5>
                <input type="text" id="phone" name="phone">
            </div>
            <button type="submit" class="btn add-button me-2">إضافة</button>
        </form>
    </div>
</div>
<style>
.main {
    display: flex;
    height: 100vh; /* تأكد من أن الحاوية الرئيسية تأخذ ارتفاع كامل الشاشة */
    justify-content: center;
    align-items: center;
    /* background-color: #ffffff;  */
}
.addsupervisor-title {
    color: #02568C; 
    /* text-align: center;
    width: 100%;
    margin: 0 auto; 
    font-weight: bold; */
} 
.container {
   
    width: 100%;
}
.table {
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 10px;
    padding: 60px; /* زيادة padding لتكبير المساحة الداخلية */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 500px; /* زيادة عرض المستطيل */
    width: 100%;
    text-align: center;
    margin-top: 100px;
    min-height: 300px; /* زيادة الحد الأدنى للارتفاع */
    margin-bottom: 100px;
}

h1 {
    font-size: 24px;
    color: #02568C;
    /* margin-bottom: 50px;  */
    

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
    font-size: 16px; /* تكبير حجم النص داخل الحقول */
    width: 350px;
}
button.add-button {
    background-color: #007bff;
    color: #fff;
    padding: 10px 10px; /* زيادة padding لتكبير الزر */
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 18px; /* تكبير حجم النص داخل الزر */
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