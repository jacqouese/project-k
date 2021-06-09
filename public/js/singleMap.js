var map;
var directionsManager;

function GetMap(x1, y1, name) {
    window.scrollTo({top: 0, behavior: 'smooth'});
    map = new Microsoft.Maps.Map('#my-map', {
        credentials: 'ArnGjMKK1i1pqfVUfvKGlq33gKNMEgcV5wFmJ3L2QLm65AgaekhL44ZlGvAktUQ_'
    });

    //Load the directions module.
    Microsoft.Maps.loadModule('Microsoft.Maps.Directions', function () {
        //Create an instance of the directions manager.
        directionsManager = new Microsoft.Maps.Directions.DirectionsManager(map);

        //Get variables from HTML
        const x = document.getElementById('my-map').getAttribute('x');
        const y = document.getElementById('my-map').getAttribute('y');
        //Show directions to bikes on first load
        const xTemp = document.getElementById('my-map').getAttribute('xTemp');
        const yTemp = document.getElementById('my-map').getAttribute('yTemp');

        if (x != null && x != "") {
            //Create waypoints to route between.
            var seattleWaypoint = new Microsoft.Maps.Directions.Waypoint({ address: 'Ten nocleg', location: new Microsoft.Maps.Location(x, y) });
            directionsManager.addWaypoint(seattleWaypoint);

            if (x1 == null || x1 == '' || y1 == null || y1 == '') {
                x1 = xTemp;
                y1 = yTemp;
                name = 'stacja rowerów';
            }

            var workWaypoint = new Microsoft.Maps.Directions.Waypoint({ address: name, location: new Microsoft.Maps.Location(x1, y1) });
            directionsManager.addWaypoint(workWaypoint);

            //Specify the element in which the itinerary will be rendered.
            directionsManager.setRenderOptions({ itineraryContainer: '#directionsItinerary' });

            //Calculate directions.
            directionsManager.calculateDirections();
        }

        
    });
}
