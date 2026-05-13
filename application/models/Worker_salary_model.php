<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Worker_salary_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_worker($worker_id)
    {
        return $this->db
            ->where('id', $worker_id)
            ->get('workers')
            ->row_array();
    }

    public function get_or_create_salary_month($worker_id, $month, $year)
    {
        $salary_month_row = $this->db
            ->where('worker_id', $worker_id)
            ->where('salary_month', $month)
            ->where('salary_year', $year)
            ->get('worker_salary_months')
            ->row_array();

        if (!$salary_month_row) {
            $worker = $this->get_worker($worker_id);

            if (!$worker) {
                return false;
            }

            $current_month = (int) date('m');
            $current_year = (int) date('Y');

            $selected_index = ($year * 12) + $month;
            $current_index = ($current_year * 12) + $current_month;

            $status = 'open';

            // nëse muaji është në të kaluarën, krijohet i mbyllur
            if ($selected_index < $current_index) {
                $status = 'closed';
            }

            $insert_data = array(
                'worker_id' => $worker_id,
                'salary_month' => $month,
                'salary_year' => $year,
                'base_salary' => (float) $worker['base_salary'],
                'absent_days' => 0,
                'absent_deduction' => 0,
                'total_loans' => 0,
                'total_paid' => 0,
                'carry_forward' => 0,
                'final_salary' => (float) $worker['base_salary'],
                'remaining_salary' => (float) $worker['base_salary'],
                'status' => $status,
                'created_at' => current_datetime(),
                'updated_at' => current_datetime()
            );

            $insert_data = $this->security->xss_clean($insert_data);
            $this->db->insert('worker_salary_months', $insert_data);

            $salary_month_row = $this->db
                ->where('worker_id', $worker_id)
                ->where('salary_month', $month)
                ->where('salary_year', $year)
                ->get('worker_salary_months')
                ->row_array();
        }

        return $salary_month_row;
    }
    public function get_absences($worker_id, $month, $year)
    {
        return $this->db
            ->where('worker_id', $worker_id)
            ->where('MONTH(created_at) = ' . (int)$month, null, false)
            ->where('YEAR(created_at) = ' . (int)$year, null, false)
            ->order_by('created_at', 'DESC')
            ->get('worker_absences')
            ->result_array();
    }

    public function get_loans($worker_id, $month, $year)
    {
        return $this->db
            ->where('worker_id', $worker_id)
            ->where('salary_month', $month)
            ->where('salary_year', $year)
            ->order_by('id', 'DESC')
            ->get('worker_loans')
            ->result_array();
    }

    public function get_payments($worker_id, $month, $year)
    {
        return $this->db
            ->where('worker_id', $worker_id)
            ->where('salary_month', $month)
            ->where('salary_year', $year)
            ->order_by('created_at', 'DESC')
            ->get('worker_salary_payments')
            ->result_array();
    }


    public function refresh_worker_month_details($worker_id, $month, $year)
    {
        $worker = $this->get_worker($worker_id);

        if (!$worker) {
            return false;
        }

        $salary_month_row = $this->get_or_create_salary_month($worker_id, $month, $year);

        if (!$salary_month_row) {
            return false;
        }

        $absences = $this->get_absences($worker_id, $month, $year);
        $loans = $this->get_loans($worker_id, $month, $year);

        $installment_data = $this->get_total_installment_deductions($worker_id, $month, $year);
        $installment_loans = $installment_data['rows'];
        $total_installment_loans = (float) $installment_data['total'];

        $payments = $this->get_payments($worker_id, $month, $year);

        $absent_days = 0;
        $total_absent_hours = 0;

        foreach ($absences as $absence) {
            $days = isset($absence['days']) ? (float)$absence['days'] : 0;
            $hours = isset($absence['hours']) ? (float)$absence['hours'] : 0;

            $absent_days += $days;
            $total_absent_hours += $hours;
        }

        // 8 orë = 1 ditë pune
        $absent_days_from_hours = $total_absent_hours / 8;

        $total_absent_days = $absent_days + $absent_days_from_hours;

        $monthly_loans_total = 0;
        foreach ($loans as $loan) {
            $monthly_loans_total += (float) $loan['amount'];
        }

        $total_loans = $monthly_loans_total + $total_installment_loans;

        $total_paid = 0;
        foreach ($payments as $payment) {
            $total_paid += (float) $payment['amount'];
        }

        $last_closed_salary_month_row = $this->get_last_closed_salary_month_row($worker_id, $month, $year);

        $carry_forward = 0;
        if ($last_closed_salary_month_row) {
            $previous_remaining = (float) $last_closed_salary_month_row['remaining_salary'];

            // Bart vetëm tejpagesën / balancin negativ nga muaji i fundit i mbyllur
            if ($previous_remaining < 0) {
                $carry_forward = $previous_remaining;
            }
        }

        // nëse muaji është open, përditëso pagën me atë aktuale
        if ($salary_month_row['status'] == 'open') {
            $this->db->where('id', $salary_month_row['id']);
            $this->db->update('worker_salary_months', [
                'base_salary' => $worker['base_salary']
            ]);

            // rifresko row
            $salary_month_row['base_salary'] = $worker['base_salary'];
        }

        $base_salary = (float) $salary_month_row['base_salary'];
        $daily_salary = $base_salary / 30;
        $absent_deduction = $daily_salary * $total_absent_days;
        $final_salary = $base_salary - $absent_deduction - $total_loans;
        $remaining_salary = $final_salary - $total_paid + $carry_forward;

        $absent_days = round($absent_days, 2);
        $absent_days = round($absent_days, 2);
        $total_absent_hours = round($total_absent_hours, 2);
        $total_absent_days = round($total_absent_days, 2);
        $monthly_loans_total = round($monthly_loans_total, 2);
        $total_installment_loans = round($total_installment_loans, 2);
        $total_loans = round($total_loans, 2);
        $total_paid = round($total_paid, 2);
        $carry_forward = round($carry_forward, 2);
        $final_salary = round($final_salary, 2);
        $remaining_salary = round($remaining_salary, 2);

        $update_data = array(
            'base_salary' => $base_salary,
            'absent_days' => $total_absent_days,
            'absent_deduction' => $absent_deduction,
            'total_loans' => $total_loans,
            'total_paid' => $total_paid,
            'carry_forward' => $carry_forward,
            'final_salary' => $final_salary,
            'remaining_salary' => $remaining_salary,
            'updated_at' => current_datetime()
        );

        $update_data = $this->security->xss_clean($update_data);

        $this->db->where('id', $salary_month_row['id']);
        $this->db->update('worker_salary_months', $update_data);

        $salary_month_row = $this->db
            ->where('worker_id', $worker_id)
            ->where('salary_month', $month)
            ->where('salary_year', $year)
            ->get('worker_salary_months')
            ->row_array();

        return array(
            'worker' => $worker,
            'salary_month_row' => $salary_month_row,
            'salary_summary' => array(
                'base_salary' => (float) $salary_month_row['base_salary'],
                'absent_days' => (float) $salary_month_row['absent_days'],
                'absent_days_only' => $absent_days,
                'absent_hours_only' => $total_absent_hours,
                'absent_deduction' => (float) $salary_month_row['absent_deduction'],
                'total_loans' => (float) $salary_month_row['total_loans'],
                'total_paid' => (float) $salary_month_row['total_paid'],
                'carry_forward' => (float) $salary_month_row['carry_forward'],
                'carry_forward_source_month' => $last_closed_salary_month_row ? (int)$last_closed_salary_month_row['salary_month'] : null,
                'carry_forward_source_year' => $last_closed_salary_month_row ? (int)$last_closed_salary_month_row['salary_year'] : null,
                'final_salary' => (float) $salary_month_row['final_salary'],
                'remaining_salary' => (float) $salary_month_row['remaining_salary'],
                'status' => $salary_month_row['status']
            ),
            'absences' => $absences,
            'loans' => $loans,
            'installment_loans' => $installment_loans,
            'payments' => $payments,
            'monthly_loans_total' => $monthly_loans_total,
            'total_installment_loans' => $total_installment_loans
        );
    }
    public function add_loan($worker_id, $month, $year, $amount, $note = null)
    {
        $worker = $this->get_worker($worker_id);

        if (!$worker) {
        return false;
        }

        $insert_data = array(
        'worker_id' => (int) $worker_id,
        'salary_month' => (int) $month,
        'salary_year' => (int) $year,
        'amount' => round((float) $amount, 2),
        'note' => $note,
        'created_at' => current_datetime(),
        'updated_at' => current_datetime()
        );

        $insert_data = $this->security->xss_clean($insert_data);

        $result = $this->db->insert('worker_loans', $insert_data);

        return $result;
    }

    public function add_payment($worker_id, $month, $year, $amount, $created_at, $note = null)
    {
        $worker = $this->get_worker($worker_id);

        if (!$worker) {
            return false;
        }

        $insert_data = array(
            'worker_id' => (int) $worker_id,
            'salary_month' => (int) $month,
            'salary_year' => (int) $year,
            'amount' => round((float) $amount, 2),
            'created_at' => $created_at,
            'note' => $note,
            'created_at' => current_datetime(),
            'updated_at' => current_datetime()
        );

        $insert_data = $this->security->xss_clean($insert_data);

        return $this->db->insert('worker_salary_payments', $insert_data);
    }

    public function get_installment_loans($worker_id)
    {
        return $this->db
            ->where('worker_id', $worker_id)
            ->where('status', 'active')
            ->order_by('id', 'DESC')
            ->get('worker_installment_loans')
            ->result_array();
    }

    public function get_installment_month_deduction($loan, $selected_month, $selected_year)
    {
        $start_month = (int) $loan['start_month'];
        $start_year = (int) $loan['start_year'];
        $total_amount = (float) $loan['total_amount'];
        $monthly_amount = (float) $loan['monthly_amount'];

        if ($monthly_amount <= 0 || $total_amount <= 0) {
            return 0;
        }

        // sa muaj diferencë ka prej nisjes deri te muaji i zgjedhur
        $month_diff = (($selected_year - $start_year) * 12) + ($selected_month - $start_month);

        // nëse muaji është para nisjes së huazimit
        if ($month_diff < 0) {
            return 0;
        }

        // numri total i kësteve
        $total_installments = (int) ceil($total_amount / $monthly_amount);

        // nëse ka përfunduar periudha e kësteve
        if ($month_diff >= $total_installments) {
            return 0;
        }

        // sa është paguar para këtij muaji
        $paid_before_this_month = $month_diff * $monthly_amount;

        // sa mbetet para këtij muaji
        $remaining_before_this_month = $total_amount - $paid_before_this_month;

        if ($remaining_before_this_month <= 0) {
            return 0;
        }

        // për muajin aktual zbrit minimumin
        return round(min($monthly_amount, $remaining_before_this_month), 2);
    }

    public function get_total_installment_deductions($worker_id, $selected_month, $selected_year)
    {
        $installment_loans = $this->get_installment_loans($worker_id);

        $total = 0;
        $loan_rows = array();

    foreach ($installment_loans as $loan) {
        $month_deduction = $this->get_installment_month_deduction($loan, $selected_month, $selected_year);

        if ($month_deduction > 0) {
            $start_month = (int) $loan['start_month'];
            $start_year = (int) $loan['start_year'];
            $total_amount = (float) $loan['total_amount'];
            $monthly_amount = (float) $loan['monthly_amount'];

            $month_diff = (($selected_year - $start_year) * 12) + ($selected_month - $start_month);

            $paid_before_this_month = $month_diff * $monthly_amount;
            if ($paid_before_this_month < 0) {
                $paid_before_this_month = 0;
            }

            $paid_until_this_month = $paid_before_this_month + $month_deduction;
            if ($paid_until_this_month > $total_amount) {
                $paid_until_this_month = $total_amount;
            }

            $remaining_after_this_month = $total_amount - $paid_until_this_month;
            if ($remaining_after_this_month < 0) {
                $remaining_after_this_month = 0;
            }

            $total_installments = (int) ceil($total_amount / $monthly_amount);

            $end_index = ($start_year * 12 + $start_month - 1) + ($total_installments - 1);
            $end_year = (int) floor($end_index / 12);
            $end_month = (int) (($end_index % 12) + 1);

            $loan['month_deduction'] = round($month_deduction, 2);
            $loan['paid_until_this_month'] = round($paid_until_this_month, 2);
            $loan['remaining_after_this_month'] = round($remaining_after_this_month, 2);
            $loan['end_month'] = $end_month;
            $loan['end_year'] = $end_year;

            $loan_rows[] = $loan;
            $total += $month_deduction;
        }
    }

        return array(
            'total' => round($total, 2),
            'rows' => $loan_rows
        );
    }

    public function add_installment_loan($worker_id, $total_amount, $monthly_amount, $start_month, $start_year, $note = null)
    {
        $worker = $this->get_worker($worker_id);

        if (!$worker) {
            return false;
        }

        $insert_data = array(
            'worker_id' => (int) $worker_id,
            'total_amount' => round((float) $total_amount, 2),
            'monthly_amount' => round((float) $monthly_amount, 2),
            'start_month' => (int) $start_month,
            'start_year' => (int) $start_year,
            'note' => $note,
            'status' => 'active',
            'created_at' => current_datetime(),
            'updated_at' => current_datetime()
        );

        $insert_data = $this->security->xss_clean($insert_data);

        return $this->db->insert('worker_installment_loans', $insert_data);
    }

    public function get_last_existing_salary_month_row($worker_id, $month, $year)
    {
        $current_index = ((int)$year * 12) + (int)$month;

        $rows = $this->db
            ->where('worker_id', $worker_id)
            ->get('worker_salary_months')
            ->result_array();

        $last_row = null;
        $last_index = -1;

        foreach ($rows as $row) {
            $row_index = ((int)$row['salary_year'] * 12) + (int)$row['salary_month'];

            if ($row_index < $current_index && $row_index > $last_index) {
                $last_index = $row_index;
                $last_row = $row;
            }
        }

        return $last_row;
    }

    public function get_salary_month_row($worker_id, $month, $year)
    {
        return $this->db
            ->where('worker_id', $worker_id)
            ->where('salary_month', $month)
            ->where('salary_year', $year)
            ->get('worker_salary_months')
            ->row_array();
    }

    public function close_salary_month($worker_id, $month, $year)
    {
        $salary_month_row = $this->get_salary_month_row($worker_id, $month, $year);

        if (!$salary_month_row) {
            return false;
        }

        $this->db->where('id', $salary_month_row['id']);
        return $this->db->update('worker_salary_months', array(
            'status' => 'closed',
            'updated_at' => current_datetime()
        ));
    }

    public function reopen_salary_month($worker_id, $month, $year)
    {
        $salary_month_row = $this->get_salary_month_row($worker_id, $month, $year);

        if (!$salary_month_row) {
            return false;
        }

        $this->db->where('id', $salary_month_row['id']);
        return $this->db->update('worker_salary_months', array(
            'status' => 'open',
            'updated_at' => current_datetime()
        ));
    }

    public function get_last_closed_salary_month_row($worker_id, $month, $year)
    {
        $current_index = ((int)$year * 12) + (int)$month;

        $rows = $this->db
            ->where('worker_id', $worker_id)
            ->where('status', 'closed')
            ->get('worker_salary_months')
            ->result_array();

        $last_row = null;
        $last_index = -1;

        foreach ($rows as $row) {
            $row_index = ((int)$row['salary_year'] * 12) + (int)$row['salary_month'];

            if ($row_index < $current_index && $row_index > $last_index) {
                $last_index = $row_index;
                $last_row = $row;
            }
        }

        return $last_row;
    }

    public function add_absence($worker_id, $created_at, $absence_type, $value, $note = null)
    {
        $worker = $this->get_worker($worker_id);

        if (!$worker) {
            return false;
        }

        $days = 0;
        $hours = 0;

        if ($absence_type === 'day') {
            $days = round((float) $value, 2);
        } elseif ($absence_type === 'hour') {
            $hours = round((float) $value, 2);
        } else {
            return false;
        }

        $insert_data = array(
            'worker_id' => (int) $worker_id,
            'absence_type' => $absence_type,
            'days' => $days,
            'hours' => $hours,
            'note' => $note,
            'created_at' => current_datetime(),
            'updated_at' => current_datetime()
        );

        $insert_data = $this->security->xss_clean($insert_data);

        return $this->db->insert('worker_absences', $insert_data);
    }

    public function get_absence_by_id($absence_id)
    {
        return $this->db
            ->where('id', $absence_id)
            ->get('worker_absences')
            ->row_array();
    }

    public function delete_absence($absence_id)
    {
        $this->db->where('id', $absence_id);
        return $this->db->delete('worker_absences');
    }

    public function get_loan_by_id($loan_id)
    {
        return $this->db
            ->where('id', $loan_id)
            ->get('worker_loans')
            ->row_array();
    }

    public function delete_loan($loan_id)
    {
        $this->db->where('id', $loan_id);
        return $this->db->delete('worker_loans');
    }

    public function get_payment_by_id($payment_id)
    {
        return $this->db
            ->where('id', $payment_id)
            ->get('worker_salary_payments')
            ->row_array();
    }

    public function delete_payment($payment_id)
    {
        $this->db->where('id', $payment_id);
        return $this->db->delete('worker_salary_payments');
    }


    public function get_installment_loan_by_id($installment_loan_id)
    {
        return $this->db
            ->where('id', $installment_loan_id)
            ->get('worker_installment_loans')
            ->row_array();
    }

    public function delete_installment_loan($installment_loan_id)
    {
        $this->db->where('id', $installment_loan_id);
        return $this->db->delete('worker_installment_loans');
    }

    public function get_monthly_salary_report($month, $year)
    {
        $workers = $this->db
            ->order_by('id', 'DESC')
            ->get('workers')
            ->result_array();

        $rows = array();
        $grand_total = 0;

        foreach ($workers as $worker) {
            $details = $this->refresh_worker_month_details($worker['id'], $month, $year);

            if ($details) {
                $rows[] = array(
                    'worker_id' => $worker['id'],
                    'worker_name' => $details['worker']['workers_name'],
                    'base_salary' => (float) $details['salary_summary']['base_salary'],
                    'absent_days' => (float) $details['salary_summary']['absent_days'],
                    'absent_deduction' => (float) $details['salary_summary']['absent_deduction'],
                    'total_loans' => (float) $details['salary_summary']['total_loans'],
                    'total_paid' => (float) $details['salary_summary']['total_paid'],
                    'carry_forward' => (float) $details['salary_summary']['carry_forward'],
                    'final_salary' => (float) $details['salary_summary']['final_salary'],
                    'remaining_salary' => (float) $details['salary_summary']['remaining_salary'],
                    'status' => $details['salary_summary']['status'],
                    'monthly_loans_total' => isset($details['monthly_loans_total']) ? (float) $details['monthly_loans_total'] : 0,
                    'total_installment_loans' => isset($details['total_installment_loans']) ? (float) $details['total_installment_loans'] : 0,
                );

                $grand_total += (float) $details['salary_summary']['remaining_salary'];
            }
        }

        return array(
            'rows' => $rows,
            'grand_total' => round($grand_total, 2)
        );
    }

    public function update_absence($absence_id, $created_at, $absence_type, $value, $note = null)
    {
        $absence = $this->get_absence_by_id($absence_id);

        if (!$absence) {
            return false;
        }

        $days = 0;
        $hours = 0;

        if ($absence_type === 'day') {
            $days = round((float) $value, 2);
        } elseif ($absence_type === 'hour') {
            $hours = round((float) $value, 2);
        } else {
            return false;
        }

        $update_data = array(
            'created_at' => current_datetime(),
            'absence_type' => $absence_type,
            'days' => $days,
            'hours' => $hours,
            'note' => $note,
            'updated_at' => current_datetime()
        );

        $update_data = $this->security->xss_clean($update_data);

        $this->db->where('id', $absence_id);
        return $this->db->update('worker_absences', $update_data);
    }

    public function update_loan($loan_id, $loan_date, $amount, $note = null)
    {
        $loan = $this->get_loan_by_id($loan_id);

        if (!$loan) {
            return false;
        }

        $update_data = array(
            'created_at' => current_datetime(),
            'amount' => round((float) $amount, 2),
            'note' => $note,
            'updated_at' => current_datetime()
        );

        $update_data = $this->security->xss_clean($update_data);

        $this->db->where('id', $loan_id);
        return $this->db->update('worker_loans', $update_data);
    }

    public function update_payment($payment_id, $created_at, $amount, $note = null)
    {
        $payment = $this->get_payment_by_id($payment_id);

        if (!$payment) {
            return false;
        }

        $update_data = array(
            'created_at' => current_datetime(),
            'amount' => round((float) $amount, 2),
            'note' => $note,
            'updated_at' => current_datetime()
        );

        $update_data = $this->security->xss_clean($update_data);

        $this->db->where('id', $payment_id);
        return $this->db->update('worker_salary_payments', $update_data);
    }

    public function update_installment_loan(
        $loan_id,
        $total_amount,
        $monthly_amount,
        $start_month,
        $start_year,
        $note = null
    ) {
        $loan = $this->get_installment_loan_by_id($loan_id);

        if (!$loan) {
            return false;
        }

        $update_data = array(
            'total_amount' => round((float)$total_amount, 2),
            'monthly_amount' => round((float)$monthly_amount, 2),
            'start_month' => (int)$start_month,
            'start_year' => (int)$start_year,
            'note' => $note,
            'updated_at' => current_datetime()
        );

        $update_data = $this->security->xss_clean($update_data);

        $this->db->where('id', $loan_id);

        return $this->db->update('worker_installment_loans', $update_data);
    }

}