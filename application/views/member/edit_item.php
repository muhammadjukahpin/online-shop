<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-md-5">
            <?php echo form_open_multipart(); ?>
            <input type="hidden" name="id" id="id" value="<?= $item['id']; ?>">
            <input type="hidden" name="email" id="email" class="form-control" value="<?= $this->session->userdata('email'); ?>">
            <input type="hidden" name="name" id="name" class="form-control" value="<?= $user['name']; ?>">
            <div class="form-group">
                <label for="no_hp">No HandPhone</label>
                <div class="row">
                    <div class="col-md-3">
                        <input class="form-control" type="text" value="+62" readonly>
                    </div>
                    <div class="col-md">
                        <input type="number" name="no_hp" id="no_hp" class="form-control" value="<?= $item['no_hp']; ?>">
                    </div>
                </div>
                <small class="form-text text-danger"><?= form_error('no_hp'); ?></small>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" name="category" id="category" class="form-control" value="<?= $item['category']; ?>">
                <small class="form-text text-danger"><?= form_error('category'); ?></small>
            </div>
            <div class="form-group">
                <label for="name_item">Name Item</label>
                <input type="text" name="name_item" id="name_item" class="form-control" value="<?= $item['name_item']; ?>">
                <small class="form-text text-danger"><?= form_error('name_item'); ?></small>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" value="<?= $item['price']; ?>" class="form-control">
                <small class="form-text text-danger"><?= form_error('price'); ?></small>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea type="text" class="form-control" id="description" name="description"><?= $item['description']; ?></textarea>
                <small class="form-text text-danger"><?= form_error('description'); ?></small>
            </div>
            <label for="image">Image</label>
            <div class="row">
                <div class="col-md-4">
                    <img class="img-thumbnail" src="<?= base_url('asset/img/') . $item['image']; ?>" alt="profile">
                </div>
                <div class="col-md">
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" name="image" id="image" class="custom-file-input">
                            <label for="image" class="custom-file-label">Choose file</label>
                        </div>
                        <?= form_error('image', '<small class="text-danger ">', '</small>'); ?>
                        <small class="form-text text-danger"><?= $this->session->flashdata('message'); ?></small>
                    </div>
                </div>
            </div>
            <div class="form-group mt-3">
                <a href="<?= base_url('member'); ?>" type="submit" name="submit" class="btn btn-primary">Back</a>
                <button type="submit" name="submit" class="btn btn-primary float-right">Edit Item</button>
            </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->