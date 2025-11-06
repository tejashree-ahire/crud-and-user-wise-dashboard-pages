<div class="container mt-4">
  <h3>Customer Registration</h3>
  <form id="registerForm" name="registerForma" method ="POST">
      <?= csrf_field() ?>
    <div class="form-group">
      <label>Full Name</label>
      <input type="text" name="fullname" class="form-control" required>
    </div>

    <div class="form-group">
      <label>Age</label>
      <input type="number" name="age" class="form-control" required>
    </div>

    <div class="form-group">
      <label>Gender</label>
      <select name="gender" class="form-control" required>
        <option value="">Select</option>
        <option>Male</option>
        <option>Female</option>
      </select>
    </div>

    <div class="form-group">
      <label>Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>

    <div class="form-group">
      <label>Password</label>
      <input type="password" name="password" class="form-control" required minlength="6">
    </div>

    <div class="form-group">
      <label>Customer Type</label>
      <select name="customer_type" class="form-control" required>
        <option value="">Select</option>
        <option>Admin</option>
        <option>Client</option>
        
      </select>
    </div>
 
    <button type="submit" class="btn btn-primary mt-2">Register</button>

  </form>
  <br>
  <div class="text-end mb-3">
    Alredy have a Account <a href="<?= base_url('login'); ?>" class="btn btn-primary"> Login</a>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(function() {
  $('#registerForm').on('submit', function(e) {
    e.preventDefault();

    $.ajax({
      url: '<?= base_url("register/store") ?>',
      method: 'POST',
      data: $(this).serialize(),
      dataType: 'json',
      success: function(response) {
        if (response.status === 'success') {
          alert(response.message);
          $('#registerForm')[0].reset();
        } else {
          let errors = '';
          $.each(response.errors, function(key, value) {
            errors += value + "\n";
          });
          alert(errors);
        }
      },
      error: function() {
        alert('Something went wrong. Please try again.');
      }
    });
  });
});
</script>
