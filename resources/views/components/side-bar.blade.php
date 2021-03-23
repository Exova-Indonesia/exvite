        <div
          class="card rounded-0"
          style="background-image: url({{ auth()->user()->avatar->large }});"
          data-card-height="150"
          style="height: 150px"
        >
          <div class="card-top">
            <a
              href="#"
              class="close-menu float-end me-2 text-center mt-3 icon-40 notch-clear"
              ><i class="fa fa-times color-white"></i
            ></a>
          </div>
          <div class="card-bottom">
            <h1 class="color-white ps-3 mb-1 font-18">{{ auth()->user()->name }}</h1>
          </div>
          <div class="card-overlay bg-gradient"></div>
        </div>
        <div class="mt-4"></div>
        <h6 class="menu-divider">Akun</h6>
        <div class="list-group list-custom-small list-menu">
          <a id="nav-welcome" href="{{ url('/profile') }}">
            <i class="fa fa-user gradient-red color-white"></i>
            <span>Profil</span>
            <i class="fa fa-angle-right"></i>
          </a>
          <a id="nav-homepages" href="{{ url('/wallet') }}">
            <i class="fa fa-piggy-bank gradient-green color-white"></i>
            <span>Wallet</span>
            <i class="fa fa-angle-right"></i>
          </a>
          <a id="nav-components" href="{{ url('/studio') }}">
            <i class="fa fa-business-time gradient-blue color-white"></i>
            <span>Studio</span>
            <i class="fa fa-angle-right"></i>
          </a>
        </div>
        <h6 class="menu-divider mt-4">settings</h6>
        <div class="list-group list-custom-small list-menu">
          <a href="#" data-menu="menu-colors">
            <i class="fa fa-brush gradient-highlight color-white"></i>
            <span>Highlights</span>
            <i class="fa fa-angle-right"></i>
          </a>
          <a
            href="#"
            data-toggle-theme=""
            data-trigger-switch="switch-dark-mode"
          >
            <i class="fa fa-moon gradient-dark color-white"></i>
            <span>Dark Mode</span>
            <div class="custom-control small-switch ios-switch">
              <input
                data-toggle-theme=""
                type="checkbox"
                class="ios-input"
                id="toggle-dark-menu"
              />
              <label
                class="custom-control-label"
                for="toggle-dark-menu"
              ></label>
            </div>
          </a>
        </div>
        <h6 class="menu-divider mt-4">Orderan Terakhir</h6>
        <div class="list-group list-custom-small list-menu">
          <a href="#">
            <img src="images/pictures/1s.jpg" />
            <span>John Droid</span>
            <i class="fa fa-angle-right"></i>
          </a>
          <a href="#">
            <img src="images/pictures/5s.jpg" />
            <span>Gina Seed</span>
            <i class="fa fa-angle-right"></i>
          </a>
          <a href="#">
            <img src="images/pictures/6s.jpg" />
            <span>Jane Louder</span>
            <i class="fa fa-angle-right"></i>
          </a>
        </div>
        <h6 class="menu-divider font-10 mt-4">
        Copyright {{ config('app.name') }}<span class="copyright-year"> {{ date('Y') }}</span>
        </h6>
      </div>