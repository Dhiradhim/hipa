<script type="text/javascript">
    // Escaping nilai dinamis dari API agar tidak terjadi DOM-based XSS.
    function esc(v) {
        var amp = String.fromCharCode(38, 97, 109, 112, 59); // &
        var lt = String.fromCharCode(38, 108, 116, 59); // <
        var gt = String.fromCharCode(38, 103, 116, 59); // >
        var quot = String.fromCharCode(38, 113, 117, 111, 116, 59); // "
        var apos = String.fromCharCode(38, 35, 51, 57, 59); // '
        var map = {
            '&': amp,
            '<': lt,
            '>': gt,
            '\u0022': quot,
            '\u0027': apos
        };
        return String(v).replace(/[&<>\u0022\u0027]/g, function(ch) {
            return map[ch];
        });
    }

    // Muat daftar provinsi ke sebuah <select>.
    function loadProvinsi($sel) {
        $sel.html('<option value="">Pilih Provinsi</option>');
        $.ajax({
            url: 'get_prov.php',
            type: 'GET',
            dataType: 'json',
            success: function(result) {
                for (var i = 0; i < result.length; i++)
                    $sel.append('<option value="' + esc(result[i].prop_name) + '">' + esc(result[i].prop_name) + '</option>');
            }
        });
    }

    // Inisialisasi satu blok domisili (provinsi/kabupaten/kecamatan/kelurahan).
    function initLokasi($item) {
        var $prov = $item.find('.lokasi-provinsi');
        var $kab = $item.find('.lokasi-kabupaten');
        var $kec = $item.find('.lokasi-kecamatan');
        var $kel = $item.find('.lokasi-kelurahan');

        $kab.html('<option value="">Pilih Kabupaten</option>');
        $kec.html('<option value="">Pilih Kecamatan</option>');
        $kel.html('<option value="">Pilih Kelurahan</option>');

        loadProvinsi($prov);
    }

    // Handler terdelegasi: berlaku untuk semua blok domisili, termasuk yang ditambah dinamis.
    $(document).on('change', '.lokasi-provinsi', function() {
        var $item = $(this).closest('.tergugat-item');
        var prop_name = $(this).val();
        var $kab = $item.find('.lokasi-kabupaten');
        var $kec = $item.find('.lokasi-kecamatan');
        var $kel = $item.find('.lokasi-kelurahan');

        $kab.html('<option value="">Pilih Kabupaten</option>');
        $kec.html('<option value="">Pilih Kecamatan</option>');
        $kel.html('<option value="">Pilih Kelurahan</option>');

        $.ajax({
            url: 'get_kota.php?prop_name=' + encodeURIComponent(prop_name),
            type: 'GET',
            dataType: 'json',
            success: function(result) {
                for (var i = 0; i < result.length; i++)
                    $kab.append('<option value="' + esc(result[i].kabkota) + '">' + esc(result[i].kabkota) + '</option>');
            }
        });
    });

    $(document).on('change', '.lokasi-kabupaten', function() {
        var $item = $(this).closest('.tergugat-item');
        var kabkota = $(this).val();
        var $kec = $item.find('.lokasi-kecamatan');
        var $kel = $item.find('.lokasi-kelurahan');

        $kec.html('<option value="">Pilih Kecamatan</option>');
        $kel.html('<option value="">Pilih Kelurahan</option>');

        $.ajax({
            url: 'get_kec.php?kabkota=' + encodeURIComponent(kabkota),
            type: 'GET',
            dataType: 'json',
            success: function(result) {
                for (var i = 0; i < result.length; i++)
                    $kec.append('<option value="' + esc(result[i].kec) + '">' + esc(result[i].kec) + '</option>');
            }
        });
    });

    $(document).on('change', '.lokasi-kecamatan', function() {
        var $item = $(this).closest('.tergugat-item');
        var kec = $(this).val();
        var $kel = $item.find('.lokasi-kelurahan');

        $kel.html('<option value="">Pilih Kelurahan</option>');

        $.ajax({
            url: 'get_kel.php?kec=' + encodeURIComponent(kec),
            type: 'GET',
            dataType: 'json',
            success: function(result) {
                for (var i = 0; i < result.length; i++)
                    $kel.append('<option value="' + esc(result[i].id) + '">' + esc(result[i].kel) + '</option>');
            }
        });
    });

    // ===== Fitur tambah/hapus tergugat (hanya aktif di halaman form) =====
    var tergugatCount = 0;

    // Perbarui label judul tiap blok tergugat menjadi "Tergugat/Termohon 1", "Tergugat/Termohon 2", dst.
    function renumberTergugat() {
        $('#tergugat-container .tergugat-item').each(function(i) {
            $(this).find('.tergugat-title').text('Tergugat/Termohon ' + (i + 1));
        });
    }

    function buatTergugat() {
        tergugatCount++;
        var html =
            '<div class="tergugat-item" data-index="' + tergugatCount + '">' +
            '  <div class="form-divider tergugat-title"></div>' +
            '  <div class="row">' +
            '    <div class="form-group col-6">' +
            '      <label>Provinsi</label>' +
            '      <select class="form-control lokasi-provinsi" name="provinsi[]"></select>' +
            '    </div>' +
            '    <div class="form-group col-6">' +
            '      <label>Kota/Kabupaten</label>' +
            '      <select class="form-control lokasi-kabupaten" name="kabupaten[]"></select>' +
            '    </div>' +
            '  </div>' +
            '  <div class="row">' +
            '    <div class="form-group col-6">' +
            '      <label>Kecamatan</label>' +
            '      <select class="form-control lokasi-kecamatan" name="kecamatan[]"></select>' +
            '    </div>' +
            '    <div class="form-group col-6">' +
            '      <label>Kelurahan</label>' +
            '      <select class="form-control lokasi-kelurahan" name="kelurahan[]" required></select>' +
            '    </div>' +
            '  </div>' +
            '  <div class="form-group">' +
            '    <button type="button" class="btn btn-danger btn-sm hapus-tergugat">Hapus Tergugat/Termohon</button>' +
            '  </div>' +
            '  <hr>' +
            '</div>';

        var $item = $(html);
        $('#tergugat-container').append($item);
        initLokasi($item);
        renumberTergugat();
    }

    $(document).ready(function() {
        if ($('#tergugat-container').length) {
            // Secara default tidak ada pihak Tergugat/Termohon.
            // Blok hanya ditambahkan manual melalui tombol "Tambah Tergugat/Termohon".

            $('#tambah-tergugat').on('click', function() {
                buatTergugat();
            });

            $(document).on('click', '.hapus-tergugat', function() {
                // Semua blok boleh dihapus, termasuk yang terakhir.
                $(this).closest('.tergugat-item').remove();
                renumberTergugat();
            });
        }
    });
</script>