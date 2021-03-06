<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
		'cpf',
		'telephone',
		'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

	public $timestamps = true;

	public function phoneNumber($telephone) {
		if (strlen($telephone) == 11) {
			echo '(' . substr($telephone, 0, 2) . ') ' . substr($telephone, 2, 5) . '-' . substr($telephone, 7, 4);
		}
	}

	public static function cpf($cpf) {
        return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9);
	}

	public static function clearTelephone($telephone) {
		return str_replace(' ', '', str_replace('(', '', str_replace(')', '', str_replace('-', '', $telephone))));
	}

	public static function clearCpf($cpf) {
		return str_replace('.', '', str_replace('-', '', $cpf));
	}
}
