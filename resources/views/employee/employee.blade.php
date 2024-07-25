@extends('layouts.app')
@section('title', 'employees')

@section('content')
    <div class="container mt-5 main">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="supervisor-title"> | الموظفين</h1>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="row">
            @foreach ($employees as $employee)
                <div class="col-md-4 col-12 mb-4">
                    <div class="card custom-card position-relative">
                        <div class="card-body">
                            <img src="{{ asset('images/موظف2.png') }}" class="supervisor-image">
            
                                <p class="card-text"><strong>اسم الموظف :</strong> {{ $employee->user->name }}</p>
                            
                                <p class="card-text"><strong>رقم الموظف:</strong> {{ $employee->user->phone }}</p>
                         
                                <p class="card-text"><strong>ايميل الموظف :</strong> {{ $employee->user->email }}</p>
                           
                            <div class="mt-4 d-flex justify-content-center">
                                <button type="button" class="btn edit-button me-2">
                                    <a href="{{ route('employees.upgrade', $employee->user->id) }}" style="text-decoration: none; color: inherit;">
                                        <img width="30" height="30" src="https://img.icons8.com/color/48/flyer-distributor-male.png" alt="flyer-distributor-male"/>
                                    </a>
                                </button>
                                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" onsubmit="return confirmDelete(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn delete-button">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>      
                            </div>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

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
            title: "هل متأكد من حذف الموظف",
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
