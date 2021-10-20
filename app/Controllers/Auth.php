<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Auth extends BaseController
{
    public function index()
    {
        if ($this->is_logged()) return redirect()->to('/inventory');
        return view('view_login');
    }

    public function login()
    {
        if ($this->is_logged()) return redirect()->to('/inventory');
        $session = session();

        // ambil data username dan pass yg diinput
        $username = $this->request->getVar('username');
        $password = md5($this->request->getVar('password'));

        // instansi model
        $userModel = new UsersModel();

        // ambil data sesuai usernamenya
        $dataUser = $userModel->where('username', $username)->first();

        // cek apakah username tersedia
        if ($dataUser) {
            // cek apakah password benar
            if ($dataUser['password'] == $password) {
                // jika benar masukan data ke session

                $dataSession = [
                    'username' => $dataUser['username'],
                    'id' => $dataUser['id'],
                    'name' => $dataUser['name'],
                    'level_user' => $dataUser['level_user'],
                    'is_logged' => TRUE
                ];

                $session->set($dataSession);
                $pesan = "Selamat datang " . $dataUser['name'] . "!";
                session()->setFlashdata('Success', $pesan);
                // arahkan ke controller inventory
                return redirect()->to('/inventory/index');
            } else {

                // buat flash data untuk swall
                session()->setFlashdata('Danger', 'Password yang Anda masukan salah!');

                // redirect ke menu login
                return redirect()->to('/auth/index')->withInput();
            }
        } else {
            // buat flash data
            session()->setFlashdata('Danger', 'Username yang Anda masukan tidak terdaftar!');

            // redirect ke menu login
            return redirect()->to('/auth/index')->withInput();
        }
    }
    public function logout()
    {
        $session = session();
        $session->destroy();

        return redirect()->to('/auth/index')->withInput();
    }

    public function is_logged()
    {
        session();
        if (session()->get('is_logged')) {
            return true;
        } else {
            return false;
        }
    }
}
