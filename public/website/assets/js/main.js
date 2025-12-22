$(document).ready(function () {



    $('.news-marquee').marquee({
        duration: 10000,
        gap: 50,
        delayBeforeStart: 0,
        direction: 'left',
        duplicated: true,
        pauseOnHover: true
    })


    $('.owl-carousel').owlCarousel({
    loop:true,
    margin:20,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:4
        }
    }
})


// Donation custom amount toggle
$(document).on('change', 'input[name="donation_amount"]', function () {
  if ($(this).val() === 'custom') {
    $('.gr-donation-custom').slideDown(200);
  } else {
    $('.gr-donation-custom').slideUp(200);
  }
});



})
