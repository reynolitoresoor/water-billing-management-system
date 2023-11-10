<?php 
$page_title = "Profile";
include 'inc/header.php';
include 'inc/header-nav.php';

?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-10">
          <div class="card">
            <div class="card-body">
              <form method="POST" action="" enctype="multipart/form-data">
                <?php if($this->session->tempdata('success')): ?>
                <div class="py-3">
                  <p class="text-success"><?php echo $this->session->tempdata('success'); ?></p>
                </div>
                <?php endif; ?>
                <div class="row py-2">
                  <label for="profile-image" class="col-md-4 col-lg-3 col-form-label">Profile</label>
                  <div class="col-md-8 col-lg-9">
                    <img src="<?php echo !empty($profile[0]->profile)?base_url().'uploads/images/'.$profile[0]->profile:base_url().'uploads/images/profile.png'; ?>" id="profile-image" width="150" height="150" alt="Profile" style="border-radius: 100%;">
                    <input type="file" name="profile" id="profile" hidden onchange="loadFile(event)"/>
                    <div class="pt-2">
                      <a id="upload-profile" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-label" for="first-name">First Name</label>
                      <input type="text" name="first_name" id="first-name" value="<?php echo $profile[0]->first_name; ?>" class="form-control" />
                    </div>
                    <div class="form-group">
                      <label class="form-label" for="last-name">Last Name</label>
                      <input type="text" name="last_name" value="<?php echo $profile[0]->last_name; ?>" id="last-name" class="form-control" />
                    </div>
                    <div class="form-group">
                      <label class="form-label" for="username">Username</label>
                      <input type="text" name="username" value="<?php echo $profile[0]->username; ?>" id="username" class="form-control" />
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-label" for="middle-name">Middle Name</label>
                      <input type="text" name="middle_name" value="<?php echo $profile[0]->middle_name; ?>" id="middle-name" class="form-control" />
                    </div>
                    <div class="form-group">
                      <label class="form-label" for="email">Email</label>
                      <input type="email" name="email" value="<?php echo $profile[0]->email; ?>" id="email" class="form-control" />
                    </div>
                    <div class="form-group">
                      <label class="form-label" for="contact-no">Contact Number</label>
                      <input type="text" name="contact_no" value="<?php echo $profile[0]->contact_no; ?>" id="contact-no" class="form-control" />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label class="form-label" for="address">Address</label>
                      <input type="text" name="address" value="<?php echo $profile[0]->address; ?>" id="address" class="form-control" />
                    </div>
                  </div>
                </div>
                <div class="py-2">
                  <button class="btn btn-primary" type="submit">Submit</button>
                </div>
              </form>
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
<?php include 'inc/footer.php'; ?>
<script>
  $(document).ready(function() {
    $('#upload-profile').click(function() {
       $('#profile').click();
    });
  });
  var loadFile = function(event) {
  var reader = new FileReader();
  reader.onload = function(){
      var output = document.getElementById('profile-image');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };
</script>