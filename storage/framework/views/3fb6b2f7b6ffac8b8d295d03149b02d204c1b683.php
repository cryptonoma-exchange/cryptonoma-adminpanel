<?php
$atitle ="kycview";
?>

<?php $__env->startSection('title', 'Users List - Admin'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>KYC Submits</h1>
    </header>
    <?php if(session('status')): ?>
        <div class="alert alert-success">
          <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>
    <div class="card">
      <div class="card-body">
        <a href="<?php echo e(url('admin/kyc')); ?>"><i class="zmdi zmdi-arrow-left"></i> Back to KYC Submit</a>
        <br />
        <br />
        <form method="POST" action="<?php echo e(url('admin/kycupdate')); ?>" id="theform">
        <?php echo e(csrf_field()); ?>

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>First Name</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="fromaddress" class="form-control" value="<?php echo e($kyc->fname); ?>" readonly>
                <i class="form-group__bar"></i> </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Last Name</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="fromaddress" class="form-control" value="<?php echo e($kyc->lname); ?>" readonly>
                <i class="form-group__bar"></i> </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Date of Birth</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="fromaddress" class="form-control" value="<?php echo e($kyc->dob); ?>" readonly>
                <i class="form-group__bar"></i> </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>State/City</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="fromaddress" class="form-control" value="<?php echo e($kyc->city); ?>" readonly>
                <i class="form-group__bar"></i> </div>
            </div>
          </div>
          <!-- <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Country</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="fromaddress" class="form-control" value="<?php echo e($kyc->country); ?>" readonly>
                <i class="form-group__bar"></i> </div>
            </div>
          </div>
           <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Nationality</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="fromaddress" class="form-control" value="<?php echo e($kyc->nationality); ?>" readonly>
                <i class="form-group__bar"></i> </div>
            </div>
          </div>

        

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Zip Code</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="zipcode" class="form-control" value="<?php echo e($kyc-> zipcode ? $kyc->  zipcode :'-'); ?>" readonly>
                <i class="form-group__bar"></i> </div>
            </div>
          </div> -->

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Address</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="address" class="form-control" value="<?php echo e($kyc->address ? $kyc->address :'-'); ?>" readonly>
                <i class="form-group__bar"></i> </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>ID Type</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="fromaddress" class="form-control" value="<?php echo e($kyc->id_type == "Driving Licence" ? "Driver's Licence" : $kyc->id_type); ?>" readonly>
                <i class="form-group__bar"></i> </div>
            </div>
          </div>

     <?php if($kyc->id_type =='Other'): ?>
           <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Other Type</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
        
                <input type="text" name="fromaddress" class="form-control" value="<?php echo e($kyc->other_type); ?>" readonly>
                <i class="form-group__bar"></i> </div>
            </div>
          </div>
          <?php endif; ?>

            <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>ID Document Number</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="fromaddress" class="form-control" value="<?php echo e($kyc->id_number); ?>" readonly>
                <i class="form-group__bar"></i> </div>
            </div>
          </div>
          <?php if($kyc->id_type != "National ID"): ?>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>ID Expiry Date</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="fromaddress" class="form-control" value="<?php echo e($kyc->id_exp); ?>" readonly>
                <i class="form-group__bar"></i> </div>
            </div>
          </div> 
          <?php endif; ?>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>ID Front Document</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group"><a target="_blank" href="<?php echo e($kyc->front_img); ?>"><img width="200px" src="<?php echo e($kyc->front_img); ?>"></a> </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>ID Back Document</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group"><a target="_blank" href="<?php echo e($kyc->back_img); ?>"><img width="200px" src="<?php echo e($kyc->back_img); ?>"></a></div>
            </div>
          </div>

              


             <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Address Document</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group"><a target="_blank" href="<?php echo e($kyc->proofpaper); ?>"><img width="200px" src="<?php echo e($kyc->proofpaper); ?>"></a></div>
            </div>
          </div> 

      
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Status</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <?php if($kyc->status == 0): ?> 
                  <select class="form-control" name="status">
                    <option value="0">Waiting</option>
                    <option value="1">Accepted</option>
                    <option value="2">Rejected</option>
                  </select> 
              <?php else: ?>
                 <?php if($kyc->status == 1): ?>
                    Accepted
                 <?php else: ?>
                    Rejected
                 <?php endif; ?>
              <?php endif; ?>
              </div>
            </div>
          </div>

              <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Remark</label>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <?php if($kyc->status == 2): ?>
                <textarea type="text" name="remark" class="form-control"><?php echo e($kyc->remark ? $kyc->remark :' '); ?></textarea>
                <?php else: ?>
                   <textarea type="text" name="remark" class="form-control"><?php echo e($kyc->remark ? $kyc->remark :' '); ?></textarea>
                <?php endif; ?>
                <i class="form-group__bar"></i> </div>
            </div>
          </div>

          <?php if(in_array("write", explode(',',$AdminProfiledetails->kyc))): ?>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>&nbsp;</label>
              </div>
            </div>
            <?php if($kyc->status == 0): ?>
            <div class="col-md-4">
               <input type="hidden" name="kyc_id" value="<?php echo e($kyc->kyc_id); ?>"/>
               <input type="hidden" name="uid" value="<?php echo e($kyc->uid); ?>"/>
               <input type="submit" class="btn btn-md btn-warning" value="Update"> <br /><br />
               <p style="color:black;">Note : Once you accept / reject kyc, You can't update the status again!</p>
            </div>
            <?php endif; ?>
          </div>
          <?php endif; ?>
        </form>
      </div>
    </div>
  </div>
</section>
  <?php $__env->stopSection(); ?>
  
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/hd83s.cryptonoma.com/public_html/resources/views/user/kyc_edit.blade.php ENDPATH**/ ?>