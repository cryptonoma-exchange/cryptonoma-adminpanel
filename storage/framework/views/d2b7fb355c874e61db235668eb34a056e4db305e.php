<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Panel | <?php echo e(config('app.name')); ?> </title>
    <!-- favicon !-->
	    <link rel="icon" href="<?php echo e(url('images/favicon.png')); ?>">

    <!-- Vendor styles -->
    <link rel="stylesheet" href="<?php echo e(url('adminpanel/css/material-design-iconic-font.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('adminpanel/css/animate.min.css')); ?>">
    <!-- App styles -->
    <link rel="stylesheet" href="<?php echo e(url('adminpanel/css/app.min.css')); ?>">
</head>
<body data-sa-theme="7">
    <style>
        .g-recaptcha{
            transform: scale(0.92);
            transform-origin: 0 0;
        }
    </style>
    <!-- Login -->
    <div class="login">
        <div class="login__block active" id="l-login">
            <img src="<?php echo e(url('/images/logo.svg')); ?>" class="logo-text" />
            <div class="login__block__header">
                <i class="zmdi zmdi-account-circle"></i>
                Admin Panel                 
            </div>
            <div class="login__block__body">
                <?php if(session('error')): ?>
                    <div class="alert alert-danger">
                          <?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?>
                <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('login')); ?>">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group">
                        <input type="text" class="form-control text-center" name="email" value="<?php echo e(old('email')); ?>" placeholder="Email">
                        <?php if($errors->has('email')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('email')); ?></strong>
                        </span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control text-center" placeholder="Password">
                        <?php if($errors->has('password')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('password')); ?></strong>
                        </span>
                        <?php endif; ?>
                    </div>
                    <?php if($admin->google2fa_verify == 1): ?>
                        <div class="form-group">
                        <input type="text" class="form-control text-center" name="code" value="" placeholder="Authentication Code">
                        <?php if($errors->has('code')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('code')); ?></strong>
                        </span>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    
                    <div class="form-group <?php echo e($errors->has('g-recaptcha-response') ? ' has-error' : ''); ?>">
                                    <div class="g-recaptcha" data-sitekey="<?php echo e(config('app.GOOGLE_RECAPTCHA_KEY')); ?>">
                                    </div>
                                    <?php if($errors->has('g-recaptcha-response')): ?>

                                        <span class="help-block">
                                            <strong
                                                class="text text-danger"><?php echo e($errors->first('g-recaptcha-response')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                    <button type="submit" name="secure-adminlogin" class="btn btn--icon login__block__btn"><i class="zmdi zmdi-long-arrow-right"></i></button>
                </form>
            </div>
        </div>
    </div>
    <script src="<?php echo e(url('adminpanel/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(url('adminpanel/js/popper.min.js')); ?>"></script>
    <script src="<?php echo e(url('adminpanel/js/bootstrap.min.js')); ?>"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="<?php echo e(url('adminpanel/js/app.min.js')); ?>"></script>
</body>
</html>

<script>
      $(document).ready(function(){
        $('form').attr('autocomplete', 'off');
      });
</script><?php /**PATH /home/admin/web/hd83s.cryptonoma.com/public_html/resources/views/welcome.blade.php ENDPATH**/ ?>