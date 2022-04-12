

<?php $__env->startSection('page-title', trans('app.free_play')); ?>
<?php $__env->startSection('page-heading', trans('app.free_play')); ?>

<?php $__env->startSection('content'); ?>

	<section class="content-header">
		<?php echo $__env->make('backend.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</section>

	<section class="content">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo app('translator')->get('app.free_play'); ?></h3>
			</div>
            <div class="box-body">
                <div class="table-responsive" >
                    <table class="table table-bordered table-striped" id="free_play_table">
					<thead>
					<tr>
						<th><?php echo app('translator')->get('app.id'); ?></th>
						<th><?php echo app('translator')->get('app.email'); ?></th>
						<th><?php echo app('translator')->get('app.visitor_id'); ?></th>
					</tr>
					</thead>
					<tbody>
					<?php if(count($freeplay_users)): ?>
						<?php $__currentLoopData = $freeplay_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php echo $__env->make('backend.freeplay.item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php else: ?>
						<tr><td colspan="9"><?php echo app('translator')->get('app.no_data'); ?></td></tr>
					<?php endif; ?>
					</tbody>
					<thead>
					<tr>
					<th><?php echo app('translator')->get('app.id'); ?></th>
						<th><?php echo app('translator')->get('app.email'); ?></th>
						<th><?php echo app('translator')->get('app.visitor_id'); ?></th>
					</tr>
					</thead>
                    </table>
                </div>
            </div>
		</div>
	</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
	<script>
		$('#free_play_table').dataTable();
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\00work\01casino\canada777\resources\views/backend/freeplay/list.blade.php ENDPATH**/ ?>