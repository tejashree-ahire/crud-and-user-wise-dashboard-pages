
        <form method="post" action="<?= base_url('update/' . $user['id']); ?>">
            <div class="mb-3">
                <label>Full Name</label>
                <input type="text" name="fullname" value="<?= esc($user['fullname']); ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" value="<?= esc($user['email']); ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Age</label>
                <input type="number" name="age" value="<?= esc($user['age']); ?>" class="form-control">
            </div>

            <div class="mb-3">
                <label>Gender</label>
                <select name="gender" class="form-control">
                    <option value="Male" <?= $user['gender'] == 'Male' ? 'selected' : ''; ?>>Male</option>
                    <option value="Female" <?= $user['gender'] == 'Female' ? 'selected' : ''; ?>>Female</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Customer Type</label>
                <input type="text" name="customer_type" value="<?= esc($user['customer_type']); ?>" class="form-control" Readonly>
            </div>

            <div class="mb-3">
                <label>Bill No</label>
                <input type="text" name="bill_no" value="<?= esc($user['bill_no']); ?>" class="form-control" Readonly>
            </div>

            <div class="mb-3">
                <label>GIC Policy</label>
                <input type="text" name="gic_policy" value="<?= esc($user['gic_policy']); ?>" class="form-control" Readonly>
            </div>

            <div class="mb-3">
                <label>Goal Name</label>
                <input type="text" name="goal_name" value="<?= esc($user['goal_name']); ?>" class="form-control">
            </div>

            <div class="mb-3">
                <label>LIC Policy</label>
                <input type="text" name="lic_policy" value="<?= esc($user['lic_policy']); ?>" class="form-control" Readonly>
            </div>

            <div class="mb-3">
                <label>Thought Message</label>
                <input type="text" name="thought" value="<?= esc($user['thought']); ?>" class="form-control">
            </div>

            <div class="container mt-4">
    <div class="row text-center">
        <div class="col-md-6">
            <button type="submit" class="btn btn-success btn-lg w-100 py-2">
                Save Changes
            </button>
        </div>
        <div class="col-md-6">
            <button type="button" class="btn btn-secondary btn-lg w-100 py-2"
                onclick="window.location.href='<?= base_url('/dashboard'); ?>'">
                Cancel
            </button>
        </div>
    </div>
</div>

            <br>

        </form>
    </div>
</div>
</body>

