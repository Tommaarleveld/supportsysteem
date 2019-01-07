<nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="/">{{config('app.name', 'Supportsysteem')}}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
  
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item {{request()->is('/') ? 'active' : ''}}">
              <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item {{request()->is('about') ? 'active' : ''}}">
              <a class="nav-link" href="/about">About</a>
            </li>
            <li class="nav-item {{request()->is('tickets') ? 'active' : ''}}">
                <a class="nav-link" href="/tickets">Tickets</a>
            </li>
          </ul>
        </div>
</nav>