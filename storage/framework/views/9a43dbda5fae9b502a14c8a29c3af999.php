<?php $__env->startSection('content'); ?>

<!--Page header-->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title"><?php echo e(session('title')); ?></h4>
    </div>
</div>
<!--End Page header-->
<div class="row">

    <div class="col-lg-12">
        <div class="p-4 bg-light border border-bottom-0 mg-t-20">
            <div class="modal d-block pos-static">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body text-center p-4">
                            <i class="fe fe-x-circle fs-100 text-danger lh-1 mb-4 d-inline-block"></i>
                            <h4 class="text-danger mb-20">Delete Program</h4>
                            <p class="mb-4 mx-4">Are you sure you would like to delete this Program entirely?</p>

                            <?php if($program): ?>
                            <form action="<?php echo e(route('deleteProgram.programs')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <a href="<?php echo e(route('index.programs')); ?>" class="btn btn-primary pd-x-25">Cancel</a>
                                <button class="btn btn-danger pd-x-25" type="submit">Yes, Delete</button>
                            </form>
                            <?php else: ?>
                            <p>This program does not exist.</p>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- End Row -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/user/Documents/react/Reachahand_backend/resources/views/programs/confirm_delete.blade.php ENDPATH**/ ?>