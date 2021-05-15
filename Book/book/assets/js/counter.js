var a = 0;
$(window).scroll(function() {

  var oTop = $('.mu-single-counter').offset().top - window.innerHeight;
  if (a == 0 && $(window).scrollTop() > oTop) {
    $('.counter-value').each(function() {
      var $this = $(this),
        countTo = $this.attr('data-count');
      $({
        countNum: $this.text()
      }).animate({
          countNum: countTo
        },

        {

          duration: 2000,
          easing: 'swing',
          step: function() {
            $this.text(Math.floor(this.countNum));
          },
          complete: function() {
            $this.text(this.countNum);
            //alert('finished');
          }

        });
    });
    a = 1;
  }

});


//Form Display None

function openForm() {
document.getElementById("popupForm").style.display = "block";
}
function closeForm() {
document.getElementById("popupForm").style.display = "none";
}
