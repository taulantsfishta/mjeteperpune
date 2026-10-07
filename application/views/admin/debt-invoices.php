<!DOCTYPE html>
<html lang="sq">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>LISTA E DETYRIMEVE</title>

    <style>
        :root {
            --border: #e4e7ea;
            --radius: 12px;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f7f8fa;
        }

        .white-box {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 16px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, .06);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            white-space: nowrap;
        }

        .clickable-row {
            cursor: pointer;
            transition: background-color .15s ease;
        }

        .clickable-row:hover {
            background-color: #f3f5f7 !important;
        }

        .debt-amount {
            font-weight: bold;
            color: #d9534f;
        }

        .client-name {
            font-weight: bold;
        }

        .action-buttons .btn {
            margin: 2px;
        }

        @media (max-width: 767px) {
            table thead {
                display: none;
            }

            table tbody tr {
                display: block;
                border: 1px solid var(--border);
                border-radius: 10px;
                padding: 10px;
                margin-bottom: 12px;
                background: #fff;
            }

            table tbody td {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                padding: 8px 6px;
                border: 0;
            }

            table tbody td:not(:last-child) {
                border-bottom: 1px dashed #eef0f3;
            }

            table tbody td::before {
                content: attr(data-label);
                font-weight: 600;
                margin-right: 12px;
            }
        }
    </style>
</head>

