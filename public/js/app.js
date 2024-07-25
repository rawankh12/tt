
$(document).ready(function() {
    function fetchData() {
        $.ajax({
            url: '/admin/overview/data',
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

    var tripsTodayChart = new Chart(document.getElementById('tripsTodayChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: [''],
            datasets: [{
                label: 'عدد الرحلات العامة ',
                data: [],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var vehiclesAvailableChart = new Chart(document.getElementById('vehiclesAvailableChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: [''],
            datasets: [{
                label: 'عدد الرحلات الخاصة ',
                data: [],
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var totalDistanceChart = new Chart(document.getElementById('totalDistanceChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: [''],
            datasets: [{
                label: '  ',
                data: [],
                backgroundColor: 'rgba(255, 159, 64, 0.2)',
                borderColor: 'rgba(255, 159, 64, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var fuelUsageChart = new Chart(document.getElementById('fuelUsageChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: [''],
            datasets: [{
                label: ' ',
                data: [],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    fetchData();
    setInterval(fetchData, 60000); // تحديث كل 60 ثانية
});
