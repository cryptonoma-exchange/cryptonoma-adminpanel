<?php
$atitle ="subscriber";
?>

<?php $__env->startSection('title', 'Subscriber - Admin'); ?>
<?php $__env->startSection('content'); ?>

<section class="content">
  <header class="content__title">
    <h1>Subscriber List</h1>
  </header>
  

  <?php if($message = Session::get('status')): ?>
  <div class="alert alert-success alert-block">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong><?php echo e($message); ?></strong> </div>
  <?php endif; ?>
    
    <div class="card">
      <div class="card-body">


        <div class="table-responsive search_result">
          <table class="table downloaddatas" id="subscriber">
              <thead>
              <tr>
              <tr>
              <th>S.No</th>
              <th>Email</th>                 
              <th>Date/Time</th> 
                 <?php if(in_array("delete", explode(',',$AdminProfiledetails->subscribe))): ?> 
              <th>Delete</th>  
              <?php endif; ?>
              </tr>
              </tr>
              </thead>

                <tbody>
                <?php if(count($listall) > 0): ?>

                <?php
                $limit = 15; 
                if(isset($_GET['page'])){
                $page = $_GET['page'];
                $i = (($limit * $page) - $limit)+1;
                }else{
                $i =1;
                }
                ?>

                <?php $__currentLoopData = $listall; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $results): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                <td><?php echo e($i); ?></td>
                <td><?php echo e($results->email); ?></td>
                <td><?php echo e($results->created_at); ?></td>
                 <?php if(in_array("delete", explode(',',$AdminProfiledetails->subscribe))): ?>
                <td>
                  <a class="btn btn-success btn-xs" href="<?php echo e(url('/admin/subscriberdelete/'.Crypt::encrypt($results->id))); ?>">Remove </a>
                </td>
                <?php endif; ?>

                </tr>
                <?php $i++ ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                <?php else: ?>
                <tr><td colspan="4">No records found</td></tr>
                <?php endif; ?>    
                </tbody>
          </table>
          <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
          <div class="pagination-tt clearfix">
          <?php if($listall->count()): ?>
          <?php echo e($listall->links()); ?>

          <?php endif; ?>
          </div>
          </div>
     </div>
   </div>
 </div>


 <?php $__env->stopSection(); ?>



 
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/hd83s.cryptonoma.com/public_html/resources/views/subscriber/subscriber.blade.php ENDPATH**/ ?>