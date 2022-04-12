

<?php $__env->startSection('page-title', trans('app.edit_user')); ?>
<?php $__env->startSection('page-heading', $user->present()->username); ?>

<?php $__env->startSection('content'); ?>

    <section class="content-header">
        <?php echo $__env->make('backend.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </section>

    <section class="content">
        <div class="row">
            <?php echo $__env->make('backend.user.partials.info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="col-md-9">
                <form action="" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><?php echo app('translator')->get('app.dateFrom'); ?></label>
                                <input type="text" class="form-control" name="dateFrom" value="<?php echo e(Request::get('dateFrom')); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><?php echo app('translator')->get('app.dateTo'); ?></label>
                                <input type="text" class="form-control" name="dateTo" value="<?php echo e(Request::get('dateTo')); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>&nbsp;</label><br>
                                <button type="submit" class="btn btn-primary">
                                    <?php echo app('translator')->get('app.filter'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a id="details-tab"
                               data-toggle="tab"
                               href="#details">
                                <?php echo app('translator')->get('app.edit_user'); ?>
                            </a>
                        </li>
                        <li>
                            <a id="login-tab"
                               data-toggle="tab"
                               href="#login-details">
                                <?php echo app('translator')->get('app.latest_activity'); ?>
                            </a>
                        </li>
                        <li>
                            <a id="game-tab"
                               data-toggle="tab"
                               href="#game-details">
                                <?php echo app('translator')->get('app.games_activity'); ?>
                            </a>
                        </li>
                        <li>
                            <a id="transaction-tab"
                               data-toggle="tab"
                               href="#transaction-history">
                                <?php echo app('translator')->get('app.transaction_history'); ?>
                            </a>
                        </li>
                        <li>
                            <a id="bet-tab"
                               data-toggle="tab"
                               href="#bet-history">
                                <?php echo app('translator')->get('app.bet_history'); ?>
                            </a>
                        </li>
                        <li>
                            <a id="bet-tab"
                               data-toggle="tab"
                               href="#api-game-bet-history">
                                <?php echo app('translator')->get('app.api_game_bet_history'); ?>
                            </a>
                        </li>
                        <li>
                            <a id="bonus-tab"
                               data-toggle="tab"
                               href="#bonus-history">
                                <?php echo app('translator')->get('app.bonus_history'); ?>
                            </a>
                        </li>
                        <li>
                            <a id="freespin-tab"
                               data-toggle="tab"
                               href="#freespin-history">
                                <?php echo app('translator')->get('app.freespin_history'); ?>
                            </a>
                        </li>
                        <li>
                            <a id="verify-tab"
                               data-toggle="tab"
                               href="#verify">
                                <?php echo app('translator')->get('app.verify_account'); ?>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane active" id="details">
                            <?php echo Form::open(['route' => ['backend.user.update.details', $user->id], 'method' => 'PUT', 'id' => 'details-form']); ?>

                            <?php echo $__env->make('backend.user.partials.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php echo Form::close(); ?>

                        </div>

                        <div class="tab-pane" id="login-details">
                            <?php if(count($userActivities)): ?>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('app.action'); ?></th>
                                        <th><?php echo app('translator')->get('app.date'); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $userActivities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($activity->description); ?></td>
                                            <td><?php echo e($activity->created_at->format(config('app.date_time_format'))); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <p class="text-muted font-weight-light"><em><?php echo app('translator')->get('app.no_activity_from_this_user_yet'); ?></em></p>
                            <?php endif; ?>
                        </div>

                        <div class="tab-pane" id="game-details">
                            <?php if(count($numbers) || count($max_wins) || count($max_bets)): ?>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('app.games'); ?></th>
                                        <th><?php echo app('translator')->get('app.count2'); ?></th>
                                        <th><?php echo app('translator')->get('app.max_bet'); ?></th>
                                        <th><?php echo app('translator')->get('app.max_win'); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($numbers): ?>
                                        <?php $__currentLoopData = $numbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $number): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($number->game); ?></td>
                                                <td><?php echo e($number->summ); ?> </td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    <?php if($max_wins): ?>
                                        <?php $__currentLoopData = $max_wins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $win): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($win->game); ?></td>
                                                <td></td>
                                                <td></td>
                                                <td><?php echo e($win->max_win); ?> </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    <?php if($max_bets): ?>
                                        <?php $__currentLoopData = $max_bets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($bet->game); ?></td>
                                                <td></td>
                                                <td><?php echo e($bet->max_bet); ?> </td>
                                                <td></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <p class="text-muted font-weight-light"><em><?php echo app('translator')->get('app.no_activity_from_this_user_yet'); ?></em></p>
                            <?php endif; ?>
                        </div>
                        <div class="tab-pane" id="transaction-history">
                            <form action="<?php echo e(route('backend.user.balance.update.manually')); ?>" method="POST">
                                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                <input type="hidden" id="AddId" name="user_id" value="<?php echo e($user->present()->id); ?>">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo app('translator')->get('app.payment_amount'); ?></label>
                                            <input type="text" class="form-control" name="summ" value="<?php echo e(Request::get('dateFrom')); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo app('translator')->get('app.reason'); ?></label>
                                            <input type="text" class="form-control" name="dateTo" value="<?php echo e(Request::get('dateTo')); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>&nbsp;</label><br>
                                            <button type="submit" class="btn btn-primary">
                                                <?php echo app('translator')->get('app.deposit'); ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <?php if(count($transactions)): ?>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('app.date'); ?></th>
                                        <th><?php echo app('translator')->get('app.status'); ?></th>
                                        <th><?php echo app('translator')->get('app.payment_system'); ?></th>
                                        <th><?php echo app('translator')->get('app.payment_type'); ?></th>
                                        <th><?php echo app('translator')->get('app.payment_amount'); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($history->created_at->format(config('app.date_time_format'))); ?></td>
                                            <td>
                                                <?php if($history->status == 1): ?> Confirm <?php else: ?> Unconfirm <?php endif; ?>
                                            </td>
                                            <td><?php echo e($history->system); ?></td>
                                            <td><?php echo e($history->type); ?></td>
                                            <td><?php echo e(abs($history->summ)); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <p class="text-muted font-weight-light"><em><?php echo app('translator')->get('app.no_activity_from_this_user_yet'); ?></em></p>
                            <?php endif; ?>
                        </div>
                        <div class="tab-pane" id="bet-history">
                            <p style="text-align:center">TOTAL BET:<?php echo e($totalBet); ?> AMOUNT WIN:<?php echo e($amountWin); ?> AMOUNT WIN<?php echo e($winPercent); ?>%</p>
                            <?php if(count($bets)): ?>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('app.date'); ?></th>
                                        <th><?php echo app('translator')->get('app.balance'); ?></th>
                                        <th><?php echo app('translator')->get('app.bet'); ?></th>
                                        <th><?php echo app('translator')->get('app.win'); ?></th>
                                        <th><?php echo app('translator')->get('app.game'); ?></th>
                                        <th><?php echo app('translator')->get('app.percent'); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $bets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr data-id="<?php echo e($history->id); ?>">
                                            <td><?php echo e($history->date_time); ?></td>
                                            <td><?php echo e($history->balance); ?></td>
                                            <td><?php echo e($history->bet); ?></td>
                                            <td><?php echo e($history->win); ?></td>
                                            <td><?php echo e($history->game); ?></td>
                                            <td><?php echo e($history->percent); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <p class="text-muted font-weight-light"><em><?php echo app('translator')->get('app.no_activity_from_this_user_yet'); ?></em></p>
                            <?php endif; ?>
                        </div>
                        <div class="tab-pane" id="api-game-bet-history">
                            <p style="text-align:center">TOTAL BET:<?php echo e($totalApiGameBet); ?> AMOUNT WIN:<?php echo e($totalApiGameWin); ?> AMOUNT WIN<?php echo e($winApiGamePercent); ?>%</p>
                            <?php if(count($apiGameBet)): ?>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('app.date'); ?></th>
                                        <th><?php echo app('translator')->get('app.balance'); ?></th>
                                        <th><?php echo app('translator')->get('app.bet'); ?></th>
                                        <th><?php echo app('translator')->get('app.win'); ?></th>
                                        <th><?php echo app('translator')->get('app.game'); ?></th>
                                        <!-- <th><?php echo app('translator')->get('app.percent'); ?></th> -->
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $apiGameBet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $api_game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr data-id="<?php echo e($history->id); ?>">
                                            <td><?php echo e($api_game->created_at); ?></td>
                                            <td><?php echo e($api_game->there_was_money); ?></td>
                                            <?php if($api_game->action == 'debit'): ?>
                                            <td><?php echo e($api_game->amount); ?></td>
                                            <td></td>
                                            <?php else: ?>
                                            <td></td>
                                            <td><?php echo e($api_game->amount); ?></td>
                                            <?php endif; ?>
                                            <td><?php echo e($api_game->name); ?></td>
                                            <!-- <td></td> -->
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <p class="text-muted font-weight-light"><em><?php echo app('translator')->get('app.no_activity_from_this_user_yet'); ?></em></p>
                            <?php endif; ?>
                        </div>
                        <div class="tab-pane" id="bonus-history">
                            <?php if(count($bonus)): ?>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('app.date'); ?></th>
                                        <th><?php echo app('translator')->get('app.deposit_number'); ?></th>
                                        <th><?php echo app('translator')->get('app.deposit'); ?></th>
                                        <th><?php echo app('translator')->get('app.bonus'); ?></th>
                                        <th><?php echo app('translator')->get('app.wager'); ?></th>
                                        <th><?php echo app('translator')->get('app.wager_remain'); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $bonus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
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
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <p class="text-muted font-weight-light"><em><?php echo app('translator')->get('app.no_activity_from_this_user_yet'); ?></em></p>
                            <?php endif; ?>
                        </div>
                        <div class="tab-pane" id="freespin-history">
                            <?php if(isset($freespin) && count($freespin)): ?>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Game</th>
                                            <th>Free Spins</th>
                                            <th>Remaining<br/>Free Spins</th>
                                            <th>Win</th>
                                            <th>Wager<br/>Need</th>
                                            <th>Remaining<br/>Wager</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $freespin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(date('Y-m-d', strtotime($history->started_at)) < date('Y-m-d')): ?>
                                        <tr>
                                        <?php elseif(date('Y-m-d', strtotime($history->started_at)) > date('Y-m-d')): ?>
                                        <tr>
                                        <?php else: ?>
                                        <tr>
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
                                            <td><?php echo e($history->name); ?></td>
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
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <p class="text-muted font-weight-light"><em><?php echo app('translator')->get('app.no_activity_from_this_user_yet'); ?></em></p>
                            <?php endif; ?>
                        </div>
                        <div class="tab-pane" id="verify">
                            <?php if($verify): ?>
                            <?php echo Form::open(['route' => ['backend.user.update.verify', $user->id], 'method' => 'PUT', 'id' => 'details-form']); ?>

                            <?php if($verify->id_img): ?>
                            <div class="form-group">
                                <label><?php echo app('translator')->get('app.id_image'); ?></label>
                                <img src="<?php echo e($verify->id_img); ?>" style="display:block;">
                            </div>
                            <?php endif; ?>
                            <?php if($verify->address_img): ?>
                            <div class="form-group">
                                <label><?php echo app('translator')->get('app.address_image'); ?></label>
                                <img src="<?php echo e($verify->address_img); ?>" style="display:block;">
                            </div>
                            <div class="form-group">
                                <label>Verify Status</label>
                                <select class="form-control" id="verified" name="verified">
                                    <?php if($verify->verified == 0): ?>
                                    <option value="0" selected="selected">Unverify</option>
                                    <option value="1">Verify</option>
                                    <?php else: ?>
                                    <option value="0">Unverify</option>
                                    <option value="1" selected="selected">Verify</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary" id="update-details-btn">
                                <?php echo app('translator')->get('app.edit_user'); ?>
                            </button>
                            <?php endif; ?>
                            <?php echo Form::close(); ?>

                            <?php else: ?>
                                <p class="text-muted font-weight-light"><em><?php echo app('translator')->get('app.no_activity_from_this_user_yet'); ?></em></p>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        $(function() {
            $('input[name="date"]').datepicker({
                format: 'yyyy-mm-dd',
            });
        });
    </script>
    <?php echo HTML::script('/back/js/as/app.js'); ?>

    <?php echo HTML::script('/back/js/as/btn.js'); ?>

    <?php echo HTML::script('/back/js/as/profile.js'); ?>

    <?php echo JsValidator::formRequest('VanguardLTE\Http\Requests\User\UpdateDetailsRequest', '#details-form'); ?>

    <?php echo JsValidator::formRequest('VanguardLTE\Http\Requests\User\UpdateLoginDetailsRequest', '#login-details-form'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\00work\01casino\canada777\resources\views/backend/user/edit.blade.php ENDPATH**/ ?>