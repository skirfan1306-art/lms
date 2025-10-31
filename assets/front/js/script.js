$(document).ready(function () {
    
      $('.custom-select').select2({
      width:'100%',
    minimumResultsForSearch: Infinity // removes search box
  });
  
  $(".open-booking-popup").on("click", function () {
    $(".booking-overlay, .booking-popup").fadeIn(300);
      $("body").addClass("no-scroll");
  });

  $(".booking-overlay, .close-popup").on("click", function () {
    $(".booking-overlay, .booking-popup").fadeOut(300);
      $("body").removeClass("no-scroll");
  });

  $(document).on("keydown", function (e) {
    if (e.key === "Escape") {
      $(".booking-overlay, .booking-popup").fadeOut(300);
    }
  });

  function toggleStickyHeader() {
    if ($(window).scrollTop() > 0) {
      $(".main-header-section").addClass("sticky-header");
      $(".header-search").addClass("scrolled");
    } else {
      $(".main-header-section, .header-search").removeClass(
        "sticky-header scrolled"
      );
    }
  }
  toggleStickyHeader();
  $(window).on("scroll", toggleStickyHeader);

  $(".search-icon").click(function (e) {
    e.stopPropagation();
    $(".header-search").toggleClass("showing");
  });

  $(".header-search").click(function (e) {
    e.stopPropagation();
  });

  $(document).click(function () {
    $(".header-search").removeClass("showing");
  });

  $(".menu-toggle").click(function (e) {
    e.stopPropagation();
    $(".menu-nav-list").toggleClass("active");
  });

  $(".has-submenu > .menu-nav-link").click(function (e) {
    if ($(window).width() <= 991) {
      e.preventDefault();
      var $parent = $(this).parent();
      $parent.toggleClass("open").siblings(".has-submenu").removeClass("open");
    }
  });

  $(document).click(function (e) {
    if (!$(e.target).closest(".menu-nav-list, .menu-toggle").length) {
      $(".menu-nav-list").removeClass("active");
      $(".has-submenu").removeClass("open");
    }
  });

  $(".owl-carousel.remoteslider").owlCarousel({
    margin: 10,
    loop: true,
    nav: false,
    dots: false,
    autoplay: true,
    autoplayTimeout: 2000, 
    responsive: { 0: { items: 2 }, 576: { items: 3 }, 768: { items: 5 } },
  });

  $(".owl-carousel.blog-slider").owlCarousel({
    margin: 50,
    loop: true,
    nav: false,
    dots: true,
    autoplay: true,
    autoplayTimeout: 2000,
    responsive: { 0: { items: 1 }, 768: { items: 2 }, 1300: { items: 3 } },
    onInitialized: limitDots,
    onTranslated: limitDots,
  });

  function limitDots(event) {
    var $dots = $(event.target).find(".owl-dots .owl-dot");
    if ($dots.length > 3) {
      $dots.hide().slice(0, 3).show();
    }
  }

  $(".owl-carousel.testimonial-slider").owlCarousel({
    margin: 10,
    loop: true,
    nav: false,
    dots: true,
    autoplay: true,
    autoplayTimeout: 2000,
    responsive: { 0: { items: 1 }, 576: { items: 1 }, 768: { items: 1 } },
  });

  $(".owl-carousel.feature-col-slider").owlCarousel({
    margin: 25,
    loop: true,
    nav: false,
    dots: false,
    autoplay: true,
    autoplayTimeout: 4000, // time between slides
  smartSpeed: 2000, 
    responsive: { 0: { items: 1 } },
  });

 

  $(".owl-carousel.related-products-slider").owlCarousel({
    margin: 35,
    loop: true,
    nav: false,
    dots: true,
    autoplay: true,
    autoplayTimeout: 3000,
    responsive: {
      0: { items: 1 },
      576: { items: 2 },
      768: { items: 3 },
      1024: { items: 4 },
    },
  });

  $(".owl-carousel.hero-slider").owlCarousel({
    items: 1,
    margin: 0,
    loop: true,
    nav: false,
    dots: true,
    autoplay: true,
    autoplayTimeout: 5000,
  });

  $(".owl-carousel .item").click(function () {
    const newSrc = $(this).data("large");
    $("#mainProductImage").attr("src", newSrc);
    $(".owl-carousel .item").removeClass("active");
    $(this).addClass("active");
  });

 

  let quantity = 1;
  const salePrice = 115.0;

  function updateQuantityPrice() {
    const totalPrice = (quantity * salePrice).toFixed(2);
    $(".price-total").text("£" + totalPrice);
    $("#quantity").text(quantity);
  }
  updateQuantityPrice();

  $("#btnMinus").click(function () {
    if (quantity > 1) {
      quantity--;
      updateQuantityPrice();
    }
  });

  $("#btnPlus").click(function () {
    quantity++;
    updateQuantityPrice();
  });

  window.addToBasket = function () {
    alert(
      `${quantity} product(s) added to basket at £${(
        quantity * salePrice
      ).toFixed(2)}`
    );
  };

window.toggleFavorite = function () {
  const icon = $("#favouriteIcon");

  if (icon.hasClass("fa-regular")) { 
    icon.removeClass("fa-regular").addClass("fa-solid heartbeat"); 
    setTimeout(() => icon.removeClass("heartbeat"), 600);
  } else { 
    icon.removeClass("fa-solid").addClass("fa-regular");
  }
};


  const tabsContainer = document.querySelector(".product-single-tab");
  if (tabsContainer) {
    const buttons = Array.from(tabsContainer.querySelectorAll("button"));
    const panels = Array.from(document.querySelectorAll("[role=tabpanel]"));

    function activateTab(tabButton) {
      buttons.forEach((btn) => {
        btn.classList.remove("active");
        btn.setAttribute("aria-selected", "false");
        btn.setAttribute("tabindex", "-1");
      });
      panels.forEach((panel) => panel.setAttribute("hidden", true));

      tabButton.classList.add("active");
      tabButton.setAttribute("aria-selected", "true");
      tabButton.setAttribute("tabindex", "0");

      const panelId = tabButton.getAttribute("aria-controls");
      const panel = document.getElementById(panelId);
      if (panel) {
        panel.removeAttribute("hidden");
        panel.focus();
      }
    }

    buttons.forEach((btn) => {
      btn.addEventListener("click", () => activateTab(btn));
      btn.addEventListener("keydown", (e) => {
        let index = buttons.indexOf(document.activeElement);
        if (e.key === "ArrowRight") index = (index + 1) % buttons.length;
        else if (e.key === "ArrowLeft")
          index = (index - 1 + buttons.length) % buttons.length;
        else if (e.key === "Home") index = 0;
        else if (e.key === "End") index = buttons.length - 1;
        else if (e.key === "Enter" || e.key === " ")
          activateTab(document.activeElement);
        buttons[index]?.focus();
      });
    });
  }

  const faqItems = document.querySelectorAll(".faq-item");
  faqItems.forEach((item) => {
    const btn = item.querySelector(".faq-question");
    btn.addEventListener("click", () => {
      faqItems.forEach((other) => {
        if (other !== item) {
          other.classList.remove("active");
          other
            .querySelector(".faq-question")
            .setAttribute("aria-expanded", "false");
          other.querySelector(".faq-question .symbol").textContent = "+";
        }
      });
      const isActive = item.classList.toggle("active");
      btn.setAttribute("aria-expanded", isActive);
      btn.querySelector(".symbol").textContent = isActive ? "-" : "+";
    });
  });

  const minPrice = $("#minPrice");
  const maxPrice = $("#maxPrice");
  const priceOutput = $("#priceOutput");
  const sliderTrack = $("#sliderTrack");
  const maxVal = parseInt(maxPrice.attr("max"), 10);

  function updateFilterPrice() {
    let min = parseInt(minPrice.val(), 10);
    let max = parseInt(maxPrice.val(), 10);

    if (min > max - 10) {
      min = max - 10;
      minPrice.val(min);
    }
    if (max < min + 10) {
      max = min + 10;
      maxPrice.val(max);
    }

    priceOutput.text(`£${min} - £${max}`);

    const percent1 = (min / maxVal) * 100;
    const percent2 = (max / maxVal) * 100;
    sliderTrack.css({ left: percent1 + "%", width: percent2 - percent1 + "%" });
  }

  minPrice.on("input", updateFilterPrice);
  maxPrice.on("input", updateFilterPrice);
  updateFilterPrice();

  $("#product-clear-filters").on("click", function (e) {
    e.preventDefault();
    $(".product-filters input[type='checkbox']").prop("checked", false);
    minPrice.val(200);
    maxPrice.val(400);
    updateFilterPrice();
  });
  
$(function () {
    function openPopup(id) {
        $(".login-overlay").fadeOut(200);
        $(id).fadeIn(300).css("display", "flex");
    }

    function closePopup(id) {
        $(id).fadeOut(300);
    }

    window.openPopup = openPopup;
    window.closePopup = closePopup;

    $("#openLogin").click(() => openPopup("#loginOverlay"));
    $("#openCa").click(() => openPopup("#caOverlay"));

    $("#closeLogin").click(() => closePopup("#loginOverlay"));
    $("#closeCa").click(() => closePopup("#caOverlay"));

    $(".login-links a").click(function (e) {
        e.preventDefault();
        if ($(this).text().includes("Sign Up")) openPopup("#caOverlay");
        else openPopup("#loginOverlay");
    });

    $(".login-overlay").click(function (e) {
        if (e.target === this) closePopup(this);
    });

    $(document).keydown(e => {
        if (e.key === "Escape") $(".login-overlay").fadeOut(300);
    });
});

});

