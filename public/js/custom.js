document.addEventListener('DOMContentLoaded', function () {
    // Modal Bootstrap
    const modalTambahUser = new bootstrap.Modal(document.getElementById('modalTambahUser'));
    const modalEditUser = new bootstrap.Modal(document.getElementById('modalEdit'));

    // Inisialisasi Select2 Tambah
    const selectTambah = document.querySelector('#cabang');
    if (selectTambah) {
        $('#cabang').select2({
            dropdownParent: $('#modalTambahUser'),
            width: '100%'
        });
    }

    // Inisialisasi Select2 Edit
    if ($('#cabang-edit').length) {
        $('#cabang-edit').select2({
            dropdownParent: $('#modalEdit'),
            width: '100%'
        });
    }

    // Tombol Edit User (gunakan event delegation karena pakai DataTables)
   $(document).on('click', '.btn-editUser', function () {
    // Tutup semua modal jika masih ada yang terbuka
    $('.modal').modal('hide');

    // Ambil data
    const id = $(this).data('id');
    const username = $(this).data('user');
    const name = $(this).data('name');
    const cabang = $(this).data('cabang');
    const custid = $(this).data('custid');
    const role = $(this).data('role');
    const status = $(this).data('status');

    // Isi data ke form
    $('#edit-id').val(id);
    $('#edit-username').val(username);
    $('#edit-name').val(name);
    $('#edit-custid').val(custid);
    $('#edit-role').val(role);
    $('#edit-status').val(status);
    $('#cabang-edit').val(cabang).trigger('change');

    // Tampilkan modal edit
    const modal = new bootstrap.Modal(document.getElementById('modalEdit'));
    modal.show();
});

});
