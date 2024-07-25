@extends('layouts.app')

@section('title', 'قائمة الشكاوى')

@section('content')
<div class="container mt-5 main">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="comp-title"> | قائمة الشكاوي</h1>
        </div>
    </div>
    <div class="row">
        @foreach ($complaints as $complaint)
        <div>
                <div class="card custom-card position-relative mb-4">
                    <div class="card-body d-flex align-items-center">
                        <img src="{{ asset('images/موظف3.png') }}" class="com-image me-3" alt="user image">
                        <div>
                            <p class="card-text"><strong>اسم المستخدم:</strong> {{ $complaint->user->name }}</p>
                            <p class="card-text"><strong>الرحلة :</strong> {{ $complaint->trip->section->address->name }}</p>
                            <p class="card-text"><strong>الشكوى:</strong> {{ $complaint->description }}</p>
                            <div class="mt-4 d-flex justify-content-center">
                                <button type="button" class="btn detail-button me-2" style="border-block-color: black ">
                                    <a href="{{ route('trips.index', $complaint->trip->id) }}" style="text-decoration: none; color: inherit;">
                                        <i>تفاصيل الرحلة</i>
                                    </a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

<!-- يمكنك إضافة بعض الأنماط المخصصة -->
<style>
    .com-image {
        width: 70px;
        height: 70px; 
        border-radius: 50%;
        margin-left: auto;
    }

    .custom-card {
        border: 2px solid #02568C; 
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        padding-bottom: 15px; 
        margin-bottom: 20px; 
        position: relative;
    }

    .comp-title {
        margin-top: 20px; 
        color: #02568C; 
        width: 100%;
        margin-right: 40px;
        font-weight: bold;
    }
</style>
