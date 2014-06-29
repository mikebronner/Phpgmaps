## Phpgmaps
A none CI implementation of BIOINSTALL's [CodeIgniter library](http://github.com/BIOSTALL/CodeIgniter-Google-Maps-V3-API-Library).

### Overview
I found this library to be incredibly useful when I was working in CodeIgniter. However a little bit of work needed to be done to use it in a Laravel project. I can't take any of the credit for the actual "heavy lifting" going on in the class.

### Installation
 1. Include the package in your composer.json file `"appitventures/phpgmaps": "dev-master",`
 2. Add `'Appitventures\Phpgmaps\PhpgmapsServiceProvider',` to app.config
 3. Add `'Gmaps' => 'Appitventures\Phpgmaps\Facades\Phpgmaps',` to your facade list

### Example 
The following code will prompt the user for access to their geolocation and then creates a map centered on their lat/lng

    Route::get('/', function(){
        $config = array();
        $config['center'] = 'auto';
        $config['onboundschanged'] = 'if (!centreGot) {
                var mapCentre = map.getCenter();
                marker_0.setOptions({
                    position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng())
                });
            }
            centreGot = true;';
            
        Gmaps::initialize($config);

        // set up the marker ready for positioning
        // once we know the users location
        $marker = array();
        Gmaps::add_marker($marker);

        $map = Gmaps::create_map();
        echo "<html><head>".$map['js']."</head><body>".$map['html']."</body></html>";
    });

### More Examples
BIOINSTALL has a great website showing how to do all the things with the class. No reason to reinvent the wheel, so [here](http://biostall.com/demos/google-maps-v3-api-codeigniter-library/) it is. The only thing to note is that `$this->googlemaps` is now `Gmaps::`.
