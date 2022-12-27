/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';


// start the Stimulus application
import './bootstrap';


import 'leaflet';

import 'leaflet/dist/leaflet.css';
import 'leaflet-defaulticon-compatibility/dist/leaflet-defaulticon-compatibility.webpack.css'; // Re-uses images from ~leaflet package
import * as L from 'leaflet';
import 'leaflet-defaulticon-compatibility';
var stage =[45.588862683915785, 2.739248871901525];

var map = L.map('map').setView(stage,19);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
    maxZoom: 30
}).addTo(map);

var marker =L.marker(stage).addTo(map)

marker.bindPopup('<a href="https://www.google.com/maps/@45.588862683915785,2.739248871901525,19z">Aux délices des fées</a>')


