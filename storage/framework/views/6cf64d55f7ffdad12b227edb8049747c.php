<?php $__env->startSection('content'); ?>


<!-- End Row-->

<div class="col-lg-12">>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Partner</h4>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="<?php echo e(route('index.partners')); ?>"> Back</a>
        </div>
        <?php if(session('status')): ?>
        <div class="alert alert-success mb-1 mt-1">
            <?php echo e(session('status')); ?>

        </div>
        <?php endif; ?>
        <div class="card-body">
            <form action="<?php echo e(route('store.partners')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="partner_name" class="form-label">Partner's Name:</label>
                    <input type="text" name="partner_name" class="form-control" placeholder="">
                    <?php $__errorArgs = ['partner_name'];
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
                    <label for="partner_category" class="form-label">Category of Partner:</label>
                    <input type="text" name="partner_category" class="form-control">
                    <?php $__errorArgs = ['partner_category'];
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
                    <label for="desc" class="form-label">Description:</label>
                    <textarea name="desc" rows="4" cols="30" class="form-control tinymce-editor" required></textarea>
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
                <div class="col-md-10">
                    <label for='cover_pic' class="form-label">Select Cover Picture of the Partner:</label>
                    <input type="file" name="cover_pic" id="cover_pic" class="form-control" />
                    <?php $__errorArgs = ['cover_pic'];
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
                    <label for="programs_supported_images" class="form-label">Upload other Images about the
                        Partner:</label>
                    <input type="file" name="programs_supported_images[]" id="programs_supported_images"
                        multiple="multiple" class="form-control">
                    <?php $__errorArgs = ['programs_supported_image'];
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



                <button type="submit" class="btn btn-primary mt-1 mb-0">Create Partner</button>

            </form>
        </div>
    </div>
</div>

<!-- End Row -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/user/Documents/react/Reachahand_backend/resources/views/partners/create.blade.php ENDPATH**/ ?>