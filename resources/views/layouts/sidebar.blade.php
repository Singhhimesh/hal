<div class="leftbar">
    <!-- Start Sidebar -->
    <div class="sidebar">               
        <!-- Start Navigationbar -->
        <div class="navigationbar">
            <div class="vertical-menu-detail">
                
                <div class="tab-content" id="v-pills-tabContent">

                   <div class="tab-pane fade active show" id="v-pills-dashboard" role="tabpanel" aria-labelledby="v-pills-dashboard">

                    <ul class="vertical-menu">
                        <div class="logobar">
                            <a href="{{ url('/') }}" class="logo logo-large">
                                <img style="object-fit:scale-down;" src="{{url('images/logo/'.$logo)}}"
                                    class="img-fluid" alt="logo">
                            </a>
                        </div>
                      
                        <li class="{{ Nav::isRoute('dashboard') }}">
                            <a class="nav-link" href="{{url('/admin')}}">
                                <i class="feather icon-pie-chart text-secondary"></i>
                                <span>{{__('Dashboard')}}</span>
                            </a>
                        </li>

                        @canany(['users.view','roles.view'])
                            <li class="header">{{ __('USERS') }}</li>
                            <li class="{{ Nav::isResource('users') }}{{ Nav::isResource('roles') }}">
                                <a href="javaScript:void();" class="menu"><i class="feather icon-users text-secondary"></i>
                                    <span>{{ __('Users') }}<div class="sub-menu truncate">{{__('All Users, Roles And Permission')}}</div></span><i class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    @can('users.view')
                                    <li>
                                        <a class="{{ Nav::isResource('users') }}"
                                            href="{{url('/admin/users')}}">{{ __('All Users') }}</a>
                                    </li>
                                    @endcan
                                    @can('roles.view')
                                    <li>
                                        <a class="{{ Nav::isResource('roles') }}"
                                         href="{{route('roles.index')}}">{{ __('Roles And Permission') }}</a>
                                    </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcanany

                        @if(Module::find('Producer') && Module::find('Producer')->isEnabled())
                            @can(['producer-content.manage','packageforproducer.view','pendingrequest.view'])
                                <li class="{{ Nav::isResource('paddedmovies') }} {{ Nav::isResource('paddedTvSeries') }} {{ Nav::isResource('paddedLiveTv') }}
                                {{ Nav::isResource('packageforproducer') }} {{ Nav::isResource('pendingrequest') }}">
                                    <a href="javaScript:void();" class="menu"><i class="feather icon-users text-secondary"></i>
                                    <span>{{ __('Producer') }}<div class="sub-menu truncate">{{__('Producer Package, Producer Request, Added Movies, Added Tv Series, Added Live Tv, Payment Details, Payment Settings, Revenue Request')}}</div></span><i class="feather icon-chevron-right"></i>
                                    </a>
                                    <ul class="vertical-submenu">
                                        @can('packageforproducer.view')
                                        <li>
                                            <a class="{{ Nav::isResource('packageforproducer') }}"
                                             href="{{url('/admin/packagesforproducer')}}">{{ __('Producer Package') }}</a>
                                        </li>
                                        @endcan
                                        @if($button->producer_approval==1)
                                        @can('pendingrequest.view')
                                        <li>
                                            <a class="{{ Nav::isResource('pendingrequest') }} {{ Nav::isResource('paymentdetails') }} 
                                            {{ Nav::isResource('producerrevenue') }} "
                                            href="{{url('/admin/pendingrequest')}}">{{ __('Producer Request') }}</a>
                                        </li>
                                        @endcan
                                        @endif
                                        <li>
                                            <a class="{{ Nav::isResource('paddedmovies') }}" 
                                            href="{{route('addedmovies')}}">{{ __('Added Movies') }}</a>
                                        </li>
                                        <li>
                                            <a class="{{ Nav::isResource('paddedTvSeries') }}" 
                                            href="{{route('addedTvSeries')}}">{{ __('Added Tv Series') }}</a>
                                        </li>
                                        <li>
                                            <a class="{{ Nav::isResource('paddedLiveTv') }}" 
                                            href="{{route('addedLiveTv')}}">{{ __('Added Tv Channel') }}</a>
                                        </li>
                                        <li>
                                            <a class="{{ Nav::isResource('paymentdetails') }}" 
                                            href="{{url('/admin/payment-details')}}">{{ __('Payment Details') }}</a>
                                        </li>
                                        <li>
                                            <a class="{{ Nav::isResource('producerrevenue') }}" 
                                            href="{{url('/admin/producer-settings')}}">{{ __('Payment Settings') }}</a>
                                        </li>
                                        <li>
                                            <a class="{{ Nav::isResource('producerrevenuerequest') }}" 
                                            href="{{url('/admin/producer-revenue-request')}}">{{ __('Revenue Request') }}</a>
                                        </li>
                                    </ul>
                                </li>
                            @endcanany
                        @endif
                        @canany(['menu.view','menu.create','menu.edit','menu.delete','package.view','package-feature.view'])
                            <li class="header">{{ __('MENU & PACKAGES') }}</li>
                            <li class="{{ Nav::isResource('menu') }}">
                                <a href="{{url('/admin/menu')}}">
                                    <i class="ion ion-ios-menu"></i><span>{{ __('Menu') }}</span>
                                </a>
                            </li>
                            <li class="{{ Nav::isResource('packages') }}{{ Nav::isResource('package_feature') }}">
                                <a href="javaScript:void();" class="menu"><i class="ion ion-md-paper"></i>
                                <span>{{ __('Packages') }}<div class="sub-menu truncate">{{__('Packages, Packages Features')}}</div></span><i class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    @can('package.view')
                                    <li>
                                         <a class="{{ Nav::isResource('packages') }}"
                                            href="{{url('/admin/packages')}}">{{ __('Packages') }}</a>
                                    </li>
                                    @endcan
                                    @can('package-feature.view')
                                    <li>
                                        <a class="{{ Nav::isResource('package_feature') }}"
                                         href="{{url('/admin/package_feature')}}">{{ __('Packages Features') }}</a>
                                    </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcanany

                        @canany(['movies.view','tvseries.view','livetv.view','liveevent.view','audio.view'])
                        <li class="header">{{ __('CONTENT') }}</li>
                        @can('movies.view')
                        <li class="{{ Nav::isResource('movies') }}">
                            <a href="{{url('/admin/movies')}}">
                                <i class="fa fa-file-movie-o"></i></i><span>{{ __('Movie') }}</span>
                            </a>
                        </li>
                        @endcan
                        @can('tvseries.view')
                        <li class="{{ Nav::isResource('tvseries') }}">
                            <a href="{{url('/admin/tvseries')}}">
                                <i class="ion ion-md-tv"></i><span>{{ __('Tv Series') }}</span>
                            </a>
                        </li>
                        @endcan
                        @can('livetv.view')
                        <li class="{{ Nav::isResource('livetv') }}">
                            <a href="{{url('/admin/livetv')}}">
                                <i class="ion ion-ios-tv"></i><span>{{ __('Tv Chanel') }}</span>
                            </a>
                        </li>
                        @endcan
                        @can('audio.view')
                        <li class="{{ Nav::isResource('audio') }}">
                            <a href="{{url('/admin/audio')}}">
                                <i class="fa fa-music"></i><span>{{ __('Audio') }}</span>
                            </a>
                        </li>
                        @endcan
                        @if(Auth::user()->is_assistant != 1)
                        @can('liveevent.view')
                        <li class="{{ Nav::isResource('liveevent') }}">
                            <a href="{{url('/admin/liveevent')}}">
                                <i class="ion ion-md-calendar"></i><span>{{ __('Live Event') }}</span>
                            </a>
                        </li>
                        @endcan
                        @if(Module::find('Ebook') && Module::find('Ebook')->isEnabled())
                        <li class="{{ Nav::isRoute('ebook') }}">
                            <a href="{{route('ebook')}}">
                                <i class="fa fa-book"></i><span>{{ __('Ebook') }}</span>
                            </a>
                        </li>
                        @endif
                        @endif
                        <li class="{{ Nav::isResource('moviesreq') }}">
                            <a href="{{url('/admin/movies-req')}}">
                                <i class="fa fa-file-movie-o"></i></i><span>{{ __('Requested Movies') }}</span>
                            </a>
                        </li>
                        @if(Auth::user()->is_assistant != 1)
                        @php
                        $config = App\Config::first();
                        @endphp
                        @can('blog.view')
                        <li class="{{ Nav::isRoute('blog') }}">
                            <a class="nav-link" href="{{route('blog.index')}}">
                                <i class="ion ion-ios-list-box"></i>
                                <span>{{__('Blog')}}</span>
                            </a>
                        </li>
                        @endif
                        @endcan
                        @endcanany
                        @canany(['genre.view','actor.view','director.view','audiolanguage.view','label.view'])
                            <li class="{{ Nav::isResource('genres') }}{{ Nav::isResource('directors') }} {{ Nav::isResource('actors') }}{{ Nav::isResource('audio_language') }} {{ Nav::isResource('label') }}">
                                <a href="javaScript:void();" class="menu"><i class="ion ion-ios-options"></i>
                                    <span>{{ __('Content') }}<div class="sub-menu truncate">{{__('Genres, Directors, Actors, Audio Language, Label')}}</div></span><i class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    @can('genre.view')
                                    <li>
                                         <a class="{{ Nav::isResource('genres') }}"
                                            href="{{url('/admin/genres')}}">{{ __('Genres') }}</a>
                                    </li>
                                    @endcan
                                    @can('actor.view')
                                    <li>
                                         <a class="{{ Nav::isResource('directors') }}"
                                            href="{{url('/admin/directors')}}">{{ __('Directors') }}</a>
                                    </li>
                                    @endcan
                                    @can('director.view')
                                    <li>
                                         <a class="{{ Nav::isResource('actors') }}"
                                            href="{{url('/admin/actors')}}">{{ __('Actors') }}</a>
                                    </li>
                                    @endcan
                                    @can('audiolanguage.view')
                                    <li>
                                         <a class="{{ Nav::isResource('audio_language') }}"
                                            href="{{url('/admin/audio_language')}}">{{ __('Audio Language') }}</a>
                                    </li>
                                    @endcan
                                    @can('label.view')
                                    <li>
                                         <a class="{{ Nav::isResource('label') }}"
                                            href="{{url('/admin/label')}}">{{ __('Label') }}</a>
                                    </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcanany
                        

                       

                       
                        
                        @canany(['coupon.view','notification.manage','affiliate.settings','pushnotification.settings','affiliate.history','comment-settings.comments','comment-settings.subcomments','fake.views'])
                            <li class="header">{{ __('MARKETING & FINANCE') }}</li>
                            <li class="{{ Nav::isResource('coupons') }} {{ Nav::isResource('notification') }} {{ Nav::isRoute('admin.affilate.settings') }} 
                            {{ Nav::isRoute('admin.affilate.dashboard') }} {{ Nav::isRoute('admin.comment.index') }} {{ Nav::isRoute('admin.subcomment.index') }} 
                            {{ Nav::isResource('fakeViews') }}">
                                <a href="javaScript:void();" class="menu"><i class="socicon-itchio"></i>
                                    <span>{{ __('Marketing') }}<div class="sub-menu truncate">{{__('Coupons, Notification, Affiliate Settings, Affiliate Reports, Comments, Sub Comments, Fake Views')}}</div></span><i class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    @can('coupon.view')
                                    <li>
                                        <a class="{{ Nav::isResource('coupons') }}"
                                            href="{{url('/admin/coupons')}}">{{ __('Coupons') }}</a>
                                    </li>
                                    @endcan
                                    @can('notification.manage')
                                    <li>
                                        <a class="{{ Nav::isResource('notification') }}"
                                         href="{{route('notification.create')}}">{{ __('Notification') }}</a>
                                    </li>
                                    @endcan
                                    @can('affiliate.settings')
                                    <li>
                                        <a class="{{ Nav::isResource('admin.affilate.settings') }}"
                                            href="{{route('admin.affilate.settings')}}">{{ __('Affiliate Settings') }}</a>
                                    </li>
                                    @endcan
                                    @can('affiliate.history')
                                    <li>
                                        <a class="{{ Nav::isResource('admin.affilate.dashboard') }}"
                                         href="{{route('admin.affilate.dashboard')}}">{{ __('Affiliate Reports') }}</a>
                                    </li>
                                    @endcan
                                    @can('comment-settings.comments')
                                    <li>
                                        <a class="{{ Nav::isResource('admin.comment.index') }}"
                                            href="{{url('/admin/comments')}}">{{ __('Comments') }}</a>
                                    </li>
                                    @endcan
                                    @can('comment-settings.subcomments')
                                    <li>
                                        <a class="{{ Nav::isResource('admin.subcomment.index') }}"
                                         href="{{url('/admin/subcomments')}}">{{ __('Sub Comments') }}</a>
                                    </li>
                                    @endcan
                                    @can('fake.views')
                                    <li>
                                        <a class="{{ Nav::isResource('fakeViews') }}"
                                            href="{{url('/admin/fakeViews')}}">{{ __('Fake Views') }}</a>
                                    </li>
                                    @endcan
                                    
                                    @can('pushnotification.settings')
                                    <li>
                                        <a class="{{ Nav::isRoute('admin.push.noti.settings') }}" 
                                        href="{{route('admin.push.noti.settings')}}">{{ __('Push Notification') }}</a>
                                    </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcanany
                        @canany('reports.device-history','reports.revenue','reports.user-subscription','reports.viewtraker','reports.stripe-report')
                            
                            <li class="{{ Nav::isRoute('device_history') }} {{ Nav::hasSegment('report') }} 
                            {{ Nav::isRoute('revenue.report')}} {{ Nav::isRoute('view.track') }}">
                                <a href="javaScript:void();"><i class="socicon-itchio"></i>
                                    <span>{{ __('Reports') }}<div class="sub-menu truncate">{{__('User Subscription, Stripe Reports, Stripe Reports, Revenue Reports, Revenue Reports')}}</div></span><i class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    @if(Auth::user()->is_assistant != 1 && App\PaypalSubscription::count()>0)
                                    @can('reports.user-subscription')
                                    <li>
                                        <a class="{{ Nav::isResource('plan') }}" 
                                        href="{{url('/admin/plan')}}">{{ __('User Subscription') }}</a>
                                    </li>
                                    @endcan
                                    @endif
                                    @if(env('STRIPE_SECRET') != "")
                                    @can('reports.stripe-report')
                                    <li>
                                        <a class="{{ Nav::hasSegment('report') }}" 
                                        href="{{url('admin/report')}}">{{ __('Stripe Reports') }}</a>
                                    </li>
                                    @endcan
                                    @endif
                                    @can('reports.device-history')
                                    <li>
                                        <a class="{{ Nav::isRoute('device_history') }}"
                                         href="{{ route('device_history') }}">{{ __('Device History') }}</a>
                                    </li>
                                    @endcan
                                    @can('reports.revenue')
                                    <li>
                                        <a class="{{ Nav::isRoute('revenue.report')}}"
                                        href="{{url('admin/report_revenue')}}">{{ __('Revenue Reports') }}</a>
                                    </li>
                                    @endcan
                                    @can('reports.viewtraker')
                                    <li>
                                        <a class="{{ Nav::isRoute('view.track') }}" 
                                        href="{{ route('view.track') }}">{{ __('View Tracker') }}</a>
                                    </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcanany
                        @canany(['wallet.settings','wallet.history'])
                        <li class="{{ Nav::isRoute('admin.wallet.settings') }}">
                            <a class="nav-link" href="{{ route('admin.wallet.settings') }}">
                                <i class="ion ion-md-wallet"></i>
                                <span>{{__('Wallet')}}</span>
                            </a>
                        </li>
                        @endcanany

                       

                        @canany(['front-settings.sliders','front-settings.sliders','front-settings.auth-customization','pages.view','front-settings.short-promo',
                        'front-settings.social-icon','faq.view','site-settings.style-settings','site-settings.copyrights','site-settings.termsandcondition','site-settings.privacy-policy',
                        'site-settings.refund-policy','site-settings.pwa','site-settings.color-option',])
                            <li class="header">{{ __('SETTING') }}</li>
                            <li class="{{ Nav::isResource('home_slider') }} {{ Nav::isResource('landing-page') }} 
                            {{ Nav::isResource('auth-page-customize') }} {{ Nav::isRoute('social.ico') }} 
                            {{ Nav::isResource('home-block') }} {{ Nav::isResource('custom_page') }} {{ Nav::isResource('faqs') }}
                            {{ Nav::isRoute('admin.color.scheme') }} {{ Nav::isRoute('pwa.setting.index') }} {{ Nav::isRoute('term_con') }}
                            {{ Nav::isRoute('pri_pol') }} {{ Nav::isRoute('refund_pol') }} {{ Nav::isRoute('copyright') }} ">
                                <a href="javaScript:void();"><i class="fa fa-sliders"></i>
                                    <span>{{ __('Site-Customization') }}<div class="sub-menu truncate">{{__('Slider Settings, Landing Page, Custom Pages, Sign In Sign Up, Social Url Setting, Promotion Settings, Faq')}}</div></span><i class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    @can('front-settings.sliders')
                                    <li>
                                        <a class="{{ Nav::isResource('landing-page') }}"
                                         href="{{url('admin/customize/landing-page')}}">{{ __('Landing Page') }}</a>
                                    </li>
                                    @endcan
                                    @can('pages.view')
                                    <li>
                                        <a class="{{ Nav::isResource('custom_page') }}"
                                         href="{{url('/admin/custom_page')}}">{{ __('Custom Pages') }}</a>
                                    </li>
                                    @endcan
                                    @can('front-settings.auth-customization')
                                    <li>
                                        <a class="{{ Nav::isResource('auth-page-customize') }}"
                                            href="{{url('admin/customize/auth-page-customize')}}">{{ __('Sign In Sign Up') }}</a>
                                    </li>
                                    @endcan
                                    @can('front-settings.social-icon')
                                    <li>
                                        <a class="{{ Nav::isResource('social.ico') }}"
                                         href="{{route('social.ico')}}">{{ __('Social Url Setting') }}</a>
                                    </li>
                                    @endcan
                                    @can('front-settings.sliders')
                                    <li>
                                        <a class="{{ Nav::isResource('home_slider') }}"
                                            href="{{url('/admin/home_slider')}}">{{ __('Slider Settings') }}</a>
                                    </li>
                                    @endcan
                                    @can('faq.view')
                                    <li>
                                        <a class="{{ Nav::isResource('faqs') }}"
                                            href="{{url('/admin/faqs')}}">{{ __('Faq') }}</a>
                                    </li>
                                    @endcan
                                    @can('front-settings.short-promo')
                                    <li>
                                        <a class="{{ Nav::isResource('home-block') }}"
                                            href="{{url('/admin/home-block')}}">{{ __('Promotion Settings') }}</a>
                                    </li>
                                    @endcan
                                    @can('site-settings.color-option')
                                    <li>
                                        <a class="{{ Nav::isRoute('admin.color.scheme') }}" 
                                        href="{{route('admin.color.scheme')}}">{{ __('Color Option') }}</a>
                                    </li>
                                    @endcan
                                    @can('site-settings.pwa')
                                    <li>
                                        <a class="{{ Nav::isRoute('pwa.setting.index') }}" 
                                        href="{{route('pwa.setting.index')}}">{{ __('PWA Settings') }}</a>
                                    </li>
                                    @endcan
                                    @can('site-settings.termsandcondition')
                                    <li>
                                        <a class="{{ Nav::isRoute('term_con') }}" 
                                        href="{{url('admin/term&con')}}">{{ __('Terms Condition') }}</a>
                                    </li>
                                    @endcan
                                    @can('site-settings.privacy-policy')
                                    <li>
                                        <a class="{{ Nav::isRoute('pri_pol') }}" 
                                        href="{{url('admin/pri_pol')}}">{{ __('Privacy Policy') }}</a>
                                    </li>
                                    @endcan
                                    @can('site-settings.refund-policy')
                                    <li>
                                        <a class="{{ Nav::isRoute('refund_pol') }}" 
                                        href="{{url('admin/refund_pol')}}">{{ __('Refund Policy') }}</a>
                                    </li>
                                    @endcan
                                    @can('site-settings.style-settings')
                                    <li>
                                        <a class="{{ Nav::isRoute('customstyles') }}" 
                                        href="{{url('admin/custom-style-settings')}}">{{ __('Custom CSS & JS') }}</a>
                                    </li>
                                    @endcan
                                    @can('site-settings.copyrights')
                                    <li>
                                        <a class="{{ Nav::isRoute('copyright') }}" 
                                        href="{{url('admin/copyright')}}">{{ __('Copyright') }}</a>
                                    </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcanany
                        @canany(['site-settings.genral-settings','site-settings.seo','site-settings.api-settings',
                        'site-settings.social-login-settings','site-settings.chat-setting',
                        
                        'site-settings.player-setting','ads.view','googleads.view',
                        'site-settings.adsense',
                        'site-settings.language'])
                            <li class="{{ Nav::isResource('settings') }} {{ Nav::isResource('seo') }} {{ Nav::isResource('mail') }} {{Nav::isRoute('chat.index')}} 
                            {{ Nav::isRoute('sociallogin') }}
                             {{ Nav::isRoute('adsense') }} {{ Nav::isRoute('player.set') }} {{ Nav::isRoute('ads') }}  
                            {{ Nav::hasSegment('blocker') }} {{ Nav::isResource('languages') }} {{ Nav::isRoute('google.ads') }} ">
                                <a href="javaScript:void();"><i class="ion ion-ios-settings"></i>
                                    <span>{{ __('Site-Setting') }}<div class="sub-menu truncate">{{__('General Settings, Seo Settings, API Settings, Mail Settings, Social Login Settings, Chat Settings, PWA Settings,  Adsense Settings, Terms Condition, Privacy Policy, Languages, Static Words, Currency')}}</div></span><i class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    @can('site-settings.genral-settings')
                                    <li>
                                        <a class="{{ Nav::isRoute('settings') }}" 
                                        href="{{url('admin/settings')}}">{{ __('General Settings') }}</a>
                                    </li>
                                    @endcan
                                    @can('site-settings.seo')
                                    <li>
                                        <a class="{{ Nav::isResource('seo') }}" 
                                        href="{{url('/admin/seo')}}">{{ __('Seo Settings') }}</a>
                                    </li>
                                    @endcan
                                    @can('site-settings.api-settings')
                                    <li>
                                        <a class="{{ Nav::isResource('mail') }}" 
                                        href="{{route('mail.getset')}}">{{ __('Mail Settings') }}</a>
                                    </li>
                                    @endcan
                                    @can('site-settings.social-login-settings')
                                    <li>
                                        <a class="{{ Nav::isRoute('sociallogin') }}" 
                                        href="{{url('/admin/social-login')}}">{{ __('Social Login Settings') }}</a>
                                    </li>
                                    @endcan
                                    @can('site-settings.chat-setting')
                                    <li>
                                        <a class="{{ Nav::isRoute('chat.index') }}" 
                                        href="{{route('chat.index')}}">{{ __('Chat Settings') }}</a>
                                    </li>
                                    @endcan
                                   
                                    @can('site-settings.adsense')
                                    <li>
                                        <a class="{{ Nav::isRoute('adsense') }}" 
                                        href="{{url('/admin/adsensesetting')}}">{{ __('Adsense Settings') }}</a>
                                    </li>
                                    @endcan
                                    
                                   
                                    @can('site-settings.language')
                                    <li>
                                        <a class="{{ Nav::isResource('languages') }}" 
                                        href="{{url('/admin/languages')}}">{{ __('Languages') }}</a>
                                    </li>
                                    @endcan
                                    {{-- @can('site-settings.language')
                                    <li>
                                        <a class="{{ Nav::isResource('StaticWords') }}" 
                                        href="{{url('/admin/custom-static-words')}}">{{ __('Static Words') }}</a>
                                    </li>
                                    @endcan --}}
                                    @can('site-settings.currency')
                                    <li>
                                        <a class="{{ Nav::isResource('currency') }}" 
                                        href="{{route('currency.index')}}">{{ __('Currency') }}</a>
                                    </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcanany

                        @canany(['site-settings.player-settings','ads.view','googlead.view'])
                            <li class="{{ Nav::isRoute('player.set') }} {{ Nav::isRoute('ads') }} {{ Nav::isRoute('google.ads') }}">
                                <a href="javaScript:void();"><i class="socicon-play"></i>
                                    <span>{{ __('Player Setting') }}<div class="sub-menu truncate">{{__('Player Customization, Advertise, Google Advertise')}}</div></span><i class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    @can('site-settings.player-setting')
                                    <li>
                                         <a class="{{ Nav::isRoute('player.set') }}" 
                                         href="{{route('player.set')}}">{{ __('Player Customization') }}</a>
                                    </li>
                                    @endcan
                                    
                                    @can('googleads.view')
                                    <li>
                                         <a class="{{ Nav::isRoute('google.ads') }}" 
                                         href="{{route('google.ads')}}">{{ __('Google Advertise') }}</a>
                                    </li>
                                    @endcan

                                    @if(Module::find('Advertise') && Module::find('Advertise')->isEnabled())
                                    @can('ads.view')
                                    <li>
                                         <a class="{{ Nav::isRoute('ads') }}" 
                                         href="{{url('admin/ads')}}">{{ __('Advertise') }}</a>
                                    </li>
                                    @endcan
                                    @endif

                                </ul>
                            </li>
                        @endcanany

                        @canany(['site-settings.manualpayment','manual-payment.view'])
                            <li class="{{ Nav::isResource('pgs') }} {{ Nav::isResource('manual.payment.gateway') }} {{ Nav::isResource('manual-payment') }}">
                                <a href="javaScript:void();"><i class="ion ion-md-wallet"></i>
                                    <span>{{ __('Payment Gateway') }}<div class="sub-menu truncate">{{__('Payment Gateway Settings, Manual Payment Gateway, Payment Transections')}}</div></span><i class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    @can('app-settings.setting')
                                    <li>
                                         <a class="{{ Nav::isResource('appsettpgsings') }}" 
                                         href="{{url('admin/paymentgatwaysettings')}}">{{ __('Payment Gateway Settings') }}</a>
                                    </li>
                                    @endcan
                                    @can('manual-payment.view')
                                    <li>
                                        <a class="{{ Nav::isResource('manual.payment.gateway') }}" 
                                        href="{{route('manual.payment.gateway')}}">{{ __('Manual Payment Gateway') }}</a>
                                    </li>
                                    @endcan
                                    @can('site-settings.manualpayment')
                                    <li>
                                        <a class="{{ Nav::isResource('manual-payment') }}" 
                                        href="{{url('/admin/manual-payment')}}">{{ __('Payment Transections') }}</a>
                                    </li>
                                    @endcan
                                </ul>
                            </li>
                           
                        @endcanany

                        @canany(['app-settings.setting','app-settings.slider'])
                            <li class="{{ Nav::isResource('appsettings') }} {{ Nav::isResource('api') }} {{ Nav::isRoute('admob') }} {{ Nav::isResource('appslider') }} {{ Nav::isResource('upi') }}">
                                <a href="javaScript:void();"><i class="ion ion-ios-settings"></i>
                                    <span>{{ __('App Settings') }}<div class="sub-menu truncate">{{__('Settings, App Slider Settings')}}</div></span><i class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    @can('app-settings.setting')
                                    <li>
                                         <a class="{{ Nav::isResource('appsettings') }}" 
                                         href="{{url('admin/appsettings')}}">{{ __('Settings') }}</a>
                                    </li>
                                    @endcan
                                    @can('site-settings.api-settings')
                                    <li>
                                        <a class="{{ Nav::isResource('api') }}" 
                                        href="{{url('admin/api-settings')}}">{{ __('API Settings') }}</a>
                                    </li>
                                    @endcan
                                    @can('app-settings.slider')
                                    <li>
                                         <a class="{{ Nav::isResource('appslider') }}" 
                                         href="{{url('admin/appslider')}}">{{ __('App Slider Settings') }}</a>
                                    </li>
                                    @endcan
                                    @if(Module::find('Upi') && Module::find('Upi')->isEnabled())
                                    <li>
                                        <a class="{{ Nav::isResource('upi') }}" href="{{route('upi')}}">
                                            {{ __('UPI') }}
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </li>
                           
                        @endcanany

                        @canany(['media-manager.manage'])
                        <li class="{{ Nav::isRoute('media.manager') }}">
                            <a class="nav-link" href="{{ route('media.manager') }}">
                                <i class="ion ion-ios-images"></i>
                                <span>{{__('Media Manager')}}</span>
                            </a>
                        </li>
                        @endcanany

                       

                        
                        <li class="header">{{ __('SUPPORT') }}</li>
                        
                        {{-- Producer links start --}}
                        @can('producerurl.view')
                        <li class="{{ Nav::isResource('ProducerUrl') }}">
                            <a href="{{url('/producer/url')}}">
                                <i class="ion ion-md-link"></i><span>{{ __('Profile') }}</span>
                            </a>
                        </li>
                        @endcan 

                        @canany(['producer-payment.setting'])
                        <li class="{{ Nav::isResource('producer-payment') }} {{ Nav::isRoute('view.track') }} 
                        {{ Nav::isRoute('producer.revenue') }}">
                            <a href="javaScript:void();"><i class="ion ion-ios-settings"></i>
                                <span>{{ __('Producer Settings') }}<div class="sub-menu truncate">{{__('Payment Settings, View Tracker, Producer Revenue')}}</div></span><i class="feather icon-chevron-right"></i>
                            </a>
                            <ul class="vertical-submenu">
                                <li>
                                    <a class="{{ Nav::isResource('producer-payment') }}" href="{{url('/producer/payment-settings')}}">{{ __('Payment Settings') }}</a>
                                </li>
                                <li>
                                    <a class="{{ Nav::isRoute('view.track') }}" href="{{ route('view.track') }}">{{ __('View Tracker') }}</a>
                                </li>
                                <li>
                                    <a class="{{ Nav::isRoute('producer.revenue') }}" href="{{ url('producer/revenue') }}">{{ __('Producer Revenue') }}</a>
                                </li>
                            </ul>
                        </li>
                    @endcanany
                        {{-- Producer links end --}}


                        @canany(['help.import-demo','help.db-backup','help.system-status','help.remove-public','help.clear-cache'])
                            <li class="{{ Nav::isRoute('admin.import.demo') }} {{ Nav::isRoute('addonmanger.index') }} {{ Nav::isRoute('admin.backup.settings') }} 
                            {{ Nav::isRoute('system.status') }} {{ Nav::isRoute('clear_cache') }} {{ Nav::isRoute('get.remove.public') }}">
                                <a href="javaScript:void();"><i class="ion ion-ios-settings"></i>
                                    <span>{{ __('Help And Support') }}<div class="sub-menu truncate">{{__('Database Backup, Import Demo,Add-On, System Status, Remove Public, Clear Cache')}}</div></span><i class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                
                                @can('help.db-backup')
                                    <li>
                                        <a class="{{ Nav::isRoute('admin.backup.settings') }}"
                                         href="{{route('admin.backup.settings')}}">{{ __('Database Backup') }}</a>
                                    </li>
                                    @endcan
                                    @can('help.import-demo')
                                    <li>
                                        <a class="{{ Nav::isRoute('admin.import.demo') }}" 
                                        href="{{route('admin.import.demo')}}">{{ __('Import Demo') }}</a>
                                    </li>
                                    @endcan

                                    @can('addon-manager.manage')
                                <li>
                                    <a class="{{ Nav::isRoute('addonmanger.index') }}" 
                                     href="{{route('addonmanger.index')}}">
                                        <span>{{__('Add-On')}}</span>
                                    </a>
                                    </li>
                                @endcan
                                   
                                    
                                    @can('help.remove-public')
                                    <li>
                                        <a class="{{ Nav::isRoute('get.remove.public') }}" 
                                        href="{{route('get.remove.public')}}">{{ __('Remove Public') }}</a>
                                    </li>
                                    @endcan
                                    @can('help.clear-cache')
                                    <li>
                                        <a class="{{ Nav::isRoute('clear_cache') }}" 
                                        href="{{route('clear.cache')}}">{{ __('Clear Cache') }}</a>
                                    </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcanany

                        </ul> 
                    </div>
                    

                </div>
                
            </div>
        </div>
        <!-- End Navigationbar -->
    </div>
    <!-- End Sidebar -->
</div>