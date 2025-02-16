<?php
use App\Models\ProductSizes;
use App\Models\Category;

if (!function_exists("formatcurrency")) {
    function formatcurrency($floatcurr, $curr = "USD")
    {
        $currencies["ARS"] = [2, ",", "."]; //  Argentine Peso
        $currencies["AMD"] = [2, ".", ","]; //  Armenian Dram
        $currencies["AWG"] = [2, ".", ","]; //  Aruban Guilder
        $currencies["AUD"] = [2, ".", " "]; //  Australian Dollar
        $currencies["BSD"] = [2, ".", ","]; //  Bahamian Dollar
        $currencies["BHD"] = [3, ".", ","]; //  Bahraini Dinar
        $currencies["BDT"] = [2, ".", ","]; //  Bangladesh, Taka
        $currencies["BZD"] = [2, ".", ","]; //  Belize Dollar
        $currencies["BMD"] = [2, ".", ","]; //  Bermudian Dollar
        $currencies["BOB"] = [2, ".", ","]; //  Bolivia, Boliviano
        $currencies["BAM"] = [2, ".", ","]; //  Bosnia and Herzegovina, Convertible Marks
        $currencies["BWP"] = [2, ".", ","]; //  Botswana, Pula
        $currencies["BRL"] = [2, ",", "."]; //  Brazilian Real
        $currencies["BND"] = [2, ".", ","]; //  Brunei Dollar
        $currencies["CAD"] = [2, ".", ","]; //  Canadian Dollar
        $currencies["KYD"] = [2, ".", ","]; //  Cayman Islands Dollar
        $currencies["CLP"] = [0, "", "."]; //  Chilean Peso
        $currencies["CNY"] = [2, ".", ","]; //  China Yuan Renminbi
        $currencies["COP"] = [2, ",", "."]; //  Colombian Peso
        $currencies["CRC"] = [2, ",", "."]; //  Costa Rican Colon
        $currencies["HRK"] = [2, ",", "."]; //  Croatian Kuna
        $currencies["CUC"] = [2, ".", ","]; //  Cuban Convertible Peso
        $currencies["CUP"] = [2, ".", ","]; //  Cuban Peso
        $currencies["CYP"] = [2, ".", ","]; //  Cyprus Pound
        $currencies["CZK"] = [2, ".", ","]; //  Czech Koruna
        $currencies["DKK"] = [2, ",", "."]; //  Danish Krone
        $currencies["DOP"] = [2, ".", ","]; //  Dominican Peso
        $currencies["XCD"] = [2, ".", ","]; //  East Caribbean Dollar
        $currencies["EGP"] = [2, ".", ","]; //  Egyptian Pound
        $currencies["SVC"] = [2, ".", ","]; //  El Salvador Colon
        $currencies["ATS"] = [2, ",", "."]; //  Euro
        $currencies["BEF"] = [2, ",", "."]; //  Euro
        $currencies["DEM"] = [2, ",", "."]; //  Euro
        $currencies["EEK"] = [2, ",", "."]; //  Euro
        $currencies["ESP"] = [2, ",", "."]; //  Euro
        $currencies["EUR"] = [2, ",", "."]; //  Euro
        $currencies["FIM"] = [2, ",", "."]; //  Euro
        $currencies["FRF"] = [2, ",", "."]; //  Euro
        $currencies["GRD"] = [2, ",", "."]; //  Euro
        $currencies["IEP"] = [2, ",", "."]; //  Euro
        $currencies["ITL"] = [2, ",", "."]; //  Euro
        $currencies["LUF"] = [2, ",", "."]; //  Euro
        $currencies["NLG"] = [2, ",", "."]; //  Euro
        $currencies["PTE"] = [2, ",", "."]; //  Euro
        $currencies["GHC"] = [2, ".", ","]; //  Ghana, Cedi
        $currencies["GIP"] = [2, ".", ","]; //  Gibraltar Pound
        $currencies["GTQ"] = [2, ".", ","]; //  Guatemala, Quetzal
        $currencies["HNL"] = [2, ".", ","]; //  Honduras, Lempira
        $currencies["HKD"] = [2, ".", ","]; //  Hong Kong Dollar
        $currencies["HUF"] = [0, "", "."]; //  Hungary, Forint
        $currencies["ISK"] = [0, "", "."]; //  Iceland Krona
        $currencies["INR"] = [2, ".", ","]; //  Indian Rupee
        $currencies["IDR"] = [2, ",", "."]; //  Indonesia, Rupiah
        $currencies["IRR"] = [2, ".", ","]; //  Iranian Rial
        $currencies["JMD"] = [2, ".", ","]; //  Jamaican Dollar
        $currencies["JPY"] = [0, "", ","]; //  Japan, Yen
        $currencies["JOD"] = [3, ".", ","]; //  Jordanian Dinar
        $currencies["KES"] = [2, ".", ","]; //  Kenyan Shilling
        $currencies["KWD"] = [3, ".", ","]; //  Kuwaiti Dinar
        $currencies["LVL"] = [2, ".", ","]; //  Latvian Lats
        $currencies["LBP"] = [0, "", " "]; //  Lebanese Pound
        $currencies["LTL"] = [2, ",", " "]; //  Lithuanian Litas
        $currencies["MKD"] = [2, ".", ","]; //  Macedonia, Denar
        $currencies["MYR"] = [2, ".", ","]; //  Malaysian Ringgit
        $currencies["MTL"] = [2, ".", ","]; //  Maltese Lira
        $currencies["MUR"] = [0, "", ","]; //  Mauritius Rupee
        $currencies["MXN"] = [2, ".", ","]; //  Mexican Peso
        $currencies["MZM"] = [2, ",", "."]; //  Mozambique Metical
        $currencies["NPR"] = [2, ".", ","]; //  Nepalese Rupee
        $currencies["ANG"] = [2, ".", ","]; //  Netherlands Antillian Guilder
        $currencies["ILS"] = [2, ".", ","]; //  New Israeli Shekel
        $currencies["TRY"] = [2, ".", ","]; //  New Turkish Lira
        $currencies["NZD"] = [2, ".", ","]; //  New Zealand Dollar
        $currencies["NOK"] = [2, ",", "."]; //  Norwegian Krone
        $currencies["PKR"] = [2, ".", ","]; //  Pakistan Rupee
        $currencies["PEN"] = [2, ".", ","]; //  Peru, Nuevo Sol
        $currencies["UYU"] = [2, ",", "."]; //  Peso Uruguayo
        $currencies["PHP"] = [2, ".", ","]; //  Philippine Peso
        $currencies["PLN"] = [2, ".", " "]; //  Poland, Zloty
        $currencies["GBP"] = [2, ".", ","]; //  Pound Sterling
        $currencies["OMR"] = [3, ".", ","]; //  Rial Omani
        $currencies["RON"] = [2, ",", "."]; //  Romania, New Leu
        $currencies["ROL"] = [2, ",", "."]; //  Romania, Old Leu
        $currencies["RUB"] = [2, ",", "."]; //  Russian Ruble
        $currencies["SAR"] = [2, ".", ","]; //  Saudi Riyal
        $currencies["SGD"] = [2, ".", ","]; //  Singapore Dollar
        $currencies["SKK"] = [2, ",", " "]; //  Slovak Koruna
        $currencies["SIT"] = [2, ",", "."]; //  Slovenia, Tolar
        $currencies["ZAR"] = [2, ".", " "]; //  South Africa, Rand
        $currencies["KRW"] = [0, "", ","]; //  South Korea, Won
        $currencies["SZL"] = [2, ".", ", "]; //  Swaziland, Lilangeni
        $currencies["SEK"] = [2, ",", "."]; //  Swedish Krona
        $currencies["CHF"] = [2, ".", '\'']; //  Swiss Franc
        $currencies["TZS"] = [2, ".", ","]; //  Tanzanian Shilling
        $currencies["THB"] = [2, ".", ","]; //  Thailand, Baht
        $currencies["TOP"] = [2, ".", ","]; //  Tonga, Paanga
        $currencies["AED"] = [2, ".", ","]; //  UAE Dirham
        $currencies["UAH"] = [2, ",", " "]; //  Ukraine, Hryvnia
        $currencies["USD"] = [2, ".", ","]; //  US Dollar
        $currencies["VUV"] = [0, "", ","]; //  Vanuatu, Vatu
        $currencies["VEF"] = [2, ",", "."]; //  Venezuela Bolivares Fuertes
        $currencies["VEB"] = [2, ",", "."]; //  Venezuela, Bolivar
        $currencies["VND"] = [0, "", "."]; //  Viet Nam, Dong
        $currencies["ZWD"] = [2, ".", " "]; //  Zimbabwe Dollar
        if ($curr == "INR" || $curr == "NPR") {
            return formatinr($floatcurr);
        } else {
            return number_format(
                $floatcurr,
                $currencies[$curr][0],
                $currencies[$curr][1],
                $currencies[$curr][2]
            );
        }
    }
}

