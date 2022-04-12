
<?php $__env->startSection('content'); ?>
<div class="navigation-sibling">
    <div class="main-section px-4 py-4">
        <hr class="divider"></hr>
        <div class="row">
            <div class="col-md-12">
                <center><h3><b>BONUS</b></h3>
<p>1st deposit • 100% Match +200 Free Spins<br/>2nd deposit • 100% Match<br/>3rd deposit • 100% Match</p>
                <h3><b>BONUS FREE SPINS</b></h3> </center>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="freespins_history_table" style="width:100%">
                <thead>
                    <tr>
                        <th style="width:20%" scope="col">Date</th>
                        <th style="width:20%" scope="col">Game</th>
                        <th style="width:10%" scope="col">Free Spins</th>
                        <th style="width:10%" scope="col">Remaining<br/>Free Spins</th>
                        <th style="width:10%" scope="col">Win</th>
                        <th style="width:10%" scope="col">Wager<br/>Need</th>
                        <th style="width:10%" scope="col">Remaining<br/>Wager</th>
                        <th style="width:10%" scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($welcomepackage_history) && count($welcomepackage_history)): ?>
                    <?php $__currentLoopData = $welcomepackage_history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(date('Y-m-d', strtotime($history->started_at)) < date('Y-m-d')): ?>
                    <tr class="text-muted">
                    <?php elseif(date('Y-m-d', strtotime($history->started_at)) > date('Y-m-d')): ?>
                    <tr class="text-dark">
                    <?php else: ?>
                    <tr class="text-primary">
                    <?php endif; ?>
                        <?php if($history->day == 1): ?>
                        <td><?php echo e(date('Y-m-d', strtotime($history->started_at))); ?><br/><?php echo e($history->day); ?>st Day</td>
                        <?php elseif($history->day == 2): ?>
                        <td><?php echo e(date('Y-m-d', strtotime($history->started_at))); ?><br/><?php echo e($history->day); ?>nd Day</td>
                        <?php elseif($history->day == 3): ?>
                        <td><?php echo e(date('Y-m-d', strtotime($history->started_at))); ?><br/><?php echo e($history->day); ?>rd Day</td>
                        <?php else: ?>
                        <td><?php echo e(date('Y-m-d', strtotime($history->started_at))); ?><br/><?php echo e($history->day); ?>th Day</td>
                        <?php endif; ?>
                        <?php if(date('Y-m-d', strtotime($history->started_at)) == date('Y-m-d')): ?>
                        <td><a href="<?php echo e(route('frontend.game.go.prego', ['game'=>$history->name, 'prego'=>'realgo'])); ?>"><?php echo e($history->name); ?></a></td>
                        <?php else: ?>
                        <td><a href="javascript:void(0);"><?php echo e($history->name); ?></a></td>
                        <?php endif; ?>
                        <td><?php echo e($history->freespin); ?></td>
                        <td><?php echo e($history->remain_freespin); ?></td>
                        <td><?php echo e($history->win); ?></td>
                        <td><?php echo e($history->wager); ?></td>
                        <td><?php echo e($history->wager-$history->wager_played); ?></td>
                        <?php if(date('Y-m-d', strtotime($history->started_at)) < date('Y-m-d')): ?>
                        <td>Expired</td>
                        <?php elseif(date('Y-m-d', strtotime($history->started_at)) > date('Y-m-d')): ?>
                        <td>Comming</td>
                        <?php else: ?>
                        <td>Today</td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.Default.user.profile', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\00work\01casino\canada777\resources\views/frontend/Default/user/freespin.blade.php ENDPATH**/ ?>