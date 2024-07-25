<header class="header">
    <div class="header-container">
       
        <div class="header-icons">
            <form action="{{ route('logout') }}" method="POST" onsubmit="return confirmlogout(event)">
                @csrf
            <button id="profile-btn" type="submit">
                <i class="lni lni-exit"></i>
            </button>
        </form> 
            <!-- أيقونة تغيير الوضع -->
        <button id="mode-toggle"><i id="theme-icon" class="lni lni-sun"></i></button>
            {{-- <button id="search-btn" type="button">
                <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/30/search--v1.png" alt="search--v1"/>
            </button>
            <div class="search-container">
                <input type="text" id="search-input" placeholder="ابحث هنا...">
            </div> --}}
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

 <!-- jQuery -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

 <!-- SweetAlert -->
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

 <script type="text/javascript">
    function confirmlogout(event) {
        event.preventDefault();
        var form = event.target;
        swal({
            title: "هل متأكد من رغبتك في تسجيل الخروج",
            icon: "warning",
            buttons: ["إلغاء", "تسجيل الخروج"],
            dangerMode: true,
        }).then((willlogout) => {
            if (willlogout) {
                form.submit();
            }
        });
    }
    </script>
</header>
