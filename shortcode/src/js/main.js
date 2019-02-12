jQuery(document).ready(function ($) {
  var swiper = new Swiper('.swiper-container', {
    slidesPerView: 1,
    spaceBetween: 20,
    loop: true,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    }
  })

  $('#work__slider--next').click(() => {
      swiper.slideNext()
    }
  )

  $('#work__slider--prev').click(() => {
      swiper.slidePrev()
    }
  )
})
