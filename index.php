
    <?php   header("Access-Control-Allow-Origin: *");
            header("ContentType: application/json");
            $defaultTimeZone='America/Los_Angeles';
            date_default_timezone_set($defaultTimeZone);
    ?>

    <?php $street=$_GET["street"]; $city=$_GET["city"]; $state=$_GET["state"];
            switch ($_GET["degree"])
            {
                case "Fahrenheit": {$degree="us";}break;
                case "Celsius": {$degree="si";}break;
                default: $degree="";break;
            }
            $geocodeurl="http://maps.google.com/maps/api/geocode/xml?address=".$street.",".$city.",".$state;
            $geoxml=simplexml_load_file($geocodeurl);
            $lat=$geoxml->result->geometry->location->lat;
            $lng=$geoxml->result->geometry->location->lng;
            $mykey="0cb4c308b597a4d4d04786315b34f697";
            $forecasturl="https://api.forecast.io/forecast/"
                        .$mykey."/".$lat.",".$lng."?units=".$degree."&exclude=flags";

            $json = file_get_contents($forecasturl);
            echo $json;
?>
