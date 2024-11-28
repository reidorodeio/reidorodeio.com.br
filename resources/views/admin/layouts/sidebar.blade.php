<aside class="s7__sidebar">
    <button type="button" class="sidebar-close-btn"><i class="las la-times-circle"></i></button>
    <div class="s7__logo">
        <a href="{{ route('admin.home') }}" class="long-logo"><img src="{{ asset('public/images/logo/logo.png') }}"
                alt="logo image"></a>
        <a href="{{ route('admin.home') }}" class="short-logo-icon"><img class="cust-short-logo"
                src="{{ asset('public/images/logo/favicon.png') }}" alt="logo image"></a>
    </div>
    <div class="s7__sidebar-nav-wrapper" data-simplebar>
        <ul class="s7__sidebar-nav" id="s7__sidebar-nav">
            <li>
                <a class="sidebar-link" href="{{ route('admin.home') }}">
                    <span data-feather="home" class="nav-icon"></span>
                    <span class="s7__nav-caption">{{ __('Painel') }}</span>
                </a>
            </li>
            
            <li>
                   <a href="{{ route('admin.fantasy.competitors.index') }}" class="sidebar-link">
                        <span data-feather="users" class="nav-icon"></span>
                        <span class="s7__nav-caption">{{ __('Competidores Fantasy') }}</span>
                   </a>
            </li>

            <li>
                   <a href="{{ route('admin.fantasy.events.index') }}" class="sidebar-link">
                       <span data-feather="users" class="nav-icon"></span>
                       <span class="s7__nav-caption">{{ __('Eventos Fantasy') }}</span>
                   </a>
            </li>

            <li>
                   <a href="{{ route('admin.fantasy.boloens.index') }}" class="sidebar-link">
                       <span data-feather="users" class="nav-icon"></span>
                       <span class="s7__nav-caption">{{ __('Bolões Fantasy') }}</span>
                   </a>
            </li>

            <li>
                   <a href="{{ route('admin.fantasy.rankings.index') }}" class="sidebar-link">
                       <span data-feather="users" class="nav-icon"></span>
                       <span class="s7__nav-caption">{{ __('Ranking Fantasy') }}</span>
                   </a>
            </li>

            <li class="nav-item">
                   <a class="nav-link" href="{{ route('admin.points.index') }}">
                      <i class="fas fa-trophy"></i>
                      <span class="nav-icon"> </span>
                      <span>Pontuar Fantasy</span>
                   </a>
           </li>

            <li>
                    <a href="{{ route('admin.fantasy.teams.index') }}" class="sidebar-link">
                        <span data-feather="users" class="nav-icon"></span>
                        <span class="s7__nav-caption">{{ __('Times Fantasy') }}</span>
                   </a>
            </li>
        
            @can('permissions-index')
                <li class="has-child">
                    <a href="#0" aria-expanded="false">
                        <span data-feather="users" class="nav-icon"></span>
                        <span class="s7__nav-caption">{{ __('Administradores') }}</span>
                    </a>
                    <ul class="s7__sub-nav" aria-expanded="false">
                        <li>
                            <a class="sidebar-link" href="{{ route('permissions.index') }}">
                                <span class="s7__nav-caption">{{ __('Permissões') }}</span>
                            </a>
                        </li>
                        @can('roles-index')
                            <li>
                                <a class="sidebar-link" href="{{ route('roles.index') }}">
                                    <span class="s7__nav-caption">{{ __('Usuários') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('admin-users-index')
                            <li>
                                <a class="sidebar-link" href="{{ route('admin-users.index') }}">
                                    <span class="s7__nav-caption">{{ __('Usuários Registrados') }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            <li class="s7__menu-title">
                <span>{{ __('Usuários') }} </span>
            </li>

            @can('admin-user-manage')
            <li>
               <a href="{{ route('admin.user.manage') }}">
                   <span data-feather="users" class="nav-icon"></span>
                  <span class="s7__nav-caption">{{ __('Usuários') }}</span>
                </a>
            </li>
            @endcan



            <li class="s7__menu-title">
                <span>{{ __('Comissões') }} </span>
            </li>
            
            @can('admin-referral-index')
                <li>
                    <a class="sidebar-link" href="{{ route('admin.referral.index') }}">
                        <span data-feather="link" class="nav-icon"></span>
                        <span class="s7__nav-caption">{{ __('Indicações') }}</span>
                    </a>
                </li>
            @endcan

            <li class="s7__menu-title">
                <span>{{ __('Saque') }} </span>
            </li>

            @can('withdraw-index')
                <li class="has-child">
                    <a href="#0" aria-expanded="false">
                        <span data-feather="users" class="nav-icon"></span>
                        <span class="s7__nav-caption">{{ __('Saque') }}</span>
                    </a>
                    <ul class="s7__sub-nav" aria-expanded="false">
                        <li>
                            <a class="sidebar-link" href="{{ route('withdraw.index') }}">
                                <span class="s7__nav-caption">{{ __('Métodos') }}</span>
                            </a>
                        </li>
                        @can('admin-withdraw-request')
                            <li>
                                <a class="sidebar-link" href="{{ route('admin.withdraw.request') }}">
                                    <span class="s7__nav-caption">{{ __('Pendentes') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('admin-withdraw-viewlog')
                            <li>
                                <a class="sidebar-link" href="{{ route('admin.withdraw.viewlog') }}">
                                    <span class="s7__nav-caption">{{ __('Logs') }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            <li class="s7__menu-title">
                <span>{{ __('Controles') }} </span>
            </li>

            @can('advertise-create')
                <li class="has-child">
                    <a href="#0" aria-expanded="false">
                        <span data-feather="users" class="nav-icon"></span>
                        <span class="s7__nav-caption">{{ __('Anúncios') }}</span>
                    </a>
                    <ul class="s7__sub-nav" aria-expanded="false">
                        <li>
                            <a class="sidebar-link" href="{{ route('advertise.create') }}">
                                <span class="s7__nav-caption">{{ __('Adicionar') }}</span>
                            </a>
                        </li>
                        @can('admin-advertise-banner')
                            <li>
                                <a class="sidebar-link" href="{{ route('admin.advertise.banner') }}">
                                    <span class="s7__nav-caption">{{ __('Banners') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('admin-advertise-script')
                            <li>
                                <a class="sidebar-link" href="{{ route('admin.advertise.script') }}">
                                    <span class="s7__nav-caption">{{ __('Scripts') }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('admin-web-index')
                <li class="has-child">
                    <a href="#0" aria-expanded="false">
                        <span data-feather="users" class="nav-icon"></span>
                        <span class="s7__nav-caption">{{ __('Configurações Site') }}</span>
                    </a>
                    <ul class="s7__sub-nav" aria-expanded="false">
                        @can('slider-index')
                            <li>
                                <a class="sidebar-link" href="{{ route('slider.index') }}">
                                    <span class="s7__nav-caption">{{ __('Slides') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('service-index')
                            <li>
                                <a class="sidebar-link" href="{{ route('service.index') }}">
                                    <span class="s7__nav-caption">{{ __('Serviço') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('admin-about-index')
                            <li>
                                <a class="sidebar-link" href="{{ route('admin.about.index') }}">
                                    <span class="s7__nav-caption">{{ __('Sobre nós') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('testimonial-index')
                            <li>
                                <a class="sidebar-link" href="{{ route('testimonial.index') }}">
                                    <span class="s7__nav-caption">{{ __('Testemunhos') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('social-index')
                            <li>
                                <a class="sidebar-link" href="{{ route('social.index') }}">
                                    <span class="s7__nav-caption">{{ __('Social') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('faq-index')
                            <li>
                                <a class="sidebar-link" href="{{ route('faq.index') }}">
                                    <span class="s7__nav-caption">{{ __('FAQS') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('admin-contact-index')
                            <li>
                                <a class="sidebar-link" href="{{ route('admin.contact.index') }}">
                                    <span class="s7__nav-caption">{{ __('Contato') }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan


            @can('news-index')
                <li class="has-child">
                    <a href="#0" aria-expanded="false">
                        <span data-feather="users" class="nav-icon"></span>
                        <span class="s7__nav-caption">{{ __('Notícias') }}</span>
                    </a>
                    <ul class="s7__sub-nav" aria-expanded="false">
                        @can('news-category-index')
                            <li>
                                <a class="sidebar-link" href="{{ route('news-category.index') }}">
                                    <span class="s7__nav-caption">{{ __('Categorias') }}</span>
                                </a>
                            </li>
                        @endcan
                        <li>
                            <a class="sidebar-link" href="{{ route('news.index') }}">
                                <span class="s7__nav-caption">{{ __('Manutenção') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            @can('section-index')
                <li class="has-child">
                    <a href="#0" aria-expanded="false">
                        <span data-feather="users" class="nav-icon"></span>
                        <span class="s7__nav-caption">{{ __('Páginas') }}</span>
                    </a>
                    <ul class="s7__sub-nav" aria-expanded="false">
                        <li>
                            <a class="sidebar-link" href="{{ route('section.index') }}">
                                <span class="s7__nav-caption">{{ __('Seção') }}</span>
                            </a>
                        </li>
                        @can('extra-page-index')
                            <li>
                                <a class="sidebar-link" href="{{ route('extra-page.index') }}">
                                    <span class="s7__nav-caption">{{ __('Outras') }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan


            <li class="s7__menu-title">
                <span>{{ __('THEME SETTINGS') }} </span>
            </li>

            @can('general-nav-sidebar')
                <li class="has-child">
                    <a href="#0" aria-expanded="false">
                        <span data-feather="users" class="nav-icon"></span>
                        <span class="s7__nav-caption">{{ __('Configurações') }}</span>
                    </a>
                    <ul class="s7__sub-nav" aria-expanded="false">
                        @can('admin-gnl-index')
                            <li>
                                <a class="sidebar-link" href="{{ route('admin.gnl.index') }}">
                                    <span class="s7__nav-caption">{{ __('Geral') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('admin-logo-favicon-index')
                            <li>
                                <a class="sidebar-link" href="{{ route('admin.logo-favicon.index') }}">
                                    <span class="s7__nav-caption">{{ __('Logo & Favicon') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('admin-seo-global')
                            <li>
                                <a class="sidebar-link" href="{{ route('admin.seo.global') }}">
                                    <span class="s7__nav-caption">{{ __('SEO') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('extension-index')
                            <li>
                                <a class="sidebar-link" href="{{ route('extension.index') }}">
                                    <span class="s7__nav-caption">{{ __('Extenções') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('sports-api-index')
                            <li>
                                <a class="sidebar-link" href="{{ route('sports.api.index') }}">
                                    <span class="s7__nav-caption">{{ __('Sports Api') }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('email-template-index')
                <li class="has-child">
                    <a href="#0" aria-expanded="false">
                        <span data-feather="users" class="nav-icon"></span>
                        <span class="s7__nav-caption">{{ __('Configurações de Email') }}</span>
                    </a>
                    <ul class="s7__sub-nav" aria-expanded="false">
                        <li>
                            <a class="sidebar-link" href="{{ route('email-template.index') }}">
                                <span class="s7__nav-caption">{{ __('Templates') }}</span>
                            </a>
                        </li>
                        @can('admin-global-template')
                            <li>
                                <a class="sidebar-link" href="{{ route('admin.global-template') }}">
                                    <span class="s7__nav-caption">{{ __('Modelo Global') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('admin-email-controls')
                            <li>
                                <a class="sidebar-link" href="{{ route('admin.email-controls') }}">
                                    <span class="s7__nav-caption">{{ __('Controle de Email') }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('admin-custom-css')
                <li>
                    <a href="{{ route('admin.custom.css') }}" class="sidebar-link">
                        <span data-feather="layout" class="nav-icon"></span>
                        <span class="s7__nav-caption">{{ __('Custom CSS') }}</span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</aside>
