
<div class="col-md-3">

    <div class="box box-primary">
        <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle" src="/back/img/<?php echo e($user->present()->role_id); ?>.png" alt="<?php echo e($user->present()->username); ?>">
            <h4 class="profile-username text-center"><small><i class="fa fa-circle text-<?php echo e($user->present()->labelClass); ?>"></i></small> <?php echo e($user->present()->username); ?></h4>
            <a class="multi-account-count"><span>FINGERPRINTS: user have <?php echo e($multiAccountsCount); ?> other accounts.</span></a>
            <div class="multi-account-info">
                <?php $__currentLoopData = $multiAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $multiAccount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span><?php echo e($multiAccount->email); ?>&nbsp;<span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                    <b><?php echo app('translator')->get('app.total_balance'); ?></b> <a class="pull-right"><?php echo e(number_format($user->present()->balance,2)); ?></a>
                </li>
                <?php if( $user->hasRole('user') ): ?>
                <li class="list-group-item">
                    <b><?php echo app('translator')->get('app.in'); ?></b> <a class="pull-right"><?php echo e(number_format($user->present()->total_in,2)); ?></a>
                </li>
                <li class="list-group-item">
                    <b><?php echo app('translator')->get('app.out'); ?></b> <a class="pull-right"><?php echo e(number_format($user->present()->total_out,2)); ?></a>
                </li>
                <li class="list-group-item">
                    <b><?php echo app('translator')->get('app.bonus_balance'); ?></b> <a class="pull-right"><?php echo e(number_format($user->present()->bonus,2)); ?></a>
                </li>
                <li class="list-group-item">
                    <b><?php echo app('translator')->get('app.real_balance'); ?></b> <a class="pull-right"><?php echo e(number_format($user->present()->total_in - $user->present()->total_out,2)); ?></a>
                </li>
                <li class="list-group-item">
                    <b><?php echo app('translator')->get('app.daily_deposit_amount'); ?></b> <a class="pull-right"><?php echo e(number_format($user->present()->max_deposit,2)); ?></a>
                    <form action="<?php echo e(route('backend.user.update.deposit-amount', $user->id)); ?>" method="POST" style="display: flex; margin-top: 10px;">
                        <?php echo csrf_field(); ?>
                        <input type="text" name="daily_deposit_amount" class="form-control input-sm">
                        <button type="submit" class="btn btn-primary btn-xs" style="margin-left: 10px;">Change</button>
                    </form>
                </li>
                <?php endif; ?>

            </ul>

            <?php if( $user->id != Auth::id() ): ?>
                <?php if(

                    (auth()->user()->hasRole('agent') && $user->hasRole('distributor'))
                    ||
                    (auth()->user()->hasRole('distributor') && $user->hasRole('manager'))
                    ||
                    (auth()->user()->hasRole('manager') && $user->hasRole('cashier'))
                    ||
                    (auth()->user()->hasRole('cashier') && $user->hasRole('user'))
                ): ?>
                <?php if (\Auth::user()->hasPermission('users.delete')) : ?>
                <a href="<?php echo e(route('backend.user.delete', $user->id)); ?>"
                   class="btn btn-danger btn-block"
                   data-method="DELETE"
                   data-confirm-title="<?php echo app('translator')->get('app.please_confirm'); ?>"
                   data-confirm-text="<?php echo app('translator')->get('app.are_you_sure_delete_user'); ?>"
                   data-confirm-delete="<?php echo app('translator')->get('app.yes_delete_him'); ?>">
                    <b><?php echo app('translator')->get('app.delete'); ?></b></a>
                <?php endif; ?>
                <?php endif; ?>

                    <?php if (\Auth::user()->hasPermission('users.delete')) : ?>
                    <?php if(auth()->user()->hasRole('admin') && $user->hasRole(['agent','distributor']) ): ?>
                        <a href="<?php echo e(route('backend.user.hard_delete', $user->id)); ?>"
                           class="btn btn-danger btn-block"
                           data-method="DELETE"
                           data-confirm-title="<?php echo app('translator')->get('app.please_confirm'); ?>"
                           data-confirm-text="<?php echo app('translator')->get('app.are_you_sure_delete_user'); ?>"
                           data-confirm-delete="<?php echo app('translator')->get('app.yes_delete_him'); ?>">
                            <b><?php echo app('translator')->get('app.hard_delete'); ?> <?php echo e($user->role->name); ?></b></a>
                    <?php endif; ?>
                    <?php endif; ?>

            <?php endif; ?>
        </div>
    </div>


</div>
<?php /**PATH E:\00work\01casino\canada777\resources\views/backend/user/partials/info.blade.php ENDPATH**/ ?>