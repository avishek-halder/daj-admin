<?php $__env->startSection('title', $page_title); ?>
<?php $__env->startSection('meta_description', $meta_description); ?>
<?php $__env->startSection('meta_keywords', $meta_keywords); ?>
<?php $__env->startSection('author', ''); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\laravel\daj-home\resources\views/frontend/home.blade.php ENDPATH**/ ?>