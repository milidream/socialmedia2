<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'profile_picture',
        'cover_picture',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'owner_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'owner_id');
    }

    public function likedComments() {
        return $this->morphedByMany(Comment::class, 'likeable');
    }

    public function likedPosts() {
        return $this->morphedByMany(Post::class, 'likeable');
    }

    public function friendsFrom()
    {
        return $this->belongsToMany(User::class, 'friendship', 'friend1_id', 'friend2_id');
    }

    public function friendsTo()
    {
        return $this->belongsToMany(User::class, 'friendship', 'friend2_id', 'friend1_id');
    }

    public function getFriends() {
        return $this->query()
            ->select('friends.*')
            ->join('friendship', function($join) {
                $join->on('friendship.friend1_id', 'users.id')
                    ->orOn('friendship.friend2_id', 'users.id');
                //->where('is_accepted', true);
            })
            ->join('users as friends', function($join) {
                $join->on('friendship.friend1_id', 'friends.id')
                    ->orOn('friendship.friend2_id', 'friends.id');
            })
            ->where('users.id', $this->getKey())
            ->whereNot('friends.id', $this->getKey())
            ->get();
    }
}
