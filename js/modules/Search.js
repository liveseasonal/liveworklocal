import $ from 'jquery'; 

class Search {

// 1. Describe and create/initite our object

  constructor(){
    this.openButton = $('.js-search-trigger');
    this.closeButton = $('search-overlay__close')
    this.searchOverlay = $('.search-overlay')
    this.events();
  }

//2. Events List all of my different events

events() {
  this.openButton.on('click',this.openOverlay.bind(this));
  this.closeButton.on('click',this.closeOverlay.bind(this));
}



//3. Methods (function, action...)



  openOverlay() {
    this.searchOverlay.addClass('search-overlay--active');

  }

  closeOverlay() {
    this.searchOverlay.removeClass('search-overlay--active');
  }

}

export default Search; 



// So when creating a class in JS always have the constructor method and whatever is between 
// the curly brackets will run 
// When we want to export to another file to use we use export default Search; 





