<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- CSRF Token -->
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="">
<meta name="theme-color" content="#DF0021">
<link rel="icon" type="image/ico" sizes="32x32" href="<?php echo e(asset(config('settings.favicon'))); ?>">
<title><?php echo e(config('settings.appname')); ?> :: <?php echo $__env->yieldContent('title'); ?></title>

<?php echo $__env->yieldPushContent('top'); ?><?php /**PATH F:\laravel\daj-home\resources\views/partial/head.blade.php ENDPATH**/ ?>