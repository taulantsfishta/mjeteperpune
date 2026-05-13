<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <strong>Përditëso pagesën për: <?php echo html_escape($worker['workers_name']); ?></strong>
                </div>

                <div class="card-body">
                    <form method="post" action="<?php echo base_url('admin/workers/edit_payment/' . $worker['id'] . '/' . $payment['id']); ?>">

                        <div class="form-group">
                            <label>Data e pagesës</label>
                            <input type="date" name="created_at" class="form-control" value="<?php echo html_escape($payment['created_at']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Shuma e pagesës</label>
                            <input type="number" step="0.01" min="0.01" name="amount" class="form-control" value="<?php echo number_format((float)$payment['amount'], 2, '.', ''); ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Shënim</label>
                            <textarea name="note" class="form-control" rows="4"><?php echo html_escape($payment['note']); ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Ruaj ndryshimet</button>
                        <a href="<?php echo base_url('admin/workers/worker_detail/' . $worker['id'] . '?month=' . date('m', strtotime($payment['created_at'])) . '&year=' . date('Y', strtotime($payment['created_at']))); ?>" class="btn btn-secondary">Kthehu mbrapa</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>