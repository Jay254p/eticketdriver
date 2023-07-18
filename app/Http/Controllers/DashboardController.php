<?php

namespace App\Http\Controllers;

use App\Models\Offence;
use App\Models\Receipt;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        // Get the current user
        $user = Auth::user();

        // Get user-specific statistics
        $totalOffences = Offence::where('DriverLicenceNumber', $user->DriverLicenceNumber)->count();
        $totalReceipts = Receipt::where('driver_licence_number', $user->DriverLicenceNumber)->count();

        // Get data for the bar chart (number of offences by type)
        $offencesByType = Offence::where('DriverLicenceNumber', $user->DriverLicenceNumber)
            ->select('OffenceCommited', DB::raw('count(*) as total'))
            ->groupBy('OffenceCommited')
            ->get();

        // Get data for the line chart (number of receipts by month)
        $receiptsByMonth = Receipt::where('driver_licence_number', $user->DriverLicenceNumber)
            ->select(DB::raw('MONTH(payment_date) as month'), DB::raw('count(*) as total'))
            ->groupBy(DB::raw('MONTH(payment_date)'))
            ->get();

        return view('dashboard', compact('totalOffences', 'totalReceipts', 'offencesByType', 'receiptsByMonth'));
    }

   
}
