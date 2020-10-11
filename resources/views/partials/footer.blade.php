{{-- Layouts/footer.blade.php --}}

{{-- Footer --}}
<footer>
  <div class="container-fluid text-center py-3">
    <div class="row">
      <div class="col-6">

        <section class="my_presentation">
            <h2 class="text-center">CHI SIAMO</h2>
            <div id="carouselExample" class="carousel slide " data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carouselExample" data-slide-to="0" class="active d-none d-md-block"><br><br>
                  <img class="rounded-circle" src="{{ asset("img/daniele.png") }}" alt="First slide">
                </li>
                <li data-target="#carouselExample" data-slide-to="1"class=" d-none d-md-block"><br><br>
                  <img class="rounded-circle" src="{{ asset("img/andrea.jfif") }}" alt="Second slide">
                </li>
                <li data-target="#carouselExample" data-slide-to="2" class=" d-none d-md-block"><br><br>
                  <img class="rounded-circle" src="{{ asset("img/ivan.jfif") }}" alt="Third slide">
                </li>
                <li data-target="#carouselExample" data-slide-to="3" class=" d-none d-md-block"><br><br>
                  <img class="rounded-circle" src="{{ asset("img/nicola.jfif") }}" alt="Fourth slide">
                </li>
              </ol>

            <div class="carousel-inner">
              <div class="carousel-item active">
                <h3>DANIELE DETOMMASO</h3>
                <small>Back-end developer</small>
              </div>

              <div class="carousel-item">
                <h3>ANDREA CINIERI</h3>
                <small>Back-end developer</small>
              </div>

              <div class="carousel-item">
                <h3>IVAN MONFRINI</h3>
                <small>Front-end developer</small>
              </div>

              <div class="carousel-item">
                <h3>NICOLA VALENTE</h3>
                <small>Front-end developer</small>
              </div>

            </div>
            </div>
        </section>

      </div>
      <div class="col-6">
        <div class="navbar-collapse footer_list">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="d-inline-block nav-link" href="#">
                <span>Contacts</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="d-inline-block nav-link" href="#">
                <span>Credits</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="d-inline-block nav-link" href="#">
                <span>Socials Area</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="d-inline-block nav-link" href="#">
                <span>News Covid 19</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="d-inline-block nav-link" href="#">
                <span>FAQ</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="d-inline-block nav-link" href="#">
                <span>Lavora con noi</span>
              </a>
            </li>
          </ul>
        </div>

      </div>

    </div>
    <hr class="w-100">
    <div class="row">
      <div class="navbar-collapse social_list">
        <ul class="d-block d-flex flex-row justify-content-around navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fab fa-instagram"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fab fa-facebook-f"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fab fa-twitter"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</footer>
{{-- end Footer --}}
