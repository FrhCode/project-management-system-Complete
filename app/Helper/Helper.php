<?php

namespace App\Helper;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use \stdClass;

class Helper
{
    public static function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

    public static function randomName($characters, $random_string_length)
    {
        $string = '';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < $random_string_length; $i++) {
            $string .= $characters[mt_rand(0, $max)];
        }

        return $string;
    }

    // get month name from number
    public static function month_name($month_number)
    {
        return date('F', mktime(0, 0, 0, $month_number, 10));
    }


    // get get last date of given month (of year)
    public static function month_end_date($year, $month_number)
    {
        return date("t", strtotime("$year-$month_number-0"));
    }

    // return two digit month or day, e.g. 04 - April
    public static function zero_pad($number)
    {
        if ($number < 10) return "0$number";

        return "$number";
    }

    // Return quarters between tow dates. Array of objects
    public static function get_quarters($start_date, $end_date)
    {
        $quarters = array();

        $start_month = date('m', strtotime($start_date));
        $start_year = date('Y', strtotime($start_date));

        $end_month = date('m', strtotime($end_date));
        $end_year = date('Y', strtotime($end_date));

        $start_quarter = ceil($start_month / 3);
        $end_quarter = ceil($end_month / 3);

        $quarter = $start_quarter; // variable to track current quarter

        // Loop over years and quarters to create array
        for ($y = $start_year; $y <= $end_year; $y++) {
            if ($y == $end_year) $max_qtr = $end_quarter;
            else $max_qtr = 4;

            for ($q = $quarter; $q <= $max_qtr; $q++) {

                $current_quarter = new stdClass();

                $end_month_num = Helper::zero_pad($q * 3);
                $start_month_num = ($end_month_num - 2);

                $q_start_month = Helper::month_name($start_month_num);
                $q_end_month = Helper::month_name($end_month_num);

                //$current_quarter->period = "Q$q ($q_start_month - $q_end_month) $y";
                $current_quarter->period = "Q$q $y";
                $current_quarter->period_start = "$y-$start_month_num-01"; // yyyy-mm-dd
                $current_quarter->period_end = "$y-$end_month_num-" . Helper::month_end_date($y, $end_month_num);

                $quarters[] = $current_quarter;
                unset($current_quarter);
            }

            $quarter = 1; // reset to 1 for next year
        }

        return $quarters;
        // return [1,2,3];
    }

    // Get Quarter From Spesific Date
    public static function get_quarter_for_spesific_date($date)
    {
        $curMonth = date("m", $date->getTimestamp());
        $curQuarter = ceil($curMonth / 3);
        return "Q$curQuarter " . $date->format("Y");;
    }

    // Get random date between date
    public static function rand_date($min_date, $max_date)
    {
        /* Gets 2 dates as string, earlier and later date.
           Returns date in between them.
        */

        $min_epoch = strtotime($min_date);
        $max_epoch = strtotime($max_date);

        $rand_epoch = rand($min_epoch, $max_epoch);

        return date('Y-m-d H:i:s', $rand_epoch);
    }

    // Get Badge color according date
    public static function badgeColorDate($date)
    {
        // kalo dah lewat dia danger || kalo dibawah 20 hari lagi dia warning
        if ($date->isPast()) {
            return 'danger';
        }
        $date = $date->diffInDays();
        if ($date > 60)
            return "success";

        if ($date > 50)
            return "primary";

        if ($date > 40)
            return "info";

        if ($date > 30)
            return "secondary";

        if ($date > 20)
            return "dark";

        return 'warning';
    }

    // Nentuin buat yang di task list
    public static function isTaskOwner($taskId)
    {
        return $taskId == Auth::user()->id ? true : false;
    }

    // Nentuin warna badge di project detail
    public static function badgeColorStatus($status)
    {
        return !strcmp($status, 'on Progress') ?  'info' : 'success';
    }

    public static function percentageTaskComplete($task, $type = null)
    {
        // dd($task);
        $taskTotal = count($task);
        // Kalo blm ada task kembalikan 0%
        if (!$taskTotal) {
            return "0%";
        }

        $taskComplete = 0;
        foreach ($task as $key => $value) {
            if (strcmp($value->status, "completed") == 0) {
                $taskComplete++;
            }
        }
        if ($type)
            return number_format((float) $taskComplete / $taskTotal * 100, 0, '.', '') . "%";
        return $taskComplete . "/" . $taskTotal;
    }

    public static function customCarbon($date)
    {
        // dd($date->diffInDays());
        // return $date->diffForHumans();
        // return $date->diffInHours();
        return $date->diffInMonths() > 1 ? $date->diffInMonths() . " Bulan" : $date->diffInDays() . " Hari";
    }

    public static function deleteFile($file, $folder = 'file')
    {
        $file = $file->map(function ($file) {
            return 'file/' . $file;
        });

        foreach ($file as $key => $value) {
            if (File::exists(public_path($value)))
                \File::delete(public_path($value));
        }
    }
}
