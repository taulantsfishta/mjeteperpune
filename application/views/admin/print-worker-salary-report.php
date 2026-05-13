<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Raporti i pagës - <?php echo html_escape($worker['workers_name']); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 20px;
            color: #000;
        }

        h2, h3, p {
            margin: 0 0 10px 0;
        }

        .top-actions {
            margin-bottom: 20px;
        }

        .summary-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }

        .summary-box {
            border: 1px solid #ccc;
            padding: 10px;
            width: 220px;
            box-sizing: border-box;
        }

        .summary-box h4 {
            margin: 0 0 8px 0;
            font-size: 14px;
        }

        .summary-box p {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            margin-bottom: 25px;
        }

        table th, table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
            font-size: 13px;
        }

        table th {
            background: #f2f2f2;
        }

        .section-title {
            margin-top: 20px;
            font-size: 16px;
            font-weight: bold;
        }

        @media print {
            .no-print {
                display: none !important;
            }

            body {
                margin: 0;
            }
        }
    </style>
</head>
<body>

    <div class="top-actions no-print">
        <button onclick="window.print();">Printo</button>
    </div>

    <h2>Raporti i pagës për një punëtor</h2>
    <p><strong>Punëtori:</strong> <?php echo html_escape($worker['workers_name']); ?></p>
    <p><strong>Muaji:</strong> <?php echo str_pad($selected_month, 2, '0', STR_PAD_LEFT) . '/' . $selected_year; ?></p>
    <!-- <p><strong>Data e printimit:</strong> <?php echo date('d-m-Y H:i'); ?></p> -->

    <div class="summary-grid">
        <div class="summary-box">
            <h4>Paga bazë</h4>
            <p><?php echo number_format($salary_summary['base_salary'], 2); ?> €</p>
        </div>

        <div class="summary-box">
            <h4>Mungesa</h4>
            <p><?php echo number_format($salary_summary['absent_days'], 2); ?> ditë</p>
        </div>

        <div class="summary-box">
            <h4>Zbritje mungese</h4>
            <p><?php echo number_format($salary_summary['absent_deduction'], 2); ?> €</p>
        </div>

        <div class="summary-box">
            <h4>Huazime të muajit</h4>
            <p><?php echo number_format($monthly_loans_total, 2); ?> €</p>
        </div>

        <div class="summary-box">
            <h4>Këste mujore</h4>
            <p><?php echo number_format($total_installment_loans, 2); ?> €</p>
        </div>

        <div class="summary-box">
            <h4>Totali i huazimeve</h4>
            <p><?php echo number_format($salary_summary['total_loans'], 2); ?> €</p>
        </div>

        <div class="summary-box">
            <h4>Balanci i bartur</h4>
            <p><?php echo number_format($salary_summary['carry_forward'], 2); ?> €</p>
        </div>

        <div class="summary-box">
            <h4>Paguar gjatë muajit</h4>
            <p><?php echo number_format($salary_summary['total_paid'], 2); ?> €</p>
        </div>

        <div class="summary-box">
            <h4>Rroga për këtë muaj</h4>
            <p><?php echo number_format($salary_summary['final_salary'], 2); ?> €</p>
        </div>

        <div class="summary-box">
            <h4>Për t’u paguar</h4>
            <p><?php echo number_format($salary_summary['remaining_salary'], 2); ?> €</p>
        </div>
    </div>

    <div class="section-title">Mungesat</div>
    <table>
        <thead>
            <tr>
                <th>Data</th>
                <th>Mungesa</th>
                <th>Shënim</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($absences)): ?>
                <?php foreach ($absences as $absence): ?>
                    <tr>
                        <td><?php echo date('d-m-Y', strtotime($absence['created_at'])); ?></td>
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
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">Nuk ka mungesa.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="section-title">Huazime të muajit</div>
    <table>
        <thead>
            <tr>
                <th>Data</th>
                <th>Shuma</th>
                <th>Shënim</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($loans)): ?>
                <?php foreach ($loans as $loan): ?>
                    <tr>
                        <td><?php echo !empty($loan['created_at']) ? date('d-m-Y', strtotime($loan['created_at'])) : '-'; ?></td>
                        <td><?php echo number_format($loan['amount'], 2); ?> €</td>
                        <td><?php echo html_escape($loan['note']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">Nuk ka huazime mujore.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="section-title">Huazime me këste</div>
    <table>
        <thead>
            <tr>
                <th>Huazimi total</th>
                <th>Kësti mujor</th>
                <th>Mbaron në</th>
                <th>Zbritja për këtë muaj</th>
                <th>Mbetur nga huazimi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($installment_loans)): ?>
                <?php foreach ($installment_loans as $loan): ?>
                    <tr>
                        <td><?php echo number_format($loan['total_amount'], 2); ?> €</td>
                        <td><?php echo number_format($loan['monthly_amount'], 2); ?> €</td>
                        <td><?php echo str_pad($loan['end_month'], 2, '0', STR_PAD_LEFT) . '/' . $loan['end_year']; ?></td>
                        <td><?php echo number_format($loan['month_deduction'], 2); ?> €</td>
                        <td><?php echo number_format($loan['remaining_after_this_month'], 2); ?> €</td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Nuk ka huazime me këste aktive.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="section-title">Pagesat gjatë muajit</div>
    <table>
        <thead>
            <tr>
                <th>Data</th>
                <th>Shuma</th>
                <th>Shënim</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($payments)): ?>
                <?php foreach ($payments as $payment): ?>
                    <tr>
                        <td><?php echo date('d-m-Y', strtotime($payment['created_at'])); ?></td>
                        <td><?php echo number_format($payment['amount'], 2); ?> €</td>
                        <td><?php echo html_escape($payment['note']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">Nuk ka pagesa gjatë muajit.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>

<script>
window.onload = function() {
    window.print();
};
</script>