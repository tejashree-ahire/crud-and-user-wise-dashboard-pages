
<!-- <h2 class="mb-4 text-center">Welcome, <?php //echo($user['fullname']); ?> 👋</h2> -->
<div style="position: absolute; top: 20px; right: 20px;">
    <a href="<?= base_url('/logout'); ?>" class="btn btn-danger btn-lg">Logout</a>
</div>

<table class="table table-bordered">
    <tr>
        <th>Full Name</th>
        <td><?= esc($user['fullname']); ?></td>
    </tr>
    <tr>
        <th>Email</th>
        <td><?= esc($user['email']); ?></td>
    </tr>
    <tr>
        <th>Age</th>
        <td><?= esc($user['age']); ?></td>
    </tr>
    <tr>
        <th>Gender</th>
        <td><?= esc($user['gender']); ?></td>
    </tr>
    <tr>
        <th>Customer Type</th>
        <td><?= esc($user['customer_type']); ?></td>
    </tr>
    <tr>
        <th>Bill No </th>
        <td><?= esc($user['bill_no']); ?></td>
    </tr>
    <!-- other coloums -->
      <tr>
        <th>GIC Policy</th>
        <td><?= esc($user['gic_policy']); ?></td>
    </tr>
     <tr>
        <th>Goal Name</th>
        <td><?= esc($user['goal_name']); ?></td>
    </tr>
     <tr>
        <th>LIC Policy</th>
        <td><?= esc($user['lic_policy']); ?></td>
    </tr>
     <tr>
        <th>Thought Message</th>
        <td><?= esc($user['thought']); ?></td>
    </tr>
</table>


<div class="text-center mt-4">
    <a href="<?= base_url('edit/' . $user['id']); ?>" class="btn btn-success  ms-2">Edit Profile</a>
</div>
<br>

       