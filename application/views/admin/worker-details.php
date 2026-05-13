<div class="container-fluid">

    <div class="row mb-4">
        <div class="col-md-8">
            <h3><?php echo html_escape($worker['workers_name']); ?></h3>
            <p class="mb-1">
                Paga bazë mujore:
                <strong><?php echo number_format($salary_summary['base_salary'], 2); ?> €</strong>
            </p>
            <p class="mb-0">
                Muaji i zgjedhur:
                <strong><?php echo str_pad($selected_month, 2, '0', STR_PAD_LEFT) . '/' . $selected_year; ?></strong>
            </p>
            <p class="mb-0">
                Statusi i muajit:
                <strong class="<?php echo ($salary_summary['status'] == 'closed') ? 'text-danger' : 'text-success'; ?>">
                    <?php echo ($salary_summary['status'] == 'closed') ? 'CLOSED' : 'OPEN'; ?>
                </strong>
            </p>
        </div>

        <div class="col-md-4 text-right">
            <form method="get" action="<?php echo base_url('admin/workers/worker_detail/' . $worker['id']); ?>">
                <div class="form-row">
                    <div class="col">
                        <select name="month" class="form-control">
                            <?php for ($m = 1; $m <= 12; $m++): ?>
                                <option value="<?php echo $m; ?>" <?php echo ($selected_month == $m) ? 'selected' : ''; ?>>
                                    <?php echo str_pad($m, 2, '0', STR_PAD_LEFT); ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <div class="col">
                        <select name="year" class="form-control">
                            <?php for ($y = date('Y') - 2; $y <= date('Y') + 2; $y++): ?>
                                <option value="<?php echo $y; ?>" <?php echo ($selected_year == $y) ? 'selected' : ''; ?>>
                                    <?php echo $y; ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-block">Shfaq</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row mb-3">
        <div class="row mb-3">
            <div class="col-md-12">
                <?php if ($salary_summary['status'] == 'open'): ?>
                    <a href="<?php echo base_url('admin/workers/close_month/' . $worker['id'] . '?month=' . $selected_month . '&year=' . $selected_year); ?>" class="btn btn-danger">
                        Mbyll muajin
                    </a>
                <?php else: ?>
                    <a href="<?php echo base_url('admin/workers/reopen_month/' . $worker['id'] . '?month=' . $selected_month . '&year=' . $selected_year); ?>" class="btn btn-warning">
                        Hap muajin
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="row mb-3">
        
        <div class="col-md-3 mb-3">
            <?php if ($salary_summary['status'] == 'open'): ?>
                <a href="<?php echo base_url('admin/workers/add_payment/' . $worker['id'] . '?month=' . $selected_month . '&year=' . $selected_year); ?>" class="btn btn-success btn-block">
                    Shto pagesë gjatë muajit
                </a>
            <?php else: ?>
                <button type="button" class="btn btn-secondary btn-block" disabled>
                    Shto pagesë gjatë muajit
                </button>
            <?php endif; ?>
        </div>
        <div class="col-md-3 mb-3">
            <?php if ($salary_summary['status'] == 'open'): ?>
                <a href="<?php echo base_url('admin/workers/add_absence/' . $worker['id'] . '?month=' . $selected_month . '&year=' . $selected_year); ?>" class="btn btn-danger btn-block">
                    Shto mungesë
                </a>
            <?php else: ?>
                <button type="button" class="btn btn-secondary btn-block" disabled>
                    Shto mungesë
                </button>
            <?php endif; ?>
        </div>
        <div class="col-md-3 mb-3">
            <?php if ($salary_summary['status'] == 'open'): ?>
                <a href="<?php echo base_url('admin/workers/add_loan/' . $worker['id'] . '?month=' . $selected_month . '&year=' . $selected_year); ?>" class="btn btn-warning btn-block">
                    Shto huazim mujor
                </a>
            <?php else: ?>
                <button type="button" class="btn btn-secondary btn-block" disabled>
                    Shto huazim mujor
                </button>
            <?php endif; ?>
        </div>
        <div class="col-md-3 mb-3">
            <?php if ($salary_summary['status'] == 'open'): ?>
                <a href="<?php echo base_url('admin/workers/add_installment_loan/' . $worker['id'] . '?month=' . $selected_month . '&year=' . $selected_year); ?>" class="btn btn-dark btn-block">
                    Shto huazim me këste
                </a>
            <?php else: ?>
                <button type="button" class="btn btn-secondary btn-block" disabled>
                    Shto huazim me këste
                </button>
            <?php endif; ?>
            </div>
    </div>


    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card p-3">
                <h5>Paga bazë</h5>
                <h4><?php echo number_format($salary_summary['base_salary'], 2); ?> €</h4>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card p-3">
                <h5>Mungesa</h5>
                <h4><?php echo number_format($salary_summary['absent_days'], 2); ?> ditë</h4>
                <small>
                    <?php echo number_format($salary_summary['absent_days_only'], 2); ?> ditë /
                    <?php echo number_format($salary_summary['absent_hours_only'], 2); ?> orë
                </small>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card p-3">
                <h5>Zbritje mungese</h5>
                <h4><?php echo number_format($salary_summary['absent_deduction'], 2); ?> €</h4>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card p-3">
                <h5>Huazime të muajit</h5>
                <h4><?php echo number_format($monthly_loans_total, 2); ?> €</h4>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card p-3">
                <h5>Këste mujore</h5>
                <h4><?php echo number_format($total_installment_loans, 2); ?> €</h4>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card p-3">
                <h5>Totali i zbritjeve nga huazimet</h5>
                <h4><?php echo number_format($salary_summary['total_loans'], 2); ?> €</h4>
            </div>
        </div>
       
        <?php if ((float)$salary_summary['carry_forward'] != 0): ?>
            <div class="col-md-3 mb-3">
                <div class="card p-3">
                    <h5>Balanci i bartur</h5>
                    <h4><?php echo number_format($salary_summary['carry_forward'], 2); ?> €</h4>

                    <?php if (!empty($salary_summary['carry_forward_source_month']) && !empty($salary_summary['carry_forward_source_year'])): ?>
                        <small>
                            Nga muaji <?php echo str_pad($salary_summary['carry_forward_source_month'], 2, '0', STR_PAD_LEFT) . '/' . $salary_summary['carry_forward_source_year']; ?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        
        <div class="col-md-3 mb-3">
            <div class="card p-3">
                <h5>Paguar gjatë muajit per punetorin nga kompania</h5>
                <h4><?php echo number_format($salary_summary['total_paid'], 2); ?> €</h4>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card p-3">
                <h5>Rroga për këtë muaj</h5>
                <h4><?php echo number_format($salary_summary['final_salary'], 2); ?> €</h4>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card p-3">
                <h5>Për t’u paguar në fund të muajit</h5>
                <h4><?php echo number_format($salary_summary['remaining_salary'], 2); ?> €</h4>
            </div>
        </div>
    </div>


    <div class="card mt-4">
        <div class="card-header">
            <strong>Mungesat</strong>
        </div>
        <div class="card-body">
            <?php if (!empty($absences)): ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Mungesa</th>
                                <th>Shënim</th>
                                <th>Veprime</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($absences as $absence): ?>
                                <tr>
                                    <td><?php echo date('d-m-Y H:i:s', strtotime($absence['created_at'])); ?></td>

                                    <td>
                                        <?php
                                            if (!empty($absence['absence_type']) && $absence['absence_type'] == 'hour') {
                                                echo number_format((float)$absence['hours'], 2) . ' orë';
                                            } else {
                                                echo number_format((float)$absence['days'], 2) . ' ditë';
                                            }
                                        ?>
                                    </td>

                                    <td><?php echo html_escape($absence['note']); ?></td>
                                    <td>
                                        <?php if ($salary_summary['status'] == 'open'): ?>
                                            <a href="<?php echo base_url('admin/workers/edit_absence/' . $worker['id'] . '/' . $absence['id']); ?>"
                                            class="btn btn-sm btn-primary">
                                                Edito
                                            </a>

                                            <a href="<?php echo base_url('admin/workers/delete_absence/' . $worker['id'] . '/' . $absence['id']); ?>"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('A jeni të sigurt që doni ta fshini këtë mungesë?');">
                                                Fshij
                                            </a>
                                        <?php else: ?>
                                            <button type="button" class="btn btn-sm btn-secondary" disabled>Edito</button>
                                            <button type="button" class="btn btn-sm btn-secondary" disabled>Fshij</button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="mb-0">Nuk ka mungesa për këtë muaj.</p>
            <?php endif; ?>
        </div>
    </div>


    <div class="card mt-4">
        <div class="card-header">
            <strong>Huazimet te muajit</strong>
        </div>
        <div class="card-body">
            <?php if (!empty($loans)): ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Shuma</th>
                                <th>Shënim</th>
                                <th>Veprime</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($loans as $loan): ?>
                                <tr>
                                    <td><?php echo !empty($loan['created_at']) ? date('d-m-Y H:i:s', strtotime($loan['created_at'])) : '-'; ?></td>
                                    <td><?php echo number_format($loan['amount'], 2); ?> €</td>
                                    <td><?php echo html_escape($loan['note']); ?></td>
                                    <td>
                                        <?php if ($salary_summary['status'] == 'open'): ?>
                                            <a href="<?php echo base_url('admin/workers/edit_loan/' . $worker['id'] . '/' . $loan['id']); ?>"
                                            class="btn btn-sm btn-primary">
                                                Edito
                                            </a>

                                            <a href="<?php echo base_url('admin/workers/delete_loan/' . $worker['id'] . '/' . $loan['id']); ?>"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('A jeni të sigurt që doni ta fshini këtë huazim?');">
                                                Fshij
                                            </a>
                                        <?php else: ?>
                                            <button type="button" class="btn btn-sm btn-secondary" disabled>Edito</button>
                                            <button type="button" class="btn btn-sm btn-secondary" disabled>Fshij</button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="mb-0">Nuk ka huazime për këtë muaj.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <strong>Huazime me këste aktive për këtë muaj</strong>
        </div>
        <div class="card-body">
            <?php if (!empty($installment_loans)): ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Huazimi total</th>
                                <th>Kësti mujor</th>
                                <th>Muaji i nisjes</th>
                                <th>Mbaron në</th>
                                <th>Zbritja për këtë muaj</th>
                                <th>Paguar deri këtë muaj</th>
                                <th>Mbetur nga huazimi</th>
                                <th>Shënim</th>
                                <th>Veprime</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($installment_loans as $loan): ?>
                                <tr>
                                    <?php foreach ($installment_loans as $loan): ?>
                                        <tr>
                                            <td><?php echo number_format($loan['total_amount'], 2); ?> €</td>
                                            <td><?php echo number_format($loan['monthly_amount'], 2); ?> €</td>
                                            <td><?php echo str_pad($loan['start_month'], 2, '0', STR_PAD_LEFT) . '/' . $loan['start_year']; ?></td>
                                            <td><?php echo str_pad($loan['end_month'], 2, '0', STR_PAD_LEFT) . '/' . $loan['end_year']; ?></td>
                                            <td><?php echo number_format($loan['month_deduction'], 2); ?> €</td>
                                            <td><?php echo number_format($loan['paid_until_this_month'], 2); ?> €</td>
                                            <td><?php echo number_format($loan['remaining_after_this_month'], 2); ?> €</td>
                                            <td><?php echo html_escape($loan['note']); ?></td>
                                            <td>
    <?php if ($salary_summary['status'] == 'open'): ?>

        <a
            href="<?php echo base_url('admin/workers/edit_installment_loan/' . $worker['id'] . '/' . $loan['id']); ?>"
            class="btn btn-sm btn-primary"
        >
            Edito
        </a>

        <a
            href="<?php echo base_url('admin/workers/delete_installment_loan/' . $worker['id'] . '/' . $loan['id']); ?>"
            class="btn btn-sm btn-danger"
            onclick="return confirm('A jeni të sigurt që doni ta fshini këtë huazim me këste?');"
        >
            Fshij
        </a>

    <?php else: ?>

        <button type="button" class="btn btn-sm btn-secondary" disabled>
            Edito
        </button>

        <button type="button" class="btn btn-sm btn-secondary" disabled>
            Fshij
        </button>

    <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="mb-0">Nuk ka huazime me këste aktive për këtë muaj.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <strong>Pagesat e bëra gjatë këtij muaji per punetore nga kompania</strong>
        </div>
        <div class="card-body">
            <?php if (!empty($payments)): ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Data e pagesës</th>
                                <th>Shuma</th>
                                <th>Shënim</th>
                                <th>Veprime</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($payments as $payment): ?>
                                <tr>
                                    <td><?php echo date('d-m-Y H:i:s', strtotime($payment['created_at'])); ?></td>                                    <td><?php echo number_format($payment['amount'], 2); ?> €</td>
                                    <td><?php echo html_escape($payment['note']); ?></td>
                                   <td>
                                        <?php if ($salary_summary['status'] == 'open'): ?>
                                            <a href="<?php echo base_url('admin/workers/edit_payment/' . $worker['id'] . '/' . $payment['id']); ?>"
                                            class="btn btn-sm btn-primary">
                                                Edito
                                            </a>

                                            <a href="<?php echo base_url('admin/workers/delete_payment/' . $worker['id'] . '/' . $payment['id']); ?>"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('A jeni të sigurt që doni ta fshini këtë pagesë?');">
                                                Fshij
                                            </a>
                                        <?php else: ?>
                                            <button type="button" class="btn btn-sm btn-secondary" disabled>Edito</button>
                                            <button type="button" class="btn btn-sm btn-secondary" disabled>Fshij</button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="mb-0">Nuk ka pagesa për këtë muaj.</p>
            <?php endif; ?>
        </div>
    </div>
</div>