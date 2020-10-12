{{-- Layouts/footer.blade.php --}}

{{-- Footer --}}
<footer>

  {{-- Bootstrap --}}
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 p-0">

        {{-- Section Footer menu --}}
        <div class="row">
          <div class="col-12">
            <section class="footer_menu">

              {{-- Footer menu navbar --}}
              <nav class="footer_menu_navbar">
                <ul class="footer_menu_list text-center d-flex justify-content-center">

                  {{-- Instagram --}}
                  <li class="menu_item d-inline-block">
                    <a class="menu_link" href="#">
                      <span>Contacts</span>
                    </a>
                  </li>

                  {{-- Facebook --}}
                  <li class="menu_item d-inline-block">
                    <a class="menu_link" href="#">
                      <span>Faq</span>
                    </a>
                  </li>

                  {{-- Twitter --}}
                  <li class="menu_item d-inline-block">
                    <a class="menu_link" href="#">
                      <span>Work with us</span>
                    </a>
                  </li>

                  {{-- Youtube --}}
                  <li class="menu_item d-inline-block">
                    <a class="menu_link" href="#">
                      <span>Covid 19</span>
                    </a>
                  </li>

                </ul>
              </nav>
              {{-- Footer menu navbar --}}

            </section>
          </div>
        </div>
        {{-- end Section Footer menu --}}

        {{-- My presentation --}}
        <div class="row d-flex justify-content-center">
          <div class="col-12 text-center">
            <section class="my_presentation">

              {{-- Carousel --}}
              <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">

                {{-- Carousel faces circles --}}
                <ol class="carousel-indicators">
                  <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active">
                    <img class="rounded-circle" src="{{ asset("img/daniele.png") }}" alt="First slide">
                  </li>
                  <li data-target="#carouselExampleCaptions" data-slide-to="1">
                    <img class="rounded-circle" src="{{ asset("img/andrea.jfif") }}" alt="Second slide">
                  </li>
                  <li data-target="#carouselExampleCaptions" data-slide-to="2">
                    <img class="rounded-circle" src="{{ asset("img/ivan.jfif") }}" alt="Third slide">
                  </li>
                  <li data-target="#carouselExampleCaptions" data-slide-to="3">
                    <img class="rounded-circle" src="{{ asset("img/nicola.jfif") }}" alt="Fourth slide">
                  </li>
                </ol>
                {{-- Carousel faces circles --}}

                {{-- Carousel Inner --}}
                <div class="carousel-inner">

                  {{-- Daniele --}}
                  <div class="carousel-item active">
                    <div class="d-none d-block height_title"></div>
                    <div class="carousel-caption d-none d-block">
                      <a href="https://www.linkedin.com/in/daniele-detommaso-234682178/" target="_blank">
                        <h5>Daniele Detommaso</h5>
                        <p>Full-Stack Web Developer</p>
                      </a>
                    </div>
                  </div>
                  {{-- Daniele --}}

                  {{-- Ivan --}}
                  <div class="carousel-item">
                    <div class="d-none d-block height_title"></div>
                    <div class="carousel-caption d-none d-block">
                      <a href="https://www.linkedin.com/in/andrea-cinieri/" target="_blank">
                        <h5>Andrea Cinieri</h5>
                        <p>Full-Stack Web Developer</p>
                      </a>
                    </div>
                  </div>
                  {{-- end Ivan --}}

                  {{-- Andrea --}}
                  <div class="carousel-item">
                    <div class="d-none d-block height_title"></div>
                    <div class="carousel-caption d-none d-block">
                      <a href="https://www.linkedin.com/in/ivanmonfrini/" target="_blank">
                        <h5>Ivan Monfrini</h5>
                        <p>Full-Stack Web Developer</p>
                      </a>
                    </div>
                  </div>
                  {{-- end Andrea --}}

                  {{-- Nicola --}}
                  <div class="carousel-item">
                    <div class="d-none d-block height_title"></div>
                    <div class="carousel-caption d-none d-block">
                      <a href="https://www.linkedin.com/in/nicola-valente-339a0010a/?originalSubdomain=it" target="_blank">
                        <h5>Nicola Valente</h5>
                        <p>Full-Stack Web Developer</p>
                      </a>
                    </div>
                  </div>
                  {{-- end Nicola --}}

                </div>
                {{-- Carousel Inner --}}

              </div>
              {{-- end Carousel --}}

            </section>
          </div>
        </div>
        {{-- end My presentation --}}

        {{-- Section Social --}}
        <div class="row">
          <div class="col-12">
            <section class="footer_socials">

              {{-- Socials navbar --}}
              <nav class="socials_navbar">
                <ul class="socials_list text-center d-flex justify-content-between">

                  {{-- Instagram --}}
                  <li class="socials_item d-inline-block">
                    <a class="socials_link" href="https://www.instagram.com/?hl=it" target="_blank">
                      <i class="fab fa-instagram-square"></i>
                    </a>
                  </li>
                  {{-- end Instagram --}}

                  {{-- Facebook --}}
                  <li class="socials_item d-inline-block">
                    <a class="socials_link" href="https://www.facebook.com/gaming/?ref=games_tab" target="_blank">
                      <i class="fab fa-facebook"></i>
                    </a>
                  </li>
                  {{-- end Facebook --}}

                  {{-- Twitter --}}
                  <li class="socials_item d-inline-block">
                    <a class="socials_link" href="https://twitter.com/login?lang=it" target="_blank">
                      <i class="fab fa-twitter-square"></i>
                    </a>
                  </li>
                  {{-- end Twitter --}}

                  {{-- Youtube --}}
                  <li class="socials_item d-inline-block">
                    <a class="socials_link" href="https://www.youtube.com/?gl=IT&hl=it" target="_blank">
                      <i class="fab fa-youtube"></i>
                    </a>
                  </li>
                  {{-- end Youtube --}}

                </ul>
              </nav>
              {{-- Socials navbar --}}

              {{-- Copyrights --}}
              <p class="copyrights text-center">© 2020 Airbnb, Inc. All rights reserved protected by Copyrights</p>

            </section>
          </div>
        </div>
        {{-- end Section Social --}}

      </div>
    </div>
  </div>
  {{-- Bootstrap --}}

</footer>
{{-- end Footer --}}
