(function () {

    $(document).ready(function(){
        
        //Dashboard Links transition function
        $('a').click(function(e){
            e.preventDefault();

            var href = $(this).attr('href');

            $('body').addClass('apage-transition');

            setTimeout(function(){
                window.location.href = href;
            }, 500); 
        });

        //Logout Handler
        $('#logout').click(function(e) {
            e.preventDefault(); 
            fetch('/logout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_field() }}' // Add CSRF token
                },
               
            }).then(response => {
                
            }).catch(error => {
                console.error('Logout error:', error);
            });
        });
    });

    /* Card-Creation Reload IA Response
    document.getElementById('reload-response').addEventListener('click', function(){
        document.getElementById('card-creation-form').submit();
    });
    */
    /*Card-Creation Card Flip */
    // enter on keyboard works like clicking
document.querySelectorAll('.flip-card-click .flip-card-inner').forEach(function(item) {  
    item.addEventListener('keypress', function(evt) { if (evt.keyCode == 13 || evt.keyCode == 32) { item.click(); } });
});
// click to flip
document.querySelectorAll('.flip-card-click').forEach(function(item) { 
    item.addEventListener('click', function () { this.classList.toggle('flipped');  });
});
// shuffle cards
function shuffle(id) {
  var container = document.getElementById(id);
  var cardClass = container.getElementsByTagName('div')[0].className;
  var elementsArray = Array.prototype.slice.call(container.getElementsByClassName(cardClass));
    elementsArray.forEach(function(element){
    container.removeChild(element);
  })
  shuffleArray(elementsArray);
  elementsArray.forEach(function(element){
  container.appendChild(element);
})
}
function shuffleArray(array) {
    for (var i = array.length - 1; i > 0; i--) {
        var j = Math.floor(Math.random() * (i + 1));
        var temp = array[i];
        array[i] = array[j];
        array[j] = temp;
    }
    return array;
}
    
})();
