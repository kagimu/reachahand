<?php $__env->startSection('content'); ?>

 <div class="col-lg-12">>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Report</h4>
        </div>
        <div class="card-header">
            <a class="btn btn-primary" href="<?php echo e(route('index.reports')); ?>" enctype="multipart/form-data"> Back</a>
        </div>
        <?php if(session('status')): ?>
        <div class="alert alert-success mb-1 mt-1">
        <?php echo e(session('status')); ?>

        </div>
        <?php endif; ?>
        <div class="card-body">
                <form action="<?php echo e(route('update.reports', $report->id)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="form-group">
                        <label for="title" class="form-label">Report Name:</label>
                        <input type="text" name="title" class="form-control" placeholder="" value="<?php echo e(old('title', $report->title)); ?>">
                        <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert alert-danger mt-1 mb-1"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="desc" class="form-label">Brief Description of the report:</label>
                        <textarea name="desc" rows="4" cols="30" id="textarea"><?php echo e(old('desc', $report->desc)); ?></textarea>
                        <?php $__errorArgs = ['desc'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert alert-danger mt-1 mb-1"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <label for="year" class="form-label">Date:</label>
                        <input type="text" name="year" class="form-control" placeholder="" value="<?php echo e(old('year', $report->year)); ?>">
                        <?php $__errorArgs = ['year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert alert-danger mt-1 mb-1"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                <div class="col-md-10">
                    <label for="reports" class="form-label">Update the Report Documents:</label>
                    <input type="file" name="reports[]" id="reports" multiple="multiple" class="form-control">
                    <?php $__errorArgs = ['report'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="alert alert-danger mt-1 mb-1"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-md-10">
                    <label for="image" class="form-label">Update CoverArt:</label>
                    <input type="file" name="image" id="image" class="form-control"/>
                    <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="alert alert-danger mt-1 mb-1"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <button type="submit" class="btn btn-primary mt-4 mb-0">Update Post</button>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/user/Documents/react/Reachahand_backend/resources/views/reports/edit.blade.php ENDPATH**/ ?>