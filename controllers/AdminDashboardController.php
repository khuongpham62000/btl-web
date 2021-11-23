<?php

use Carbon\Carbon;

require_once('controllers/BaseAdminController.php');
require_once('models/OrderList.php');

class AdminDashboardController extends BaseAdminController
{
    function __construct()
    {
        $this->page = 'Dashboard';
    }

    public function index()
    {
        $now = new Carbon();
        $start_year = $now->copy()->startOfYear();
        $orders = OrderList::getOrderByTime($start_year);
        $monthly_earning = [];
        for ($i = 1; $i <= $now->month; $i++) {
            $monthly_earning[] = self::getEarningByMonth($orders, $i);
        }
        $earning_anual = array_reduce(
            $monthly_earning,
            fn ($carry, $order) => $carry + $order,
            0
        );
        $data = array(
            'monthly_earning' => $monthly_earning,
            'earning_anual' => $earning_anual,
            'pending_order' => self::getPendingOrder(),
            'current_proplem' => 0
        );
        $this->render('dashboard', $data, 'dashboard_js');
    }

    public function error()
    {
        $this->render('404');
    }

    private static function getEarningByMonth($orders, $month)
    {
        $year = Carbon::now()->year;
        $start_date = Carbon::create($year, $month, 1);
        $end_date = Carbon::create($year, $month + 1, 1, 23, 59, 59)->subDay();
        $monthly_orders = array_filter(
            $orders,
            function ($order, $key) use ($start_date, $end_date) {
                $order_date = new Carbon($order->finished_time);
                return $start_date->lessThanOrEqualTo($order_date) && $order_date->lessThanOrEqualTo($end_date);
            },
            ARRAY_FILTER_USE_BOTH
        );
        return array_reduce(
            $monthly_orders,
            fn ($carry, $order) => $carry + $order->total_price,
            0
        );
    }

    private static function getPendingOrder()
    {
        $orders = OrderList::getUnfinishedOrder();
        return array_reduce(
            $orders,
            fn ($carry, $order) => $carry + 1,
            0
        );
    }
}
