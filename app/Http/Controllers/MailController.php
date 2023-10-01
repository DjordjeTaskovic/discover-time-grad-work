<?php

namespace App\Http\Controllers;

use App\Models\ContactMails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MailController extends BaseController
{
    public function ad_mailbox(){
        $this->data['mail'] = ContactMails::Mails();
        $this->data['arch_mail'] = ContactMails::Arch_Mails();
        return view('dashboard.admin_pages.mail.mailbox', $this->data);

    }
    public function ad_mailbox_arch(){
        $this->data['mail'] = ContactMails::Mails();
        $this->data['arch_mail'] = ContactMails::Arch_Mails();
        return view('dashboard.admin_pages.mail.mailbox_arch', $this->data);
    }
    public function mail_trash(Request $req){
       
        DB::table('contact_mails')->where('ID','=',$req->mail_ID)->update([
            'is_removed'=> 1
        ]);
        return back();

    }
    public function mail_arch(Request $req){
      
        DB::table('contact_mails')->where('ID','=',$req->mail_ID)->update([
            'is_archived'=> 1
        ]);
        return back();
    }
   
}
