<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\PurchasingModel;
use App\Models\SubmissionModel;
use App\Models\TransactionModel;


class Inventory extends BaseController
{
    public function __construct()
    {
        $this->SubmissionModel = new SubmissionModel();
        $this->PurchasingModel = new PurchasingModel();
        $this->TransactionModel = new TransactionModel();
        $this->ProductModel = new ProductModel();
    }
    public function index()
    {
        // cek session apakah sudah login
        $session = session();
        if (!$session->get('is_logged')) {
            return redirect()->to('/auth/index')->withInput();
        }

        $data = [
            'title' => 'dashboard'
        ];

        return view('view_dashboard', $data);
    }

    public function Submit_EmptyStock()
    {
        // cek session apakah sudah login
        $session = session();
        if (!$session->get('is_logged')) {
            return redirect()->to('/auth/index')->withInput();
        }

        if ($session->get('level_user') != 1) {
            dd("Akses ditolak! Kamu tidak diizinkan menggunakan menu ini!");
        }

        // select * from product
        $getData = $this->ProductModel->findAll();
        $data = [
            'product' => $getData,
            'title' => 'Stock Empty'
        ];
        return view('view_emptyStock', $data);
    }

    // controller untuk input barang
    public function add_product()
    {
        //ErrorListTama : 1 -> NEED VALIDATION INPUTAN!
        $data = [
            'name_product' => $this->request->getVar('name_product'),
            'price' => $this->request->getVar('price'),
        ];

        $this->ProductModel->save($data);


        session()->setFlashdata('Success', 'Product berhasil ditambahkan!');
        return redirect()->to('/inventory/Submit_EmptyStock')->withInput();
    }

    public function submit_data()
    {
        $priority = ($this->request->getVar('priority') != 'YES') ? "NO" : "YES";
        $date_needed = ($this->request->getVar('date_needed') != "0000-00-00") ? $this->request->getVar('date_needed') : date('Y/m/d');

        $totalPrice = $this->request->getVar('price') * $this->request->getVar('quantity');
        $data = [
            'id_product' => $this->request->getVar('id_product'),
            'priority' => $priority,
            'date_needed' => $date_needed,
            'quantity' => $this->request->getVar('quantity'),
            'status_submission' => "Waiting",
            'total_price' => $totalPrice
        ];

        $SubmissionModel = new SubmissionModel();

        $SubmissionModel->save($data);

        // buat flash data
        session()->setFlashdata('Success', 'Product berhasil diajukan!');
        return redirect()->to('/inventory/Submit_EmptyStock')->withInput();
    }

    // controller untuk menampilkan purchasing list
    public function make_purchase()
    {
        $session = session();
        if (!$session->get('is_logged')) {
            return redirect()->to('/auth/index')->withInput();
        }

        // cek apakah user adalah Bag. Purchasing?
        if ($session->get('level_user') != 2) {
            dd("Akses ditolak! Kamu tidak diizinkan menggunakan menu ini!");
        }

        // ambil seluruh data barang yg telah diajukan
        $SubmissionModel = new SubmissionModel();
        $getData = $SubmissionModel->getData();
        $data = [
            'submission' => $getData,
            'title' => 'Purchasing List'
        ];

        // tampilkan view pembuatan pruchasing list (form)
        return view('view_submissionProduct', $data);
    }

