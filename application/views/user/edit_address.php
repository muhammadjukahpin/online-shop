<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-md-6">
            <form action="" method="post">
                <input type="hidden" name="id" id="id" value="<?= $address['id']; ?>">
                <input type="hidden" name="email" id="email" value="<?= $address['email']; ?>">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" value="<?= $address['name']; ?>">
                        <small class="form-text text-danger"><?= form_error('name'); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" id="address" name="address" value=""><?= $address['address']; ?></textarea>
                        <small class="form-text text-danger"><?= form_error('address'); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_hp" class="col-sm-2 col-form-label">No HandPhone</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="no_hp" id="no_hp" value="<?= $address['no_hp']; ?>">
                        <small class="form-text text-danger"><?= form_error('no_hp'); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="label" class="col-sm-2 col-form-label">Label</label>
                    <div class="col-sm-10">
                        <select class="custom-select" id="label" name="label">
                            <?php foreach ($label as $l) : ?>
                                <?php if ($l == $address['label']) : ?>
                                    <option value="<?= $l; ?>" selected><?= $l; ?></option>
                                <?php else : ?>
                                    <option value="<?= $l; ?>"><?= $l; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <small class="form-text text-danger"><?= form_error('label'); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="label" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <select class="custom-select" id="description" name="description" required>
                            <?php foreach ($description as $ds) : ?>
                                <?php if ($ds == $address['description']) : ?>
                                    <option value="<?= $ds; ?>" selected><?= $ds; ?></option>
                                <?php else : ?>
                                    <option value="<?= $ds; ?>"><?= $ds; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <small class="form-text text-danger"><?= form_error('description'); ?></small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group ">
                            <a href="<?= base_url('user/address'); ?>" class="btn btn-primary" type="submit" name="submit" <?php $this->session->unset_userdata('name'); ?>>Back</a>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group float-right">
                            <button class="btn btn-primary" type="submit" name="submit">Edit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->


</div>
<!-- End of Main Content -->