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
                                    <?php foreach ($materi as $u) : ?>
                                        <input type="hidden" name="id_mapel" id="id_mapel" value="<?= $u->id_mapel ?>">
                                        <li style="cursor: pointer;" data-id_materi="<?= $u->id_materi ?>" data-id_mapel="<?= $u->id_mapel ?>" data-nama_materi="<?= $u->nama_materi ?>" data-desk_materi="<?= $u->desk_materi ?>" data-created_at="<?= $u->created_at ?>" class="list-group-item"><?= $u->nama_materi ?></li>
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
        const id_mapel = $('#id_mapel').val();;
        const data = [];
        const data_key = [];

        for (let i = 0; i < $('.list-group-item').length; i++) {
            data.push($('.list-group-item')[i].dataset.id_materi)


            data_key.push({
                id_mapel: $('.list-group-item')[i].dataset.id_mapel,
                id_materi: $('.list-group-item')[i].dataset.id_materi,
                nama_materi: $('.list-group-item')[i].dataset.nama_materi,
                deks_materi: $('.list-group-item')[i].dataset.deks_materi,
                urutan: i + 1,
                created_at: $('.list-group-item')[i].dataset.created_at,
            })
        }

        $.ajax({
            url: '<?= site_url('admin/update_sort_materi/') ?>' + id_mapel,
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