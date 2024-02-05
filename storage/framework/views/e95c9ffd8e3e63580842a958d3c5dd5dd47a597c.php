<?php
if (isset($atitle)) {
    switch ($atitle) {
        case 'dashboard':
            $active = 'dashboard';
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
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Admin Dashboard | <?php echo e(config('app.name')); ?> </title>
    <link rel="icon" href="<?php echo e(url('images/favicon.png')); ?>">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendor styles -->
    <link rel="stylesheet" href="<?php echo e(url('adminpanel/dist/css/material-design-iconic-font.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('adminpanel/css/animate.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('adminpanel/js/jquery.scrollbar/jquery.scrollbar.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('adminpanel/css/fullcalendar.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('adminpanel/css/flatpickr.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(url('adminpanel/font-awesome/css/font-awesome.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(url('adminpanel/css/app.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('adminpanel/css/pagination.css')); ?>">
    <!--<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>-->
    <?php echo $__env->yieldPushContent('customscripts'); ?>
</head>
<body data-sa-theme="7">
    <main class="main">
        <header class="header">
            <div class="navigation-trigger hidden-xl-up" data-sa-action="aside-open" data-sa-target=".sidebar">
                <i class="zmdi zmdi-menu"></i>
            </div>
            <div class="logo hidden-sm-down">
                <h1><a href="#">
                        <img src="<?php echo e(url('/images/logo.svg')); ?>" class="logo-text-1" />
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
                            <div class="user__email"><?php echo e($Admindetails['email']); ?></div>
                        </div>
                    </div>
                </div>
                <ul class="navigation">
                    <li class="@photogalleryactive"><a <?php if($active=='dashboard' ): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/dashboard')); ?>"><i class="zmdi zmdi-view-dashboard"></i>Dashboard</a>
                    </li>
                    <?php if(in_array('read', explode(',', $AdminProfiledetails->userlist))): ?>
                    <li class="@photogalleryactive"><a <?php if($active=='users' ): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/users')); ?>"><i class="zmdi zmdi-accounts-alt"></i> Users</a></li>
                    <?php endif; ?>
                    <?php if((in_array("read", explode(',',$AdminProfiledetails->tokensetting))) || (in_array("read",
                    explode(',',$AdminProfiledetails->tradepair))) || (in_array("read",
                    explode(',',$AdminProfiledetails->commissionsetting))) || (in_array("read",
                    explode(',',$AdminProfiledetails->liquiditysettings)))): ?>
                    <li class="navigation__sub navigation__sub--toggled"><a href="#"><i class="zmdi zmdi-edit"></i>Coin
                            Settings</a>
                        <ul <?php if($active=='tradepair' || $active=='commission' ): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?>>
                            <li class="@colorsactive"><a <?php if($active=='tradepair' ): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/tradepairlist')); ?>">Trade Pairs </a></li>
                            <li class="@colorsactive"><a <?php if($active=='commission' ): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/commission')); ?>">Commission Settings </a></li>
                            <li class="@colorsactive"><a <?php if($active=='tokenlist' ): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/tokenlist')); ?>">Tokens</a></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <?php if(in_array('read', explode(',', $AdminProfiledetails->support))): ?>
                    <li class="@photogalleryactive"><a <?php if($active=='support' ): ?> class="active" <?php endif; ?> href="<?php echo e(url('/admin/support')); ?>"><i class="zmdi zmdi-ticket-star"></i> Support
                            (<?php echo e(ticketcount()); ?>)<span class="pull-right"> </span></a></li>
                    <?php endif; ?>
                    <?php if(in_array('read', explode(',', $AdminProfiledetails->tradehistroylist))): ?>
                    <li class="navigation__sub navigation__sub--toggled"><a <?php if($active=='trades' ): ?> class="active" <?php endif; ?> href="#"><i class="zmdi zmdi-time-restore"></i> Trade History</a>
                        <ul <?php if($active=='buytrade' || $active=='selltrade' || $active=='pendingorder' ): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?>>

                            <li class="@colorsactive"><a <?php if($active=='buytrade' ): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/buy_tradehistory/' . first_pair() . '/limit')); ?>">Buy
                                    Trade</a></li>
                            <li class="@colorsactive"><a <?php if($active=='selltrade' ): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/sell_tradehistory/' . first_pair() . '/limit')); ?>">Sell
                                    Trade
                                </a></li>
                            <li class="@colorsactive"><a <?php if($active=='pendingorder' ): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/pending_tradehistory/all')); ?>">Pending Orders </a></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <?php if(in_array('read', explode(',', $AdminProfiledetails->depositlist))): ?>
                    <li class="navigation__sub navigation__sub--toggled"><a href="#"><i class="fa fa-money" aria-hidden="true"></i>User Deposit History</a>
                        <ul <?php if($active=='deposit' ): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?>>
                            <?php $__empty_1 = true; $__currentLoopData = list_coin(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coins): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php if(isset($coin)): ?>
                            <?php $selectedcoin = $coin; ?>
                            <?php else: ?>
                            <?php $selectedcoin = 'BTC'; ?>
                            <?php endif; ?>
                            <li class="@colorsactive"><a <?php if($selectedcoin==$coins->source): ?> class="active" <?php endif; ?>
                                    href="<?php echo e(url('admin/deposits/' . $coins->source)); ?>"><?php echo e($coins->source); ?></a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li class="@colorsactive"><a href="#">No Coins list</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <?php if(in_array('read', explode(',', $AdminProfiledetails->withdrawlist))): ?>
                    <li class="navigation__sub navigation__sub--toggled"><a href="#"><i class="fa fa-arrows" aria-hidden="true"></i>User Withdraw History</a>
                        <ul <?php if($active=='withdraw' ): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?>>
                            <?php $__empty_1 = true; $__currentLoopData = list_coin(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coinss): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php
                            $c = \Request::segment(3); ?>
                            <?php if(isset($c)): ?>
                            <?php $selectedcoin = $c; ?>
                            <?php else: ?>
                            <?php $selectedcoin = 'BTC'; ?>
                            <?php endif; ?>
                            <li class="@colorsactive"><a <?php if($selectedcoin==$coinss->source): ?> class="active" <?php endif; ?>
                                    href="<?php echo e(url('admin/withdraw/' . $coinss->source)); ?>"><?php echo e($coinss->source); ?></a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li class="@colorsactive"><a <?php if($active=='withdraw' ): ?> class="active" <?php endif; ?> href="#">No Coins list</a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <li class="@photogalleryactive"><a <?php if($active == 'adminwallet'): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/adminwallet')); ?>"><i class="zmdi zmdi-balance-wallet"></i>Admin Wallet</a></li>
                    <!-- <?php if(in_array('read', explode(',', $AdminProfiledetails->feewallet))): ?>
                 <li class="@photogalleryactive"><a <?php if($active == 'feewallet'): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/feewallet')); ?>"><i class="zmdi zmdi-balance-wallet"></i>Admin Fee Wallet</a></li>
                 <?php endif; ?> -->
                    <?php if(in_array('read', explode(',', $AdminProfiledetails->kyc))): ?>
                    <li class="navigation__sub navigation__sub--toggled"><a <?php if($active=='kyc' ): ?> class="active" <?php endif; ?> href="#"><i class="zmdi zmdi-assignment-o"></i> KYC</a>
                        <ul <?php if($active=='kycview' ): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?>>
                            <li class="@colorsactive"><a <?php if($active=='kycview' ): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/kyc')); ?>">KYC submit</a></li>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <?php if(in_array('read', explode(',', $AdminProfiledetails->security_setup))): ?>
                <li class="@photogalleryactive"><a <?php if($active=='settings' ): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/menu')); ?>"><i class="zmdi zmdi-shield-check" aria-hidden="true"></i>Email Notifications</a></li>
                <?php endif; ?>


                    
                    <li class="@photogalleryactive"><a <?php if($active=='liquidity' ): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/liquidity/')); ?>"><i class="zmdi zmdi-view-dashboard"></i>
                        Liquidity Settings</a>
                    </li>
                    
                    <?php if(in_array('read', explode(',', $AdminProfiledetails->adminbank))): ?>
                    <li class="navigation__sub navigation__sub--toggled"><a href="#"><i class="zmdi zmdi-code" aria-hidden="true"></i>Admin Bank</a>
                        <ul <?php if($active=='adminbank' ): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?>>
                            <?php
                            $cmss = \Request::segment(3);
                            $Commission = \App\Models\Commission::on('mysql2')
                            ->where('type', 'fiat')
                            ->get();
                            ?>
                            <?php $__currentLoopData = $Commission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="@colorsactive">
                                <a <?php if($value->source == $cmss): ?> class="active" <?php endif; ?>
                                    href="<?php echo e(url('admin/bank/' . $value->source)); ?>"><?php echo e($value->source); ?></a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                    <?php endif; ?>
                    
                    <li class="@photogalleryactive"><a <?php if($active=='mpesa' ): ?> class="active" <?php endif; ?> href="<?php echo e(url('/admin/mpesa')); ?>"><i class="zmdi zmdi-balance"></i>

                            Mpesa<span class="pull-right"> </span></a></li>
                    <!-- <li class="@photogalleryactive"><a <?php if($active == 'mpesa'): ?> class="active" <?php endif; ?> href="<?php echo e(url('/admin/mpesa')); ?>"><i class="zmdi zmdi-assignment-return zmdi-hc-fw"></i> Referral Settings <span class="pull-right"> </span></a></li> -->
                   <li class="@photogalleryactive"><a <?php if($active=='coldwalletaddress' ): ?> class="active" <?php endif; ?> href="<?php echo e(url('/admin/coldwalletaddress')); ?>"><i class="zmdi zmdi-assignment-return zmdi-hc-fw"></i>
                            Cold Wallet Address<span class="pull-right"> </span></a></li>
                    <li class="@photogalleryactive"><a <?php if($active=='feewalletaddress' ): ?> class="active" <?php endif; ?> href="<?php echo e(url('/admin/feewalletaddress')); ?>"><i class="zmdi zmdi-storage zmdi-hc-fw"></i>
                            Fee Wallet Address<span class="pull-right"> </span></a></li>
                    <?php if(in_array('read', explode(',', $AdminProfiledetails->cms_settings))): ?>
                    <?php
                    $cm = \Request::segment(2);
                    ?>
                    <li class="navigation__sub navigation__sub--toggled"><a href="#"><i class="zmdi zmdi-settings" aria-hidden="true"></i>CMS Settings </a>
                        <ul <?php if($cm=='homepage' || $cm=='liveprice' || $cm=='tc' || $cm=='privacy' || $cm=='faq' || $cm=='aboutus' || $cm=='socialmedia' || $cm=='termsservices' || $cm=='crypto' || $cm=='credit' || $cm=='features' || $cm=='howitworks' || $cm=='securitypage' || $cm=='web' || $cm=='testimonial' || $cm=='mobileappdescription' || $cm=='listingstatus' || $cm=='mpsadesc'|| $cm=='statistics'): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?>>
                            <!-- <li class="@colorsactive"><a href="<?php echo e(url('admin/logo')); ?>">Logo & Favicon</a></li> -->
                            <li class="@colorsactive"><a <?php if($cm==' homepage' ): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/homepage')); ?>">Home Banner</a>
                    </li>
                    <li class="@colorsactive"><a <?php if($cm=='liveprice' ): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/liveprice')); ?>">Live Price View</a></li>
                    
                    
                    <li class="@colorsactive"><a <?php if($cm=='tc' ): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/tc')); ?>">Terms & Conditions</a></li>
                    <li class="@colorsactive"><a <?php if($cm=='privacy' ): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/privacy')); ?>">Privacy Policy</a></li>
                    <li class="@colorsactive"><a <?php if($cm=='faq' || $cm=='faq_add' || $cm=='faq_edit' ): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/faq')); ?>">FAQ</a></li>
                    
                    <li class="@colorsactive"><a <?php if($cm=='features' ): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/features')); ?>">Features</a></li>
                    
                    <li class="@colorsactive"><a <?php if($cm=='mobileappdescription' ): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/mobileappdescription')); ?>">Mobile App Description</a>
                    </li>
                    <li class="@colorsactive"><a <?php if($cm=='statistics' ): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/statistics')); ?>">Statistics</a></li>
                    <li class="@colorsactive"><a <?php if($cm=='mpsadesc' ): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/mpisa')); ?>">Mpesa Description</a></li>
                    
                    <!-- 
                        <li class="@photogalleryactive"><a <?php if($active == 'listing'): ?> class="active" <?php endif; ?> href="<?php echo e(url('/admin/listing')); ?>"> Listing Application </a></li> -->
                    <!-- <li class="@colorsactive"><a <?php if($cm == 'webdisclaimer'): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/webdisclaimer')); ?>">Website Disclaimer</a></li> -->
                    <!-- <li class="@colorsactive"><a <?php if($cm == 'warning'): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/warning')); ?>">Warning Risk</a></li> -->
                    <li class="@colorsactive"><a <?php if($cm=='howitworks' ): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/howitworks')); ?>">How it works</a></li>
                    <!-- <li class="@colorsactive"><a <?php if($cm == 'socialmedia'): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/socialmedia')); ?>">Social Media</a></li> -->
                    <!-- <li class="@colorsactive"><a <?php if($cm == 'termsservices'): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/termsservices')); ?>">Terms & Services</a></li> -->
                    
                    <!--  <li class="@colorsactive"><a href="<?php echo e(url('admin/partner')); ?>">Partner logo</a></li> -->
                    <!-- <li class="@colorsactive"><a href="<?php echo e(url('admin/mobile_security')); ?>">Kyc Security</a></li> -->
                </ul>
                </li>
                <?php endif; ?>
                
                <!-- <li class="@photogalleryactive"><a <?php if($active == 'referral'): ?> class="active" <?php endif; ?> href="<?php echo e(url('/admin/referral')); ?>"><i class="zmdi zmdi-assignment-return zmdi-hc-fw"></i> Referral Settings <span class="pull-right"> </span></a></li> -->
                <?php if(in_array('read', explode(',', $AdminProfiledetails->security_setup))): ?>
                <li class="@photogalleryactive"><a <?php if($active=='settings' ): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/security')); ?>"><i class="zmdi zmdi-shield-check" aria-hidden="true"></i>Security Settings </a></li>
                <?php endif; ?>
                <li class="@photogalleryactive"><a <?php if($active=='subscriber' ): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/subscriber')); ?>"><i class="zmdi zmdi-view-list zmdi-hc-fw" aria-hidden="true"></i>Subscribers </a></li>
                <!--   <li class="@photogalleryactive"><a href="<?php echo e(url('admin/adminwallet')); ?>"><i class="zmdi zmdi-balance-wallet zmdi-hc-fw" aria-hidden="true"></i>Admin Wallet </a></li> -->
                <li class="@photogalleryactive"><a <?php if($active=='logout' ): ?> class="active" <?php endif; ?> href="<?php echo e(url('logout')); ?>"><i class="zmdi zmdi-power-off"></i> Logout</a></li>
                </ul>
            </div>
        </aside>
        <?php echo $__env->yieldContent('content'); ?>
        <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/hd83s.cryptonoma.com/public_html/resources/views/layouts/header.blade.php ENDPATH**/ ?>