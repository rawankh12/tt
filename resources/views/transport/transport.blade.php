?>

@extends('layouts.app')

@section('title', 'Transport')

@section('content')
    <div class="container mt-5 main">
        <div class="row mb-4">
            <div class="col-12 ">
                <h1 class="supervisor-title"> | وسائل النقل</h1>
            </div>
        </div>
        <div class="row">
            @foreach ($transports as $transport)
                <div class="col-md-4 col-12 mb-4">
                    <div class="card custom-card position-relative">
                        <div class="card-body">
                            {{-- <img src="{{ asset('images/اضافة وتعديل رحلة.png') }}" class="supervisor-image"> --}}
                            <div class="supervisor-info-box">
                                <p class="card-text"><strong>مدير الفرع :</strong> 
                                    {{ $transport->section && $transport->section->address ? $transport->section->address->name : 'العنوان غير متوفر' }}
                                </p>
                            </div>
                            <div class="supervisor-info-box">
                                <p class="card-text"><strong>نوع وسيلة النقل :</strong> 
                                    {{ $transport->type_tran ? $transport->type_tran->name_t : 'نوع وسيلة النقل غير متوفر' }}
                                </p>
                            </div>
                            <div class="supervisor-info-box">
                                <p class="card-text"><strong>عدد الركاب :</strong> {{ $transport->capacity }}</p>
                            </div>
                            <div class="supervisor-info-box">
                                <p class="card-text"><strong> الكمية المراد فرزها :</strong> {{ $transport->number }}</p>
                            </div>
                            <div class="mt-4 d-flex justify-content-center">
                                <button type="button" class="btn edit-button me-2">
                                    <a href="{{ route('transport.edit', $transport->id) }}" style="text-decoration: none; color: inherit;">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </button>
                                <form action="{{ route('transport.destroy', $transport->id) }}" method="POST" onsubmit="return confirmDelete(event)">
                                    @csrf
                                    @method('DELETE') <!-- تعديل هنا ليكون DELETE -->
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

    <!-- Floating Button for adding new supervisor -->
    <a href="{{ route('transport.create') }}" class="btn-add-supervisor">
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
            title: "هل متأكد من حذف وسيلة النقل ؟",
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