<!DOCTYPE html>
<html lang="en" class="notranslate" translate="no">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="Find the top online casino, voted best Canadian Casino Sites with bonus, voted number one in Ontario, Alberta, British-Columbia and Quebec.">
    <meta title="title" content="Best Online Casinos Canada 2021- Real Money Gambling" />
    <meta name="google" content="notranslate" />
    <meta name="author" content="Adonis" />
    <!-- <meta name="description" content="HTML template"> -->
    <meta name="viewport" content="width=device-width" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <meta name="keywords" content="Canada777+online+casino" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />

    <title><?php echo e(settings('app_name')); ?></title>

    <!-- Global site tag (gtag.js) - Google Analytics -->

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-185160427-1"></script>

    <script>

        window.dataLayer = window.dataLayer || [];

        function gtag(){dataLayer.push(arguments);}

        gtag('js', new Date());

        gtag('config', 'UA-185160427-1');

    </script>

    <?php echo $__env->make('component.frontend.layout.style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
    <?php echo $__env->make('component.frontend.layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <main>
        <section id="hero-section border-bottom" style="border-bottom-color: white; border-bottom-width: 6px; border-bottom-style: solid;">
            <img class="hero-image" src="https://canada777.com/frontend/Page/image/bonus-banner.jpg" />
        </section>
        <section id="bonus-section">
            <div class="position-relative bonus-content py-5 px-5 d-flex justify-content-center">
                <?php if(Auth::check()): ?>
                    <img class="section-image" src="https://canada777.com/frontend/Page/image/bonus-content-image.jpg" />
                <?php else: ?>
                    <a href="#signin-modal" class="d-flex justify-content-center">
                        <img class="section-image" src="https://canada777.com/frontend/Page/image/bonus-content-image.jpg" />
                    </a>
                <?php endif; ?>
                <a href="<?php echo e(url('/bonus/term')); ?>" class="position-absolute d-block text-light" style="bottom: 10px; right: 100px;">Terms Apply</a>
            </div>
            <?php if($welcomepackages && count($welcomepackages)): ?>
            <div class="position-relative bonus-content py-5 px-5 d-flex justify-content-center">
                <div class="welcomepackage-games w-100">
                    <?php $__currentLoopData = $welcomepackages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$welcomepackage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="game-item m-1">
                        <?php if($welcomepackage->day == 1): ?>
                        <div class="text-white">1st Day <?php echo e($welcomepackage->freespin); ?> Free Spins</div>
                        <?php elseif($welcomepackage->day == 2): ?>
                        <div class="text-white">2nd Day <?php echo e($welcomepackage->freespin); ?> Free Spins</div>
                        <?php elseif($welcomepackage->day == 3): ?>
                        <div class="text-white">3rd Day <?php echo e($welcomepackage->freespin); ?> Free Spins</div>
                        <?php else: ?>
                        <div class="text-white"><?php echo e($welcomepackage->day); ?>th Day <?php echo e($welcomepackage->freespin); ?> Free Spins</div>
                        <?php endif; ?>
                        <img class="section-image mw-100" src="https://canada777.com/frontend/Default//ico/<?php echo e($welcomepackage->name); ?>.jpg/">
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php endif; ?>
            <p class="text-center text-light py-2 px-2 border-top border-default mb-0">*1st Deposit - Match Bonus up to C$ 400 • 2nd / 3rd Deposit - Match Bonus up to C$ 300 • New customers only • Min deposit C$ 10 • 70x wagering</p>
        </section>
    </main>
    <?php echo $__env->make('component.frontend.layout.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('component.frontend.layout.deposit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('component.frontend.layout.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php /**PATH E:\00work\01casino\canada777\resources\views/frontend/Default/bonus/bonus.blade.php ENDPATH**/ ?>