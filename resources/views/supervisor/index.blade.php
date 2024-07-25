@extends('layouts.app')
@section('title', 'Supervisors')
@section('content')
    <div class="container mt-5 main">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="supervisor-title"> | المشرفين</h1>
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

        <div class="row">
            @foreach ($supervisors as $supervisor)
            <div class="col-md-4 col-12 mb-4">
                <div class="card position-relative">
                    <div class="card-body">
                            <img src="{{ asset('images/المشرفين.png') }}" class="supervisor-image">
                            <h5 class="card-title">{{ $supervisor->user_name }}</h5> 
                            <div class="supervisor-info-box">
                            <p class="card-text"><strong>الايميل :</strong> {{ $supervisor->email }}</p> </div>
                            <div class="supervisor-info-box">
                            <p class="card-text"><strong>رقم الهاتف :</strong> {{ $supervisor->phone }}</p></div>
                            @if($supervisor->section && $supervisor->section->address)
                            <div class="supervisor-info-box">
                            <p class="card-text"><strong>مدير فرع :</strong> {{ $supervisor->section->address->name }}</p></div>
                            @else
                            <div class="supervisor-info-box">
                            <p class="card-text"><strong>مدير فرع :</strong> غير محدد</p></div>
                            @endif
                            <div class="mt-4 d-flex justify-content-center">
                                <button type="button" class="btn edit-button me-2">
                                    <a href="{{ route('supervisors.edit', $supervisor->id) }}" style="text-decoration: none; color: inherit;">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </button>
                            <form action="{{ route('supervisors.destroy', $supervisor->id) }}" method="POST" onsubmit="return confirmDelete(event)">
                                @csrf
                                @method('DELETE') <!-- تعديل هنا ليكون DELETE -->
                                <button type="submit" class="btn delete-button">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>                            
                            </div>
                        </div>
                    </div>
                </div>
            
            @endforeach            
        </div>
    </div>

     <!-- Floating Button for adding new supervisor -->
     <a href="{{ route('supervisors.create') }}" class="btn-add-supervisor">
        <i class="bi bi-plus" style="color: black"></i>
    </a>
  
 <!-- Bootstrap Bundle with Popper -->
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

 <!-- jQuery -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

 <!-- SweetAlert -->
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

 <script type="text/javascript">
    function confirmDelete(event) {
        event.preventDefault();
        var form = event.target;
        swal({
            title: "هل متأكد من حذف المشرف؟",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    }
    </script>

@endsection
