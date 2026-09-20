<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * NOTE: Đặt tên là ParentModel thay vì "Parent" để tránh nhầm lẫn với
 * từ khóa `parent::` của PHP, dù về mặt kỹ thuật class tên "Parent" vẫn chạy được.
 * Bảng vẫn là `parents` (khai báo tường minh qua $table).
 */
class ParentModel extends Model
{
    use HasFactory;

    protected $table = 'parents';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
    ];

    public function students(): HasMany
    {
        return $this->hasMany(Student::class, 'parent_id');
    }

    public function feedbacks(): HasMany
    {
        return $this->hasMany(Feedback::class, 'parent_id');
    }
}
