// 3rd party packages from NPM
import $ from 'jquery';
import slick from 'slick-carousel';

// Our modules / classes
import MobileMenu from './modules/MobileMenu';
import HeroSlider from './modules/HeroSlider';
import GoogleMap from './modules/GoogleMap';
import Search from './modules/Search';

// Instantiate a new object using our modules/classes
var mobileMenu = new MobileMenu();
var heroSlider = new HeroSlider();
var googleMap = new GoogleMap();
var search = new Search();

// So we have imported a our search.js javascript from another within the same modules 
// folder hence the ./modules. 

// And once we have it imported we can now create a new object of our search class 