<?php

namespace App\Controllers;

use App\Database\Models\Invites\InvitesModel;

class User extends BaseController
{

    public function create()
    {
        $inviteToken = $this->request->getVar("invite_token");

        $invitesModel = new InvitesModel();
        $invite =  $invitesModel->where([
            "token" => $inviteToken
        ])->first();

        if (empty($invite))
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        return view("layouts/user/create", [
            "inviteToken" => $inviteToken
        ]);
    }
}
