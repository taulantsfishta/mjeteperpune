<style>
@media print {

    body * {
        visibility: hidden;
    }

    .print-area, .print-area * {
        visibility: visible;
    }

    .print-area {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }

    .no-print {
        display: none !important;
    }

    header, nav, .sidebar, .footer {
    display: none !important;
}

}
</style>
<div class="container-fluid">

    <div class="row mb-4 no-print">
        <div class="col-md-12">
            <h3>Raporti mujor i pagave</h3>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <form method="get" action="<?php echo base_url('admin/workers/monthly_salary_report'); ?>">
                <div class="form-row">
                    <div class="col-md-3">
                        <label>Muaji</label>
                        <select name="month" class="form-control">
                            <?php for ($m = 1; $m <= 12; $m++): ?>
                                <option value="<?php echo $m; ?>" <?php echo ($selected_month == $m) ? 'selected' : ''; ?>>
                                    <?php echo str_pad($m, 2, '0', STR_PAD_LEFT); ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label>Viti</label>
                        <select name="year" class="form-control">
                            <?php for ($y = date('Y') - 2; $y <= date('Y') + 2; $y++): ?>
                                <option value="<?php echo $y; ?>" <?php echo ($selected_year == $y) ? 'selected' : ''; ?>>
                                    <?php echo $y; ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary btn-block">Shfaq raportin</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="mb-3">
    <button onclick="printReport()" class="btn btn-success">
        Printo raportin per punetoret
        </button>
    </div>
    
    <div class="card print-area">
        <div class="text-center mb-3">
            <h3>Raporti mujor i pagave</h3>
            <p>
                Muaji: <?php echo str_pad($selected_month, 2, '0', STR_PAD_LEFT); ?>/<?php echo $selected_year; ?>
            </p>
        </div>
        <div class="card-header">
            <strong>Raporti për muajin <?php echo str_pad($selected_month, 2, '0', STR_PAD_LEFT) . '/' . $selected_year; ?></strong>
    </div>

        <div class="card-body">
            <?php if (!empty($report_rows)): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Punëtori</th>
                                <th>Paga bazë</th>
                                <th>Mungesa</th>
                                <th>Zbritje mungese</th>
                                <th>Huazime mujore</th>
                                <th>Këste mujore</th>
                                <th>Totali i huazimeve</th>
                                <th>Balanci i bartur</th>
                                <th>Paguar gjatë muajit</th>
                                <th>Rroga për këtë muaj</th>
                                <th>Për t’u paguar</th>
                                <th>Statusi</th>
                                <th>Detaje</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($report_rows as $row): ?>
                                <tr>
                                    <td><?php echo html_escape($row['worker_name']); ?></td>
                                    <td><?php echo number_format($row['base_salary'], 2); ?> €</td>
                                    <td><?php echo number_format($row['absent_days'], 2); ?> ditë</td>
                                    <td><?php echo number_format($row['absent_deduction'], 2); ?> €</td>
                                    <td><?php echo number_format($row['monthly_loans_total'], 2); ?> €</td>
                                    <td><?php echo number_format($row['total_installment_loans'], 2); ?> €</td>
                                    <td><?php echo number_format($row['total_loans'], 2); ?> €</td>
                                    <td><?php echo number_format($row['carried_balance'], 2); ?> €</td>
                                    <td><?php echo number_format($row['total_paid'], 2); ?> €</td>
                                    <td><?php echo number_format($row['final_salary'], 2); ?> €</td>
                                    <td><strong><?php echo number_format($row['remaining_salary'], 2); ?> €</strong></td>
                                    <td><?php echo strtoupper($row['status']); ?></td>
                                    <td>
                                        <a href="<?php echo base_url('admin/workers/print_worker_salary_report/' . $row['worker_id'] . '?month=' . $selected_month . '&year=' . $selected_year); ?>" target="_blank" class="btn btn-sm btn-info">
                                            Printo
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="10" class="text-right">Totali për t’u paguar</th>
                                <th><strong><?php echo number_format($grand_total, 2); ?> €</strong></th>
                                <th colspan="2"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            <?php else: ?>
                <p class="mb-0">Nuk ka të dhëna për këtë muaj.</p>
            <?php endif; ?>
        </div>
    </div>

</div>


<script>
function printReport() {
    window.print();
}
</script>