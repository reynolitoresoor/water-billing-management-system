<?php 
$page_title = "Staff";
include 'inc/header.php';
include 'inc/header-nav.php';
?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Staff</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
          <li class="breadcrumb-item active">Staff</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
  	          	<div class="col-lg-6 py-3">
  	          		<a class="btn btn-success" id="add-staff">Add Staff</a>
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
                    <th scope="col">Profile</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact #</th>
                    <th scope="col">Address</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if($staff): foreach($staff as $user): ?>
                  <tr>
                    <th scope="row"><?php echo $user->id; ?></th>
                    <th><img class="rounded-circle" width="50" src="<?php if($user->profile){echo base_url().'uploads/images/'.$user->profile;}else{echo base_url().'uploads/images/profile.png';} ?>"/></th>
                    <td><?php echo $user->last_name.', '.$user->first_name.' '.$user->middle_name; ?></td>
                    <td><?php echo $user->email; ?></td>
                    <td><?php echo $user->contact_no; ?></td>
                    <td><?php echo $user->address; ?></td>
                    <td>
                    	<a onclick="editUser(<?php echo $user->id; ?>)" class="text-success"><i class="bi bi-pencil"></i> Edit</a><br/>
                    	<?php if($this->session->user_type == 1): ?>
                      <a href="<?php echo base_url().'delete/user/'.$user->id; ?>" onclick="if(confirm('Are you sure you want to delete this user?')){return true;}else{return false;}" class="text-danger"><i class="bi bi-trash"></i> Delete</a>
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
    <!-- Add staff modal -->
    <div class="modal fade" id="addStaffModal" tabindex="-1" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form method="POST" action="">
            <div class="modal-header bg-primary">
              <h5 class="modal-title text-light">Add Staff</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label class="form-label" for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" required />
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required />
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="first-name">First Name</label>
                    <input type="text" class="form-control" name="first_name" id="first-name" />
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="last-name">Last Name</label>
                    <input type="text" class="form-control" name="last_name" id="last-name" />
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" />
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="confirm_password">Confirm Password</label>
                    <input type="password" class="form-control" name="confirm_password" id="confirm-password" required/>
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="middle-name">Middle Name</label>
                    <input type="text" class="form-control" name="middle_name" id="middle-name" />
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="contact-no">Contact Number</label>
                    <input type="text" class="form-control" name="contact_no" id="contact-no" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label class="form-label" for="address">Address</label>
                    <input type="text" class="form-control" name="address" id="address" />
                  </div>
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
  <!-- Edit staff modal -->
    <div class="modal fade" id="editStaffModal" tabindex="-1" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form method="POST" action="" id="edit-form">
            <div class="modal-header bg-primary">
              <h5 class="modal-title text-light">Edit Staff</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label class="form-label" for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" required />
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="password">New Password</label>
                    <input type="password" class="form-control" name="password" id="password"/>
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="first-name">First Name</label>
                    <input type="text" class="form-control" name="first_name" id="first-name" />
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="last-name">Last Name</label>
                    <input type="text" class="form-control" name="last_name" id="last-name" />
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" />
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="confirm_password">Confirm Password</label>
                    <input type="password" class="form-control" name="confirm_password" id="confirm-password"/>
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="middle-name">Middle Name</label>
                    <input type="text" class="form-control" name="middle_name" id="middle-name" />
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="contact-no">Contact Number</label>
                    <input type="text" class="form-control" name="contact_no" id="contact-no" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label class="form-label" for="address">Address</label>
                    <input type="text" class="form-control" name="address" id="address" />
                  </div>
                </div>
              </div>
              <input type="hidden" name="staff_id" id="staff-id" value="">
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
    $('#add-staff').click(function() {
      $('#addStaffModal').modal('show');
    });
  })
  function editUser(user_id) {
    $.ajax({
       type: 'POST',
       url: '<?php echo base_url(); ?>requests/get-user/'+user_id,
       success: function(data) {
          if(data) {
            var obj = JSON.parse(data);
            $('#edit-form').find('#username').val(obj[0].username);
            $('#edit-form').find('#email').val(obj[0].email);
            $('#edit-form').find('#first-name').val(obj[0].first_name);
            $('#edit-form').find('#middle-name').val(obj[0].middle_name);
            $('#edit-form').find('#last-name').val(obj[0].last_name);
            $('#edit-form').find('#contact-no').val(obj[0].contact_no);
            $('#edit-form').find('#address').val(obj[0].address);
            $('#edit-form').find('#staff-id').val(obj[0].id);
            $('#editStaffModal').modal('show');
          }
       }
    });
  }
</script>