if (!function_exists("formatinr")) {
    function formatinr($input)
    {
        if($input == '' || $input == NULL){
            return "0";
        } else {
            $dec = "";
            $pos = strpos($input, ".");
            if ($pos === false) {
                //no decimals
            } else {
                //decimals
                $dec = substr(round(substr($input, $pos), 2), 1);
                $input = substr($input, 0, $pos);
            }
            $num = substr($input, -3); //get the last 3 digits
            $input = substr($input, 0, -3); //omit the last 3 digits already stored in $num
            while (strlen($input) > 0) {
                //loop the process - further get digits 2 by 2
                $num = substr($input, -2) . "," . $num;
                $input = substr($input, 0, -2);
            }
            return $num . $dec;
        }
    }
}

if(!function_exists("suitable_for_groups")){
    function suitable_for_groups(){
        $suitable_for_groups = [
            [
                "id" => 1,
                "title" => "Men",
                "slug" => "men",
            ],
            [
                "id" => 2,
                "title" => "Women",
                "slug" => "women",
            ],
            [
                "id" => 3,
                "title" => "Kids",
                "slug" => "kids",
            ],
        ];
        return $suitable_for_groups;
    }
}

if(!function_exists("getGroupIdFromSlug")){
    function getGroupIdFromSlug($group_slug){
        $group_arr = suitable_for_groups();
        $search_key = array_search($group_slug, array_column($group_arr, "slug"));
        if($search_key !== FALSE)
            return isset($search_key) ? $group_arr[$search_key]['id'] : "";
        else
            return "";
    }
}

