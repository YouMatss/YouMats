<?php

namespace App\Observers;

use App\Models\Vendor;
use Illuminate\Encryption\Encrypter;

class VendorObserver
{
    public function creating(Vendor $vendor) {
        if($vendor->isDirty('contacts')) {
            $newContacts = [];
            foreach ($vendor->contacts as $contact) {
                $phone = $contact['phone'];
                $encrypter = new Encrypter('kingOfSuppliersA', 'aes-128-gcm');
                $contact['phone_code'] = $encrypter->encrypt($phone);
                $newContacts[] = $contact;
            }
            $vendor->contacts = $newContacts;
        }
    }

    public function updating(Vendor $vendor) {
        if($vendor->isDirty('contacts')) {
            $newContacts = [];
            foreach ($vendor->contacts as $contact) {
                $phone = $contact['phone'];
                $encrypter = new Encrypter('kingOfSuppliersA', 'aes-128-gcm');
                $contact['phone_code'] = $encrypter->encrypt($phone);
                $newContacts[] = $contact;
            }
            $vendor->contacts = $newContacts;
        }
    }
}
