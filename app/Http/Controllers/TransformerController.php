<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransformerController extends Controller
{
    //
    public static function convertProductType(int $type)
    {
        switch ($type) {
            case 1:
                return "Food & Beverage";
                break;
            case 2:
                return "Retail";
                break;
            default:
                return "Unknown";
                break;
        }
    }

    public static function convertProductStatus(int $status)
    {
        switch ($status) {
            case 0:
                return "Not Active";
                break;
            case 1:
                return "Active";
                break;
            default:
                return "Unknown";
                break;
        }
    }
}
