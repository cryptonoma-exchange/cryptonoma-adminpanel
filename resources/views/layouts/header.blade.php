<?php
if (isset($atitle)) {
    switch ($atitle) {
        case 'dashboard':
            $active = 'dashboard';
            break;
         case 'plans':
            $active = 'plans';
            break;  
        case 'time-settings':
            $active = 'time-settings';
            break; 
        case 'stages':
            $active = 'stages';
            break;   
        case 'referral-setting':
            $active = 'referral-setting';
            break;      
        case 'users':
            $active = 'users';
            break;
        case 'tradepair':
            $active = 'tradepair';
            break;
        case 'crypto':
            $active = 'crypto';
            break;
        case 'credit':
            $active = 'credit';
            break;
        case 'commission':
            $active = 'commission';
            break;
        case 'buytrade':
            $active = 'buytrade';
            break;
        case 'selltrade':
            $active = 'selltrade';
            break;
        case 'pendingorder':
            $active = 'pendingorder';
            break;
        case 'deposit':
            $active = 'deposit';
            break;
        case 'withdraw':
            $active = 'withdraw';
            break;
        case 'adminwallet':
            $active = 'adminwallet';
            break;
        case 'liquidity':
            $active = 'liquidity';
            break;
        case 'kyc':
            $active = 'kyc';
            break;
        case 'kycview':
            $active = 'kycview';
            break;
        case 'incomeview':
            $active = 'incomeview';
            break;
        case 'professview':
            $active = 'professview';
            break;
        case 'adminbank':
            $active = 'adminbank';
            break;
        case 'mpesa':
            $active = 'mpesa';
            break;
        case 'kycsetting':
            $active = 'kycsetting';
            break;
        case 'contact':
            $active = 'contact';
            break;
        case 'subscriber':
            $active = 'subscriber';
            break;
        case 'support':
            $active = 'support';
            break;
        case 'listing':
            $active = 'listing';
            break;
        case 'referral':
            $active = 'referral';
            break;
        case 'cms':
            $active = 'cms';
            break;
        case 'homepage':
            $active = 'homepage';
            break;
        case 'liveprice':
            $active = 'liveprice';
            break;
        case 'tc':
            $active = 'tc';
            break;
        case 'privacy':
            $active = 'privacy';
            break;
        case 'faq':
            $active = 'faq';
            break;
        case 'faq_add':
            $active = 'faq_add';
            break;
        case 'faq_edit':
            $active = 'faq_edit';
            break;
        case 'aboutus':
            $active = 'aboutus';
            break;
        case 'mpsadesc':
            $active = 'mpsadesc';
            break;
        case 'bittrex':
            $active = 'bittrex';
            break;
        case 'socialmedia':
            $active = 'socialmedia';
            break;
        case 'termsservices':
            $active = 'termsservices';
            break;
        case 'settings':
            $active = 'settings';
            break;
        case 'logout':
            $active = 'logout';
            break;
        case 'category':
            $active = 'category';
            break;
        case 'subcategory':
            $active = 'subcategory';
            break;
        case 'feewallet':
            $active = 'feewallet';
            break;
        case 'coldwalletaddress':
            $active = 'coldwalletaddress';
            break;
        case 'feewalletaddress';
            $active = 'feewalletaddress';
            break;
        default:
            $active = 'dashboard';
            break;
    }
} else {
    $active = '';
}
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard | {{ config('app.name') }} </title>
    <link rel="icon" href="{{ url('images/favicon.png') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendor styles -->
    <link rel="stylesheet" href="{{ url('adminpanel/dist/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{ url('adminpanel/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ url('adminpanel/js/jquery.scrollbar/jquery.scrollbar.css') }}">
    <link rel="stylesheet" href="{{ url('adminpanel/css/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ url('adminpanel/css/flatpickr.min.css') }}" />
    <link rel="stylesheet" href="{{ url('adminpanel/font-awesome/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ url('adminpanel/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ url('adminpanel/css/pagination.css') }}">
    <!--<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>-->
    @stack('customscripts')
