<?php

use App\Models\Configuration;
use App\Models\Page;
use App\Models\QuickLink;

function getConfiguration($key){
    $config = Configuration::where('configuration_key', '=', $key)->first();
    if($config!=null){
        return $config->configuration_value;

    }
    return null;
}
// if (!function_exists('getOfferCategories')) {
//     function getOfferCategories()
//     {
//         return OfferCategory::with('offer')
//             ->where('status', 1)->latest()
//             ->get();
//     }
// }
// function formatNumber($number) {
//     if ($number >= 1000) {
//         $formattedNumber = round($number / 1000, 1) . 'k';
//         return $formattedNumber;
//     }
//     return $number;
// }
if(!function_exists('getPage')){
    function getPage(){
        return Page::where('status', 1)->where('type_id', 1)->latest()->get();
    }
}

if(!function_exists('getPageJP')){
    function getPageJP(){
        return Page::where('status', 1)->where('type_id', 2)->latest()->get();
    }
}
if(!function_exists('getQuickLink')){
    function getQuickLink(){
        return QuickLink::where('status', 1)->where('type_id', 1)->orderBy('priority', 'asc')->latest()->get();
    }
}
if(!function_exists('getQuickLinkJP')){
    function getQuickLinkJP(){
        return QuickLink::where('status', 1)->where('type_id',2)->orderBy('priority', 'asc')->latest()->get();
    }
}
