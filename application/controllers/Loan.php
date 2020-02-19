<?php

/**
 * Created by PhpStorm.
 * User: buddhi_hasanka
 * Date: 09-Feb-19
 * Time: 5:05 PM
 */

defined('BASEPATH') or exit('No direct script access allowed');

class Loan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url_helper');
        $this->load->model('loan_model');
        $this->load->model('customer_model');
        $this->load->helper('form');
        $this->load->library('session');
    }


    //    ------------------------------ Views -----------------------------------

    public function loans()
    {

        $data['get_loans'] = $this->loan_model->get_loans();
        $data['get_loanTypes'] = $this->loan_model->get_loan_types();
        $data['rowCount'] = array(10, 20, 50, 100);
        $this->checkLoans();

        $this->load->view('templates/header');
        $this->load->view('loan/loans', $data);
        $this->load->view('templates/footer');
    }

    public function show_loan($id)
    {
        $data['loan_id'] = $id;
        $data['get_loan_detail'] = $this->loan_model->get_customer_loans(array('idloan' => $id));
        $data['get_loan_schedule_detail'] = $this->loan_model->get_loan_schedule(array('idloan' => $id));
        $data['get_last_loan_payment_log'] = $this->loan_model->get_last_loan_payment_log(array('idloan' => $id));
        $data['get_loan_payment_log'] = $this->loan_model->get_loan_payment_log(array('idloan' => $id));
        $data['rowCount'] = array(10, 20, 50, 100);

        $this->load->view('templates/header');
        $this->load->view('loan/show_loan', $data);
        $this->load->view('templates/footer');
    }

    //    ------------------------------ Views -----------------------------------


    public function loan_create()
    {


        $customer = $this->customer_model->get_customer(array('memnumber' => $this->input->post('loan_cid')));

        if (!empty($customer) && !empty($customer[0]) && !empty($customer[0]['idcustomer'])) {

            //     // $currentDate = date("Y-m-d H:i:s");
            $currentDate = new DateTime(date('Y-m-d H:i:s'));
            //     // if ($this->input->post('loan_date')) {
            //     //     $currentDate = new DateTime($this->input->post('loan_date'));
            //     // }

            $amount = $this->input->post('loan_amount');
            $duration = $this->input->post('loan_duration');

            $installment = $this->loan_model->round_up(($amount / $duration), 2);

            $data = array(
                'idcustomer' => $customer[0]['idcustomer'],
                'idloan_type' => $this->input->post('loan_type'),
                'amount' => $this->input->post('loan_amount'),
                'installment' => $installment,
                'interest' => $this->input->post('loan_interest'),
                'duration' => $this->input->post('loan_duration'),
                'iduser' => '1',
                'status' => "Active",
                // 'status' => $this->input->post('loan_status'),
                'date' => $currentDate->format('Y-m-d H:i:s'),
                // 'is_old_loan' => false,
                // 'is_fixed' => false,
                // 'is_delete' => false,
            );


            $data_payment_schedule = array();

            $date = $currentDate->format("d");
            $month = $currentDate->format("m");
            $year = $currentDate->format("Y");
            $time = $currentDate->format("H:i:s");

            foreach (range(1, $duration) as $i) {

                $d = new DateTime($year . '-' . $month . '-' . $date);
                $installment_date = '';

                if ($d->format('d') !== $date) {

                    $td = new DateTime($year . '-' . $d->format('m') . '-' . $date);
                    $installment_date = $td->format('Y-m-d');
                    //                echo '------------------------------------------------ ' . $td->format('Y - m - d'), "\n<br>";
                    $month = $td->format('m');
                    $year = $td->format('Y');
                } else {

                    $d->modify('next month');

                    if ($d->format('d') !== $date) {

                        $td = new DateTime($year . '-' . $month . '-01');
                        $td->modify('last day of next month');
                        $installment_date = $td->format('Y-m-d');
                        //                    echo '------------------------------------------------ ' . $td->format('Y - m - d'), "\n<br>";
                        $month = $td->format('m');
                        $year = $td->format('Y');
                    } else {

                        $installment_date = $d->format('Y-m-d');
                        //                    echo '------------------------------------------------ ' . $d->format('Y - m - d'), "\n<br>";
                        $month = $d->format('m');
                        $year = $d->format('Y');
                    }
                }

                //    echo $installment_date;

                array_push($data_payment_schedule, array(
                    'date' => date('Y-m-d H:i:s', strtotime($installment_date)),
                    'installment_balance' => $installment,
                    'status' => false,
                    'fine_status' => false,
                    'is_delete' => false,
                ));
            }


            $insert = $this->loan_model->save($data, $data_payment_schedule, null);


            echo json_encode(array("status" => TRUE, $insert));
        } else {
            echo json_encode(array("status" => FALSE, "error" => "Invalid Member ID"));
        }
    }


    public function old_loan_create()
    {


        $customer = $this->customer_model->get_customer(array('memnumber' => $this->input->post('old_loan_cid')));

        if (!empty($customer) && !empty($customer[0]) && !empty($customer[0]['idcustomer'])) {


            $createDate = new DateTime($this->input->post('old_loan_create_date') . " 10:00:00");
            $amount = $this->input->post('old_loan_amount');
            $duration = $this->input->post('old_loan_duration');
            $is_fixed = true;
            // $last_payment_date = $this->input->post('old_loan_last_payment_date');
            $last_payment_date = new DateTime($this->input->post('old_loan_last_payment_date'));

            $installment = $this->loan_model->round_up(($amount / $duration), 2);

            $temp_data_payment_schedule = array();

            $date = $createDate->format("d");
            $month = $createDate->format("m");
            $year = $createDate->format("Y");
            $time = $createDate->format("H:i:s");

            foreach (range(1, $duration) as $i) {

                $d = new DateTime($year . '-' . $month . '-' . $date);
                $installment_date = '';

                if ($d->format('d') !== $date) {

                    $td = new DateTime($year . '-' . $d->format('m') . '-' . $date);
                    $installment_date = $td->format('Y-m-d');
                    //                echo '------------------------------------------------ ' . $td->format('Y - m - d'), "\n<br>";
                    $month = $td->format('m');
                    $year = $td->format('Y');
                } else {

                    $d->modify('next month');

                    if ($d->format('d') !== $date) {

                        $td = new DateTime($year . '-' . $month . '-01');
                        $td->modify('last day of next month');
                        $installment_date = $td->format('Y-m-d');
                        //                    echo '------------------------------------------------ ' . $td->format('Y - m - d'), "\n<br>";
                        $month = $td->format('m');
                        $year = $td->format('Y');
                    } else {

                        $installment_date = $d->format('Y-m-d');
                        //                    echo '------------------------------------------------ ' . $d->format('Y - m - d'), "\n<br>";
                        $month = $d->format('m');
                        $year = $d->format('Y');
                    }
                }

                array_push($temp_data_payment_schedule, array(
                    'date' => date('Y-m-d H:i:s', strtotime($installment_date)),
                    'installment_balance' => $installment,
                    'status' => false,
                    'fine_status' => false,
                    'is_delete' => false,
                ));
            }

            $data_payment_schedule = array();
            $loan_balance = $this->input->post('old_loan_balance');

            foreach (array_reverse($temp_data_payment_schedule) as $row) {
                if ($loan_balance > 0) {
                    if ($loan_balance >= $row['installment_balance']) {
                        $loan_balance -= $row['installment_balance'];
                    } else {

                        $row['installment_balance'] = $loan_balance;
                        $loan_balance = 0;
                    }

                    $schedule_date = new DateTime($row['date']);
                    if ($schedule_date < $last_payment_date) {
                        $is_fixed = false;
                    }
                } else {
                    $row['installment_balance'] = 0;
                    $row['status'] = true;
                }
                array_push($data_payment_schedule, $row);
            };

            $data1 = array(
                'idcustomer' => $customer[0]['idcustomer'],
                'idloan_type' => $this->input->post('old_loan_type'),
                'amount' => $this->input->post('old_loan_amount'),
                'installment' => $installment,
                'interest' => $this->input->post('old_loan_interest'),
                'duration' => $this->input->post('old_loan_duration'),
                'iduser' => '1',
                'status' => "Active",
                // 'status' => $this->input->post('loan_status'),
                'date' => $createDate->format('Y-m-d H:i:s'),
                'is_old_loan' => true,
                'is_fixed' => $is_fixed,
                // 'is_delete' => false,
            );


            $data2 = array(
                'idloan' => null,
                'date' => $last_payment_date->format('Y-m-d H:i:s'),
                'premium ' => 0,
                'interest' => 0,
                'penalty' => 0,
                'iduser' => '1',
                'is_visible' => false,
                'is_delete' => false
            );

            // $this->loan_model->save_payment_log($data1);

            // echo json_encode(array(
            //     "status" => TRUE, array_reverse($data_payment_schedule), $data1, $is_fixed
            // ));

            $insert = $this->loan_model->save($data1, array_reverse($data_payment_schedule), $data2);
            echo json_encode(array("status" => TRUE, $insert, $is_fixed));
        } else {
            echo json_encode(array("status" => FALSE, "error" => "Invalid Member ID"));
        }
    }


    public function loan_update($id)
    {

        $data = array(
            'idloan_type' => $this->input->post('loan_type'),
            'amount' => $this->input->post('loan_amount'),
            'interest' => $this->input->post('loan_interest'),
            'duration' => $this->input->post('loan_duration'),
            'status' => $this->input->post('loan_status'),
            'is_delete' => false,
        );

        $this->loan_model->update(array('idloan' => $id), $data);
        echo json_encode(array("status" => TRUE));
    }


    public function loan_search()
    {


        $data = $this->loan_model->search(array($_POST['searchType'] => $_POST['text']));
        //        echo json_encode($data);
        //
        if (!empty($data)) {
            foreach ($data as $row) {
                if (!empty($row['idloan'])) {
                    echo '<tr id="' . $row['idloan'] . '">';
                    echo '<td>' . $row['memnumber'] . '</td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['nic'] . '</td>';
                    echo '<td>' . $row['date'] . '</td>';
                    echo '<td>' . $row['status'] . '</td>';
                    echo '<td>';
                    echo '<button type="button" class="btn btn-icons btn-rounded btn-secondary" onclick="editModal(' . $row['idloan'] . ')">';
                    echo '<i class="mdi mdi-pencil"></i>';
                    echo '</button>';
                    //                    echo '<button type="button" class="btn btn-icons btn-rounded btn-danger">';
                    //                    echo '<i class="mdi mdi-delete"></i>';
                    //                    echo '</button>';
                    echo '</td>';
                    echo '</tr>';
                }
            }
        } else {
            echo '<tr class="emptyTable">';
            echo '<td colspan="7"> <h4 class="text-danger">No Results Found!</h4></td>';
            echo '</tr>';
        }
    }

    public function get_loan($id)
    {
        $data = $this->loan_model->get_loan_by_id(array('idloan' => $id));
        echo json_encode($data);
    }

    public function get_loan_payment_log($id)
    {
        $data = $this->loan_model->get_loan_payment_log(array('idloan' => $id));
        echo json_encode($data);
    }

    public function delete_loan($id)
    {
        $data = $this->loan_model->get_loan_payment_log(array('idloan' => $id));
        echo json_encode($data);
    }


    public function loan_types()
    {

        $data['get_loanTypes'] = $this->loan_model->get_loan_types();
        $data['rowCount'] = array(10, 20, 50, 100);
        $this->load->view('templates/header');
        $this->load->view('loan/loan_types', $data);
        $this->load->view('templates/footer');
    }


    public function loan_type_create()
    {

        $data = array(
            'loan_name' => $this->input->post('loan_type_name'),
            // 'iduser' => '1',
            'status' => $this->input->post('loan_type_status'),
            // 'date' => date("Y-m-d H:i:s"),
            'is_delete' => false,
        );

        $insert = $this->loan_model->save_loan_type($data);
        echo json_encode(array("status" => TRUE, $insert));
    }


    public function get_loan_type($id)
    {

        $data = $this->loan_model->get_loan_type_by_id(array('idloan_type' => $id));
        echo json_encode($data);
    }

    public function loan_type_update($id)
    {

        $data = array(
            'loan_name' => $this->input->post('loan_type_name'),
            'status' => $this->input->post('loan_type_status'),
            'is_delete' => false,
        );

        $this->loan_model->update_loan_type(array('idloan_type' => $id), $data);
        echo json_encode(array("status" => TRUE));
    }


    public function loan_type_search()
    {

        $data = $this->loan_model->search_loan_type(array($_POST['searchType'] => $_POST['text']));
        if (!empty($data)) {
            foreach ($data as $row) {
                if (!empty($row['idloan'])) {
                    echo '<tr id="' . $row['idloan_type'] . '">';
                    echo '<td>' . $row['loan_name'] . '</td>';
                    echo '<td>' . $row['status'] . '</td>';
                    echo '<td>';
                    echo '<button type="button" class="btn btn-icons btn-rounded btn-secondary" onclick="editModal(' . $row['idloan_type'] . ')">';
                    echo '<i class="mdi mdi-pencil"></i>';
                    echo '</button>';
                    //                    echo '<button type="button" class="btn btn-icons btn-rounded btn-danger">';
                    //                    echo '<i class="mdi mdi-delete"></i>';
                    //                    echo '</button>';
                    echo '</td>';
                    echo '</tr>';
                }
            }
        } else {
            echo '<tr class="emptyTable">';
            echo '<td colspan="7"> <h4 class="text-danger">No Results Found!</h4></td>';
            echo '</tr>';
        }
    }

    // idloan
    // days
    // payable_amount
    // interest
    // fine

    // balance_of_loan_amount
    // amount_of_payable_installments
    // amount_of_late_installments
    // payment

    public function payment_log_create()
    {

        // echo json_encode(array("status" => TRUE, "AAA", date("Y-m-d H:i:s")));

        // $payment = $this->input->post('show_loan_payment');

        $idloan = $_POST['idloan'];
        $installment = $_POST['installment'];
        $premium = $_POST['payment'];
        $interest = $_POST['interest'];
        $penalty = $_POST['fine'];
        $balance_of_payment = $premium - ($interest + $penalty);
        // $late_installments = $_POST['late_installments'];
        $late_installments = isset($_POST['late_installments']) ? $_POST['late_installments'] : null;
        // $late_installments = serialize($_POST['late_installments']);
        // $late_installments = [];

        $data1 = array(
            'idloan' => $idloan,
            'date' => date("Y-m-d H:i:s"),
            'premium ' => $premium,
            'interest' => $interest,
            'penalty' => $penalty,
            'iduser' => '1',
            'is_delete' => false
        );

        $this->loan_model->save_payment_log($data1);

        $data2 = $this->loan_model->get_loan_schedule(array('idloan' => $idloan));
        if (!empty($data2)) {
            foreach ($data2 as $row) {

                $idpayment_schedule = $row['idpayment_schedule'];
                $installment_balance = $row['installment_balance'];
                $status = false;
                $fine_status = false;


                if ($balance_of_payment > 0 && $installment_balance > 0) {


                    if ($balance_of_payment > $installment_balance) {
                        $balance_of_payment -= $installment_balance;
                        $balance_of_payment = number_format($balance_of_payment, 2, '.', '');
                        $installment_balance = 0;
                    } else {
                        $installment_balance -= $balance_of_payment;
                        $installment_balance = number_format($installment_balance, 2, '.', '');
                        $balance_of_payment = 0;
                    }

                    if ($installment_balance == 0) {
                        $status = true;
                    }
                }

                if ($late_installments && in_array($idpayment_schedule, $late_installments)) {
                    $fine_status = true;
                }

                if ($installment > $installment_balance || $status || $fine_status) {

                    $data3 = array(
                        'installment_balance' => $installment_balance,
                        'status' => $status,
                        'fine_status' => $fine_status
                    );

                    $this->loan_model->update_loan_schedule(array('idpayment_schedule' => $idpayment_schedule), $data3);
                }
            }
        }

        echo json_encode(array("status" => TRUE, $late_installments));
    }


    public function payment_log_update()
    {
        $all_late_installments = $_POST['all_late_installments'];

        if (!empty($all_late_installments)) {
            foreach ($all_late_installments as $row) {
                $data = array(
                    'fine_status' => true
                );

                $this->loan_model->update_loan_schedule(array('idpayment_schedule' => $row['idpayment_schedule']), $data);
            }
        }

        echo json_encode(array("status" => TRUE));
    }


    public function checkLoans()
    {
        $loans = $this->loan_model->get_loans();
        $belated = [];
        $bad_debt = [];
        if (!empty($loans)) {
            foreach ($loans as $loan) {
                $loan_id = $loan['idloan'];
                $loan_installment = $loan['installment'];

                $loan_payment_schedule = $this->loan_model->get_loan_schedule(array('idloan' => $loan_id));
                $amount_of_payable_installments = 0;

                if (!empty($loan_payment_schedule)) {
                    foreach ($loan_payment_schedule as $row) {
                        if ($row['date'] < date("Y-m-d H:i:s") && $row['status'] === '0' && !empty($row['installment_balance'])) {
                            $amount_of_payable_installments += $row['installment_balance'];
                        }
                    }
                }

                if ($amount_of_payable_installments > (9 * $loan_installment)) {
                    array_push($bad_debt, $loan_id);
                    array_push($bad_debt, $amount_of_payable_installments);
                    array_push($bad_debt, 9 * $loan_installment);
                    $this->loan_model->updateLoanStatus(array('idloan' => $loan_id), array('status' => "Bad-Debt"));
                } else if ($amount_of_payable_installments > (3 * $loan_installment)) {
                    array_push($belated, $loan_id);
                    array_push($belated, $amount_of_payable_installments);
                    array_push($belated, 3 * $loan_installment);
                    $this->loan_model->updateLoanStatus(array('idloan' => $loan_id), array('status' => "Belated"));
                } else {
                    $this->loan_model->updateLoanStatus(array('idloan' => $loan_id), array('status' => "Active"));
                }
            }
        }
        // return [$belated, $bad_debt];
        // return $bad_debt;
    }
}
