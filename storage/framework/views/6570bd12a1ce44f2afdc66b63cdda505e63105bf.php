<div class="box-body box-profile">


    <div class="form-group">
        <label><?php echo app('translator')->get('app.role'); ?></label>
        <?php echo Form::select('role_id', Auth::user()->available_roles( true ), $edit ? $user->role_id : '',
            ['class' => 'form-control', 'id' => 'role_id', 'disabled' => true]); ?>

    </div>

    <div class="form-group">
        <label><?php echo app('translator')->get('app.status'); ?></label>
        <?php echo Form::select('status', $statuses, $edit ? $user->status : '' ,
            ['class' => 'form-control', 'id' => 'status', 'disabled' => ($user->hasRole(['admin']) || $user->id == auth()->user()->id) ? true: false]); ?>

    </div>

    <div class="form-group">
        <label><?php echo app('translator')->get('app.username'); ?></label>
        <input type="text" class="form-control" id="username" name="username" placeholder="(<?php echo app('translator')->get('app.optional'); ?>)" value="<?php echo e($edit ? $user->username : ''); ?>">
    </div>

    <?php if( $user->email != '' ): ?>
    <div class="form-group">
        <label><?php echo app('translator')->get('app.email'); ?></label>
        <input type="email" class="form-control" id="email" name="email" placeholder="(<?php echo app('translator')->get('app.optional'); ?>)" value="<?php echo e($edit ? $user->email : ''); ?>">
    </div>
    <?php endif; ?>
    <div class="form-group">
        <label><?php echo app('translator')->get('app.first_name'); ?></label>
        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="(<?php echo app('translator')->get('app.optional'); ?>)" value="<?php echo e($edit ? $user->first_name : ''); ?>">
    </div>
    <div class="form-group">
        <label><?php echo app('translator')->get('app.last_name'); ?></label>
        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="(<?php echo app('translator')->get('app.optional'); ?>)" value="<?php echo e($edit ? $user->last_name : ''); ?>">
    </div>
    <div class="form-group">
        <label><?php echo app('translator')->get('app.date_of_birth'); ?></label>
        <input type="text" class="form-control" id="birthday" name="birthday" placeholder="(<?php echo app('translator')->get('app.optional'); ?>)" value="<?php echo e(($edit && date('Y', strtotime($user->birthday))>1900) ? date('Y-m-d', strtotime($user->birthday)) : ''); ?>">
    </div>
    <div class="form-group">
        <label><?php echo app('translator')->get('app.phone'); ?></label>
        <input type="text" class="form-control" id="phone" name="phone" placeholder="(<?php echo app('translator')->get('app.optional'); ?>)" value="<?php echo e($edit ? $user->phone : ''); ?>">
    </div>
    <div class="form-group">
        <label><?php echo app('translator')->get('app.country'); ?></label>
        <?php echo Form::select('country', array_pluck($countries, 'country', 'id') , $user->country,
            ['class' => 'form-control', 'id' => 'country']); ?>

    </div>
    <div class="form-group">
        <label><?php echo app('translator')->get('app.address'); ?></label>
        <input type="text" class="form-control" id="address" name="address" placeholder="(<?php echo app('translator')->get('app.optional'); ?>)" value="<?php echo e($edit ? $user->address : ''); ?>">
    </div>
    <div class="form-group">
        <label><?php echo app('translator')->get('app.postal_code'); ?></label>
        <input type="text" class="form-control" id="postalCode" name="postalCode" placeholder="(<?php echo app('translator')->get('app.optional'); ?>)" value="<?php echo e($edit ? $user->postalCode : ''); ?>">
    </div>
    <div class="form-group">
        <label><?php echo app('translator')->get('app.currency'); ?></label>
        <?php echo Form::select('currency', array_pluck($currencies, 'currency', 'id') , $user->currency,
            ['class' => 'form-control', 'id' => 'currency']); ?>

    </div>
    <div class="form-group">
        <label><?php echo app('translator')->get('app.lang'); ?></label>
        <?php echo Form::select('language', $langs, $edit ? $user->language : '', ['class' => 'form-control']); ?>

    </div>

    <div class="form-group">
        <label><?php echo e($edit ? trans("app.new_password") : trans('app.password')); ?></label>
        <input type="password" class="form-control" id="password" name="password" <?php if($edit): ?> placeholder="<?php echo app('translator')->get('app.leave_blank_if_you_dont_want_to_change'); ?>" <?php endif; ?>>
    </div>

    <div class="form-group">
        <label><?php echo e($edit ? trans("app.confirm_new_password") : trans('app.confirm_password')); ?></label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" <?php if($edit): ?> placeholder="<?php echo app('translator')->get('app.leave_blank_if_you_dont_want_to_change'); ?>" <?php endif; ?>>
    </div>

</div>

<div class="box-footer">
    <button type="submit" class="btn btn-primary" id="update-details-btn">
        <?php echo app('translator')->get('app.edit_user'); ?>
    </button>
</div>
<?php /**PATH E:\00work\01casino\canada777\resources\views/backend/user/partials/edit.blade.php ENDPATH**/ ?>