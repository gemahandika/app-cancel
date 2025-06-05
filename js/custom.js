document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.btn-edit');
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const resi = this.getAttribute('data-resi');
            const keterangan = this.getAttribute('data-keterangan');

            document.getElementById('edit-id').value = id;
            document.getElementById('edit-resi').value = resi;
            document.getElementById('edit-keterangan').value = keterangan;
        });
    });

    const editButtonsUser = document.querySelectorAll('.btn-editUser');
    editButtonsUser.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const username = this.getAttribute('data-user');
            const name = this.getAttribute('data-name');
            const role = this.getAttribute('data-role');
            const cust_id = this.getAttribute('data-custid');
            const status = this.getAttribute('data-status');

            document.getElementById('edit-id').value = id;
            document.getElementById('edit-username').value = username;
            document.getElementById('edit-name').value = name;
            document.getElementById('edit-custid').value = cust_id;
            document.getElementById('edit-role').value = role;
            document.getElementById('edit-status').value = status;
        });
    });
});
