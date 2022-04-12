
<?php $__env->startSection('content'); ?>
<div class="navigation-sibling">
    <div class="main-section px-4 py-4">
        <hr class="divider"></hr>
        <div class="row">
            <div class="col-md-12">
                <h3>Bonus History</h3>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="bonus_history_table" style="width:100%">
                <thead>
                    <tr>
                        <th style="width:30%" scope="col">Date</th>
                        <th style="width:30%" scope="col">Deposit Number</th>
                        <th style="width:10%" scope="col">Deposit</th>
                        <th style="width:10%" scope="col">Bonus</th>
                        <th style="width:10%" scope="col">Wager</th>
                        <th style="width:20%" scope="col">Remaining<br/>Wager</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($bonus_history) && count($bonus_history)): ?>
                    <?php $__currentLoopData = $bonus_history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($history->wager_played == $history->wager): ?>
                    <tr class="text-muted">
                    <?php elseif($history->wager_played == 0): ?>
                    <tr class="text-dark">
                    <?php else: ?>
                    <tr class="text-primary">
                    <?php endif; ?>
                        <td><?php echo e($history->created_at); ?></td>
                        <?php if($history->deposit_num == 1): ?>
                        <td>1st Deposit</td>
                        <?php elseif($history->deposit_num == 2): ?>
                        <td>2nd Deposit</td>
                        <?php elseif($history->deposit_num == 3): ?>
                        <td>3rd Deposit</td>
                        <?php else: ?>
                        <td><?php echo e($history->deposit_num); ?>th Deposit</td>
                        <?php endif; ?>
                        <td><?php echo e($history->deposit); ?></td>
                        <td><?php echo e($history->bonus); ?></td>
                        <td><?php echo e($history->wager); ?></td>
                        <td><?php echo e($history->wager-$history->wager_played); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.Default.user.profile', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\00work\06casino\canada777\resources\views/frontend/Default/user/bonus.blade.php ENDPATH**/ ?>