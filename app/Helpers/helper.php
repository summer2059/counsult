<?php

use App\Models\Configuration;
use App\Models\OfferCategory;
use App\Models\Page;
use App\Models\QuickLinks;

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
// if(!function_exists('getPage')){
//     function getPage(){
//         return Page::where('status', 1)->orderBy('priority', 'asc')->latest()->get();
//     }
// }
// if(!function_exists('getQuickLink')){
//     function getQuickLink(){
//         return QuickLinks::where('status', 1)->orderBy('priority', 'asc')->latest()->get();
//     }
// }
