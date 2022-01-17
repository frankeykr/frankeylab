// Added event listener to the scroll
window.addEventListener('scroll', moveScrollIndicator);

// Getting scrollIndicator element by ID
const scrollIndicatorElt = document.getElementById('scrollIndicator');

// Height of entire web page - height
// of viewable portion of browser
const maxHeight = window.document.body.scrollHeight - window.innerHeight;

function moveScrollIndicator(e) {
// Calculating width of the 
// scrollIndicator element
const percentage = ((window.scrollY) / maxHeight) * 100;

// Pixels scrolled by the user 
// to total scrollable Pixels
scrollIndicatorElt.style.width = percentage + '%';
}