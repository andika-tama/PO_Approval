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

        return view('view_dashboard');
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
            'product' => $getData
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

        session()->setFlashdata('Alert', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Product Berhasil Ditambahkan!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');

        // redirect ke menu login
        return redirect()->to('/inventory/Submit_EmptyStock')->withInput();
    }

    public function submit_data()
    {
        $priority = ($this->request->getVar('priority') != 'YES') ? "NO" : "YES";
        $date_needed = ($this->request->getVar('date_needed') != "0000-00-00") ? $this->request->getVar('date_needed') : date('Y/m/d');
        $data = [
            'id_product' => $this->request->getVar('id_product'),
            'priority' => $priority,
            'date_needed' => $date_needed,
            'quantity' => $this->request->getVar('quantity'),
        ];

        $SubmissionModel = new SubmissionModel();

        $SubmissionModel->save($data);

        // buat flash data
        session()->setFlashdata('Alert', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Product Berhasil Diajukan!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');

        // redirect ke menu login
        return redirect()->to('/inventory/Submit_EmptyStock')->withInput();
    }

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

        $SubmissionModel = new SubmissionModel();
        $getData = $SubmissionModel->getData();
        $data = [
            'submission' => $getData
        ];

        // dd($getData);
        return view('view_submissionProduct', $data);
    }

    // controller membuat purchase list
    public function make_purchaseList()
    {

        $purchasingModel = new PurchasingModel();
        $transactionModel = new TransactionModel();


        $data_item = $this->request->getVar('id[]');


        // buat purchasing list baru!
        $dataPurchase = [
            'date_needed' => $this->request->getVar('date_needed')
        ];

        $purchasingModel->save($dataPurchase);

        // ambil id dari purchasing list yang baru dibuat
        $getPurchaseId = $purchasingModel->getLastId();

        // masukan ke tabel transaksi untuk detail barangnya

        foreach ($data_item as $id_sub) {

            $detail = [
                'id_purchasing' => $getPurchaseId,
                'id_submission' => $id_sub,
                'quantity' => 1,
            ];

            // dd($detail);
            $transactionModel->save($detail);
        }

        session()->setFlashdata('Alert', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Purchase List Berhasil Dibuat!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');

        // redirect ke menu login
        return redirect()->to('/inventory/make_purchase')->withInput();
        // dd($getPurchaseId);
    }

    public function view_purchaselist()
    {
        $data = [
            'purchasing_list' => $this->PurchasingModel->findAll()
        ];

        // dd($data);
        return view('view_purchaselist', $data);
    }

    public function approval_purchase()
    {
        $role = session()->get('level_user');
        // cek route bila tidak ada role maka tidak bisa masuk
        if ($role == NULL) {
            return redirect()->to("/inventory");
        }

        $data = [
            'purchasing_list' => $this->PurchasingModel->getWaitForApproval($role)
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
                    ->set(['pm_approved' => "Approved"])
                    ->update();
                break;
            case 4:
                $this->PurchasingModel
                    ->where('id', $id)
                    ->set(['gm_approved' => "Approved"])
                    ->update();
                break;
            case 5:
                $this->PurchasingModel
                    ->where('id', $id)
                    ->set(['cfo_approved' => "Approved"])
                    ->update();
                break;
        }

        session()->setFlashdata('Alert', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Purchase List Berhasil Dikonfirmasi!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');


        return redirect()->to("/inventory/Approval_Purchase");
    }
}
