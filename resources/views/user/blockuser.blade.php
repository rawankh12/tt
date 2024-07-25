@extends('layouts.app')
@section('title', 'المستخدمين')
@section('content')
    <div class="container mt-5 main">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="supervisor-title">| المستخدمين</h1>
            </div>
        </div>

          <div class="row justify-content mb-4">
            <div class="col-12 " style="  margin-right: 40px;">
                <a href="{{ route('users.index') }}" class="btn btn-primary me-2">الكل</a>
                <a href="{{ route('users.showblock') }}" class="btn btn-secondary me-2">المحظورين</a>
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
            @foreach ($users as $user)
            <div class="col-md-4 col-12 mb-4">
                <div class="card custom-card position-relative">
                    <div class="card-body">
                            <img src="{{ asset('images/موظف3.png') }}" class="supervisor-image">
                            <h5 class="card-title">{{ $user->user->name }}</h5> 
                            {{-- <div class="supervisor-info-box"> --}}
                            <p class="card-text"><strong></strong> {{ $user->user->phone }}</p>
                            <p class="card-text"><strong></strong> {{ $user->user->email }}</p>
                            <div class="mt-4 d-flex justify-content-center">
                                <form action="{{ route('users.unblock', $user->id) }}" method="POST" onsubmit="return confirmunblock(event)">
                                    @csrf
                                <button type="submit" class="btn edit-button me-2">
                                    {{-- <a href="{{ route('users.block', $user->id) }}" style="text-decoration: none; color: inherit;"> --}}
                                        <img width="25" height="25" src="https://img.icons8.com/ios-glyphs/30/cancel-2.png" alt="cancel-2"/>
                                    {{-- </a> --}}
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
    function confirmunblock(event) {
            event.preventDefault();
            var form = event.target;
            swal({
                title: "هل متأكد من فك حظر هذا المستخدم؟",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willBlock) => {
                if (willBlock) {
                    form.submit();
                }
            });
        }
    </script>
<style>
    

.btn {
            padding: 10px 20px;
            font-size: 16px;    
        }

.btn-primary {
            background-color: #cdd9e4;
            border: none;
            color: rgb(15, 14, 14);
           
        }

.btn-secondary {
            background-color: #1c426a;
            border: none;
            color: white;
           

        }

.btn-primary:hover,
.btn-secondary:hover {
            opacity: 0.8;
        }

    </style>
@endsection
