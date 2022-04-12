<div class="col-md-6">
    <div class="form-group">
        <label><?php echo app('translator')->get('app.username'); ?></label>
        <input type="text" class="form-control" id="username" name="username" value="<?php echo e(old('username')); ?>">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label><?php echo app('translator')->get('app.email'); ?></label>
        <input type="text" class="form-control" id="email" name="email" value="<?php echo e(old('email')); ?>">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label><?php echo app('translator')->get('app.first_name'); ?></label>
        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo e(old('first_name')); ?>">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label><?php echo app('translator')->get('app.last_name'); ?></label>
        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo e(old('last_name')); ?>">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label><?php echo app('translator')->get('app.date_of_birth'); ?></label>
        <input type="text" class="form-control" id="birthday" name="birthday" value="<?php echo e(old('birthday')); ?>">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label><?php echo app('translator')->get('app.phone'); ?></label>
        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo e(old('phone')); ?>">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label><?php echo app('translator')->get('app.country'); ?></label>
        <?php echo Form::select('country', $countries, 36,
            ['class' => 'form-control', 'id' => 'country', '']); ?>

    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label><?php echo app('translator')->get('app.address'); ?></label>
        <input type="text" class="form-control" id="address" name="address" value="<?php echo e(old('address')); ?>">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label><?php echo app('translator')->get('app.postal_code'); ?></label>
        <input type="text" class="form-control" id="postalCode" name="postalCode" value="<?php echo e(old('postalCode')); ?>">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label><?php echo app('translator')->get('app.currency'); ?></label>
        <?php echo Form::select('currency', $currencies, '',
            ['class' => 'form-control', 'id' => 'currency', '']); ?>

    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label><?php echo app('translator')->get('app.lang'); ?></label>
        <input type="text" class="form-control" id="language" name="language" value="<?php echo e(old('language')); ?>">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label><?php echo app('translator')->get('app.status'); ?></label>
        <?php echo Form::select('status', $statuses, '',
            ['class' => 'form-control', 'id' => 'status', '']); ?>

    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label><?php echo app('translator')->get('app.role'); ?></label>
        <?php echo Form::select('role_id', $roles, '',
            ['class' => 'form-control', 'id' => 'role_id', '']); ?>

    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label><?php echo e(trans('app.password')); ?></label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label><?php echo e(trans('app.confirm_password')); ?></label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label><?php echo app('translator')->get('app.shop'); ?></label>
        <?php echo Form::select('shop', $shops, '',
            ['class' => 'form-control', 'id' => 'shop', '']); ?>

    </div>
</div><?php /**PATH E:\00work\01casino\canada777\resources\views/backend/user/partials/create.blade.php ENDPATH**/ ?>