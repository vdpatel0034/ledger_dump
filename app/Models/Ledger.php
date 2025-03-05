<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    use HasFactory;

    protected $table = 'master.ledgers';

    protected $primaryKey = 'id';

    protected $fillable = [
        'created_date',
        'is_active',
        'is_deleted',
        'updated_date',
        'version',
        'code',
        'is_group',
        'is_ledger',
        'is_sub_group',
        'ledger_name',
        'created_by',
        'updated_by',
        'ledger_type_id',
        'parent_id',
        'tb_menu_id',
        'serialnumber',
        'formula',
        'is_editable',
        'depreciation_ledger_id',
        'accumulated_depreciation_id',
        'is_optional',
        'ap_version',
        'fsa_area_id',
        'ledger_header'
    ];
        public function parent()
        {
            return $this->belongsTo(Ledger::class, 'parent_id');
        }
    
        public function children()
        {
            return $this->hasMany(Ledger::class, 'parent_id');
        }
    
        public function subGroup()
        {
            return $this->belongsTo(Ledger::class, 'parent_id')->where('is_ledger', false);
        }
    
        public function group()
        {
            return $this->hasOneThrough(
                Ledger::class,     
                Ledger::class,      
                'id',               
                'id',               
                'parent_id',        
                'parent_id'         
            )->where('master.ledgers.is_ledger', false); 
        }

        public $timestamps = false; // Prevent Laravel from managing timestamps
}
