<div class="row">
	<div class="col-12">
		<?php if($errors->any()): ?>
		<div class="alert alert-danger alert-dismissible bg-danger text-white mb-0 mt-4 border-0 fade show" role="alert">
		    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		        <span aria-hidden="true">×</span>
		    </button>
	    	<?php $__empty_1 = true; $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
	    		<?php echo e($error); ?> </br>
	    	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
	    	<?php endif; ?>
		</div>
		<?php endif; ?>

		<?php if( session('error') ): ?>
		<div class="alert alert-danger alert-dismissible bg-danger text-white mb-0 mt-4 border-0 fade show" role="alert">
		    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		        <span aria-hidden="true">×</span>
		    </button>
		    <?php echo session('error'); ?>

		</div>
		<?php endif; ?>

		<?php if( session('success') ): ?>
		<div class="alert alert-success alert-dismissible bg-success text-white mb-0 mt-4 border-0 fade show" role="alert">
		    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		        <span aria-hidden="true">×</span>
		    </button>
		    <?php echo session('success'); ?>

		</div>
		<?php endif; ?>
	</div>
</div>