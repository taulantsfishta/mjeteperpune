<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <strong>Shto mungesë për: <?php echo html_escape($worker['workers_name']); ?></strong>
                </div>

                <div class="card-body">
                    <form method="post" action="<?php echo base_url('admin/workers/add_absence/' . $worker['id']); ?>">

                        <div class="form-group">
                            <label>Muaji</label>
                            <select name="salary_month" class="form-control" required>
                                <?php for ($m = 1; $m <= 12; $m++): ?>
                                    <option value="<?php echo $m; ?>" <?php echo ($selected_month == $m) ? 'selected' : ''; ?>>
                                        <?php echo str_pad($m, 2, '0', STR_PAD_LEFT); ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Viti</label>
                            <select name="salary_year" class="form-control" required>
                                <?php for ($y = date('Y') - 2; $y <= date('Y') + 2; $y++): ?>
                                    <option value="<?php echo $y; ?>" <?php echo ($selected_year == $y) ? 'selected' : ''; ?>>
                                        <?php echo $y; ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Data e mungesës</label>
                            <input type="date" name="created_at" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Lloji i mungesës</label>
                            <select name="absence_type" class="form-control" id="absence_type" required>
                                <option value="day">Me ditë</option>
                                <option value="hour">Me orë</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label id="absence_value_label">Numri i ditëve</label>
                            <input type="number" step="0.25" min="0.25" name="absence_value" id="absence_value" class="form-control" placeholder="P.sh. 1 ose 0.5" required>
                            <small class="form-text text-muted" id="absence_help_text">
                                Mund të vendosësh 1 ditë, 0.5 ditë, 2 ditë, etj.
                            </small>
                        </div>

                        <div class="form-group">
                            <label>Shënim</label>
                            <textarea name="note" class="form-control" rows="4" placeholder="Shënim opsional..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Ruaj mungesën</button>
                        <a href="<?php echo base_url('admin/workers/worker_detail/' . $worker['id'] . '?month=' . $selected_month . '&year=' . $selected_year); ?>" class="btn btn-secondary">Kthehu mbrapa</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    var absenceType = document.getElementById('absence_type');
    var helpText = document.getElementById('absence_help_text');
    var valueLabel = document.getElementById('absence_value_label');
    var valueInput = document.getElementById('absence_value');

    function updateAbsenceFields() {
        if (absenceType.value === 'hour') {
            valueLabel.textContent = 'Numri i orëve';
            valueInput.placeholder = 'P.sh. 1, 2, 3...';
            helpText.textContent = 'Vendos numrin e orëve që do t’i llogaritni si mungesë. P.sh. 1, 2, 3...';
        } else {
            valueLabel.textContent = 'Numri i ditëve';
            valueInput.placeholder = 'P.sh. 1 ose 0.5';
            helpText.textContent = 'Mund të vendosësh 1 ditë, 0.5 ditë, 2 ditë, etj.';
        }
    }

    absenceType.addEventListener('change', updateAbsenceFields);
    updateAbsenceFields();
});
</script>