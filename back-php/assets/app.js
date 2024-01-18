import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';


import logo  from './images/logo_ConsumerPrediction.png';

import imageMannequin  from './images/mannequin.png';

import pub from './images/pub.jpg';
import imagePrediction from './images/imagePrediction.png';
import DRKadry from './images/DRKadry.png';
import banner from './images/banner.jpg';
import makup from './images/makup.png';
import gloss from './images/gloss.png';
import makupL from './images/makupL.png';


require('bootstrap');

let html;
html = `<img src="${logo}" alt="logo">`;

html = `<img src="${imageMannequin}" alt="imageMannequin">`;

html = `<img src="${pub}" alt="pub">`;
html = `<img src="${imagePrediction}" alt="image Prediction">`;
html = `<img src="${DRKadry}" alt="DR Kadry">`;
html = `<img src="${banner}" alt="banner">`;
html = `<img src="${makup}" alt="image makup">`;
html = `<img src="${makupL}" alt="image makupL">`;
html = `<img src="${gloss}" alt="image gloss">`;