flatpickr(".dateInput", {
  dateFormat: "d-m-Y",
  minDate: "today",
   disableMobile: true 
});


// product description gallery

  var mainSlider = $(".main-image-wrapper");
  var thumbs = $(".products-gallery");

  // Main slider
  mainSlider.owlCarousel({
    items:1,
    loop:true,
    dots:false,
    nav:false,
    smartSpeed:500
  });

  // Thumbnails slider
thumbs.owlCarousel({
  items: 4,
  margin: 10,
  dots: false,
  nav: false,
  responsive: {
    0: {
      items: 2 
    },
    768: {
      items: 4
    }
  }
});


  // Thumbnail click → sync main slider
  thumbs.on("click", ".products-gallery-image", function(){
    var index = $(this).data("index");
    mainSlider.trigger("to.owl.carousel", [index, 300]);

    // Active border
    $(".products-gallery .item").removeClass("active");
    $(this).addClass("active");
  });

  // Sync active thumbnail on main slider change
  mainSlider.on("changed.owl.carousel", function(event){
    var index = event.item.index - event.relatedTarget._clones.length / 2;
    var count = event.item.count;
    var currentIndex = ((index % count) + count) % count;

    $(".products-gallery .item").removeClass("active");
    $(".products-gallery .item").eq(currentIndex).addClass("active");
    thumbs.trigger("to.owl.carousel", [currentIndex, 300, true]);
  });