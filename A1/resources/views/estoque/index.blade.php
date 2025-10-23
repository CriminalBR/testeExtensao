{{-- ... Código anterior ... --}}
                        @else
                            {{-- Link para Estoque --}}
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('estoque.*') ? 'active' : '' }}" href="{{ route('estoque.index') }}">
                                    <i class="bi bi-box-seam me-1"></i> {{ __('Estoque') }}
                                </a>
                            </li>
                            {{-- Link para Relatório --}}
                             <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('relatorio.*') ? 'active' : '' }}" href="{{ route('relatorio.index') }}">
                                    <i class="bi bi-bar-chart-line me-1"></i> {{ __('Relatório') }}
                                </a>
                            </li>

                            {{-- Dropdown do Usuário (já existente) --}}
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                     <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    {{-- Pode adicionar link para Perfil aqui se quiser --}}
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        {{-- ... Restante do código ... --}}

    {{-- Certifique-se de ter os scripts do Bootstrap (geralmente no final do body) --}}
    {{-- @vite(['resources/js/app.js']) --}} {{-- Se estiver usando Vite --}}
    {{-- Ou adicione o script do Bootstrap via CDN se não usar Vite/Mix --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> --}}

    {{-- Adicionar CDN Bootstrap Icons (idealmente no <head>) --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</body>
</html>