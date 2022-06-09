<?php
$this->load->view('admin/template_admin/header');
$this->load->view('admin/template_admin/sidebar');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="bg-white p-4" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px;">
                    <div class="table-responsive">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Sort Mapel</h3>
                            </div>
                            <div class="card-body">
                                <ol id="list" class="list-group mb-4">
                                    <?php foreach ($user as $u) : ?>
                                        <li style="cursor: pointer;" data-id="<?= $u->id_mapel ?>" data-nama_mapel="<?= $u->nama_mapel ?>" data-slug="<?= $u->slug ?>" data-desk="<?= $u->desk ?>" data-tgl_mulai="<?= $u->tgl_mulai ?>" data-tgl_selesai="<?= $u->tgl_selesai ?>" data-image="<?= $u->image ?>" data-id_guru="<?= $u->id_guru ?>" data-semester="<?= $u->id_semester ?>" class="list-group-item"><?= $u->nama_mapel ?> | <?= $u->nama_guru ?> | Semester <?= $u->semester ?></li>
                                    <?php endforeach; ?>
                                </ol>
                                <button id="sort" type="button" class="btn btn-primary">Update Urutan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>
</div>
<?php
$this->load->view('admin/template_admin/footer');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js" integrity="sha512-Eezs+g9Lq4TCCq0wae01s9PuNWzHYoCMkE97e2qdkYthpI0pzC3UGB03lgEHn2XM85hDOUF6qgqqszs+iXU4UA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-sortablejs@latest/jquery-sortable.js"></script>
<script>
    new Sortable(document.getElementById('list'), {});

    $('#sort').click(function() {
        const data = [];
        const data_key = [];

        for (let i = 0; i < $('.list-group-item').length; i++) {
            data.push($('.list-group-item')[i].dataset.id)


            data_key.push({
                id_mapel: $('.list-group-item')[i].dataset.id,
                nama_mapel: $('.list-group-item')[i].dataset.nama_mapel,
                slug: $('.list-group-item')[i].dataset.slug,
                desk: $('.list-group-item')[i].dataset.desk,
                id_guru: $('.list-group-item')[i].dataset.id_guru,
                tgl_mulai: $('.list-group-item')[i].dataset.tgl_mulai,
                tgl_selesai: $('.list-group-item')[i].dataset.tgl_selesai,
                urutan: i + 1,
                image: $('.list-group-item')[i].dataset.image,
                id_semester: $('.list-group-item')[i].dataset.semester,
            })
        }

        $.ajax({
            url: '<?= site_url('admin/update_sort_mapel') ?>',
            method: 'POST',
            data: {
                data,
                data_key
            },
            success: function(res) {
                location.reload();
            },
            error: function() {

            }
        })
        console.log(data);
    })
</script>