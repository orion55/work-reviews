jQuery(document).ready(function ($) {
  var swiper = new Swiper('.swiper-container', {
    slidesPerView: 1,
    spaceBetween: 20
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
