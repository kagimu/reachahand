<?php $__env->startSection('content'); ?>

<!--Page header-->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title"><?php echo e(session('title')); ?></h4>
    </div>
    <div class="page-rightheader ml-auto d-lg-flex d-none">
        <a class="btn btn-success" href="<?php echo e(route('create.opportunities')); ?>"> Create Opportunity</a>

    </div>
</div>
<!--End Page header-->

<!-- Row -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">All Opportunities</div>
            </div>
            <div class="card-body">
                <?php if(Session::has('message')): ?>
                <div class="alert alert-info" role="alert"><button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true"></button>
                    <?php echo e(Session::get('message')); ?>

                </div>
                <?php endif; ?>
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th class="wd-15p border-bottom-0">title</th>
                                <th class="wd-15p border-bottom-0">Deadline</th>
                                <th class="wd-15p border-bottom-0">cover image</th>
                                <th class="wd-15p border-bottom-0">Documents</th>
                                <th class="wd-15p border-bottom-0">DATE</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $opportunities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opportunity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($opportunity->id); ?></td>
                                <td><?php echo e($opportunity->title); ?></td>
                                <td><?php echo e($opportunity->date); ?></td>
                                <td>
                                    <?php if(is_string($opportunity->cover_pic)): ?>
                                    <img src="<?php echo e(asset('storage/' . $opportunity->cover_pic)); ?>" alt="Image"
                                        class="img-fluid" style="max-width: 100%; max-height: 100%;">
                                    <?php endif; ?>

                                </td>
                                <td>
                                    <?php if(is_array($opportunity->documents_url)): ?>
                                    <?php if(count($opportunity->documents_url) > 0): ?>
                                    <a href="<?php echo e(asset($opportunity->documents_url[0])); ?>" target="_blank">
                                        View PDF
                                    </a>
                                    <?php else: ?>
                                    No PDF available
                                    <?php endif; ?>
                                    <?php elseif($opportunity->documents_url): ?>
                                    <a href="<?php echo e(asset($opportunity->documents_url)); ?>" target="_blank">
                                        <strong>View PDF</strong>
                                    </a>
                                    <?php else: ?>
                                    No PDF available
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($opportunity->created_at); ?></td>
                                <td>
                                    <a href="<?php echo e(route('edit.opportunities', $opportunity->id)); ?>"
                                        class="btn btn-light mr-2">Edit</a>
                                    <a href="<?php echo e(route('confirm_delete.opportunities', $opportunity->id)); ?>"
                                        class="btn btn-light">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>

                    </table>
                </div>
                <!-- table-responsive -->
            </div>
        </div>
    </div>
    <!-- End Row -->
    <!--End Page header-->

    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/user/Documents/react/Reachahand_backend/resources/views/opportunities/index.blade.php ENDPATH**/ ?>