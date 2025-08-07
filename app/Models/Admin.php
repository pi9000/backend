<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'agent_id',
        'username',
        'email',
        'balance',
        'ip_whitelist',
        'login_verifed',
        'roles',
        'brand_id',
        'created_by',
        'agent_code',
        'permissions',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'secure_pin',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'secure_pin' => 'hashed',
    ];

    public function hasPermission($key)
    {
        $permissions = $this->permissions;

        if (is_string($permissions)) {
            $permissions = json_decode($permissions, true);
        }

        if (str_starts_with($key, 'sub_sidebar.')) {
            $segments = explode('.', $key);

            $isWildcard = in_array('*', $segments, true);

            if ($isWildcard) {
                return $this->checkWildcardPermission($permissions['sub_sidebar'] ?? [], array_slice($segments, 1));
            }

            $value = $permissions;
            foreach ($segments as $segment) {
                if (!is_array($value) || !array_key_exists($segment, $value)) {
                    return false;
                }
                $value = $value[$segment];
            }

            return in_array($value, ['1', true, 'on'], true);
        }
        return in_array($permissions[$key] ?? null, ['1', true, 'on'], true);
    }

    private function checkWildcardPermission($data, $segments)
    {
        if (empty($segments)) {
            return in_array($data, ['1', true, 'on'], true);
        }

        $segment = array_shift($segments);

        if ($segment === '*') {
            foreach ($data as $child) {
                if ($this->checkWildcardPermission($child, $segments)) {
                    return true;
                }
            }
            return false;
        }

        if (!isset($data[$segment])) {
            return false;
        }

        return $this->checkWildcardPermission($data[$segment], $segments);
    }

    public function loginHistory()
    {
        return $this->hasMany(LoginHistory::class, 'agent_id','id');
    }
}
