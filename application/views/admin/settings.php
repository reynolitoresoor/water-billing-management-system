<?php 
$page_title = "Settings";
$this->load->view('inc/header.php',compact('page_title'));
$this->load->view('inc/header-nav.php',compact('page_title'));
?>
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Settings</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
          <li class="breadcrumb-item active">Settings</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
               <form accept="" method="POST">
               	 <div class="py-2">
               	 	<?php if($this->session->tempdata('success')): ?>
	                <p class="text-success"><?php echo $this->session->tempdata('success'); ?></p>
	                <?php endif; ?>
	                <?php if(validation_errors()): ?>
	                <?php echo validation_errors('<p class="text-danger">','</p>'); ?>
	                <?php endif; ?>
               	 </div>
               	 <div class="row py-2">
               	 	<div class="col-lg-6">
               	 	   <div class="form-group">
               	 	   	  <label class="form-label" for="system-name">System Name</label>
               	 	   	  <input class="form-control" name="system_name" id="system-name" value="<?php echo (isset($settings[0]['field']) && $settings[0]['field'] == 'system_name')?$settings[0]['value']:''; ?>" />
               	 	   </div>
               	 	</div>
               	 	<div class="col-lg-6">
               	 		
               	 	</div>
               	 </div>
               	 <div class="py-2">
               	 	<button class="btn btn-primary" type="submit">Save Changes</button>
               	 </div>
               </form>
            </div>
          </div>
        </div>
      </div>
    </section>

</main>
<?php $this->load->view('inc/footer.php'); ?>