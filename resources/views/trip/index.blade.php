@extends('layouts.app')
@section('title', 'تفاصيل الرحلة')
@section('content')
<div class="container mt-5 main">
    <div class="row mb-4">
        <div class="col-12 text-center">
            {{-- <h1 class="supervisor-title"> | تفاصيل الرحلة</h1> --}}
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

    <div class="row justify-content-center">
        @foreach ($trips as $trip)
        <div class="col-md-8 col-12 mb-4">
            <div class="card custom-card position-relative">
                <div class="card-body">
                    <h5 class="card-title">تفاصيل الرحلة</h5> 
                    <div class="supervisor-info-box">
                    <p class="card-text"><strong>مكان انطلاق الرحلة :</strong> {{ $trip->section->address->name }}</p></div>
                    <div class="supervisor-info-box">
                    <p class="card-text"><strong>نوع وسيلة النقل :</strong> {{ $trip->transporter->type_tran->name_t }}</p></div>
                    <div class="supervisor-info-box">
                    <p class="card-text"><strong>نوع الرحلة :</strong> {{ $trip->type->name }}</p></div>
                    <div class="supervisor-info-box">
                    <p class="card-text"><strong>وجهة الرحلة :</strong> {{ $trip->section_end }}</p></div>
                    <div class="supervisor-info-box">
                    <p class="card-text"><strong>تاريخ الرحلة :</strong> {{ $trip->date }}</p></div>
                    <div class="supervisor-info-box">
                    <p class="card-text"><strong>وقت الرحلة :</strong> {{ $trip->time }}</p></div>
                    <div class="supervisor-info-box">
                    <p class="card-text"><strong>عدد الركاب :</strong> {{ $trip->num_seat }}</p></div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<style>
    .custom-card {
        border: 2px solid #02568C; /* إضافة حد حول الكارد */
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        /* padding-bottom: 70%; إضافة مسافة في الأسفل */
        margin-bottom: 20px; /* مسافة بين الكارد والكارد التالي */
        /* padding-left: 70px;
        padding-right: 70px; */
        position: relative;
        width: 100%;
        min-width: 700px;
        padding: 70px;
        padding-top: 20px;
    }

    .supervisor-title {
        margin-top: 20px; /* يمكنك ضبط المسافة حسب الحاجة */
        color: #02568C; /* لون النص */
        font-weight: bold;
    }
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .col-12.text-center h1 {
        text-align: center;
    }
    
</style>

@endsection
