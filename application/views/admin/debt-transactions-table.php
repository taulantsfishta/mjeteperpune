<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Data</th>
                <th>Lloji</th>
                <th>Përshkrimi</th>
                <th>Shuma</th>
                <th>Fatura</th>
                <th>Statusi</th>
                <th>Veprimi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($transactions)): ?>
                <?php foreach ($transactions as $transaction): ?>
                    <?php
                    $isCancelled = (int)($transaction['is_cancelled'] ?? 0) === 1;
                    $isDebt = $transaction['type'] === 'debt';
                    $canCancel = !empty($debtCanModify)
                        && (int)($transaction['user_id'] ?? 0) === (int)$this->session->userdata('id')
                        && !$isCancelled;
                    $invoiceId = (int)($transaction['invoice_id'] ?? 0);
                    if ($invoiceId <= 0 && $isDebt && preg_match('/^FATURA_ID:(\d+)\s*-/', (string)($transaction['description'] ?? ''), $matches)) {
                        $invoiceId = (int)$matches[1];
                    }
                    ?>
                    <tr <?php echo $isCancelled ? 'style="background-color:#f5f5f5;"' : ''; ?>>
                        <td><?php echo date('d.m.Y H:i', strtotime($transaction['created_at'])); ?></td>
                        <td>
                            <span class="label label-<?php echo $isDebt ? 'danger' : 'success'; ?>">
                                <?php echo $isDebt ? 'Detyrim' : 'Pagesë'; ?>
                            </span>
                        </td>
                        <td>
                            <?php echo htmlspecialchars((string)($transaction['description'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>
                            <?php if ($isCancelled): ?>
                                <div class="text-muted" style="margin-top:6px;font-size:12px;">
                                    <strong>Arsyeja:</strong> <?php echo htmlspecialchars((string)($transaction['cancellation_reason'] ?? ''), ENT_QUOTES, 'UTF-8'); ?><br>
                                    <strong>Anuluar më:</strong> <?php echo !empty($transaction['cancelled_at']) ? date('d.m.Y H:i', strtotime($transaction['cancelled_at'])) : '-'; ?><br>
                                    <strong>Nga përdoruesi ID:</strong> <?php echo (int)($transaction['cancelled_by'] ?? 0); ?>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <strong style="color:<?php echo $isCancelled ? '#888' : ($isDebt ? '#d9534f' : '#5cb85c'); ?>;<?php echo $isCancelled ? 'text-decoration:line-through;' : ''; ?>">
                                <?php echo $isDebt ? '+' : '-'; ?>
                                <?php echo number_format((float)$transaction['amount'], 2, '.', ','); ?> €
                            </strong>
                        </td>
                        <td>
                            <?php if ($isDebt && $invoiceId > 0): ?>
                                <a href="<?php echo base_url('admin/invoices/print_pdf?id=' . $invoiceId); ?>" target="_blank" rel="noopener" class="btn btn-info btn-sm">
                                    <i class="fa fa-download"></i> Shkarko faturën
                                </a>
                            <?php else: ?>
                                <span class="text-muted">—</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($isCancelled): ?>
                                <span class="label label-default">Anuluar</span>
                            <?php else: ?>
                                <span class="label label-success">Aktiv</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($canCancel): ?>
                                <form method="post"
                                    action="<?php echo base_url('admin/invoices/cancel_debt_transaction/' . (int)$transaction['id']); ?>"
                                    onsubmit="return confirmDebtCancellation(this);"
                                    style="display:inline;">
                                    <?php if (config_item('csrf_protection')): ?>
                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                    <?php endif; ?>
                                    <input type="hidden" name="cancellation_reason" value="">
                                    <button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-ban"></i> Anulo</button>
                                </form>
                            <?php else: ?>
                                <span class="text-muted">—</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center" style="padding:25px;">Nuk ka transaksione.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php
$totalPages = 1;
if ($per_page > 0) {
    $totalPages = (int)ceil($total_transactions / $per_page);
}
if ($totalPages < 1) $totalPages = 1;
?>
<?php if ($total_transactions > $per_page): ?>
    <div class="pagination-area">
        <button type="button" class="btn btn-default debt-page-btn" data-page="<?php echo $page - 1; ?>" <?php echo $page <= 1 ? 'disabled' : ''; ?>>
            <i class="fa fa-angle-left"></i> Para
        </button>
        <span class="page-info">Faqja <strong><?php echo $page; ?></strong> nga <strong><?php echo $totalPages; ?></strong></span>
        <button type="button" class="btn btn-default debt-page-btn" data-page="<?php echo $page + 1; ?>" <?php echo $page >= $totalPages ? 'disabled' : ''; ?>>
            Tjetra <i class="fa fa-angle-right"></i>
        </button>
    </div>
<?php endif; ?>
<script>
    if (typeof window.confirmDebtCancellation !== 'function') {
        window.confirmDebtCancellation = function(form) {
            var reason = window.prompt('Shkruani arsyen e anulimit të transaksionit:');
            if (reason === null) return false;
            reason = reason.trim();
            if (!reason || reason.length > 1000) {
                window.alert('Arsyeja është e obligueshme (maksimumi 1000 karaktere).');
                return false;
            }
            if (!window.confirm('A jeni i sigurt që dëshironi ta anuloni këtë transaksion?')) return false;
            form.querySelector('input[name="cancellation_reason"]').value = reason;
            return true;
        };
    }
</script>