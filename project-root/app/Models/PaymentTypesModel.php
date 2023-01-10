<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentTypesModel extends Model
{
    protected $table      = 'tbl_paymenttypes';
    protected $primaryKey = 'paymenttype_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['paymenttype_id', 'paymenttype_name', 'description'];

    protected $useTimestamps = true;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    protected $deletedField  = 'is_deleted';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;
}