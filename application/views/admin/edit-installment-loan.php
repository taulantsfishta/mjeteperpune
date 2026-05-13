<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">

            <div class="card">

                <div class="card-header">
                    <strong>
                        Përditëso huazimin me këste për:
                        <?php echo html_escape($worker['workers_name']); ?>
                    </strong>
                </div>

                <div class="card-body">

                    <form method="post">

                        <div class="form-group">
                            <label>Shuma totale e huazimit</label>

                            <input
                                type="number"
                                step="0.01"
                                min="0.01"
                                name="total_amount"
                                class="form-control"
                                value="<?php echo number_format((float)$loan['total_amount'], 2, '.', ''); ?>"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label>Kësti mujor</label>

                            <input
                                type="number"
                                step="0.01"
                                min="0.01"
                                name="monthly_amount"
                                class="form-control"
                                value="<?php echo number_format((float)$loan['monthly_amount'], 2, '.', ''); ?>"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label>Muaji fillestar</label>

                            <select name="start_month" class="form-control" required>

                                <?php for ($m = 1; $m <= 12; $m++): ?>

                                    <option
                                        value="<?php echo $m; ?>"
                                        <?php echo ((int)$loan['start_month'] === $m) ? 'selected' : ''; ?>
                                    >
                                        <?php echo str_pad($m, 2, '0', STR_PAD_LEFT); ?>
                                    </option>

                                <?php endfor; ?>

                            </select>
                        </div>

                        <div class="form-group">
                            <label>Viti fillestar</label>

                            <input
                                type="number"
                                name="start_year"
                                class="form-control"
                                value="<?php echo (int)$loan['start_year']; ?>"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label>Shënim</label>

                            <textarea
                                name="note"
                                class="form-control"
                                rows="4"
                            ><?php echo html_escape($loan['note']); ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Ruaj ndryshimet
                        </button>

                        <a
                            href="<?php echo base_url('admin/workers/worker_detail/' . $worker['id']); ?>"
                            class="btn btn-secondary"
                        >
                            Kthehu mbrapa
                        </a>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>