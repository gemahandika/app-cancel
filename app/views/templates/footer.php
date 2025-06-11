<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Your Website 2023</div>
            <div>
                <a href="#">Privacy Policy</a>
                &middot;
                <a href="#">Terms &amp; Conditions</a>
            </div>
        </div>
    </div>
</footer>
</div>
</div>
<!-- jQuery (harus sebelum Select2 JS) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#cabang').select2({
            dropdownParent: $('#modalTambahUser'), // ganti ID dengan ID modal Anda
            width: '100%' // ⬅️ penting!
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="<?= BASE_URL; ?>/js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="<?= BASE_URL; ?>/js/datatables-simple-demo.js"></script>
<script src="https://cdn.datatables.net/2.3.1/js/dataTables.js"></script>
<script src="<?= BASE_URL; ?>/js/custom.js"></script>





<script>
    new DataTable('#example', {
        scrollX: true
    });
</script>

</body>

</html>