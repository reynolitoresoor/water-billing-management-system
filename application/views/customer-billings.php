<?php 
$page_title = "Customer Billings";
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
      <h1>Customer Billings</h1>
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
                <div class="col-lg-6 py-3">
                  <a class="btn btn-success" id="add-billing">Add Billing</a>
                </div>
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
                  <?php if($customer_billings): foreach($customer_billings as $bill): ?>
                  <tr>
                    <th scope="row"><?php echo $bill->id; ?></th>
                    <td>₱<?php echo number_format($bill->amount,'2','.',','); ?></td>
                    <td><?php echo $bill->due_date; ?></td>
                    <td><?php echo $bill->meter_from; ?></td>
                    <td><?php echo $bill->meter_to; ?></td>
                    <td><?php if($bill->status == 0){echo '<span class="text-primary">Unpaid</span>';}else if($bill->status == 1){echo '<span class="text-success">Paid</span>';}else{echo '<span class="text-danger">For disconnection</span>';} ?></td>
                    <td>
                        <a onclick="editBilling(<?php echo $bill->id; ?>)" class="text-success"><i class="bi bi-pencil"></i> Edit</a><br/>
                        <?php if($this->session->user_type == 1 || $this->session->user_type == 2): ?>
                        <a href="<?php echo base_url().'delete/bill/'.$bill->id; ?>" onclick="if(confirm('Are you sure you want to delete this user?')){return true;}else{return false;}" class="text-danger"><i class="bi bi-trash"></i> Delete</a>
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
    <div class="modal fade" id="addBillingModal" tabindex="-1" style="display: none;" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form method="POST" action="">
            <div class="modal-header bg-primary">
              <h5 class="modal-title text-light">Add Billing</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row py-2">
                <div class="col-12">
                  <small class="text-danger">* All fields are required</small>
                  <div class="form-group">
                    <label class="form-label" for="customer">Customer <span class="text-danger">*</span></label>
                    <select class="form-control" name="customer" id="customer">
                      <option value="" disabled selected>Select Customer</option>
                      <?php foreach($customers as $customer): ?>
                      <option value="<?php echo $customer->id; ?>"><?php echo ucfirst($customer->last_name).', '.ucfirst($customer->first_name).' '.ucfirst($customer->middle_name); ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="amount">Amount Due <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text">₱</span>
                      <input type="number" class="form-control" name="amount" id="amount" required />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="due-date">Due Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="due_date" id="due-date" required />
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="meter-from">Meter From <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="meter_from" id="meter-from" required/>
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="meter-to">Meter To <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="meter_to" id="meter-to" required />
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main><!-- End #main -->
  <!-- Edit billing modal -->
    <div class="modal fade" id="editBillingModal" tabindex="-1" style="display: none;" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form method="POST" action="" id="edit-form">
            <div class="modal-header bg-primary">
              <h5 class="modal-title text-light">Edit Billing</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row py-2">
                <div class="col-12">
                  <small class="text-danger">* All fields are required</small>
                  <div class="form-group">
                    <label class="form-label" for="customer">Customer <span class="text-danger">*</span></label>
                    <select class="form-control" name="customer" id="customer">
                      <option value="" disabled selected>Select Customer</option>
                      <?php foreach($customers as $customer): ?>
                      <option value="<?php echo $customer->id; ?>"><?php echo ucfirst($customer->last_name).', '.ucfirst($customer->first_name).' '.ucfirst($customer->middle_name); ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="amount">Amount Due <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text">₱</span>
                      <input type="number" class="form-control" name="amount" id="amount" required />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="due-date">Due Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="due_date" id="due-date" required />
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="meter-from">Meter From <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="meter_from" id="meter-from" required/>
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="meter-to">Meter To <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="meter_to" id="meter-to" required />
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="status">Status</label>
                    <select class="form-control" name="status" id="status">
                      <option value="0">Unpaid</option>
                      <option value="1">Paid</option>
                      <option value="2">For Disconnection</option>
                    </select>
                  </div>
                  <input type="hidden" name="billing_id" id="billing_id" value="">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php include 'inc/footer.php'; ?>
<script type="text/javascript">
  $(document).ready(function() {
    $('#add-billing').click(function() {
      $('#addBillingModal').modal('show');
    });
  });

  function editBilling(billing_id) {
    $.ajax({
       type: 'POST',
       url: '<?php echo base_url(); ?>requests/get-bill/'+billing_id,
       success: function(data) {
          if(data) {
            var obj = JSON.parse(data);
            $('#edit-form').find('#customer').val(obj[0].user_id);
            $('#edit-form').find('#amount').val(obj[0].amount);
            $('#edit-form').find('#due-date').val(obj[0].due_date);
            $('#edit-form').find('#meter-from').val(obj[0].meter_from);
            $('#edit-form').find('#meter-to').val(obj[0].meter_to);
            $('#edit-form').find('#status').val(obj[0].status);
            $('#edit-form').find('#billing_id').val(obj[0].id);
            $('#editBillingModal').modal('show');
          }
       }
    });
  }
</script>