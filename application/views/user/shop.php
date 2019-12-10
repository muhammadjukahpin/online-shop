<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row mt-2">
        <?php foreach ($item as $i) : ?>
            <div class="col-md-3 mt-2">
                <div class="card " style="width: 13rem;">
                    <img src="<?= base_url('asset/img/') . $i['image']; ?>" class="card-img-top" alt="image">
                    <div class="card-body">
                        <h5 class="card-title"><?= ucwords($i['name_item']); ?></h5>
                        <h6 class="card-title">Rp.<?= number_format($i['price'], 2, ',', '.'); ?></h6>
                        <a href="#" class="card-link showDes" data-id="<?= $i['id']; ?>">
                            <p class="card-text text-success" data-toggle="modal" data-target="#desModal">Description</p>
                        </a>
                        <small class="mt-1">Seller : <?= $i['name']; ?></small>
                        <a href="https://api.whatsapp.com/send?phone=<?= $i['no_hp']; ?>&text=Nama%20Saya%20<?= $user['name']; ?>%20.Saya%20Mau%20Pesan%20<?= $i['name_item']; ?>,%20Tolong%20Bisa%20Kirim%20sekarang%20ke%20alamat%20saya%20yaitu%20<?= $address['address']; ?>." class=" btn btn-primary mt-1" target="_blank">Buy</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<!-- Modal -->
<div class="modal fade" id="desModal" tabindex="-1" role="dialog" aria-labelledby="desLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="desLabel">Description</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <p class="ml-1 description"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>