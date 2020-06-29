
<link rel="stylesheet" href="<?=base_url()?>assets/css/map.css" type="text/css">
<div class="row">
    <div class="blog-post col-md-12 wow fadeIn">
        <div id="map"></div>
        <script>
            var selectedInfoWindow;
            function goto_course(course_id) {
                var url = "<?=base_url()?>search/result/"+course_id;
                document.location.href = url;
            }
            function goto_courses(location) {
                console.log("location :: " + location);
                var url = "<?=base_url()?>search/location/"+location;
                document.location.href = url;
            }
            function initMap() {
                var courses = JSON.parse('<?php echo $courses;?>');
                var radius = '<?php echo $radius;?>';
                var lot = '<?php echo $lot;?>';
                var lat = '<?php echo $lat;?>';
                var zoom = 12;
                switch (radius){
                    case '5':
                        zoom = 12;
                        break;
                    case "10":
                        zoom = 11;
                        break;
                    case "20":
                        zoom = 10;
                        break;
                    default:
                        break;
                }

                var latitude = "59.9160302";
                var longitude = "10.7361983";
                if(courses.length > 0 || lot != ""){
                    latitude = lat;
                    longitude = lot;
                }
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: zoom,
                    center: {lat: parseFloat(latitude), lng: parseFloat(longitude)}
                });

                // Display the area between the location southWest and northEast.
//                map.fitBounds(bounds);

                var showed_markers = [];
                for (var i = 0; i < courses.length; ++i) {
                    var location = courses[i].lat + "_" + courses[i].lot;
                    if(jQuery.inArray(location, showed_markers) !== -1){
                        continue;
                    }else{
                        var marker = new google.maps.Marker({
                            position: {
                                lat: parseFloat(courses[i].lat),
                                lng: parseFloat(courses[i].lot)
                            },
                            map: map
                        });
                        var html = '<div class="pin-area">';
                        var class_index = 0;
                        for (var k = 0; k < courses.length; k++) {
                            var location1 = courses[k].lat + "_" + courses[k].lot;
                            if(location == location1){
                                class_index ++;
                                showed_markers.push(location);
                            }else{
                                continue;
                            }
                        }

                        html += '<div class="span12">';
                        html += '<p>'+courses[i].address+'</p>';
                        html += '</div>';
                        // html += '<div class="span12">';
                        // if(class_index == 1){
                        //     html += '<button class="form-control" onclick="goto_course('+courses[i].id+')" style="background-color: red;color: white;width:120px">Find Class</button>';
                        // }else{
                        //     html += '<button class="form-control" onclick="goto_courses(\''+location+'\')" style="background-color: red;color: white;width:120px">Find Classes</button>';
                        // }
                        // html += '</div>';
                        html += '</div>';
                        attachSecretMessage(marker, html);
                    }

                    /*
                    var marker = new google.maps.Marker({
                        position: {
                            lat: parseFloat(courses[i].lat),
                            lng: parseFloat(courses[i].lot)
                        },
                        map: map
                    });
                    var html = '<div class="pin-area"><div class="span12">';
                    html += '<p>'+courses[i].address+'</p>';
                    html += '</div>';
                    html += '<div class="span12">';
                    html += '<button class="form-control" onclick="goto_course('+courses[i].id+')" style="background-color: red;color: white;width:120px">Find Classes</button>';
                    html += '</div></div>';
                    attachSecretMessage(marker, html);
                    */
                }


                initAutocomplete();
            }

            // Attaches an info window to a marker with the provided message. When the
            // marker is clicked, the info window will open with the secret message.
            function attachSecretMessage(marker, secretMessage) {
                var infowindow = new google.maps.InfoWindow({
                    content: secretMessage
                });
//                marker.addListener('click', function() {
//                    infowindow.open(marker.get('map'), marker);
//                });
                marker.addListener('click', function() {
                    if (selectedInfoWindow != null && selectedInfoWindow.getMap() != null) {
                        selectedInfoWindow.close();
                        if (selectedInfoWindow == infowindow) {
                            selectedInfoWindow = null;
                            return;
                        }
                    }
                    selectedInfoWindow = infowindow;
                    selectedInfoWindow.open(map, marker);
                });

            }
        </script>
        <script>
            var autocomplete;
            function initAutocomplete() {
                // Create the autocomplete object, restricting the search to geographical
                // location types.
                autocomplete = new google.maps.places.Autocomplete(
                    /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
                    {componentRestrictions: {country: "no"}});

                // When the user selects an address from the dropdown, populate the address
                // fields in the form.
                autocomplete.addListener('place_changed', fillInAddress);
            }

            function fillInAddress() {
                // Get the place details from the autocomplete object.
                $("#address").val("");
                $("#lot").val("");
                $("#lat").val("");
                var place = autocomplete.getPlace();
                var location = place.geometry.location;

                $("#address").val(place.name);
                $("#lat").val(location.lat());
                $("#lot").val(location.lng());
            }
            function geolocate() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var geolocation = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        var circle = new google.maps.Circle({
                            center: geolocation,
                            radius: position.coords.accuracy
                        });
                        autocomplete.setBounds(circle.getBounds());
                    });
                }
            }
        </script>
    </div>
</div>
<!-- <div class="row wow fadeIn searchform md-t20 md-b20">
    <form action="<?=base_url()?>search/form" method="post">
    <div class="col-md-12 row">
        <div class="col-md-2"></div>
        <div class="col-md-4 col-sm-12">
            <select name="level" id="level" class="sel-level form-control">
                <option value="0">Select Level</option>
                <?php
                foreach ($levels as $level){
                    if($level['is_visible'] == 1){
                        if($level['id'] == $sel_level){
                            echo '<option value="'.$level['id'].'" selected>'.$level['level_name'].'</option>';
                        }else{
                            echo '<option value="'.$level['id'].'">'.$level['level_name'].'</option>';
                        }
                    }
                }
                ?>
            </select>
        </div>
        <div class="col-md-4 col-sm-12" style="height: 60px;">
            <div id="locationField">
                <input id="autocomplete" placeholder="Type your address or Post Code" onFocus="geolocate()" value="<?=$address?>" type="text" class="form-control" required/>
            </div>
            <input type="hidden" name="address" id="address" />
            <input type="hidden" name="lot" id="lot" />
            <input type="hidden" name="lat" id="lat" />
        </div>
        <div class="col-md-2"></div>
    </div>
    <div class="col-md-12 row">
        <div class="col-md-2"></div>
        <div class="col-md-4 col-sm-12">
            <select name="radius" id="radius" class="form-control" style="float: left;">
                <option value="5" <?php echo $radius == '5' ? "selected" : ""; ?>>Within 5km</option>
                <option value="10" <?php echo $radius == '10' ? "selected" : ""; ?>>Within 10km</option>
                <option value="20" <?php echo $radius == '20' ? "selected" : ""; ?>>Within 20km</option>
            </select>
        </div>
        <div class="col-md-4 col-sm-12">
            <button type="submit" id="btn_search" class="form-control btn-custom">SEARCH</button>
        </div>
        <div class="col-md-2"></div>
    </div>
    </form> -->
</div>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHzdYJH6qSnII2K1mrEPBxHtAqIQP_tIE&callback=initMap&libraries=places">
</script>