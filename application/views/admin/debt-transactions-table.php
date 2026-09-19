<div class="table-responsive">

    <table class="table table-bordered table-hover">

        <thead>

            <tr>

                <th>
                    Data
                </th>

                <th>
                    Lloji
                </th>

                <th>
                    Përshkrimi
                </th>

                <th>
                    Shuma
                </th>
                <th>Fatura</th>

            </tr>

        </thead>


        <tbody>


        <?php if (!empty($transactions)): ?>


            <?php foreach ($transactions as $transaction): ?>


                <tr>


                    <!-- DATA -->

                    <td>

                        <?php echo date(
                            'd.m.Y H:i',
                            strtotime(
                                $transaction['created_at']
                            )
                        ); ?>

                    </td>



                    <!-- LLOJI -->

                    <td>

                        <?php if (
                            $transaction['type'] == 'debt'
                        ): ?>

                            <span class="label label-danger">

                                Detyrim

                            </span>

                        <?php else: ?>

                            <span class="label label-success">

                                Pagesë

                            </span>

                        <?php endif; ?>

                    </td>



                    <!-- PERSHKRIMI -->

                    <td>

                        <?php echo htmlspecialchars(
                            $transaction['description'] ?? '',
                            ENT_QUOTES,
                            'UTF-8'
                        ); ?>

                    </td>



                    <!-- SHUMA -->

                    <td>

                        <?php if (
                            $transaction['type'] == 'debt'
                        ): ?>

                            <strong style="color:#d9534f;">

                                +

                                <?php echo number_format(
                                    (float)$transaction['amount'],
                                    2,
                                    '.',
                                    ','
                                ); ?> €

                            </strong>


                        <?php else: ?>


                            <strong style="color:#5cb85c;">

                                -

                                <?php echo number_format(
                                    (float)$transaction['amount'],
                                    2,
                                    '.',
                                    ','
                                ); ?> €

                            </strong>


                        <?php endif; ?>

                    </td>

                    <!-- FATURA -->
                    <td>
                        <?php
                            $invoiceId = (int) ($transaction['invoice_id'] ?? 0);

                            // Për transaksionet e vjetra që e kanë
                            // ID-në e faturës vetëm në përshkrim.
                            if (
                                $invoiceId <= 0 &&
                                $transaction['type'] === 'debt' &&
                                preg_match(
                                    '/^FATURA_ID:(\d+)\s*-/',
                                    $transaction['description'] ?? '',
                                    $matches
                                )
                            ) {
                                $invoiceId = (int) $matches[1];
                            }
                        ?>

                        <?php if (
                            $transaction['type'] === 'debt' &&
                            $invoiceId > 0
                        ): ?>

                            <a
                                href="<?php echo base_url(
                                    'admin/invoices/print_pdf?id=' . $invoiceId
                                ); ?>"
                                target="_blank"
                                rel="noopener"
                                class="btn btn-info btn-sm"
                            >
                                <i class="fa fa-download"></i>
                                Shkarko faturën
                            </a>

                        <?php else: ?>

                            <span class="text-muted">—</span>

                        <?php endif; ?>
                    </td>


                </tr>


            <?php endforeach; ?>


        <?php else: ?>


            <tr>

                <td
                    colspan="5"
                    class="text-center"
                    style="padding:25px;"
                >

                    Nuk ka transaksione.

                </td>

            </tr>


        <?php endif; ?>


        </tbody>

    </table>

</div>


<?php

/*
 * LLOGARIT NUMRIN E FAQEVE
 */

$totalPages = 1;

if ($per_page > 0) {

    $totalPages = (int) ceil(
        $total_transactions / $per_page
    );

}

if ($totalPages < 1) {
    $totalPages = 1;
}

?>


<?php if ($total_transactions > $per_page): ?>


    <div class="pagination-area">


        <!-- PARA -->

        <button
            type="button"
            class="btn btn-default debt-page-btn"
            data-page="<?php echo $page - 1; ?>"
            <?php echo $page <= 1 ? 'disabled' : ''; ?>
        >

            <i class="fa fa-angle-left"></i>

            Para

        </button>



        <!-- FAQJA -->

        <span class="page-info">

            Faqja

            <strong>
                <?php echo $page; ?>
            </strong>

            nga

            <strong>
                <?php echo $totalPages; ?>
            </strong>

        </span>



        <!-- TJETRA -->

        <button
            type="button"
            class="btn btn-default debt-page-btn"
            data-page="<?php echo $page + 1; ?>"
            <?php echo $page >= $totalPages ? 'disabled' : ''; ?>
        >

            Tjetra

            <i class="fa fa-angle-right"></i>

        </button>


    </div>


<?php endif; ?>