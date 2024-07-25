<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function getOverviewData()
    {
        // جلب البيانات اللازمة للإحصائيات
        $data = [
            'tripsToday' => 120, // مثال على عدد الرحلات اليوم
            'vehiclesAvailable' => 30, // مثال على عدد المركبات المتاحة
            'totalDistance' => 4500, // مثال على المسافة المقطوعة
            'fuelUsage' => 500 // مثال على استهلاك الوقود
        ];

        return response()->json($data);
    }
}
