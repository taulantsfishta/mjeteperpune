<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <strong>Përditëso huazimin për: <?php echo html_escape($worker['workers_name']); ?></strong>
                </div>

                <div class="card-body">
                    <form method="post" action="<?php echo base_url('admin/workers/edit_loan/' . $worker['id'] . '/' . $loan['id']); ?>">

                        <div class="form-group">
                            <label>Data e huazimit</label>
                            <input type="date" name="created_at" class="form-control" value="<?php echo html_escape($loan['created_at']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Shuma e huazimit</label>
                            <input type="number" step="0.01" min="0.01" name="amount" class="form-control" value="<?php echo number_format((float)$loan['amount'], 2, '.', ''); ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Shënim</label>
                            <textarea name="note" class="form-control" rows="4"><?php echo html_escape($loan['note']); ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Ruaj ndryshimet</button>
                        <a href="<?php echo base_url('admin/workers/worker_detail/' . $worker['id'] . '?month=' . date('m', strtotime($loan['created_at'])) . '&year=' . date('Y', strtotime($loan['created_at']))); ?>" class="btn btn-secondary">Kthehu mbrapa</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>