 <!-- footer-66 -->
  <footer class="w3l-footer">

  </footer>
  <!--//footer-66 -->

  <!-- jQuery JS -->
  <!-- <script src="assets/js/jquery-3.4.1.slim.min.js"></script> -->
  <script src="{{ url('assets/js/jquery-1.9.1.min.js') }}"></script>


  <script src="{{ url('assets/js/theme-change.js') }}"></script>

  <!-- responsive tabs -->
  <script src="{{ url('assets/js/easyResponsiveTabs.js') }}"></script>

  <!--Plug-in Initialisation-->
  <script type="text/javascript">
    $(document).ready(function () {
      //Horizontal Tab
      $('#parentHorizontalTab').easyResponsiveTabs({
        type: 'default', //Types: default, vertical, accordion
        width: 'auto', //auto or any width like 600px
        fit: true, // 100% fit in a container
        tabidentify: 'hor_1', // The tab groups identifier
        activate: function (event) { // Callback function if tab is switched
          var $tab = $(this);
          var $info = $('#nested-tabInfo');
          var $name = $('span', $info);
          $name.text($tab.text());
          $info.show();
        }
      });
    });
  </script>
  <!-- Template JavaScript -->
  <script src="{{ url('assets/js/owl.carousel.js') }}"></script>
  <!-- script for banner slider-->
  <script>
    $(document).ready(function () {
      $('.owl-one').owlCarousel({
        loop: true,
        margin: 0,
        nav: false,
        responsiveClass: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplaySpeed: 1000,
        autoplayHoverPause: false,
        responsive: {
          0: {
            items: 1,
            nav: false
          },
          480: {
            items: 1,
            nav: false
          },
          667: {
            items: 1,
            nav: true
          },
          1000: {
            items: 1,
            nav: true
          }
        }
      })
    })
  </script>
  <!-- //script -->

  <!-- disable body scroll which navbar is in active -->
  <script>
    $(function () {
      $('.navbar-toggler').click(function () {
        $('body').toggleClass('noscroll');
      })
    });
  </script>
  <!-- disable body scroll which navbar is in active -->


  <!-- Bootstrap JS -->
  <script src="{{ url('assets/js/bootstrap.min.js') }}"></script>
  </body>

  </html>