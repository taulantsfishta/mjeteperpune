<!DOCTYPE html>
<html lang="sq">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>LISTA E DETYRIMEV</title>

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
            transition: background-color 0.15s ease;
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

        /*
         * Mobile
         */
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


      <!-- BUTONI SHTO KLIENTIN -->

      <!-- SEARCH + SHTO KLIENTIN -->

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
                  placeholder="Kërko sipas emrit, adresës ose telefonit..."
                  autocomplete="off"
              >

          </div>

      </div>


      <div class="hidden-xs col-sm-2 col-md-4"></div>


      <div class="col-xs-12 col-sm-4 col-md-3">

          <a
              href="<?php echo base_url('admin/invoices/add_debt_client'); ?>"
              class="btn btn-block"
              style="background:#ffcd35;color:#1a1a1a;"
          >

              <i class="fa fa-plus"></i>
              &nbsp;&nbsp;
              Shto Klientin

          </a>

      </div>

  </div>

  <br>


    <!-- LISTA E KLIENTEVE -->

    <div class="row">

        <div class="col-lg-12">

            <div class="white-box">


                <table
                    class="tablesaw table-striped table-hover table-bordered table"
                    data-tablesaw-mode="columntoggle"
                    style="font-size:15px;font-family:Arial, Helvetica, sans-serif;">


                    <thead style="font-weight:bold;">

                        <tr>

                            <th>
                                ID
                            </th>

                            <th>
                                Emri i Klientit
                            </th>

                            <th>
                                Detyrimi Total
                            </th>

                        </tr>

                    </thead>


                    <tbody id="clientsTableBody">

                      <?php if (!empty($clients)): ?>

                          <?php foreach ($clients as $client): ?>

                              <tr
                                  class="clickable-row"
                                  data-href="<?php echo base_url(
                                      'admin/invoices/debt_client/' . $client['id']
                                  ); ?>"
                              >

                                  <td data-label="ID">
                                      <?php echo $client['id']; ?>
                                  </td>

                                  <td data-label="Emri i Klientit">

                                      <span class="client-name">

                                          <?php echo htmlspecialchars(
                                              $client['name'],
                                              ENT_QUOTES,
                                              'UTF-8'
                                          ); ?>

                                      </span>

                                  </td>

                                  <td data-label="Detyrimi Total">

                                      <span class="debt-amount">

                                          <?php echo number_format(
                                              (float)$client['total_debt'],
                                              2,
                                              '.',
                                              ','
                                          ); ?> €

                                      </span>

                                  </td>

                              </tr>

                          <?php endforeach; ?>

                      <?php endif; ?>

                  </tbody>


                </table>


            </div>

        </div>

    </div>



    <script>

        $(document).ready(function () {


            /*
             * Klikimi kudo në rresht
             * e hap faqen e detajeve të klientit.
             */

            $(document).on(
                'click',
                '.clickable-row',
                function () {

                    var href = $(this).data('href');

                    if (href) {

                        window.location.href = href;

                    }

                }
            );


        });

    </script>

    <script>

    $(document).ready(function () {

        var searchTimer;


        /*
        * SEARCH AJAX
        */
        $('#clientSearch').on('keyup', function () {

            clearTimeout(searchTimer);

            var search = $(this).val();


            searchTimer = setTimeout(function () {

                $.ajax({

                    url: '<?php echo base_url("admin/invoices/search_debt_clients"); ?>',

                    type: 'GET',

                    data: {
                        search: search
                    },

                    beforeSend: function () {

                        $('#clientsTableBody').html(
                            '<tr>' +
                                '<td colspan="3" class="text-center" style="padding:25px;">' +
                                    '<i class="fa fa-spinner fa-spin"></i> Duke kërkuar...' +
                                '</td>' +
                            '</tr>'
                        );

                    },

                    success: function (response) {

                        $('#clientsTableBody').html(response);

                    },

                    error: function () {

                        $('#clientsTableBody').html(
                            '<tr>' +
                                '<td colspan="3" class="text-center text-danger" style="padding:25px;">' +
                                    'Ndodhi një gabim gjatë kërkimit.' +
                                '</td>' +
                            '</tr>'
                        );

                    }

                });

            }, 300);

        });



        /*
        * HAP DETAJET E KLIENTIT
        */
        $(document).on('click', '.clickable-row', function () {

            var href = $(this).data('href');

            if (href) {
                window.location.href = href;
            }

        });

    });

    </script>


</body>

</html>