    // controller membuat purchase list
    public function make_purchaseList()
    {
        // ambil id dari tiap2 barang yg diajukan
        $data_item = $this->request->getVar('id[]');

        $total_cost = $this->request->getVar('total_cost');

        // buat purchasing list baru!
        // ErrorListTama tambahin buat pengaju
        // 'created_by' => session()->get('name')
        $dataPurchase = [
            'date_needed' => $this->request->getVar('date_needed'),
            'created_by' => session()->get('name'),
            'status' => "proccess",
            'total_cost' => $total_cost,
            'pm_approved' => "Waiting"

        ];

        // insert ke purchasing list table
        $this->PurchasingModel->save($dataPurchase);

        // ambil id dari purchasing list yang baru dibuat
        $getPurchaseId = $this->PurchasingModel->getLastId();

        // masukan ke tabel transaksi untuk detail barangnya (sebanyak jumlah barang yang dimasukkan)
        foreach ($data_item as $id_sub) {

            // ErrorListTama hilangkan 'quantity'
            $detail = [
                'id_purchasing' => $getPurchaseId,
                'id_submission' => $id_sub,
            ];

            $this->TransactionModel->save($detail);
        }

        session()->setFlashdata('Success', 'Purchase List Berhasil Dibuat!');
        // kembalikan ke view purchasing list
        return redirect()->to('/inventory/view_purchaselist')->withInput();
    }

    public function view_purchaselist()
    {
        $data = [
            'purchasing_list' => $this->PurchasingModel->findAll(),
            'title' => 'Approval Status'
        ];

        return view('view_purchaselist', $data);
    }

    public function approval_purchase()
    {
        $role = session()->get('level_user');
        // cek bila tidak ada role maka tidak bisa masuk
        if ($role == NULL) {
            return redirect()->to("/inventory");
        }

        $data = [
            'purchasing_list' => $this->PurchasingModel->getWaitForApproval($role),
            'title' => 'Approval Page'
        ];

        return view("view_approval", $data);
    }

    // controller untuk approved purchase list
    public function approving_list($id)
    {
        $role = session()->get('level_user');

        switch ($role) {
            case 3:
                $this->PurchasingModel
                    ->where('id', $id)
                    ->set([
                        'pm_approved' => "Approved",
                        'gm_approved' => "Waiting"
                    ])
                    ->update();
                break;
            case 4:
                $this->PurchasingModel
                    ->where('id', $id)
                    ->set([
                        'gm_approved' => "Approved",
                        'cfo_approved' => "Waiting"
                    ])
                    ->update();
                break;
            case 5:
                $this->PurchasingModel
                    ->where('id', $id)
                    ->set([
                        'cfo_approved' => "Approved",
                        'status' => "Approved"
                    ])
                    ->update();
                break;
        }

        if ($role == 5) {
            // ambil id tabel submission untuk diupdate
            $dataSubmission = $this->SubmissionModel->getDataByIdPL($id);
            foreach ($dataSubmission as $ds) {
                $this->SubmissionModel
                    ->where('id', $ds)
                    ->set([
                        'status_submission' => "Approved"
                    ])
                    ->update();
            }
        }

        session()->setFlashdata('Success', 'Purchase List Berhasil Dikonfirmasi!');

        return redirect()->to("/inventory/Approval_Purchase");
    }

    // controller untuk menolak list
    public function declining_list($id)
    {

        // tambahkan validasi rolenya!
        $role = session()->get('level_user');

        // dd($desc);
        switch ($role) {
            case 3:
                $this->PurchasingModel
                    ->where('id', $id)
                    ->set([
                        'pm_approved' => "Declined",
                        'status' => "Declined"
                    ])
                    ->update();
                break;
            case 4:
                $this->PurchasingModel
                    ->where('id', $id)
                    ->set([
                        'gm_approved' => "Declined",
                        'status' => "Declined"
                    ])
                    ->update();
                break;
            case 5:
                $this->PurchasingModel
                    ->where('id', $id)
                    ->set([
                        'cfo_approved' => "Declined",
                        'status' => "Declined"
                    ])
                    ->update();
                break;
        }

        $dataSubmission = $this->SubmissionModel->getDataByIdPL($id);
        foreach ($dataSubmission as $ds) {
            $this->SubmissionModel
                ->where('id', $ds)
                ->set([
                    'status_submission' => "Declined"
                ])
                ->update();
        }

        session()->setFlashdata('Success', 'Purchase List Berhasil Ditolak!');

        return redirect()->to("/inventory/Approval_Purchase");
    }
}
