
    
<!-- .row -->
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <form method="post" action="<?php echo base_url('admin/printproduct/print_product'); ?>" enctype="multipart/form-data">
                            <div class="form-group">
                                <h3 class="box-title">NGARKO LISTEN EXCEL TE PRODUKTEV PER TU PRINTUAR</h3>
                                <div id="uploadProductList">
                                    <div class="input-group">
                                    <input type="file" id="excelFileInput" name='excel_file' accept=".xlsx, .xls" class="dropify" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <h3 class="box-title">CAKTO DIMENSIONET E FLETES SE PRINTERIT</h3>
                                <select class="form-select form-select-lg mb-12" style="width:100%;height:40px;" aria-label=".form-select-lg example" name="label_dimension" id="label_dimension" required>
                                <?php foreach($page_dimension as $index => $dimension){ ?>
                                    <?php if($index === 0): ?>
                                        <option value="<?php echo $dimension['id']; ?>" selected><span>W: <?php echo $dimension['width']; ?> - H: <?php echo $dimension['height']; ?></span></option>
                                    <?php else: ?>
                                        <option value="<?php echo $dimension['id']; ?>"><span>W: <?php echo $dimension['width']; ?> - H: <?php echo $dimension['height']; ?></span></option>
                                    <?php endif; ?>
                                <?php } ?>
                                </select>
                            </div>    
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-info">PRINTO</button>
                            </div>
                    </form>  
                </div>    
            </div>        
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.3/xlsx.full.min.js"></script>
<script>
    function uploadExcel() {
        var input = document.getElementById('excelFileInput');
        var file = input.files[0];
        var reader = new FileReader();
        
        reader.onload = function(e) {
            var data = new Uint8Array(e.target.result);
            var workbook = XLSX.read(data, { type: 'array' });
            var sheetName = workbook.SheetNames[0];
            var sheet = workbook.Sheets[sheetName];
            var jsonData = XLSX.utils.sheet_to_json(sheet, { header: 1 });
            
            // Process jsonData as needed (it contains the Excel data)
            console.log(jsonData);
        };
        
        reader.readAsArrayBuffer(file);
    }
</script>