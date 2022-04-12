
<?php $__env->startSection('content'); ?>
<div class="navigation-sibling">
    <div class="main-section px-4 py-4">
    <?php echo $__env->make('frontend.Default.user.transaction_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <hr class="divider"></hr>
        <div class="row">
            <div class="col-md-12">
                <h3>Payments</h3>
            </div>
        </div>
        <div class="row my-2">
            <div class="col-md-12">



































            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="payment_history_table" style="width:100%">
            <thead>
                <tr>
                    <th style="width: 40%" scope="col">Date</th>
                    <th style="width: 20%" scope="col">Status</th>
                    <th style="width: 20%" scope="col">Payment System</th>
                    <th style="width: 20%" scope="col">Type</th>
                    <th style="width: 20%" scope="col">Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($payment_history) && count($payment_history)): ?>
                <?php $__currentLoopData = $payment_history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($history->created_at); ?></td>
                    <td><?php echo e($history->getStatus()); ?></td>
                    <td><?php echo e($history->system); ?></td>
                    <td><?php echo e($history->type); ?></td>
                    <td><?php echo e(number_format($history->summ,2)); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </tbody>
        </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.Default.user.profile', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\00work\01casino\canada777\resources\views/frontend/Default/user/payment_history.blade.php ENDPATH**/ ?>