<?php $__env->startSection('content'); ?>

<!--Page header-->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title"><?php echo e(session('title')); ?></h4>
    </div>
    <div class="page-rightheader ml-auto d-lg-flex d-none">
        <a class="btn btn-success" href="<?php echo e(route('create.events')); ?>"> Add New Event</a>

    </div>
</div>
<!--End Page header-->

<!-- Row -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">All Events</div>
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
                                <th class="wd-15p border-bottom-0">Author</th>
                                <th class="wd-15p border-bottom-0">TITLE</th>
                                <th class="wd-15p border-bottom-0">starts</th>
                                <th class="wd-15p border-bottom-0">ends</th>
                                <th class="wd-15p border-bottom-0">venue</th>
                                <th class="wd-20p border-bottom-0">main_image</th>
                                 <th class="wd-20p border-bottom-0">other images</th>
                                <th class="wd-15p border-bottom-0">DATE</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($event->id); ?></td>
                                <td><?php echo e($event->user->name); ?></td>
                                <td><?php echo e($event->title); ?></td>
                                <td><?php echo e($event->start); ?></td>
                                <td><?php echo e($event->end); ?></td>
                                <td><?php echo e($event->venue); ?></td>
                                 <td><?php if(is_string($event->main_image)): ?>
                                    <img src="<?php echo e(asset('storage/' . $event->main_image)); ?>" alt="Cover Pic"
                                        class="img-fluid" style="max-width: 80%; max-height: 80%;">
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php $__currentLoopData = $event->images ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(is_string($image)): ?>
                                    <img src="<?php echo e(asset('storage/' . $image)); ?>" alt="Image" class="img-fluid"
                                        style="max-width: 25%; max-height: 30%; border-radius:3px;">
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                </td>
                                <td><?php echo e($event->created_at); ?></td>
                                <td>
                                    <a href="<?php echo e(route('edit.events', $event->id)); ?>" class="btn btn-light mr-2">Edit</a>
                                    <a href="<?php echo e(route('confirm_delete.events', $event->id)); ?>"
                                        class="btn btn-light">Delete</a>
                                    <a href="<?php echo e(route('show.events', $event->id)); ?>" class="btn btn-light">View Event
                                        Details</a>
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/user/Documents/ALL/react/Reachahand_backend/resources/views/events/index.blade.php ENDPATH**/ ?>