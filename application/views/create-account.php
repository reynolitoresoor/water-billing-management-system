<?php 
$page_title = "Create Account";
include 'inc/header.php'; ?>
<main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 col-md-8 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto text-light">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block"><?php echo (isset($settings[0]['field']) && $settings[0]['field'] == 'system_name')?$settings[0]['value']:'Water Billing Management System'; ?></span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>
                  <?php echo validation_errors('<p class="text-danger">', '</p>'); ?>
                  <form class="row g-3 needs-validation" method="POST" action="" novalidate>
                    <div class="row">
                      <div class="col-6">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="username" required>
                        <div class="invalid-feedback">Please, enter your username!</div>
                      </div>
                      <div class="col-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email">
                        <div class="invalid-feedback">Please enter valid email address!</div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                        <div class="invalid-feedback">Please enter your password!</div>
                      </div>
                      <div class="col-6">
                        <label for="confirm-password" class="form-label">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" id="confirm-password" required>
                        <div class="invalid-feedback">Please enter your password!</div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6">
                        <label for="first-name" class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control" id="first-name">
                        <div class="invalid-feedback">Please enter your first name!</div>
                      </div>
                      <div class="col-6">
                        <label for="middle-name" class="form-label">Middle Name</label>
                        <input type="text" name="middle_name" class="form-control" id="middle-name">
                        <div class="invalid-feedback">Please enter your middle name!</div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6">
                        <label for="last-name" class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control" id="last-name">
                        <div class="invalid-feedback">Please enter your last name!</div>
                      </div>
                      <div class="col-6">
                        <label for="contact-no" class="form-label">Contact Number</label>
                        <input type="text" name="contact_no" class="form-control" id="contact-no">
                        <div class="invalid-feedback">Please enter your contact number!</div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" name="address" class="form-control" id="address">
                        <div class="invalid-feedback">Please enter your last name!</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="<?php echo base_url(); ?>">Log in</a></p>
                    </div>
                  </form>

                </div>
              </div>
              
            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<?php include 'inc/footer.php'; ?>
