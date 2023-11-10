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
      <h1>My Billings</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
          <li class="breadcrumb-item active">Billings</li>
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
                <p class="text-success"><?php echo $this->session->tempdata('success'); ?></p>
                <?php endif; ?>
                <?php if(validation_errors()): ?>
                <?php echo validation_errors('<p class="text-danger">','</p>'); ?>
                <?php endif; ?>
  	          </div>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Amount Due</th>
                    <th scope="col">Due Date</th>
                    <th scope="col">Meter From</th>
                    <th scope="col">Meter To</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if($my_billings): foreach($my_billings as $bill): ?>
                  <tr>
                    <th scope="row"><?php echo $bill->id; ?></th>
                    <td>₱<?php echo number_format($bill->amount,'2','.',','); ?></td>
                    <td><?php echo $bill->due_date; ?></td>
                    <td><?php echo $bill->meter_from; ?></td>
                    <td><?php echo $bill->meter_to; ?></td>
                    <td><?php if($bill->status == 0){echo '<span class="text-primary">Unpaid</span>';}else if($bill->status == 1){echo '<span class="text-success">Paid</span>';}else{echo '<span class="text-danger">For disconnection</span>';} ?></td>
                    <td>
                      <?php if($bill->status != 1): ?>
                      <a class="btn btn-success" id="pay-bill" data-amount_due="<?php echo $bill->amount; ?>" data-billing_id="<?php echo $bill->id; ?>"><span class="bi">₱</span> Pay Bill</a>
                      <?php endif; ?>
                    </td>
                  </tr>
                  <?php endforeach; endif; ?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>
    <!-- Add user modal -->
    <div class="modal fade" id="payBillModal" tabindex="-1" style="display: none;" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form method="POST" action="" id="pay-bill-form" enctype="multipart/form-data">
            <div class="modal-header bg-primary">
              <h5 class="modal-title text-light">Pay Bill</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row py-2">
                <div class="col-12">
                  <small class="text-danger">* All fields are required</small>
                  <div class="form-group py-2">
                    <label class="form-label" for="amount">Amount Due <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text">₱</span>
                      <input type="number" class="form-control" name="amount" id="amount"/>
                    </div>
                  </div>
                  <div class="form-group py-2">
                    <label class="form-label" for="payment-option">Payment Option <span class="text-danger">*</span></label>
                    <select class="form-control" name="payment_option" id="payment-option" required>
                      <option value="" disabled selected>Select Payment Option</option>
                      <option value="gcash">Gcash</option>
                      <option value="palawan">Palawan</option>
                      <option value="mlhuillier">M Lhuillier</option>
                    </select>
                  </div>
                  <div class="form-group" id="gcash">
                    <p class="text-danger my-0">Please Send Your Payment</p>
                    <p class="text-danger my-0">Name: John R. Doe</p>
                    <p class="text-danger my-0">Gcash: 0927-342-3423</p>
                  </div>
                  <div class="form-group" id="palawan">
                    <p class="text-danger my-0">Please Send Your Payment</p>
                    <p class="text-danger my-0">Name: John R. Doe</p>
                    <p class="text-danger my-0">Contact: 0927-342-3423</p>
                  </div>
                  <div class="form-group py-2">
                    <label class="form-label" for="receipt">Upload Receipt Screenshot/Image <span class="text-danger">*</span></label>
                    <input class="form-control" type="file" id="receipt" name="receipt" required>
                  </div>
                  <div class="form-group py-2">
                    <label class="form-label" for="note">Note <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="note" id="note" placeholder="Add note message."></textarea>
                  </div>
                  <input type="hidden" name="billing_id" id="billing_id" value="">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btn-pay">Pay</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main><!-- End #main -->
<?php include 'inc/footer.php'; ?>
<script type="text/javascript">
  $(document).ready(function() {
    $('#pay-bill').click(function() {
      $('#pay-bill-form').find('#amount').val($(this).data('amount_due'));
      $('#pay-bill-form').find('#billing_id').val($(this).data('billing_id'));
      $('#payBillModal').modal('show');
    });
    $('#payment-option').change(function() {
      if($(this).val() == 'gcash') {
        $('#gcash').show();
      } else if($(this).val() == 'palawan') {
        $('#palawan').show();
      }
    });
    $('#amount').keyup(function() {
      var amount = $(this).val();
      var amount_to_pay = $('#pay-bill').data('amount_due');
      if(amount < amount_to_pay) {
        $(this).css('border','1px solid red');
        $('.btn-pay').attr('disabled','true');
      } else {
        $(this).removeAttr('style');
        $('.btn-pay').removeAttr('disabled');
      }
    });
  });
</script>