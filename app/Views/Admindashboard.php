
<div style="position: absolute; top: 20px; right: 20px;">
    <a href="<?= base_url('/logout'); ?>" class="btn btn-danger btn-lg">Logout</a>
</div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Customer Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($clients)): ?>
                <?php foreach ($clients as $client): ?>
                    <tr id="row-<?= $client['id']; ?>">
                        <td><?= esc($client['id']); ?></td>
                        <td><?= esc($client['fullname']); ?></td>
                        <td><?= esc($client['email']); ?></td>
                        <td><?= esc($client['age']); ?></td>
                        <td><?= esc($client['gender']); ?></td>
                        <td><?= esc($client['customer_type']); ?></td>
                        <td>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="<?= $client['id']; ?>">
                                Delete
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="7" class="text-center">No active clients found</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

<script>
$(document).on('click', '.delete-btn', function() {
    if (!confirm('Are you sure you want to deactivate this client?')) return;

    let id = $(this).data('id');

    $.ajax({
        url: '<?= base_url('delete'); ?>/' + id,
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                alert(response.message);
                $('#row-' + id).fadeOut();
            } else {
                alert(response.message);
            }
        },
        error: function() {
            alert('Server error. Please try again.');
        }
    });
});
</script>

