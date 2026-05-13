<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <strong>Shto huazim me këste për: <?php echo html_escape($worker['workers_name']); ?></strong>
                </div>

                <div class="card-body">
                    <form method="post" action="<?php echo base_url('admin/workers/add_installment_loan/' . $worker['id']); ?>">

                        <div class="form-group">
                            <label>Shuma totale e huazimit</label>
                            <input type="number" step="0.01" min="0.01" name="total_amount" class="form-control" placeholder="P.sh. 7000.00" required>
                        </div>

                        <div class="form-group">
                            <label>Kësti mujor</label>
                            <input type="number" step="0.01" min="0.01" name="monthly_amount" class="form-control" placeholder="P.sh. 100.00" required>
                        </div>

                        <div class="form-group">
                            <label>Muaji i nisjes</label>
                            <select name="start_month" class="form-control" required>
                                <?php for ($m = 1; $m <= 12; $m++): ?>
                                    <option value="<?php echo $m; ?>" <?php echo ($selected_month == $m) ? 'selected' : ''; ?>>
                                        <?php echo str_pad($m, 2, '0', STR_PAD_LEFT); ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Viti i nisjes</label>
                            <select name="start_year" class="form-control" required>
                                <?php for ($y = date('Y') - 2; $y <= date('Y') + 5; $y++): ?>
                                    <option value="<?php echo $y; ?>" <?php echo ($selected_year == $y) ? 'selected' : ''; ?>>
                                        <?php echo $y; ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Shënim</label>
                            <textarea name="note" class="form-control" rows="4" placeholder="P.sh. Huazim për shtëpi, veturë, etj."></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Ruaj huazimin me këste</button>
                        <a href="<?php echo base_url('admin/workers/worker_detail/' . $worker['id'] . '?month=' . $selected_month . '&year=' . $selected_year); ?>" class="btn btn-secondary">Kthehu mbrapa</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>