</head>
<body data-sa-theme="7">
    <main class="main">
        <header class="header">
            <div class="navigation-trigger hidden-xl-up" data-sa-action="aside-open" data-sa-target=".sidebar">
                <i class="zmdi zmdi-menu"></i>
            </div>
            <div class="logo hidden-sm-down">
                <h1><a href="#">
                        <img src="{{ url('/images/logo.svg') }}" class="logo-text-1" />
                    </a></h1>
            </div>
            <ul class="top-nav">
                <li class="hidden-xl-up"><a href="#" data-sa-action="search-open"><i class="zmdi zmdi-search"></i></a>
                </li>
                <li class="dropdown top-nav__notifications">
                    <a href="#" data-toggle="dropdown" class="top-nav__notify">
                        <i class="zmdi zmdi-notifications"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu--block">
                </li>
            </ul>
            <div class="clock hidden-md-down">
                <div class="time">
                    <span class="hours"></span>
                    <span class="min"></span>
                    <span class="sec"></span>
                </div>
            </div>
        </header>
        <aside class="sidebar">
            <div class="scrollbar-inner">
                <div class="user">
                    <div class="user__info" data-toggle="dropdown">
                        <div>
                            <div class="user__name">Admin</div>
                            <div class="user__email">{{ $Admindetails['email'] }}</div>
                        </div>
                    </div>
                </div>
                <ul class="navigation">
                    <li class="@@photogalleryactive"><a @if ($active=='dashboard' ) class="active" @endif href="{{ url('admin/dashboard') }}"><i class="zmdi zmdi-view-dashboard"></i>Dashboard</a>
                    </li>
                    @if (in_array('read', explode(',', $AdminProfiledetails->userlist)))
                    <li class="@@photogalleryactive"><a @if ($active=='users' ) class="active" @endif href="{{ url('admin/users') }}"><i class="zmdi zmdi-accounts-alt"></i> Users</a></li>
                    @endif
                    @if((in_array("read", explode(',',$AdminProfiledetails->tokensetting))) || (in_array("read",
                    explode(',',$AdminProfiledetails->tradepair))) || (in_array("read",
                    explode(',',$AdminProfiledetails->commissionsetting))) || (in_array("read",
                    explode(',',$AdminProfiledetails->liquiditysettings))))
                    <li class="navigation__sub navigation__sub--toggled"><a href="#"><i class="zmdi zmdi-edit"></i>Coin
                            Settings</a>
                        <ul @if ($active=='tradepair' || $active=='commission' ) style="display: block;" @else style="display: none;" @endif>
                            <li class="@@colorsactive"><a @if ($active=='tradepair' ) class="active" @endif href="{{ url('admin/tradepairlist') }}">Trade Pairs </a></li>
                            <li class="@@colorsactive"><a @if ($active=='commission' ) class="active" @endif href="{{ url('admin/commission') }}">Commission Settings </a></li>
                            <li class="@@colorsactive"><a @if ($active=='tokenlist' ) class="active" @endif href="{{ url('admin/tokenlist') }}">Tokens</a></li>
                        </ul>
                    </li>
                    @endif
                    @if (in_array('read', explode(',', $AdminProfiledetails->support)))
                    <li class="@@photogalleryactive"><a @if ($active=='support' ) class="active" @endif href="{{ url('/admin/support') }}"><i class="zmdi zmdi-ticket-star"></i> Support
                            ({{ ticketcount() }})<span class="pull-right"> </span></a></li>
                    @endif

                     @if (in_array('read', explode(',', $AdminProfiledetails->support)))
                    <li class="@@photogalleryactive"><a @if ($active=='time-settings' ) class="active" @endif href="{{ url('/admin/time-settings') }}"><i class="zmdi zmdi-time"></i> Time Settings
                    </a></li>
                    @endif

                     @if (in_array('read', explode(',', $AdminProfiledetails->support)))
                    <li class="@@photogalleryactive"><a @if ($active=='plans' ) class="active" @endif href="{{ url('/admin/plans') }}"><i class="zmdi zmdi-input-composite"></i> Manage Plans
                    </a></li>
                    @endif

                    @if (in_array('read', explode(',', $AdminProfiledetails->support)))
                    <li class="@@photogalleryactive"><a @if ($active=='referral-setting' ) class="active" @endif href="{{ url('/admin/referral-setting') }}"><i class="zmdi zmdi-device-hub"></i> Referral Levels
                    </a></li>
                    @endif


                    @if (in_array('read', explode(',', $AdminProfiledetails->support)))
                    <li class="@@photogalleryactive"><a @if ($active=='stages' ) class="active" @endif href="{{ url('/admin/stages') }}"><i class="zmdi zmdi-device-hub"></i> ICO /STO Stage
                    </a></li>
                    @endif

                    @if (in_array('read', explode(',', $AdminProfiledetails->tradehistroylist)))
                    <li class="navigation__sub navigation__sub--toggled"><a @if ($active=='trades' ) class="active" @endif href="#"><i class="zmdi zmdi-time-restore"></i> Trade History</a>
                        <ul @if ($active=='buytrade' || $active=='selltrade' || $active=='pendingorder' ) style="display: block;" @else style="display: none;" @endif>

                            <li class="@@colorsactive"><a @if ($active=='buytrade' ) class="active" @endif href="{{ url('admin/buy_tradehistory/' . first_pair() . '/limit') }}">Buy
                                    Trade</a></li>
                            <li class="@@colorsactive"><a @if ($active=='selltrade' ) class="active" @endif href="{{ url('admin/sell_tradehistory/' . first_pair() . '/limit') }}">Sell
                                    Trade
                                </a></li>
                            <li class="@@colorsactive"><a @if ($active=='pendingorder' ) class="active" @endif href="{{ url('admin/pending_tradehistory/all') }}">Pending Orders </a></li>
                        </ul>
                    </li>
                    @endif
                    @if (in_array('read', explode(',', $AdminProfiledetails->depositlist)))
                    <li class="navigation__sub navigation__sub--toggled"><a href="#"><i class="fa fa-money" aria-hidden="true"></i>User Deposit History</a>
                        <ul @if ($active=='deposit' ) style="display: block;" @else style="display: none;" @endif>
                            @forelse(list_coin() as $coins)
                            @if (isset($coin))
                            @php $selectedcoin = $coin; @endphp
                            @else
                            @php $selectedcoin = 'BTC'; @endphp
                            @endif
                            <li class="@@colorsactive"><a @if ($selectedcoin==$coins->source) class="active" @endif
                                    href="{{ url('admin/deposits/' . $coins->source) }}">{{ $coins->source }}</a>
                            </li>
                            @empty
                            <li class="@@colorsactive"><a href="#">No Coins list</a></li>
                            @endforelse
                        </ul>
                    </li>
                    @endif
                    @if (in_array('read', explode(',', $AdminProfiledetails->withdrawlist)))
                    <li class="navigation__sub navigation__sub--toggled"><a href="#"><i class="fa fa-arrows" aria-hidden="true"></i>User Withdraw History</a>
                        <ul @if ($active=='withdraw' ) style="display: block;" @else style="display: none;" @endif>
                            @forelse(list_coin() as $coinss)
                            @php
                            $c = \Request::segment(3); @endphp
                            @if (isset($c))
                            @php $selectedcoin = $c; @endphp
                            @else
                            @php $selectedcoin = 'BTC'; @endphp
                            @endif
                            <li class="@@colorsactive"><a @if ($selectedcoin==$coinss->source) class="active" @endif
                                    href="{{ url('admin/withdraw/' . $coinss->source) }}">{{ $coinss->source }}</a>
                            </li>
                            @empty
                            <li class="@@colorsactive"><a @if ($active=='withdraw' ) class="active" @endif href="#">No Coins list</a>
                            </li>
                            @endforelse
                        </ul>
                    </li>
                    @endif
                    <li class="@@photogalleryactive"><a @if ($active == 'adminwallet') class="active" @endif href="{{ url('admin/adminwallet') }}"><i class="zmdi zmdi-balance-wallet"></i>Admin Wallet</a></li>
                    <!-- @if (in_array('read', explode(',', $AdminProfiledetails->feewallet)))
                 <li class="@@photogalleryactive"><a @if ($active == 'feewallet') class="active" @endif href="{{ url('admin/feewallet') }}"><i class="zmdi zmdi-balance-wallet"></i>Admin Fee Wallet</a></li>
                 @endif -->
                    @if (in_array('read', explode(',', $AdminProfiledetails->kyc)))
                    <li class="navigation__sub navigation__sub--toggled"><a @if ($active=='kyc' ) class="active" @endif href="#"><i class="zmdi zmdi-assignment-o"></i> KYC</a>
                        <ul @if ($active=='kycview' ) style="display: block;" @else style="display: none;" @endif>
                            <li class="@@colorsactive"><a @if ($active=='kycview' ) class="active" @endif href="{{ url('admin/kyc') }}">KYC submit</a></li>
                        </ul>
                    </li>
                    @endif

                    @if (in_array('read', explode(',', $AdminProfiledetails->security_setup)))
                <li class="@@photogalleryactive"><a @if ($active=='settings' ) class="active" @endif href="{{ url('admin/menu') }}"><i class="zmdi zmdi-shield-check" aria-hidden="true"></i>Email Notifications</a></li>
                @endif


                    {{-- @if (in_array('read', explode(',', $AdminProfiledetails->liquidity))) --}}
                    <li class="@@photogalleryactive"><a @if ($active=='liquidity' ) class="active" @endif href="{{ url('admin/liquidity/') }}"><i class="zmdi zmdi-view-dashboard"></i>
                        Liquidity Settings</a>
                    </li>
                    {{-- @endif --}}
                    @if (in_array('read', explode(',', $AdminProfiledetails->adminbank)))
                    <li class="navigation__sub navigation__sub--toggled"><a href="#"><i class="zmdi zmdi-code" aria-hidden="true"></i>Admin Bank</a>
                        <ul @if ($active=='adminbank' ) style="display: block;" @else style="display: none;" @endif>
                            @php
                            $cmss = \Request::segment(3);
                            $Commission = \App\Models\Commission::on('mysql2')
                            ->where('type', 'fiat')
                            ->get();
                            @endphp
                            @foreach ($Commission as $value)
                            <li class="@@colorsactive">
                                <a @if ($value->source == $cmss) class="active" @endif
                                    href="{{ url('admin/bank/' . $value->source) }}">{{ $value->source }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @endif
                    {{-- @if (in_array('read', explode(',', $AdminProfiledetails->mpesa)))
                    <li class="@@photogalleryactive"><a @if ($active == 'mpesa') class="active" @endif
                            href="{{ url('/admin/mpesa') }}"><i class="zmdi zmdi-ticket-star"></i> Mpesa
                    <span class="pull-right"> </span></a></li>
                    @endif --}}
                    <li class="@@photogalleryactive"><a @if ($active=='mpesa' ) class="active" @endif href="{{ url('/admin/mpesa') }}"><i class="zmdi zmdi-balance"></i>

                            Mpesa<span class="pull-right"> </span></a></li>
                    <!-- <li class="@@photogalleryactive"><a @if ($active == 'mpesa') class="active" @endif href="{{ url('/admin/mpesa') }}"><i class="zmdi zmdi-assignment-return zmdi-hc-fw"></i> Referral Settings <span class="pull-right"> </span></a></li> -->
                   <li class="@@photogalleryactive"><a @if ($active=='coldwalletaddress' ) class="active" @endif href="{{ url('/admin/coldwalletaddress') }}"><i class="zmdi zmdi-assignment-return zmdi-hc-fw"></i>
                            Cold Wallet Address<span class="pull-right"> </span></a></li>
                    <li class="@@photogalleryactive"><a @if ($active=='feewalletaddress' ) class="active" @endif href="{{ url('/admin/feewalletaddress') }}"><i class="zmdi zmdi-storage zmdi-hc-fw"></i>
                            Fee Wallet Address<span class="pull-right"> </span></a></li>
                    @if (in_array('read', explode(',', $AdminProfiledetails->cms_settings)))
                    @php
                    $cm = \Request::segment(2);
                    @endphp
                    <li class="navigation__sub navigation__sub--toggled"><a href="#"><i class="zmdi zmdi-settings" aria-hidden="true"></i>CMS Settings </a>
                        <ul @if ($cm=='homepage' || $cm=='liveprice' || $cm=='tc' || $cm=='privacy' || $cm=='faq' || $cm=='aboutus' || $cm=='socialmedia' || $cm=='termsservices' || $cm=='crypto' || $cm=='credit' || $cm=='features' || $cm=='howitworks' || $cm=='securitypage' || $cm=='web' || $cm=='testimonial' || $cm=='mobileappdescription' || $cm=='listingstatus' || $cm=='mpsadesc'|| $cm=='statistics') style="display: block;" @else style="display: none;" @endif>
                            <!-- <li class="@@colorsactive"><a href="{{ url('admin/logo') }}">Logo & Favicon</a></li> -->
                            <li class="@@colorsactive"><a @if ($cm==' homepage' ) class="active" @endif href="{{ url('admin/homepage') }}">Home Banner</a>
                    </li>
                    <li class="@@colorsactive"><a @if ($cm=='liveprice' ) class="active" @endif href="{{ url('admin/liveprice') }}">Live Price View</a></li>
                    {{-- <li class="@@colorsactive"><a @if ($cm == 'crypto') class="active" @endif
                                        href="{{ url('admin/crypto') }}">Crypto lending</a>
                    </li> --}}
                    {{-- <li class="@@colorsactive"><a @if ($cm == 'credit') class="active" @endif
                                        href="{{ url('admin/credit') }}">Credit card</a></li> --}}
                    <li class="@@colorsactive"><a @if ($cm=='tc' ) class="active" @endif href="{{ url('admin/tc') }}">Terms & Conditions</a></li>
                    <li class="@@colorsactive"><a @if ($cm=='privacy' ) class="active" @endif href="{{ url('admin/privacy') }}">Privacy Policy</a></li>
                    <li class="@@colorsactive"><a @if ($cm=='faq' || $cm=='faq_add' || $cm=='faq_edit' ) class="active" @endif href="{{ url('admin/faq') }}">FAQ</a></li>
                    {{-- <li class="@@colorsactive"><a @if ($cm == 'aboutus') class="active" @endif
                                        href="{{ url('admin/aboutus') }}">About Us</a></li> --}}
                    <li class="@@colorsactive"><a @if ($cm=='features' ) class="active" @endif href="{{ url('admin/features') }}">Features</a></li>
                    {{-- <li class="@@colorsactive"><a @if ($cm == 'testimonial') class="active" @endif
                                        href="{{ url('admin/testimonial') }}">Announcement</a></li> --}}
                    <li class="@@colorsactive"><a @if ($cm=='mobileappdescription' ) class="active" @endif href="{{ url('admin/mobileappdescription') }}">Mobile App Description</a>
                    </li>
                    <li class="@@colorsactive"><a @if ($cm=='statistics' ) class="active" @endif href="{{ url('admin/statistics') }}">Statistics</a></li>
                    <li class="@@colorsactive"><a @if ($cm=='mpsadesc' ) class="active" @endif href="{{ url('admin/mpisa') }}">Mpesa Description</a></li>
                    {{-- <li class="@@colorsactive"><a @if ($cm == 'listingstatus') class="active" @endif
                                        href="{{ url('admin/listingstatus') }}">Listing Status</a></li> --}}
                    <!-- 
                        <li class="@@photogalleryactive"><a @if ($active == 'listing') class="active" @endif href="{{ url('/admin/listing') }}"> Listing Application </a></li> -->
                    <!-- <li class="@@colorsactive"><a @if ($cm == 'webdisclaimer') class="active" @endif href="{{ url('admin/webdisclaimer') }}">Website Disclaimer</a></li> -->
                    <!-- <li class="@@colorsactive"><a @if ($cm == 'warning') class="active" @endif href="{{ url('admin/warning') }}">Warning Risk</a></li> -->
                    <li class="@@colorsactive"><a @if ($cm=='howitworks' ) class="active" @endif href="{{ url('admin/howitworks') }}">How it works</a></li>
                    <!-- <li class="@@colorsactive"><a @if ($cm == 'socialmedia') class="active" @endif href="{{ url('admin/socialmedia') }}">Social Media</a></li> -->
                    <!-- <li class="@@colorsactive"><a @if ($cm == 'termsservices') class="active" @endif href="{{ url('admin/termsservices') }}">Terms & Services</a></li> -->
                    {{-- <li class="@@colorsactive"><a href="{{ url('admin/aml') }}">AML</a></li> --}}
                    <!--  <li class="@@colorsactive"><a href="{{ url('admin/partner') }}">Partner logo</a></li> -->
                    <!-- <li class="@@colorsactive"><a href="{{ url('admin/mobile_security') }}">Kyc Security</a></li> -->
                </ul>
                </li>
                @endif
                {{-- <li class="@@photogalleryactive"><a @if ($active == 'listing') class="active" @endif
                            href="{{ url('/admin/listing') }}"><i class="zmdi zmdi-assignment-return zmdi-hc-fw"></i>
                Listing Application <span class="pull-right"> </span></a></li> --}}
                <!-- <li class="@@photogalleryactive"><a @if ($active == 'referral') class="active" @endif href="{{ url('/admin/referral') }}"><i class="zmdi zmdi-assignment-return zmdi-hc-fw"></i> Referral Settings <span class="pull-right"> </span></a></li> -->
                @if (in_array('read', explode(',', $AdminProfiledetails->security_setup)))
                <li class="@@photogalleryactive"><a @if ($active=='settings' ) class="active" @endif href="{{ url('admin/security') }}"><i class="zmdi zmdi-shield-check" aria-hidden="true"></i>Security Settings </a></li>
                @endif
                <li class="@@photogalleryactive"><a @if ($active=='subscriber' ) class="active" @endif href="{{ url('admin/subscriber') }}"><i class="zmdi zmdi-view-list zmdi-hc-fw" aria-hidden="true"></i>Subscribers </a></li>
                <!--   <li class="@@photogalleryactive"><a href="{{ url('admin/adminwallet') }}"><i class="zmdi zmdi-balance-wallet zmdi-hc-fw" aria-hidden="true"></i>Admin Wallet </a></li> -->
                <li class="@@photogalleryactive"><a @if ($active=='logout' ) class="active" @endif href="{{ url('logout') }}"><i class="zmdi zmdi-power-off"></i> Logout</a></li>
                </ul>
            </div>
        </aside>
        @yield('content')
        @include('layouts.footer')