<body>
    <?php if (!empty($debtIsAdmin) && !empty($debtUserOptions)): ?>
        <div class="row" style="margin-bottom:15px;">
            <div class="col-xs-12 col-sm-5 col-md-4">
                <label for="debtUserSelect">Shfaq detyrimet e:</label>

                <select id="debtUserSelect" class="form-control">
                    <?php foreach ($debtUserOptions as $user): ?>
                        <option
                            value="<?php echo (int)$user['id']; ?>"
                            <?php echo ((int)$user['id'] === (int)$debtSelectedUserId) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($user['display_name'], ENT_QUOTES, 'UTF-8'); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    <?php endif; ?>

    <div class="row">

        <div class="col-xs-12 col-sm-6 col-md-5">
            <div class="input-group" style="width:100%;">
                <span class="input-group-addon">
                    <i class="fa fa-search"></i>
                </span>

                <input
                    type="text"
                    id="clientSearch"
                    class="form-control"
                    value="<?php echo htmlspecialchars(isset($search) ? $search : '', ENT_QUOTES, 'UTF-8'); ?>"
                    placeholder="Kërko klientin..."
                    autocomplete="off">
            </div>
        </div>

        <div class="hidden-xs col-sm-2 col-md-4"></div>

        <div class="col-xs-12 col-sm-4 col-md-3">
            <?php if (!empty($debtCanModify)): ?>
                <a
                    href="<?php echo base_url('admin/invoices/add_debt_client'); ?>"
                    class="btn btn-block"
                    style="background:#ffcd35;color:#1a1a1a;">
                    <i class="fa fa-plus"></i>&nbsp;&nbsp; Shto Klientin
                </a>
            <?php endif; ?>
        </div>

    </div>

    <br>

    <div class="row">
        <div class="col-lg-12">
            <div class="white-box">

                <table
                    class="tablesaw table-striped table-hover table-bordered table"
                    data-tablesaw-mode="columntoggle"
                    style="font-size:15px;font-family:Arial,Helvetica,sans-serif;">

                    <thead style="font-weight:bold;">
                        <tr>
                            <th>ID</th>
                            <th>Emri i Klientit</th>
                            <th>Detyrimi Total</th>
                            <th>Veprimi</th>
                        </tr>
                    </thead>

                    <tbody id="clientsTableBody">

                        <?php if (!empty($clients)): ?>

                            <?php foreach ($clients as $client): ?>

                                <?php
                                $detailUrl = base_url(
                                    'admin/invoices/debt_client/' . (int)$client['id']
                                ) . '?debt_user_id=' . (int)$debtSelectedUserId;

                                $editUrl = base_url(
                                    'admin/invoices/edit_debt_client/' . (int)$client['id']
                                );

                                $deleteUrl = base_url(
                                    'admin/invoices/delete_debt_client/' . (int)$client['id']
                                ) . '?debt_user_id=' . (int)$debtSelectedUserId;
                                ?>

                                <tr
                                    class="clickable-row"
                                    data-href="<?php echo htmlspecialchars($detailUrl, ENT_QUOTES, 'UTF-8'); ?>">

                                    <td data-label="ID">
                                        <?php echo (int)$client['id']; ?>
                                    </td>

                                    <td data-label="Emri i Klientit">
                                        <span class="client-name">
                                            <?php echo htmlspecialchars($client['name'], ENT_QUOTES, 'UTF-8'); ?>
                                        </span>
                                    </td>

                                    <td data-label="Detyrimi Total">
                                        <span class="debt-amount">
                                            <?php echo number_format((float)$client['total_debt'], 2, '.', ','); ?> €
                                        </span>
                                    </td>

                                    <td data-label="Veprimi" class="text-center action-buttons">

                                        <?php if (!empty($debtCanModify) && !empty($debtIsAdmin)): ?>

                                            <a
                                                href="<?php echo htmlspecialchars($editUrl, ENT_QUOTES, 'UTF-8'); ?>"
                                                class="btn btn-primary btn-sm"
                                                onclick="event.stopPropagation();">
                                                <i class="fa fa-pencil"></i> Edito
                                            </a>

                                            <a
                                                href="<?php echo htmlspecialchars($deleteUrl, ENT_QUOTES, 'UTF-8'); ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="event.stopPropagation(); return confirm('A jeni i sigurt që dëshironi ta largoni këtë klient nga lista? Klienti dhe historia e detyrimeve nuk do të fshihen nga databaza.');">
                                                <i class="fa fa-trash"></i> Fshi
                                            </a>

                                        <?php else: ?>

                                            <span class="text-muted">-</span>

                                        <?php endif; ?>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>
                                <td colspan="4" class="text-center" style="padding:30px;">
                                    Nuk u gjet asnjë klient.
                                </td>
                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            var searchTimer;
            var selectedUserId = <?php echo (int)$debtSelectedUserId; ?>;

            $(document).on('click', '.clickable-row', function() {
                var href = $(this).data('href');

                if (href) {
                    window.location.href = href;
                }
            });

            $('#debtUserSelect').on('change', function() {

                var userId = $(this).val();

                window.location.href =
                    '<?php echo base_url("admin/invoices/debt_invoices"); ?>' +
                    '?debt_user_id=' + encodeURIComponent(userId);
            });

            $('#clientSearch').on('keyup', function() {

                clearTimeout(searchTimer);

                var search = $(this).val();

                searchTimer = setTimeout(function() {

                    $.ajax({

                        url: '<?php echo base_url("admin/invoices/search_debt_clients"); ?>',

                        type: 'GET',

                        data: {
                            search: search,
                            debt_user_id: selectedUserId
                        },

                        beforeSend: function() {

                            $('#clientsTableBody').html(
                                '<tr>' +
                                '<td colspan="4" class="text-center" style="padding:25px;">' +
                                '<i class="fa fa-spinner fa-spin"></i> Duke kërkuar...' +
                                '</td>' +
                                '</tr>'
                            );
                        },

                        success: function(response) {

                            $('#clientsTableBody').html(response);
                        },

                        error: function() {

                            $('#clientsTableBody').html(
                                '<tr>' +
                                '<td colspan="4" class="text-center text-danger" style="padding:25px;">' +
                                'Ndodhi një gabim gjatë kërkimit.' +
                                '</td>' +
                                '</tr>'
                            );
                        }

                    });

                }, 300);

            });

        });
    </script>

</body>

</html>