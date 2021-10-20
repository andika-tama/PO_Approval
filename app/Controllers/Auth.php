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

                // arahkan ke controller inventory
                return redirect()->to('/inventory/index');
            } else {

                // buat flash data
                session()->setFlashdata('Alert', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Password yang and masukan salah!!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');

                // redirect ke menu login
                return redirect()->to('/auth/index')->withInput();
            }
        } else {
            // buat flash data
            session()->setFlashdata('Alert', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Username tidak tersedia!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');

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
