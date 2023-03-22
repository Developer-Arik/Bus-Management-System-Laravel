<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminRouteController extends Controller
{
    function login(){
        if(Auth::guard('admin')->check()){
            abort(404);
        }

        return view('admin.auth.login');
    }
    function recent_statistics($days){
        $RecentSaleingStatisticsLabels = [];
        $ammount = [];

        for ($i=$days; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('y-m-d');
            $ammount[$date] = 0;

            array_push($RecentSaleingStatisticsLabels,Carbon::parse($date)->format('M d'));

            for ($j=0; $j < sizeof(Booking::where('date',$date)->get()); $j++) {
                $booking = Booking::where('date',$date)->get()[$j];
                if($booking->payment->ammount==true){
                    $ammount[$date]+=$booking->payment->ammount;
                }
            }
        }

        $ammount = array_values($ammount);
        return [
            "ammount" => $ammount,
            "labels" => $RecentSaleingStatisticsLabels,
            "todaySale" => $ammount[sizeof($ammount)-1],
            "profitRateToday" => (int) round(($ammount[sizeof($ammount)-1]-$ammount[sizeof($ammount)-2])/($ammount[sizeof($ammount)-1]<1 ? 1 : $ammount[sizeof($ammount)-1])*100),
            "profitInTaka" => (($ammount[sizeof($ammount)-1])-($ammount[sizeof($ammount)-2])),
            "lossInTaka" => (($ammount[sizeof($ammount)-1])-($ammount[sizeof($ammount)-2]))*(-1),
            "lossRateToday" => (int) round((($ammount[sizeof($ammount)-1])-($ammount[sizeof($ammount)-2]))*(-1)/($ammount[sizeof($ammount)-2]<1 ? 1 : $ammount[sizeof($ammount)-2])*100)
        ];
    }
    function month_statistics($days){
        $labels = [];
        $ammount = [];

        for ($i=$days; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $ammount[$date->format('y-m')] = 0;

            array_push($labels,(Carbon::now())->subMonths($i)->format('M'));

            for ($j=0; $j < sizeof(Booking::all()); $j++) {
                $booking = Booking::all()[$j];
                $datex = Carbon::parse($booking->date)->format('y-m');
                if($datex==$date->format('y-m') && $booking->payment->ammount==true){
                    $ammount[$date->format('y-m')]+=$booking->payment->ammount;
                }
            }
        }

        $ammount = array_values($ammount);

        return [
            "sellingThisMonth" => $ammount[sizeof($ammount)-1],
            "ammount" => $ammount,
            "labels" => $labels,
            "profitRateToday" => (int) round(($ammount[sizeof($ammount)-1]-$ammount[sizeof($ammount)-2])/($ammount[sizeof($ammount)-1]<1 ? 1 : $ammount[sizeof($ammount)-1])*100),
            "profitInTaka" => (($ammount[sizeof($ammount)-1])-($ammount[sizeof($ammount)-2])),
            "lossInTaka" => (($ammount[sizeof($ammount)-1])-($ammount[sizeof($ammount)-2]))*(-1),
            "lossRateToday" => (int) round((($ammount[sizeof($ammount)-1])-($ammount[sizeof($ammount)-2]))*(-1)/($ammount[sizeof($ammount)-2]<1 ? 1 : $ammount[sizeof($ammount)-2])*100)
        ];
    }
    function dashboard(){
        $recentStatistics = Self::recent_statistics(7);
        $monthStatistics = Self::month_statistics(7);

        $grossSale = 0;
        $grossSaleMonth = 0;

        for ($i=0; $i < sizeof(Payment::where('status',true)->get());$i++){
            $payment = Payment::where('status',true)->get()[$i];

            $grossSale+=$payment->ammount;
        }

        for ($j=0; $j < sizeof(Booking::all());$j++){
            $booking = Booking::all()[$j];
            if(Carbon::parse($booking->date)->format('y-m-W')==Carbon::now()->format('y-m-W')){
                $payment = $booking->payment;
                $grossSaleMonth+=$payment->ammount;
            }
        }

        return view('admin.pages.dashboard',[
            "GrossSale" => $grossSale,
            "TodaySale" => $recentStatistics['todaySale'],
            "WeeksSale" => $grossSaleMonth,
            "MonthSale" => $monthStatistics["sellingThisMonth"],
            "RecentSaleingStatistics" => json_encode($recentStatistics),
            "MonthSaleingStatistics" => json_encode($monthStatistics)
        ]);
    }
}
