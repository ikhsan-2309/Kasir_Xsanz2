<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=[" your-google-map-api"]&libraries=places"></script>
<script src="dist/js/app.js"></script>
<script src="dist/js/jquery.min.js"></script>
<script src="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.js"></script>
<script src="dist/js/select2.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.1.0/autoNumeric.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
    // In your Javascript (external .js resource or <scrip> tag)
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
    $(document).ready(function() {
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf'
            ]
        });
    });
</script>
<script>
    new AutoNumeric('.angka');
</script>

<script>
    $(document).ready(function() {
        ("#bayar").click(function(event) {
            event.preventDefault();

            // Ambil nilai total bayar dari input
            var totalBayar = $("input[name='total_bayar']").val();

            // Kirim permintaan AJAX ke server
            $.ajax({
                url: "proses_transaksi.php",
                method: "POST",
                data: {
                    total_bayar: totalBayar
                },
                success: function(response) {
                    alert(response);
                }
            });
        });
    });
</script>
<script>
    function printTransaction(id_transaksi) {
        // Lakukan permintaan AJAX untuk mendapatkan detail transaksi berdasarkan ID transaksi
        $.ajax({
            url: 'get_transaction_details.php',
            method: 'POST',
            data: {
                id_transaksi: id_transaksi
            },
            dataType: 'json',
            success: function(response) {
                // Cetak detail transaksi dalam bentuk cetak
                printContent(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    function printContent(data) {
        // Buka jendela baru untuk mencetak
        var printWindow = window.open('', '_blank');
        // Isi konten cetak dengan data transaksi
        printWindow.document.write('<html><head><title>Detail Transaksi</title></head><body>');
        printWindow.document.write('<h1>Detail Transaksi</h1>');
        printWindow.document.write('<p>ID Transaksi : ' + data.id_transaksi + '</p>');
        printWindow.document.write('<p>Total Harga : ' + data.total_harga + '</p>');
        printWindow.document.write('<p>Kembalian : ' + data.kembalian + '</p>');
        printWindow.document.write('<p>Tanggal : ' + data.tanggal + '</p>');
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        // Cetak konten
        printWindow.print();
    }
</script>