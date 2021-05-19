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

          </a>
          <a id="nav-homepages" href="{{ url('/wallet') }}">
            <i class="fa fa-piggy-bank gradient-green color-white"></i>
            <span>Wallet</span>

          </a>
          <a id="nav-components" href="{{ url('/studio') }}">
            <i class="fa fa-business-time gradient-blue color-white"></i>
            <span>Studio</span>

          </a>
          <a id="nav-components" href="{{ url('/messenger') }}">
            <i class="fa fa-envelope gradient-yellow color-white"></i>
            <span>Messenger</span>
            <!-- <i class="font-normal">{{ $messages ?? 0 }}</i> -->
          </a>
        </div>
        <h6 class="menu-divider mt-4">settings</h6>
        <div class="list-group list-custom-small list-menu">
          <a
            href="#"
            data-toggle-thee=""
            data-trigger-switc="switch-dark-mod"
          >
            <i class="fa fa-moon gradient-dark color-white"></i>
            <span>Dark Mode</span>
              <span class="bg-danger rounded-pill text-white pr-2">Coming Soon</span>
            <!-- <div class="custom-control small-switch ios-switch">
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
            </div> -->
          </a>
          <a role="button" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <i class="fa fa-power-off gradient-red color-white"></i>
            <span>Logout</span>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
        </div>
        <h6 class="menu-divider font-10 mt-4">
        Copyright {{ config('app.name') }}<span class="copyright-year"> {{ date('Y') }}</span>
        </h6>
      </div>