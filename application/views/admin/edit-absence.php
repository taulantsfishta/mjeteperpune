<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <strong>Përditëso mungesën për: <?php echo html_escape($worker['workers_name']); ?></strong>
                </div>

                <div class="card-body">
                    <form method="post" action="<?php echo base_url('admin/workers/edit_absence/' . $worker['id'] . '/' . $absence['id']); ?>">

                        <div class="form-group">
                            <label>Data e mungesës</label>
                            <input type="date" name="created_at" class="form-control" value="<?php echo html_escape($absence['created_at']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Lloji i mungesës</label>
                            <select name="absence_type" class="form-control" id="absence_type" required>
                                <option value="day" <?php echo (!empty($absence['absence_type']) && $absence['absence_type'] == 'day') ? 'selected' : ''; ?>>Me ditë</option>
                                <option value="hour" <?php echo (!empty($absence['absence_type']) && $absence['absence_type'] == 'hour') ? 'selected' : ''; ?>>Me orë</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label id="absence_value_label">Numri i ditëve</label>
                            <input type="number" step="0.25" min="0.25" name="absence_value" id="absence_value" class="form-control" value="<?php echo number_format($absence_value, 2, '.', ''); ?>" required>
                            <small class="form-text text-muted" id="absence_help_text">
                                Mund të vendosësh 1 ditë, 0.5 ditë, 2 ditë, etj.
                            </small>
                        </div>

                        <div class="form-group">
                            <label>Shënim</label>
                            <textarea name="note" class="form-control" rows="4"><?php echo html_escape($absence['note']); ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Ruaj ndryshimet</button>
                        <a href="<?php echo base_url('admin/workers/worker_detail/' . $worker['id'] . '?month=' . date('m', strtotime($absence['created_at'])) . '&year=' . date('Y', strtotime($absence['created_at']))); ?>" class="btn btn-secondary">Kthehu mbrapa</a>
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
            helpText.textContent = 'Vendos numrin e orëve që do t’i llogaritni si mungesë.';
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