<?php 
$page_title = "My Billings";
include 'inc/header.php';
include 'inc/header-nav.php';
?>
  <style type="text/css">
    #gcash, #palawan {
      display: none;
    }
  </style>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Receipt</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
          <li class="breadcrumb-item active">Receipt</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
               <div class="row py-3">
                 <?php if($this->session->tempdata('success')): ?>
                  <p class="small text-success"><?php echo $this->session->tempdata('success'); ?></p>
                  <?php endif; ?>
                 <div class="col-6 border py-3">
                   <h1 class="text-center"><?php echo (isset($settings[0]['field']) && $settings[0]['field'] == 'system_name')?$settings[0]['value']:'Water Billing Management System'; ?></h1>
                   <?php foreach($bill as $b): 
                     $date = date_create($b->updated_at);
                   ?>
                   <p class="my-0"><strong>Biller: </strong><?php echo $b->last_name.', '.$b->first_name.' '.$b->middle_name; ?></p>
                   <p class="my-0"><strong>Receipt Number: </strong>#<?php echo str_pad($b->id, 7, "0", STR_PAD_LEFT); ?></p>
                   <p class="my-0"><strong>Amount Paid:</strong> ₱<?php echo number_format($b->paid_amount,2,'.',','); ?></p>
                   <p class="my-0"><strong>Amount Due:</strong> ₱<?php echo number_format($b->amount,2,'.',','); ?></p>
                   <p class="my-0"><strong>Meter From:</strong> <?php echo $b->meter_from; ?></p>
                   <p class="my-0"><strong>Meter To:</strong> <?php echo $b->meter_to; ?></p>
                   <p class="my-0"><strong>Date Paid:</strong> <?php echo date_format($date, 'Y-m-d'); ?></p>
                   <p class="my-0"><strong>Status:</strong> <?php if($b->status == 1){echo '<span class="text-success">Paid</span>';}else if($b->status == 0){echo '<span class="text-primary">Unpaid</span>';} ?></p>
                   <?php endforeach; ?>
                 </div>
               </div>
            </div>
          </div>

        </div>
      </div>
    </section>
  </main><!-- End #main -->
<?php include 'inc/footer.php'; ?>