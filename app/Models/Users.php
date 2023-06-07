<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    use HasFactory;

    public function getUserProfile($id = 0)
    {
        $desigsql = "
            CASE
                WHEN u.utype=3 THEN 'Student'
                WHEN u.utype=4 THEN 'Parent/Guardian'
                ELSE 'Staff'
            END
            ";
        $sql = "SELECT u.*,p.*,(SELECT GROUP_CONCAT(privilegeid) FROM `userprivileges` WHERE userid=u.ID GROUP BY userid) AS privileges
        ,($desigsql) AS designation FROM users u, profile p WHERE p.user_id = u.id LIMIT 1";

        return DB::select($sql);
    }
}
