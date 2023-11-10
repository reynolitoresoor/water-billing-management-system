<?php 
$page_title = "Login";
include 'inc/header.php'; ?>
  <main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto text-center">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block"><?php echo (isset($settings[0]['field']) && $settings[0]['field'] == 'system_name')?$settings[0]['value']:'Water Billing Management System'; ?></span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                    <?php if($this->session->tempdata('success')): ?>
                    <p class="text-center small text-success"><?php echo $this->session->tempdata('success'); ?></p>
                    <?php endif; ?>
                  </div>
                  <form class="row g-3 needs-validation" action="" method="POST" novalidate>

                    <div class="col-12">
                      <label for="username" class="form-label">Username</label>
                      <input type="text" name="username" class="form-control" id="username" required>
                      <div class="invalid-feedback">Please enter your username.</div>
                    </div>

                    <div class="col-12">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="password" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Don't have account? <a href="<?php echo base_url().'create-account'; ?>">Create an account</a></p>
                    </div>
                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main>
<?php include 'inc/footer.php'; ?>