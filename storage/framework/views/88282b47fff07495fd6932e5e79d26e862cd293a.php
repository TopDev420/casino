
<?php $__env->startSection('content'); ?>
<div class="navigation-sibling">
    <div class="layout-column layout-column-1">
        <div class="portlet-dropzone portlet-column-content fn-portlet-container column-1">
            <div class="portlet portlet_name_update-my-details portlet-wrapper fn-portlet-wrapper portlet-boundary portlet-boundary_updatemydetails_WAR_accountportlet_ portlet-update-my-details portlet_type_border">
                <div class="portlet-title fn-portlet-title">
                    <span class="fn-portlet-title-region portlet-title__text-wrapper"><span class="portlet-title-text">Personal details</span></span>
                </div>
                <div class="fn-portlet portlet__content portlet__content_border_show portlet__content_type_update-my-details ">
                    <form action="/profile/details/update" class="form form_name_update-details" id="update-details" novalidate="" method="post">
                    <?php echo csrf_field(); ?>
                        <div class="form-messages fn-form-messages"></div>
                        <div class="form__fieldset">
                            <div class="field field_name_name">
                                <div class="field__label"><label for="username">Name</label></div>
                                <div class="field__control"><input type="text" value="<?php echo e($user->username); ?>" name="username" disabled></div>
                            </div>
                            <div class="field field_name_country fn-validate text">
                                <div class="field__label"><label for="country">Country</label></div>
                                <div class="field__control"><input type="text" value="<?php echo e($user->country); ?>" name="country" id="country" disabled></div>
                            </div>
                            <div class="field field_name_city fn-validate text" data-validation-type="city">
                                <div class="field__label"><label for="city">City</label></div>
                                <div class="field__control"><input type="text" value="<?php echo e($user->city); ?>" name="city" id="city" disabled=""></div>
                            </div>
                            <div class="field field_name_zip fn-validate text" data-validation-type="zip">
                                <div class="field__label"><label for="postalCode">Postal Code</label></div>
                                <div class="field__control"><input type="text" value="<?php echo e($user->postalCode); ?>" name="postalCode" id="postalCode" disabled=""></div>
                            </div>
                            <div class="field field_name_phone fn-validate tel" data-validation-type="phoneWithArea">
                                <div class="field__label"><label for="phone">Cell phone</label></div>
                                <div class="field__control"><input name="phone" type="tel" value="<?php echo e($user->phone); ?>" id="phone" onchange="enableButton();"></div>
                            </div>
                            <div class="field field_name_email fn-validate email" data-validation-type="registerEmail">
                                <div class="field__label"><label for="email">Email</label></div>
                                <div class="field__control"><input name="email" type="email" value="<?php echo e($user->email); ?>" id="email" disabled=""></div>
                            </div>
                        </div>
                        <div class="form__actions"><button type="submit" class="btn" name="updatedetail" disabled>Update details</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.Default.user.profile', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\00work\01casino\canada777\resources\views/frontend/Default/user/detail.blade.php ENDPATH**/ ?>