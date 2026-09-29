<!DOCTYPE html>
<html lang="sq">

<head>

    <meta charset="utf-8">

    <title>Klientët e fshirë</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f7f8fa;
        }

        .white-box {
            background: #fff;
            border: 1px solid #e4e7ea;
            border-radius: 12px;
            padding: 16px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, .06);
        }

        .deleted-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .btn-restore {
            background: #5cb85c;
            color: #fff !important;
            border: 1px solid #4cae4c;
        }

        .btn-restore:hover {
            background: #449d44;
        }

        @media (max-width: 767px) {

            table thead {
                display: none;
            }

            table tbody tr {
                display: block;
                border: 1px solid #e4e7ea;
                border-radius: 10px;
                padding: 10px;
                margin-bottom: 12px;
                background: #fff;
            }

            table tbody td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 8px 6px;
                border: 0;
            }

            table tbody td:not(:last-child) {
                border-bottom: 1px dashed #eef0f3;
            }

            table tbody td::before {
                content: attr(data-label);
                font-weight: bold;
                margin-right: 15px;
            }
        }
    </style>

</head>

<body>


    <div class="row">

        <div class="col-xs-12">

            <a
                href="<?php echo base_url('admin/invoices/debt_invoices'); ?>"
                class="btn btn-default">

                <i class="fa fa-arrow-left"></i>
                Kthehu te Detyrimet

            </a>

        </div>

    </div>


    <br>


    <?php if ($this->session->flashdata('success')): ?>

        <div class="alert alert-success">

            <i class="fa fa-check"></i>

            <?php
            echo htmlspecialchars(
                $this->session->flashdata('success'),
                ENT_QUOTES,
                'UTF-8'
            );
            ?>

        </div>

    <?php endif; ?>


    <div class="row">

        <div class="col-lg-12">

            <div class="white-box">

                <div class="deleted-title">

                    <i class="fa fa-trash"></i>
                    Klientët e fshirë

                </div>


                <table
                    class="table table-striped table-hover table-bordered"
                    style="font-size:15px;">

                    <thead>

                        <tr>

                            <th style="width:70px;">
                                ID
                            </th>

                            <th>
                                Emri i Klientit
                            </th>

                            <th>
                                Adresa
                            </th>

                            <th>
                                Telefoni
                            </th>

                            <th
                                class="text-center"
                                style="width:150px;">

                                Veprimi

                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php if (!empty($clients)): ?>

                            <?php foreach ($clients as $client): ?>

                                <tr>

                                    <td data-label="ID">

                                        <?php
                                        echo (int)$client['id'];
                                        ?>

                                    </td>


                                    <td data-label="Emri">

                                        <strong>

                                            <?php
                                            echo htmlspecialchars(
                                                $client['name'],
                                                ENT_QUOTES,
                                                'UTF-8'
                                            );
                                            ?>

                                        </strong>

                                    </td>


                                    <td data-label="Adresa">

                                        <?php
                                        echo htmlspecialchars(
                                            !empty($client['address'])
                                                ? $client['address']
                                                : '-',
                                            ENT_QUOTES,
                                            'UTF-8'
                                        );
                                        ?>

                                    </td>


                                    <td data-label="Telefoni">

                                        <?php
                                        echo htmlspecialchars(
                                            !empty($client['phone'])
                                                ? $client['phone']
                                                : '-',
                                            ENT_QUOTES,
                                            'UTF-8'
                                        );
                                        ?>

                                    </td>


                                    <td
                                        data-label="Veprimi"
                                        class="text-center">

                                        <a
                                            href="<?php
                                                    echo base_url(
                                                        'admin/invoices/restore_debt_client/' .
                                                            (int)$client['id']
                                                    );
                                                    ?>"
                                            class="btn btn-restore btn-sm"
                                            onclick="return confirm(
                                        'A dëshironi ta riktheni këtë klient?'
                                    );">

                                            <i class="fa fa-undo"></i>

                                            Rikthe

                                        </a>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>

                                <td
                                    colspan="5"
                                    class="text-center"
                                    style="padding:30px;">

                                    Nuk ka klientë të fshirë.

                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>


</body>

</html>