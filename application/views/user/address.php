<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-md-5">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col md-5">
            <a href="#" class="btn btn-primary showAddress" data-toggle="modal" data-target="#addNewAddressModal">Add New Address</a>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-sm">

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">No HP</th>
                        <th scope="col">Address</th>
                        <th scope="col">Label</th>
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($address) : ?>
                        <?php $i = 0;
                            foreach ($address as $a) : ?>
                            <tr>
                                <th scope="row"><?= ++$i; ?></th>
                                <td scope="row"><?= $a['name']; ?></td>
                                <td scope="row"><?= $a['no_hp']; ?></td>
                                <td><?= $a['address']; ?></td>
                                <td scope="row"><?= $a['label']; ?></td>
                                <td scope="row"><?= $a['description']; ?></td>
                                <td>
                                    <a href="<?= base_url('user/editaddress/') . $a['id']; ?>" class="badge badge-success showEditAddress" data-id="<?= $a['id']; ?>">Edit</a>
                                    <a href="<?= base_url('user/delAddress'); ?>/<?= $a['id']; ?>" class="badge badge-danger " onclick="return confirm('are you sure?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>

<!-- Modal -->
<div class="modal fade" id="addNewAddressModal" tabindex="-1" role="dialog" aria-labelledby="addNewAddressLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewAddressLabel">Add New Address</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('user/addAddress'); ?>" method="post">
                    <input type="hidden" id="id" name="id">
                    <input type="hidden" id="email" name="email" value="<?= $this->session->userdata('email'); ?>">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" required>
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="Enter Number HandPhone" required>
                    </div>
                    <div class="form-group">
                        <select class="custom-select" id="label" name="label" required>
                            <option>Label</option>
                            <option value="Home">Home</option>
                            <option value="Office">Office</option>
                            <option value="Apartement">Apartement</option>
                            <option value="Hotel">Hotel</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="custom-select" id="description" name="description" required>
                            <option>Description</option>
                            <option value="First Address">First Address</option>
                            <option value="Temporary Address">Temporary Address</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-primary">Add Address</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->