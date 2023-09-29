<?php

namespace App\Helpers;

use Auth;
use Session;
use Illuminate\Support\Facades\URL;
use File;
use DB;

class Helper
{

    function GetName($action, $match_value)
    {
        $select_data = '';

        if ($action == 'get_user_role') {
            if ($match_value == '0') {
                $select_data = "Admin"; //"Role Name Admin";
            } elseif ($match_value == '1') {
                $select_data = "SuperStockiest"; //" Role Name  Super Stockiest";
            } elseif ($match_value == '2') {
                $select_data = "Stockiest"; //"Role Name  Stockiest";
            } elseif ($match_value == '3') {
                $select_data = "Distributor"; //" Role Name  Distributor";
            } elseif ($match_value == '4') {
                $select_data = "Customer"; //"Role Name  Customer";
            }
        } elseif ($action == 'get_user_name') {
            $get_detail = \App\User::select('name')->where('id', '=', $match_value)->first();
            if ($get_detail) {
                $select_data = $get_detail->name;
            }
        } elseif ($action == 'get_user_role_by_id') {
            $get_detail = \App\User::select('role_id')->where('id', '=', $match_value)->first();
            if ($get_detail) {
                $select_data = (new \App\Helpers\Helper)->GetName('get_user_role', $get_detail->role_id);
                //$select_data = $get_detail->name;
            }
        } elseif ($action == 'get_user_full_name') {
            $get_detail = \App\User::select('full_name')->where('id', '=', $match_value)->first();
            if ($get_detail) {
                $select_data = $get_detail->full_name;
            }
        } elseif ($action == 'get_user_name_with_full_name') {
            $get_detail = \App\User::select('full_name', 'name')->where('id', '=', $match_value)->first();
            if ($get_detail) {
                $select_data = $get_detail->full_name . '(' . $get_detail->name . ')';
            }
        } elseif ($action == 'get_date_time_format') {
            $date_start_date_array_value = date('Y', strtotime($match_value));
            if ($date_start_date_array_value != '1970') {
                $select_data = date('Y-m-d H:i:s', strtotime($match_value));
            }
        } elseif ($action == 'get_india_date_time_format') {
            $date_start_date_array_value = date('Y', strtotime($match_value));
            if ($date_start_date_array_value != '1970') {
                $select_data = date('d-m-Y H:i:s', strtotime($match_value));
            }
        } elseif ($action == 'get_date_format') {
            $date_start_date_array_value = date('Y', strtotime($match_value));
            if ($date_start_date_array_value != '1970') {
                $select_data = date('d-m-Y', strtotime($match_value));
            }
        } elseif ($action == 'get_time_format') {
            $date_start_date_array_value = date('Y', strtotime($match_value));
            if ($date_start_date_array_value != '1970') {
                $select_data = date('H:i:s', strtotime($match_value));
            }
        } elseif ($action == 'get_total_sale_sum') {
            $get_detail = \App\CommissionDetail::where('user_id', '=', $match_value)->sum('total_play_coin');
            $select_data = $get_detail;
        } elseif ($action == 'get_total_commission_amount_sum') {
            $get_detail = \App\CommissionDetail::where('user_id', '=', $match_value)->sum('commission_amount');
            $select_data = $get_detail;
        }
        return $select_data;
    }

    function GetCommissionData($action, $match_value, $date_time)
    {
        $select_data = '';

        if ($action == 'get_total_sale_sum') {

            if (isset($date_time)) {
                $reservationtime = explode('-', $date_time);
                $from_date = GetName('get_date_time_format', $reservationtime['0']);
                $to_date = GetName('get_date_time_format', $reservationtime['1']);
                $get_detail = \App\CommissionDetail::where('user_id', '=', $match_value)->whereBetween('created_at', [$from_date, $to_date])->sum('total_play_coin');
            } else {
                $get_detail = \App\CommissionDetail::where('user_id', '=', $match_value)->sum('total_play_coin');
            }
            $select_data = $get_detail;
        } elseif ($action == 'get_total_commission_amount_sum') {
            if (isset($date_time)) {
                $reservationtime = explode('-', $date_time);
                $from_date = GetName('get_date_time_format', $reservationtime['0']);
                $to_date = GetName('get_date_time_format', $reservationtime['1']);
                $get_detail = \App\CommissionDetail::where('user_id', '=', $match_value)->whereBetween('created_at', [$from_date, $to_date])->sum('commission_amount');
            } else {
                $get_detail = \App\CommissionDetail::where('user_id', '=', $match_value)->sum('commission_amount');
            }
            $select_data = $get_detail;
        }
        return $select_data;
    }
}