if(!function_exists("getGroupNameFromSlug")){
    function getGroupNameFromSlug($group_slug){
        $group_arr = suitable_for_groups();
        $search_key = array_search($group_slug, array_column($group_arr, "slug"));
        if($search_key !== FALSE)
            return isset($search_key) ? $group_arr[$search_key]['title'] : "";
        else
            return "";
    }
}

if (!function_exists("getClickableLinks")) {
    function getClickableLinks($clickstring, $type)
    {
        $clickable_links = "";
        if ($clickstring != "") {
            if (is_string($clickstring)) {
                $comma_search = ",";
                if(preg_match("/{$comma_search}/i", $clickstring)) {
                    $temp_arr = explode(",", $clickstring);
                    $temp_arr = array_map("trim", $temp_arr);
                } else {
                    $temp_arr[] =  $clickstring;
                }
            } else {
                $temp_arr = [];
                $modelDatas = $clickstring->toArray();
                foreach ($modelDatas as $key => $modelData) {
                    if ($type == "phone") {
                        $temp_arr[] = isset($modelDatas[$key]["contact_number"])
                            ? $modelDatas[$key]["contact_number"]
                            : "";
                    } else {
                        $temp_arr[] = isset($modelDatas[$key]["email"])
                            ? $modelDatas[$key]["email"]
                            : "";
                    }
                }
            }


            if (!empty($temp_arr)) {
                foreach ($temp_arr as $key => $temp) {
                    if ($temp != "") {
                        $temp = trim($temp);
                        if ($type == "phone") {
                            $clickable_links .=
                                "<a href='tel:" . $temp . "'>" . $temp . "</a>";
                        } elseif ($type == "email") {
                            $clickable_links .=
                                "<a href='mailto:" .
                                $temp .
                                "'>" .
                                $temp .
                                "</a>";
                        } else {
                            $clickable_links .= "<a>" . $temp . "</a>";
                        }
                        if ($key !== array_key_last($temp_arr)) {
                            $clickable_links .= ", ";
                        }
                    }
                }
            }
        }
        return $clickable_links;
    }
}

if (!function_exists("parseVideos")) {
    function parseVideos($yt_url = null)
    {
        $url_parsed_arr = parse_url($yt_url);
        if (
            $url_parsed_arr["host"] == "www.youtube.com" &&
            $url_parsed_arr["path"] == "/watch" &&
            substr($url_parsed_arr["query"], 0, 2) == "v=" &&
            substr($url_parsed_arr["query"], 2) != ""
        ) {
            $videos = $url_parsed_arr;
        } else {
            $videos = [];
        }
        // return array of parsed videos
        return $videos;
    }
}

if(!function_exists('getProductAttr')){
    function getProductAttr($product_id, $type){
        $data = ProductSizes::where(["product_id"=>$product_id])->pluck($type);
        return isset($data[0]) ? ($data[0]) : '';
    }
}

if(!function_exists('getSubcategories')){
    function getSubcategories($category_id){
        $categories = Category::where(["status" => "1", "parent_id" => $category_id])
            ->orderBy("order", "ASC")
            ->get();
        return $categories;
    }
}

if (!function_exists("getAvgRating")) {
    function getAvgRating($product_id)
    {
         $average_ratings = \App\Models\Review::where([
                "product_id" => $product_id,
            ])
                ->pluck("rating")
                ->avg();

            return $product_average =
                $average_ratings > 0 ? round($average_ratings) : 0;
    }
}