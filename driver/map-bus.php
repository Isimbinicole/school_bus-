<?php
session_start();
if (!isset($_SESSION['driver_ID'])) {
    header("location:../index.php");
} else {
    $driver_ID = $_SESSION['driver_ID'];
}
include '../includes/db_conn.php';


$send_map = "";

$sql = "SELECT * FROM `drivers` as d inner join bus as b on d.bus_ID=b.bus_ID where d.driver_ID='$driver_ID' ";
$exe = $conn->query($sql);
while ($row = $exe->fetch_array()) {
    $longitude = $row['longitude'];
    $latitude = $row['latitude'];
    $name = $row['plate_number'];
    $icon2 = "{
                url: '../images/development/bus.png', 
                scaledSize: new google.maps.Size(50, 50), 
                origin: new google.maps.Point(0, 0), 
                anchor: new google.maps.Point(0, 0) 
            }";
}
$send_map .= "{coords:{lat:" . $latitude . ",lng:" . $longitude . "},content:'" . $name . "',iconImage:" . $icon2 . ",},";
$centerlat = $latitude;
$centerlong = $longitude;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>map</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="../plugins/jquery/jquery.js"></script>
    <script src="../plugins/jquery/jquery.min.js"></script>
    <style>
        #map {
            height: 100vh;
            /* The height is 400 pixels */
            width: 100%;
            background-color: grey;
            /* The width is the width of the web page */

        }
    </style>
</head>

<body style="width:100%;height:100%;overflow:hidden;">
    <div id="map" class="map ">
</body>


</html>





</div>

<script>
    // setInterval(() => {
    // Initialize and add the map
    function initMap() {
        var options = {
            zoom: 14,
            center: {
                lat: <?php echo $centerlat; ?>,
                lng: <?php echo $centerlong; ?>
            }
        }

        var map = new google.maps.Map(document.getElementById("map"), options);


        var markers = [<?php echo $send_map; ?>];

        // loop through markers 
        for (var i = 0; i < markers.length; i++) {
            addMarker(markers[i]);
        }


        function addMarker(props) {
            var marker = new google.maps.Marker({
                position: props.coords,
                map: map,

            });

            if (props.iconImage) {
                marker.setIcon(props.iconImage);
            }
            if (props.content) {
                var infoWindow = new google.maps.InfoWindow({
                    content: props.content,
                });
                infoWindow.open(map, marker);
                marker.addListener('click', function() {
                    infoWindow.open(map, marker);
                });
            }
            // this code will learn to continously fetch the location data of the soldier 

            const fetchLastData = () => {
                fetch("./includes/fetch-bus-loc.php")
                    .then((resp) => {
                        return resp.json();
                    })
                    .then((backData) => {
                        const gotData = backData;
                        console.log(gotData);


                        let latitude = Number(gotData.latitude);
                        let longitude = Number(gotData.longitude);


                        marker.setPosition({
                            lat: latitude,
                            lng: longitude
                        });
                    });
            }
            fetchLastData();
            setInterval(() => {
                fetchLastData();
            }, 3000);

        }
    }
    // }, 2000);
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABe4YclPdBycrGRaPI6RPxvDLugppGm_k&callback=initMap" async></script>