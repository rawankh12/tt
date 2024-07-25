@extends('layouts.sidebar')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">لوحة الإحصائيات</h1>
    <div class="row mt-4">
        <div class="col-md-6">
            <canvas id="tripsTodayChart"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="vehiclesAvailableChart"></canvas>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6">
            <canvas id="totalDistanceChart"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="fuelUsageChart"></canvas>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
 $(document).ready(function() {
    function fetchData() {
        $.ajax({
            url: '{{ route("admin.overview.data") }}',
            method: 'GET',
            success: function(data) {
                updateCharts(data);
            }
        });
    }

    function updateCharts(data) {
        tripsTodayChart.data.datasets[0].data = [data.tripsToday];
        vehiclesAvailableChart.data.datasets[0].data = [data.vehiclesAvailable];
        totalDistanceChart.data.datasets[0].data = [data.totalDistance];
        fuelUsageChart.data.datasets[0].data = [data.fuelUsage];
        
        tripsTodayChart.update();
        vehiclesAvailableChart.update();
        totalDistanceChart.update();
        fuelUsageChart.update();
    }

    function resizeCharts() {
            tripsTodayChart.resize();
            vehiclesAvailableChart.resize();
            totalDistanceChart.resize();
            fuelUsageChart.resize();
        }

        // إنشاء المخططات
        const tripsTodayCtx = document.getElementById('tripsTodayChart').getContext('2d');
        const vehiclesAvailableCtx = document.getElementById('vehiclesAvailableChart').getContext('2d');
        const totalDistanceCtx = document.getElementById('totalDistanceChart').getContext('2d');
        const fuelUsageCtx = document.getElementById('fuelUsageChart').getContext('2d');

        const gradientBackground = (ctx, colorStart, colorEnd) => {
            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, colorStart);
            gradient.addColorStop(1, colorEnd);
            return gradient;
        };

    var tripsTodayChart = new Chart(document.getElementById('tripsTodayChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: ['الرحلات اليوم'],
            datasets: [{
                label: 'عدد الرحلات',
                data: [],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    gradient: true
                }
    });

    var vehiclesAvailableChart = new Chart(document.getElementById('vehiclesAvailableChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: ['المركبات المتاحة'],
            datasets: [{
                label: 'عدد المركبات',
                data: [],
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    gradient: true
                }
            }
    });

    var totalDistanceChart = new Chart(document.getElementById('totalDistanceChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: ['المسافة المقطوعة'],
            datasets: [{
                label: 'المسافة بالكيلومترات',
                data: [],
                backgroundColor: 'rgba(255, 159, 64, 0.2)',
                borderColor: 'rgba(255, 159, 64, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    gradient: true
                }
            }
    });

    var fuelUsageChart = new Chart(document.getElementById('fuelUsageChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: ['استهلاك الوقود'],
            datasets: [{
                label: 'الاستهلاك باللترات',
                data: [],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    gradient: true
                }
            }
    });

         // تحديث المخططات عند تغيير حجم النافذة
         $(window).resize(function() {
            resizeCharts();
        });

        // تحديث المخططات عند فتح/إغلاق الشريط الجانبي
        $('#toggle-btn').click(function() {
            setTimeout(resizeCharts, 30000); // تأخير صغير للسماح بالتحريك
        });

    fetchData();
    setInterval(fetchData, 60000); // تحديث كل 60 ثانية
});

</script>
@endsection
